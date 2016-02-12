<?php namespace MPOproperty\Mposuccess\Repositories\News;
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 15.09.2015
 * Time: 22:00
 */

use MPOproperty\Mposuccess\Repositories\Repository;

class NewsRepository extends Repository {

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {

        return 'MPOproperty\Mposuccess\Models\News';
    }

    /**
    * Find post news by id and type
    *
    * @return boolean
    */
    public function findByIdAndType($id, $type)
    {
        // find news
        $news = $this->model
                ->select(['id', 'img', 'name', 'content', 'updated_at'])
                ->where('id', $id);

        if ($type)
            $news->where('type', $type);

        $news = $news->first();

        if(!$news)
            return false;


        $current_updated_at = $news->updated_at . ' ' . $id;

        // get prev news id
        $prev = $this->model
            ->select(\DB::raw('CONCAT(updated_at, " ",id) as uid'), 'id', 'updated_at')
            ->where(\DB::raw('CONCAT(updated_at, " ",id)'), '>=', $current_updated_at)
            ->where('id', '<>', $id)
            ->orderBy('uid', 'asc');

        if ($type)
            $prev->where('type', $type)
                 ->where('display', 1);

        $news->prev = $prev->pluck('id');

        // get next news id
        $next = $this->model
            ->select(\DB::raw('CONCAT(updated_at, " ",id) as uid'), 'id', 'updated_at')
            ->where(\DB::raw('CONCAT(updated_at, " ",id)'), '<=', $current_updated_at)
            ->where('id', '<>', $id)
            ->orderBy('uid', 'desc');

        if ($type)
            $next->where('type', $type)
                 ->where('display', 1);

        $news->next = $next->pluck('id');

        return $news;
    }

    /**
     * Find news by type and paginate
     *
     * @return boolean
     */
    public function findByTypeAndPaginate($type, $perPage)
    {
        return $this->model
            ->select(['id', 'img', 'name', 'preview', 'updated_at'])
            ->where('type', $type)
            ->where('display', 1)
            ->orderBy('updated_at', 'desc')
            ->orderBy('id', 'desc')
            ->paginate($perPage);
    }

    /**
     * Find last num news public (type company or world)
     *
     * @return boolean
     */
    public function findNumberLastPublic($number)
    {
        return $this->model
            ->select(['id', 'img', 'name', 'preview', 'type'])
            ->whereRaw('type = ? or type = ?', [
                config('mposuccess.news_type_company'),
                config('mposuccess.news_type_world') ])
            ->orderBy('updated_at', 'desc')
            ->orderBy('id', 'desc')
            ->take($number)->get();
    }

    /**
     * Create/edit news
     *
     * @return boolean
     */
    public function updateData($data, $request)
    {
        $data['name'] = $data['headLine'];
        $data['type'] = $request->input('type');
        $data['display'] = $request->input('display');

        unset($data['headLine']);

        if ($request->input('id')) {
            $id = $request->input('id');

            $this->update($data, $id);

            $oldImg = $this->find($id, ['img'])->img;
        } else {
            $news = $this->create($data);

            if ($news) {
                $id = $news->id;
                $oldImg = null;
            } else {
                return false;
            }
        }

        /*
         *  Change/add (upload) image for news - if file uploaded
        */
        if ($request->hasFile('file'))
        {
            $destinationPath = config('mposuccess.news_storage_img');
            $fileName = $id . '.' . $request->file('file')->getClientOriginalExtension();

            if ($oldImg) {
                if (file_exists(public_path() . $destinationPath . $oldImg)) {
                    unlink(public_path() . $destinationPath . $oldImg);
                }
            }

            $request->file('file')->move(public_path() . $destinationPath, $fileName);

            $this->update([
                'img' => $fileName
            ], $id);
        }

        return true;
    }

}
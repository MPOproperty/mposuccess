<div class="row">
    <div class="col-md-12 blog-page">
        <div class="row">
            <div class="article-block">
                <div class="row" style="margin: 0">
                    <div class="col-md-3 blog-tag-data" style="float: right">
                        <ul class="list-inline" style="float: right; margin-top: 4px">
                            <li>
                                <i class="fa fa-calendar"></i>
                                <a href="javascript:;">
                                    {{ $news->updated_at or trans('mpouspehm::panel.unknown') }} </a>
                            </li>
                        </ul>
                    </div>
                    <h3 style="margin: 0">
                        @if ($back)
                        <a href="{{ $back }}" >
                            <i class="fa fa-mail-reply"></i></a>
                        @endif
                        {{ $news->name or trans('mpouspehm::panel.unknown') }}</h3>
                </div>
                <div class="blog-tag-data">
                    @if($news->img)
                        <img src="{{ config('mpouspehm.news_storage_img') . $news->img }}" class="img-responsive" alt="">
                    @endif
                </div>

                <div class="content" style="margin-bottom: 20px">
                    {!! $news->content or trans('mpouspehm::panel.unknown') !!}
                </div>

                @if ($news->next)
                    <a href="{{ $news->next }}" class="btn default" style="float: right">
                        Следующая <i class="fa fa-long-arrow-right"></i></a>
                @endif

                @if ($news->prev)
                    <a href="{{ $news->prev }}" class="btn default">
                        <i class="fa fa-long-arrow-left"></i> Предыдущая</a>
                @endif


            </div>
        </div>
    </div>
</div>
@if (count($news))
    <div class="row">

        @for ($j = 0; $j < 3; $j++)

            <div class="col-md-4">

                @for ($i = $j; $i < count($news); $i += 3)
                    <div class="news-blocks">
                        <h3>
                            <a href="/{{$urlPost}}/{{ $news[$i]->id }}">
                                {{ $news[$i]->name }} </a>
                        </h3>
                        <div class="news-block-tags">
                            <strong>{{ $news[$i]->updated_at }}</strong>
                        </div>
                        <p>
                            <img class="news-block-img pull-right"
                                 src="{{ $news[$i]->img ? config('mposuccess.news_storage_img') . $news[$i]->img : config('mposuccess.news_private_default_img') }}" alt="">
                            {{ $news[$i]->preview }}
                        </p>
                        <a href="/{{ $urlPost }}/{{ $news[$i]->id }}" class="news-block-btn">
                            @lang('mposuccess::panel.readMore') <i class="m-icon-swapright m-icon-black"></i>
                        </a>
                    </div>
                @endfor

            </div>

        @endfor

    </div>

    <div class="row text-center" style="margin-bottom: 20px">
        <?php echo $news->render(); ?>
    </div>
@else
    <h2 style="margin-top: 0">
        @if($urlPost == 'news') @lang('mposuccess::panel.news.none') @else @lang('mposuccess::front.articlesNone') @endif</h2>
    <img src="{{ config('mposuccess.news_none_img') }}" alt="" class="img-responsive" style="margin: 0 auto">
@endif

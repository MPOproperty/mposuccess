<div class="row">
    <div class="col-md-12 blog-page">
        <div class="row">
            <div class="col-md-12 col-sm-10 article-block">
                @if (count($news))
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-10">
                                <h2 style="margin-top: 0">@lang('mpouspehm::panel.news.latestNews')</h2>
                            </div>
                            <div class="col-md-2">
                                <form id="perPage">
                                    <select class="bs-select form-control" name="perPage">
                                        @foreach ([1, 3, 5, 10, 20, 50] as $count)
                                            <option value="{{ $count }}" @if($count == $news->perPage()) selected @endif>{{ $count }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>

                    @for ($i = 0; $i < count($news); $i++)
                        @if ($i != 0)
                            <hr>
                        @endif

                        <div class="row">
                            <div class="col-md-4 blog-img blog-tag-data">
                                <img src="{{ $news[$i]->img ? config('mpouspehm.news_storage_img') . $news[$i]->img : config('mpouspehm.news_private_default_img') }}" alt="" class="img-responsive">
                            </div>
                            <div class="col-md-8 blog-article">
                                <h3>
                                    <a href="post/{{ $news[$i]->id }}">
                                        {{ $news[$i]->name }}</a>
                                </h3>
                                <ul class="list-inline">
                                    <li>
                                        <i class="fa fa-calendar"></i>
                                    <span>
                                        {{ $news[$i]->updated_at }} </span>
                                    </li>
                                </ul>
                                <p>
                                    {{ $news[$i]->preview }}
                                </p>
                                <a class="btn blue" href="post/{{ $news[$i]->id }}">
                                    @lang('mpouspehm::panel.readMore')  <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                    @endfor

                    <?php echo $news->render(); ?>
                @else
                    <h2 style="margin-top: 0">@lang('mpouspehm::panel.news.none')</h2>
                    <img src="{{ config('mpouspehm.news_none_img') }}" alt="" class="img-responsive" style="margin: 0 auto">
                @endif
            </div>
        </div>
    </div>
</div>


<script>
    var dataNews = [];

    dataNews['perPage'] = "<?=$news->perPage()?>";
</script>
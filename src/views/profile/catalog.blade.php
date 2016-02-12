<div class="row product-list">
    @foreach($products as $product)
        <?php
            $array_images = [];
            $description_entities = "";

            foreach($product->entities_all as $entity){
                $description_entities .= '<strong>' . $entity->name . ' x'. $entity->pivot->count . '</strong><br>' . $entity->description . '<br>';
                $array_images[] = $entity->image;
            }

            if ($description_entities != '') {
                $description_entities = '<strong>Товары:</strong><br>' . $description_entities;
            }
        ?>

        <div class="col-md-3 col-sm-4 col-xs-6">
            <div class="product-item">
                <div class="pi-img-wrapper">
                    <img src="<?=count($array_images) ? config('mposuccess.entities_storage_img') . $array_images[0] : ''?>" class="img-responsive" alt="">
                    <div>
                        @if (count($array_images))
                        <a href="{{config('mposuccess.entities_storage_img') . $array_images[0]}}" class="btn btn-default fancybox-button">@lang('mposuccess::panel.zoom')</a>
                        @endif
                        <a href="#product-pop-up" class="btn btn-default fancybox-fast-view" data-images="{{implode(",", $array_images)}}"
                           data-count="{{$product->count}}" data-desc="{{$product->des . '<br>' . $description_entities}}">@lang('mposuccess::panel.more')</a>
                    </div>
                </div>
                <h3>{{$product->name}}</h3>
                <div class="pi-price"><span><i class='fa fa-rouble'></i></span>{{$product->coast}}</div>
                <a href="/bye/tree/{{$product->url}}" class="btn btn-default add2cart not-active">@lang('mposuccess::panel.buy')</a>
                <div class="sticker sticker-level"><span>@lang('mposuccess::profile.structures.'.$product->level )</span></div>
            </div>
        </div>
    @endforeach
</div>

<!-- BEGIN fast view of a product -->
<div id="product-pop-up" style="display: none; width: 700px;">
    <div class="product-page product-pop-up">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-3">
                <div class="product-main-image">
                    <img src="/assets/img/products/model7.jpg" alt="Нет изображения" class="img-responsive">
                    <div class="sticker sticker-level"><span></span></div>
                </div>
                <div class="product-other-images">
                    <a href="javascript:;" class="active"><img alt="Berry Lace Dress" src="/images/entities/model3.jpg"></a>
                    <a href="javascript:;"><img alt="Berry Lace Dress" src="/images/entities/model4.jpg"></a>
                    <a href="javascript:;"><img alt="Berry Lace Dress" src="/images/entities/model1.jpg"></a>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-9">
                <h1>Cool green dress with red bell</h1>
                <div class="price-availability-block clearfix">
                    <div class="price">
                        <strong><span>$</span>47.00</strong>
                        <!--em>$<span>62.00</span></em-->
                    </div>
                    <div class="availability">
                        Количество мест: <strong>1</strong>
                    </div>
                </div>
                <div class="description">
                    <p>Lorem ipsum dolor ut sit ame dolore  adipiscing elit, sed nonumy nibh sed euismod laoreet dolore magna aliquarm erat volutpat
                        Nostrud duis molestie at dolore.</p>
                </div>
                <div class="product-page-options"></div>
                <div class="product-page-cart">
                    <div class="product-quantity">
                        <input id="product-quantity" type="text" value="1" readonly name="product-quantity" class="form-control input-sm">
                    </div>
                    <a href="javascript:;" class="btn btn-default add2cart not-active">@lang('mposuccess::panel.buy')</a>
                    <!--a href="shop-item.html" class="btn btn-default">More details</a-->
                    <div id="total">Итого: <strong>$47.00</strong></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END fast view of a product -->

<script>
    var storage_img_entities = "{{config('mposuccess.entities_storage_img')}}";
</script>
{!! \Assets::css() !!}

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title"> {{ $headerTitle }} </h4>
    </div>
<div class="modal-body">

    <div class="row">
        <div class="col-md-12">
            <div id="errors"></div>
        </div>
        <div class="col-md-12">
            <table class="table table-bordered table-striped">
                <tbody>
                <tr>
                    <td style='width:15%'> @lang('mposuccess::panel.products.name') </td>
                    <td style="width:50%">
                        <a href="javascript:;" id="name" data-type="text" data-pk="1" data-placeholder="Вторая структура" data-original-title="@lang("mposuccess::panel.enter") @lang("mposuccess::panel.products.name")"> {{ !empty($product) ? $product->name : '' }} </a>
                    </td>
                </tr>
                <tr>
                    <td style='width:15%'> @lang('mposuccess::panel.products.desc') </td>
                    <td>
                        <a href="javascript:;" id="desc" data-type="textarea" data-pk="1" data-placeholder="Описание.." data-original-title="@lang("mposuccess::panel.enter") @lang("mposuccess::panel.products.desc")"> {{ !empty($product) ? $product->des : '' }} </a>
                    </td>
                </tr>
                <tr>
                    <td style='width:15%'> @lang('mposuccess::panel.products.url') </td>
                    <td style="width:50%">
                        <a href="javascript:;" id="url" data-type="text" data-pk="1" data-placeholder="one" data-original-title="@lang("mposuccess::panel.enter") @lang("mposuccess::panel.products.url")"> {{ !empty($product) ? $product->url : '' }} </a>
                    </td>
                </tr>
                <tr>
                    <td style='width:15%'> @lang('mposuccess::panel.products.price') </td>
                    <td style="width:50%">
                        <input id="price_touchspin" type="text" value="{{ !empty($product) ? $product->price : 1 }}" name="price" class="form-control">
                    </td>
                </tr>
                <tr>
                    <td style='width:15%'> @lang('mposuccess::panel.products.percent') </td>
                    <td style="width:50%">
                        <input id="percent_range" type="text" name="percent" value="0;100"/>
                    </td>
                </tr>
                <tr>
                    <td style='width:15%'> @lang('mposuccess::panel.products.entities') </td>
                    <td style="width:50%">
                        <div id="count_entities" class="start"></div>
                        <select multiple="multiple" class="multi-select" id="entities" name="entities[]">
                            @foreach($entities as $entity)
                                <option title="{{$entity->description}}" value="{{$entity->id}}">{{$entity->name}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style='width:15%'> @lang('mposuccess::panel.products.count') @lang('mposuccess::panel.products.countHelp')</td>
                    <td style="width:50%">
                        <input id="count_touchspin" type="text" name="count" value="{{!empty($product) ? $product->count : 0}}"/>
                    </td>
                </tr>
                <tr>
                    <td style='width:15%'> @lang('mposuccess::panel.products.level') </td>
                    <td style="width:50%">
                        <a href="javascript:;" id="level" data-type="select" data-pk="1" data-value="{{ !empty($product) && $product->level > 0 ? $product->level : 1 }}" data-original-title="@lang("mposuccess::panel.select") @lang("mposuccess::panel.products.level")"></a>
                    </td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>

</div>
<div class="modal-footer">
    <input id="product_id" type="hidden" value="{{ !empty($product) ? $product->id : '' }}"/>
    <button type="button" class="btn default" data-dismiss="modal">@lang('mposuccess::panel.cancel')</button>
    <button id="save" type="button" class="btn blue">@lang('mposuccess::panel.save')</button>
    <a href="javascript:;" style="display: none" class="loading-save">
        <img src="/images/pages/loading-spinner-grey.gif" alt="" class="loading">
        <span>&nbsp;&nbsp;@lang('mposuccess::panel.loading')... </span></a>
</div>

{!! \Assets::js() !!}

<script>
    jQuery(document).ready(function() {
        FormEditable.init();

        $('#entities').multiSelect({
            afterSelect: function(values){
                // if > 8 selected elems
                //console.log($('.ms-selection .ms-selected').length);
                if ($('.ms-selection .ms-selected').length > 8)  {
                    $("#entities").multiSelect('deselect', values);
                    return;
                }

                if (!$('#count_entities').hasClass('start')) {
                    var selected_ids = [];
                    $("#count_entities input[data-entity]").each(function(){
                        selected_ids.push($(this).attr('data-entity'));
                    });

                    var pos = 0;
                    if (selected_ids.length) {
                        for (var i = 0; i < selected_ids.length; i++) {
                            if (selected_ids[i] > values)  {
                                pos = selected_ids[i];
                                break;
                            }
                        }

                        if (pos) {
                            $("#count_entities input[data-entity='"+pos+"']").parent().parent().before('<div><input type="text" data-entity="' + values + '" value="1" readonly name="count_entity" class="form-control input-sm count_entity"></div>');
                        } else {
                            $('#count_entities').append('<div><input type="text" data-entity="' + values + '" value="1" readonly name="count_entity" class="form-control input-sm count_entity"></div>');
                        }
                    } else {
                        $('#count_entities').append('<div><input type="text" data-entity="' + values + '" value="1" readonly name="count_entity" class="form-control input-sm count_entity"></div>');
                    }

                    if ($(this).attr('data-entity') > values) {
                        $('#count_entities').append('<div><input type="text" data-entity="' + values + '" value="1" readonly name="count_entity" class="form-control input-sm count_entity"></div>');
                        return;
                    }
                    initTouchspin();
                }
            },
            afterDeselect: function(value){
                $('#count_entities input[data-entity=' + value + ']').parent().parent().remove();
            }
        });

        var entity_ids = [];
        var counts = [];
        @if ($product)
        @foreach($product->entities as $productEntity)
            entity_ids.push("{{$productEntity->entity_id}}");
            counts.push("{{$productEntity->count}}");
        @endforeach
        @endif

        console.log('entities_id = ', entity_ids);
        $("#entities").multiSelect('select', entity_ids);
        console.log('counts = ', counts);
        for (var i = 0; i < counts.length; i++) {
            $('#count_entities').append('<div><input type="text" data-entity="' + entity_ids[i] + '" value="' + counts[i] + '" readonly name="count_entity" class="form-control input-sm count_entity"></div>');
        }
        $('#count_entities').removeClass('start');


        $("#percent_range").ionRangeSlider({
            type: "single",
            from_value: {{ !empty($product) ? $product->percent : 0 }},
            from: {{ !empty($product) ? $product->percent : 0 }},
            step: 1,
            postfix: " %",
            hideText: true
        });

        $("#count_range").ionRangeSlider({
            type: "single",
            from_value: {{ !empty($product) ? 4 : 0 }},
            from: {{ !empty($product) ? $product->count : 0 }},
            min: 0,
            max: 6,
            step: 1,
            hideText: true
        });
        $("#count_touchspin").TouchSpin({
            buttondown_class: 'btn blue',
            buttonup_class: 'btn blue',
            min: 0,
            max: 6,
            step: 1,
            boostat: 5,
            postfix: ' мест'
        });

        $("#price_touchspin").TouchSpin({
            buttondown_class: 'btn blue',
            buttonup_class: 'btn blue',
            min: 0.01,
            max: 1000000,
            step: 0.01,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 10,
            postfix: 'рублей'
        });

        $('#level').editable({
            inputclass: 'form-control',
            source: [{
                value: '1',
                text:  '1'
            }, {
                value: '2',
                text:  '2'
            }, {
                value: '4',
                text:  '4'
            }, {
                value: '5',
                text:  '5'
            }]
        });

        function initTouchspin() {
            $(".count_entity").TouchSpin({
                step:1,
                min: 1,
                max: 99
            }).on('touchspin.on.startspin, touchspin.on.stopspin', function () {
            });

            $(".quantity-down").html("<i class='fa fa-angle-down'></i>");
            $(".quantity-up").html("<i class='fa fa-angle-up'></i>");
        }

        initTouchspin();

    });
</script>
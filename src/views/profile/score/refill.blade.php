{!! \Assets::css() !!}

{{--Пополнение баланса--}}

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">@lang('mposuccess::profile.score.refill')</h4>
</div>
<div class="modal-body">
    <form method="post" action="{{ route(config('mposuccess.panel_url') . '.payments.refillBalance') }}" enctype="multipart/form-data" id="refillBalanceId"
    data-validation="MPOproperty/Mposuccess/Requests/RefillBalanceRequest">

        <input type="hidden" name="_token" id="_token" value="{{csrf_token() }}" />

        <div class="form-group">
            <label class="control-label">@lang('mposuccess::payment.paymentForm.price')</label>
            <input type="text" name="price_refill" id="price_refill"
                   class="form-control" value="{{ Input::old('price_refill') }}" oninput="taxCalculate(this.id);">
        </div>

         <div class="form-group">
            <label class="control-label">@lang('mposuccess::payment.paymentForm.tax')</label>
            <input type="text" name="tax" id="tax" disabled
                   class="form-control" value="0">
           <span class="help-block"> {{$descriptionTax}} </span>
        </div>

         <div class="form-group">
            <label class="control-label">@lang('mposuccess::payment.paymentForm.description')</label>
            <input type="text" name="description_refill" id="description_refill"
                   class="form-control" value="{{ $descriptionRefill or Input::old('description_refill') }}">
        </div>

        <input style="visibility: hidden" id="tax_default" value="{{ $tax }}">

        <div class="form-group">
            <button class="btn blue" data-dismiss="modal">
                @lang('mposuccess::payment.back')
            </button>
            <button type="submit" class="btn green-haze">
                @lang('mposuccess::payment.refillButton')
            </button>
        </div>

    </form>
</div>

@include('vendor.lrgt.ajax_script', [
    'form' => 'refillBalanceId',
    'on_start'=>false
])

<script>
function taxCalculate (element_id) {
    var result = 0;
    var number = +$('#'+element_id).val();

    if(!isNaN(number) && (isInt(number) || isFloat(number)) && number > 0){
        var taxDefault = +$('#tax_default').val();
        var tax = +( (taxDefault * number) / 100).toFixed(2);
        result = (number + tax).toFixed(2);
    }

    $('#tax').val(result);

    function isInt(n){
        return Number(n) === n && n % 1 === 0;
    }

    function isFloat(n){
        return n === Number(n) && n % 1 !== 0;
    }
}

</script>

{!! \Assets::js() !!}

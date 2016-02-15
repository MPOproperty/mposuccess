{!! \Assets::css() !!}

{{--Вывод средств--}}

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">@lang('mpouspehm::profile.score.withdrawal')</h4>
</div>
<div class="modal-body">
    <form method="post" action="{{ route(config('mpouspehm.panel_url') . '.payments.withdrawalPayment') }}" enctype="multipart/form-data" id="conclusionId"
    data-validation="MPOproperty/Mpouspehm/Requests/WithdrawalRequest">

        <input type="hidden" name="_token" id="_token" value="{{csrf_token() }}" />

        <div class="form-group">
            <label class="control-label">@lang('mpouspehm::payment.paymentForm.method')</label>
            <select id="method_conclusion" class="form-control" name="method_conclusion" id="method_conclusion" data-placeholder="@lang('mpouspehm::payment.selectMethod')" >
                 @foreach ($methods as $key => $method)
                    <option @if(Input::old('method_conclusion') == $key) selected="selected" @endif value="{{ $key }}">{{ $method }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label class="control-label">@lang('mpouspehm::payment.paymentForm.date')</label>
            <input type="date" name="date_conclusion" id="date_conclusion"
                   class="form-control" value="{{ Input::old('date_conclusion') }}">
        </div>

        <div class="form-group">
            <label class="control-label">@lang('mpouspehm::payment.paymentForm.price')</label>
            <input type="text" name="price_conclusion" id="price_conclusion"
                   class="form-control" value="{{ Input::old('price_conclusion') }}">
        </div>

         <div class="form-group">
            <label class="control-label">@lang('mpouspehm::payment.paymentForm.description')</label>
            <input type="text" name="description_conclusion" id="description_conclusion"
                   class="form-control" value="{{ Input::old('description_conclusion') }}">
        </div>

        <div class="form-group">
            <button class="btn blue" data-dismiss="modal">
                @lang('mpouspehm::payment.back')
            </button>
            <button type="submit" class="btn green-haze">
                @lang('mpouspehm::payment.conclusionButton')
            </button>
        </div>

    </form>
</div>

@include('vendor.lrgt.ajax_script', [
    'form' => 'conclusionId',
    'on_start'=>false
])

{!! \Assets::js() !!}

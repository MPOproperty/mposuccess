<script>
    document.body.style.cursor='wait';
</script>

@if(session('status'))
    <script>
    window.onload = function(e){
        document.body.style.cursor='default';
        document.getElementById('modalId').id = 'ajax';

        var status =  '{{session('status')}}' ;
        var name =  '{{session('name')}}' ;
        var message =  '{{session('message')}}' ;

       toastr[status](name, message);
    }
    </script>
@else
    <script>
    window.onload = function(e){
        document.body.style.cursor='default';
        document.getElementById('modalId').id = 'ajax';
    }
    </script>
@endif

<span class="caption-subject font-blue-madison bold uppercase">@lang('mposuccess::profile.score.operations')</span>
<hr>
<div class="tiles">

    {{--Вывод средств--}}
    <a href="/panel/score/conclusion" data-target="#ajax" data-toggle="modal">
        <div class="tile double-down selected withdrawal" >
            <div class="corner">
            </div>
            <div class="check">
            </div>
            <div class="tile-body">
                <h3>@lang('mposuccess::profile.score.withdrawal')</h3>
                Чтобы получить возможность свободно выводить имеющиеся на вашем счету средства, вам нужно обратиться в Компанию и оформить необходимые документы.
            </div>
            <div class="tile-object">
                <div class="name">
                    <i class="fa fa-share"></i>
                </div>

            </div>
        </div>
    </a>

    {{--Пополнение баланса--}}
    <a href="/panel/score/operation-refill" data-target="#ajax" data-toggle="modal">
        <div class="tile double selected refill">
            <div class="corner">
            </div>
            <div class="check">
            </div>
            <div class="tile-body">
                <h3>@lang('mposuccess::profile.score.refill')</h3>
На этой странице собрана информация о различных способах пополнения внутреннего счета. Выберите наиболее удобный для вас способ.
            </div>
            <div class="tile-object">
                <div class="name">
                    <i class="fa fa-plus"></i>
                </div>
            </div>
        </div>
    </a>

    {{--Перевод средств--}}
    <a href="/panel/score/operation-transfer" data-target="#ajax" data-toggle="modal">
        <div class="tile double selected transfer" id="profile-transfer-if">
            <div class="corner">
            </div>
            <div class="check">
            </div>
            <div class="tile-body">
                <h3>@lang('mposuccess::profile.score.transfer')</h3>
                Используйте данный раздел для перевода суммы другому участнику системы.
            </div>
            <div class="tile-object">
                <div class="name">
                    <i class="fa fa-money"></i>
                </div>
            </div>
        </div>
    </a>

</div>
<div class="modal" id="withdrawal" tabindex="-1" role="withdrawal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">@lang('mposuccess::profile.score.withdrawal')</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">Способ</label>
                    <select class="form-control">
                        <option>VISA, MasterCard</option>
                        <option>WebMoney</option>
                        <option>Яндекс.Деньги</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Дата</label>
                    <input type="date" class="form-control">
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Сумма</label>
                    <input type="text" class="form-control" placeholder="Сумма...">
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Комментарий</label>
                    <textarea class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn default" data-dismiss="modal">Назад</button>
                <button type="button" class="btn blue">Вывести</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<div class="modal" id="modalId" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <img src="/images/pages/loading-spinner-grey.gif" alt="" class="loading">
            </div>
        </div>
    </div>
</div>

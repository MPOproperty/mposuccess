<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PROFILE SIDEBAR -->
        <div class="profile-sidebar">
            <!-- PORTLET MAIN -->
            <div class="portlet light profile-sidebar-portlet">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    <img src="{{ $user->url_avatar ? $user->url_avatar : '/images/users/default.jpg' }}"
                         class="img-responsive" alt="">
                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name">
                        {{ $user->surname }} {{ $user->name }}
                    </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR BUTTONS -->
                <div class="profile-userbuttons">
                    @if($refer)
                        <a href="/panel/user/{{ $user->refer }}" data-target="#ajax" data-toggle="modal"
                           class="btn btn-circle green-haze btn-sm">@lang('mpouspehm::profile.refer')</a>
                    @endif
                    <div class="profile-usermenu">
                        <ul class="nav">
                            <li>
                                <a href="/panel/personal/">
                                    <i class="icon-note"></i>@lang('mpouspehm::profile.personalInfo.title')
                                </a>
                            </li>
                            <li class="active">
                                <a href="/panel/partner/">
                                    <i class="icon-users"></i>@lang('mpouspehm::profile.partnerProgram.title')
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- END SIDEBAR BUTTONS -->
            </div>
            <!-- END PORTLET MAIN -->
        </div>
        <!-- END BEGIN PROFILE SIDEBAR -->
        <!-- BEGIN PROFILE CONTENT -->
        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light">
                        <div class="portlet-title tabbable-line">
                            <div class="row text-center">
                                <i class="icon-globe theme-font hide"></i>
                                <span class="caption-subject font-blue-madison bold uppercase">@lang('mpouspehm::profile.partnerProgram.title')</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <!-- PARTNER PROGRAM TAB -->

                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="portlet blue-hoki box">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="fa fa-cogs"></i>@lang('mpouspehm::profile.instruction')
                                                        : {{ $program->name or trans('mpouspehm::panel.unknown') }}
                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="slimScrollDiv">
                                                        <div class="full-height-content-body" style="height: 210px">
                                                            {!! $program->description or '' !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="portlet sale-summary">
                                                <div class="portlet-title">
                                                    <div class="caption" style="font-size: 16px;">
                                                        @lang('mpouspehm::profile.partnerProgram.statisticReferrals')
                                                    </div>
                                                    <!--div class="tools">
                                                        <a class="reload" href="javascript:;">
                                                        </a>
                                                    </div-->
                                                </div>
                                                <div class="portlet-body">
                                                    <ul class="list-unstyled">
                                                        @foreach($countPlaces as $level => $value)
                                                            <li>
                                                                <span class="sale-info">@lang('mpouspehm::profile.structures.'.$level ) @lang('mpouspehm::profile.partnerProgram.level')
                                                                    <i class="fa fa-img-up"></i></span>
                                                                <span class="sale-num">{{ $value }} </span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="control-label">@lang('mpouspehm::profile.partnerProgram.refLink')</label>

                                            <div id="copy-block" style="position: relative">
                                                <input type="text" class="form-control"
                                                       value="{{ url('') . config('mpouspehm.register_url') . $user->sid }}"
                                                       disabled>

                                                <div id="copy-button"
                                                     data-clipboard-text="{{ url('') . config('mpouspehm.register_url') . $user->sid }}"
                                                     title="@lang('mpouspehm::profile.copyInBuffer')"
                                                     style="position: absolute; top: 0; right: 0; cursor: pointer"
                                                     class="btn blue">
                                                    <i class="fa fa-copy"></i> @lang('mpouspehm::profile.copy')</div>
                                            </div>
                                        </div>
                                    </div>
									<div class="row">
										<div class="col-md-8">
											<p style="text-align: right;">Форма утверждена Правлением МПО «Успех-М»<br /> Протокол от 14 сентября 2015г.</p>
											<p> </p>
											<p> </p>
											<p style="text-align: center;"><strong>Договор</strong> <strong>оферты</strong></p>
											<p style="text-align: center;">по обеспечению товарами и услугами участников Международного Потребительского Общества «Успех-М»</p>
											<p style="text-align: right;">г. Москва «14» сентября 2015 года</p>
											<p>Международное Потребительское Общество «Успех-М» (далее «Общество») в лице Председателя Правления Верчиновой Ларисы Анатольевны, действующего на основании Устава, предлагает, а участник (далее «Оферент») действующий на основании собственного волеизъявления, принимает следующие предложения:</p>
											<ol>
											<li>Общество предоставляет информацию, услуги, организует и совершает иные действия, направленные на получение Оферентом и членами его семьи товаров и услуг действуя по его поручению от своего имени и/или от имени Оферента, но в интересах и за счет денежных средств Оферента.</li>
											<li>Перечень товаров и услуг указывается в каталоге и предложениях на сайте Общества. Заявка на потребление той или иной услуги оформляется в порядке, указанном на сайте.</li>
											<li>Оферент имеет право на ознакомление с уставом, нормативными документами Общества и другой информацией, касающейся предмета настоящих «Общих условий».</li>
											<li>Оферент присоединяется к числу участников Потребительского Клуба Общества и присоединении к положениям его уставных и нормативных документов.</li>
											<li>Общество вносит Оферента в единый список участников подготовительной программы Потребительского Клуба Общества, что свидетельствует о его вступлении в кандидаты членов Общества и дает право заявления в Общество с просьбами об удовлетворении материальных и иных потребностей.</li>
											<li>Правами участника может пользоваться только Оферент, либо уполномоченные представители Оферента при наличии его заявления или доверенности. В случае выдачи участникам индивидуальных карточек, за использованием своей карточки обязан следить Оферент.</li>
											<li>При изменении своих данных Оферент обязан незамедлительно уведомить об этом Общество в письменном виде.</li>
											<li>В случае выхода Оферента из числа кандидатов в члены Общества, все заключенные с ним договоры расторгаются автоматически с момента выхода.</li>
											<li>В целях реализации договоренностей сторон (оформленных в письменном виде), Оферент уполномочивает, а Общество принимает на себя обязательства совершить следующие действия:
											<ul>
											<li>организовать и провести консультации со специалистами и исполнителями;</li>
											<li>заключить необходимые договоры с третьими лицами на получение Оферентом товаров и услуг и заплатить по условиям таких договоров за счет денежных взносов Оферента;</li>
											<li>предоставить Оференту необходимое имущество, в рамках действующих программ, для безвозмездного использования;</li>
											</ul>
											</li>
											<li style="list-style-type: none;">Полномочия Общества указанные в настоящем разделе действуют исключительно в пределах перечня товаров и услуг, который представляется на официальном сайте Общества или дополнительно согласованных с Оферентом.</li>
											<li>Общество вправе требовать от Оферента возмещения фактических убытков, причиненных Обществу прекращением представительства от имени Оферента, если такое прекращение случилось до окончания срока действия отдельных соглашений или приложений, согласованный Сторонами.</li>
											<li>В случае нарушения настоящих «Общих условий» стороны возмещают причиненные убытки за счет нарушителя.</li>
											<li>В случае недобросовестных действий сторон они вправе предъявить требования друг к другу в соответствии с действующим законодательством.</li>
											<li>Все данные об Оференте, полученные Обществом в анкете участника и других документах, сохраняются в строго конфиденциальной форме. Оферент выражает свое согласие получать от Общества любые рекламные и информационные материалы, которые будут ему направляться Обществом и/или его уполномоченными представителями по почте и/или иным способом.</li>
											<li>Оферент выражает согласие с настоящим Договором путем электронной регистрации на сайте Общества.</li>
											</ol>
											<p style="text-align: right;">Председатель Правления МПО «Успех-М»</p>
											<p style="text-align: right;">Верчинова Л.А.</p>
										</div>
									</div>
                                </div>
                            </div>
                        </div>
                        <!-- END PARTNER PROGRAM TAB -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END PROFILE CONTENT -->
</div>
</div>

<div class="modal fade" id="ajax" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <img src="/images/pages/loading-spinner-grey.gif" alt="" class="loading">
                <span>&nbsp;&nbsp; + messages['loading'] + ... </span>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var dataUser = [];

    dataUser['country'] = "{{ $user->country }}";
    dataUser['program'] = "{{ $user->program }}";
    dataUser['phone'] = "{{ old('phone', $user->phone) }}";

</script>

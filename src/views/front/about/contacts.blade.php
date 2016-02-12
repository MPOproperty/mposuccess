<div class="row margin-bottom-40">
    <!-- BEGIN CONTENT -->
    <div class="col-md-12">
        <h1>Контакты</h1>
        <div class="content-page">
            <div class="row">
                <div class="col-md-12">
                    @if(!empty($errors->all()))
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert"></button>
                            Сообщение не отправлено! Проверьте данные.
                        </div>
                    @endif
                    @if(isset($success))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert"></button>
                            Сообщение успешно отправлено.
                        </div>
                    @endif
                </div>
                <div class="col-md-12 margin-bottom-40"  style="height:400px;">
                   <script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=veZhT3pkjvoB6HzGAkymr7neCXD8HWsI&width=100%&height=100%&lang=ru_RU&sourceType=constructor"></script>
                </div>
                <div class="col-md-9 col-sm-9">
                    <h2>Обратная связь</h2>
                    <p>Данный сервис предназначен для обратной связи с МПО "Успех-М".
                        Воспользуйтесь формой, чтобы задать интересующий Вас вопрос,
                        отправить комментарии, замечания или предложения.
                        Для отправки заполните соответствующие поля. Обращаем Ваше внимание,
                        что корректное и полное заполнение полей формы обращения поможет нам быстро и
                        качественно ответить Вам. </p>
                    <!-- BEGIN FORM-->
                    <form method="POST" role="form">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-group">
                            <label for="contacts-name">Имя</label>
                            <input type="text" name="name" class="form-control" id="contacts-name" value="{{ old('name') }}">
                            @if($errors->has('name'))
                                <span class="help-block error">{{$errors->first('name')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="contacts-email">Email</label>
                            <input type="email" name="email" class="form-control" id="contacts-email" value="{{ old('email') }}">
                            @if($errors->has('email'))
                                <span class="help-block error">{{$errors->first('email')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="contacts-phone">Телефон</label>
                            <input type="text" name="phone" class="form-control" id="contacts-phone" value="{{ old('phone') }}">
                            @if($errors->has('phone'))
                                <span class="help-block error">{{$errors->first('phone')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="contacts-message">Сообщение</label>
                            <textarea class="form-control" name="message" rows="5" id="contacts-message"> {{ old('message') }}</textarea>
                            @if($errors->has('message'))
                                <span class="help-block error">{{$errors->first('message')}}</span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> Отправить</button>
                    </form>
                    <!-- END FORM-->
                </div>

                <div class="col-md-3 col-sm-3 sidebar2">
                    <h2>Наши контакты</h2>
                    <address>
                        <strong>МПО "Успех-М"</strong><br>
                        Электродная улица, 4Б,офис 107<br>
                        Москва, РФ 111123<br>
                        <abbr title="Телефон">T:</abbr> +7 (495) 255-28-09<br>
                        <abbr title="Телефон">T:</abbr> +7 (985) 267-04-04
                    </address>
                    <address>
                        <strong>Email</strong><br>
                        <a href="mailto:mpo-uspeh-m@yandex.ru">mpo-uspeh-m@yandex.ru</a><br>
                        <a href="mailto:info@mposuccess.ru">info@mposuccess.ru</a>
                    </address>
                    <ul class="social-icons margin-bottom-20">
                        <li><a href="javascript:;" data-original-title="facebook" class="facebook"></a></li>
                        <li><a href="javascript:;" data-original-title="Goole Plus" class="googleplus"></a></li>
                        <li><a href="javascript:;" data-original-title="Вконтакте" class="vk"></a></li>
                        <li><a href="javascript:;" data-original-title="Twitter" class="twitter"></a></li>
                        <li><a href="javascript:;" data-original-title="Skype" class="skype"></a></li>
                    </ul>

                    <h2 class="padding-top-20">О нас</h2>
                    <p>Мы лучшая компания по подбору бизнес-проектов.</p>
                    <ul class="list-unstyled">
                        <li><i class="fa fa-check"></i> Самые актуальные проекты</li>
                        <li><i class="fa fa-check"></i> Бесплатная консультация юристов </li>
                        <li><i class="fa fa-check"></i> Индивидуальная работа с претендентом</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT -->
</div>

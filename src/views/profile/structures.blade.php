<div class="col-md-4">

    @if($data)
        <div style="position: absolute;">
            <div class="input-group">
                @if($level % 3)
                    <select name="place" id="select2_place" data-href="/{{config('mpouspehm.panel_url')}}/structures/{{$level}}/" class="form-control select2 input-sm">
                        @foreach ($listPlaces as $key => $place)
                            <option value="{{$place}}">{{$key+1}} место - №{{$place}} в структуре @if($currentPlace == $place) ОНО @endif</option>
                        @endforeach
                    </select>
                    <span class="input-group-btn">
                        <button id="setPlace" class="btn blue" type="button">Go!</button>
                    </span>
                @else
                    <select name="place" id="select2_place" data-href="/{{config('mpouspehm.panel_url')}}/structures/{{$level}}/" class="form-control select2 input-sm">
                        @foreach ($listPlaces as $key => $place)
                            <option value="{{$place['id']}}">{{$place['number']}} место - @if($place['reborn']) реинвестированое @else не реинвестированое @endif</option>
                        @endforeach
                    </select>
                @endif
            </div>
        </div>

        <div id="body">
            <div id="toolTip" class="tooltip">
                <div id="head" class="header"></div>
                <div id="header1" class="header1"></div>
                <div id="header2" class="header2"></div>
                <div id="statistic">
                    <div id="triangle" class="selected">
                        <div class="header3"><br>Статистика в треугольнике</div>
                        <div class="header3"><br>Своих мест / Лично приглашённых</div>
                        <div class="header-rule"></div>
                        <div class="value header4"></div>
                    </div>
                    <div id="structure" class="selected">
                        <div class="header3"><br>Статистика в структуре</div>
                        <div class="header3"><br>Своих мест / Лично приглашённых</div>
                        <div class="header-rule"></div>
                        <div class="value header4"></div>
                    </div>
                </div>
            </div>
        </div>
    @else
        {{ $sheet }}
    @endif
</div>

<script>
    var data = [];
    data['sid']   = "{{ $sid }}";
    data['level'] = "{{ $level }}";
    data['data']  = "{{ $data }}";
</script>

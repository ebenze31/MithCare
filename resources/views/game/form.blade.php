
<style>
    input[type="file"]::file-selector-button {
            border: 2px solid #00cec9;
            border-radius: 50%;
            padding: 0.3em 0.5em;
            border-radius: 0.8em;
            background-color: #81ecec;
            transition: 1s;
            margin-top: 0.8em;

        }

        input[type="file"]::file-selector-button:hover {
            background-color: #007bff;
            border: 2px solid #4170A2;
        }


</style>

<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'ชื่อเกม' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($game->name) ? $game->name : ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('link') ? 'has-error' : ''}}">
    <label for="link" class="control-label">{{ 'ลิ้ง' }}</label>
    <input class="form-control" name="link" type="text" id="link" value="{{ isset($game->link) ? $game->link : ''}}" >
    {!! $errors->first('link', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('img') ? 'has-error' : ''}}">
    <label for="img" class="control-label">{{ 'รูปภาพปกเกม' }}</label>
    <input class="form-control" name="img" type="file" id="img" value="{{ isset($game->img) ? $game->img : ''}}" >
    {!! $errors->first('img', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('detail_of_game') ? 'has-error' : ''}}">
    <label for="detail_of_game" class="control-label">{{ 'รายละเอียดเกม' }}</label>
    <textarea class="form-control" name="detail_of_game" type="text" id="detail_of_game">{{ isset($game->detail_of_game) ? $game->detail_of_game : ''}}</textarea>
    {!! $errors->first('detail_of_game', '<p class="help-block">:message</p>') !!}
</div>
{{-- <div class="form-group {{ $errors->has('amount_click') ? 'has-error' : ''}}">
    <label for="amount_click" class="control-label">{{ 'จำนวนคลิ๊ก' }}</label>
    <input class="form-control" name="amount_click" type="text" id="amount_click" value="{{ isset($game->amount_click) ? $game->amount_click : ''}}" >
    {!! $errors->first('amount_click', '<p class="help-block">:message</p>') !!}
</div> --}}



<div class="form-group">
    <div class="row">
        <div class="col-12 col-md-2">
            <a href="{{ url('/game') }}" title="Back">
                <span class="btn btn-info btn-sm main-shadow main-radius">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> กลับ
                </span>
            </a>
        </div>
        <div class="col-12 col-md-10 ">
            <button class="btn btn-primary main-shadow main-radius float-right" type="submit" >{{ $formMode === 'edit' ? 'แก้ไข' : 'บันทึก' }}</button>
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'เรื่อง' }}</label>
    <input class="form-control" name="title" type="text" id="title" value="{{ isset($health_check->title) ? $health_check->title : ''}}" >
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
<div class="row">
    <div class="col-md-4 col-12">
        <div class="form-group {{ $errors->has('img_1') ? 'has-error' : ''}}">
            <label for="img_1" class="control-label">{{ 'Img 1' }}</label>
            <input class="form-control" name="img_1" type="text" id="img_1" value="{{ isset($health_check->img_1) ? $health_check->img_1 : ''}}" >
            {!! $errors->first('img_1', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-4 col-12">
        <div class="form-group {{ $errors->has('img_2') ? 'has-error' : ''}}">
            <label for="img_2" class="control-label">{{ 'Img 2' }}</label>
            <input class="form-control" name="img_2" type="text" id="img_2" value="{{ isset($health_check->img_2) ? $health_check->img_2 : ''}}" >
            {!! $errors->first('img_2', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-4 col-12">
        <div class="form-group {{ $errors->has('img_3') ? 'has-error' : ''}}">
            <label for="img_3" class="control-label">{{ 'Img 3' }}</label>
            <input class="form-control" name="img_3" type="text" id="img_3" value="{{ isset($health_check->img_3) ? $health_check->img_3 : ''}}" >
            {!! $errors->first('img_3', '<p class="help-block">:message</p>') !!}
        </div>
    </div>



</div>




<div class="form-group">
    <div class="row">
        <div class="col-3 col-md-2">
            <a href="{{ url('/health_check') }}" title="Back">
                <button class="btn btn-info btn-sm main-shadow main-radius">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> กลับ
                </button>
            </a>
        </div>
        <div class="col-12 col-md-10 ">
            <button class="btn btn-primary main-shadow main-radius float-right" type="submit" >{{ $formMode === 'edit' ? 'แก้ไข' : 'บันทึก' }}</button>
        </div>
    </div>
</div>

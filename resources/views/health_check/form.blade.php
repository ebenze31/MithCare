<style>
    input[type="file"]::file-selector-button {
  border: 2px solid #007bff;
  border-radius: 50%;
  padding: 0.3em 0.5em;
  border-radius: 0.8em;
  background-color: #4170A2;
  transition: 1s;
}

input[type="file"]::file-selector-button:hover {
  background-color: #81ecec;
  border: 2px solid #00cec9;
}
</style>
<center>
    <div class="form-group ">
        <label for="title" class="control-label">{{ 'เรื่อง' }}</label>
        <input class="form-control" name="title" type="text" id="title" value="{{ isset($health_check->title) ? $health_check->title : ''}}" >
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</center>
<div class="row">
    <div class="col-md-12 col-12">
        <div class="form-group {{ $errors->has('img_1') ? 'has-error' : ''}}">
            <label for="img_1" class="control-label">รูปเอกสาร 1</label>
            <input  class="form-control p-2" name="img_1" type="file" id="img_1" value="{{ isset($health_check->img_1) ? $health_check->img_1 : ''}}" >
            {!! $errors->first('img_1', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-12 col-12">
        <div class="form-group {{ $errors->has('img_2') ? 'has-error' : ''}}">
            <label for="img_2" class="control-label">รูปเอกสาร 2</label>
            <input class="form-control p-2" name="img_2" type="file" id="img_2" value="{{ isset($health_check->img_2) ? $health_check->img_2 : ''}}" >
            {!! $errors->first('img_2', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-12 col-12">
        <div class="mb-3">
            <label for="formFile" class="form-label">รูปเอกสาร 3</label>
            <input class="form-control p-2" name="formFile" type="file" id="formFile" value="{{ isset($health_check->img_2) ? $health_check->img_2 : ''}}" >
          </div>
    </div>
</div>


<div class="form-group">
    <div class="row">
        <div class="col-6 ">
            <a href="{{ url('/health_check') }}" title="Back">
                <span class="btn-old btn-info btn-sm main-shadow main-radius">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> กลับ
                </span>
            </a>
        </div>
        <div class="col-6 ">
            <button class="btn-old btn-primary main-shadow main-radius float-right" type="submit" >{{ $formMode === 'edit' ? 'แก้ไข' : 'บันทึก' }}</button>
        </div>
    </div>
</div>


<script>
    $(".form-control").change(function() {
    filename = this.files[0].name;
    });
</script>

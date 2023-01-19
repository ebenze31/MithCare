<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Title' }}</label>
    <input class="form-control" name="title" type="text" id="title" value="{{ isset($health_check->title) ? $health_check->title : ''}}" >
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('img_1') ? 'has-error' : ''}}">
    <label for="img_1" class="control-label">{{ 'Img 1' }}</label>
    <input class="form-control" name="img_1" type="text" id="img_1" value="{{ isset($health_check->img_1) ? $health_check->img_1 : ''}}" >
    {!! $errors->first('img_1', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('img_2') ? 'has-error' : ''}}">
    <label for="img_2" class="control-label">{{ 'Img 2' }}</label>
    <input class="form-control" name="img_2" type="text" id="img_2" value="{{ isset($health_check->img_2) ? $health_check->img_2 : ''}}" >
    {!! $errors->first('img_2', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('img_3') ? 'has-error' : ''}}">
    <label for="img_3" class="control-label">{{ 'Img 3' }}</label>
    <input class="form-control" name="img_3" type="text" id="img_3" value="{{ isset($health_check->img_3) ? $health_check->img_3 : ''}}" >
    {!! $errors->first('img_3', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="control-label">{{ 'User Id' }}</label>
    <input class="form-control" name="user_id" type="text" id="user_id" value="{{ isset($health_check->user_id) ? $health_check->user_id : ''}}" >
    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>

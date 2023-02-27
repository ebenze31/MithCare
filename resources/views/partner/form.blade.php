<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($partner->name) ? $partner->name : ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('full_name') ? 'has-error' : ''}}">
    <label for="full_name" class="control-label">{{ 'Full Name' }}</label>
    <input class="form-control" name="full_name" type="text" id="full_name" value="{{ isset($partner->full_name) ? $partner->full_name : ''}}" >
    {!! $errors->first('full_name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
    <label for="type" class="control-label">{{ 'Type' }}</label>
    <input class="form-control" name="type" type="text" id="type" value="{{ isset($partner->type) ? $partner->type : ''}}" >
    {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
    <label for="phone" class="control-label">{{ 'Phone' }}</label>
    <input class="form-control" name="phone" type="text" id="phone" value="{{ isset($partner->phone) ? $partner->phone : ''}}" >
    {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('mail') ? 'has-error' : ''}}">
    <label for="mail" class="control-label">{{ 'Mail' }}</label>
    <input class="form-control" name="mail" type="text" id="mail" value="{{ isset($partner->mail) ? $partner->mail : ''}}" >
    {!! $errors->first('mail', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('name_line_group') ? 'has-error' : ''}}">
    <label for="name_line_group" class="control-label">{{ 'Name Line Group' }}</label>
    <input class="form-control" name="name_line_group" type="text" id="name_line_group" value="{{ isset($partner->name_line_group) ? $partner->name_line_group : ''}}" >
    {!! $errors->first('name_line_group', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('show_homepage') ? 'has-error' : ''}}">
    <label for="show_homepage" class="control-label">{{ 'Show Homepage' }}</label>
    <input class="form-control" name="show_homepage" type="text" id="show_homepage" value="{{ isset($partner->show_homepage) ? $partner->show_homepage : ''}}" >
    {!! $errors->first('show_homepage', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('line_group_id') ? 'has-error' : ''}}">
    <label for="line_group_id" class="control-label">{{ 'Line Group Id' }}</label>
    <input class="form-control" name="line_group_id" type="text" id="line_group_id" value="{{ isset($partner->line_group_id) ? $partner->line_group_id : ''}}" >
    {!! $errors->first('line_group_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>

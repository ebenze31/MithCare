<div class="form-group {{ $errors->has('group_id') ? 'has-error' : ''}}">
    <label for="group_id" class="control-label">{{ 'Group Id' }}</label>
    <input class="form-control" name="group_id" type="text" id="group_id" value="{{ isset($group_line->group_id) ? $group_line->group_id : ''}}" >
    {!! $errors->first('group_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('group_name') ? 'has-error' : ''}}">
    <label for="group_name" class="control-label">{{ 'Group Name' }}</label>
    <input class="form-control" name="group_name" type="text" id="group_name" value="{{ isset($group_line->group_name) ? $group_line->group_name : ''}}" >
    {!! $errors->first('group_name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('picture_url') ? 'has-error' : ''}}">
    <label for="picture_url" class="control-label">{{ 'Picture Url' }}</label>
    <input class="form-control" name="picture_url" type="text" id="picture_url" value="{{ isset($group_line->picture_url) ? $group_line->picture_url : ''}}" >
    {!! $errors->first('picture_url', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('owner') ? 'has-error' : ''}}">
    <label for="owner" class="control-label">{{ 'Owner' }}</label>
    <input class="form-control" name="owner" type="text" id="owner" value="{{ isset($group_line->owner) ? $group_line->owner : ''}}" >
    {!! $errors->first('owner', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('partner_id') ? 'has-error' : ''}}">
    <label for="partner_id" class="control-label">{{ 'Partner Id' }}</label>
    <input class="form-control" name="partner_id" type="text" id="partner_id" value="{{ isset($group_line->partner_id) ? $group_line->partner_id : ''}}" >
    {!! $errors->first('partner_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>

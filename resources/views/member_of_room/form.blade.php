<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'Status' }}</label>
    <input class="form-control" name="status" type="text" id="status" value="{{ isset($member_of_room->status) ? $member_of_room->status : ''}}" >
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('lv_of_caretaker') ? 'has-error' : ''}}">
    <label for="lv_of_caretaker" class="control-label">{{ 'Lv Of Caretaker' }}</label>
    <input class="form-control" name="lv_of_caretaker" type="text" id="lv_of_caretaker" value="{{ isset($member_of_room->lv_of_caretaker) ? $member_of_room->lv_of_caretaker : ''}}" >
    {!! $errors->first('lv_of_caretaker', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="control-label">{{ 'User Id' }}</label>
    <input class="form-control" name="user_id" type="text" id="user_id" value="{{ isset($member_of_room->user_id) ? $member_of_room->user_id : ''}}" >
    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('room_id') ? 'has-error' : ''}}">
    <label for="room_id" class="control-label">{{ 'Room Id' }}</label>
    <input class="form-control" name="room_id" type="text" id="room_id" value="{{ isset($member_of_room->room_id) ? $member_of_room->room_id : ''}}" >
    {!! $errors->first('room_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>

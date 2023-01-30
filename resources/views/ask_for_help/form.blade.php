<div class="form-group {{ $errors->has('name_user') ? 'has-error' : '' }}">
    <label for="name_user" class="control-label">{{ 'Name User' }}</label>
    <input class="form-control" name="name_user" type="text" id="name_user"
        value="{{ isset($ask_for_help->name_user) ? $ask_for_help->name_user : '' }}">
    {!! $errors->first('name_user', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">
    <label for="content" class="control-label">{{ 'Content' }}</label>
    <input class="form-control" name="content" type="text" id="content" value="{{ isset($ask_for_help->content) ? $ask_for_help->content : ''}}" >
    {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
</div>
{{-- <div class="form-group {{ $errors->has('lat') ? 'has-error' : ''}}">
    <label for="lat" class="control-label">{{ 'Lat' }}</label>
    <input class="form-control" name="lat" type="text" id="lat" value="{{ isset($ask_for_help->lat) ? $ask_for_help->lat : ''}}" >
    {!! $errors->first('lat', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('lng') ? 'has-error' : ''}}">
    <label for="lng" class="control-label">{{ 'Lng' }}</label>
    <input class="form-control" name="lng" type="text" id="lng" value="{{ isset($ask_for_help->lng) ? $ask_for_help->lng : ''}}" >
    {!! $errors->first('lng', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('province') ? 'has-error' : ''}}">
    <label for="province" class="control-label">{{ 'Province' }}</label>
    <input class="form-control" name="province" type="text" id="province" value="{{ isset($ask_for_help->province) ? $ask_for_help->province : ''}}" >
    {!! $errors->first('province', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('district') ? 'has-error' : ''}}">
    <label for="district" class="control-label">{{ 'District' }}</label>
    <input class="form-control" name="district" type="text" id="district" value="{{ isset($ask_for_help->district) ? $ask_for_help->district : ''}}" >
    {!! $errors->first('district', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('sub_district') ? 'has-error' : ''}}">
    <label for="sub_district" class="control-label">{{ 'Sub District' }}</label>
    <input class="form-control" name="sub_district" type="text" id="sub_district" value="{{ isset($ask_for_help->sub_district) ? $ask_for_help->sub_district : ''}}" >
    {!! $errors->first('sub_district', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
    <label for="address" class="control-label">{{ 'Address' }}</label>
    <input class="form-control" name="address" type="text" id="address" value="{{ isset($ask_for_help->address) ? $ask_for_help->address : ''}}" >
    {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
</div>

 <div class="form-group {{ $errors->has('photo_sos') ? 'has-error' : ''}}">
    <label for="photo_sos" class="control-label">{{ 'Photo Sos' }}</label>
    <input class="form-control" name="photo_sos" type="text" id="photo_sos" value="{{ isset($ask_for_help->photo_sos) ? $ask_for_help->photo_sos : ''}}" >
    {!! $errors->first('photo_sos', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('organization_helper') ? 'has-error' : ''}}">
    <label for="organization_helper" class="control-label">{{ 'Organization Helper' }}</label>
    <input class="form-control" name="organization_helper" type="text" id="organization_helper" value="{{ isset($ask_for_help->organization_helper) ? $ask_for_help->organization_helper : ''}}" >
    {!! $errors->first('organization_helper', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('name_helper') ? 'has-error' : ''}}">
    <label for="name_helper" class="control-label">{{ 'Name Helper' }}</label>
    <input class="form-control" name="name_helper" type="text" id="name_helper" value="{{ isset($ask_for_help->name_helper) ? $ask_for_help->name_helper : ''}}" >
    {!! $errors->first('name_helper', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('help_complete') ? 'has-error' : ''}}">
    <label for="help_complete" class="control-label">{{ 'Help Complete' }}</label>
    <input class="form-control" name="help_complete" type="text" id="help_complete" value="{{ isset($ask_for_help->help_complete) ? $ask_for_help->help_complete : ''}}" >
    {!! $errors->first('help_complete', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('help_complete_time') ? 'has-error' : ''}}">
    <label for="help_complete_time" class="control-label">{{ 'Help Complete Time' }}</label>
    <input class="form-control" name="help_complete_time" type="datetime-local" id="help_complete_time" value="{{ isset($ask_for_help->help_complete_time) ? $ask_for_help->help_complete_time : ''}}" >
    {!! $errors->first('help_complete_time', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('score_impression') ? 'has-error' : ''}}">
    <label for="score_impression" class="control-label">{{ 'Score Impression' }}</label>
    <input class="form-control" name="score_impression" type="number" id="score_impression" value="{{ isset($ask_for_help->score_impression) ? $ask_for_help->score_impression : ''}}" >
    {!! $errors->first('score_impression', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('score_period') ? 'has-error' : ''}}">
    <label for="score_period" class="control-label">{{ 'Score Period' }}</label>
    <input class="form-control" name="score_period" type="number" id="score_period" value="{{ isset($ask_for_help->score_period) ? $ask_for_help->score_period : ''}}" >
    {!! $errors->first('score_period', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('score total') ? 'has-error' : ''}}">
    <label for="score total" class="control-label">{{ 'Score Total' }}</label>
    <input class="form-control" name="score total" type="number" id="score total" value="{{ isset($ask_for_help->score total) ? $ask_for_help->score total : ''}}" >
    {!! $errors->first('score total', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('commemt_help') ? 'has-error' : ''}}">
    <label for="commemt_help" class="control-label">{{ 'Commemt Help' }}</label>
    <input class="form-control" name="commemt_help" type="text" id="commemt_help" value="{{ isset($ask_for_help->commemt_help) ? $ask_for_help->commemt_help : ''}}" >
    {!! $errors->first('commemt_help', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('notify') ? 'has-error' : ''}}">
    <label for="notify" class="control-label">{{ 'Notify' }}</label>
    <input class="form-control" name="notify" type="text" id="notify" value="{{ isset($ask_for_help->notify) ? $ask_for_help->notify : ''}}" >
    {!! $errors->first('notify', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('photo_succeed') ? 'has-error' : ''}}">
    <label for="photo_succeed" class="control-label">{{ 'Photo Succeed' }}</label>
    <input class="form-control" name="photo_succeed" type="text" id="photo_succeed" value="{{ isset($ask_for_help->photo_succeed) ? $ask_for_help->photo_succeed : ''}}" >
    {!! $errors->first('photo_succeed', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('photo_succeed_by') ? 'has-error' : ''}}">
    <label for="photo_succeed_by" class="control-label">{{ 'Photo Succeed By' }}</label>
    <input class="form-control" name="photo_succeed_by" type="text" id="photo_succeed_by" value="{{ isset($ask_for_help->photo_succeed_by) ? $ask_for_help->photo_succeed_by : ''}}" >
    {!! $errors->first('photo_succeed_by', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('remark_helper') ? 'has-error' : ''}}">
    <label for="remark_helper" class="control-label">{{ 'Remark Helper' }}</label>
    <input class="form-control" name="remark_helper" type="text" id="remark_helper" value="{{ isset($ask_for_help->remark_helper) ? $ask_for_help->remark_helper : ''}}" >
    {!! $errors->first('remark_helper', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('time_go_to_help') ? 'has-error' : ''}}">
    <label for="time_go_to_help" class="control-label">{{ 'Time Go To Help' }}</label>
    <input class="form-control" name="time_go_to_help" type="datetime-local" id="time_go_to_help" value="{{ isset($ask_for_help->time_go_to_help) ? $ask_for_help->time_go_to_help : ''}}" >
    {!! $errors->first('time_go_to_help', '<p class="help-block">:message</p>') !!}
</div> --}}
{{-- <div class="form-group {{ $errors->has('helper_id') ? 'has-error' : '' }}">
    <label for="helper_id" class="control-label">{{ 'Helper Id' }}</label>
    <input class="form-control" name="helper_id" type="text" id="helper_id"
        value="{{ isset($ask_for_help->helper_id) ? $ask_for_help->helper_id : '' }}">
    {!! $errors->first('helper_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('user_id') ? 'has-error' : '' }}">
    <label for="user_id" class="control-label">{{ 'User Id' }}</label>
    <input class="form-control" name="user_id" type="text" id="user_id"
        value="{{ isset($ask_for_help->user_id) ? $ask_for_help->user_id : '' }}">
    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('partner_id') ? 'has-error' : '' }}">
    <label for="partner_id" class="control-label">{{ 'Partner Id' }}</label>
    <input class="form-control" name="partner_id" type="text" id="partner_id"
        value="{{ isset($ask_for_help->partner_id) ? $ask_for_help->partner_id : '' }}">
    {!! $errors->first('partner_id', '<p class="help-block">:message</p>') !!}
</div> --}}

<div class="row mt-2">
    <div class="col-3">
        <a href="{{ url('/ask_for_help') }}" title="กลับ">
            <button class="btn btn-warning btn-sm form-control" style="background-color: #21CDC0; font-size: 25px; color: white;">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>กลับ
            </button>
        </a>
    </div>
    <div class="col-6">
        <div class="form-group">
            <input class="btn btn-primary form-control" style="background-color: #3490dc; font-size: 25px; color: white;"
            type="submit" value="{{ $formMode === 'edit' ? 'แก้ไข' : 'ขอความช่วยเหลือ' }}">
        </div>
    </div>
</div>

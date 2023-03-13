<div class="row d-flex justify-content-between">
    <label for="title p-2" class="control-label">{{ 'ประเภท' }}</label>
    <div class="col-6 p-2">
        <label>
        <input class="card-input-element d-none type_appoint_edit" id="type_doc_edit" name="type" type="radio" value="doc" {{ (isset($appoint->type)) ? 'checked' : ''}} onChange="edit_type(value);">
            <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">
                <span style="font-size:16px;">
                    นัดหมอ
                </span>
            </div>
        </label>
    </div>
    <div class="col-6 p-2">
        <label>
        <input class="card-input-element d-none type_appoint_edit" id="type_pill_edit" name="type" type="radio" value="pill" {{ (isset($appoint->type)) ? 'checked' : ''}} onChange="edit_type(value);">
            <div class="card card-body bg-light d-flex flex-row justify-content-between align-items-center">
                <span style="font-size:16px;">
                   ใช้ยา
                </span>
            </div>
        </label>
    </div>
</div>

<div class="row">

    {{-- <div class="form-group {{ $errors->has('type') ? 'has-error' : ''}} col-md-12 col-12">
        <label for="type" class="control-label" style="font-size: 25px;">{{ 'ประเภท' }}</label>
        <select name="type" class="form-control type_edit" id="type" onChange="edit_type();" required>
        <option selected disabled>กรุณาเลือกประเภท</option>
            @foreach (json_decode('{"doc":"นัดหมอ","pill":"ใช้ยา"}', true) as $optionKey => $optionvalue)
                <option value="{{ $optionKey }}" {{ (isset($appoint->type) && $appoint->type == $optionKey) ? 'selected' : ''}}>{{ $optionvalue }}</option>
            @endforeach

        </select>
        {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
    </div> --}}
    <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}} col-md-12 col-12">
        <label for="title" class="control-label">{{ 'เรื่อง' }}</label>
        <input class="form-control title_edit" name="title" type="text" id="title" value="{{ isset($appoint->title) ? $appoint->title : ''}}" required>
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>

    <div id="div_date_edit" class="form-group col-md-6 col-12">
        <label id="label_date" for="date" class="control-label">{{ 'วันที่' }}</label>
        <input class="form-control date_edit" name="date" type="date" id="date_edit" value="{{ isset($appoint->date_time) ? $appoint->date_time : ''}}" required>
    </div>

    <div id="div_datetime_edit" class="form-group col-md-6 col-12 ">
        <label id="label_datetime" for="date_time" class="control-label">{{ 'เวลา' }}</label>
        <input class="form-control date_time_edit" name="date_time" type="time" id="date_time_edit" value="{{ isset($appoint->date_time) ? $appoint->date_time : ''}}" >
    </div>

</div>




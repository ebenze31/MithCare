@extends('layouts.mithcare')
@section('content')
<div class="d-none">
  <div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
        <label for="user_id" class="control-label">{{ 'User Id' }}</label>
        <input class="form-control" name="user_id" type="number" id="user_id" value="{{ $user_id }}" >
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
  </div>
<input class="d-none" type="text" id="CountryCode" name="CountryCode" value="">
<!-- Button trigger modal -->
<button id="btn_modal" type="button" class="btn btn-primary d-none" data-toggle="modal" data-target="#modal">
  Launch static backdrop modal
</button>

<!-- Modal -->
<div class="modal fade" id="modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-body" style="margin:-16.5px;">
        <center>
            <div id="sos_TH" class="d-none">
              <img width="100%" src="{{ asset('/img/logo_mithcare/sticker/thanks.jpg') }}">
            </div>
        </center>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button> -->
        <a id="a_line" href="https://lin.ee/xnFKMfc">
            <button type="button" class="btn btn-success">เสร็จสิ้น</button>
        </a>
      </div>
    </div>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', (event) => {

        document.getElementById("btn_modal").click();

        var delayInMilliseconds = 5000;

        setTimeout(function() {
          document.getElementById("a_line").click();
        }, delayInMilliseconds);
    });

</script>
@endsection

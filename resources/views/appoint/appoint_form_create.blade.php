<div class="row">

    <div class="form-group {{ $errors->has('type') ? 'has-error' : ''}} col-md-12 col-12">
        <label for="type" class="control-label" style="font-size: 25px;">{{ 'นัดหมอ/ทานยา' }}</label>
        <select name="type" class="form-control" id="type" >
        <option selected disabled >กรุณาเลือกประเภทนัดหมาย</option>
            @foreach (json_decode('{"นัดหมอ":"นัดหมอ","ทานยา":"ทานยา"}', true) as $optionKey => $optionvalue)
                <option value="{{ $optionKey }}" {{ (isset($appoint->type) && $appoint->type == $optionKey) ? 'selected' : ''}}>{{ $optionvalue }}</option>
            @endforeach
        </select>
        {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}} col-md-12 col-12">
        <label for="title" class="control-label">{{ 'เรื่อง' }}</label>
        <input class="form-control" name="title" type="text" id="title" value="{{ isset($appoint->title) ? $appoint->title : ''}}" >
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
 
    <div  id="div_datetime" class="form-group {{ $errors->has('date_time') ? 'has-error' : ''}} col-md-12 col-12 ">
        <label id="label_datetime" for="date_time" class="control-label">{{ 'วันที่/เวลา' }}</label>
        <input class="form-control" name="date_time" type="datetime-local" id="date_time"  value="{{ isset($appoint->date_time) ? $appoint->date_time : ''}}" >
        {!! $errors->first('date_time', '<p class="help-block">:message</p>') !!}
    </div>

    <div  id="div_date" class="form-group {{ $errors->has('date') ? 'has-error' : ''}} col-md-12 col-12 ">
        <label id="label_date" for="date" class="control-label">{{ 'วันที่' }}</label>
        <input class="form-control" name="date" type="date" id="date"  value="{{ isset($appoint->date) ? $appoint->date : ''}}" >
        {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
    </div>

    <!-- <div class="form-group {{ $errors->has('date') ? 'has-error' : ''}} col-md-12 col-12">
        <label for="date" class="control-label">{{ 'วันที่' }}</label>
        <input class="form-control" name="date" type="date" id="date" value="{{ isset($appoint->date_time) ? $appoint->date_time : ''}}" >
        {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
    </div>
    -->
</div>

<center>
    <div class="form-group col-12 col-md-6 ">
        <button class="btn btn-primary form-control" style="background-color: #3490dc; font-size: 25px; color: white;" type="submit">สร้าง</button>
    </div>
</center>



<script>
        document.addEventListener('DOMContentLoaded', (event) => {
            document.getElementById('div_datetime').style.display = 'none';    
            document.getElementById('div_date').style.display = 'none'; 
        });

        //ฟังก์ชันเลือก Type ของ input -----select = นัดหมอ->type = date, select = ทานยา->type = datetime
        document.getElementById('type').addEventListener("change", function(e) {
            if (e.target.value === 'นัดหมอ') {

                // document.getElementById('date_time').type = 'date';    
          
                document.getElementById('div_date').style.display = 'block';   
                document.getElementById('div_datetime').style.display = 'none';        

            } else if(e.target.value === 'ทานยา'){        

                // document.getElementById('date_time').type = 'datetime-local'; 
              
                document.getElementById('div_date').style.display = 'none';   
                document.getElementById('div_datetime').style.display = 'block';    

            }else{
        
            }
        });
        
</script>


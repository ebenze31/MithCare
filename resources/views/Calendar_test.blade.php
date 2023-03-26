<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description" content="Medcity - Medical Healthcare HTML5 Template">
    <link href="{{ asset('/img/logo_mithcare/x-icon.png') }}" rel="icon">
    <title>MithCare</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


    <style>
   .header_edit_member {
  background-color: #ffffff;
  padding: 5px;
  border-style: solid;
  border-radius: 25px;
  border-color: #4170A2;

}

.header-line_edit_member {
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
}

.header-name1_edit_member {
  font-size: 16px;
  font-weight: bold;

}

.header-name2_edit_member, .header-name3_edit_member {
  font-size: 16px;
  margin: 0 10px;
  font-weight: bold;
  padding-left: 3px;
}

.header-close_edit_member {
  background-color: transparent;
  /* position: absolute;
  top: 0;
  right: 5px; */
  border-style: solid;
  border-radius: 25px;
  border-color: #4170A2;
  border: none;
  font-size: 16px;
  cursor: pointer;
  float: left;
}

.header-close_edit_member:hover {
  color: red;
}
   /* preloader */
   /* .edit_member-form {
	border:#4170A2;
    border-style: solid;
    border-radius: 25px;
    height: 40px;
    padding: 1.5rem;
    font-size: 100%;
    font-weight: bold;
   }
   .border {
        border: 2px blue dashed;
    }

    .mr-0 {
    margin-right: 0;
    }
    .ml-auto {
    margin-left:auto;
    }
    .d-block {
    display:block;
    } */
    </style>

</head>

<body>
    <div class="header_edit_member">
        <div class="header-line_edit_member">
            <div class="col-9">
                <span class="header-name1_edit_member">ชื่อผู้ป่วย</span>
                <br>
                <span class="header-name1_edit_member">Name 2</span>
            </div>
            <div class="col-3">
                <button class="header-close_edit_member">ยกเลิก</button>
            </div>
        </div>
        <hr class="m-1 p-1">
        <div class="header-line_edit_member">
            <span class="header-name2_edit_member">Name 2</span>
            <span class="header-name2_edit_member">=></span>
            <span class="header-name3_edit_member">Name 3</span>

        </div>
    </div>

    {{-- <div class="edit_member-form">patient <hr style=""> member1 => member 2<span class="d-block mr-0 ml-auto">ยกเลิก</span></div> --}}
</body>

</html>


<script>
    // $("#profile-pic").click(function(e) {
    //     $("#fileToUpload").click();
    // });

    // function fasterPreview(uploader) {
    //     if (uploader.files && uploader.files[0]) {
    //         $('#profile-pic').attr('src',
    //             window.URL.createObjectURL(uploader.files[0]));
    //     }
    // }

    // $("#fileToUpload").change(function() {
    //     fasterPreview(this);
    // });




    $("#profileImage").click(function(e) {
        $("#imageUpload").click();
    });

    function fasterPreview(uploader) {
        if (uploader.files && uploader.files[0]) {
            $('#profileImage').attr('src',
                window.URL.createObjectURL(uploader.files[0]));
        }
    }

    $("#imageUpload").change(function() {
        fasterPreview(this);
    });
</script>

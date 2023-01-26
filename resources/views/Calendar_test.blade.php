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
        #imageUpload {
            display: none;
        }

        #profileImage {
            cursor: pointer;
        }

        #profile-container {
            width: 150px;
            height: 150px;
            overflow: hidden;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            -ms-border-radius: 50%;
            -o-border-radius: 50%;
            border-radius: 50%;
        }

        #profile-container img {
            width: 150px;
            height: 150px;
        }
    </style>

</head>

<body>


    <div id="profile-container">
        <img id="profileImage" src="http://lorempixel.com/100/100" />
    </div>
    <input id="imageUpload" type="file" name="profile_photo" placeholder="Photo" required="" capture>

    {{-- <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="fileToUpload">
            <div class="profile-pic" id="profile-pic"
                style="background-image: url('https://randomuser.me/api/portraits/med/men/65.jpg')">
                <span class="glyphicon glyphicon-camera"></span>
                <span>Change Image</span>
            </div>
        </label>
        <input type="File" name="fileToUpload" id="fileToUpload">
    </form> --}}

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

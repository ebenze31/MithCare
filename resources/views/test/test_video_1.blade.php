@extends('layouts.mithcare_topbar')

@section('content')
<link href="{{ asset('mithcare/css/animation_for_videoCall.css') }}" rel="stylesheet">

<div id="maindeiv"></div>

<script>
    const loadingAnime =
                            '<div class="overlay-loader">'+
                                '<div class="loader">'
                                    '<div></div>' +
                                    '<div></div>' +
                                    '<div></div>' +
                                    '<div></div>' +
                                    '<div></div>' +
                                    '<div></div>' +
                                    '<div></div>' +
                                '</div>' +
                            '</div>';

                            const mainVideoDiv = document.getElementById('maindeiv');
                            mainVideoDiv.innerHTML = loadingAnime;
</script>
@endsection

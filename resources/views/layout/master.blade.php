<!DOCTYPE html>
<html>
<head>
  <title>JakTech - VAS</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- CSRF Token -->
  <meta name="_token" content="{{ csrf_token() }}">
  
  <link rel="shortcut icon" href="{{ asset('/favicon.jpg') }}">

  <!-- plugin css -->
  {!! Html::style('assets/plugins/@mdi/font/css/materialdesignicons.min.css') !!}
  {!! Html::style('assets/plugins/perfect-scrollbar/perfect-scrollbar.css') !!}
  <!-- end plugin css -->

  @stack('plugin-styles')

  <!-- common css -->
  {!! Html::style('css/app.css') !!}
  <!-- end common css -->

  @stack('style')
  {{-- style for every ajax calls --}}
    <style>
        #loading-overlay {
        position: fixed;
        width: 100%;
        height:100%;
        left: 0;
        top: 0;
        display: none;
        align-items: center;
        background-color: #000;
        z-index: 999;
        opacity: 0.5;
        }
        .loading-icon{ position:absolute;border-top:2px solid rgb(240, 0, 200);border-right:2px solid #fff;border-bottom:2px solid #fff;border-left:2px solid #767676;border-radius:25px;width:25px;height:25px;margin:0 auto;position:absolute;left:50%;margin-left:-13px;top:50%;margin-top:-12px;z-index:4;-webkit-animation:spin 1s linear infinite;-moz-animation:spin 1s linear infinite;animation:spin 1s linear infinite;}
        @-moz-keyframes spin { 100% { -moz-transform: rotate(360deg); } }
        @-webkit-keyframes spin { 100% { -webkit-transform: rotate(360deg); } }
        @keyframes spin { 100% { -webkit-transform: rotate(360deg); transform:rotate(360deg); } }  
    </style>
    <!-- style for the style of scrollbar on the sidemenu -->
    <style>
  
        .sidebar::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
            border-radius: 0px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            border-radius: 50px;
            /* background:#cce6ff; */
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
        }
        @media only screen and (max-width: 991px) {
          .main-panel {
            margin-left:0px;
          }
        }
        @media only screen and (min-width: 991px) {
          .main-panel {
            margin-left:255px;
          }
        }
    </style>
</head>
<body data-base-url="{{url('/')}}">

  <div class="container-scroller" id="app">
    @include('layout.header')
    <div class="container-fluid page-body-wrapper">
      @include('layout.sidebar')
      <div class="main-panel">
        <!-- below div hold page loader gif -->
        <div class="se-pre-con"></div>
        {{-- loader for every ajax requests --}}
        <div id="loading-overlay">
            <div style="border-radius:4px; width:10%;height:5%;background-color:white; top:47%;left:45%;position: absolute;">
                <div class="loading-icon"></div>
            </div>
        </div>
        @include('/modals/createRecord')
        <div class="content-wrapper" id="odda">
          @yield('content')
        </div>
        @include('layout.footer')
      </div>
    </div>
  </div>

  <!-- base js -->
  {!! Html::script('js/app.js') !!}
  {!! Html::script('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') !!}
  <!-- end base js -->

  <!-- plugin js -->
  @stack('plugin-scripts')
  <!-- end plugin js -->

  <!-- common js -->
  {!! Html::script('assets/js/off-canvas.js') !!}
  {!! Html::script('assets/js/hoverable-collapse.js') !!}
  {!! Html::script('assets/js/misc.js') !!}
  {!! Html::script('assets/js/settings.js') !!}
  {!! Html::script('assets/js/todolist.js') !!}
  <!-- end common js -->

  @stack('custom-scripts')
  @yield('js')



</body>
</html>
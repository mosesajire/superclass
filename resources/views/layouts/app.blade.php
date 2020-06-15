<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="SuperClass is a digital learning platform for secondary school students to enrol in free online lessons created by excellent educators.">

    <title> @yield('title') @if(isset($title)) {{$title}} @endif @if(Auth::user()) {{ " | " . Auth::user()->first_name . " " . Auth::user()->last_name }}  @endif</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>

<body id="app-layout">
    <!-- Navigation -->
    @include('includes.nav')


    <div class="container main-container">

      @if(Auth::user())

        <div class="row">
          <div class="col-lg-12">
              <h3 class="alert alert-info">You are currently logged in, {{Auth::user()->first_name}}.</h3>
          </div>
        </div>

      @endif

      <!-- Notification messages -->
       @include('includes.messages')

      <!-- Contents -->
       @yield('content')

    </div>

    <!-- Footer -->
    @include('includes.footer')

     <!-- Javascript files -->
   <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>

   <script src="{{ asset('js/bootstrap.min.js') }}"></script>

   <script src="{{ asset('js/app.js') }}"></script>

  @if(Auth::user())
    <!-- Include these files if user is registered -->
   <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
   <script>
        CKEDITOR.replace( 'article-ckeditor' );
   </script>

  @endif
</body>
</html>

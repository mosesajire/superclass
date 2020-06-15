<nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    SuperClass
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> Home</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}"><i class="fa fa-sign-in"></i> Login</a></li>
                       <li><a href="{{ url('/register') }}"><i class="fa fa-user"></i> Register</a></li>
                    @else

                        @if(Auth::user()->role_id == 1)
                        {{-- For registered user --}}
                        <li><a href="{{ url('/user/dashboard') }}"> <i class="fa fa-btn fa-user-circle"></i> Dashboard</a></li>
                        @endif

                        {{-- For admin user --}}
                        @if(Auth::user()->role_id == 2)
                        <li><a href="{{ url('/admin/dashboard') }}"> <i class="fa fa-btn fa-user-circle"></i> Dashboard</a></li>
                        @endif

                        <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i> Logout</a></li>

                    @endif
                </ul>
            </div>
        </div>
    </nav>
<div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
    <div class="app-header header-shadow">
        <div class="app-header__logo">
            {{-- <div class="logo-src">
            </div> --}}
            <h2>QCW Portal</h2>
            <div class="header__pane ml-auto">
                <div>
                    <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
        <div class="app-header__mobile-menu">
            <div>
                <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
        <div class="app-header__menu">
            <span>
                <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                    <span class="btn-icon-wrapper">
                        <i class="fa fa-ellipsis-v fa-w-6"></i>
                    </span>
                </button>
            </span>
        </div>
        <div class="app-header__content">
            <div class="app-header-left">
                {{-- <h4 class=" text-white">{{auth()->user()->name}}&nbsp; | &nbsp; {{ucfirst(auth()->user()->role_names).' Dashboard' }}</h4> --}}
            </div>
            <div class="app-header-right">
                <h4 class=" text-white">{{auth()->user()->email}}&nbsp;  | &nbsp; {{auth()->user()->phone}}</h4>
                <div class="header-btn-lg pr-0">
                    <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left">
                                <div class="btn-group">
                                    <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn text-white">
                                        <img width="42" class="rounded-circle" src="{{asset('images/logo.png')}}" alt="">
                                        <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                        {{ Auth::user()->name }}
                                    </a>
                                    <div tabindex="-1" id="dropdown" role="menu" aria-hidden="true" class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-menu-header">
                                            <div class="dropdown-menu-header-inner bg-info">
                                                <div class="menu-header-image opacity-2" style="background-image: url('/admin_assets/images/dropdown-header/city3.jpg');">
                                                </div>
                                                <div class="menu-header-content text-left">
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            {{-- <div class="widget-content-left mr-3">
                                                                <img width="42" class="rounded-circle" src="{{asset('images/logo.png')}}" alt="">
                                                            </div> --}}
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">{{Auth::user()->name}}</div>
                                                                <div class="widget-subheading opacity-8">
                                                                </div>
                                                            </div>
                                                            <div class="widget-content-right mr-2">
                                                                <form action="{{url('/logout')}}" method="post" accept-charset="utf-8">
                                                                    @csrf
                                                                    <button type="submit" class="btn-pill btn-shadow btn-shine btn btn-focus">Logout
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a class="dropdown-item" href="{{ url('user/profile') }}">
                                            <i class="fa fa-user mr-5"></i> Profile
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="app-main">
        <div class="app-sidebar sidebar-shadow">
            <div class="app-header__logo">
                <div class="logo-src"></div>
                <div class="header__pane ml-auto">
                </div>
            </div>
            <div class="app-header__mobile-menu">
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>
            <div class="scrollbar-sidebar">
                <div class="app-sidebar__inner">
                   @role('admin')
                       @include('admin.partial.menu')
                    @endrole
                      @role('subadmin')
                       @include('subadmin.partial.menu')
                    @endrole
                     @role('school')
                       @include('school.partial.menu')
                    @endrole

                     @role('teacher')
                       @include('teacher.partial.menu')
                    @endrole

                     @role('student')
                       @include('student.partial.menu')
                    @endrole
                      @role('deputy_admin')
                       @include('deputy_admin.partial.menu')
                    @endrole
                </div>
            </div>
        </div>
        <div class="app-main__outer">
            <div class="app-main__inner">
                @if (Session::has('flash_message'))
                <div class="container">
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ Session::get('flash_message') }}
                    </div>
                </div>
                @endif
                @if (Session::has('error'))
                <div class="container">
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ Session::get('error') }}
                    </div>
                </div>
                @endif
                {{-- @yield('content') --}}


                @if (isset($header))
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Page Content -->
                <main>
                        @yield('content')
                  {{--    @if(!$slot)
                    @endif
                    {{ $slot }} --}}
                </main>


            </div>
        </div>
    </div>
</div>

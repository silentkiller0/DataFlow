<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow" style="border-radius:30px">
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                        <ul class="nav navbar-nav">
                            <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon feather icon-menu"></i></a></li>
                        </ul>
                    </div>
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-us"></i><span class="selected-language">English</span></a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-flag">
                                <a class="dropdown-item" href="#" data-language="fr"><i class="flag-icon flag-icon-fr"></i> French</a>
                                <a class="dropdown-item" href="#" data-language="en"><i class="flag-icon flag-icon-us"></i> English</a>
                                <a class="dropdown-item" href="#" data-language="es"><i class="flag-icon flag-icon-es"></i> Spanish</a>
                                <a class="dropdown-item" href="#" data-language="ar"><i class="flag-icon flag-icon-ae"></i> Arabic</a>
                            </div>
                        </li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon feather icon-maximize"></i></a></li>

                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="user-nav d-sm-flex d-none"><span class="user-name text-bold-600">{{Auth::user()->lastname.' '.Auth::user()->firstname}}</span><span class="user-status">{{Auth::user()->username}}</span></div><span><img class="round" src="../../../app-assets/images/Dataflow_profile.png" alt="avatar" height="40" width="40"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="/profile" class="dropdown-item"><i class="feather icon-user"></i>Profile</a>
                                <div class="dropdown-divider"></div>
                                <form class="dropdown-item" method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <i class="feather icon-power"></i>
                                    <a href="route('logout')" style=":hover {color: white}" onclick="event.preventDefault(); this.closest('form').submit();"> Logout</a>
                                </form>
                            </div>    
                                
                                
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar animated slideInLeft">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="user-pro"> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><img src="{{ asset('assets/images/users/1.jpg') }}" alt="user-img" class="img-circle"><span class="hide-menu">{{ Auth::user()->firstname .'&nbsp;'. Auth::user()->lastname }}</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ url('/profile') }}"><i class="ti-user"></i> My Profile</a></li>
                        <li><a href="javascript:void(0)"><i class="ti-settings"></i> Account Setting</a></li>
                        <li><a href="{{ route('logout') }}" class="text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-power-off"></i> Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
                <li class="nav-small-cap">--- MENU</li>
                <li>
                    <a class="waves-effect waves-dark" href="{{ url('/empres') }}" aria-expanded="false"><i class="icon-grid"></i><span class="hide-menu">Dashboard </span></a>
                </li>
                <li> 
                    <a class="waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="icon-trophy"></i><span class="hide-menu">Individual Performance </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ url('/morss/survey')}}">Create IPC </a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
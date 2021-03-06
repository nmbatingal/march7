<div class="navbar-collapse">
    <!-- ============================================================== -->
    <!-- toggle and nav items -->
    <!-- ============================================================== -->
    <ul class="navbar-nav mr-auto">
        <!-- This is  -->
        <li class="nav-item"> <a class="nav-link nav-toggler d-block d-sm-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
        <li class="nav-item"> <a class="nav-link sidebartoggler d-none waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
        <!-- ============================================================== -->
        <!-- Search -->
        <!-- ============================================================== -->
        <li class="nav-item">
            <!-- <form class="app-search d-none d-md-block d-lg-block">
                <input type="text" class="form-control" placeholder="Search & enter">
            </form> -->
        </li>
    </ul>
    <!-- ============================================================== -->
    <!-- User profile and search -->
    <!-- ============================================================== -->
    <ul class="navbar-nav my-lg-0">
        <!-- ============================================================== -->
        <!-- mega menu -->
        <!-- ============================================================== -->
        <li class="nav-item dropdown mega-dropdown"> 
            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ti-layout-grid2" data-toggle="tooltip" title="Apps"></i>
            </a>
            <div id="miniapps" class="dropdown-menu animated">
                <div class="row el-element-overlay">
                    <div class="col-md-12">
                        <!-- <h4 class="card-title">DOST13 Apps</h4> -->
                        <h6 class="card-subtitle m-b-20 text-muted">Continue using the system by clicking an app below or return to <a href="{{ url('/home') }}">home page</a>.</h6> 
                    </div>
                    @include('layouts.home.miniapps')
                </div>
            </div>
        </li>
        <!-- ============================================================== -->
        <!-- End mega menu -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Messages -->
        <!-- ============================================================== -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="icon-bubble" data-toggle="tooltip" title="Messages"></i>
                <!-- <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div> -->
            </a>
            <div class="dropdown-menu mailbox dropdown-menu-right animated" aria-labelledby="2">
                <ul>
                    <li>
                        <div class="drop-title">You have 4 new messages</div>
                    </li>
                    <li>
                        <div class="message-center">
                            <!-- Message -->
                            <a href="javascript:void(0)">
                                <div class="user-img"> <img src="{{ asset('assets/images/users/1.jpg') }}" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                                <div class="mail-contnet">
                                    <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:30 AM</span> </div>
                            </a>
                            <!-- Message -->
                            <a href="javascript:void(0)">
                                <div class="user-img"> <img src="{{ asset('assets/images/users/2.jpg') }}" alt="user" class="img-circle"> <span class="profile-status busy pull-right"></span> </div>
                                <div class="mail-contnet">
                                    <h5>Sonu Nigam</h5> <span class="mail-desc">I've sung a song! See you at</span> <span class="time">9:10 AM</span> </div>
                            </a>
                            <!-- Message -->
                            <a href="javascript:void(0)">
                                <div class="user-img"> <img src="{{ asset('assets/images/users/3.jpg') }}" alt="user" class="img-circle"> <span class="profile-status away pull-right"></span> </div>
                                <div class="mail-contnet">
                                    <h5>Arijit Sinh</h5> <span class="mail-desc">I am a singer!</span> <span class="time">9:08 AM</span> </div>
                            </a>
                            <!-- Message -->
                            <a href="javascript:void(0)">
                                <div class="user-img"> <img src="{{ asset('assets/images/users/4.jpg') }}" alt="user" class="img-circle"> <span class="profile-status offline pull-right"></span> </div>
                                <div class="mail-contnet">
                                    <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                            </a>
                        </div>
                    </li>
                    <li>
                        <a class="nav-link text-center link" href="javascript:void(0);"> <strong>See all e-Mails</strong> <i class="fa fa-angle-right"></i> </a>
                    </li>
                </ul>
            </div>
        </li>
        <!-- ============================================================== -->
        <!-- End Messages -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Notification -->
        <!-- ============================================================== -->
        <li class="nav-item dropdown">
            <a id="notifications" class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ti-bell" data-toggle="tooltip" title="Notifications"></i>

                @if ( auth()->user()->unreadNotifications->count() > 0 )
                    <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                @endif

            </a>
            <div class="dropdown-menu dropdown-menu-right mailbox animated">
                <ul>
                    <li>
                        <div class="drop-title">Notifications 
                            @if ( auth()->user()->unreadNotifications->count() > 0 )
                                <span class="badge badge-danger">
                                    {{ auth()->user()->unreadNotifications->count() }} unread 
                                    @if ( auth()->user()->unreadNotifications->count() == 1 )
                                        notification
                                    @else
                                        notifications
                                    @endif
                                </span>

                            @endif
                        </div>
                    </li>
                    <li>
                        <div class="message-center">
                            <!-- Message -->
                            @foreach ( auth()->user()->notifications()->take(10)->get() as $notification )

                                <a href="{{ url('/notification/read/'.$notification->id) }}"
                                    class="waves-effect waves-light {{ !empty($notification->read_at) ? '' : 'bg-info' }}">
                                    <div class="user-img"> 
                                        <img src="{{ asset($notification->data['_img']) }}" alt="user" class="img-circle"> 
                                        <!-- <span class="profile-status away pull-right"></span>  -->
                                    </div>
                                    <div class="mail-contnet">
                                        <h5>{{ $notification->data['name'] }}</h5> <span class="mail-desc">{{ $notification->data['data'] }}</span>
                                        <span class="time">
                                            {{ $notification->created_at->diffInMonths(Carbon\Carbon::now()) >= 1 ? $notification->created_at->format('j M Y , g:ia') : $notification->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </a>

                            @endforeach
                        </div>
                    </li>
                    <li>
                        <a class="nav-link text-center link" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                    </li>
                </ul>
            </div>
        </li>
        <!-- ============================================================== -->
        <!-- End Notification -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- User Profile -->
        <!-- ============================================================== -->
        <li class="nav-item dropdown u-pro">
            <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ asset(Auth::user()->_img) }}" alt="user" class=""> <span class="hidden-md-down">{{ Auth::user()->firstname }} &nbsp;<i class="fa fa-angle-down"></i></span> </a>
            <div class="dropdown-menu dropdown-menu-right animated">
                <!-- text-->
                <a href="{{ url('/accounts/profile/'. Auth::user()->id ) }}" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                <!-- text-->
                <div class="dropdown-divider"></div>
                <!-- text-->
                <a href="{{ url( '/logs/'.Auth::user()->id ) }}" class="dropdown-item"><i class="ti-list"></i> Activity Log</a>
                <!-- text-->
                <div class="dropdown-divider"></div>
                <!-- text-->
                <a href="{{ route('logout') }}" class="dropdown-item text-danger"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    <i class="fa fa-power-off"></i> Logout
                </a>
                <!-- text-->
            </div>
        </li>
        <!-- ============================================================== -->
        <!-- End User Profile -->
        <!-- ============================================================== -->
        <li class="nav-item right-side-toggle"> <a class="nav-link  waves-effect waves-light" href="javascript:void(0)"><i class="ti-settings"></i></a></li>
    </ul>
</div>
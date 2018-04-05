<nav class="navbar top-navbar navbar-expand-md navbar-dark">
    <!-- ============================================================== -->
    <!-- Logo -->
    <!-- ============================================================== -->
    <div class="navbar-header custom-hide">
        <a class="navbar-brand" href="{{ url('/hrmis') }}">
            <!-- Logo icon -->
            <b>
                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                <!-- Dark Logo icon -->
                <!-- <img src="{{ asset('assets/images/logo-icon.png') }}" alt="homepage" class="dark-logo" /> -->
                <!-- Light Logo icon -->
                <!-- <img src="{{ asset('assets/images/logo-light-icon.png') }}" alt="homepage" class="light-logo" /> -->
            </b>
            <!--End Logo icon -->
            <!-- Logo text -->
            <span>
                <img src="{{ asset('img/logo-dost.png') }}" class="light-logo" alt="homepage" />
                DOST13 <strong>HRMIS</strong>
                <!-- dark Logo text -->
                <!-- <img src="{{ asset('assets/images/logo-text.png') }}" alt="homepage" class="dark-logo" /> -->
                <!-- Light Logo text -->    
                <!-- <img src="{{ asset('assets/images/logo-light-text.png') }}" class="light-logo" alt="homepage" /> -->
            </span> 
        </a>
    </div>
    <!-- ============================================================== -->
    <!-- End Logo -->
    <!-- ============================================================== -->
    @include('layouts.home.notification')
</nav>
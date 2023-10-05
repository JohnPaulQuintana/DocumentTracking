<div class="navbar-header">
    <div class="d-flex">

        <!-- LOGO -->
        <div class="navbar-brand-box">
            <a href="index.html" class="logo logo-dark">
                <span class="logo-sm">
                    <img src="{{ asset('images/logo/logo.png') }}" alt="logo-sm" height="50">
                </span>
                <span class="logo-lg">
                    <img src="{{ asset('images/logo/logo.png') }}" alt="logo-dark" height="50">
                </span>
            </a>

            <a href="index.html" class="logo logo-light">
                <span class="logo-sm">
                    <img src="{{ asset('images/logo/logo.png') }}" alt="logo-sm-light" height="50">
                </span>
                <span class="logo-lg">
                    <img src="{{ asset('images/logo/logo.png') }}" alt="logo-light" height="50">
                    <span class="text-white"><b>Document Tracking</b></span>
                </span>
            </a>
        </div>

        <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
            <i class="ri-menu-2-line align-middle"></i>
        </button>

    </div>

    <div class="d-flex">

        <div class="dropdown d-inline-block">
            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                  data-bs-toggle="dropdown" aria-expanded="false">
                <i class="ri-notification-3-line"></i>
                <span class="noti-dot"></span>
            </button>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                aria-labelledby="page-header-notifications-dropdown">

                <div class="p-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="m-0"> Notifications </h6>
                        </div>
                        <div class="col-auto">
                            <a href="#!" class="small"> View All</a>
                        </div>
                    </div>
                </div>

                <div data-simplebar style="max-height: 230px;" class="notif-container">
                    
                    {{-- <a href="" class="text-reset notification-item">
                        <div class="d-flex">
                            <img src="{{ asset('assets/images/users/avatar-3.jpg') }}"
                                class="me-3 rounded-circle avatar-xs" alt="user-pic">
                            <div class="flex-1">
                                <h6 class="mb-1">James Lemire</h6>
                                <div class="font-size-12 text-muted">
                                    <p class="mb-1">It will seem like simplified English.</p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                </div>
                            </div>
                        </div>
                    </a> --}}

                    <a href="" class="text-reset notification-item">
                        <div class="d-flex">
                            <div class="avatar-xs me-3">
                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                    <i class="ri-checkbox-circle-line"></i>
                                </span>
                            </div>
                            <div class="flex-1">
                                <h6 class="mb-1">Your item is shipped</h6>
                                <div class="font-size-12 text-muted">
                                    <p class="mb-1">If several languages coalesce the grammar</p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                </div>
                            </div>
                        </div>
                    </a>

                </div>

                <div class="p-2 border-top">
                    <div class="d-grid">
                        <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                            {{-- <i class="mdi mdi-arrow-right-circle me-1"></i> View More.. --}}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="dropdown d-inline-block user-dropdown">
            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="rounded-circle header-profile-user" src="{{ asset('assets/images/users/default-admin.png') }}"
                    alt="Header Avatar">
                <span class="d-none d-xl-inline-block ms-1">{{ Auth::user()->name }}</span>
                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <!-- item-->
                <a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="ri-user-line align-middle me-1"></i> Profile</a>
                <div class="dropdown-divider"></div>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="dropdown-item text-danger" :href="route('logout')" onclick="event.preventDefault();this.closest('form').submit();">
                        <i class="ri-shut-down-line align-middle me-1 text-danger"></i> 
                        {{ __('Logout') }}
                    </a>
                </form>
            </div>
        </div>

        {{-- <div class="dropdown d-inline-block">
            <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                <i class="ri-settings-2-line"></i>
            </button>
        </div> --}}

    </div>
</div>
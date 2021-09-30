<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
       id="sidenav-main">

    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
           aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0"
           @unless(request()->routeIs('account')) href="{{ route('account') }}" @endunless >
            <span id="auth" data-auth="{{ Auth::user()->id }}" data-role="{{ $userRole }}"
                  class="ms-1 font-weight-bold">Welcome, {{ Auth::user()->name }}</span>
        </a>
    </div>

    <hr class="horizontal dark mt-0">

    <div class="collapse navbar-collapse  w-auto  max-height-vh-100 h-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link @if(request()->routeIs('customer')) active @endif"--}}
{{--                   href="{{ route('customer') }}">--}}
{{--                    <div--}}
{{--                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">--}}
{{--                        <i class="fa fa-table opacity-10 text-primary"></i>--}}
{{--                    </div>--}}
{{--                    <span class="nav-link-text ms-1">Dashboard</span>--}}
{{--                </a>--}}
{{--            </li>--}}

            @if ($userRole === 'ROLE_CUSTOMER')
                <li class="nav-item">
                    <router-link :to="{name: 'my-tickets'}" class="nav-link">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-table opacity-10 text-primary"></i>
                        </div>
                        <span class="nav-link-text ms-1">My tickets</span>
                    </router-link>
                </li>
            @endif

            @if ($userRole === 'ROLE_ADMIN' | $userRole === 'ROLE_SUPER_ADMIN')
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Tickets</h6>
                    <hr class="horizontal dark mt-0">
                </li>

                <li class="nav-item">
                    <router-link :to="{name: 'admin.tickets'}" class="nav-link">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-clipboard-list opacity-10 text-primary"></i>
                        </div>
                        <span class="nav-link-text ms-1">Tickets</span>
                    </router-link>
                </li>

                <li class="nav-item">
                    <router-link :to="{name: 'admin.ticket-types'}" class="nav-link">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-clipboard-list opacity-10 text-primary"></i>
                        </div>
                        <span class="nav-link-text ms-1">Ticket types</span>
                    </router-link>
                </li>

                <li class="nav-item">
                    <router-link :to="{name: 'admin.ticket-status'}" class="nav-link">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-clipboard-list opacity-10 text-primary"></i>
                        </div>
                        <span class="nav-link-text ms-1">Ticket status</span>
                    </router-link>
                </li>

                <li class="nav-item">
                    <router-link :to="{name: 'admin.ticket-priority'}" class="nav-link">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-clipboard-list opacity-10 text-primary"></i>
                        </div>
                        <span class="nav-link-text ms-1">Ticket priority</span>
                    </router-link>
                </li>

                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Users</h6>
                    <hr class="horizontal dark mt-0">
                </li>

                <li class="nav-item">
                    <router-link :to="{name: 'admin.users'}" class="nav-link">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-users opacity-10 text-primary"></i>
                        </div>
                        <span class="nav-link-text ms-1">Users</span>
                    </router-link>
                </li>

                <li class="nav-item">
                    <router-link :to="{name: 'admin.roles'}" class="nav-link">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-users opacity-10 text-primary"></i>
                        </div>
                        <span class="nav-link-text ms-1">User roles</span>
                    </router-link>
                </li>

                <li class="nav-item">
                    <router-link :to="{name: 'admin.teams'}" class="nav-link">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-users opacity-10 text-primary"></i>
                        </div>
                        <span class="nav-link-text ms-1">Teams</span>
                    </router-link>
                </li>
            @endif

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account</h6>
                <hr class="horizontal dark mt-0">
            </li>

            <li class="nav-item">
                <router-link :to="{name: 'profile'}" class="nav-link">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-table opacity-10 text-primary"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </router-link>
            </li>

{{--            <li class="nav-item">--}}
{{--                <a class="nav-link  " href="#">--}}
{{--                    <div--}}
{{--                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">--}}
{{--                        <i class="fa fa-table opacity-10 text-primary"></i>--}}
{{--                    </div>--}}
{{--                    <span class="nav-link-text ms-1">Settings</span>--}}
{{--                </a>--}}
{{--            </li>--}}
        </ul>
    </div>

</aside>

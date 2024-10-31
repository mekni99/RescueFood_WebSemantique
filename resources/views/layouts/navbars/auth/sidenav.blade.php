

<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand " href="{{ route('home') }}" target="_blank">
    <img src="{{ asset('img/logo22.png') }}" style="height: 100px; width: auto;" alt="main_logo">
</a>


    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}" href="{{ route('home') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'profile' ? 'active' : '' }}" href="{{ route('profile') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
            <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}" href="{{ route('users.index') }}">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-bullet-list-67 text-dark text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">User Management</span>
    </a>
</li>


            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'transports') ? 'active' : '' }}" href="{{ route('transports.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <span style="font-size: 1.2em;">🚚</span>
                    </div>
                    <span class="nav-link-text ms-1">Transport</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'deliveries') ? 'active' : '' }}" href="{{ route('deliveries.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <span style="font-size: 1.2em;">🚀</span>
                    </div>
                    <span class="nav-link-text ms-1">Deliveries</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'restaurants') ? 'active' : '' }}" href="{{ route('restaurants.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <span style="font-size: 1.2em;">🍽️</span>
                    </div>
                    <span class="nav-link-text ms-1">Restaurants</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'recommendations') ? 'active' : '' }}" href="{{ route('recommendations.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <span style="font-size: 1.2em;">⭐</span>
                    </div>
                    <span class="nav-link-text ms-1">Recommendations</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'stock') ? 'active' : '' }}" href="{{ route('stock.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <span style="font-size: 1.5em;">📦</span> <!-- Emoji box -->
                    </div>
                    <span class="nav-link-text ms-1">Stock</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'associations') ? 'active' : '' }}" href="{{ route('associations.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <span style="font-size: 1.5em;">🤝</span> <!-- Emoji handshake -->
                    </div>
                    <span class="nav-link-text ms-1">Associations</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'requests') ? 'active' : '' }}" href="{{ route('requests.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <span style="font-size: 1.5em;">📩</span> <!-- Emoji envelope -->
                    </div>
                    <span class="nav-link-text ms-1">Requests</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'destinataires') ? 'active' : '' }}" href="{{ route('destinataire.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <span style="font-size: 1.5em;">📬</span> <!-- New Emoji for Destinataire -->
                    </div>
                    <span class="nav-link-text ms-1">Destinataire</span>
                </a>
            </li>
            
            
        </ul>
    </div>
</aside>

<header class="pc-header">
  <div class="header-wrapper">
    <!-- [Mobile Media Block] start -->
    <div class="me-auto pc-mob-drp">
      <ul class="list-unstyled">
        <li class="pc-h-item header-mobile-collapse">
          <a href="#" class="pc-head-link head-link-secondary ms-0" id="sidebar-hide">
            <i class="ti ti-menu-2"></i>
          </a>
        </li>
        <li class="pc-h-item pc-sidebar-popup">
          <a href="#" class="pc-head-link head-link-secondary ms-0" id="mobile-collapse">
            <i class="ti ti-menu-2"></i>
          </a>
        </li>
      </ul>
    </div>
    <div class="ms-auto">
      <ul class="list-unstyled">
        <li class="dropdown pc-h-item header-user-profile">
          <a class="pc-head-link head-link-primary dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
            <img src="{{ asset('storage/' . $user->foto) }}" alt="Foto" class=" rounded-circle me-0 me-sm-2" style="width: 30px; height: 30px; object-fit: cover;">
            <span>
              <i class="ti ti-settings"></i>
            </span>
          </a>
          <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
            <div class="dropdown-header">
              <h2>{{ $user->name }}</h4>
                <p class="text-muted"><b> {{ __('messages.role') }} :</b>
                  {{ $user->role->nama_role }}
                  <hr>
                  <div class="profile-notification-scroll position-relative" style="max-height: calc(100vh - 280px)">
                    <a href="{{ route('profile') }}" class="dropdown-item">
                      <i class="ti ti-user"></i>
                      <span> {{ __('messages.profile') }}</span>
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                      @csrf
                      <button type="submit" class="dropdown-item">
                        <i class="ti ti-logout"></i>
                        <span> {{ __('messages.logout') }}</span>
                      </button>
                    </form>
                  </div>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>


</header>

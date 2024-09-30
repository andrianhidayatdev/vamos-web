<!-- [ Pre-loader ] start -->
<div class="loader-bg">
  <div class="loader-track">
    <div class="loader-fill"></div>
  </div>
</div>
<!-- [ Pre-loader ] End -->
<!-- [ Sidebar Menu ] start -->
<nav class="pc-sidebar">
  <div class="navbar-wrapper">
    <div class="m-header">
      <a href="{{ route('home.index')}}" class="b-brand text-primary">
        <!-- ========   Change your logo from here   ============ -->
        <div class="d-flex align-items-center">
          @if ($user && $user->cabang && $user->cabang->setting && $user->cabang->setting->logo)
          <img src="{{ asset('storage/' . $user->cabang->setting->logo) }}" alt="Logo" width="35px" height="35px" class="rounded">
          @else
          <div style="width: 35px; height: 35px; border: 2px solid #000; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
            <span style="color: #000;">?</span>
          </div>
          @endif
          <h3 class="mb-0 ms-2">{{ $user->cabang->nama_cabang }}</h3>
        </div>
      </a>
    </div>
    <div class="navbar-content">
      <ul class="pc-navbar">
        <li class="pc-item">
          <a href="/" class="pc-link"><span class="pc-micon"><i class="ti ti ti-layout-grid"></i></span><span class="pc-mtext">{{ __('messages.dashboard') }}</span></a>
        </li>
        <li class="pc-item pc-caption ">
          <label>{{ __('messages.master') }}</label>
          <i class="ti ti-apps"></i>
        </li>
        <li class="pc-item">
          <a href="{{ route('master.kategori.index') }}" class="pc-link">
            <span class="pc-micon"><i class="ti ti-stack"></i></span>
            <span class="pc-mtext">{{ __('messages.categories') }}</span>
          </a>
        </li>
        <li class="pc-item">
          <a href="{{ route('master.produk.index') }}" class="pc-link">
            <span class="pc-micon"><i class="ti ti-box"></i></span>
            <span class="pc-mtext">{{ __('messages.products') }}</span>
          </a>
        </li>
        <li class="pc-item">
          <a href="{{ route('master.member.index') }}" class="pc-link">
            <span class="pc-micon"><i class="ti ti-credit-card"></i></span>
            <span class="pc-mtext">{{ __('messages.members') }}</span>
          </a>
        </li>
        <li class="pc-item">
          <a href="{{ route('master.supplier.index') }}" class="pc-link">
            <span class="pc-micon"><i class="ti ti-caravan"></i></span>
            <span class="pc-mtext">{{ __('messages.suppliers') }}</span>
          </a>
        </li>

        <li class="pc-item pc-caption ">
          <label>{{ __('messages.transactions') }}</label>
          <i class="ti ti-apps"></i>
        </li>
        <li class="pc-item">
          <a href="{{ route('transaksi.pengeluaran.index') }}" class="pc-link">
            <span class="pc-micon"><i class="ti ti-wallet"></i></span>
            <span class="pc-mtext">{{ __('messages.expenses') }}</span>
          </a>
        </li>
        <li class="pc-item">
          <a href="{{ route('transaksi.penjualan.index') }}" class="pc-link">
            <span class="pc-micon"><i class="ti ti-report-money"></i></span>
            <span class="pc-mtext">{{ __('messages.sales') }}</span>
          </a>
        </li>
        <li class="pc-item pc-caption ">
          <label>{{ __('messages.reports') }}</label>
          <i class="ti ti-apps"></i>
        </li>
        <li class="pc-item">
          <a href="{{ route('report.laporan.index') }}" class="pc-link">
            <span class="pc-micon"><i class="ti ti-report-analytics"></i></span>
            <span class="pc-mtext">{{ __('messages.income_report') }}</span>
          </a>
        </li>
        <li class="pc-item pc-caption ">
          <label>{{ __('messages.system') }}</label>
          <i class="ti ti-apps"></i>
        </li>
        @if($isRole === 1)
        <li class="pc-item">
          <a href="{{ route('system.role.index') }}" class="pc-link">
            <span class="pc-micon"><i class="ti ti-file-certificate"></i></span>
            <span class="pc-mtext">{{ __('messages.role') }}</span>
          </a>
        </li>
        @endif
        <li class="pc-item">
          <a href="{{ route('system.cabang.index') }}" class="pc-link">
            <span class="pc-micon"><i class="ti ti-building-community"></i></span>
            <span class="pc-mtext">{{ __('messages.branches') }}</span>
          </a>
        </li>
        <li class="pc-item">
          <a href="{{ route('system.user.index') }}" class="pc-link">
            <span class="pc-micon"><i class="ti ti-users"></i></span>
            <span class="pc-mtext">{{ __('messages.users') }}</span>
          </a>
        </li>
        <li class="pc-item">
          <a href="{{ route('system.setting') }}" class="pc-link">
            <span class="pc-micon"><i class="ti ti-settings"></i></span>
            <span class="pc-mtext">{{ __('messages.settings') }}</span>
          </a>
        </li>
        <li class="pc-item">
          <a href="{{ route('system.log.index') }}" class="pc-link">
            <span class="pc-micon"><i class="ti ti-history"></i></span>
            <span class="pc-mtext">{{ __('messages.log_history') }}</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

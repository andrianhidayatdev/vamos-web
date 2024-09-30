@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')

<!-- [ Sidebar Menu ] end -->
<!-- [ Header Topbar ] start -->

<!-- [ Header ] end -->



<!-- [ Main Content ] start -->
<div class="pc-container">
  <div class="pc-content">
    <!-- [ Main Content ] start -->
    <div class="row">
      <!-- [ sample-page ] start -->
      <div class="col-xl-3 col-md-6">
        <div class="card bg-blue-900 dashnum-card text-white overflow-hidden">
          <span class="round small"></span>
          <span class="round big"></span>
          <div class="card-body">
            <div class="row">
              <div class="col">
                <div class="avtar avtar-lg">
                  <i class="text-white ti ti ti-stack"></i>
                </div>
              </div>
              <div class="col-auto">
                <div class="btn-group">
                  <a href="#" class="avtar bg-blue-900 dropdown-toggle arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ti ti-arrow-big-right text-white"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li><a href="{{route('master.kategori.index')}}"><button class="dropdown-item">{{ __('messages.view_categories') }}</button></a></li>
                  </ul>
                </div>
              </div>
            </div>
            <span class="text-white d-block f-34 f-w-500 my-2">{{ $kategori }}</span>
            <p class="mb-0 ">{{ __('messages.categories') }} </p>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6">
        <div class="card bg-green-900 dashnum-card text-white overflow-hidden">
          <span class="round small"></span>
          <span class="round big"></span>
          <div class="card-body">
            <div class="row">
              <div class="col">
                <div class="avtar avtar-lg">
                  <i class="text-white ti ti-box"></i>
                </div>
              </div>
              <div class="col-auto">
                <div class="btn-group">
                  <a href="#" class="avtar bg-green-900 dropdown-toggle arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ti ti-arrow-big-right text-white"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li><a href="{{route('master.produk.index')}}"><button class="dropdown-item">{{ __('messages.view_products') }}</button></a></li>
                  </ul>
                </div>
              </div>
            </div>
            <span class="text-white d-block f-34 f-w-500 my-2">{{ $produk }}</span>
            <p class="mb-0 ">{{ __('messages.products') }} </p>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6">
        <div class="card bg-yellow-900 dashnum-card text-white overflow-hidden">
          <span class="round small"></span>
          <span class="round big"></span>
          <div class="card-body">
            <div class="row">
              <div class="col">
                <div class="avtar avtar-lg">
                  <i class="text-white ti ti-credit-card"></i>
                </div>
              </div>
              <div class="col-auto">
                <div class="btn-group">
                  <a href="#" class="avtar bg-yellow-900 dropdown-toggle arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ti ti-arrow-big-right text-white"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li><a href="{{route('master.member.index')}}"><button class="dropdown-item">{{ __('messages.view_members') }}</button></a></li>
                  </ul>
                </div>
              </div>
            </div>
            <span class="text-white d-block f-34 f-w-500 my-2">{{ $member }}</span>
            <p class="mb-0 ">{{ __('messages.members') }} </p>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6">
        <div class="card bg-red-900 dashnum-card text-white overflow-hidden">
          <span class="round small"></span>
          <span class="round big"></span>
          <div class="card-body">
            <div class="row">
              <div class="col">
                <div class="avtar avtar-lg">
                  <i class="text-white ti ti-caravan"></i>
                </div>
              </div>
              <div class="col-auto">
                <div class="btn-group">
                  <a href="#" class="avtar bg-red-900 dropdown-toggle arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ti ti-arrow-big-right text-white"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li><a href="{{route('master.supplier.index')}}"><button class="dropdown-item">{{ __('messages.view_suppliers') }}</button></a></li>
                  </ul>
                </div>
              </div>
            </div>
            <span class="text-white d-block f-34 f-w-500 my-2">{{ $supplier }}</span>
            <p class="mb-0 ">{{ __('messages.suppliers') }} </p>
          </div>
        </div>
      </div>

      <div class="col-xl-12 col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row mb-3 align-items-center">
              <div class="col">
                <small>{{ __('messages.total_sales') }}</small>
                <h3>Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</h3>
              </div>
            </div>
            <div id="chart"></div>
          </div>
        </div>
      </div>

      <!-- [ sample-page ] end -->
    </div>
    <!-- [ Main Content ] end -->
  </div>
</div>
@include('layouts.footer')

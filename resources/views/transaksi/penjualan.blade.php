@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')



<!-- [ Main Content ] start -->
<div class="pc-container">
  <div class="pc-content">
    <!-- [ Main Content ] start -->
    <div class="row">
      <!-- [ sample-page ] start -->
      <div class="col-xl-12 col-md-12">
        <div class="card ">

          <div class="card-body">
            <div class="mb-3 align-items-center">
              <h1 class="">{{ $name }}</h1>

            </div>
            <div class="table-responsive">
              <table id="example" class="table table-striped overflow-scroll" style="width:100%">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>{{ __('messages.date') }}</th>
                    <th>{{ __('messages.member_code') }}</th>
                    <th>{{ __('messages.total_items') }}</th>
                    <th>{{ __('messages.total_price') }}</th>
                    <th>{{ __('messages.discount') }}</th>
                    <th>{{ __('messages.total_payment') }}</th>
                    <th>{{ __('messages.cashier') }}</th>

                  </tr>
                </thead>
                <tbody>
                  @foreach ($penjualan as $row)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ \Carbon\Carbon::parse($row->created_at)->format('d-m-Y') }}</td>
                    <td>{{ $row->member->kode_member }}</td>
                    <td>{{ $row->total_item }}</td>
                    <td>{{ $row->total_harga }}</td>
                    <td>{{ $row->diskon }}</td>
                    <td>{{ $row->bayar }}</td>
                    <td>{{ $row->user_id }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- [ sample-page ] end -->
    </div>
    <!-- Modal -->

  </div>
</div>
@include('layouts.footer')

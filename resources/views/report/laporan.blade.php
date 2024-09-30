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
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah"> <i class="fas fa-calendar-alt me-2"></i> {{ __('messages.period') }}</button>
              <a href="{{ route('report.laporan.pdf', [
                  'tanggal_awal' => isset($tanggal_awal) ? $tanggal_awal : null,
                  'tanggal_akhir' => isset($tanggal_akhir) ? $tanggal_akhir : null
                  ]) }}" class="btn btn-danger">
                <i class="fas fa-file-pdf me-2"></i>{{ __('messages.export')}} PDF
              </a>
            </div>
            <div class="table-responsive">
              <table id="example" class="table table-striped overflow-scroll" style="width:100%">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>{{ __('messages.date') }}</th>
                    <th>{{ __('messages.total_sales') }}</th>
                    <th>{{ __('messages.total_expenses') }}</th>
                    <th>{{ __('messages.total_income') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($laporan as $row)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->tanggal }}</td>
                    <td>{{ $row->total_penjualan }}</td>
                    <td>{{ $row->total_pengeluaran }}</td>
                    <td>{{ $row->total_penjualan - $row->total_pengeluaran }}</td>
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
    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-primary ">
            <h2 class="modal-title text-white" id="exampleModalLabel ">{{ __('messages.period') }} </h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="{{ route('report.laporan.index') }}" method="GET" id="dateForm">
              <div class="mb-3">
                <label for="tanggalAwal" class="form-label fw-bold">{{ __('messages.start_date') }} </label>
                <input type="text" class="form-control" id="tanggalAwal" name="tanggal_awal">
              </div>
              <div class="mb-3">
                <label for="tanggalAkhir" class="form-label fw-bold">{{ __('messages.end_date') }} </label>
                <input type="text" class="form-control" id="tanggalAkhir" name="tanggal_akhir">
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">{{ __('messages.close') }} </button>
            <button type="submit" class="btn btn-primary">Filter</button>
          </div>
        </div>
        </form>

      </div>
    </div>
  </div>
</div>
@include('layouts.footer')

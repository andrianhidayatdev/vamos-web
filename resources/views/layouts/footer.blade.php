<footer class="pc-footer">
  <div class="footer-wrapper container-fluid">
    <div class="row">
      <div class="col-sm-6 my-1">
        <p>&copy; 2024 {{ __('messages.footer') }}</p>
      </div>

    </div>
  </div>
</footer>
<!-- Required Js -->
<script src="{{asset('assets/js/plugins/popper.min.js')}}"></script>
<script src="{{ asset('assets/js/plugins/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/fonts/custom-font.js') }}"></script>
<script src="{{ asset('assets/js/pcoded.js') }}"></script>
<script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>


{{-- NEED --}}

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.7/js/dataTables.bootstrap5.js"></script>

@if (Route::currentRouteName() == 'master.kategori.index')
<script src="{{ asset('assets/edit-table/kategori.js') }}"></script>
@endif

@if (Route::currentRouteName() == 'master.member.index')
<script src="{{ asset('assets/edit-table/member.js') }}"></script>
@endif

@if (Route::currentRouteName() == 'master.supplier.index')
<script src="{{ asset('assets/edit-table/supplier.js') }}"></script>
@endif

@if (Route::currentRouteName() == 'master.produk.index')
<script src="{{ asset('assets/edit-table/produk.js') }}"></script>
@endif

@if (Route::currentRouteName() == 'system.role.index')
<script src="{{ asset('assets/edit-table/role.js') }}"></script>
@endif

@if (Route::currentRouteName() == 'system.user.index')
<script src="{{ asset('assets/edit-table/user.js') }}"></script>
@endif

@if (Route::currentRouteName() == 'system.cabang.index')
<script src="{{ asset('assets/edit-table/cabang.js') }}"></script>
@endif



@if (Route::currentRouteName() == 'profile')
<script src="{{ asset('assets/dist/js/profile.js') }}"></script>
@endif


@if (Route::currentRouteName() == 'system.setting')
<script src="{{ asset('assets/dist/js/setting.js') }}"></script>
@endif


@if (Route::currentRouteName() == 'report.laporan.index')
<script src="{{ asset('assets/dist/js/report.js') }}"></script>
@endif


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">


@if (Route::currentRouteName() == 'home.index')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="{{ asset('assets/js/pages/dashboard-default.js')}}"></script>

<script>
  window.onload = function() {
    var dataFromController = @json($data_per_hari);
    var salesData = dataFromController.map(item => parseInt(item.total_penjualan));
    var categories = dataFromController.map(item => item.tanggal.split('-').pop());

    var options = {
      chart: {
        type: 'line'
        , height: 350
      }
      , series: [{
        name: 'Total Penjualan'
        , data: salesData
      }]
      , xaxis: {
        categories: categories
      }
    };
    console.log(dataFromController);
    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render().catch(err => console.error(err));
  };

</script>
@endif

<script>
  layout_change('light');

</script>

<script>
  font_change("Roboto");

</script>

<script>
  change_box_container('false');

</script>

<script>
  layout_caption_change('true');

</script>




<script>
  layout_rtl_change('false');

</script>


<script>
  preset_change("preset-1");

</script>





{{-- CONFRIM DELETE --}}
<script>
  function confirmDelete(id) {
    Swal.fire({
      title: 'Anda yakin?'
      , text: "Data ini tidak bisa dikembalikan!"
      , icon: 'warning'
      , showCancelButton: true
      , confirmButtonColor: '#3085d6'
      , cancelButtonColor: '#d33'
      , confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
      if (result.isConfirmed) {
        // Mengambil form berdasarkan ID
        document.getElementById('delete-form-' + id).submit();
      }
    });
  }

</script>
{{-- ALERT SUCCESS --}}
@if(session('success'))
<script>
  Swal.fire({
    title: @json(App::getLocale() == 'en' ? 'Success' : 'Sukses')
    , icon: 'success'
    , confirmButtonText: 'OK'
  });

</script>
@endif




{{-- ALERT ERROR --}}
@if ($errors->any())
<script>
  Swal.fire({
    title: @json(App::getLocale() == 'en' ? 'Failed' : 'Gagal')
    , text: '{{ implode('
    , ', $errors->all()) }}'
    , icon: 'error'
    , confirmButtonText: 'OK'
  });

</script>
@endif

{{-- Menangani error dalam service --}}
@if (session('error'))
<script>
  Swal.fire({
    title: 'Error'
    , text: '{{ session('
    error ') }}'
    , icon: 'error'
    , confirmButtonText: 'OK'
  });

</script>
@endif
</body>

<script>
  $(document).ready(function() {
    $('#example').DataTable({
      responsive: true
    , });
  });

</script>


</html>

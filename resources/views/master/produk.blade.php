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
              <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambah"> <i class="fas  fa-plus me-2"></i> {{ __('messages.add') }} </button>
            </div>
            <div class="table-responsive">
              <table id="example" class="table table-striped overflow-scroll" style="width:100%">
                <thead>
                  <tr>
                    <th class="small-text">No</th>
                    <th class="small-text">{{ __('messages.product.code') }}</th>
                    <th class="small-text">{{ __('messages.product.name') }}</th>
                    <th class="small-text">{{ __('messages.product.brand') }}</th>
                    <th class="small-text">{{ __('messages.product.category') }}</th>
                    <th class="small-text">{{ __('messages.product.purchase_price') }}</th>
                    <th class="small-text">{{ __('messages.product.sale_price') }}</th>
                    <th class="small-text">{{ __('messages.product.stock') }}</th>
                    <th class="small-text">{{ __('messages.product.discount') }}</th>
                    <th class="small-text">{{ __('messages.user') }}</th>
                    <th>{{ __('messages.last_update') }}</th>

                    @if($isRole != 3 )
                    <th class="small-text"><i class="ti ti-settings"></i></th>
                    @endif
                  </tr>
                <tbody>
                  @foreach ($produk as $row)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->kode_produk ?? '-' }}</td>
                    <td>{{ $row->nama_produk ?? '-' }}</td>
                    <td>{{ $row->merk ?? '-' }}</td>
                    <td>{{ $row->nama_kategori ?? '-' }}</td>
                    <td>{{ $row->harga_beli ?? '-' }}</td>
                    <td>{{ $row->harga_jual ?? '-' }}</td>
                    <td>{{ $row->stok ?? '-' }}</td>
                    <td>{{ $row->diskon ?? '-' }}</td>
                    <td>{{ $row->users->name ?? '-' }}</td>
                    <td>{{ $row->users_last_update->name ?? '-' }}</td>
                    @if($isRole != 3 )
                    <td class="d-flex align-items-center">
                      <button type="button" class="btn btn-info me-2" data-bs-toggle="modal" data-bs-target="#edit" data-id_produk="{{$row->id_produk}}" data-nama_produk="{{$row->nama_produk}}" data-merk="{{$row->merk}}" data-harga_jual="{{$row->harga_jual}}" data-stok="{{$row->stok}}" data-diskon="{{$row->diskon}}" data-id_kategori="{{$row->id_kategori}}" data-harga_beli="{{$row->harga_beli}}">
                        <i class="fas fa-edit me-1 small-icon" style="font-size: 0.8rem;"></i>
                      </button>

                      <form id="delete-form-{{ $row->id_produk }}" action="{{ route('master.produk.delete', $row->id_produk) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $row->id_produk }})">
                          <i class="fas fa-trash me-1" style="font-size: 0.8rem;"></i>
                        </button>
                      </form>
                    </td>
                    @endif

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
      <div class="modal-dialog ">
        <div class="modal-content ">
          <div class="modal-header bg-success ">
            <h2 class="modal-title text-white" id="exampleModalLabel ">{{ __('messages.add')}} </h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body ">
            <form action="{{route('master.produk.create') }}" method="POST">
              @csrf
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label fw-bold">{{ __('messages.product.name') }} </label>
                <input type="text" class="form-control" name="nama_produk" aria-describedby="emailHelp" required>
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label fw-bold">{{ __('messages.product.purchase_price') }} </label>
                <input type="number" class="form-control" name="harga_beli" aria-describedby="emailHelp" required>
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label fw-bold">{{ __('messages.product.sale_price') }}</label>
                <input type="number" class="form-control" name="harga_jual" aria-describedby="emailHelp" required>
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label fw-bold">{{ __('messages.product.brand') }} </label>
                <input type="text" class="form-control" name="merk" aria-describedby="emailHelp">
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label fw-bold">{{ __('messages.product.category') }}</label>
                <select class="form-select" aria-label="Default select example" name="id_kategori">
                  <option selected hidden value="">{{ __('messages.product.category') }}</option>
                  @foreach ($kategori as $row)
                  <option value="{{ $row->id_kategori }}">{{ $row->nama_kategori }}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label fw-bold">{{ __('messages.product.stock') }}</label>
                <input type="number" class="form-control" name="stok" aria-describedby="emailHelp">
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label fw-bold">{{ __('messages.product.discount') }}</label>
                <input type="number" class="form-control" name="diskon" aria-describedby="emailHelp" min="0" max="100">
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">{{ __('messages.close')}}</button>
            <button type="submit" class="btn btn-success">{{ __('messages.add')}}</button>
          </div>
        </div>
        </form>

      </div>
    </div>

    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-info ">
            <h2 class="modal-title text-white" id="exampleModalLabel ">Edit </h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="{{route('master.produk.update') }}" method="POST">
              @csrf
              <div class="mb-3">
                <label for="nama_produk" class="form-label fw-bold">{{ __('messages.product.name') }} </label>
                <input type="text" class="form-control" name="nama_produk" id="nama_produk" aria-describedby="emailHelp" required>
              </div>
              <div class="mb-3">
                <label for="harga_beli" class="form-label fw-bold">{{ __('messages.product.purchase_price') }} </label>
                <input type="number" class="form-control" name="harga_beli" id="harga_beli" aria-describedby="emailHelp" required>
              </div>
              <div class="mb-3">
                <label for="harga_jual" class="form-label fw-bold">{{ __('messages.product.sale_price') }}</label>
                <input type="number" class="form-control" name="harga_jual" id="harga_jual" aria-describedby="emailHelp" required>
              </div>
              <div class="mb-3">
                <label for="merk" class="form-label fw-bold">{{ __('messages.product.brand') }} </label>
                <input type="text" class="form-control" name="merk" id="merk" aria-describedby="emailHelp">
              </div>
              <div class="mb-3">
                <label for="id_kategori" class="form-label fw-bold">{{ __('messages.product.category') }}</label>
                <select class="form-select" aria-label="Default select example" name="id_kategori" id="id_kategori">
                  <option selected hidden value="">{{ __('messages.product.category') }}</option>
                  @foreach ($kategori as $row)
                  <option value="{{ $row->id_kategori }}">{{ $row->nama_kategori }}</option>
                  @endforeach
                </select>
              </div>

              <div class="mb-3">
                <label for="stok" class="form-label fw-bold">{{ __('messages.product.stock') }}</label>
                <input type="number" class="form-control" name="stok" id="stok" aria-describedby="emailHelp">
              </div>
              <div class="mb-3">
                <label for="diskon" class="form-label fw-bold">{{ __('messages.product.discount') }}</label>
                <input type="number" class="form-control" name="diskon" id="diskon" aria-describedby="emailHelp" min="0" max="100">
              </div>

              <input type="number" name="id_produk" id="id_produk" hidden>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">{{ __('messages.close')}}</button>
            <button type="submit" class="btn btn-info">Edit</button>
          </div>
        </div>
        </form>

      </div>
    </div>
  </div>
</div>
@include('layouts.footer')

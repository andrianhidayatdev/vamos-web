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
                    <th>No</th>
                    <th>{{ __('messages.name') }}</th>
                    <th>{{ __('messages.address') }}</th>
                    <th>{{ __('messages.phone') }}</th>
                    <th>{{ __('messages.user') }}</th>
                    <th>{{ __('messages.last_update') }}</th>
                    <th><i class="ti ti-settings"></i></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($supplier as $row)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->nama }}</td>
                    <td>{{ $row->alamat }}</td>
                    <td>{{ $row->telepon }}</td>
                    <td>{{ $row->users->name }}</td>
                    <td>{{ $row->users_last_update->name }}</td>
                    <td class="d-flex align-items-center">
                      <button type="button" class="btn btn-info me-2" data-bs-toggle="modal" data-bs-target="#edit" data-id_supplier="{{$row->id_supplier}}" data-nama="{{$row->nama}}" data-telepon="{{$row->telepon}}" data-alamat="{{$row->alamat}}">
                        <i class="fas fa-edit me-2"></i>
                      </button>

                      <form id="delete-form-{{ $row->id_supplier }}" action="{{ route('master.supplier.delete', $row->id_supplier) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $row->id_supplier }})">
                          <i class="fas fa-trash me-2"></i>
                        </button>
                      </form>
                    </td>
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
          <div class="modal-header bg-success ">
            <h2 class="modal-title text-white" id="exampleModalLabel ">{{ __('messages.add') }} </h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="{{route('master.supplier.create') }}" method="POST">
              @csrf
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label fw-bold">{{ __('messages.name')}} </label>
                <input type="text" class="form-control" name="nama" aria-describedby="emailHelp" required>
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label fw-bold">{{ __('messages.phone')}} </label>
                <input type="number" class="form-control" name="telepon" aria-describedby="emailHelp">
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label fw-bold">{{ __('messages.address')}} </label>
                <textarea class="form-control" name="alamat" rows="4" aria-describedby="emailHelp"></textarea>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">{{ __('messages.close') }}</button>
            <button type="submit" class="btn btn-success">{{ __('messages.add') }}</button>
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
            <form action="{{route('master.supplier.update') }}" method="POST">
              @csrf
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label fw-bold">{{ __('messages.name')}} </label>
                <input type="text" class="form-control" name="nama" id="nama" aria-describedby="emailHelp" required>
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label fw-bold">{{ __('messages.phone')}} </label>
                <input type="number" class="form-control" name="telepon" id="telepon" aria-describedby="emailHelp">
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label fw-bold">{{ __('messages.address')}} </label>
                <textarea class="form-control" name="alamat" rows="4" id="alamat" aria-describedby="emailHelp"></textarea>
                <input type="number" name="id_supplier" id="id_supplier" hidden>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">{{ __('messages.close') }}</button>
            <button type="submit" class="btn btn-info">Edit</button>
          </div>
        </div>
        </form>

      </div>
    </div>
  </div>
</div>
@include('layouts.footer')

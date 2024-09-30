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
                    <th>{{ __('messages.photo') }}</th>
                    <th>{{ __('messages.name') }}</th>
                    <th>{{ __('messages.email') }}</th>
                    <th>{{ __('messages.branches') }}</th>
                    <th>{{ __('messages.role') }}</th>
                    <th><i class="ti ti-settings"></i></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($userData as $row)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                      <img src="{{ asset('storage/' . $row->foto) }}" alt="Foto" class=" rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                    </td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->email }}</td>
                    <td>{{ $row->nama_cabang }}</td>
                    <td>{{ $row->nama_role }}</td>
                    <td class="">
                      <div class="d-flex">
                        <button type="button" class="btn btn-info me-2" data-bs-toggle="modal" data-bs-target="#edit" data-id="{{ $row->id }}" data-nama="{{ $row->name }}" data-email="{{ $row->email }}" data-id_role="{{ $row->id_role }}" data-id_cabang="{{ $row->id_cabang }}">
                          <i class="fas fa-edit me-2"></i>
                        </button>

                        <form id="delete-form-{{ $row->id }}" action="{{ route('system.user.delete', $row->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $row->id }})">
                            <i class="fas fa-trash me-2"></i>
                          </button>
                        </form>
                      </div>
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
            <form action="{{route('system.user.create') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label fw-bold">{{ __('messages.name') }} </label>
                <input type="text" class="form-control" name="name" required aria-describedby="emailHelp">
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label fw-bold">{{ __('messages.email') }}</label>
                <input type="email" class="form-control" name="email" required aria-describedby="emailHelp" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label fw-bold">{{ __('messages.password') }}</label>
                <input type="password" class="form-control" name="password" id="password" required>
              </div>
              <div class="mb-3">
                <label for="password_confirmation" class="form-label fw-bold">{{ __('messages.confirm.password') }}</label>
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label fw-bold">{{ __('messages.branches') }}</label>
                <select class="form-select" aria-label="Default select example" name="id_cabang">
                  <option selected hidden value="">{{ __('messages.select_branch') }}</option>
                  @foreach ($cabang as $row )
                  <option value="{{$row->id_cabang}}">{{ $row->nama_cabang }}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label fw-bold">{{__('messages.role')}} </label>
                <select class="form-select" aria-label="Default select example" name="id_role">
                  <option selected hidden value="">{{ __('messages.select_role') }}</option>
                  @foreach ($role as $row)
                  @if ($isRole != 1)

                  @if ($row->role == 2 || $row->role == 3)

                  <option value="{{ $row->id_role }}">{{ $row->nama_role }}</option>
                  @endif
                  @else
                  <option value="{{ $row->id_role }}">{{ $row->nama_role }}</option>
                  @endif
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label fw-bold">{{ __('messages.photo') }}</label>
                <input type="file" class="form-control" name="foto" aria-describedby="emailHelp">
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
            <form action="{{route('system.user.update') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label fw-bold">{{__('messages.name')}} </label>
                <input type="text" class="form-control" name="name" required id="name" aria-describedby="emailHelp">
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label fw-bold">{{__('messages.email')}} </label>
                <input type="email" class="form-control" name="email" required aria-describedby="emailHelp" required id="email">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label fw-bold">{{__('messages.password')}} </label>
                <input type="password" class="form-control" name="password">
              </div>
              <div class="mb-3">
                <label for="password_confirmation" class="form-label fw-bold">{{__('messages.confirm.password')}} </label>
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label fw-bold">{{__('messages.branches')}} </label>
                <select class="form-select" aria-label="Default select example" name="id_cabang" id="id_cabang">
                  <option selected hidden value="">{{__('messages.select_branch')}} </option>
                  @foreach ($cabang as $row )
                  <option value="{{$row->id_cabang}}">{{ $row->nama_cabang }}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label fw-bold">{{__('messages.role')}} </label>
                <select class="form-select" aria-label="Default select example" name="id_role" id="id_role">
                  <option selected hidden value="">{{__('messages.select_role')}}</option>
                  @foreach ($role as $row)
                  @if ($isRole != 1)

                  @if ($row->role == 2 || $row->role == 3)

                  <option value="{{ $row->id_role }}">{{ $row->nama_role }}</option>
                  @endif
                  @else
                  <option value="{{ $row->id_role }}">{{ $row->nama_role }}</option>
                  @endif
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label fw-bold">{{__('messages.photo')}} </label>
                <input type="file" class="form-control" name="foto" aria-describedby="emailHelp">
                <input type="number" name="id" id="id" hidden>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">{{__('messages.close')}}</button>
            <button type="submit" class="btn btn-info">Edit</button>
          </div>
        </div>
        </form>

      </div>
    </div>
  </div>
</div>
@include('layouts.footer')

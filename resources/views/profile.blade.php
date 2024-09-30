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
        <div class="card">

          <div class="card-body flex justify-content-center">
            <div class="row justify-justify-content-center">
              <div class="col-12 col-lg-5 d-flex justify-content-center align-items-center">
                <img src="{{ asset('storage/' . $user->foto) }}" alt="Foto" id="profile" class="rounded-circle" style="width: 250px; height: 250px; object-fit: cover;">
              </div>

              <div class="col-12 col-lg-6">
                <form action="{{route('update.profile')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label fw-bold">{{ __('messages.name') }}</label>
                    <input type="text" class="form-control" name="name" id="exampleInputEmail1" value="{{ $user->name }}">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label fw-bold">{{ __('messages.branches') }}</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" value="{{ $user->nama_cabang }}" readonly>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label fw-bold">{{ __('messages.photo') }}</label>
                    <input type="file" class="form-control" name="foto" aria-describedby="emailHelp" onchange="previewProfile(event)">
                  </div>
                  <div class="mb-3">
                    <label for="old_password" class="form-label fw-bold">{{ __('messages.old_password') }}</label>
                    <input type="password" class="form-control" id="old_password" name="old_password">
                  </div>
                  <div class="mb-3">
                    <label for="new_password" class="form-label fw-bold">{{ __('messages.new_password') }}</label>
                    <input type="password" class="form-control" id="new_password" name="password_baru">
                  </div>
                  <div class="mb-3">
                    <label for="new_password_confirmation" class="form-label fw-bold">{{ __('messages.confirm_new_password') }}</label>
                    <input type="password" class="form-control" id="new_password_confirmation" name="password_baru_confirmation">
                  </div>

                  <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>{{ __('messages.save') }}</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@include('layouts.footer')

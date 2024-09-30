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
        <div class="card mb-3">
          <div class="card-body flex justify-content-center">

            <h2>{{ __('messages.settings') }}</h2>
            <hr>
            <form action="{{route('system.setting.createOrUpdateOtherSetting')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="mb-3 col-md-3">
                  <label for="exampleInputEmail1" class="form-label fw-bold">{{ __('messages.language') }}</label>
                  <select class="form-select" aria-label="Default select example" name="bahasa" id="id_role">

                    @if(isset($user->other_setting->bahasa))
                    <option value="id" {{ $user->other_setting->bahasa === 'id' ? 'selected' : '' }}>Bahasa Indonesia</option>
                    <option value="en" {{ $user->other_setting->bahasa === 'en' ? 'selected' : '' }}>English</option>
                    @else
                    <option value="id">Bahasa Indonesia</option>
                    <option value="en">English</option>
                    @endif
                  </select>
                </div>
                <div class="d-flex justify-content-end">
                  <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>{{ __('messages.save') }}</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="card">

          <div class="card-body flex justify-content-center">
            <h2>{{ __('messages.branch_setting') }}</h2>
            <hr>
            <form action="{{route('system.setting.updateOrCreate')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="mb-3 col-md-6">
                  <label for="exampleInputEmail1" class="form-label fw-bold">{{ __('messages.branches') }}</label>
                  <input type="text" class="form-control " id="exampleInputEmail1" value="{{ $user->cabang->nama_cabang ?? '' }}" readonly>
                </div>
                <div class="mb-3 col-md-6">
                  <label for="exampleInputEmail1" class="form-label fw-bold">{{ __('messages.phone') }}</label>
                  <input type="number" class="form-control " name="telepon" id="exampleInputEmail1" value="{{ $setting->telepon ?? '' }}">
                </div>
                <div class="mb-3 col-md-6">
                  <label for="alamat" class="form-label fw-bold">{{ __('messages.address') }}</label>
                  <textarea class="form-control " name="alamat" rows="3">{{ $setting->alamat ?? '' }}</textarea>
                </div>
                <div class=" mb-3 col-md-6">
                  <label for="new_password_confirmation" class="form-label fw-bold">{{ __('messages.discount') }}</label>
                  <input type="number" min="0" max="100" class="form-control " id="new_password_confirmation" name="diskon" value="{{ $setting->diskon ?? '' }}">
                </div>
                <div class="mb-3 col-md-6">
                  <label for="logo" class="form-label fw-bold">Logo {{ __('messages.branches') }}</label>
                  <input type="file" class="form-control" name="logo" onchange="previewLogo(event)">
                </div>

                <div class="mb-3 col-md-6">
                  <label for="kartu_member" class="form-label fw-bold">{{ __('messages.member_card') }}</label>
                  <input type="file" class="form-control" name="kartu_member" id="kartu_member" onchange="previewKartuMember(event)">
                </div>

                <div class="form-group col-6">
                  <div class="preview-container border rounded d-flex align-items-center justify-content-center" style="max-width: 300px; height: 200px; overflow: hidden;">
                    @if($setting && $setting->logo)
                    <img id="logo" src="{{ asset('storage/' . $setting->logo) }}" alt="Preview Gambar" class="img-fluid" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                    <span id="logo-text" class="text-muted" style="display: none;">{{ __('messages.no_image_selected') }}</span>
                    @else
                    <img id="logo" src="" alt="Preview Gambar" class="img-fluid" style="display: none; max-height: 100%; max-width: 100%; object-fit: contain;">
                    <span id="logo-text" class="text-muted">{{ __('messages.no_image_selected') }}</span>
                    @endif
                  </div>
                </div>

                <div class="form-group col-6">
                  <div class="preview-container border rounded d-flex align-items-center justify-content-center" style="max-width: 300px; height: 200px; overflow: hidden;">
                    @if($setting && $setting->kartu_member)
                    <img id="kartuMember" src="{{ asset('storage/' . $setting->kartu_member) }}" alt="Preview Gambar" class="img-fluid" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                    <span class="text-muted" style="display: none;">{{ __('messages.no_image_selected') }}</span>
                    @else
                    <img id="kartuMember" src="" alt="Preview Gambar" class="img-fluid" style="display: none; max-height: 100%; max-width: 100%; object-fit: contain;">
                    <span class="text-muted">{{ __('messages.no_image_selected') }}</span>
                    @endif
                  </div>
                </div>
                <div class="d-flex justify-content-end">
                  <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>{{ __('messages.save') }}</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
@include('layouts.footer')

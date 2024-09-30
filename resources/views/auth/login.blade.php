<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->
<head>
  <title>Login </title>
  <!-- [Meta] -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Berry is trending dashboard template made using Bootstrap 5 design framework. Berry is available in Bootstrap, React, CodeIgniter, Angular,  and .net Technologies.">
  <meta name="keywords" content="Bootstrap admin template, Dashboard UI Kit, Dashboard Template, Backend Panel, react dashboard, angular dashboard">
  <meta name="author" content="codedthemes">

  <!-- [Favicon] icon -->

  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" id="main-font-link">
  <!-- [Tabler Icons] https://tablericons.com -->
  <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css')}}">
  <!-- [Feather Icons] https://feathericons.com -->
  <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css')}}">
  <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
  <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
  <!-- [Material Icons] https://fonts.google.com/icons -->
  <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}">
  <!-- [Template CSS Files] -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link">
  <link rel="stylesheet" href="{{ asset('assets/css/style-preset.css') }}">

</head>
<!-- [Head] end -->
<!-- [Body] Start -->
<body>
  <!-- [ Pre-loader ] start -->
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>
  <!-- [ Pre-loader ] End -->

  <div class="auth-main">
    <div class="auth-wrapper v3">
      <div class="auth-form">
        <div class="card my-5">
          <div class="card-body">
            <a href="#" class="d-flex justify-content-center">
              {{-- <img src="../assets/images/logo-dark.svg" alt="image" class="img-fluid brand-logo"> --}}
            </a>
            <div class="row">
              <div class="d-flex justify-content-center">
                <div class="auth-header">
                  <h2 class="text-secondary mt-5"><b>Hi, Selamat Datang</b></h2>
                  <p class="f-16 mt-2">Masukkan Email dan Password</p>
                </div>
              </div>
            </div>

            <form action="{{ route('login.post') }}" method="post">
              @csrf
              <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingInput" placeholder="Email address / Username" name="email">
                <label for="floatingInput">Email</label>
                @if($errors->has('email'))
                <div class="text-danger" style="width: 100%;">
                  {{ $errors->first('email') }}
                </div>
                @endif
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingInput1" placeholder="Password" name="password">
                <label for="floatingInput1">Password</label>
                @if($errors->has('password'))
                <div class="text-danger" style="width: 100%;">
                  {{ $errors->first('password') }}
                </div>
                @endif
              </div>
              <div class="d-flex mt-1 justify-content-between">
                <div class="form-check">
                  <input class="form-check-input input-primary" type="checkbox" id="customCheckc1" name="remember">
                  <label class="form-check-label text-muted" for="customCheckc1">Remember me</label>
                </div>
              </div>

              <div class="d-grid mt-4">
                <button type="submit" class="btn btn-secondary">Login</button>
              </div>
            </form>
            <hr>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->
  <!-- Required Js -->
  <script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/simplebar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/fonts/custom-font.js') }}"></script>
  <script src="{{ asset('assets/js/pcoded.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>





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


</body>
<!-- [Body] end -->
</html>

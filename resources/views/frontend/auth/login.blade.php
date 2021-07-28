<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      rel="stylesheet"
      href="{{ mix('css/app.css') }}"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
    />
    <style>
      body {
        overflow: hidden;
      }
      input[type="checkbox"]:focus {
        outline: none;
        box-shadow: none !important;
        border: 1px solid #ccc !important;
      }
      input[type="checkbox"] {
        width: 20px !important;
        height: 20px !important;
      }
      .form-check-label {
        padding-top: 2px !important;
      }
      .background {
        position: absolute;
        width: 600px;
        bottom: 0;
        right: 0;
        left: 0;
      }
      .rounded-4 {
        border-radius: 0.5rem;
      }
      .rounded-rem {
        border-radius: 1rem;
      }
      .mt-10 {
        margin-top: 10rem;
      }
      .btn-login {
        color: #fff;
        width:100%;
        border-color: #4e67f3;
        background-color: #4e67f3;
        box-shadow: 0 4px 6px rgb(50 50 93 / 11%), 0 1px 3px rgb(0 0 0 / 8%);
      }
      .btn-login:hover {
        color: #fff;
        border-color: #435be0;
        background-color: #435be0;
        box-shadow: 0 6px 6px rgb(50 50 93 / 11%), 0 3px 3px rgb(0 0 0 / 8%);
      }
      .form-check-label{
        margin-top: 2px;
        margin-left:2px;
      }
      .not-valid{
        border-color:red !important;
      }
      .social-login{
        width:60px !important;
        height:60px !important;
        box-shadow: 1px 6px 6px rgb(50 50 93 / 11%), 0 3px 3px rgb(0 0 0 / 8%);
        color:#fff;
      }
      .social-login .fab{
        font-size:28px
      }
      .social-login.google{color:#DC4A38;}
      .social-login.facebook{color:#3B5998;}
      .social-login.twitter{color:#3CF;}
      .social-login.google:hover{background-color:#DC4A38;}
      .social-login.facebook:hover{background-color:#3B5998;}
      .social-login.twitter:hover{background-color:#3CF;}
      .social-login:hover{color:#fff;}
    </style>
    <title>login</title>
  </head>
  <body>
    <img class="background" src="{{ asset('/img/svgs/Login.svg') }}" alt="" />
    <div class="row d-flex justify-content-center align-items-center">
      <div
        class="
          col-10 col-sm-8 col-md-6 col-lg-4 col-xxl-3
          card
          bg-white
          mt-10
          p-3
          rounded-rem
          shadow-sm
          border-light
        "
      >
        <div class="card-body p-3">
          <h1 class="h3 text-center text-gray-800 fw-bold mb-4">{{ __('Login') }}</h1>
          <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3 py-3">
              <label class="">Email</label>
              <input
                type="text"
                class="form-control @error('email') not-valid @enderror"
                placeholder="email"
                value="{{ old('email') }}"
                autocomplete="email"
                autofocus
                name="email"
                aria-label="email"
              />
              @error('email') <span class="text-red-500" style="font-size: 14px">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3 py-2">
              <label class="">Password</label>
              <input
                type="password"
                class="form-control @error('password') not-valid  @enderror"
                placeholder="password"
                name="password"
                aria-label="password"
                autocomplete="current-password"
              />
              @error('password') <span class="text-red-500" style="font-size: 14px">{{ $message }}</span> @enderror

            </div>
            <div class="form-check">
              <input
                class="form-check-input"
                type="checkbox"
                name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}
              />
              <label class="form-check-label " for="remember">
                {{ __('Remember Me') }}
              </label>
            </div>
            <button role="submit"
              class="btn btn-login  my-3 shadow-sm"
              style="font-size: 18px"
              >Login
            </button>
          </form>
          <div class="d-flex justify-content-center my-3">
              <span class="border-2 border-gray-300 border-bottom mb-2 mx-2 w-25"></span>
              <span class="text-gray-400">or Login with</span>
              <span class="border-2 border-gray-300 border-bottom mb-2 mx-2 w-25"></span>
          </div>
          <div class="d-flex justify-content-center my-4">
            <a
            href=""
            class="btn rounded-circle mx-3 d-flex justify-content-center align-items-center social-login google">
                <i class="fab fa-google"></i>
            </a>
            <a
            href=""
            class="btn rounded-circle mx-3 d-flex justify-content-center align-items-center social-login facebook">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a
            href=""
            class="btn rounded-circle mx-3 d-flex justify-content-center align-items-center social-login twitter">
                <i class="fab fa-twitter"></i>
            </a>
          </div>
          <div class="d-flex justify-content-between">
            <a href="{{ route('password.request') }}" class="text-decoration-none "
                >{{ __('Forget Your password?') }}</a
            >
            <a href="{{ route('register') }}" class="text-decoration-none "
                >{{ __('Register') }}</a
            >
          </div>
        </div>
      </div>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
  </body>
</html>





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
    <style class="">
      body {
        overflow: hidden;
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
      .not-valid{
        border-color:red !important;
      }
      .error{
        color:red;
      }
    </style>
    <title>Reset Password</title>
  </head>
  <body>
    <img class="background" src="{{ asset('/img/svgs/reset_password.svg') }}" alt="" />
    <div class="row justify-content-center align-items-center">
      <div
        class="
          col-10 col-sm-8 col-md-6 col-lg-4 col-xxl-3
          card
          bg-white
          mt-10
          p-3
          rounded-rem
          shadow-lg
          border-light
        "
      >
        <div class="card-body p-3">
          <h1 class="h3 text-center mb-5">{{ __('Reset Password') }}</h1>
          <form action="{{ route('password.email') }}" method="POST">
            @csrf
            @if(Session::has('status'))
              <div class="alert alert-green-300 text-green-500 fw-bold rounded-5 p-1 my-2 px-2">{{ session('status') }}</div>
            @endif
            <div class="mb-3">
              <label>Email</label>
              <input
                type="text"
                class="form-control @error('email') not-valid @enderror"
                value="{{ old('email') }}"
                name="email"
                autocomplete="email" autofocus
              />
              @error('email')<div class="text-red-500" style="font-size: 14px">{{ $message }}</div>@enderror
            </div>
            <button
              class="btn btn-login mb-3 mt-1 shadow-sm"
              style="font-size: 18px; width:100%"
              >{{ __('Send Password Reset Link') }}
            </button>
          </form>
          <div class="mt-3 d-flex justify-content-between">
            <a href="{{ route('login') }}" class="text-decoration-none "
                >{{ __('Login') }}</a
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

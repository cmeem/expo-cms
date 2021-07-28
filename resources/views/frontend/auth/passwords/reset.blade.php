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
      .not-valid{
        border-color:red !important;
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
          <h1 class="h3 text-center mb-4">{{ __('Reset Password') }}</h1>
          <form action="{{ route('password.update') }}" method="POST">
            @csrf
            @if(Session::has('status'))
              <div class="alert alert-green-300 text-green-500 p-1 my-2 px-2">{{ session('status') }}</div>
            @endif
            @if(Session::has('error'))
              <div class="alert alert-green-300 text-green-500 p-1 my-2 px-2">{{ session('error') }}</div>
            @endif
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <div class="mb-3">
              <label for="" class="">Password</label>
              <input
                type="password"
                class="form-control @error('password') not-valid  @enderror"
                name="password"
              />
              @error('password')<span class="text-red-500" >{{ $message }}</span>@enderror
            </div>

            <div class="mb-3">
              <label class="">Password Confirmation</label>
              <input
                type="password"
                class="form-control @error('password') not-valid  @enderror"
                name="password_confirmation"
              />
              @error('password')<span class="text-red-500" >{{ $message }}</span>@enderror
            </div>

            <button
              type="submit"
              class="btn btn-login my-3 shadow-sm"
              style="font-size: 18px"
              >{{ __('Reset Password') }}
            </button>
          </form>
        </div>
      </div>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
  </body>
</html>

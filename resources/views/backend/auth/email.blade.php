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
      textarea:focus,
      textarea.form-control:focus,
      input.form-control:focus,
      input[type="text"]:focus,
      input[type="password"]:focus,
      input[type="email"]:focus,
      input[type="number"]:focus,
      [type="text"].form-control:focus,
      [type="password"].form-control:focus,
      [type="email"].form-control:focus,
      [type="tel"].form-control:focus,
      [contenteditable].form-control:focus {
        outline: none;
        box-shadow: none !important;
        border: 1px solid #ccc !important;
        border-left: none !important;
      }
      textarea,
      textarea.form-control,
      input.form-control,
      input[type="text"],
      input[type="password"],
      input[type="email"],
      input[type="number"],
      [type="text"].form-control,
      [type="password"].form-control,
      [type="email"].form-control,
      [type="tel"].form-control,
      [contenteditable].form-control {
        border-left: none;
      }
      .input-group-text {
        border-right: none;
        background-color: #fff;
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
          <form action="{{ route('admin.password.email') }}" method="POST">
            @csrf
            @if(Session::has('status'))
              <div class="alert alert-green-200 text-green-500 p-1 my-1">{{ session('status') }}</div>
            @endif
            @if(Session::has('error'))
              <div class="alert alert-danger p-1 my-1">{{ session('error') }}</div>
            @endif
            @if ($errors->any())
                <div class="mt-0 mb-3 alert alert-danger p-1">
                    <ul class="m-0 p-0" style="list-style-type:none;" >
                        @foreach ($errors->all() as $error)
                            <li> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @else
            <div class="mb-3 mt-0"></div>
            @endif
            <div class="input-group mb-3">
              <span class="input-group-text @error('email') not-valid @enderror" id="basic-addon1"
                ><i class="fas fa-at"></i
              ></span>
              <input
                type="text"
                class="form-control @error('email') not-valid @enderror"
                placeholder="email"
                name="email"
                aria-label="email"
                aria-describedby="basic-addon1"
              />
            </div>
            <button
              class="btn btn-login mb-3 mt-1 shadow-sm"
              style="font-size: 18px; width:100%"
              >{{ __('Send reset link') }}
            </button>
          </form>
          <a href="{{ route('admin.login.form') }}" class="text-decoration-none">{{ __('Login') }}</a>
        </div>
      </div>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
  </body>
</html>

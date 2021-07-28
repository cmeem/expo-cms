
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

    </style>
    <title>Virify</title>
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
            <form action="{{ route('verification.resend') }}" method="POST">
            @csrf
            @if (session('resent'))
            <div class="alert alert-green-300 text-green-500 p-1 my-1 px-2 rounded-5" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
            @endif

            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email') }},

            <button role="submit"
                class="btn btn-login  my-3 shadow-sm"
                style="font-size: 18px"
                >{{ __('click here to request another') }}
            </button>
            </form>

            <div class="d-flex justify-content-between">
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

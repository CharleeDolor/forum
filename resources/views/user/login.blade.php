@extends('layouts.user')

@section('content')
    <style>
        body {
            background: linear-gradient(to bottom, #007BFF, #FFFFFF);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        .inputType {
            height: 50px;
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 16px;
        }

        .error-container {
            max-width: 400px;
            width: 100%;
            margin: 0 auto 20px auto;
            padding: 0 15px;
        }

        .alert {
            margin-bottom: 20px;
        }

        .login-container {
            background: white;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        .login-form h1 {
            margin-bottom: 30px;
            color: #007BFF;
        }

        .login-form a {
            margin-top: 15px;
            display: block;
            color: #007BFF;
            text-decoration: none;
        }

        .login-form a:hover {
            text-decoration: underline;
        }

        .btn-success {
            width: 100%;
            padding: 15px;
            border-radius: 4px;
            font-size: 18px;
            box-shadow: rgba(45, 35, 66, 0.4) 0 2px 4px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
            background-color: #007BFF;
            border: none;
            color: white;
            cursor: pointer;
            border: 2px solid #000000;
}
 

        .btn-success:hover {
            background: linear-gradient(to bottom, #04bade, white);
            color: black;
        }

        .close {
            background: none;
            border: none;
            font-size: 1.5rem;
            position: absolute;
            top: 10px;
            right: 15px;
            cursor: pointer;
        }

        .fade {
            opacity: 1;
            transition: opacity 0.15s linear;
        }

        .show {
            display: block;
        }

        .alert-dismissible {
            position: relative;
        }
    </style>

    <div class="error-container">
        @if (\Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" id="success-alert">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>{!! \Session::get('success') !!}</strong> Login using your email and password
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <span><strong>{{ $message }}</strong></span>
            </div>
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <span><strong>{{ $error }}</strong></span>
                </div>
            @endforeach
        @endif
    </div>

    <div class="login-container">
        <form action="{{ route('auth.doLogin') }}" method="POST" class="login-form">
            <h1>Login</h1>
            @csrf
            <input type="email" class="inputType" name="email" id="email" placeholder="Email address" value="{{ old('email') }}" required>
            <input type="password" class="inputType" name="password" id="password" placeholder="Password" required>
            <input type="submit" value="Login" class="btn btn-success">
            <a href="{{ route('user.create') }}">Create an account</a>
        </form>
    </div>
@endsection

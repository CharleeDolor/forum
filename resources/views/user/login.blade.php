@extends('layouts.user')


@section('content')
    <style>
        .inputType {
            height: 50px;
            width: 300px;
        }

        .error-container {
            left: 0;
            right: 0;

            margin-left: auto;
            margin-right: auto;

            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }
    </style>

    <div class="error-container w-25 m-3">
        @if (\Session::has('success'))
            <div class="alert alert-success alert-block alert-dismissible fade show m-3" id="success-alert">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong> {!! \Session::get('success') !!} </strong> Login using your email and password
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible fade show alert-block m-3">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <span class="p-4"><strong>{{ $message }}</strong></span>
            </div>
        @endif
        @if ($errors->any())
            {!! implode(
                '',
                $errors->all(
                    "<div class='alert alert-danger alert-dismissible fade show alert-block m-3'>
                                        <span class='p-4'><strong>:message</strong></span>
                                        <button type='button' class='close' data-dismiss='alert'>x</button>
                                    </div>",
                ),
            ) !!}
        @endif
    </div>
    <div class="d-flex align-items-center justify-content-center min-vh-100 flex-column">

        <div class="p-2">
            <form action="{{ route('auth.doLogin') }}" method="POST">
                <div class=" d-flex align-items-center justify-content-center flex-column p-lg-5 bg-white rounded">
                    <div class="p-2">
                        <h1>Login</h1>
                    </div>
                    @csrf
                    <input type="email" class="inputType" name="email" id="email" placeholder="Email address"
                        value="{{ old('email') }}">
                    <br>
                    <input type="password" class="inputType" name="password" id="password" placeholder="password"
                        value="{{ old('password') }}">
                    <br>
                    <input type="submit" value="Login" class="btn btn-success">
                    <a href="{{ route('user.create') }}">Create an account</a>
                </div>
            </form>
        </div>
    </div>

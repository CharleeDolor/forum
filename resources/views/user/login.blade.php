@extends('layouts.user')


@section('content')
<style>
    .inputType{
        height: 50px;
        width: 300px;
    }
</style>
    <div class="d-flex align-items-center justify-content-center min-vh-100 flex-column">
        @if (\Session::has('success'))
            <div class="alert alert-success fixed-top" id="success-alert">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong> {!! \Session::get('success') !!} </strong> Login using your email and password
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif

        <?php
        
        
        ?>

        <div class="p-2">
            <form action="{{ route('auth.doLogin') }}" method="POST">
                <div class=" d-flex align-items-center justify-content-center flex-column p-lg-5 bg-white rounded">
                    <div class="p-2">
                        <h1>Login</h1>
                    </div>
                    @csrf
                    <input type="email" class="inputType" name="email" id="email" placeholder="Email address">
                    <br>
                    <input type="password" class="inputType" name="password" id="password" placeholder="password">
                    <br>
                    <input type="submit" value="Login" class="btn btn-success">
                    <a href="{{ route('user.create') }}">Create an account</a>
                </div>
            </form>
        </div>
    </div>

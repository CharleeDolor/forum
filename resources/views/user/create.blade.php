@extends('layouts.user')

@section('content')

    <div class="d-flex align-items-center justify-content-center min-vh-100 flex-column">
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                {!! implode(
                    '',
                    $errors->all("
                                    <p><strong>:message</strong>
                                "),
                ) !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <form action="{{ route('user.store') }}" method="POST">
            @csrf
            <div class="d-flex align-items-center justify-content-center flex-column bg-white rounded p-lg-5">
                <h1>Create User</h1>
                @csrf

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" required placeholder="Name"
                        value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        id="email" aria-describedby="emailHelp" placeholder="Enter email" 
                        value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password" 
                        value="{{ old('password') }}">

                </div>
                <div class="d-flex justify-content-center flex-column">
                    <div><small>Atleast 6 characters long</small></div>
                    <div><small>Atleast one lower case letter</small></div>
                    <div><small>Atleast one upper case letter</small></div>
                    <div><small>Atleast one special character</small></div>
                    <div><small>Atleast one digit</small></div>
                </div>

                <div class="form-group">
                    <label for="password">Confirm Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password_confirmation" required autocomplete="current-password" 
                        value="{{ old('password_confirmation') }}">
                </div>


                <hr class="w-100 bg-dark" />
                <div class="form-group">
                    <input type="submit" value="Create Account" class="btn btn-success">
                </div>

                <div class="form-group">
                    <a href="{{ route('user.login') }}">Already have an account?</a>
                </div>
            </div>

        </form>
    </div>

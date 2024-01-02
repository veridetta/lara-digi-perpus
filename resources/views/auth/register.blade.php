@extends('layouts.templates.app', ['title' => 'Register'])

@section('content')

<div class="col-md-8">
    <div class="card border-0 shadow rounded">
        <div class="card-body">
            <h4 class="font-weight-bold">REGISTER</h4>
            <hr>
            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label font-weight-bold text-uppercase">Full Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter Full Name">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label font-weight-bold text-uppercase">Email address</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter Email Address">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="password" class="form-label font-weight-bold text-uppercase">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Enter Password">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label font-weight-bold text-uppercase">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Enter Confirm Password">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-info col-12">REGISTER</button>
            </form>
        </div>
    </div>
    <div class="login mt-3 text-center">
        <p>Already have an account? Login <a href="/login">here</a></p>
    </div>
</div>

@endsection

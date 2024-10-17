<!-- resources/views/auth/reset-password-code.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container position-sticky z-index-sticky top-0">
    <div class="row">
        <div class="col-12">
            @include('layouts.navbars.guest.navbar')
        </div>
    </div>
</div>
<main class="main-content mt-0">
    <section>
        <div class="page-header min-vh-100">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-start">
                                <h4 class="font-weight-bolder">Verify Your Code</h4>
                                <p class="mb-0">Enter the reset code sent to your email.</p>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('reset.password.verify') }}">
                                    @csrf
                                    <div class="flex flex-col mb-3">
                                        <input type="email" name="email" class="form-control form-control-lg" placeholder="Email" value="{{ old('email') }}" required>
                                    </div>
                                    <div class="flex flex-col mb-3">
                                        <input type="text" name="code" class="form-control form-control-lg" placeholder="Reset Code" required>
                                        @error('code') <p class="text-danger text-xs pt-1">{{ $message }}</p>@enderror
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Verify Code</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

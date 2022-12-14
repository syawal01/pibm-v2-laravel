@extends('layouts.auth')

@section('content')
<div class="page page-center">
    <div class="container-tight py-4">
        <div class="text-center mb-2">
            <a href="." class="navbar-brand"><img src="{{ asset('images/logo.png') }}" alt="SMK Logo" height="150"></a>
        </div>

        @include('partials.alert')

        <form class="card card-md form-disable" action="{{ route('login') }}" method="post">
            @csrf

            <div class="card-body">
                <h2 class="card-title text-center mb-4">eLearning SMK Negeri 1 Stabat</h2>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" autofocus
                        class="form-control @error('email') is-invalid is-invalid-lite @enderror"
                        autocomplete="email-login" name="email" value="{{ old('email') }}"
                        placeholder="Email address anda">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-2">
                    <label class="form-label">
                        Password
                    </label>
                    <div>

                        <div class="input-group input-group-flat">
                            <input type="password"
                                class="form-control @error('password') is-invalid is-invalid-lite @enderror"
                                placeholder="Password" autocomplete="off" name="password" id="password">
                            <span class="input-group-text">
                                <a href="#" data-input-password-target="#password"
                                    class="btn-show-password link-secondary" title="Show password"
                                    data-bs-toggle="tooltip">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <circle cx="12" cy="12" r="2" />
                                        <path
                                            d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" />
                                    </svg>
                                </a>
                            </span>
                        </div>
                        @error('password')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="mb-2">
                    <label class="form-check">
                        <input type="checkbox" class="form-check-input" name="remember" />
                        <span class="form-check-label">Ingatkan aku di perangkat ini</span>
                    </label>
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Masuk </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
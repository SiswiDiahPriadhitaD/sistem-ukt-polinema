@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="display-4">Ubah Profile</h1>
        </div>
        <div class="section-body">
            <h2 class="section-title">Hi, {{ Auth::user()->name }}!</h2>
            <p class="section-lead">
                Informasi.
            </p>

            <div class="row mt-4">
                <div class="col-12 col-md-5 mb-4">
                    <div class="card shadow-sm">
                        <form method="POST" action="{{ route('user-password.update') }}" class="needs-validation"
                            novalidate="">
                            @csrf
                            @method('PUT')
                            <div class="card-header bg-gradient-primary text-white text-center font-weight-bold"
                                style="font-size: 1.5em;">
                                Edit Password
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="current_password">Current Password</label>
                                    <input id="current_password" type="password"
                                        class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                                        name="current_password" required>
                                    @error('current_password', 'updatePassword')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                                        name="password" required>
                                    @error('password', 'updatePassword')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Password Confirmation</label>
                                    <input id="password_confirmation" type="password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        name="password_confirmation" required>
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary" type="submit">Ubah Password</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-md-7">
                    <div class="card shadow-sm mb-4">
                        <form method="POST" action="{{ route('user-profile-information.update') }}"
                            class="needs-validation" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="card-header bg-gradient-primary text-white text-center font-weight-bold"
                                style="font-size: 1.5em;">
                                Edit Auth
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Name</label>
                                        <input id="name" name="name" type="text"
                                            class="form-control @error('name', 'updateProfileInformation') is-invalid @enderror"
                                            value="{{ Auth::user()->name }}" required>
                                        @error('name', 'updateProfileInformation')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email">Email</label>
                                        <input id="email" name="email" type="email"
                                            class="form-control @error('email', 'updateProfileInformation') is-invalid @enderror"
                                            value="{{ Auth::user()->email }}" required>
                                        @error('email', 'updateProfileInformation')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary" type="submit">Ubah Profile</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@push('customScript')
    <script src="/assets/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                iziToast.success({
                    title: 'Success',
                    message: '{{ session('success') }}',
                    position: 'topRight'
                });
            @endif

            @if (session('error'))
                iziToast.error({
                    title: 'Error',
                    message: '{{ session('error') }}',
                    position: 'topRight'
                });
            @endif
        });
    </script>
@endpush
@push('customStyle')
    <link rel="stylesheet" href="/assets/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
    <style>
        .profile-widget {
            border: 1px solid #e3e6f0;
            border-radius: .35rem;
        }

        .profile-widget-header {
            background-color: #f8f9fc;
        }

        .profile-widget-picture {
            width: 100px;
            height: 100px;
        }

        .profile-widget-name {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .card-header.bg-primary {
            background-color: #4e73df !important;
        }

        .bg-gradient-primary {
            background: linear-gradient(45deg, #007bff, #0056b3);
        }

        .card {
            border-radius: 1rem;
        }

        .card-header {
            border-radius: 1rem 1rem 0 0;
        }
    </style>
@endpush

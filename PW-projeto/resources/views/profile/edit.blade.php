@extends('layouts.autenticado')

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Profile') }}
    </h2>
</x-slot>

@section('main-content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Update Profile Information</h3>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Update Password</h3>
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Delete User</h3>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
@endsection

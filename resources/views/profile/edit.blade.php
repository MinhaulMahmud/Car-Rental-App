@extends('layouts.app')

@section('title')
    {{ __('Profile') }}
@endsection

@section('content')
    <x-slot name="header">
        <h2 class="font-weight-bold text-xl text-dark">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container">
             <!-- Update Profile Information Form -->
            <div class="mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            <!-- Update Password Form -->
            <div class="mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            <!-- Delete User Form -->
            <div class="mb-4">
                <div class="card shadow-sm">
                     <div class="card-body">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('user.layouts.user')

@section('title', 'Settings')

@section('content')
<div class="bg-white p-6 shadow-md rounded-md">
    <h2 class="text-2xl font-bold mb-4">Account Settings</h2>

    <!-- Profile Update Section -->
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('patch')

        <!-- Profile Picture -->
        <div class="flex items-center space-x-4">
            <img src="{{ asset(Auth::user()->profile_picture ?? 'default-avatar.png') }}" alt="Profile Picture" class="w-16 h-16 rounded-full border">
            {{-- <input type="file" name="profile_picture" class="block w-full text-gray-700 border p-2 rounded-md"> --}}
        </div>

        <!-- Name -->
        <div>
            <label class="block font-bold">Full Name</label>
            <input type="text" name="name" value="{{ Auth::user()->name }}" class="w-full p-2 border rounded-md">
        </div>

        <!-- Email -->
        <div>
            <label class="block font-bold">Email</label>
             <label class="block font-bold">{{ Auth::user()->email }}</label>
            {{-- <input type="email" name="email" value="{{ Auth::user()->email }}" class="w-full p-2 border rounded-md"> --}}
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Update Profile</button>
    </form>

    <!-- Password Update Section -->
    <div class="mt-8">
        <h3 class="text-xl font-bold mb-2">Change Password</h3>
        <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Current Password -->
            <div>
                <label class="block font-bold">Current Password</label>
                <input type="password" name="current_password" class="w-full p-2 border rounded-md">
            </div>

            <!-- New Password -->
            <div>
                <label class="block font-bold">New Password</label>
                <input type="password" name="new_password" class="w-full p-2 border rounded-md">
            </div>

            <!-- Confirm New Password -->
            <div>
                <label class="block font-bold">Confirm New Password</label>
                <input type="password" name="new_password_confirmation" class="w-full p-2 border rounded-md">
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md">Update Password</button>
        </form>
    </div>
</div>
@endsection

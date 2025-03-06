<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MailWave')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <style>
        :root {
            --primary-color: #4F46E5;
        }
        .active {
            background-color: var(--primary-color);
            color: white;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        @include('user.components.sidebar')
        <div class="flex flex-col flex-1">
            @include('user.components.navbar')
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
{{-- 
├── resources/views/user/
│   ├── layouts/
│   │   ├── user.blade.php   <!-- Main layout for user pages -->
│   ├── components/
│   │   ├── sidebar.blade.php <!-- Sidebar component -->
│   │   ├── navbar.blade.php  <!-- Navbar component -->
│   ├── dashboard/
│   │   ├── index.blade.php  <!-- User dashboard -->
│   │   ├── subscribe.blade.php  <!-- Subscription page -->
│   │   ├── campaigns.blade.php  <!-- Campaigns page -->
│   │   ├── settings.blade.php  <!-- User settings page -->
│   │   ├── bulk-email.blade.php <!-- Bulk Email Page -->

<!-- Layout File (resources/views/user/layouts/user.blade.php) -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MailWave')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <style>
        :root {
            --primary-color: #4F46E5;
        }
        .active {
            background-color: var(--primary-color);
            color: white;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        @include('user.components.sidebar')
        <div class="flex flex-col flex-1">
            @include('user.components.navbar')
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>

<!-- Sidebar Component (resources/views/user/components/sidebar.blade.php) -->
<div class="w-64 bg-white shadow-md h-full hidden md:block">
    <div class="p-6 text-xl font-bold text-gray-700" style="color: var(--primary-color);">MailWave</div>
    <ul class="mt-6">
        <li class="p-3 hover:bg-gray-200"><a href="{{ route('dashboard') }}" class="flex items-center"><i class="fas fa-home mr-2"></i> Dashboard</a></li>
        <li class="p-3 hover:bg-gray-200"><a href="{{ route('subscribe') }}" class="flex items-center"><i class="fas fa-user-plus mr-2"></i> Subscriptions</a></li>
        <li class="p-3 hover:bg-gray-200"><a href="{{ route('campaigns') }}" class="flex items-center"><i class="fas fa-envelope mr-2"></i> Campaigns</a></li>
        <li class="p-3 hover:bg-gray-200"><a href="{{ route('bulk-email') }}" class="flex items-center"><i class="fas fa-paper-plane mr-2"></i> Bulk Email</a></li>
        <li class="p-3 hover:bg-gray-200"><a href="{{ route('settings') }}" class="flex items-center"><i class="fas fa-cog mr-2"></i> Settings</a></li>
    </ul>
</div>

<!-- Navbar Component (resources/views/user/components/navbar.blade.php) -->
<div class="bg-white shadow-md p-4 flex justify-between items-center">
    <button class="md:hidden" onclick="document.getElementById('sidebar').classList.toggle('hidden')">
        ☰
    </button>
    <h1 class="text-lg font-bold" style="color: var(--primary-color);">@yield('title', 'MailWave')</h1>
    <div>
        <a href="{{ route('logout') }}" class="text-red-500">Logout</a>
    </div>
</div>

<!-- Bulk Email Page (resources/views/user/dashboard/bulk-email.blade.php) -->
@extends('user.layouts.user')
@section('title', 'Send Bulk Emails')
@section('content')
<div class="bg-white p-6 shadow-md rounded-md">
    <h2 class="text-2xl font-bold">Send Bulk Emails</h2>
    <p class="mt-2 text-gray-600">Compose and send bulk emails to your subscribers.</p>
    <form class="mt-4">
        <label class="block font-bold">Subject</label>
        <input type="text" class="w-full p-2 border rounded-md" placeholder="Enter subject">
        <label class="block font-bold mt-3">Recipients</label>
        <textarea class="w-full p-2 border rounded-md" placeholder="Enter emails separated by commas"></textarea>
        <label class="block font-bold mt-3">Message</label>
        <textarea class="w-full p-2 border rounded-md" placeholder="Write your message here"></textarea>
        <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-md">Send Emails</button>
    </form>
</div>
@endsection

<!-- Dashboard Page (resources/views/user/dashboard/index.blade.php) -->
@extends('user.layouts.user')
@section('title', 'Dashboard')
@section('content')
<div class="bg-white p-6 shadow-md rounded-md">
    <h2 class="text-2xl font-bold">Welcome to MailWave</h2>
    <p class="mt-2 text-gray-600">Manage your email campaigns easily.</p>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
        <div class="bg-blue-500 text-white p-4 rounded-md shadow-md">
            <h3 class="text-lg font-bold">Total Subscribers</h3>
            <p class="text-2xl">1,200</p>
        </div>
        <div class="bg-green-500 text-white p-4 rounded-md shadow-md">
            <h3 class="text-lg font-bold">Campaigns Sent</h3>
            <p class="text-2xl">45</p>
        </div>
        <div class="bg-red-500 text-white p-4 rounded-md shadow-md">
            <h3 class="text-lg font-bold">Emails Bounced</h3>
            <p class="text-2xl">12</p>
        </div>
    </div>
</div>


//settings 
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
            {{-- <input type="file" name="profile_picture" class="block w-full text-gray-700 border p-2 rounded-md"> 
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
            {{-- <input type="email" name="email" value="{{ Auth::user()->email }}" class="w-full p-2 border rounded-md"> 
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

//campaigns
@extends('user.layouts.user')
@section('title', 'campaigns')
@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow rounded">
    <h2 class="text-2xl font-bold mb-4">Send Bulk Emails</h2>

    @if(session('success'))
        <div class="p-2 bg-green-500 text-white">{{ session('success') }}</div>
    @endif

    <form  method="POST" enctype="multipart/form-data">
        @csrf
        <label class="block text-gray-700">Subject</label>
        <input type="text" name="subject" class="w-full p-2 border rounded" required>

        <label class="block text-gray-700 mt-4">Email Content (Plain)</label>
        <textarea name="content" class="w-full p-2 border rounded"></textarea>

        <label class="block text-gray-700 mt-4">Select Email Template</label>
        <select name="template" class="w-full p-2 border rounded">
            <option value="">No Template (Plain Text)</option>
            <option value="business">Business Template</option>
            <option value="promotion">Promotion Template</option>
        </select>

        <label class="block text-gray-700 mt-4">Emails (Comma-separated or Upload File)</label>
        <input type="text" name="emails" class="w-full p-2 border rounded mb-2">
        <input type="file" name="email_file" accept=".csv,.txt,.xlsx" class="w-full p-2 border rounded">

        <button type="submit" class="mt-4 bg-blue-500 text-white p-2 rounded">Send Emails</button>
    </form>
</div>
@endsection

@endsection --}}

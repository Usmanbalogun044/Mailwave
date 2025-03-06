 <html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MailWave')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    {{-- <style>
        :root {
            --primary-color: #4F46E5;
        }
        .active {
            background-color: var(--primary-color);
            color: white;
        }
    </style> --}}
</head>
<body class="bg-gray-100">
 <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-600 to-purple-700">
        <div class="w-full max-w-md bg-white shadow-lg rounded-2xl p-8">
            <div class="flex justify-center mb-6">
                <img src="/logo.png" alt="MailWave Logo" class="h-12">
            </div>
            <h2 class="text-2xl font-bold text-center text-gray-900">Welcome Back!</h2>
            <p class="text-sm text-center text-gray-500">Log in to continue</p>
            
            <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-4">
                @csrf
                
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input id="email" type="email" name="email" class="w-full px-4 py-2 mt-1 border rounded-lg focus:ring focus:ring-blue-300" required autofocus>
                </div>
                
                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" type="password" name="password" class="w-full px-4 py-2 mt-1 border rounded-lg focus:ring focus:ring-blue-300" required>
                </div>
                
                <!-- Remember Me & Forgot Password -->
                <div class="flex justify-between items-center text-sm">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600 focus:ring focus:ring-blue-300">
                        <span class="ml-2 text-gray-600">Remember me</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline">Forgot password?</a>
                </div>
                
                <!-- Submit Button -->
                <div>
                    <button type="submit" class="w-full py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">Login</button>
                </div>
            </form>

            <!-- Register Link -->
            <p class="mt-4 text-sm text-center text-gray-600">Don't have an account? 
                <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Sign up</a>
            </p>
        </div>
    </div>

  
</body>
</html>
 

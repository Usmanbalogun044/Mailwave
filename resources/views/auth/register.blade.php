 <html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MailWave')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
</head>
<body class="bg-gray-100">
 <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-600 to-purple-700">
        <div class="w-full max-w-md bg-white shadow-lg rounded-2xl p-8">
            <div class="flex justify-center mb-6">
                <img src="/logo.png" alt="MailWave Logo" class="h-12">
            </div>
            <h2 class="text-2xl font-bold text-center text-gray-900">Create an Account</h2>
            <p class="text-sm text-center text-gray-500">Sign up to start sending emails</p>
            
            <form method="POST" action="{{ route('register') }}" class="mt-6 space-y-4">
                @csrf
                
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input id="name" type="text" name="name" class="w-full px-4 py-2 mt-1 border rounded-lg focus:ring focus:ring-blue-300" required>
                </div>
                
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input id="email" type="email" name="email" class="w-full px-4 py-2 mt-1 border rounded-lg focus:ring focus:ring-blue-300" required>
                </div>
                
                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" type="password" name="password" class="w-full px-4 py-2 mt-1 border rounded-lg focus:ring focus:ring-blue-300" required>
                </div>
                
                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" class="w-full px-4 py-2 mt-1 border rounded-lg focus:ring focus:ring-blue-300" required>
                </div>
                
                <!-- Submit Button -->
                <div>
                    <button type="submit" class="w-full py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">Sign Up</button>
                </div>
            </form>

            <!-- Login Link -->
            <p class="mt-4 text-sm text-center text-gray-600">Already have an account? 
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a>
            </p>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold text-center text-gray-700">Register</h2>
        <form action="{{ route('api.register') }}" method="POST" class="mt-4">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-600">Name</label>
                <input type="text" id="name" name="name" 
                       class="w-full p-2 border border-gray-300 rounded mt-1" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-600">Email</label>
                <input type="email" id="email" name="email" 
                       class="w-full p-2 border border-gray-300 rounded mt-1" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-600">Password</label>
                <input type="password" id="password" name="password" 
                       class="w-full p-2 border border-gray-300 rounded mt-1" required>
            </div>
            <button type="submit" 
                    class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">
                Register
            </button>
        </form>
    </div>
</body>
</html>
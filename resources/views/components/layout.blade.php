<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My App</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-2xl font-bold text-gray-700">---Task-Manager---</a>
            <div>
                @guest
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 px-4">Login</a>
                    <a href="{{ route('register') }}" class="text-gray-600 hover:text-blue-600 px-4">Register</a>
                @else
                    <a href="{{ route('tasks.store') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add a Task</a>
                    <a href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                       class="text-red-600 hover:text-red-800 px-4">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                @endguest
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-600 transition">
                            Admin Dashboard
                        </a>
                    @endif
                @endauth


            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container mx-auto mt-6">
        @yield('content')
    </div>

    <div class="container mx-auto mt-4 relative">
        @if (session('success'))
            <div 
                x-data="{ show: true }" 
                x-init="setTimeout(() => show = false, 5000)" 
                x-show="show" 
                class="bg-green-500 text-white px-4 py-2 rounded-md mb-4 transition-opacity duration-500 ease-in-out w-fit absolute right-0"
            >
                {{ session('success') }}
            </div>
        @endif
    </div>

</body>
</html>


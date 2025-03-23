@section('components.layout')
<div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold text-gray-700 text-center">Forgot Password</h2>
    <p class="text-gray-600 text-center">Enter your email to receive a password reset link.</p>

    @if (session('status'))
        <div class="bg-green-200 text-green-700 p-2 mt-4 rounded">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="mt-4">
        @csrf
        <div>
            <label for="email" class="block text-gray-700">Email Address</label>
            <input type="email" id="email" name="email" required
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-300">
            
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg mt-4 hover:bg-blue-700">
            Send Password Reset Link
        </button>
    </form>
</div>
@endsection
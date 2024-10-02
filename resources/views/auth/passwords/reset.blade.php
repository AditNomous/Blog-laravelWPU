@vite('resources/css/app.css', 'resources/js/app.js')
<div class="h-screen flex items-center" >
<form method="POST" action="{{ route('password.update') }}" class=" max-w-md mx-auto p-6 bg-white shadow-md rounded-lg">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <div class="mb-4">
        <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
    </div>

    <div class="mb-4">
        <label for="password" class="block text-gray-700 font-bold mb-2">Password:</label>
        <input type="password" id="password" name="password" required
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
    </div>

    <div class="mb-6">
        <label for="password_confirmation" class="block text-gray-700 font-bold mb-2">Confirm Password:</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
    </div>

    <div class="flex justify-center">
        <button type="submit"
                class="bg-indigo-500 text-white px-6 py-2 rounded-lg hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            Reset Password
        </button>
    </div>
</form>
<div
@extends('layouts.layout')
@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md max-w-lg mx-auto">

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold mb-2">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('email')a
                    <span class="text-red-500 text-sm">{{ $errors->get('email')[0] }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                <input type="password" id="password" name="password" required autocomplete="current-password"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('password')
                    <span class="text-red-500 text-sm">{{ $errors->get('password')[0] }}</span>
                @enderror
            </div>
            <div class="mb-4 flex items-center justify-between">
                <div>
                    <input type="checkbox" id="remember" name="remember"
                           class="mr-2 rounded border-gray-300 text-blue-500 focus:ring-blue-500">
                    <label for="remember" class="text-gray-700 text-sm">Remember Me</label>
                </div>
                <a href="{{ route('password.request') }}" class="text-blue-500 text-sm">Forgot Password?</a>
            </div>
            <button type="submit"
                    class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition">
                Login
            </button>
        </form>
    </div>
@endsection
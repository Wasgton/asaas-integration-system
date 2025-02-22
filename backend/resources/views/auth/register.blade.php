@extends('layouts.layout')
@section('content')
<div class="bg-white p-6 rounded-lg shadow-md max-w-lg mx-auto">
    <form method="POST" action="{{ route('register') }}">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
                <input id="name"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"/>
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $errors->get('name')[0] }}</p>
                @enderror
            </div>
    
            <div class="mt-4">
                <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
                <input id="email"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       type="email" name="email" value="{{ old('email') }}" required autocomplete="username"/>
                @error('email')
                <p class="mt-2 text-sm text-red-600">{{ $errors->get('email')[0] }}</p>
                @enderror
            </div>
    
            <div class="mt-4">
                <label for="password" class="block text-sm font-medium text-gray-700">{{ __('Password') }}</label>
                <input id="password"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       type="password" name="password" required autocomplete="new-password"/>
                @error('password')
                <p class="mt-2 text-sm text-red-600">{{ $errors->get('password')[0] }}</p>
                @enderror
            </div>
    
            <div class="mt-4">
                <label for="password_confirmation"
                       class="block text-sm font-medium text-gray-700">{{ __('Confirm Password') }}</label>
                <input id="password_confirmation"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       type="password" name="password_confirmation" required autocomplete="new-password"/>
                @error('password_confirmation')
                <p class="mt-2 text-sm text-red-600">{{ $errors->get('password_confirmation')[0] }}</p>
                @enderror
            </div>
    
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                   href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
    
                <button type="submit"
                        class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition">
                    {{ __('Register') }}
                </button>
            </div>
        </form>
</div>
@endsection
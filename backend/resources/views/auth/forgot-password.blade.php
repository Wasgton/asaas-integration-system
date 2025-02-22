<div class="mb-4 text-sm text-gray-600">
    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
</div>

<!-- Session Status -->
@if (session('status'))
    <div class="mb-4 text-sm text-green-600">
        {{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <!-- Email Address -->
    <div>
        <label for="email" class="block font-medium text-sm text-gray-700">
            {{ __('Email') }}
        </label>
        <input id="email"
               class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
               type="email" name="email" value="{{ old('email') }}" required autofocus>
        @error('email')
        <div class="mt-2 text-sm text-red-600">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="flex items-center justify-end mt-4">
        <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            {{ __('Email Password Reset Link') }}
        </button>
    </div>
</form>
<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de pagamento</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 font-sans flex flex-col min-h-screen justify-between">

<header class="flex bg-blue-600 text-white p-4 shadow-md justify-between w-full">    
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-lg font-bold">
            <a href="{{route('index')}}">Sistema de pagamento</a>
        </h1>
    </div>
    @guest
    <div class="container mx-auto flex items-center justify-end space-x-4">
        <a href="{{ route('login') }}" class="text-white hover:text-blue-500">Login</a>
        <a href="{{ route('register') }}" class="text-white hover:text-blue-500">Registrar</a>
    </div>
    @endguest
    @auth
        <div class="container mx-auto flex items-center justify-end space-x-4">
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="text-white hover:text-blue-500">Logout</button>
            </form>
        </div>
    @endauth
</header>
<main class="container mx-auto mt-10">
    @yield('content')
</main>

<footer class="bg-gray-800 text-white py-4 mt-10">
    <div class="container mx-auto text-center">
        <p class="text-sm">&copy;Todos os direitos reservados.</p>
    </div>
</footer>

@vite(['resources/js/app.js'])
</body>
</html>
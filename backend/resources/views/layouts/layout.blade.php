<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Pagamento</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 font-sans flex flex-col min-h-screen justify-between">

<header class="bg-blue-600 text-white p-4 shadow-md">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-lg font-bold">Página de Pagamento</h1>
    </div>
</header>

<main class="container mx-auto mt-10 ">
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
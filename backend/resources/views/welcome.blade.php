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
    <div class="bg-white p-6 rounded-lg shadow-md max-w-lg mx-auto">
        <h2 class="text-2xl font-bold mb-4 text-gray-700">Escolha o Método de Pagamento</h2>
        <form action="#" method="POST">
            @method('post')
            @csrf
            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Opção de Pagamento:</label>
                <div class="space-y-2">
                    <div>
                        <input type="radio" id="boleto" name="payment_method" value="boleto" class="mr-2">
                        <label for="boleto" class="text-gray-600">Boleto</label>
                    </div>
                    <div>
                        <input type="radio" id="cartao" name="payment_method" value="cartao" class="mr-2">
                        <label for="cartao" class="text-gray-600">Cartão</label>
                    </div>
                    <div>
                        <input type="radio" id="pix" name="payment_method" value="pix" class="mr-2">
                        <label for="pix" class="text-gray-600">Pix</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Confirmar Pagamento
            </button>
        </form>
    </div>
</main>

<footer class="bg-gray-800 text-white py-4 mt-10">
    <div class="container mx-auto text-center">
        <p class="text-sm">&copy;Todos os direitos reservados.</p>
    </div>
</footer>

@vite(['resources/js/app.js'])
</body>
</html>
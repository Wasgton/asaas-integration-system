@extends('layouts.layout')
@section('content')
<div class="bg-white p-6 rounded-lg shadow-md mx-auto">
    <h2 class="text-2xl font-bold mb-4 text-gray-700">Pagamento</h2>
    <form action="{{route('payment')}}" method="POST">
        @method('post')
        @csrf
        <div id="content" class="w-full flex flex-row space-x-4 justify-between">
            <div id="customerInfo" class="w-1/2 ">
                <div>
                    <div id="clientInfo" class="flex flex-col">
                        <label class="block text-gray-700 font-medium mb-2">Dados do Cliente: </label>
                        <div>
                            <input type="text" name="value" placeholder="Valor" class="w-full border rounded px-3 py-2 mb-3">
                        </div>
                        <div>
                            <input type="text" name="customer[name]" placeholder="Nome" class="w-full border rounded px-3 py-2 mb-3">
                        </div>
                        <div>
                            <input type="email" name="customer[email]" placeholder="E-mail" class="w-full border rounded px-3 py-2 mb-3">
                        </div>
                        <div>
                            <input type="text" name="customer[document]" placeholder="CPF/CNPJ" class="w-full border rounded px-3 py-2 mb-3">
                        </div>
                    </div>
                    <label class="block text-gray-700 font-medium mb-2">Opção de Pagamento:</label>
                    <div id="paymentType" class="flex justify-around">
                        <div class="flex items-center mx-2">
                            <input type="radio" id="boleto" name="billingType" value="BOLETO" class="mr-2">
                            <label for="boleto" class="text-gray-600">Boleto</label>
                        </div>
                        <div class="flex items-center mx-2">
                            <input type="radio" id="cartao" name="billingType" value="CARTAO_CREDITO" class="mr-2">
                            <label for="cartao" class="text-gray-600">Cartão</label>
                        </div>
                        <div class="flex items-center mx-2">
                            <input type="radio" id="pix" name="billingType" value="PIX" class="mr-2">
                            <label for="pix" class="text-gray-600">Pix</label>
                        </div>
                    </div>
                </div>
            </div>
            <div id="creditCardHolderInfo" class="hidden w-1/2">
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Informações do Cartão de Crédito:</label>
                    <div>
                        <input type="text" name="creditCard[holderName]" placeholder="Nome do Titular"
                               class="w-full border rounded px-3 py-2 mb-3">
                    </div>
                    <div>
                        <input type="text" name="creditCard[number]" placeholder="Número do Cartão"
                               class="w-full border rounded px-3 py-2 mb-3">
                    </div>
                    <div>
                        <input type="text" name="creditCard[expiryMonth]" placeholder="Mês de Expiração (MM)"
                               class="w-full border rounded px-3 py-2 mb-3">
                    </div>
                    <div>
                        <input type="text" name="creditCard[expiryYear]" placeholder="Ano de Expiração (YYYY)"
                               class="w-full border rounded px-3 py-2 mb-3">
                    </div>
                    <div>
                        <input type="text" name="creditCard[ccv]" placeholder="Código de Segurança (CCV)"
                               class="w-full border rounded px-3 py-2 mb-3">
                    </div>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Informações do Titular do Cartão:</label>
                    <div>
                        <input type="text" name="creditCardHolderInfo[name]" placeholder="Nome"
                               class="w-full border rounded px-3 py-2 mb-3">
                    </div>
                    <div>
                        <input type="email" name="creditCardHolderInfo[email]" placeholder="E-mail"
                               class="w-full border rounded px-3 py-2 mb-3">
                    </div>
                    <div>
                        <input type="text" name="creditCardHolderInfo[cpfCnpj]" placeholder="CPF/CNPJ"
                               class="w-full border rounded px-3 py-2 mb-3">
                    </div>
                    <div>
                        <input type="text" name="creditCardHolderInfo[postalCode]" placeholder="CEP"
                               class="w-full border rounded px-3 py-2 mb-3">
                    </div>
                    <div>
                        <input type="text" name="creditCardHolderInfo[addressNumber]"
                               placeholder="Número do Endereço"
                               class="w-full border rounded px-3 py-2 mb-3">
                    </div>
                    <div>
                        <input type="text" name="creditCardHolderInfo[addressComplement]" placeholder="Complemento"
                               class="w-full border rounded px-3 py-2 mb-3">
                    </div>
                    <div>
                        <input type="text" name="creditCardHolderInfo[phone]" placeholder="Telefone"
                               class="w-full border rounded px-3 py-2 mb-3">
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Confirmar Pagamento
        </button>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cartaoInput = document.getElementById('cartao');
        const creditCardHolderInfo = document.getElementById('creditCardHolderInfo');

        document.querySelectorAll('input[name="billingType"]').forEach(function (input) {
            input.addEventListener('change', function () {
                if (cartaoInput.checked) {
                    creditCardHolderInfo.classList.remove('hidden');
                } else {
                    creditCardHolderInfo.classList.add('hidden');
                }
            });
        });
    });
</script>
@endsection
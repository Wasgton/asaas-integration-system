@extends('layouts.layout')
@section('content')
    @if($errors->has('error'))
        <div class="text-red-600 w-full border rounded px-3 py-2 mb-3">
            <p class="mt-2 text-lg text-red-600">{{  $errors->first('error') }}</p>
        </div>
    @endif
    <div class="bg-white p-6 rounded-lg shadow-md mx-auto">
        <h2 class="text-2xl font-bold mb-4 text-gray-700">Pagamento</h2>
        <form action="{{route('payment')}}" method="POST">
            @method('post')
            @csrf
            <div id="content" class="flex flex-row space-x-4 justify-between">
                <div id="customerInfo" class="w-1/2 ">
                    <div>
                        <div id="clientInfo" class="flex flex-col">
                            <label class="block text-gray-700 font-medium mb-2">Dados do Cliente: </label>
                            <div>
                                @error('value')
                                <p class="mt-2 text-sm text-red-600">{{ $errors->get('value')[0] }}</p>
                                @enderror
                                <input type="text"
                                       name="value"
                                       value="{{old('value')}}"
                                       placeholder="Valor"
                                       class="{{$errors->has('value') ? 'border-red-900' :''}} w-full border rounded px-3 py-2 mb-3">
                            </div>
                            <div>
                                @error('customer.name')
                                <p class="mt-2 text-sm text-red-600">{{ $errors->get('customer.name')[0] }}</p>
                                @enderror
                                <input type="text"
                                       name="customer[name]"
                                       placeholder="Nome"
                                       @if($user->customer)
                                           value="{{$user->customer->name}}"
                                       @else
                                           value="{{old('customer.name')}}"
                                       @endif
                                       class="{{$errors->has('customer.name') ? 'border-red-900' :''}} w-full border rounded px-3 py-2 mb-3">
                            </div>
                            <div>
                                @error('customer.email')
                                <p class="mt-2 text-sm text-red-600">{{ $errors->get('customer.email')[0] }}</p>
                                @enderror
                                <input type="email"
                                       name="customer[email]"
                                       placeholder="E-mail"
                                       @if($user->customer)
                                           value="{{$user->customer->email}}"
                                       @else
                                           value="{{old('customer.email')}}"
                                       @endif
                                       class="{{$errors->has('customer.email') ? 'border-red-900' :''}} w-full border rounded px-3 py-2 mb-3">
                            </div>
                            <div>
                                @error('customer.document')
                                <p class="mt-2 text-sm text-red-600">{{ $errors->get('customer.document')[0] }}</p>
                                @enderror
                                <input type="text"
                                       name="customer[document]"
                                       placeholder="CPF/CNPJ"
                                       @if($user->customer)
                                           value="{{$user->customer->document}}"
                                       @else
                                           value="{{old('customer.document')}}"
                                       @endif
                                       class="{{$errors->has('customer.document') ? 'border-red-900' :''}} w-full border rounded px-3 py-2 mb-3">
                            </div>
                        </div>
                        <label class="block text-gray-700 font-medium mb-2">Opção de Pagamento:</label>
                        <div id="paymentType" class="flex justify-around py-6">
                            <div class="flex items-center mx-2">
                                <input type="radio" id="boleto"
                                       @checked(old('billingType')=='BOLETO') name="billingType" value="BOLETO"
                                       class="mr-2">
                                <label for="boleto" class="text-gray-600">Boleto</label>
                            </div>
                            <div class="flex items-center mx-2">
                                <input type="radio" id="cartao"
                                       @checked(old('billingType')=='CREDIT_CARD') name="billingType"
                                       value="CREDIT_CARD" class="mr-2">
                                <label for="cartao" class="text-gray-600">Cartão</label>
                            </div>
                            <div class="flex items-center mx-2">
                                <input type="radio" id="pix" @checked(old('billingType')=='PIX') name="billingType"
                                       value="PIX" class="mr-2">
                                <label for="pix" class="text-gray-600">Pix</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="creditCardHolderInfo" class="@if(old('billingType')!=='CREDIT_CARD') hidden @endif w-1/2">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Informações do Cartão de Crédito:</label>
                        <div>
                            @error('creditCard.holderName')
                            <p class="mt-2 text-sm text-red-600">{{ $errors->get('creditCard.holderName')[0] }}</p>
                            @enderror
                            <input type="text" name="creditCard[holderName]" placeholder="Nome do Titular"
                                   value="{{old('creditCard.holderName')}}"
                                   class="{{$errors->has('creditCard.holderName') ? 'border-red-900' :''}} w-full border rounded px-3 py-2 mb-3">
                        </div>
                        <div>
                            @error('creditCard.number')
                            <p class="mt-2 text-sm text-red-600">{{ $errors->get('creditCard.number')[0] }}</p>
                            @enderror
                            <input type="text" name="creditCard[number]" placeholder="Número do Cartão"
                                   value="{{old('creditCard.number')}}"
                                   class="{{$errors->has('creditCard.number') ? 'border-red-900' :''}} w-full border rounded px-3 py-2 mb-3">
                        </div>
                        <div class="flex flex-row w-full">
                            @error('creditCard.expiryMonth')
                            <p class="mt-2 text-sm text-red-600">{{ $errors->get('creditCard.expiryMonth')[0] }}</p>
                            @enderror
                            <input type="text" name="creditCard[expiryMonth]" placeholder="Mês de Expiração (MM)"
                                   value="{{old('creditCard.expiryMonth')}}"
                                   class="{{$errors->has('creditCard.expiryMonth') ? 'border-red-900' :''}} w-1/2 border rounded px-3 py-2 mb-3">
                            @error('creditCard.expiryYear')
                            <p class="mt-2 text-sm text-red-600">{{ $errors->get('creditCard.expiryYear')[0] }}</p>
                            @enderror
                            <input type="text" name="creditCard[expiryYear]" placeholder="Ano de Expiração (YYYY)"
                                   value="{{old('creditCard.expiryYear')}}"
                                   class="{{$errors->has('creditCard.expiryYear') ? 'border-red-900' :''}} w-1/2 border rounded px-3 py-2 mb-3">
                        </div>
                        <div>
                            @error('creditCard.ccv')
                            <p class="mt-2 text-sm text-red-600">{{ $errors->get('creditCard.ccv')[0] }}</p>
                            @enderror
                            <input type="text" name="creditCard[ccv]" placeholder="Código de Segurança (CCV)"
                                   value="{{old('creditCard.ccv')}}"
                                   class="{{$errors->has('creditCard.ccv') ? 'border-red-900' :''}} w-full border rounded px-3 py-2 mb-3">
                        </div>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Informações do Titular do Cartão:</label>
                        <div>
                            @error('creditCardHolderInfo.name')
                            <p class="mt-2 text-sm text-red-600">{{ $errors->get('creditCardHolderInfo.name')[0] }}</p>
                            @enderror
                            <input type="text" name="creditCardHolderInfo[name]" placeholder="Nome"
                                   value="{{old('creditCardHolderInfo.name')}}"
                                   class="{{$errors->has('creditCardHolderInfo.name') ? 'border-red-900' :''}} w-full border rounded px-3 py-2 mb-3">
                        </div>
                        <div>
                            @error('creditCardHolderInfo.email')
                            <p class="mt-2 text-sm text-red-600">{{ $errors->get('creditCardHolderInfo.email')[0] }}</p>
                            @enderror
                            <input type="email" name="creditCardHolderInfo[email]" placeholder="E-mail"
                                   value="{{old('creditCardHolderInfo.email')}}"
                                   class="{{$errors->has('creditCardHolderInfo.email') ? 'border-red-900' :''}} w-full border rounded px-3 py-2 mb-3">
                        </div>
                        <div>
                            @error('creditCardHolderInfo.cpfCnpj')
                            <p class="mt-2 text-sm text-red-600">{{ $errors->get('creditCardHolderInfo.cpfCnpj')[0] }}</p>
                            @enderror
                            <input type="text" name="creditCardHolderInfo[cpfCnpj]" placeholder="CPF/CNPJ"
                                   value="{{old('creditCardHolderInfo.cpfCnpj')}}"
                                   class="{{$errors->has('creditCardHolderInfo.cpfCnpj') ? 'border-red-900' :''}} w-full border rounded px-3 py-2 mb-3">
                        </div>
                        <div>
                            @error('creditCardHolderInfo.postalCode')
                            <p class="mt-2 text-sm text-red-600">{{ $errors->get('creditCardHolderInfo.postalCode')[0] }}</p>
                            @enderror
                            <input type="text" name="creditCardHolderInfo[postalCode]" placeholder="CEP"
                                   value="{{old('creditCardHolderInfo.postalCode')}}"
                                   class="{{$errors->has('creditCardHolderInfo.postalCode') ? 'border-red-900' :''}} w-full border rounded px-3 py-2 mb-3">
                        </div>
                        <div>
                            @error('creditCardHolderInfo.addressNumber')
                            <p class="mt-2 text-sm text-red-600">{{ $errors->get('creditCardHolderInfo.addressNumber')[0] }}</p>
                            @enderror
                            <input type="text" name="creditCardHolderInfo[addressNumber]"
                                   value="{{old('creditCardHolderInfo.addressNumber')}}"
                                   placeholder="Número do Endereço"
                                   class="{{$errors->has('creditCardHolderInfo.addressNumber') ? 'border-red-900' :''}} w-full border rounded px-3 py-2 mb-3">
                        </div>
                        <div>
                            @error('creditCardHolderInfo.addressComplement')
                            <p class="mt-2 text-sm text-red-600">{{ $errors->get('creditCardHolderInfo.addressComplement')[0] }}</p>
                            @enderror
                            <input type="text" name="creditCardHolderInfo[addressComplement]" placeholder="Complemento"
                                   value="{{old('creditCardHolderInfo.addressComplement')}}"
                                   class="{{$errors->has('creditCardHolderInfo.addressComplement') ? 'border-red-900' :''}} w-full border rounded px-3 py-2 mb-3">
                        </div>
                        <div>
                            @error('creditCardHolderInfo.phone')
                            <p class="mt-2 text-sm text-red-600">{{ $errors->get('creditCardHolderInfo.phone')[0] }}</p>
                            @enderror
                            <input type="text" name="creditCardHolderInfo[phone]" placeholder="Telefone"
                                   value="{{old('creditCardHolderInfo.phone')}}"
                                   class="{{$errors->has('creditCardHolderInfo.phone') ? 'border-red-900' :''}} w-full border rounded px-3 py-2 mb-3">
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
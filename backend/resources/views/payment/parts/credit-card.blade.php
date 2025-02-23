<div id="creditCardSection" class="w-1/2 class="@if(old('billingType')!='CREDIT_CARD') hidden  @endif ">
    <div>
        <label class="block text-gray-700 font-medium mb-2">Informações do Cartão de Crédito:</label>
        <div>
            @error('creditCard.holderName')
            <p class="mt-2 text-sm text-red-600">{{ $errors->get('creditCard.holderName')[0] }}</p>
            @enderror
            <input type="text" name="creditCard[holderName]" placeholder="Nome do Titular" value="{{old('creditCard.holderName')}}"
                   class="{{$errors->has('creditCard.holderName') ? 'border-red-900' :''}} w-full border rounded px-3 py-2 mb-3">
        </div>
        <div>
            @error('creditCard.number')
            <p class="mt-2 text-sm text-red-600">{{ $errors->get('creditCard.number')[0] }}</p>
            @enderror
            <input type="text" name="creditCard[number]" placeholder="Número do Cartão" value="{{old('creditCard.number')}}"
                   class="{{$errors->has('creditCard.number') ? 'border-red-900' :''}} w-full border rounded px-3 py-2 mb-3">
        </div>                    
        <div class="flex flex-row w-full">
            @error('creditCard.expiryMonth')
            <p class="mt-2 text-sm text-red-600">{{ $errors->get('creditCard.expiryMonth')[0] }}</p>
            @enderror
            <input type="text" name="creditCard[expiryMonth]" placeholder="Mês de Expiração (MM)" value="{{old('creditCard.expiryMonth')}}"
                   class="{{$errors->has('creditCard.expiryMonth') ? 'border-red-900' :''}} w-1/2 border rounded px-3 py-2 mb-3">
            
            @error('creditCard.expiryYear')
            <p class="mt-2 text-sm text-red-600">{{ $errors->get('creditCard.expiryYear')[0] }}</p>
            @enderror
            <input type="text" name="creditCard[expiryYear]" placeholder="Ano de Expiração (YYYY)" value="{{old('creditCard.expiryYear')}}"
                   class="{{$errors->has('creditCard.expiryYear') ? 'border-red-900' :''}} w-1/2 border rounded px-3 py-2 mb-3">
        </div>
        <div>
            @error('creditCard.ccv')
            <p class="mt-2 text-sm text-red-600">{{ $errors->get('creditCard.ccv')[0] }}</p>
            @enderror
            <input type="text" name="creditCard[ccv]" placeholder="Código de Segurança (CCV)" value="{{old('creditCard.ccv')}}"
                   class="{{$errors->has('creditCard.ccv') ? 'border-red-900' :''}} w-full border rounded px-3 py-2 mb-3">
        </div>
    </div>
    <div>
        <label class="block text-gray-700 font-medium mb-2">Informações do Titular do Cartão:</label>
        <div>
            @error('creditCardHolderInfo.name')
            <p class="mt-2 text-sm text-red-600">{{ $errors->get('creditCardHolderInfo.name')[0] }}</p>
            @enderror
            <input type="text" name="creditCardHolderInfo[name]" placeholder="Nome" value="{{old('creditCardHolderInfo.name')}}"
                   class="{{$errors->has('creditCardHolderInfo.name') ? 'border-red-900' :''}} w-full border rounded px-3 py-2 mb-3">
        </div>
        <div>
            @error('creditCardHolderInfo.email')
            <p class="mt-2 text-sm text-red-600">{{ $errors->get('creditCardHolderInfo.email')[0] }}</p>
            @enderror
            <input type="email" name="creditCardHolderInfo[email]" placeholder="E-mail" value="{{old('creditCardHolderInfo.email')}}"
                   class="{{$errors->has('creditCardHolderInfo.email') ? 'border-red-900' :''}} w-full border rounded px-3 py-2 mb-3">
        </div>
        <div>
            @error('creditCardHolderInfo.cpfCnpj')
            <p class="mt-2 text-sm text-red-600">{{ $errors->get('creditCardHolderInfo.cpfCnpj')[0] }}</p>
            @enderror
            <input type="text" name="creditCardHolderInfo[cpfCnpj]" placeholder="CPF/CNPJ" value="{{old('creditCardHolderInfo.cpfCnpj')}}"
                   class="{{$errors->has('creditCardHolderInfo.cpfCnpj') ? 'border-red-900' :''}} w-full border rounded px-3 py-2 mb-3">
        </div>
        <div>
            @error('creditCardHolderInfo.postalCode')
            <p class="mt-2 text-sm text-red-600">{{ $errors->get('creditCardHolderInfo.postalCode')[0] }}</p>
            @enderror
            <input type="text" name="creditCardHolderInfo[postalCode]" placeholder="CEP" value="{{old('creditCardHolderInfo.postalCode')}}"
                   class="{{$errors->has('creditCardHolderInfo.postalCode') ? 'border-red-900' :''}} w-full border rounded px-3 py-2 mb-3">
        </div>
        <div>
            @error('creditCardHolderInfo.addressNumber')
            <p class="mt-2 text-sm text-red-600">{{ $errors->get('creditCardHolderInfo.addressNumber')[0] }}</p>
            @enderror
            <input type="text" name="creditCardHolderInfo[addressNumber]" value="{{old('creditCardHolderInfo.addressNumber')}}"
                   placeholder="Número do Endereço"
                   class="{{$errors->has('creditCardHolderInfo.addressNumber') ? 'border-red-900' :''}} w-full border rounded px-3 py-2 mb-3">
        </div>
        <div>
            @error('creditCardHolderInfo.addressComplement')
            <p class="mt-2 text-sm text-red-600">{{ $errors->get('creditCardHolderInfo.addressComplement')[0] }}</p>
            @enderror
            <input type="text" name="creditCardHolderInfo[addressComplement]" placeholder="Complemento" value="{{old('creditCardHolderInfo.addressComplement')}}"
                   class="{{$errors->has('creditCardHolderInfo.addressComplement') ? 'border-red-900' :''}} w-full border rounded px-3 py-2 mb-3">
        </div>
        <div>
            @error('creditCardHolderInfo.phone')
            <p class="mt-2 text-sm text-red-600">{{ $errors->get('creditCardHolderInfo.phone')[0] }}</p>
            @enderror
            <input type="text" name="creditCardHolderInfo[phone]" placeholder="Telefone" value="{{old('creditCardHolderInfo.phone')}}"
                   class="{{$errors->has('creditCardHolderInfo.phone') ? 'border-red-900' :''}} w-full border rounded px-3 py-2 mb-3">
        </div>
    </div>
</div>
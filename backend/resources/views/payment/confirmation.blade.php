@extends('layouts.layout')
@section('content')
    
    <div class="payment-success">
        <h1 class="text-2xl font-bold text-green-600">Obrigado por comprar</h1>
        <p class="mt-4 text-gray-700">Pedido Confirmado</p>
        <p class="mt-4 text-gray-700">Status do pagamento: {{$response->status->getDisplayName()}}</p>

        @if($response->billing_type==='BOLETO')
            <div class="mt-6">
                <a href="{{$response->bank_slip_url}}" target="_blank" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    Boleto
                </a>
            </div>
        @endif
        <div class="mt-6">
            <a href="{{ route('index') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Voltar a Home
            </a>
        </div>
    </div>
@endsection
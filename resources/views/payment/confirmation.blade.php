@extends('layouts.layout')
@section('content')
    <div class="text-center">
        <div class="payment-success bg-white p-6 rounded-lg shadow-md mx-auto">
            <div>
                <h1 class="text-2xl font-bold text-green-600">Obrigado por comprar</h1>
                <p class="mt-4 text-gray-700">Pedido Confirmado</p>
                <p class="mt-4 text-gray-700">Status do pagamento: {{$response->status->getDisplayName()}}</p>
            </div>
            @if($response->billing_type==='BOLETO')
                @include('payment.parts.boleto-confirmation')
            @endif
            @if($response->billing_type==='PIX')
                @include('payment.parts.pix-confirmation')
            @endif
            <div class="mt-6">
                <a href="{{ route('index') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    Voltar a Home
                </a>
            </div>
        </div>
    </div>
@endsection
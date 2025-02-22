@extends('layouts.layout')
@section('content')
    
    <div class="payment-success">
        <h1 class="text-2xl font-bold text-green-600">Obrigado por comprar</h1>
        <p class="mt-4 text-gray-700">Pagamento Confirmado</p>
        
        <div class="mt-6">
            <a href="{{ route('index') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Voltar a Home
            </a>
        </div>
    </div>
@endsection
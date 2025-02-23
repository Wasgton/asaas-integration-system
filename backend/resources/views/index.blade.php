@extends('layouts.layout')
@section('content')

    <div class="flex items-center justify-center h-screen">
        <!-- Centered container for two buttons -->
        <div class="grid grid-cols-2 gap-8">
            <!-- Make Payment Button -->
            <div class="w-28">
                <a href="{{ route('payment.makePayment') }}"
                   class="bg-blue-500 text-white font-bold w-[120px] h-[120px] rounded-md hover:bg-blue-700 flex items-center justify-center">
                    Make Payment
                </a>
            </div>

            <!-- Payments Button -->
            <div class="w-28">
                <a href="{{ route('payment.getPayments') }}"
                   class="bg-green-500 text-white font-bold w-[120px] h-[120px] rounded-md hover:bg-green-700 flex items-center justify-center">
                    Payments
                </a>
            </div>
        </div>
    </div>

@endsection

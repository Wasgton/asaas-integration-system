@extends('layouts.layout')
@section('content')

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Make Payment Tile -->
        <a href="{{route('payment')}}" class="bg-blue-500 text-white font-bold aspect-square w-75 text-c rounded-md hover:bg-blue-700 flex items-center justify-center">
            Make Payment
        </a>

        <!-- Payments Tile -->
        <a class="bg-green-500 text-white font-bold aspect-square w-75 rounded-md hover:bg-green-700 flex items-center justify-center">
            Payments
        </a>

        <!-- Profile Tile -->
        <a class="bg-purple-500 text-white font-bold aspect-square w-75 rounded-md hover:bg-purple-700 flex items-center justify-center">
            Profile
        </a>
    </div>
@endsection

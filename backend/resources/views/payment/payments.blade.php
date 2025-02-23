@extends('layouts.layout')
@section('content')

    <div class="container mx-auto mt-4">
        <div class="overflow-x-auto">
            <table class="table-auto w-full border border-gray-300">
                <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 text-center">ID Asaas</th>
                    <th class="px-4 py-2 text-center">Informações do Cliente</th>
                    <th class="px-4 py-2 text-center">Valor</th>
                    <th class="px-4 py-2 text-center">Tipo de Cobrança</th>
                    <th class="px-4 py-2 text-center">Status</th>
                    <th class="px-4 py-2 text-center">Data de Pagamento</th>
                    <th class="px-4 py-2 text-center">Boleto</th>
                    <th class="px-4 py-2 text-center">Número da Fatura</th>
                    <th class="px-4 py-2 text-center">URL da Fatura</th>
                    <th class="px-4 py-2 text-center">Comprovante de Transação</th>
                    <th class="px-4 py-2 text-center">Deletado</th>
                    <th class="px-4 py-2 text-center">Antecipado</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($payments as $payment)
                    <tr class="border-t border-gray-300">
                        <td class="px-4 py-2 text-center">{{ $payment->asaas_id }}</td>
                        <td class="px-4 py-2 text-center">
                            <button onclick="toggleCustomerInfo({{ $loop->index }})" class="text-blue-500 underline">
                                View Customer Info
                            </button>
                            <div id="customer-info-{{ $loop->index }}" class="hidden mt-2 text-left">
                                <p><strong>Customer Asaas ID:</strong> {{ $payment->customer['asaas_id'] }}</p>
                                <p><strong>Name:</strong> {{ $payment->customer['name'] }}</p>
                                <p><strong>Document:</strong> {{ $payment->customer['document'] }}</p>
                                <p><strong>Email:</strong> {{ $payment->customer['email'] }}</p>
                                <p><strong>Phone:</strong> {{ $payment->customer['phone'] }}</p>
                            </div>
                        </td>
                        <td class="px-4 py-2 text-center">{{ number_format($payment->value) }}</td>
                        <td class="px-4 py-2 text-center">{{ $payment->billing_type->getDisplayName() }}</td>
                        <td class="px-4 py-2 text-center">{{ $payment->status->getDisplayName() }}</td>
                        <td class="px-4 py-2 text-center">{{ $payment->payment_date }}</td>
                        <td class="px-4 py-2 text-center">
                            @if($payment->bank_slip_url)
                                <a href="{{ $payment->bank_slip_url }}" class="text-blue-500 underline" target="_blank">Bank
                                    Slip</a>
                            @endif
                        </td>
                        <td class="px-4 py-2 text-center">{{ $payment->invoice_number }}</td>
                        <td class="px-4 py-2 text-center">
                            @if($payment->invoice_url)
                                <a href="{{ $payment->invoice_url }}" class="text-blue-500 underline" target="_blank">Invoice</a>
                            @endif
                        </td>
                        <td class="px-4 py-2 text-center">
                            @if($payment->transaction_receipt_url)
                                <a href="{{ $payment->transaction_receipt_url }}" class="text-blue-500 underline"
                                   target="_blank">Receipt</a>
                            @endif
                        </td>
                        <td class="px-4 py-2 text-center">{{ $payment->deleted ? 'Yes' : 'No' }}</td>
                        <td class="px-4 py-2 text-center">{{ $payment->antecipated ? 'Yes' : 'No' }}</td>
                    </tr>
                    <script>
                        function toggleCustomerInfo(index) {
                            const infoDiv = document.getElementById(`customer-info-${index}`);
                            if (infoDiv.classList.contains('hidden')) {
                                infoDiv.classList.remove('hidden');
                            } else {
                                infoDiv.classList.add('hidden');
                            }
                        }
                    </script>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $payments->links() }}
        </div>
    </div>
@endsection
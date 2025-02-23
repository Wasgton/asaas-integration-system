<?php

namespace App\Payments\PaymentMethods;

use App\Exceptions\ApiException;
use App\Payments\PaymentMethods\Contracts\PaymentMethod;
use App\Repositories\Contracts\ApiRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class BoletoPayment implements PaymentMethod
{
    public function __construct(
        private ApiRepository $apiRepository
    ){}
    public function processPayment(array $paymentData): array
    {
        $customerId = $paymentData['customer']->id;
        $paymentData['customer'] = $paymentData['customer']->asaas_id;
        $paymentData['dueDate'] = Carbon::now()->addDays(5)->format('Y-m-d');
        unset($paymentData['creditCard'],$paymentData['creditCardHolderInfo']);
        $this->validate($paymentData);
        $responseData = $this->apiRepository->createPayment($paymentData);
        if (isset($responseData['errors'])) {
            throw new ApiException($responseData['errors'][0]['description'] ?? 'Erro ao processar pagamento.');
        }
        return [
            'asaas_id' => $responseData['id'],
            'customer_id' => $customerId,
            'value' => $responseData['value'],
            'billing_type' => $responseData['billingType'],
            'status' => $responseData['status'],
            'payment_date' => $responseData['paymentDate'],
            'invoice_number' => $responseData['invoiceNumber'],
            'invoice_url' => $responseData['invoiceUrl'],
            'bank_slip_url' => $responseData['bankSlipUrl'],
            'transaction_receipt_url' => $responseData['transactionReceiptUrl'],
            'deleted' => $responseData['deleted'],
            'anticipated' => $responseData['anticipated']
        ];
    }

    public function validate(array $paymentData): void
    {
        $validator = Validator::make($paymentData,[
            'customer'    => 'required',
            'billingType' => 'required|in:BOLETO',
            'value'       => 'required|numeric|min:1',
            'dueDate'     => 'required|date_format:Y-m-d|after:' . Carbon::now()->addDays(4)->format('Y-m-d'),
        ],[
            'customer.required'    => 'O campo cliente é obrigatório.',
            'billingType.required' => 'O campo tipo de cobrança é obrigatório.',
            'billingType.in'       => 'O campo tipo de cobrança deve conter o valor: BOLETO.',
            'value.required'       => 'O campo valor é obrigatório.',
            'value.numeric'        => 'O campo valor deve ser numérico.',
            'value.min'            => 'O campo valor deve ser no mínimo 1.',
            'dueDate.required'     => 'O campo data de vencimento é obrigatório.',
            'dueDate.date_format'  => 'O campo data de vencimento deve estar no formato: Y-m-d.',
            'dueDate.after'        => 'O campo data de vencimento deve ser uma data posterior a ' . Carbon::now()->addDays(4)->format('d/m/Y') . '.',
        ]);
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
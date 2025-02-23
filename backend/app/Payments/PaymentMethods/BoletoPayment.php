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
    public function processPayment(array $paymentData)
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
        ],
        );
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
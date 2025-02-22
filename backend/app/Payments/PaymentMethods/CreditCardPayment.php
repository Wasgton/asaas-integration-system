<?php

namespace App\Payments\PaymentMethods;

use App\Exceptions\ApiException;
use App\Payments\PaymentMethods\Contracts\PaymentMethod;
use App\Repositories\Contracts\ApiRepository;
use App\Rules\CpfCnpj;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CreditCardPayment implements PaymentMethod
{
    public function __construct(
        private ApiRepository $apiRepository
    ){}

    /**
     * @throws HttpException
     */
    public function processPayment(array $paymentData): array
    {
        $this->validate($paymentData);
        $customerId = $paymentData['customer']->id;
        $paymentData['customer'] = $paymentData['customer']->asaas_id;
        $paymentData['dueDate'] = Carbon::now()->addDays(5)->format('Y-m-d');
        $responseData = $this->apiRepository->createPayment($paymentData);
        if (isset($responseData['errors'])) {
            throw new ApiException($responseData['errors'][0]['description'] ?? 'Payment failed');
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
            'transaction_receipt_url' => $responseData['transactionReceiptUrl'],
            'deleted' => $responseData['deleted'],
            'anticipated' => $responseData['anticipated']
        ];
    }
    
    public function validate(array $paymentData): void
    {
        $validator = Validator::make($paymentData,[
            'installmentCount'                       => 'sometimes|max:12',
            'totalValue'                             => 'required_with:installmentCount|numeric|min:1',
            'creditCard'                             => 'array|required',
            'creditCard.holderName'                  => 'required|string|max:255',
            'creditCard.number'                      => 'required|regex:/^([0-9]{4})+([0-9]{4})+([0-9]{4})+([0-9]{4})+$/',
            'creditCard.expiryMonth'                 => 'required|date_format:m|before:today|after:01',
            'creditCard.expiryYear'                  => 'required|date_format:Y|after:today',
            'creditCard.ccv'                         => 'required|regex:/^([0-9]{3})+$/',
            'creditCardHolderInfo.name'              => 'required|string|max:255',
            'creditCardHolderInfo.email'             => 'required|email|max:255',
            'creditCardHolderInfo.cpfCnpj'           => ['required', new CpfCnpj],
            'creditCardHolderInfo.postalCode'        => 'required|digits:8',
            'creditCardHolderInfo.addressNumber'     => 'required|numeric',
            'creditCardHolderInfo.addressComplement' => 'nullable|string|max:255',
            'creditCardHolderInfo.phone'             => 'required|regex:/^[0-9]{2}9[0-9]{4}[0-9]{4}$/',
        ],
        [
            'creditCard.required'                             => 'Credit card not informed',
            'creditCard.holderName.required'                  => 'The cardholder name is required.',
            'creditCard.number.required'                      => 'The credit card number is required.',
            'creditCard.expiryMonth.required'                 => 'The expiry month is required.',
            'creditCard.expiryYear.required'                  => 'The expiry year is required.',
            'creditCard.ccv.required'                         => 'The credit card ccv is required.',
            'creditCard.holderName.max'                       => 'The cardholder name cannot exceed 255 characters.',
            'creditCard.expiryMonth.date_format'              => 'The expiry month must be in the mm format.',
            'creditCard.expiryYear.date_format'               => 'The expiry year must be in the yyyy format.',
            'creditCard.ccv.regex'                            => 'The CCV must be a 3-digit number.',
            'creditCard.number.regex'                         => 'The credit card number format is invalid. It must have exactly 16 digits.',
            'creditCard.expiryMonth.before'                   => 'The expiry month must be in the future.',
            'creditCard.expiryMonth.after'                    => 'The expiry month format is invalid. It must be greater than 01.',
            'creditCard.expiryYear.after'                     => 'The expiry year must be in the future.',
            'creditCardHolderInfo.name.required'              => 'The cardholder\'s name is required.',
            'creditCardHolderInfo.email.required'             => 'The cardholder\'s email is required.',
            'creditCardHolderInfo.cpfCnpj.required'           => 'The cardholder\'s CPF or CNPJ is required.',
            'creditCardHolderInfo.postalCode.required'        => 'The postal code is required.',
            'creditCardHolderInfo.addressNumber.required'     => 'The address number is required.',
            'creditCardHolderInfo.phone.required'             => 'The phone number is required.',
            'creditCardHolderInfo.postalCode.regex'           => 'The postal code must follow the 00000-000 format.',
            'creditCardHolderInfo.phone.regex'                => 'The phone number must follow the 00900000000 format.',
            'creditCardHolderInfo.name.max'                   => 'The cardholder\'s name cannot exceed 255 characters.',
            'creditCardHolderInfo.addressComplement.max'      => 'The address complement cannot exceed 255 characters.',
            'creditCardHolderInfo.postalCode.digits'          => 'The postal code must contain exactly 8 digits.',
            'creditCardHolderInfo.email.email'                => 'The email address format is invalid.',
            'creditCardHolderInfo.email.max'                  => 'The email address cannot exceed 255 characters.',
       ],
        );
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
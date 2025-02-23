<?php

namespace App\Services;

use App\Models\Payment;
use App\Payments\Factories\PaymentFactory;
use App\Repositories\Contracts\ApiRepository;
use App\Repositories\Contracts\PaymentRepository;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PaymentService
{
    public function __construct(
        private CustomerService $customerService,
        private PaymentRepository $repository,
        private ApiRepository $apiRepository
    ){}

    /**
     * @throws GuzzleException
     * @throws \HttpException
     */
    public function createPayment(array $paymentDetails): Payment
    {
        $customer = $this->customerService->ensureCustomerExists($paymentDetails['customer']);
        $paymentDetails['customer'] = $customer;
        $paymentMethod = PaymentFactory::createPaymentMethod($paymentDetails['billingType']);
        $payment = $paymentMethod->processPayment($paymentDetails);
        return $this->repository->create($payment);
    }

    public function getQrCode(string $asaasId): array
    {
        $validator = Validator::make(['asaas_id' => $asaasId],['asaas_id' => 'required|string|exists:payments,asaas_id']);
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        return $this->apiRepository->getQrCode($asaasId);
    }
}
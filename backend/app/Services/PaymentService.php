<?php

namespace App\Services;

use App\Models\Payment;
use App\Payments\Factories\PaymentFactory;
use App\Repositories\Contracts\PaymentRepository;
use GuzzleHttp\Exception\GuzzleException;

class PaymentService
{
    public function __construct(
        private CustomerService $customerService,
        private PaymentRepository $repository
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
}
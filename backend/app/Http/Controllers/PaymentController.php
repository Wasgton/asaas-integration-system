<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Services\PaymentService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\RedirectResponse;

class PaymentController extends Controller
{
    
    public function __construct(
        private PaymentService $service
    ){}

    /**
     * @throws \HttpException
     * @throws GuzzleException
     */
    public function makePayment(PaymentRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $response = $this->service->createPayment($data);
        return redirect()->route('payment.confirmation',compact('response'));
    }
}

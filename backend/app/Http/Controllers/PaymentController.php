<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\PaymentRequest;
use App\Http\Resources\GetQrCodeResource;
use App\Services\PaymentService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Validation\ValidationException;

class PaymentController extends Controller
{
    
    public function __construct(
        private PaymentService $service
    ){}

    public function index()
    {
        $user = auth()->user()->with('customer')->first();
        return view('payment.payment', compact('user'));
    }
    
    /**
     * @throws \HttpException
     * @throws GuzzleException
     */
    public function makePayment(PaymentRequest $request)
    {
        $data = $request->validated();
        try {
            $response = $this->service->createPayment($data);
            return view('payment.confirmation', compact('response'));
        } catch(ApiException|ValidationException $e){
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        } catch(\Exception $e){
            return redirect()->back()->withInput()->withErrors(['error' => 'Erro ao processar pagamento.']);
        }
    }

    public function getQrCode(string $asaasId)
    {
        $response = $this->service->getQrCode($asaasId);
        return GetQrCodeResource::make($response);
    }
    
}

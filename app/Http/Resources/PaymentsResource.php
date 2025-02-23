<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'asaas_id' => $this->asaas_id,
            'customer' => [
                'asaas_id' => $this->customer->asaas_id,
                'name' => $this->customer->name,
                'document' => $this->customer->document,
                'email' => $this->customer->email,
                'phone' => $this->customer->phone,
            ],
            'value' => format_money($this->value),
            'billing_type' => $this->billing_type->getDisplayName(),
            'status' => $this->status->getDisplayName(),
            'payment_date' => $this->payment_date?$this->payment_date->format('d/m/Y'):null,
            'bank_slip_url' => $this->bank_slip_url,
            'invoice_number' => $this->invoice_number,
            'invoice_url' => $this->invoice_url,
            'transaction_receipt_url' => $this->transaction_receipt_url,
            'deleted' => $this->deleted,
            'antecipated' => $this->antecipated
        ];
    }
}

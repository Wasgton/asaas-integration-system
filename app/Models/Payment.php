<?php

namespace App\Models;

use App\Enum\BillingType;
use App\Enum\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'asaas_id',
        'customer_id',
        'value',
        'billing_type',
        'status',
        'payment_date',
        'invoice_number',
        'invoice_url',
        'transaction_receipt_url',
        'deleted',
        'anticipated',
        'bank_slip_url'
    ];

    protected $casts = [
        'status' => Status::class,
        'billing_type' => BillingType::class
    ];
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
    
}

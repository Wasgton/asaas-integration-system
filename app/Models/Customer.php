<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'asaas_id',
        'name',
        'document',
        'email'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Enum;

enum BillingType : string
{
    case CREDIT_CARD = 'CREDIT_CARD';
    case BOLETO = 'BOLETO';
    case PIX = 'PIX';

    public function getDisplayName(): string
    {
        return match($this) {
            self::CREDIT_CARD => 'Cartão de credito',
            self::BOLETO => 'Boleto',
            self::PIX => 'Pix',
        };
    }
}

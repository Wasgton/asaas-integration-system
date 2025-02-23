<?php

namespace App\Enum;

enum Status: string
{
    case PENDING = 'PENDING';
    case RECEIVED = 'RECEIVED';
    case CONFIRMED = 'CONFIRMED';
    case OVERDUE = 'OVERDUE';
    case REFUNDED = 'REFUNDED';
    case RECEIVED_IN_CASH = 'RECEIVED_IN_CASH';
    case REFUND_REQUESTED = 'REFUND_REQUESTED';
    case REFUND_IN_PROGRESS = 'REFUND_IN_PROGRESS';
    case CHARGEBACK_REQUESTED = 'CHARGEBACK_REQUESTED';
    case CHARGEBACK_DISPUTE = 'CHARGEBACK_DISPUTE';
    case AWAITING_CHARGEBACK_REVERSAL = 'AWAITING_CHARGEBACK_REVERSAL';
    case DUNNING_REQUESTED = 'DUNNING_REQUESTED';
    case DUNNING_RECEIVED = 'DUNNING_RECEIVED';
    case AWAITING_RISK_ANALYSIS = 'AWAITING_RISK_ANALYSIS';

    public function getDisplayName(): string
    {
        return match($this) {
            self::PENDING => 'Pendente',
            self::RECEIVED => 'Recebido',
            self::CONFIRMED => 'Confirmado',
            self::OVERDUE => 'Vencido',
            self::REFUNDED => 'Reembolsado',
            self::RECEIVED_IN_CASH => 'Recebido em Dinheiro',
            self::REFUND_REQUESTED => 'Reembolso Solicitado',
            self::REFUND_IN_PROGRESS => 'Reembolso em Progresso',
            self::CHARGEBACK_REQUESTED => 'Chargeback Solicitado',
            self::CHARGEBACK_DISPUTE => 'Disputa de Chargeback',
            self::AWAITING_CHARGEBACK_REVERSAL => 'Aguardando Reversão de Chargeback',
            self::DUNNING_REQUESTED => 'Cobrança Solicitada',
            self::DUNNING_RECEIVED => 'Cobrança Recebida',
            self::AWAITING_RISK_ANALYSIS => 'Aguardando Análise de Risco',
        };
    }
    
}
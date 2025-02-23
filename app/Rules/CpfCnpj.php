<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CpfCnpj implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->isValidCpf($value) && !$this->isValidCnpj($value)) {
            $fail(sprintf('%s is not a valid CPF or CNPJ.', $value));
        }
    }
    private function isValidCpf(mixed $value): bool
    {
        $cpf = preg_replace('/\D/', '', $value);
        if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
        $digits = substr($cpf, 0, 9);
        $checkDigits = substr($cpf, 9);
        for ($i = 0; $i < 2; $i++) {
            $sum = 0;
            for ($j = 0; $j < 9 + $i; $j++) {
                $sum += $digits[$j] * (10 + $i - $j);
            }
            $remainder = $sum % 11;
            $digit = $remainder < 2 ? 0 : 11 - $remainder;
            if ($checkDigits[$i] != $digit) {
                return false;
            }
            $digits .= $digit;
        }
        return true;
    }
    private function isValidCnpj(string $cnpj): bool
    {
        $cnpj = preg_replace('/\D/', '', $cnpj);
        if (strlen($cnpj) !== 14 || preg_match('/(\d)\1{13}/', $cnpj)) {
            return false;
        }
        $weight = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        for ($t = 12; $t < 14; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) {
                $d += $cnpj[$c] * $weight[$c + 1 - $t];
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cnpj[$c] != $d) {
                return false;
            }
        }
        return true;
    }

}

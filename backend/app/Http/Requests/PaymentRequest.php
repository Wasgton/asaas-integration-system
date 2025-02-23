<?php

namespace App\Http\Requests;

use App\Rules\CpfCnpj;
use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'billingType'                            => 'required|in:BOLETO,CREDIT_CARD,PIX',
            'customer.name'                          => 'required|string',
            'customer.email'                         => 'required|email',
            'customer.document'                      => ['required', new CpfCnpj],
            'value'                                  => 'required|numeric|min:1',
            'creditCard'                             => 'nullable|array|required_if:billingType,CREDIT_CARD|sometimes',
            'creditCard.holderName'                  => 'nullable|required_if:billingType,CREDIT_CARD|string|max:255',
            'creditCard.number'                      => 'nullable|required_if:billingType,CREDIT_CARD|sometimes|regex:/^([0-9]{4})+([0-9]{4})+([0-9]{4})+([0-9]{4})+$/',
            'creditCard.expiryMonth'                 => 'nullable|required_if:billingType,CREDIT_CARD|sometimes|date_format:m|before:today|after:01',
            'creditCard.expiryYear'                  => 'nullable|required_if:billingType,CREDIT_CARD|sometimes|date_format:Y|after:today',
            'creditCard.ccv'                         => 'nullable|required_if:billingType,CREDIT_CARD|sometimes|regex:/^([0-9]{3})+$/',
            'creditCardHolderInfo'                   => 'nullable|array|required_if:billingType,CREDIT_CARD|sometimes',
            'creditCardHolderInfo.name'              => 'nullable|required_if:billingType,CREDIT_CARD|sometimes|string|max:255',
            'creditCardHolderInfo.email'             => 'nullable|required_if:billingType,CREDIT_CARD|sometimes|email|max:255',
            'creditCardHolderInfo.cpfCnpj'           => ['nullable','required_if:billingType,CREDIT_CARD','sometimes',new CpfCnpj],
            'creditCardHolderInfo.postalCode'        => 'nullable|required_if:billingType,CREDIT_CARD|sometimes|numeric|digits:8',
            'creditCardHolderInfo.addressNumber'     => 'nullable|required_if:billingType,CREDIT_CARD|sometimes|numeric',
            'creditCardHolderInfo.addressComplement' => 'nullable|nullable|string|max:255',
            'creditCardHolderInfo.phone'             => 'nullable|required_if:billingType,CREDIT_CARD|sometimes|regex:/^[0-9]{2}9[0-9]{4}[0-9]{4}$/',
        ];
    }

    public function messages()
    {
        return [

            'value.required' => 'O valor é obrigatório.',
            'value.numeric'  => 'O valor deve ser um número.',
            'value.min'      => 'O valor deve ser, no mínimo, 1.',

            'customer.required'          => 'Os dados do cliente são obrigatórios.',
            'customer.name.required'     => 'O nome do cliente é obrigatório.',
            'customer.name.string'       => 'O nome do cliente deve ser uma string.',
            'customer.email.required'    => 'O e-mail do cliente é obrigatório.',
            'customer.email.email'       => 'O formato do e-mail do cliente é inválido.',
            'customer.document.required' => 'O documento do cliente é obrigatório.',
            
            'creditCard.required'                         => 'Cartão de crédito não informado.',
            'creditCard.number.required'                  => 'O número do cartão de crédito é obrigatório.',
            'creditCard.expiryMonth.required'             => 'O mês de validade é obrigatório.',
            'creditCard.expiryYear.required'              => 'O ano de validade é obrigatório.',
            'creditCard.ccv.required'                     => 'O código de segurança do cartão (CCV) é obrigatório.',
            'creditCard.holderName.max'                   => 'O nome do titular do cartão não pode exceder 255 caracteres.',
            'creditCard.expiryMonth.date_format'          => 'O mês de validade deve estar no formato mm.',
            'creditCard.expiryYear.date_format'           => 'O ano de validade deve estar no formato yyyy.',
            'creditCard.ccv.regex'                        => 'O CCV deve ser um número de 3 dígitos.',
            'creditCard.number.regex'                     => 'O formato do número do cartão de crédito é inválido. Deve conter exatamente 16 dígitos.',
            'creditCard.expiryMonth.before'               => 'O mês de validade deve estar no futuro.',
            'creditCard.expiryMonth.after'                => 'O formato do mês de validade é inválido. Deve ser maior que 01.',
            'creditCard.expiryYear.after'                 => 'O ano de validade deve estar no futuro.',
                        
            'creditCard.holderName.required_if' => 'O nome é obrigatório quando cartão de credito é selecionado.',
            'creditCard.number.required_if' => 'O numero do cartão é obrigatório quando cartão de credito é selecionado.',
            'creditCard.expiryMonth.required_if' => 'A data de expiração do cartão é obrigatório quando cartão de credito é selecionado.',
            'creditCard.expiryYear.required_if' => 'A data de expiração do cartão é obrigatório quando cartão de credito é selecionado.',
            'creditCard.ccv.required_if' => 'O codigo do cartão é obrigatório quando cartão de credito é selecionado.',
            
            'creditCardHolderInfo.name.required_if' => 'O nome do titular do cartão é obrigatório quando cartão de credito é selecionado.',
            'creditCardHolderInfo.email.required_if' => 'O email do titular do cartão é obrigatório quando cartão de credito é selecionado.',
            'creditCardHolderInfo.cpfCnpj.required_if' => 'O cpf/cnpj do titular do cartão é obrigatório quando cartão de credito é selecionado.',
            'creditCardHolderInfo.postalCode.required_if' => 'O codigo postal do titular do cartão é obrigatório quando cartão de credito é selecionado.',
            'creditCardHolderInfo.addressNumber.required_if' => 'O numero do endereço do titular do cartão é obrigatório quando cartão de credito é selecionado.',
            'creditCardHolderInfo.phone.required_if' => 'O telefone do titular do cartão é obrigatório quando cartão de credito é selecionado.',
                        
            'creditCardHolderInfo.email.required'         => 'O e-mail do titular do cartão é obrigatório.',
            'creditCardHolderInfo.cpfCnpj.required'       => 'O CPF ou CNPJ do titular do cartão é obrigatório.',
            'creditCardHolderInfo.postalCode.required'    => 'O CEP é obrigatório.',
            'creditCardHolderInfo.addressNumber.required' => 'O número do endereço é obrigatório.',
            'creditCardHolderInfo.phone.required'         => 'O número de telefone é obrigatório.',
            'creditCardHolderInfo.postalCode.regex'       => 'O CEP deve estar no formato 00000-000.',
            'creditCardHolderInfo.phone.regex'            => 'O número de telefone deve estar no formato 00900000000.',
            'creditCardHolderInfo.name.max'               => 'O nome do titular do cartão não pode exceder 255 caracteres.',
            'creditCardHolderInfo.addressComplement.max'  => 'O complemento do endereço não pode exceder 255 caracteres.',
            'creditCardHolderInfo.postalCode.digits'      => 'O CEP deve conter exatamente 8 dígitos.',
            'creditCardHolderInfo.email.email'            => 'O formato do endereço de e-mail é inválido.',
            'creditCardHolderInfo.email.max'              => 'O endereço de e-mail não pode exceder 255 caracteres.',
        ];
    }
}

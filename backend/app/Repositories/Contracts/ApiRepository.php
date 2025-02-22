<?php

namespace App\Repositories\Contracts;


interface ApiRepository
{
    public function getCustomerByEmail(string $email): array|null;
    public function sendCustomerCreationRequest(array $customerRequestData): string;
    public function getCustomerById(string $id): array|null;
    public function createPayment(array $data);
}
<?php

namespace App\Service;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PetApiClientService
{

    public string $BASE_URL;

    public function __construct()
    {
        $this->BASE_URL = env('API_BASE_URL', 'https://petstore.swagger.io/v2/pet');
    }


    public function get(int $petId): array
    {
        try {
            $response = Http::get("$this->BASE_URL/$petId");

            if ($response->ok()) {
                $data = ['pet' => $response->json()];
            } else {
                $this->throwException($response);
            }
        } catch (RequestException $err) {
            $this->logError($err);

            $data = [
                'status' => $err->response->status(),
                'message' => $err->response->json()['message'] ?? 'Something went wrong, please try again later',
            ];
        }
        return $data;
    }

    public function seve(array $data, string $type): array
    {

        try {
            if ($type === 'create') {
                $response = Http::post($this->BASE_URL, $data);
            } elseif ($type === 'update') {
                $response = Http::put($this->BASE_URL, $data);
            }
            if ($response->ok()) {
                $data = [
                    'message' => 'The pet has been saved',
                    'petId' => $response->json()['id'] ?? 'unknow'
                ];
            } else {
                $this->throwException($response);
            }
        } catch (RequestException $err) {
            $this->logError($err);

            $data = [
                'error' => 'Something went wrong, please try again later',
                'code' => $response->status()
            ];
        }

        return $data;
    }

    public function delete(int $petId):array
    {
        try {
            $response = Http::delete("$this->BASE_URL/$petId");

            if($response->ok()){
                $data = ['success' => $response->ok()];
            } else {
                $this->throwException($response);
            }

        } catch (RequestException $err) {
            $this->logError($err);

            $data = [
                'error' => $response->json()['message'] ?? 'Something went wrong, please try again later',
                'code' => $response->status()
            ];
        }

        return $data;
    }

    private function throwException($response)
    {
        if ($response->clientError()) {
            throw new RequestException($response, "Client error: {$response->status()}");
        } elseif ($response->serverError()) {
            throw new RequestException($response, "Server error: {$response->status()}");
        } else {
            throw new RequestException($response, "Unexpected error: {$response->status()}");
        }
    }

    private function logError($err){
        Log::error([
            'code' => $err->response->status(),
            'error' => $err->getMessage()
        ]);
    }
}

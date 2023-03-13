<?php

namespace App\Services\AdditionalServices;

use App\Clients\MsClient;
use GuzzleHttp\Exception\ClientException;

class AttributeService
{
    public function setAllAttributesMs($data): void
    {
        $apiKeyMs = $data['tokenMs'];
        $accountId = $data['accountId'];

        try {
            $this->createOrderAttributes($apiKeyMs);
            $this->createDemandAttributes($apiKeyMs);
            $this->createSalesReturn($apiKeyMs);

            $this->createPaymentInAttributes($apiKeyMs);
            $this->createPaymentOutAttributes($apiKeyMs);
            $this->createCashInAttributes($apiKeyMs);
            $this->createCashOutAttributes($apiKeyMs);
        } catch (ClientException $e){

        }
    }

    private function createOrderAttributes($apiKeyMs): void
    {
        $bodyAttributes = $this->getDocAttributes();
        $url = "https://online.moysklad.ru/api/remap/1.2/entity/customerorder/metadata/attributes";
        $client = new MsClient($apiKeyMs);
        $this->getBodyToAdd($client, $url, $bodyAttributes);
    }

    private function createDemandAttributes($apiKeyMs): void
    {
        $bodyAttributes = $this->getDocAttributes();
        $url = "https://online.moysklad.ru/api/remap/1.2/entity/demand/metadata/attributes";
        $client = new MsClient($apiKeyMs);
        $this->getBodyToAdd($client, $url, $bodyAttributes);
    }

    private function createSalesReturn($apiKeyMs){
        $bodyAttributes = $this->getDocAttributes();
        $url = "https://online.moysklad.ru/api/remap/1.2/entity/salesreturn/metadata/attributes";
        $client = new MsClient($apiKeyMs);
        $this->getBodyToAdd($client, $url, $bodyAttributes);
    }

    private function createPaymentInAttributes($apiKeyMs):void
    {
        $bodyAttributes = $this->getPayDocAttributes();
        $url = "https://online.moysklad.ru/api/remap/1.2/entity/paymentin/metadata/attributes";
        $client = new MsClient($apiKeyMs);
        $this->getBodyToAdd($client, $url, $bodyAttributes);
    }

    private function createPaymentOutAttributes($apiKeyMs):void
    {
        $bodyAttributes = $this->getPayDocAttributes();
        $url = "https://online.moysklad.ru/api/remap/1.2/entity/paymentout/metadata/attributes";
        $client = new MsClient($apiKeyMs);
        $this->getBodyToAdd($client, $url, $bodyAttributes);
    }

    private function createCashInAttributes($apiKeyMs):void
    {
        $bodyAttributes = $this->getPayDocAttributes();
        $url = "https://online.moysklad.ru/api/remap/1.2/entity/cashin/metadata/attributes";
        $client = new MsClient($apiKeyMs);
        $this->getBodyToAdd($client, $url, $bodyAttributes);
    }

    public function createCashOutAttributes($apiKeyMs)
    {
        $bodyAttributes = $this->getPayDocAttributes();
        $url = "https://online.moysklad.ru/api/remap/1.2/entity/cashout/metadata/attributes";
        $client = new MsClient($apiKeyMs);
        $this->getBodyToAdd($client, $url, $bodyAttributes);
    }

    public function getDocAttributes(): array
    {
        return [
            0 => [
                "name" => "фискальный номер (Учёт.Касса)",
                "type" => "string",
                "required" => false,
                "description" => "данное дополнительнее поле отвечает за фискальный номер чека (Учёт.Касса)",
            ],
            1 => [
                "name" => "Ссылка для QR-кода (Учёт.Касса)",
                "type" => "link",
                "required" => false,
                "description" => "данное дополнительнее поле отвечает за ссылку на QR-код чека (Учёт.Касса)",
            ],
            2 => [
                "name" => "Фискализация (Учёт.Касса)",
                "type" => "boolean",
                "required" => false,
                "description" => "данное дополнительное поле отвечает за проведения фискализации, если стоит галочка то фискализация была (Учёт.Касса)",
            ],
            3 => [
                "name" => "ID (Учёт.Касса)",
                "type" => "string",
                "required" => false,
                "show" => false,
                "description" => "уникальный идентификатор по данному дополнительному полю идёт синхронизация с Учёт.Кассой (Учёт.Касса)",
            ],
        ];
    }

    public function getPayDocAttributes(): array
    {
        return [
            0 => [
                "name" => "Фискализация (Учёт.Касса)",
                "type" => "boolean",
                "required" => false,
                "description" => "данное дополнительное поле отвечает за проведения фискализации, если стоит галочка то фискализация была (Учёт.Касса)",
            ],
        ];
    }

    /**
     * @param MsClient $client
     * @param string $url
     * @param array $bodyAttributes
     * @return void
     */
    private function getBodyToAdd(MsClient $client, string $url, array $bodyAttributes): void
    {
        $json = $client->get($url);

        foreach ($bodyAttributes as $body) {
            $foundedAttrib = false;
            foreach ($json->rows as $row) {
                if ($body["name"] == $row->name) {
                    $foundedAttrib = true;
                    break;
                }
            }
            if (!$foundedAttrib) { $client->post($url,$body); }
        }

    }

}

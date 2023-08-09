<?php


namespace App\Helpers;


use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use http\Exception\RuntimeException;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Exception\RequestException;

class CallClient
{
    /**
     * @param string $method
     * @param string $url
     * @param array $data
     * @param array $headers
     * @return array
     * @throws GuzzleException
     */
    public static function execute(string $method, string $url, array $data, array $headers): array
    {
        $client = new Client(["timeout" => 120]);

        $options = [
            "headers" => $headers,
            "json" => $data
        ];

        try {
            switch (strtoupper($method)) {
                case "POST":
                    $response = $client->post($url, $options);
                    break;
                case "PUT":
                    $response = $client->put($url, $options);
                    break;
                default:
                    $response = $client->get($url, $options);
            }

            $responseBody = $response->getBody()->getContents();
        } catch (RequestException $exception) {
            $responseBody = $exception->getResponse()->getBody()->getContents();
        } catch (Exception $exception) {
            Log::error($exception->getMessage(), $exception->getTrace());
            throw new RuntimeException('Service unavailable currently, Please try again later. ', 503);
        }

        return json_decode($responseBody, true);
    }
}

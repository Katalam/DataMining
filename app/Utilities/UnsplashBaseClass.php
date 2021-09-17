<?php

namespace App\Utilities;

use Throwable;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class UnsplashBaseClass
{
    /**
     * Base url of unsplash api.
     *
     * @var string
     */
    private $baseUrl = 'https://api.unsplash.com/';

    /**
     * Response from unsplash api.
     */
    private $response;

    /**
     * Calls unsplash api.
     *
     * @param string $url
     * @param array  $params
     *
     * @return mix
     */
    protected function call($url, $params)
    {
        $client = new Client([
            'base_uri' => $this->baseUrl,
        ]);
        try {
            $response = $client->request('GET', $url, [
                'headers' => [
                    'Authorization'  => 'Client-ID ' . config('unsplash.ApplicationID'),
                ],
                'form_params' => $params,
                'query'       => $params,
            ]);
        } catch (Throwable $e) {
            return null;
        }
        $headers = $response->getHeaders();
        $body = json_decode($response->getBody(), true);

        if (array_key_exists('errors', $body))
        {
            return null;
        }

        if (array_key_exists('X-Ratelimit-Limit', $headers) && array_key_exists('X-Ratelimit-Remaining', $headers))
        {
            Cache::put('limit', $headers['X-Ratelimit-Limit']);
            Cache::put('remaining', $headers['X-Ratelimit-Remaining']);
        } 

        return $body;
    }
}

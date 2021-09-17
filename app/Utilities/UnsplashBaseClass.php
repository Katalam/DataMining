<?php

namespace App\Utilities;

use Throwable;
use GuzzleHttp\Client;

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
        $requestlimit = array();
        if (array_key_exists('X-Ratelimit-Limit', $headers) && array_key_exists('X-Ratelimit-Remaining', $headers))
        {
            $requestlimit = array(
                'limit' => $headers['X-Ratelimit-Limit'],
                'remaining' => $headers['X-Ratelimit-Remaining']
            );
        }
        return array($body, $requestlimit);
    }
}

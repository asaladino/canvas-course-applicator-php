<?php

namespace canvas\core\repositories;

use canvas\data\models\ApiConnector;

/**
 * Handles the basic rest repo interactions.
 * 
 * @author Adam Saladino
 */
class RestBaseRepository {

    /**
     * Holds information for connecting to the api.
     * @var ApiConnector 
     */
    public $apiConnector;

    /**
     * This should remain https.
     * @var string
     */
    public $protocol = 'https://';

    /**
     * Initialize the repos with the api connection information.
     * @param ApiConnector $apiConnector
     */
    public function __construct(ApiConnector $apiConnector) {
        $this->apiConnector = $apiConnector;
    }

    /**
     * Performs a get request on the api with the correct token.
     * @param string $uri endpoint to request.
     * @return object from json response.
     */
    public function get($uri) {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $this->protocol . $this->apiConnector->server . $uri,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $this->apiConnector->token
            ]
        ]);
        $resp = curl_exec($curl);
        curl_close($curl);
        return json_decode($resp);
    }

    /**
     * Performs a post request on the api with the correct token.
     * @param string $uri endpoint to request.
     * @param mixed $data to send to the endpoint.
     * @return object from json response.
     */
    public function post($uri, $data) {
        $url = $this->protocol . $this->apiConnector->server . $uri;
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer {$this->apiConnector->token}"
            ],
            CURLOPT_URL => $url,
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => (array) $data
        ]);
        $resp = curl_exec($curl);
        curl_close($curl);
        return json_decode($resp);
    }

}

<?php

namespace canvas\data\models;

/**
 * Canvas API connector information.
 * 
 * @author Adam Saladino
 */
class ApiConnector {

    /**
     * Domain name of the canvas instance.
     * @var string
     */
    public $server;

    /**
     * Canvas api access token.
     * @var string
     */
    public $token;

    /**
     * Initialize an api connector from a config.
     * @param Config $config to build from.
     */
    public function __construct($config) {
        $this->server = $config->server;
        $this->token = $config->token;
    }

}

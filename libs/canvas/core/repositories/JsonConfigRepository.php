<?php

namespace canvas\core\repositories;

use canvas\data\models\Config;

/**
 * Reads the config file for the app.
 *
 * @author Adam Saladino
 */
class JsonConfigRepository {

    /**
     * Location of the config file.
     * @var string
     */
    private $file;

    /**
     * Initialize the repo with the config location.
     * @param string $file
     */
    public function __construct($file) {
        $this->file = $file;
    }

    /**
     * Read the configuration.
     * @return Config
     * @throws /Exception if the file is not file.
     */
    public function read() {
        if (!file_exists($this->file)) {
            throw new \Exception("Missing config file at: $this->file");
        }
        $jsonText = file_get_contents($this->file, true);
        $configJson = json_decode($jsonText);
        return new Config($configJson);
    }

}

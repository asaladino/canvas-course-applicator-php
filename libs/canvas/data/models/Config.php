<?php

namespace canvas\data\models;

/**
 * Config for the app.
 *
 * @author Adam Saladino
 */
class Config {

    /**
     * Location of the csv file.
     * @var string
     */
    public $csv;

    /**
     * Course ID to migrate to the courses in the csv file.
     * @var string 
     */
    public $source_course_id;

    /**
     * Where the courses are loaded.
     * @var string
     */
    public $account_id;

    /**
     * Domain for the canvas server.
     * @var string
     */
    public $server;

    /**
     * Token to access the canvas api.
     * @var string
     */
    public $token;

    /**
     * Initialize the config file from a generic object.
     * @param object $entry to map from.
     */
    public function __construct($entry) {
        foreach ($entry as $key => $value) {
            $this->{$key} = $value;
        }
    }

}

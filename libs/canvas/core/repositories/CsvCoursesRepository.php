<?php

namespace canvas\core\repositories;

use canvas\data\models\Course;
use canvas\data\models\Config;

/**
 * Loads all the courses from the csv file.
 *
 * @author Adam Saladino
 */
class CsvCoursesRepository {

    /**
     * App configuration.
     * @var Config 
     */
    private $config;

    /**
     * Headers from the csv file.
     * @var string[] 
     */
    private $headers;

    /**
     * Create a repository with a config file.
     * @param Config $config
     */
    public function __construct($config) {
        $this->config = $config;
    }

    /**
     * Find all the courses in the csv file.
     * @return Course[]
     */
    public function findAll() {
        $entries = $this->getEntries();
        return $this->mapToObject($entries);
    }

    /**
     * Get all the entries in the file as an array and get the header.
     * @return array
     */
    private function getEntries() {
        $file = fopen($this->config->csv, "r");
        $i = 0;
        while (!feof($file)) {
            if ($i !== 0) {
                $entries[] = fgetcsv($file);
            } else {
                $this->headers = fgetcsv($file);
            }
            $i++;
        }
        fclose($file);
        return $entries;
    }

    /**
     * Map the enties in the csv to an array of courses.
     * @param string[string[]] $entries
     * @return Course[]
     */
    private function mapToObject($entries) {
        $list = [];
        foreach ($entries as $entry) {
            if (sizeof($entry) > 1) {
                $list[] = new Course($this->headers, $entry);
            }
        }
        return $list;
    }

}

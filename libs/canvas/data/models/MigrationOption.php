<?php

namespace canvas\data\models;

/**
 * Describes the content migration that will be performed.
 *
 * @author Adam Saladino
 */
class MigrationOption {

    /**
     * This can be other options but course copy is default.
     * @var string
     */
    public $migration_type = 'course_copy_importer';

    /**
     * There are a lot of options but we are only interest in source_course_id.
     * @var string[]
     */
    public $settings;

    /**
     * Initialize the migration option from a config.
     * @param Config $config
     */
    public function __construct($config) {
        $this->settings['source_course_id'] = $config->source_course_id;
    }

    /**
     * Get the parameters as post fields.
     * @return array as post fields
     */
    public function asPostFields() {
        $fields = [];
        $fields['migration_type'] = $this->migration_type;
        foreach ($this->settings as $key => $value) {
            $fields["settings[$key]"] = $value;
        }
        return $fields;
    }

}

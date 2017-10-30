<?php

namespace canvas\data\models;

/**
 * Describes the course to apply a template to.
 *
 * @author Adam Saladino
 */
class Course {

    /**
     * SIS course id.
     * @var string 
     */
    public $course_id;

    /**
     * Seems to be the same as the course id.
     * @var string 
     */
    public $short_name;

    /**
     * Short name + the tile.
     * @var string
     */
    public $long_name;

    /**
     * College the course belongs to: ACCT, ARTS, etc...
     * @var string
     */
    public $account_id;

    /**
     * Term the course is offered.
     * @var string 
     */
    public $term_id;

    /**
     * Status of the course, hopefully active.
     * @var string 
     */
    public $status;

    /**
     * Date the course starts.
     * @var string
     */
    public $start_date;

    /**
     * Date the course ends.
     * @var string
     */
    public $end_date;

    /**
     * Initialize the course file from a generic object and field names.
     * @param array $headers Name of the fields to map the object to.
     * @param object $entry to map from.
     */
    public function __construct($headers, $entry) {
        foreach ($entry as $key => $value) {
            $this->{$headers[$key]} = $value;
        }
    }

}

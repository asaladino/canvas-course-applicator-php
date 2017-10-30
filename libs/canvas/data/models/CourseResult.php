<?php

namespace canvas\data\models;

/**
 * Describes the canvas course. See canvas api for more information.
 * We are just interested in the sis_canvas_id.
 *
 * @author Adam Saladino
 */
class CourseResult {

    public $id;
    public $name;
    public $account_id;
    public $start_at;
    public $grading_standard_id;
    public $is_public;
    public $course_code;
    public $default_view;
    public $enrollment_term_id;
    public $end_at;
    public $public_syllabus;
    public $storage_quota_mb;
    public $is_public_to_auth_users;
    public $apply_assignment_group_weights;

    /**
     * Use to make sure the correct course is getting migrated too.
     * @var string 
     */
    public $sis_course_id;
    public $integration_id;
    public $hide_final_grades;
    public $workflow_statepublic;
    public $restrict_enrollments_to_course_dates;

    /**
     * Initialize the course result from a generic object.
     * @param array $entry to map from.
     */
    public function __construct($entry = array()) {
        foreach ($entry as $key => $value) {
            $this->{$key} = $value;
        }
    }

}

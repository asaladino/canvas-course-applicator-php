<?php

namespace canvas\core\repositories;

use canvas\data\models\CourseResult;

/**
 * Searches for a course based on sis course id.
 * https://canvas.instructure.com/doc/api/accounts.html#method.accounts.courses_api
 * 
 * @author Adam Saladino
 */
class RestCoursesSearchRepository extends RestBaseRepository {

    /**
     * Search for a course based on sis course id.
     * 
     * curl https://<instance>.test.instructure.com/api/v1/accounts/1/courses?search_term=ACCT_201_601_2016SU \
     * -H 'Authorization: Bearer 1adfAHlSCi9'
     * 
     * @param int $account_id that has has the course.
     * @param string $search_term is the sis course id.
     * @return CourseResult for the course found or null.
     */
    public function find($account_id, $search_term) {
        $uri = "/api/v1/accounts/$account_id/courses?search_term=$search_term";
        $response = $this->get($uri);
        if (!is_null($response)) {
            foreach ($response as $entry) {
                $courseResult = new CourseResult($entry);
                if ($search_term === $courseResult->sis_course_id) {
                    return $courseResult;
                }
            }
        }
        return new CourseResult();
    }

}

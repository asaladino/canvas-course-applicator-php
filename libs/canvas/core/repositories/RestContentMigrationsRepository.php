<?php

namespace canvas\core\repositories;

use canvas\data\models\MigrationOption;
use canvas\data\models\CourseResult;
use canvas\data\models\ContentMigration;

/**
 * Interfaces with the canvas content migrations api.
 * https://canvas.instructure.com/doc/api/content_migrations.html#method.content_migrations.create
 *
 * @author Adam Saladino
 */
class RestContentMigrationsRepository extends RestBaseRepository {

    /**
     * Update content on an existing course. 
     * 
     * curl 'https://<instance>.test.instructure.com/api/v1/courses/11319/content_migrations' \
     * -X POST \
     * -F 'migration_type=course_copy_importer' \
     * -F 'settings[source_course_id]=13995' \
     * -H 'Authorization: Bearer 1afdOAHlSCi9'
     * 
     * @param CourseResult $courseResult - is a canvas course with the correct canvas id.
     * @param MigrationOption $migrationOption - information about the migration.
     * @return ContentMigration - information about the content migration.
     */
    public function update($courseResult, $migrationOption) {
        $uri = "/api/v1/courses/$courseResult->id/content_migrations";
        $response = $this->post($uri, $migrationOption->asPostFields());
        return new ContentMigration($response);
    }

}

<?php

// Load all the libraries.
require_once('./libs/autoloader.php');

// Use the template service.
use canvas\core\services\TemplateService;
use canvas\data\models\ContentMigration;
use canvas\data\models\CourseResult;
use canvas\data\models\Course;

// Create the template service using the config file.
$configFile = './config/config.json';
$templateService = new TemplateService($configFile);

echo "Starting Canvas Course Applicator\n\n";
echo "Applying template to courses:\n\n";

// Apply template to all the courses in the csv file.
$templateService->applyTemplateToCourses(function(CourseResult $courseResult, ContentMigration $contentMigration) {
    echo "Updated course:\t$courseResult->id | $contentMigration->migration_type_title\n";
    echo "\tProgress:\t$contentMigration->progress_url\n";
    echo "\tIssues:\t\t$contentMigration->migration_issues_url\n\n";
}, function(Course $course) {
    echo "Course not found:\t$course->course_id | $course->long_name\n";
});

// Print summary:
echo "Courses updated:\t" . count($templateService->updatedCourses) . "\n";
echo "Courses not Found:\t" . count($templateService->notFoundCourses) . "\n";
echo "-------------------------\n";
echo "Done!";

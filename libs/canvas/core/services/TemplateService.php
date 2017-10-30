<?php

namespace canvas\core\services;

use canvas\core\repositories\CsvCoursesRepository;
use canvas\core\repositories\JsonConfigRepository;
use canvas\core\repositories\RestContentMigrationsRepository;
use canvas\core\repositories\RestCoursesSearchRepository;
use canvas\data\models\ContentMigration;
use canvas\data\models\MigrationOption;
use canvas\data\models\Config;
use canvas\data\models\ApiConnector;
use canvas\data\models\Course;

/**
 * The update service performs the following tasks:
 * 1) Reads the config file.
 * 2) Build migration options from config.
 * 3) Find all the courses in the csv file.
 * 4) Loop through the courses:
 *      1) Get the canvas course id for the course.
 *      2) If the course exists in canvas then migrate information from course
 *         listed in config file.
 * @author Adam Saladino
 */
class TemplateService {

    /**
     * Configuration information for the app.
     * @var Config
     */
    public $config;

    /**
     * Location of the config file.
     * @var string 
     */
    public $configFile;

    /**
     * Information for connecting to the canvas api.
     * @var ApiConnector
     */
    public $apiConnector;

    /**
     * Gets information from the config file.
     * @var JsonConfigRepository 
     */
    public $jsonConfigRepository;

    /**
     * Reads all the courses from the csv.
     * @var CsvCoursesRepository 
     */
    public $csvCoursesRepository;

    /**
     * Updates the course through the canvas api.
     * @var RestContentMigrationsRepository 
     */
    public $restContentMigrationsRepository;

    /**
     * Searches for a course through the canvas api.
     * @var RestCoursesSearchRepository 
     */
    public $restCoursesSearchRepository;

    /**
     * Tracks a list of courses that have been updated.
     * @var ContentMigration[];
     */
    public $updatedCourses;

    /**
     * Tracks a list of courses that were not found in canvas.
     * @var Course[];
     */
    public $notFoundCourses;

    /**
     * Initialize the template service with the config file.
     * @param string $configFile
     */
    public function __construct($configFile) {
        $this->configFile = $configFile;
        $this->load();
    }

    /**
     * Load all the repositories.
     */
    public function load() {
        $this->jsonConfigRepository = new JsonConfigRepository($this->configFile);
        $this->config = $this->jsonConfigRepository->read();
        $this->csvCoursesRepository = new CsvCoursesRepository($this->config);
        $apiConnector = new ApiConnector($this->config);
        $this->restContentMigrationsRepository = new RestContentMigrationsRepository($apiConnector);
        $this->restCoursesSearchRepository = new RestCoursesSearchRepository($apiConnector);
    }

    /**
     * Apply the course template to the courses in the csv file.
     * @param $success callback  for a successful update.
     * @param $error callback for course not found.
     */
    public function applyTemplateToCourses($success, $error) {
        $this->updatedCourses = $this->notFoundCourses = [];
        $contentMigration = new MigrationOption($this->config);
        $courses = $this->csvCoursesRepository->findAll();
        foreach ($courses as $course) {
            $courseResult = $this->restCoursesSearchRepository->find($this->config->account_id, $course->course_id);
            if (!is_null($courseResult)) {
                $response = $this->restContentMigrationsRepository->update($courseResult, $contentMigration);
                $this->updatedCourses[] = $response;
                $success($courseResult, $response);
            } else {
                $error($course);
                $this->notFoundCourses[] = $course;
            }
        }
    }

}

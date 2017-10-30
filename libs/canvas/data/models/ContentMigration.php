<?php

namespace canvas\data\models;

/**
 * This is returned from a content migration from the api.
 *
 * @author Adam Saladino
 */
class ContentMigration {

    /**
     * The unique identifier for the migration.
     * @var string
     */
    public $id;

    /**
     * The type of content migration.
     * @var string
     */
    public $migration_type;

    /**
     * The name of the content migration type.
     * @var string
     */
    public $migration_type_title;

    /**
     * API url to the content migration's issues.
     * @var string
     */
    public $migration_issues_url;

    /**
     * Attachment api object for the uploaded file may not be present for all 
     * migrations.
     * @var string
     */
    public $attachment;

    /**
     * The api endpoint for polling the current progress.
     * @var string
     */
    public $progress_url;

    /**
     * The user who started the migration.
     * @var string
     */
    public $user_id;

    /**
     * Current state of the content migration: pre_processing, pre_processed,
     * running, waiting_for_select, completed, failed.
     * @var string
     */
    public $workflow_state;

    /**
     * Timestamp.
     * @var string
     */
    public $started_at;

    /**
     * Timestamp.
     * @var string
     */
    public $finished_at;

    /**
     * Tile uploading data, see {file:file_uploads.html File Upload Documentation} for
     * file upload workflow This works a little differently in that all the file data
     * is in the pre_attachment hash if there is no upload_url then there was an
     * attachment pre-processing error, the error message will be in the message key
     * This data will only be here after a create or update call
     * @var string
     */
    public $pre_attachment;

    /**
     * Initialize the content migration with a generic object.
     * @param object $entry to map from.
     */
    public function __construct($entry) {
        foreach ($entry as $key => $value) {
            $this->{$key} = $value;
        }
    }

}

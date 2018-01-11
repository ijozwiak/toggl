<?php
namespace TogglBundle\lib;

interface TogglLibraryInterface
{
    /**
     * Init TogglApi
     * @param $apiToken
     * @return mixed
     */
    public function init($apiToken);

    /**
     * Create entry in Toggl
     *
     * @param string $entryDate
     * @param null|int $projectId
     * @param null|int $taskId
     * @param null|string $entryName
     * @return json
     */
    public function create($entryDate, $projectId = null, $taskId = null, $entryName = null);

    /**
     * Remove entry from Toggl
     *
     * @param int $entryId
     * @return json
     */
    public function remove($entryId);

    /**
     * Get service name
     *
     * @return string
     */
    public function getName();

    /**
     * Get task description
     *
     * @return string
     */
    public function getDescription($entryName);

    /**
     * Get entry's duration
     *
     * @return int
     */
    public function getDuration();

    /**
     * Set project id
     *
     * @param array $params
     * @param null|int $projectId
     */
    public function setPID(&$params, $projectId);

    /**
     * Set task id
     *
     * @param array $params
     * @param null|int $taskId
     */
    public function setTID(&$params, $taskId);
}
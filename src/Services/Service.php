<?php
/**
 * @author      Iwona Jóźwiak <ijozwiak@divante.pl>
 * @category    DivanteAdventure
 * @package     TogglBundle
 * @date        10.12.2017
 * @copyright   Copyright (C) 2017 Divante Sp. z o.o.
 * @license     http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

namespace TogglBundle\Services;
use TogglBundle\lib\TogglLibraryInterface;

/**
 * Class Service
 * @package TogglBundle\Services
 */
class Service
{
    protected $togglApi;

    /**
     * Service constructor.
     * @param TogglApi $togglApi
     * @param string $apiName
     * @param string $defaultEntryName
     * @param int $defaultProjectId
     * @param int $defaultTaskId
     */
    public function __construct(TogglLibraryInterface $togglApi, $settings)
    {
        $this->togglApi = $togglApi;

        $this->togglApi->setConfig($settings);
    }

    /**
     * Init togglApi
     *
     * @param string $apiToken
     * @return $this
     */
    public function init($apiToken)
    {
        $this->togglApi->init($apiToken);

        return $this;
    }

    /**
     * Create entry in Toggl
     *
     * @param string $entryDate
     * @param null|int $projectId
     * @param null|int $taskId
     * @param null|string $entryName
     * @return json
     */
    public function create($entryDate, $projectId = null, $taskId = null, $entryName = null)
    {
        return $this->togglApi->create($entryDate, $projectId, $taskId, $entryName);
    }

    /**
     * Remove entry from Toggl
     *
     * @param int $entryId
     * @return json
     */
    public function remove($taskId)
    {
        return $this->togglApi->remove($taskId);
    }
}
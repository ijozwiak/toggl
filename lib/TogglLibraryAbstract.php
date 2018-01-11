<?php
namespace TogglBundle\lib;

use MorningTrain\TogglApi\TogglApi;
use TogglBundle\lib\TogglLibraryInterface;

abstract class TogglLibraryAbstract implements TogglLibraryInterface
{
    /** @const int Entry's duration */
    const DURATION = 28800;

    /** @object MorningTrain\TogglApi\TogglApi */
    protected $togglApi;

    /** @var  string $togglApiToken */
    protected $togglApiToken;

    /** @var  string $togglApiName */
    protected $togglApiName;

    /** @var  int $togglProjectId */
    protected $togglProjectId;

    /** @var  int $togglTaskId */
    protected $togglTaskId;

    /** @var  string $togglEntryName */
    protected $togglEntryName;

    /**
     * TogglLibraryAbstract constructor.
     */
    public function __construct()
    {
    }

    /**
     * Init togglApi
     * @param string $apiToken
     */
    public function init($apiToken)
    {
        $this->togglApiToken = $apiToken;
        $this->togglApi      = new TogglApi($apiToken);

        return $this;
    }

    /**
     * Get service name
     *
     * @return string
     */
    public function getName()
    {
        return $this->togglApiName;
    }

    /**
     * Get entry name
     *
     * @param string $entryName
     * @return string|srting
     */
    public function getDescription($entryName)
    {
        return !is_null($entryName) ? $entryName : $this->togglEntryName;
    }

    /**
     * Get entry's duration
     *
     * @return int
     */
    public function getDuration()
    {
        return self::DURATION;
    }

    /**
     * Set project id
     *
     * @param array $params
     * @param null|int $projectId
     */
    public function setPID(&$params, $projectId)
    {
        if ($projectId) {
            $params['pid'] = $projectId;
        } else if ($this->togglProjectId) {
            $params['pid'] = $this->togglProjectId;
        }
    }

    /**
     * Set task id
     *
     * @param array $params
     * @param null|int $tasktId
     */
    public function setTID(&$params, $taskId)
    {
        if ($taskId) {
            $params['tid'] = $taskId;
        } else if ($this->togglTaskId) {
            $params['tid'] = $this->togglTaskId;
        }
    }

    /**
     * @param string $togglApiName
     */
    public function setTogglApiName($togglApiName)
    {
        $this->togglApiName = $togglApiName;
    }

    /**
     * @param string $defaultEntryName
     */
    public function setTogglEntryName($defaultEntryName)
    {
        $this->togglEntryName = $defaultEntryName;
    }

    /**
     * @param int $defaultProjectId
     */
    public function setTogglProjectId($defaultProjectId)
    {
        $this->togglProjectId = $defaultProjectId;
    }

    /**
     * @param int $defaultTaksId
     */
    public function setTogglTaskId($defaultTaksId)
    {
        $this->togglTaskId    = $defaultTaksId;
    }
}
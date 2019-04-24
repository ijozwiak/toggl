<?php
/**
 * @author      Iwona Jóźwiak <ijozwiak@divante.pl>
 * @category    DivanteAdventure
 * @package     TogglBundle
 * @date        10.12.2017
 * @copyright   Copyright (C) 2017 Divante Sp. z o.o.
 * @license     http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

namespace TogglBundle\lib;

use MorningTrain\TogglApi\TogglApi;
use TogglBundle\lib\TogglLibraryInterface;

/**
 * Class TogglLibraryAbstract
 * @package TogglBundle\lib
 */
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

    /** @var  array $config */
    protected $config;


    /**
     * Map project id
     *
     * @param array $params
     * @param null|int $projectId
     */
    private function _mapPID($projectId)
    {
        if (isset($this->config['mapping']['projects'][$projectId])) {
            return $this->config['mapping']['projects'][$projectId];
        }

        return $projectId;
    }

    /**
     * Map task id
     *
     * @param array $params
     * @param null|int $projectId
     */
    private function _mapTID($taskId)
    {
        if (isset($this->config['mapping']['tasks'][$taskId]['id'])) {
            return $this->config['mapping']['tasks'][$taskId]['id'];
        }

        return $taskId;
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
        if (!$entryName
            && !is_null($this->togglTaskId)
            && isset($this->config['mapping']['tasks'][$this->togglTaskId]['name'])
        ) {
            return $this->config['mapping']['tasks'][$this->togglTaskId]['name'];
        } else {
            return $this->togglEntryName;
        }
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
        if (!is_null($projectId)) {
            $params['pid'] = $this->_mapPID($projectId);
            $this->togglProjectId = $projectId;
        } else if (!is_null($this->togglProjectId)) {
            $params['pid'] = $this->_mapPID($this->togglProjectId);
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
        if (!is_null($taskId)) {
            $params['tid'] = $this->_mapTID($taskId);
            $this->togglTaskId = $taskId;
        } else if (!is_null($this->togglTaskId)) {
            $params['tid'] = $this->_mapTID($this->togglTaskId);
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

    /**
     * @param array $config
     */
    public function setConfig($config)
    {
        $this->config    = $config;
        $this->setTogglApiName($config['service_name']);
        $this->setTogglEntryName($config['default_entry_name']);
        $this->setTogglProjectId($config['default_project_id']);
        $this->setTogglTaskId($config['default_task_id']);
    }
}
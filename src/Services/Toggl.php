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

use TogglBundle\lib\TogglLibraryAbstract;
use TogglBundle\lib\TogglLibraryInterface;

/**
 * Class Toggl
 * @package TogglBundle\Services
 */
class Toggl extends TogglLibraryAbstract implements TogglLibraryInterface
{
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
        $params = [
            'bilable'      => false,
            'start'        => $entryDate, //'2017-12-07T12:58:58.000Z',
            'duration'     => $this->getDuration(), // 60s * 60min * 8h,
            'description'  => $this->getDescription($entryName),
            'created_with' => $this->getName(),
        ];

        $this->setPID($params, $projectId);
        $this->setTID($params, $taskId);
        $this->setTogglEntryName($entryName, $params);
        $params['description'] = $this->getDescription($entryName);

        return $this->togglApi->createTimeEntry($params);
    }

    /**
     * Remove entry from Toggl
     *
     * @param int $entryId
     * @return json
     */
    public function remove($entryId)
    {
        return $this->togglApi->deleteTimeEntry($entryId);
    }
}
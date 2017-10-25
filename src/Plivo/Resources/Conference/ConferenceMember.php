<?php
/**
 * Created by PhpStorm.
 * User: kritarth
 * Date: 25/05/17
 * Time: 4:10 PM
 */

namespace Plivo\Resources\Conference;


use Plivo\Exceptions\PlivoRestException;
use Plivo\BaseClient;
use Plivo\Resources\Resource;

/**
 * Class ConferenceMember
 * @package Plivo\Resources\Conference
 */
class ConferenceMember extends Resource
{
    protected $muted;
    protected $memberId;
    protected $deaf;
    protected $from;
    protected $to;
    protected $callerName;
    protected $direction;
    protected $callUuid;
    protected $joinTime;

    /**
     * ConferenceMember constructor.
     * @param BaseClient $client
     * @param $muted
     * @param $memberId
     * @param $deaf
     * @param $from
     * @param $to
     * @param $callerName
     * @param $direction
     * @param $callUuid
     * @param $joinTime
     */
    function __construct(
        BaseClient $client, $muted, $memberId, $deaf, $from,
        $to, $callerName, $direction, $callUuid, $joinTime)
    {
        parent::__construct($client);
        $this->muted = $muted;
        $this->memberId = $memberId;
        $this->deaf = $deaf;
        $this->from = $from;
        $this->to = $to;
        $this->callerName= $callerName;
        $this->direction = $direction;
        $this->callUuid = $callUuid;
        $this->joinTime = $joinTime;
    }

    /**
     * @param $name
     * @return mixed
     * @throws PlivoRestException
     */
    function __get($name)
    {
        if (property_exists($this, $name))
            return $this->$name;

        throw new PlivoRestException(
            "Property named " . $name . " does not exist"
        );
    }
}
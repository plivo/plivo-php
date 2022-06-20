<?php

namespace Plivo\Resources\Zentrunk;

use Plivo\BaseClient;
use Plivo\Resources\ResourceInterface;

/**
 * Class ZentrunkInterface
 * @package Plivo\Resources\Zentrunk
 */
class ZentrunkInterface extends ResourceInterface
{
    /**
     * ZentrunkInterface constructor.
     * @param BaseClient $plivoClient
     */
    public function __construct(BaseClient $plivoClient, $authId)
    {
        parent::__construct($plivoClient);
        $this->pathParams = [
            'authId' => $authId
        ];
        $this->uri = "Account/".$authId."/Call/";
    }
    
    /**
     * Get a list of Zentrunk calls
     *
     * @param array $optionalArgs
     * 
     * 
     *   + Valid arguments with their types
     *   + [string] trunk_id - The ID of a trunk, if you want to retrieve only calls made from a specific trunk.
     *   + [string] call_direction - Filter the results by call direction. The valid inputs are inbound and outbound.
     *   + [string] from_number - Filter the results by the number from where the call originated. For example:<br />
    To filter out those numbers that contain a particular number sequence, use from_number={sequence}<br />
    To filter out a number that matches an exact number, use from_number={exact_number}
     *   + [string] to_number - Filter the results by the number to which the call was made. Tips to use this filter are:<br />
    To filter out those numbers that contain a particular number sequence, use to_number={sequence}<br />
    To filter out a number that matches an exact number, use to_number={exact_number}
     *   + [string] bill_duration - Filter the results according to billed duration. The value of billed duration is in seconds. The filter can be used in one of the following five forms:<br />
    bill_duration: Input the exact value. E.g., to filter out calls that were exactly three minutes long, use bill_duration=180<br />
    bill_duration\__gt: gt stands for greater than. E.g., to filter out calls that were more than two hours in duration bill_duration\__gt=7200<br />
    bill_duration\__gte: gte stands for greater than or equal to. E.g., to filter out calls that were two hours or more in duration bill_duration\__gte=7200<br />
    bill_duration\__lt: lt stands for lesser than. E.g., to filter out calls that were less than seven minutes in duration bill_duration\__lt=420<br />
    bill_duration\__lte: lte stands for lesser than or equal to. E.g., to filter out calls that were two hours or less in duration bill_duration\__lte=7200
     *   + [string] end_time - Filter out calls according to the time of completion. The filter can be used in the following five forms:<br />
    end_time: The format expected is YYYY-MM-DD HH:MM[:ss[.uuuuuu]]. E.g., To get all calls that ended at 2012-03-21 11:47[:30], use end_time=2012-03-21 11:47[:30]<br />
    end_time\__gt: gt stands for greater than. The format expected is YYYY-MM-DD HH:MM[:ss[.uuuuuu]]. E.g., To get all calls that ended after 2012-03-21 11:47, use end_time\__gt=2012-03-21 11:47<br />
    end_time\__gte: gte stands for greater than or equal. The format expected is YYYY-MM-DD HH:MM[:ss[.uuuuuu]]. E.g., To get all calls that ended after or exactly at 2012-03-21 11:47[:30], use end_time\__gte=2012-03-21 11:47[:30]<br />
    end_time\__lt: lt stands for lesser than. The format expected is YYYY-MM-DD HH:MM[:ss[.uuuuuu]]. E.g., To get all calls that ended before 2012-03-21 11:47, use end_time\__lt=2012-03-21 11:47<br />
    end_time\__lte: lte stands for lesser than or equal. The format expected is YYYY-MM-DD HH:MM[:ss[.uuuuuu]]. E.g., To get all calls that ended before or exactly at 2012-03-21 11:47[:30], use end_time\__lte=2012-03-21 11:47[:30]  
    Note: The above filters can be combined to get calls that ended in a particular time range. The timestamps need to be UTC timestamps.
     *  + [string] initiation_time -  Filters calls by their initiation time. 
    initiation_time:The time format expected is YYYY-MM-DD HH:MM[:ss[.uuuuuu]].  E.g., To get all calls that initiated at 2012-03-21 11:47[:30], use initiation_time=2012-03-21 11:47[:30]<br />
    initiation_time\__gt: gt stands for greater than. The format expected is YYYY-MM-DD HH:MM[:ss[.uuuuuu]]. E.g., To get all calls that initiated after 2012-03-21 11:47, use initiation_time\__gt=2012-03-21 11:47<br />
    initiation_time\__gte: gte stands for greater than or equal. The format expected is YYYY-MM-DD HH:MM[:ss[.uuuuuu]]. E.g., To get all calls that initiated after or exactly at 2012-03-21 11:47[:30], use initiation_time\__gte=2012-03-21 11:47[:30]<br />
    initiation_time\__lt: lt stands for lesser than. The format expected is YYYY-MM-DD HH:MM[:ss[.uuuuuu]]. E.g., To get all calls that initiated before 2012-03-21 11:47, use initiation_time\__lt=2012-03-21 11:47<br />
    initiation_time\__lte: lte stands for lesser than or equal. The format expected is YYYY-MM-DD HH:MM[:ss[.uuuuuu]]. E.g., To get all calls that initiated before or exactly at 2012-03-21 11:47[:30], use initiation_time\__lte=2012-03-21 11:47[:30]  
     *  + [int] limit - Used to display the number of results per page. The maximum number of results that can be fetched is 20.
     *  + [int] offset - Denotes the number of value items by which the results should be offset. E.g., If the result contains a 1000 values and limit is set to 10 and offset is set to 705, then values 706 through 715 are displayed in the results. This parameter is also used for pagination of the results.
     * @return ZentrunkCallList
     */
    public function getList(array $optionalArgs = [])
    {
        $optionalArgs['isZentrunkRequest'] = true;
        $response = $this->client->fetch(
            $this->uri,
            $optionalArgs
        );

        $calls = [];

        foreach ($response->getContent()['objects'] as $call) {
            $newCall = new Zentrunk($this->client, $call, $this->pathParams['authId'], $call['call_uuid']);

            array_push($calls, $newCall);
        }
        return
            new ZentrunkList(
                $this->client,
                $response->getContent()['meta'],
                $calls);
    }


}

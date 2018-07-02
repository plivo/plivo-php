<?php

namespace Plivo\Resources\Number;


use Plivo\Exceptions\PlivoValidationException;
use Plivo\BaseClient;

use Plivo\Resources\ResourceInterface;
use Plivo\Resources\ResourceList;
use Plivo\Resources\ResponseUpdate;
use Plivo\Util\ArrayOperations;

/**
 * Class NumberInterface
 * @method ResourceList list
 * @package Plivo\Resources\Number
 */
class NumberInterface extends ResourceInterface
{
    /**
     * NumberInterface constructor.
     * @param BaseClient $plivoClient
     * @param $authId
     */
    function __construct(BaseClient $plivoClient, $authId)
    {
        parent::__construct($plivoClient);

        $this->pathParams = [
            'authId' => $authId
        ];

        $this->uri = "Account/".$authId."/Number/";
    }

    /**
     * @param array $optionalArgs
     *   + Valid arguments
     *   + [string] type - The type of number you are filtering. You can filter by local and tollfree numbers. Defaults to a local number.
     *   + [string|Int] number_startswith  - Used to specify the beginning of the number. For example, if the number '24' is specified, the API will fetch only those numbers beginning with '24'.
     *   + [string] subaccount - Requires the auth_id of the subaccount as input. If this parameter is included in the request, all numbers of the particular subaccount are displayed.
     *   + [string] alias - This is a name given to the number. The API will fetch only those numbers with the alias specified.
     *   + [string] services - Filters out phone numbers according to the services you want from that number. The following values are valid:
     *                         <br /> voice - Returns a list of numbers that provide 'voice' services. Additionally, if the numbers offer both 'voice' and 'sms', they are also listed. Note - This option does not exclusively list those services that provide both voice and sms .
     *                         <br /> voice,sms - Returns a list of numbers that provide both 'voice' and 'sms' services.
     *                         <br /> sms - Returns a list of numbers that provide only 'sms' services.
     *   + [int] limit - Used to display the number of results per page. The maximum number of results that can be fetched is 20.
     *   + [int] offset - Denotes the number of value items by which the results should be offset. Eg:- If the result contains a 1000 values and limit is set to 10 and offset is set to 705, then values 706 through 715 are displayed in the results. This parameter is also used for pagination of the results.
     * @return ResourceList
     */
    public function getList($optionalArgs = [])
    {
        $response = $this->client->fetch(
            $this->uri,
            $optionalArgs
        );

        $numbers = [];

        foreach ($response->getContent()['objects'] as $number) {
            $newNumber = new Number(
                $this->client, $number, $this->pathParams['authId']);

            array_push($numbers, $newNumber);
        }

        return new ResourceList(
            $this->client, $response->getContent()['meta'], $numbers);
    }


    /**
     * Returns a number instance
     *
     * @param string $number
     * @return Number
     * @throws PlivoValidationException
     */
    public function get($number)
    {
        if (ArrayOperations::checkNull([$number])) {
            throw
            new PlivoValidationException(
                'number is mandatory');
        }

        $response = $this->client->fetch(
            $this->uri . $number .'/',
            []
        );

        return new Number(
            $this->client, $response->getContent(),
            $this->pathParams['authId']);
    }

    /**
     * Modify a number
     * @param string $number
     * @param array $optionalArgs
     *   + Valid arguments
     *   + [string] alias - The textual name given to the number.
     *   + [string] app_id - The application id of the application that is to be linked.
     *   + [string] subaccount - The auth_id of the subaccount to which this number should be added. This can only be performed by a main account holder.
     * @return ResponseUpdate
     */
    public function update($number, $optionalArgs = [])
    {
        $response = $this->client->update(
            $this->uri . $number . '/',
            $optionalArgs
        );

        $responseContents = $response->getContent();

        return new ResponseUpdate(
            $responseContents['api_id'],
            $responseContents['message']);
    }

    /**
     * @param $number
     * @throws PlivoValidationException
     */
    public function delete($number)
    {
        if (is_null($number) || empty($number)) {
            throw
            new PlivoValidationException(
                'number cannot be null or empty');
        }
        $this->client->delete(
            $this->uri . $number . '/',
            []
        );
    }

    /**
     * Buy a new number
     *
     * @param array $numbers
     * @param $carrier
     * @param $region
     * @param array $optionalArgs
     *   + Valid arguments
     *   + [string] number_type - This field does not impact the way Plivo uses this number. It is primarily adding more information about your number. You may use this field to categorize between local and tollfree numbers. Default is local.
     *   + [string] app_id - The application id of the application that is to be linked.
     *   + [string] subaccount - The auth_id of the subaccount to which this number should be added. This can only be performed by a main account holder.
     * @return ResponseUpdate
     * @throws PlivoValidationException
     */
    public function addNumber(
        array $numbers, $carrier, $region, array $optionalArgs = [])
    {
        $mandatoryArgs = [
            'numbers' => join(',', $numbers),
            'carrier' => $carrier,
            'region' => $region
        ];

        if (ArrayOperations::checkNull($mandatoryArgs)) {
            throw new PlivoValidationException(
                "Mandatory parameters cannot be null");
        }

        $response = $this->client->update(
            $this->uri,
            array_merge($mandatoryArgs, $optionalArgs)
        );

        $responseContents = $response->getContent();

        return new ResponseUpdate(
            $responseContents['api_id'],
            $responseContents['message']);
    }
}
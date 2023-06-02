<?php

namespace Plivo\Resources\PhoneNumber;

use Plivo\Exceptions\PlivoResponseException;
use Plivo\BaseClient;
use Plivo\Resources\ResourceInterface;
use Plivo\Resources\ResourceList;

/**
 * Class PhoneNumberInterface
 * @method list($countryIso, array $optionalArgs = [])
 * @package Plivo\Resources\PhoneNumber
 */
class PhoneNumberInterface extends ResourceInterface
{
    /**
     * PhoneNumberInterface constructor.
     * @param BaseClient $plivoClient
     * @param $authId
     */
    function __construct(BaseClient $plivoClient, $authId)
    {
        parent::__construct($plivoClient);

        $this->pathParams = [
            'authId' => $authId
        ];

        $this->uri = "Account/".$authId."/PhoneNumber/";
    }

    /**
     * Return a list of available phone numbers based on country ISO
     * @param string $countryIso
     * @param array $optionalArgs
     *   + Valid arguments
     *   + [string] type - The type of number you are looking for. The possible number types are fixed, mobile and tollfree. Defaults to any if this field is not specified. type also accepts the value any, which will search for all 3 number types.
     *   + [string] pattern - Represents the pattern of the number to be searched. Adding a pattern will search for numbers which start with the country code + pattern. For eg. a pattern of 415 and a country_iso: US will search for numbers starting with 1415.
     *   + [string] region - This filter is only applicable when the type is fixed. If the type is not provided, it is assumed to be fixed. Region based filtering can be performed with the following terms:
     *                   <br /> Exact names of the region: You could use region=Frankfurt if you were looking for a number in Frankfurt. Performed if the search term is three or more characters in length.
     *   + [string] services - Filters out phone numbers according to the services you want from that number. The following values are valid:
     *                  <br /> voice - If this option is selected, it ensures that the results have voice enabled numbers. These numbers may or may not be SMS enabled.
     *                  <br /> voice,sms - If this option is selected, it ensures that the results have both voice and sms enabled on the same number.
     *                  <br /> sms - If this option is selected, it ensures that the results have sms enabled numbers. These numbers may or may not be voice enabled.
     *                  <br /> By default, numbers that have either voice or sms or both enabled are returned.
     *   + [string] lata - Numbers can be searched using Local Access and Transport Area {http://en.wikipedia.org/wiki/Local_access_and_transport_area}. This filter is applicable only for country_iso US and CA.
     *   + [string] rate_center - Numbers can be searched using Rate Center {http://en.wikipedia.org/wiki/Telephone_exchange}. This filter is application only for country_iso US and CA.
     *   + [string] npanxx - Numbers can be searched using NpaNxx of a number. This filter is applicable only for country_iso US and CA.
     *   + [string] local_calling_area - If true, will return numbers belonging to the same rate_center of given input npanxx. This filter is applicable with filter npanxx.
     *   + [int] limit - Used to display the number of results per page. The maximum number of results that can be fetched is 20.
     *   + [int] offset - Denotes the number of value items by which the results should be offset. Eg:- If the result contains a 1000 values and limit is set to 10 and offset is set to 705, then values 706 through 715 are displayed in the results. This parameter is also used for pagination of the results.
     * @return PhoneNumberListResponse output
     */
    public function getList($countryIso, $optionalArgs = [])
    {
        $response = $this->client->fetch(
            $this->uri,
            array_merge(['country_iso'=>$countryIso], $optionalArgs)
        );

        if($response->getStatusCode() == 200) {
            $phoneNumbers = [];
            foreach ($response->getContent()['objects'] as $phoneNumber) {
                $newNumber = new PhoneNumber(
                    $this->client, $phoneNumber, $this->pathParams['authId']);

                array_push($phoneNumbers, $newNumber);
            }

            if (empty($phoneNumbers) && $response->getContent()['error'] != null){
                return new PhoneNumberListResponse($this->client, $response->getContent()['meta'], $phoneNumbers, $response->getContent()['error']);
            }

            return new ResourceList($this->client, $response->getContent()['meta'], $phoneNumbers);
        } else {
            throw new PlivoResponseException(
                $response->getContent()['error'],
                0,
                null,
                $response->getContent(),
                $response->getStatusCode()
            );
        }
    }

    /**
     * Buy a phone number
     *
     * @param number $phoneNumber
     * @param string|null $appId
     * @param string|null $cnamLookup
     * @return PhoneNumberBuyResponse output
     */
    public function buy($phoneNumber, $appId = null, $cnamLookup = null)
    {
        $response = $this->client->update(
            $this->uri . $phoneNumber . '/',
            ['app_id'=>$appId,'cnam_lookup'=>$cnamLookup]
        );

        $responseContents = $response->getContent();
        if(!array_key_exists("error",$responseContents)){
            return new PhoneNumberBuyResponse(
                $responseContents['api_id'],
                $responseContents['message'],
                $responseContents['numbers'][0]['number'],
                $responseContents['numbers'][0]['status'],
                $responseContents['status'],
                $response->getStatusCode()
            );
        } elseif (gettype($responseContents['error']) == "array" && array_key_exists("error",$responseContents['error'])) {
            throw new PlivoResponseException(
                $responseContents['error']['error'],
                0,
                null,
                $response->getContent(),
                $response->getStatusCode()
            );
        } else {
            throw new PlivoResponseException(
                $responseContents['error'],
                0,
                null,
                $response->getContent(),
                $response->getStatusCode()

            );
        }
        
    }
}
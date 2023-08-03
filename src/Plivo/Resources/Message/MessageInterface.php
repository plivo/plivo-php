<?php

namespace Plivo\Resources\Message;



use Plivo\Exceptions\PlivoValidationException;
use Plivo\Exceptions\PlivoRestException;
use Plivo\Exceptions\PlivoResponseException;
use Plivo\Util\ArrayOperations;
use Plivo\Util\Template;

use Plivo\MessageClient;
use Plivo\Resources\ResourceInterface;

/**
 * Class MessageInterface
 * @package Plivo\Resources\Message
 */
class MessageInterface extends ResourceInterface
{
    /**
     * MessageInterface constructor.
     * @param MessageClient $plivoClient
     * @param $authId
     */
    public function __construct(MessageClient $plivoClient, $authId)
    {
        parent::__construct($plivoClient);
        $this->pathParams = [
            'authId' => $authId
        ];
        $this->uri = "Account/".$authId."/Message/";
    }


    /**
     * @param $messageUuid
     * @return Message
     * @throws PlivoValidationException
     */
    public function get($messageUuid)
    {
        if (ArrayOperations::checkNull([$messageUuid])) {
            throw
            new PlivoValidationException(
                'message uuid is mandatory');
        }

        $response = $this->client->fetch(
            $this->uri . $messageUuid .'/',
            []
        );
        // return the object for chain method 
        if ($response->getStatusCode() == 200){
            return new Message(
            $this->client, $response->getContent(),
            $this->pathParams['authId'], $this->uri);
        }
        return json_encode($response->getContent(), JSON_FORCE_OBJECT);
    }

    
    

    /**
     * Return a list of messages
     * @param array $optionalArgs
     *   + Valid arguments
     *   + [string] :subaccount - The id of the subaccount, if message details of the subaccount is needed.
     *   + [string] :message_direction - Filter the results by message direction. The valid inputs are inbound and outbound.
     *   + [string] :message_time  - Filter out messages according to the time of completion. The filter can be used in the following five forms:
     *                     <br /> message_time: The format expected is YYYY-MM-DD HH:MM[:ss[.uuuuuu]]. Eg:- To get all messages that were sent/received at 2012-03-21 11:47[:30], use message_time=2012-03-21 11:47[:30]
     *                     <br /> message_time\__gt: gt stands for greater than. The format expected is YYYY-MM-DD HH:MM[:ss[.uuuuuu]]. Eg:- To get all messages that were sent/received after 2012-03-21 11:47, use message_time\__gt=2012-03-21 11:47
     *                     <br /> message_time\__gte: gte stands for greater than or equal. The format expected is YYYY-MM-DD HH:MM[:ss[.uuuuuu]]. Eg:- To get all messages that were sent/received after or exactly at 2012-03-21 11:47[:30], use message_time\__gte=2012-03-21 11:47[:30]
     *                     <br /> message_time\__lt: lt stands for lesser than. The format expected is YYYY-MM-DD HH:MM[:ss[.uuuuuu]]. Eg:- To get all messages that were sent/received before 2012-03-21 11:47, use message_time\__lt=2012-03-21 11:47
     *                     <br /> message_time\__lte: lte stands for lesser than or equal. The format expected is YYYY-MM-DD HH:MM[:ss[.uuuuuu]]. Eg:- To get all messages that were sent/received before or exactly at 2012-03-21 11:47[:30], use message_time\__lte=2012-03-21 11:47[:30]
     *                     <br /> Note: The above filters can be combined to get messages that were sent/received in a particular time range. The timestamps need to be UTC timestamps.
     *   + [string] :message_state Status value of the message, is one of "queued", "sent", "failed","read", "deleted", "delivered", "undelivered" or "rejected"
     *   + [int] :limit Used to display the number of results per page. The maximum number of results that can be fetched is 20.
     *   + [int] :offset Denotes the number of value items by which the results should be offset. Eg:- If the result contains a 1000 values and limit is set to 10 and offset is set to 705, then values 706 through 715 are displayed in the results. This parameter is also used for pagination of the results.
     *   + [string] :error_code Delivery Response code returned by the carrier attempting the delivery. See Supported error codes {https://www.plivo.com/docs/api/message/#standard-plivo-error-codes}.
     *   + [string] : powerpack_id - Filter the results by Powerpack ID.
     *   + [string]:  tendlc_campaign_id - exact tendlc campaign id search
     *   + [string]:destination_country_iso2 - valid 2 character country_iso2
     *   + [string] : tendlc_registration_status - registered or unregistered enum allowed
     *   + [string] : conversation_id - Filter the results by conversation_id in case of whatsapp messages.
     *   + [string] : conversation_origin - Filter the results by conversation_origin in case of whatsapp messages.
     * 
     * @return MessageList
     */
    protected function getList($optionalArgs = [])
    {
        $response = $this->client->fetch(
            $this->uri,
            $optionalArgs
        );
        if(!array_key_exists("error", $response->getContent())) {
            $messages = [];
            foreach ($response->getContent()['objects'] as $message) {
                $newMessage = new Message($this->client, $message, $this->pathParams['authId'], $this->uri);
                array_push($messages, $newMessage);
            }
            return new MessageList($this->client, $response->getContent()['meta'], $messages, $response->getContent()["api_id"]);
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
     * Send a message
     *
     * @param string $src
     * @param array $dst
     * @param string $text
     * @param array $optionalArgs
     *   + Valid arguments
     *   + [string] :type - The type of message. Should be `sms`, `whatsapp` or `mms`. Defaults to `sms`.
     *   + [string] :url - The URL to which with the status of the message is sent. The following parameters are sent to the URL:
     *                   <br /> To - Phone number of the recipient
     *                   <br /> From - Phone number of the sender
     *                   <br /> Status - Status of the message including "queued", "sent", "failed", "delivered", "undelivered", "read", "deleted" or "rejected"
     *                   <br /> MessageUUID - The unique ID for the message
     *                   <br /> ParentMessageUUID - ID of the parent message (see notes about long SMS below)
     *                   <br /> PartInfo - Specifies the sequence of the message (useful for long messages split into multiple text messages; see notes about long SMS below)
     *                   <br /> TotalRate - Total rate per sms
     *                   <br /> TotalAmount - Total cost of sending the sms (TotalRate * Units)
     *                   <br /> Units - Number of units into which a long SMS was split
     *                   <br /> MCC - Mobile Country Code (see here {https://en.wikipedia.org/wiki/Mobile_country_code} for more details)
     *                   <br /> MNC - Mobile Network Code (see here {https://en.wikipedia.org/wiki/Mobile_country_code} for more details)
     *                   <br /> ErrorCode - Delivery Response code returned by the carrier attempting the delivery. See Supported error codes {https://www.plivo.com/docs/api/message/#standard-plivo-error-codes}.
     *   + [string] :method - The method used to call the url. Defaults to POST.
     *   + [string] :log - If set to false, the content of this message will not be logged on the Plivo infrastructure and the dst value will be masked (e.g., 141XXXXX528). Default is set to true.
     *   + [template] :template - For sending templated whatsapp messages.
     *   
     * [list] : media_urls - If your sending mms message, you can specify the media urls like ['https://yourmedia_urls/test.jpg','https://test.com/test.gif']
     * @return MessageCreateResponse output
     * @throws PlivoValidationException,PlivoResponseException
     */
    // 
    public function create($src=null, $dst=null, $text=null,array $optionalArgs = [], $powerpackUUID = null)
    {
        if (is_array($src))
        {
            $optionalArgs = array_merge($src, $optionalArgs);
            $src = isset($optionalArgs['src']) ? $optionalArgs['src'] : null;
            $dst = isset($optionalArgs['dst']) ? $optionalArgs['dst'] : null;
            $text = isset($optionalArgs['text']) ? $optionalArgs['text'] : null;
            $powerpackUUID = isset($optionalArgs['powerpackUUID']) ? $optionalArgs['powerpackUUID'] : null;
        }
        $template = isset($optionalArgs['template']) ? $optionalArgs['template'] : null;       
        if (is_array($dst)){
            $mandatoryArgs = [
                'dst' => implode('<', $dst),
            ];
            if (isset($optionalArgs['dst'])){
                unset($optionalArgs['dst']);
            }
        } 
        else {
            $mandatoryArgs = ['dst' => $dst ];
        }
        

        if (ArrayOperations::checkNull($mandatoryArgs)) {
            throw new PlivoValidationException(
                "Mandatory parameters cannot be null");
        }

        if (is_null($src) &&  is_null($powerpackUUID)) {
            throw new PlivoValidationException(
                "Specify either powerpack_uuid or src in request params to send a message."
            );
        }

        if (!is_null($src) && !is_null($powerpackUUID)) {
            throw new PlivoValidationException(
                "Both powerpack_uuid and src cannot be specified. Specify either powerpack_uuid or src in request params to send a message."
            );
        }
        if(isset($optionalArgs['type'])  && $optionalArgs['type'] == 'whatsapp' && is_null($src))
        {
            throw new PlivoValidationException(
                "src parameter not present"
            );
        }
        if (isset($optionalArgs['type'])  && $optionalArgs['type'] != 'whatsapp' && !is_null($template)){
            throw new PlivoValidationException(
                'Template paramater is only applicable when message_type is whatsapp'
            );
        }

        if(!is_null($template)){
            $err = Template::validateTemplate($template);
            if (!is_null($err))
            {
                throw new PlivoValidationException(
                    $err
                );
            }
            $optionalArgs['template'] = json_decode($template,True);
        }
        
        $response = $this->client->update(
            $this->uri,
            array_merge($mandatoryArgs,  $optionalArgs, ['src' => $src, 'powerpack_uuid' => $powerpackUUID, 'text' => $text])
        );

        $responseContents = $response->getContent();
        
        if(!array_key_exists("error",$responseContents)){
            if(array_key_exists("invalid_number", $responseContents)){
                return new MessageCreateResponse(
                    $responseContents['message'],
                    $responseContents['message_uuid'],
                    $responseContents['api_id'],
                    $response->getStatusCode(),
                    $responseContents['invalid_number']
                );
            }
            else{
                return new MessageCreateResponse(
                    $responseContents['message'],
                    $responseContents['message_uuid'],
                    $responseContents['api_id'],
                    $response->getStatusCode(),
                    []
                );
            }
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
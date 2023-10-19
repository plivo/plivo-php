<?php

namespace Plivo\Resources\VerifyCallerId;
use Plivo\BaseClient;
use Plivo\Exceptions\PlivoResponseException;
use Plivo\Exceptions\PlivoValidationException;
use Plivo\Resources\ResourceInterface;
use Plivo\Resources\Verify\VerifySessionCreateResponse;
use Plivo\Util\ArrayOperations;


class VerifyInterface extends ResourceInterface
{

    /**
     * VerifyInterface constructor.
     * @param BaseClient $plivoClient
     * @param string $authId
     */
    function __construct(BaseClient $plivoClient, $authId)
    {
        parent::__construct($plivoClient);
        $this->pathParams = [
            'authId' => $authId
        ];
        $this->uri = "Account/".$authId."/VerifiedCallerId";
    }

    public function initiate($phoneNumber, array $optionalArgs = []){

         $mandatoryArgs = [
            'phone_number' => $phoneNumber,
        ];

        if (ArrayOperations::checkNull($mandatoryArgs) or empty($phoneNumber)) {
            throw new PlivoValidationException(
                "phoneNumber is mandatory and cannot be empty");
        }

        $response = $this->client->update(
            $this->uri .'/',
            array_merge($mandatoryArgs, $optionalArgs)
        );

        $responseContents = $response->getContent();

        if(array_key_exists("error",$responseContents)){
            throw new PlivoResponseException(
                $responseContents['error'],
                0,
                null,
                $response->getContent(),
                $response->getStatusCode()

            );
        } else {
            return new InitiateVerifyResponse(
                $responseContents['api_id'],
                $responseContents['message'],
                $responseContents['verification_uuid'],
                $response->getStatusCode()
            );
        }

    }

    public function verify($verificationUuid, $otp){

        $mandatoryArgs = [
           'otp' => $otp,
       ];

       if (ArrayOperations::checkNull([$verificationUuid]) or empty($verificationUuid)) {
           throw new PlivoValidationException(
               "verification uuid is mandatory and cannot be empty");
       }

       if (ArrayOperations::checkNull($mandatoryArgs) or empty($otp)) {
            throw new PlivoValidationException(
                "otp is mandatory and cannot be empty");
        }

        $response = $this->client->update(
            $this->uri . '/Verification/'. $verificationUuid.'/',
            $mandatoryArgs
        );

       $responseContents = $response->getContent();

       if(array_key_exists("error",$responseContents)){
           throw new PlivoResponseException(
               $responseContents['error'],
               0,
               null,
               $response->getContent(),
               $response->getStatusCode()

           );
       } else {
           return new VerifyCallerIdResponse(
               $responseContents['api_id'],
               $responseContents['alias'],
               $responseContents['channel'],
               $responseContents['country'],
               $responseContents['created_at'],
               $responseContents['phone_number'],
               $responseContents['subaccount'] ?? null,
               $responseContents['verification_uuid'],
               $response->getStatusCode()
           );
       }

   }

   public function updateVerifiedCallerId($phoneNumber, array $optionalArgs = []){

       if (ArrayOperations::checkNull([$phoneNumber]) or empty($phoneNumber)) {
           throw new PlivoValidationException(
               "phoneNumber is mandatory and cannot be empty");
       }

        $response = $this->client->update(
            $this->uri . '/'. $phoneNumber.'/',
            $optionalArgs
        );

       $responseContents = $response->getContent();

       if(array_key_exists("error",$responseContents)){
           throw new PlivoResponseException(
               $responseContents['error'],
               0,
               null,
               $response->getContent(),
               $response->getStatusCode()

           );
       } else {
           return new Verify(
               $responseContents['api_id'],
               $responseContents['alias'],
               $responseContents['country'],
               $responseContents['created_at'],
               $responseContents['modified_at'],
               $responseContents['phone_number'],
               $responseContents['subaccount'],
               $responseContents['verification_uuid'],
               $response->getStatusCode()
           );
       }

   }

   public function getVerifiedCallerId($phoneNumber){
        if (ArrayOperations::checkNull([$phoneNumber]) or empty($phoneNumber)) {
            throw
            new PlivoValidationException(
                'phoneNumber is mandatory and cannot be empty');
        }

        $response = $this->client->fetch(
            $this->uri . '/'. $phoneNumber.'/',
            []
        );
        
        $responseContents = $response->getContent();
        if(array_key_exists("error",$responseContents)){
            throw new PlivoResponseException(
                $responseContents['error'],
                0,
                null,
                $response->getContent(),
                $response->getStatusCode()

            );
        } else {
            return new Verify(
                $responseContents['api_id'],
                $responseContents['alias'],
                $responseContents['country'],
                $responseContents['created_at'],
                $responseContents['modified_at'],
                $responseContents['phone_number'],
                $responseContents['subaccount'],
                $responseContents['verification_uuid'],
                $response->getStatusCode()
           );
        }
        
    }

    public function listVerifiedCallerIds(array $optionalArgs = []){

        $response = $this->client->fetch(
             $this->uri .'/',
             $optionalArgs
        );

        $responseContents = $response->getContent();

        if(array_key_exists("error",$responseContents)){
            throw new PlivoResponseException(
                $responseContents['error'],
                0,
                null,
                $response->getContent(),
                $response->getStatusCode()
            );
        } else {
            return new ListVerifiedCallerIdResponse(
                $responseContents['api_id'],
                $responseContents['meta'],
                $responseContents['objects'],
                $response->getStatusCode()
            );
        }
  
    }

    public function deleteVerifiedCallerId($phoneNumber){

        if (ArrayOperations::checkNull([$phoneNumber]) or empty($phoneNumber)) {
            throw new PlivoValidationException(
                'phoneNumber is mandatory and cannot be empty');
        }

        
        $response = $this->client->delete(
            $this->uri . '/'. $phoneNumber.'/',
            []
        );

        $responseContents = $response->getContent();

        if(array_key_exists("error",$responseContents) && strlen($responseContents['error']) > 0 ){
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
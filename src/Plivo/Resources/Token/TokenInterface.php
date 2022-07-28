<?php

namespace Plivo\Resources\Token;



use Plivo\Exceptions\PlivoValidationException;
use Plivo\Util\ArrayOperations;
use Plivo\BaseClient;
use Plivo\Resources\ResourceInterface;


/**
 * Class TokenInterface
 * @package Plivo\Resources\Token
 */
class TokenInterface extends ResourceInterface
{
    /**
     * TokenInterface constructor.
     * @param BaseClient $plivoClient
     * @param $authId
     */
    public function __construct(BaseClient $plivoClient, $authId)
    {
        parent::__construct($plivoClient);
        $this->pathParams = [
            'authId' => $authId
        ];
        $this->uri = "Account/".$authId."/";
    }


    /**
     * Create a new Token
     *
     * @param string $iss
     * @param array $optionalArgs
     *   + Valid arguments with their types
     *   + [string] Sub - Subject
     *   + [Integer] nbf - Token Creation Time
     *
     * answer_method - The method used to call the answer_url. Defaults to POST.
     *  + contains sub, nbf, exp, incoming_allow, outgoing_allow, app
     * @return TokenCreation response output
     * @throws PlivoValidationException
     */
    public function create(string $iss, array $optionalArgs = [])
    {
        $mandatoryArgs = [
            'iss' => $iss
        ];
        $optionalArgs['isVoiceRequest'] = true;
        if (ArrayOperations::checkNull($mandatoryArgs)) {
            throw new PlivoValidationException(
                "Mandatory parameters cannot be null");
        }
        if ($optionalArgs['incoming_allow'] && empty($optionalArgs['sub'])) {
            throw new PlivoValidationException(
                "sub is mandatory when incoming_allow is true");
        }


        $response = $this->client->update(
            $this->uri .'JWT/Token/',
            array_merge($mandatoryArgs, $optionalArgs)
        );
        return $response->getContent();

    }
}
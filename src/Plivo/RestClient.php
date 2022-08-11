<?php

namespace Plivo;

use Plivo\Exceptions\PlivoRestException;
use Plivo\Resources\Account\AccountInterface;
use Plivo\Resources\Application\ApplicationInterface;
use Plivo\Resources\Call\CallInterface;
use Plivo\Resources\Conference\ConferenceInterface;
use Plivo\Resources\Endpoint\EndpointInterface;
use Plivo\Resources\HostedMessaging\HostedMessageLOAInterface;
use Plivo\Resources\HostedMessaging\HostedMessagingNumberInterface;
use Plivo\Resources\Message\MessageInterface;
use Plivo\Resources\Powerpack\PowerpackInterface;
use Plivo\Resources\Media\MediaInterface;
use Plivo\Resources\Brand\BrandInterface;
use Plivo\Resources\Campaign\CampaignInterface;
use Plivo\Resources\Lookup\LookupInterface;
use Plivo\Resources\Number\NumberInterface;
use Plivo\Resources\PhoneNumber\PhoneNumberInterface;
use Plivo\Resources\Pricing\PricingInterface;
use Plivo\Resources\Recording\RecordingInterface;
use Plivo\Resources\SubAccount\SubAccountInterface;
use Plivo\Resources\CallFeedback\CallFeedbackInterface;
use Plivo\Resources\RegulatoryCompliance\EndUserInterface;
use Plivo\Resources\RegulatoryCompliance\ComplianceDocumentTypeInterface;
use Plivo\Resources\RegulatoryCompliance\ComplianceDocumentInterface;
use Plivo\Resources\RegulatoryCompliance\ComplianceRequirementInterface;
use Plivo\Resources\RegulatoryCompliance\ComplianceApplicationInterface;
use Plivo\Resources\MultiPartyCall\MultiPartyCallInterface;
use Plivo\Resources\Profile\ProfileInterface;
use Plivo\Resources\Token\TokenInterface;
use Plivo\Resources\Zentrunk\ZentrunkInterface;

/**
 * Class RestClient
 * @package Plivo
 *
 * @property CallInterface call Interface to handle all Call related api calls
 * @property TokenInterface token Interface to handle all Token related api calls
 * @property SubAccountInterface subAccount Interface to handle all SubAccount related api calls
 * @property ApplicationInterface application Interface to handle all Application related api calls
 * @property AccountInterface account Interface to handle all Account related api calls
 * @property MessageInterface message Interface to handle all Message related api calls
 * @property PowerpackInterface powerpack Interface to handle all Powerpack related api calls
 * @property MediaInterface media Interface to handle all upload mms media api
 * @property ProfileInterface profile Interface to handle all 10dlc related profile api
 * @property LookupInterface lookup Interface to handle calls to the Lookup API
 * @property EndpointInterface endpoint Interface to handle all Endpoint related api calls
 * @property NumberInterface number Interface to handle all Number related api calls
 * @property PhoneNumberInterface phoneNumber Interface to handle all PhoneNumber related api calls
 * @property PricingInterface pricing Interface to handle all Pricing related api calls
 * @property RecordingInterface recording Interface to handle all Recording related api calls
 * @property CallFeedbackInterface callfeedback Interface to handle user feedback for calls
 * @property EndUserInterface endUser Interface to handle all EndUser related api calls
 * @property ComplianceDocumentTypeInterface complianceDocumentType Interface to handle all ComplianceDocumentType related api calls
 * @property ComplianceDocumentInterface complianceDocument Interface to handle all ComplianceDocument related api calls
 * @property ComplianceRequirementInterface complianceRequirement Interface to handle all ComplianceRequirement related api calls
 * @property ComplianceApplicationInterface complianceApplication Interface to handle all ComplianceApplication related api calls
 * @property HostedMessageLOAInterface hostedMessageLOA Interface to handle all HostedMessageLOA related api calls
 * @property HostedMessagingNumberInterface hostedMessagingNumber Interface to handle all HostedMessagingNumber related api calls
 * @property ZentrunkInterface Zentrunk Interface to handle all Zentrunk Call related api
 * 
 */
class RestClient
{
    /**
     * @var BaseClient
     */
    public $client;

    /**
     * @var MessageClient
     */
    public $msgClient;

    /**
     * @var AccountInterface
     */
    protected $_account;
    /**
     * @var MessageInterface
     */
    protected $_message;

    /**
     * @var PowerpackInterface
     */
    protected $_powerpack;


     /**
     * @var BrandInterface
     */
    protected $_brand;


     /**
     * @var CampaignInterface
     */
    protected $_campaign;
     /**
     * @var MediaInterface
     */
    protected $_media;

    /**
     * @var ProfileInterface
     */
    protected $_profile;

     /**
     * @var LookupInterface
     */
    protected $_lookup;

    /**
     * @var ApplicationInterface
     */
    protected $_application;
    /**
     * @var SubAccountInterface
     */
    protected $_subAccount;
    /**
     * @var CallInterface
     */
    protected $_token;
    /**
     * @var TokenInterface
     */
    protected $_call;
    /**
     * @var ConferenceInterface
     */
    protected $_conference;

    /**
     * @var EndpointInterface
     */
    protected $_endpoint;

    /**
     * @var NumberInterface
     */
    protected $_number;

    /**
     * @var PhoneNumberInterface
     */
    protected $_phoneNumber;

    /**
     * @var PricingInterface
     */
    protected $_pricing;

    /**
     * @var RecordingInterface
     */
    protected $_recording;

    /**
     * @var CallFeedbackInterface
     */
    protected $_callFeedback;

    /**
     * @var EndUserInterface
     */
    protected $_endUser;

    /**
     * @var ComplianceDocumentTypeInterface
     */
    protected $_complianceDocumentType;

    /**
     * @var ComplianceDocumentInterface
     */
    protected $_complianceDocument;

    /**
     * @var ComplianceRequirementInterface
     */
    protected $_complianceRequirement;

    /**
     * @var ComplianceApplicationInterface
     */
    protected $_complianceApplication;

    /**
     * @var HostedMessageLOAInterface
     */
    protected $_hostedMessageLOA;

    /**
     * @var HostedMessagingNumberInterface
     */
    protected $_hostedMessagingNumber;

    /**
     * @var MultiPartyCallInterface
     */
    protected $_multiPartyCall;

    /**
     * @var ZentrunkInterface
     */
    protected $_zentrunkCall;

    /**
     * RestClient constructor.
     * @param string|null $authId
     * @param string|null $authToken
     * @param string|null $proxyHost
     * @param string|null $proxyPort
     * @param string|null $proxyUsername
     * @param string|null $proxyPassword
     */
    public function __construct(
        $authId = null,
        $authToken = null,
        $proxyHost = null,
        $proxyPort = null,
        $proxyUsername = null,
        $proxyPassword = null
    ) {

        $this->client = new BaseClient(
            $authId,
            $authToken,
            $proxyHost,
            $proxyPort,
            $proxyUsername,
            $proxyPassword
        );
        $this->msgClient = new MessageClient($authId, $authToken, $proxyHost, $proxyPort, $proxyUsername, $proxyPassword);
    }

    /**
     * @param $name
     * @return mixed
     * @throws PlivoRestException
     */
    public function __get($name)
    {
        $method = 'get' . ucfirst($name);
        if (method_exists($this, $method)) {
            return $this->$method();
        }

        throw new PlivoRestException('Unknown resource ' . $name);
    }

    /**
     * @return AccountInterface
     */
    protected function getAccounts()
    {
        if (!$this->_account) {
            $this->_account = new AccountInterface($this->client, $this->client->getAuthId());
        }
        return $this->_account;
    }

    /**
     * @return MessageInterface
     */
    protected function getMessages()
    {
        if (!$this->_message) {
            $this->_message = new MessageInterface($this->msgClient, $this->msgClient->getAuthId());
        }
        return $this->_message;
    }

    /**
     * @return PowerpackInterface
     */
    protected function getPowerpacks()
    {
        if (!$this->_powerpack) {
            $this->_powerpack = new PowerpackInterface($this->client, $this->client->getAuthId());
        }
        return $this->_powerpack;
    }

    /**
     * @return BrandInterface
     */
    protected function getBrand()
    {
        if (!$this->_brand) {
            $this->_brand = new BrandInterface($this->client, $this->client->getAuthId());
        }
        return $this->_brand;
    }

     /**
     * @return CampaignInterface
     */
    protected function getCampaign()
    {
        if (!$this->_campaign) {
            $this->_campaign = new CampaignInterface($this->client, $this->client->getAuthId());
        }
        return $this->_campaign;
    }

    /**
     * @return ProfileInterface
     *
     */
    protected function getProfile()
    {
        if (!$this->_profile) {
            $this->_profile = new ProfileInterface($this->client, $this->client->getAuthId());
        }
        return $this->_profile;
    }

    /**
     * @return MediaInterface
     */
    protected function getMedia()
    {
        if (!$this->_media) {
            $this->_media = new MediaInterface($this->client, $this->client->getAuthId());
        }
        return $this->_media;
    }

    /**
     * @return LookupInterface
     */
    protected function getLookup()
    {
        if (!$this->_lookup) {
            $this->_lookup = new LookupInterface($this->client);
        }
        return $this->_lookup;
    }

    /**
     * @return ApplicationInterface
     */
    protected function getApplications()
    {
        if (!$this->_application) {
            $this->_application = new ApplicationInterface($this->client, $this->client->getAuthId());
        }
        return $this->_application;
    }

    /**
     * @return SubAccountInterface
     */
    protected function getSubAccounts()
    {
        if (!$this->_subAccount) {
            $this->_subAccount = new SubAccountInterface($this->client, $this->client->getAuthId());
        }
        return $this->_subAccount;
    }

    /**
     * @return CallInterface
     */
    protected function getCalls()
    {
        if (!$this->_call) {
            $this->_call = new CallInterface($this->client, $this->client->getAuthId());
        }
        return $this->_call;
    }
    /**
     * @return TokenInterface
     */
    protected function getToken()
    {
        if (!$this->_token) {
            $this->_token = new TokenInterface($this->client, $this->client->getAuthId());
        }
        return $this->_token;
    }

    /**
     * @return ConferenceInterface
     */
    public function getConferences()
    {
        if (!$this->_conference) {
            $this->_conference = new ConferenceInterface($this->client, $this->client->getAuthId());
        }
        return $this->_conference;
    }

    /**
     * @return EndpointInterface
     */
    public function getEndpoints()
    {
        if (!$this->_endpoint) {
            $this->_endpoint = new EndpointInterface($this->client, $this->client->getAuthId());
        }
        return $this->_endpoint;
    }

    /**
     * @return NumberInterface
     */
    public function getNumbers()
    {
        if (!$this->_number) {
            $this->_number = new NumberInterface($this->client, $this->client->getAuthId());
        }
        return $this->_number;
    }

    /**
     * @return PhoneNumberInterface
     */
    public function getPhoneNumbers()
    {
        if (!$this->_phoneNumber) {
            $this->_phoneNumber = new PhoneNumberInterface($this->client, $this->client->getAuthId());
        }
        return $this->_phoneNumber;
    }

    /**
     * @return PricingInterface
     */
    public function getPricing()
    {
        if (!$this->_pricing) {
            $this->_pricing = new PricingInterface($this->client, $this->client->getAuthId());
        }
        return $this->_pricing;
    }

    /**
     * @return RecordingInterface
     */
    public function getRecordings()
    {
        if (!$this->_recording) {
            $this->_recording = new RecordingInterface($this->client, $this->client->getAuthId());
        }
        return $this->_recording;
    }

    /**
     * @return CallFeedbackInterface
     */
    protected function getCallFeedback()
    {
        if (!$this->_callFeedback) {
            $this->_callFeedback = new CallFeedbackInterface($this->client);
        }
        return $this->_callFeedback;
    }

    /**
     * @return EndUserInterface
     */
    public function getEndUser()
    {
        if (!$this->_endUser) {
            $this->_endUser = new EndUserInterface($this->client, $this->client->getAuthId());
        }
        return $this->_endUser;
    }

    /**
     * @return ComplianceDocumentTypeInterface
     */
    public function getComplianceDocumentType()
    {
        if (!$this->_complianceDocumentType) {
            $this->_complianceDocumentType = new ComplianceDocumentTypeInterface($this->client, $this->client->getAuthId());
        }
        return $this->_complianceDocumentType;
    }

    /**
     * @return ComplianceDocumentInterface
     */
    public function getComplianceDocument()
    {
        if (!$this->_complianceDocument) {
            $this->_complianceDocument = new ComplianceDocumentInterface($this->client, $this->client->getAuthId());
        }
        return $this->_complianceDocument;
    }

    /**
     * @return ComplianceRequirementInterface
     */
    public function getComplianceRequirement()
    {
        if (!$this->_complianceRequirement) {
            $this->_complianceRequirement = new ComplianceRequirementInterface($this->client, $this->client->getAuthId());
        }
        return $this->_complianceRequirement;
    }

    /**
     * @return ComplianceApplicationInterface
     */
    public function getComplianceApplication()
    {
        if (!$this->_complianceApplication) {
            $this->_complianceApplication = new ComplianceApplicationInterface($this->client, $this->client->getAuthId());
        }
        return $this->_complianceApplication;
    }

    /**
     * @return HostedMessageLOAInterface
     */
    public function getHostedMessageLOA()
    {
        if (!$this->_hostedMessageLOA) {
            $this->_hostedMessageLOA = new HostedMessageLOAInterface($this->client, $this->client->getAuthId());
        }
        return $this->_hostedMessageLOA;
    }
    
    /**
     * @return HostedMessagingNumberInterface
     */
    public function getHostedMessagingNumber()
    {
        if (!$this->_hostedMessagingNumber) {
            $this->_hostedMessagingNumber = new HostedMessagingNumberInterface($this->client, $this->client->getAuthId());
        }
        return $this->_hostedMessagingNumber;
    }
    
    public function getMultiPartyCalls()
    {
        if(!$this->_multiPartyCall){
            $this->_multiPartyCall = new MultiPartyCallInterface($this->client, $this->client->getAuthId());
        }
        return $this->_multiPartyCall;
    }

    /**
     * @return ZentrunkInterface
     */
    public function getZentrunkCalls()
    {
        if (!$this->_zentrunkCall) {
            $this->_zentrunkCall = new ZentrunkInterface($this->client, $this->client->getAuthId());
        }
        return $this->_zentrunkCall;
    }
}

<?php

namespace Plivo;

use Plivo\Exceptions\PlivoRestException;
use Plivo\Resources\Account\AccountInterface;
use Plivo\Resources\Application\ApplicationInterface;
use Plivo\Resources\Call\CallInterface;
use Plivo\Resources\Conference\ConferenceInterface;
use Plivo\Resources\Endpoint\EndpointInterface;
use Plivo\Resources\Message\MessageInterface;
use Plivo\Resources\Number\NumberInterface;
use Plivo\Resources\PhoneNumber\PhoneNumberInterface;
use Plivo\Resources\Pricing\PricingInterface;
use Plivo\Resources\Recording\RecordingInterface;
use Plivo\Resources\SubAccount\SubAccountInterface;

/**
 * Class RestClient
 * @package Plivo
 *
 * @property CallInterface call Interface to handle all Call related api calls
 * @property SubAccountInterface subAccount Interface to handle all SubAccount related api calls
 * @property ApplicationInterface application Interface to handle all Application related api calls
 * @property AccountInterface account Interface to handle all Account related api calls
 * @property MessageInterface message Interface to handle all Message related api calls
 * @property EndpointInterface endpoint Interface to handle all Endpoint related api calls
 * @property NumberInterface number Interface to handle all Number related api calls
 * @property PhoneNumberInterface phoneNumber Interface to handle all PhoneNumber related api calls
 * @property PricingInterface pricing Interface to handle all Pricing related api calls
 * @property RecordingInterface recording Interface to handle all Recording related api calls
 *
 */
class RestClient
{
    /**
     * @var BaseClient
     */
    public $client;

    /**
     * @var AccountInterface
     */
    protected $_account;
    /**
     * @var MessageInterface
     */
    protected $_message;
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
        $proxyPassword = null)
    {
        $this->client = new BaseClient(
            $authId, $authToken, $proxyHost, $proxyPort, $proxyUsername, $proxyPassword);
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
            $this->_message = new MessageInterface($this->client, $this->client->getAuthId());
        }
        return $this->_message;
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
}

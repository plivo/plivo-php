# Change Log

## [v4.51.0](https://github.com/plivo/plivo-php/tree/v4.51.0) (2023-06-28)
**Audio Streaming**
- API support for starting, deleting, getting streams on a live call
- XML creation support for stream element

## [4.50.1](https://github.com/plivo/plivo-php/tree/v4.50.1) (2023-05-14)
-  Fix warnings on [list all numbers API]

## [4.50.0](https://github.com/plivo/plivo-php/tree/v4.50.0) (2023-05-02)
**Feature - CNAM Lookup**
- Added New Param `cnam_lookup` in to the response of the [list all numbers API], [list single number API]
- Added `cnam_lookup` filter to AccountPhoneNumber - list all my numbers API.
- Added `cnam_lookup` parameter to buy number[Buy a Phone Number]  to configure CNAM Lookup while buying a US number
- Added `cnam_lookup` parameter to update number[Update an account phone number] to configure CNAM Lookup while buying a US number

## [v4.49.0](https://github.com/plivo/plivo-php/tree/v4.43.1) (2023-03-16)
**Feature - Added New Param 'cnam_lookup_number_config' in GetCall and ListCalls**
- Add `cnam_lookup_number_config` to the response for the [retrieve a call details API](https://www.plivo.com/docs/voice/api/call#retrieve-a-call) and the [retreive all call details API](https://www.plivo.com/docs/voice/api/call#retrieve-all-calls)

## [4.48.0](https://github.com/plivo/plivo-php/tree/v4.48.0) (2023-05-29)
- Added `monthly_recording_storage_amount`, `recording_storage_rate`, `rounded_recording_duration`, and `recording_storage_duration` parameters to the response for [get single recording API](https://www.plivo.com/docs/voice/api/recording#retrieve-a-recording) and [get all recordings API](https://www.plivo.com/docs/voice/api/recording#list-all-recordings)
- Added `recording_storage_duration` parameter as a filter option for [get all recordings API](https://www.plivo.com/docs/voice/api/recording#list-all-recordings)

## [v4.47.1](https://github.com/plivo/plivo-php/tree/v4.47.1) (2023-05-11)
- Fix send sms api failure on multiple destination number added on array param

## [v4.47.0](https://github.com/plivo/plivo-php/tree/v4.47.0) (2023-05-04)
- Add New Param `renewalDate` to the response of the [list all numbers API], [list single number API]
- Added 3 new filters to AccountPhoneNumber - list all my numbers API:`renewal_date`, `renewal_date__gt`, `renewal_date__gte`,`renewal_date__lt` and `renewal_date__lte` (https://www.plivo.com/docs/numbers/api/account-phone-number#list-all-my-numbers)

## [v4.46.0](https://github.com/plivo/plivo-php/tree/v4.46.0) (2023-04-25)
- Add `replacedSender` to the response for the [list all messages API](https://www.plivo.com/docs/sms/api/message/list-all-messages/) and the [get message details API](https://www.plivo.com/docs/sms/api/message#retrieve-a-message)
- Add `apiId` to the responses for the list all messages API and the get message details API

## [v4.45.0](https://github.com/plivo/plivo-php/tree/v4.45.1) (2023-04-11)
**Feature - Added New Param 'source_ip' in GetCall and ListCalls**
- Add `source_ip` to the response for the [retrieve a call details API](https://www.plivo.com/docs/voice/api/call#retrieve-a-call) and the [retreive all call details API](https://www.plivo.com/docs/voice/api/call#retrieve-all-calls)

## [4.44.2](https://github.com/plivo/plivo-php/tree/v4.44.2) (2023-10-04)
- Fix "https://github.com/plivo/plivo-php/issues/308"

## [4.44.0](https://github.com/plivo/plivo-php/tree/v4.44.0) (2023-24-03)
- Added New Param `created_at` to the response of the [list all profiles API], [get profile API], [list all brands API], [get brand API], [list all campaigns API] and the [get campaign API]

## [v4.43.1](https://github.com/plivo/plivo-php/tree/v4.43.1) (2023-03-24)
- Fix brand registration create api param

## [v4.43.0](https://github.com/plivo/plivo-php/tree/v4.43.0) (2023-03-03)
- Add `isDomestic` to the response for the [list all messages API](https://www.plivo.com/docs/sms/api/message/list-all-messages/) and the [get message details API](https://www.plivo.com/docs/sms/api/message#retrieve-a-message)

## [4.42.1](https://github.com/plivo/plivo-php/tree/v4.42.1) (2023-02-28)
-Added Exception handling for Retrieve all Calls API [Retrieve details of all calls](https://www.plivo.com/docs/voice/api/call#retrieve-all-calls)

## [4.42.0](https://github.com/plivo/plivo-php/tree/v4.42.0) (2023-02-27)
**Feature - Enhance MDR filtering capabilities **
- Added new fields on MDR object response

## [v4.41.0](https://github.com/plivo/plivo-php/tree/v4.41.0) (2023-01-25)
- Add `requesterIP` to the response for the [list all messages API](https://www.plivo.com/docs/sms/api/message/list-all-messages/) and the [get message details API](https://www.plivo.com/docs/sms/api/message#retrieve-a-message)

## [v4.40.0](https://github.com/plivo/plivo-php/tree/v4.40.0) (2023-01-18)
-  Added new param(Message_expiry) in Send message API

## [v4.39.0](https://github.com/plivo/plivo-php/tree/v4.39.0) (2022-12-16)
-  Added update campaign API

## [v4.38.0](https://github.com/plivo/plivo-php/tree/v4.38.0) (2022-12-06)
-  Added Delete campaign and brand API

## [v4.37.1](https://github.com/plivo/plivo-php/tree/v4.37.1) (2022-11-15)
-  Support for PHP 8.1 version

## [v4.37.0](https://github.com/plivo/plivo-php/tree/v4.37.0) (2022-11-04)
- Added Brand Usecase Request

## [v4.36.1](https://github.com/plivo/plivo-php/tree/v4.36.1) (2022-11-11)
**Bug fix - StartRecording** 
- SDK throws exception when `callback_url` is provided in the request

## [v4.36.0](https://github.com/plivo/plivo-php/tree/v4.36.0) (2022-10-14)
- Added 3 new keys to AccountPhoneNumber object:`tendlc_registration_status`, `tendlc_campaign_id` and `toll_free_sms_verification` (https://www.plivo.com/docs/numbers/api/account-phone-number#the-accountphonenumber-object)
- Added 3 new filters to AccountPhoneNumber - list all my numbers API:`tendlc_registration_status`, `tendlc_campaign_id` and `toll_free_sms_verification` (https://www.plivo.com/docs/numbers/api/account-phone-number#list-all-my-numbers)

## [v4.35.1](https://github.com/plivo/plivo-php/tree/v4.35.1) (2022-09-28)
-  10DLC: Adding new attributes to campaign creation request

## [v4.35.0](https://github.com/plivo/plivo-php/tree/v4.35.0) (2022-08-01)
-  `JWT Token Creation API` added functionality to create a new JWT token.

## [v4.34.0](https://github.com/plivo/plivo-php/tree/v4.34.0) (2022-06-21)
- Implemented new client for retrieving ZenTrunk CDRs

## [v4.33.0](https://github.com/plivo/plivo-php/tree/v4.33.0) (2022-06-14)
- Private Beta release of Trunk to DID mapping

## [v4.32.0](https://github.com/plivo/plivo-php/tree/v4.32.0) (2022-05-10)
- add `brand_type` field in brand get/list response

## [v4.31.0](https://github.com/plivo/plivo-php/tree/v4.31.0) (2022-05-05)
**Feature Added - Recording**
- now customer can filter recording with `to_number` and `from_number` filter also [Recording](https://www.plivo.com/docs/voice/api/recording/)
- `record_min_member_count` param added to [Add a participant to a multiparty call using API](https://www.plivo.com/docs/voice/api/multiparty-call/participants#add-a-participant)

## [v4.30.0](https://github.com/plivo/plivo-php/tree/v4.30.0) (2022-04-28)
**Feature - 10DLC API callback**
- Added callback support for campaign, brand, link number request.

## [v4.29.0](https://github.com/plivo/plivo-php/tree/v4.29.0) (2022-04-14)
**Feature - Profile api**
- Added profile support for 10dlc.

## [v4.28.1](https://github.com/plivo/plivo-php/tree/v4.28.1) (2022-03-30)
**Bug fix - SpeakElementXML**
- `voice` parameter is accepting lowercase as well as uppercase values [The Speak element](https://www.plivo.com/docs/voice/xml/speak/)

## [v4.28.0](https://github.com/plivo/plivo-php/tree/v4.28.0) (2022-03-25)
**Features - DialElement**
- `confirmTimeout` parameter added to [The Dial element](https://www.plivo.com/docs/voice/xml/dial/)

## [v4.27.2](https://github.com/plivo/plivo-php/tree/v4.27.2) (2022-03-24)
**Bug fix - Buy Phone Number & Application Response**
- Addition of missing fields(Number, NumberStatus, and status) in Buy [Phone number API](https://www.plivo.com/docs/numbers/api/phone-number#buy-a-phone-number).
- Enhanced error response for [Create Application API](https://www.plivo.com/docs/account/api/application/create-an-application/)

## [v4.27.1](https://github.com/plivo/plivo-php/tree/v4.27.1) (2022-03-15)
**Bug fix - CallInterface params**
- Attribute `answer_method` is set to optional for [Make a Call API](https://www.plivo.com/docs/voice/api/call#make-a-call)

## [v4.27.0](https://github.com/plivo/plivo-php/tree/v4.27.0) (2022-03-10)
**Add on - Dependancy library**
- Do not anchor php-jwt version.

## [v4.26.0](https://github.com/plivo/plivo-php/tree/v4.26.0) (2022-02-25)
**Features - Numbers: Hosted Messaging API**
- Add support for Hosted Messaging APIs.

## [v4.25.2](https://github.com/plivo/plivo-php/tree/v4.25.2) (2022-02-01)
**Features - MPCCallRecording**
- parameter name change from statusCallBack to recordingCallBack

## [v4.25.1](https://github.com/plivo/plivo-php/tree/v4.25.1) (2022-01-25)
**Bug fix - Messaging**
- Default value set to null for send sms attributes.

## [v4.25.0](https://github.com/plivo/plivo-php/tree/v4.25.0) (2021-12-15)
**Features - Voice**
- Routing SDK traffic through Akamai endpoints for all the [Voice APIs](https://www.plivo.com/docs/voice/api/overview/)

## [v4.24.1](https://github.com/plivo/plivo-php/releases/tag/v4.24.1) - 2021-12-06
**Bug fix**
- [Send SMS](https://www.plivo.com/docs/sms/api/message#send-a-message) to stop expecting optional/conitonal parameters when not passed in older messaging interface.

## [v4.24.0](https://github.com/plivo/plivo-php/releases/tag/v4.24.0) - 2021-11-11
**Features - Messaging**
- New 10DLC API:
  - Brand API: `Create`, `Get`  and `List`.
  - Campaign API: `Create`, `Get` and `List`.

## [v4.23.0](https://github.com/plivo/plivo-php/releases/tag/v4.23.0) - 2021-11-08
**Features - Messaging**
- This version includes advancements to the Messaging Interface that deals with the [Send SMS/MMS](https://www.plivo.com/docs/sms/api/message#send-a-message) interface, Creating a standard structure for `request/input` arguments to make implementation easier and incorporating support for the older interface.

 Example for [send SMS](https://github.com/plivo/plivo-php#send-a-message)

## [v4.22.0](https://github.com/plivo/plivo-node/tree/v4.22.0) - (2021-11-03)
- Added Voice MPC enhancements.

## [v4.21.3](https://github.com/plivo/plivo-php/releases/tag/v4.21.3) - 2021-10-29
- Fix `exception` returned by [Search phone number API](https://www.plivo.com/docs/numbers/api/phone-number/search-phone-numbers/) for successful request.

## [v4.21.2](https://github.com/plivo/plivo-php/releases/tag/v4.21.2) - 2021-10-19
- Fixing the `GET` request.

## [v4.21.1](https://github.com/plivo/plivo-php/releases/tag/v4.21.1) - 2021-07-27
- Updated default HTTP client request timeout to 5 seconds.

## [v4.21.0](https://github.com/plivo/plivo-php/releases/tag/v4.21.0) - 2021-07-13
- Power pack ID has been included to the response for the [list all messages API](https://www.plivo.com/docs/sms/api/message/list-all-messages/) and the [get message details API](https://www.plivo.com/docs/sms/api/message#retrieve-a-message).
- Support for filtering messages by Power pack ID has been added to the [list all messages API](https://www.plivo.com/docs/sms/api/message#list-all-messages).

## [v4.20.0](https://github.com/plivo/plivo-php/releases/tag/v4.20.0) - 2021-07-13
- Add SDK support for MPC APIs and XML.

## [v4.19.2](https://github.com/plivo/plivo-php/releases/tag/v4.19.2) - 2021-07-05
- **WARNING**: Remove total_count field from meta data for list MDR response

## [v4.19.1](https://github.com/plivo/plivo-php/releases/tag/v4.19.1) - 2021-07-02
- Adds VoiceNetworkGroup to List/Get Call response.

## [v4.19.0](https://github.com/plivo/plivo-php/releases/tag/v4.19.0) - 2021-06-15
- Add stir verification param as part of Get CDR and live call APIs

## [v4.18.3](https://github.com/plivo/plivo-php/releases/tag/v4.18.3) - 2021-05-12
- Fixing the listMedia function invoke to fetch the media detail on message_uuid

## [v4.18.2](https://github.com/plivo/plivo-php/releases/tag/v4.18.2) - 2021-03-18
- Add "npanxx" and "local_calling_area" support for Search Phone Number.

## [v4.18.1](https://github.com/plivo/plivo-php/releases/tag/v4.18.1) - 2021-03-17
- Fix error message for 400 bad request in create endpoint API

## [v4.18.0](https://github.com/plivo/plivo-php/releases/tag/v4.18.0) - 2021-02-18
- Add support for Regulatory Compliance APIs.
- Add "active","city","country","mmsEnabled","mmsRate","complianceApplicationId","complianceStatus" - these new feilds in the List/Get rented numbers
- Add "city","mmsEnabled","mmsRate","complianceRequirement" - These new feilds are added in the Search Phone Number
- Fix "https://github.com/plivo/plivo-php/issues/201" - Retrieve the correct exception message

## [v4.17.1](https://github.com/plivo/plivo-php/releases/tag/v4.17.1) - 2021-02-15
- Fix PHP v8 deprectaion warning for PlivoResponseException

## [v4.17.0](https://github.com/plivo/plivo-php/releases/tag/v4.16.0) - 2020-12-17
- Add exception to handle destination param - SMS.

## [v4.16.0](https://github.com/plivo/plivo-php/releases/tag/v4.16.0) - 2020-12-08
- Fix retrieve_application API response.

## [v4.15.1](https://github.com/plivo/plivo-php/releases/tag/v4.15.1) - 2020-11-17
- Fix resource not found exception when making sequential requests.

## [v4.15.0](https://github.com/plivo/plivo-php/releases/tag/v4.15.0) - 2020-11-17
- Add number_priority support for Powerpack API.

## [v4.14.0](https://github.com/plivo/plivo-php/releases/tag/v4.14.0) - 2020-10-25
- Change Lookup API endpoint and response.

## [v4.13.0](https://github.com/plivo/plivo-php/releases/tag/v4.13.0) - 2020-10-13
- Add support to Guzzle HTTP client 7.
- Fix "issue-168", _Undefined index: from_number_ error - Retrieve Message Details API with Invalid message UUID.

## [v4.12.0](https://github.com/plivo/plivo-php/releases/tag/v4.12.0) - 2020-09-21
- Add support for Lookup API.

## [v4.11.1](https://github.com/plivo/plivo-php/releases/tag/v4.11.1) - 2020-09-17
- Fix "Media is invalid" error while using Send MMS API.

## [v4.11.0](https://github.com/plivo/plivo-php/releases/tag/v4.11.0) - 2020-08-25
- Add Powerpack for mms.

## [v4.10.0](https://github.com/plivo/plivo-php/releases/tag/v4.10.0) - 2020-08-03
- Add retries to multiple regions for voice requests.

## [v4.9.1](https://github.com/plivo/plivo-php/releases/tag/v4.9.1) - 2020-07-21
- Fix Get Call Details API response.

## [v4.9.0](https://github.com/plivo/plivo-php/releases/tag/v4.9.0) - 2020-05-28
- Add JWT helper functions.

## [v4.8.1](https://github.com/plivo/plivo-php/releases/tag/v4.8.1) - 2020-05-28
- Fix Create Endpoint response.

## [v4.8.0](https://github.com/plivo/plivo-php/releases/tag/v4.8.0) - 2020-04-29
- Add V3 signature helper functions.

## [v4.7.1](https://github.com/plivo/plivo-php/releases/tag/v4.7.1) - 2020-04-13
- Fix MMS media_urls response.

## [v4.7.0](https://github.com/plivo/plivo-php/releases/tag/v4.7.0) - 2020-03-31
- Add application cascade delete support.

## [v4.6.0](https://github.com/plivo/plivo-php/releases/tag/v4.6.0) - 2020-03-30
- Add Tollfree support for Powerpack

## [v4.5.0](https://github.com/plivo/plivo-php/releases/tag/v4.5.0) - 2020-03-27
- Add post call quality feedback API support.

## [v4.4.2](https://github.com/plivo/plivo-php/releases/tag/v4.4.2) - 2020-03-16
- Fix DTMF and Speak functions treating '0' as null

## [v4.4.1](https://github.com/plivo/plivo-php/releases/tag/v4.4.1) - 2020-02-28
- Add Media support.

## [v4.4.0](https://github.com/plivo/plivo-php/releases/tag/v4.4.0) - 2020-01-06
- Fix Send SMS API exception

## [v4.3.9](https://github.com/plivo/plivo-php/releases/tag/v4.3.9) - 2019-12-20
- Add Powerpack support

## [v4.3.8](https://github.com/plivo/plivo-php/releases/tag/v4.3.8) - 2019-12-04
- Add MMS support

## [v4.3.7](https://github.com/plivo/plivo-php/releases/tag/v4.3.7) - 2019-11-13
- Add GetInput XML support

## [v4.3.6](https://github.com/plivo/plivo-php/releases/tag/v4.3.6) - 2019-10-16
- Add SSML support

## [v4.3.5](https://github.com/plivo/plivo-php/releases/tag/v4.3.5) - 2019-10-16
- Fix Undefined index for invalid_number: Bulk SMS

## [v4.3.4](https://github.com/plivo/plivo-php/releases/tag/v4.3.4) - 2019-07-31
- Add logic to handle invalid numbers for bulk SMS

## [v4.3.3](https://github.com/plivo/plivo-php/releases/tag/v4.3.3) - 2019-04-15
- Fix responses to return HTTP status codes.

## [v4.3.2](https://github.com/plivo/plivo-php/releases/tag/v4.3.2) - 2019-04-02
- Fix client->messages->create response by adding error handling.

## [v4.3.1](https://github.com/plivo/plivo-php/releases/tag/v4.3.1) - 2019-03-20
- Fix Json responses for all resources.

## [v4.3.0](https://github.com/plivo/plivo-php/releases/tag/v4.3.0) - 2019-03-12
- Add PHLO support
- Add Multi-Party Call triggers

## [v4.2-beta1](https://github.com/plivo/plivo-php/releases/tag/v4.2-beta1) - 2019-03-11
- Add PHLO support
- Add Multi-Party Call triggers

## [v4.1.5](https://github.com/plivo/plivo-php/releases/tag/v4.1.5) - 2018-11-21
- Add hangup party details to CDR. CDR filtering allowed by hangup_source and hangup_cause_code.
- Add sub-account cascade delete support.

## [v4.1.4](https://github.com/plivo/plivo-php/releases/tag/v4.1.4) - 2018-10-31
- Add live calls filtering by to, from numbers and call direction.

## [v4.1.3](https://github.com/plivo/plivo-php/releases/tag/v4.1.3) - 2018-09-28
- All calls retrieval response fixed

## [v4.1.2](https://github.com/plivo/plivo-php/releases/tag/v4.1.2) - 2018-09-21
- Add Queued status for filtering calls in queued status
- Add log_incoming_messages parameter to application create and modify apis

## [v4.1.1](https://github.com/plivo/plivo-php/releases/tag/v4.1.1) - 2018-09-18
- add powerpack feature
- add unit tests for powerpack feature

## [v4.1.0](https://github.com/plivo/plivo-php/releases/tag/v4.1.0) - 2018-07-05
- Fixed subaccount create response
- Fixed response mapping with multiple resources
- FIxed validate signature to handle ports in the URLs

## [v4.0.0](https://github.com/plivo/plivo-php/releases/tag/v4.0.0) - 2018-01-18
- Added a get meta method for list responses
- Reduced default timeout to 5 seconds

## [v4.0.0-beta1](https://github.com/plivo/plivo-php/releases/tag/v4.0.0-beta1) - 2017-10-25
- The new SDK works with PHP 5.5, 5.6, 7.0 and 7.1
- JSON serialization and deserialization is now handled by the SDK
- The API interfaces are consistent and guessable

## [1.1.7](https://github.com/plivo/plivo-php/releases/tag/v1.1.7) - 2017-04-25
- API domain modified from api.plivo.io to api.plivo.com

## [1.1.6](https://github.com/plivo/plivo-php/releases/tag/v1.1.6) - 2017-04-24
- API domain modified from api.plivo.com to api.plivo.io

## [1.1.5](https://github.com/plivo/plivo-php/releases/tag/v1.1.5) - 2016-06-02
- Merge pull request #37 from plivo/add_param_dial_xml
- Added digitsMatchBLeg parameter to Dial XML

## [1.1.4](https://github.com/plivo/plivo-php/releases/tag/v1.1.4) - 2016-03-29
- now you can pass accented and non ascii characters in a Speak element and they will be properly encoded in the resulting XML

## [1.1.3](https://github.com/plivo/plivo-php/releases/tag/v1.1.3) - 2016-03-01
- Removed the catching of guzzle exceptions from the request function.

## [1.1.2](https://github.com/plivo/plivo-php/releases/tag/v1.1.2) - 2016-03-01
- Relaxed guzzlehttp/guzzle version requirements; any guzzlehttp/guzzle v6.0.0 and above should work just fine.

## [1.1.1](https://github.com/plivo/plivo-php/releases/tag/v1.1.1) - 2016-02-11
- Added validate_signature function to RestAPI class.
- closes #32

## [1.1.0](https://github.com/plivo/plivo-php/releases/tag/v1.1.0) - 2016-06-02
- closes #24
- Requires PHP 5.5 or above

## [1.0.1](https://github.com/plivo/plivo-php/releases/tag/v1.0.1) - 2015-11-25
- Update README.md

## [1.0.0](https://github.com/plivo/plivo-php/releases/tag/v1.0.0) - 2015-11-10
- Update README.md

## [0.1.0](Live on composer) - 2015-03-13
- Adheres to standard when extending parent class (match signatures)
- Makes the package installable via Composer
- Replaces HTTP_Request2 with Guzzle

# Change Log

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

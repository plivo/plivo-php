# Change Log

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

<?php

namespace Plivo\Tests\Resources;


use Plivo\Http\PlivoRequest;
use Plivo\Http\PlivoResponse;
use Plivo\Tests\BaseTestCase;


/**
 * Class PhoneNumberComplianceTest
 * @package Plivo\Tests\Resources
 */
class PhoneNumberComplianceTest extends BaseTestCase
{
    // ---------------------------------------------------------------
    // Requirements
    // ---------------------------------------------------------------

    function testGetRequirementsSuccess()
    {
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/PhoneNumber/Compliance/Requirements/',
            [
                'country_iso' => 'IN',
                'number_type' => 'local',
                'user_type' => 'business'
            ]);
        $body = file_get_contents(__DIR__ . '/../Mocks/phoneNumberComplianceRequirementGetResponse.json');

        $this->mock(new PlivoResponse($request, 200, $body));

        $actual = $this->client->phoneNumberComplianceRequirement->getList([
            'country_iso' => 'IN',
            'number_type' => 'local',
            'user_type' => 'business'
        ]);

        $this->assertRequest($request);

        self::assertNotNull($actual);
        self::assertEquals('1b592b77-d072-4298-b193-370ba887f94a', $actual['requirement_id']);
        self::assertEquals('IN', $actual['country_iso']);
        self::assertCount(2, $actual['document_types']);
        self::assertEquals('Registration Certificate', $actual['document_types'][0]['name']);
    }

    function testGetRequirementsEmptyDocumentTypes()
    {
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/PhoneNumber/Compliance/Requirements/',
            [
                'country_iso' => 'IN',
                'number_type' => 'local',
                'user_type' => 'business'
            ]);
        $body = file_get_contents(__DIR__ . '/../Mocks/phoneNumberComplianceRequirementEmptyResponse.json');

        $this->mock(new PlivoResponse($request, 200, $body));

        $actual = $this->client->phoneNumberComplianceRequirement->getList([
            'country_iso' => 'IN',
            'number_type' => 'local',
            'user_type' => 'business'
        ]);

        $this->assertRequest($request);

        self::assertNotNull($actual);
        self::assertCount(0, $actual['document_types']);
    }

    // ---------------------------------------------------------------
    // Create
    // ---------------------------------------------------------------

    function testCreateSuccess()
    {
        $data = [
            'alias' => 'TestBiz-100ac06f',
            'country_iso' => 'IN',
            'number_type' => 'local',
            'user_type' => 'business',
            'end_user_type' => 'business',
            'end_user_name' => 'Test User'
        ];

        $multipart = [
            [
                'name' => 'data',
                'contents' => json_encode($data),
            ]
        ];

        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/PhoneNumber/Compliance/',
            ['multipart' => $multipart]);
        $body = file_get_contents(__DIR__ . '/../Mocks/phoneNumberComplianceCreateResponse.json');

        $this->mock(new PlivoResponse($request, 200, $body));

        $actual = $this->client->phoneNumberCompliance->create($data);

        $this->assertRequest($request);

        self::assertNotNull($actual);
        self::assertEquals('3118f6e0-b309-43c2-bca7-b8b3c58a6189', $actual->getComplianceId());
        self::assertEquals('Compliance application created and submitted for review.', $actual->getMessage());
        self::assertEquals('ad88a992-31aa-11f1-ab48-d2d6f5435dea', $actual->getApiId());
    }

    function testCreateVerifyMultipartStructure()
    {
        $data = [
            'alias' => 'TestBiz-multipart',
            'country_iso' => 'IN',
            'number_type' => 'local',
            'user_type' => 'business'
        ];

        $multipart = [
            [
                'name' => 'data',
                'contents' => json_encode($data),
            ]
        ];

        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/PhoneNumber/Compliance/',
            ['multipart' => $multipart]);
        $body = file_get_contents(__DIR__ . '/../Mocks/phoneNumberComplianceCreateResponse.json');

        $this->mock(new PlivoResponse($request, 200, $body));

        $actual = $this->client->phoneNumberCompliance->create($data);

        $this->assertRequest($request);

        self::assertNotNull($actual);
        self::assertNotNull($actual->getComplianceId());
    }

    // ---------------------------------------------------------------
    // List
    // ---------------------------------------------------------------

    function testListSuccess()
    {
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/PhoneNumber/Compliance/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/phoneNumberComplianceListResponse.json');

        $this->mock(new PlivoResponse($request, 200, $body));

        $actual = $this->client->phoneNumberCompliance->getList();

        $this->assertRequest($request);

        self::assertNotNull($actual);
        self::assertGreaterThan(0, count($actual->get()));
        self::assertCount(2, $actual->get());
    }

    function testListWithFilters()
    {
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/PhoneNumber/Compliance/',
            [
                'country_iso' => 'IN',
                'status' => 'accepted',
                'limit' => 10,
                'offset' => 0
            ]);
        $body = file_get_contents(__DIR__ . '/../Mocks/phoneNumberComplianceListResponse.json');

        $this->mock(new PlivoResponse($request, 200, $body));

        $actual = $this->client->phoneNumberCompliance->getList([
            'country_iso' => 'IN',
            'status' => 'accepted',
            'limit' => 10,
            'offset' => 0
        ]);

        $this->assertRequest($request);

        self::assertNotNull($actual);
        self::assertGreaterThan(0, count($actual->get()));
    }

    function testListEmpty()
    {
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/PhoneNumber/Compliance/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/phoneNumberComplianceListEmptyResponse.json');

        $this->mock(new PlivoResponse($request, 200, $body));

        $actual = $this->client->phoneNumberCompliance->getList();

        $this->assertRequest($request);

        self::assertNotNull($actual);
        self::assertCount(0, $actual->get());
    }

    function testListPaginationMeta()
    {
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/PhoneNumber/Compliance/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/phoneNumberComplianceListResponse.json');

        $this->mock(new PlivoResponse($request, 200, $body));

        $actual = $this->client->phoneNumberCompliance->getList();

        $this->assertRequest($request);

        self::assertNotNull($actual);

        $meta = $actual->meta();
        self::assertEquals(20, $meta['limit']);
        self::assertEquals(0, $meta['offset']);
        self::assertEquals(2, $meta['total_count']);
        self::assertNotNull($meta['next']);
        self::assertNull($meta['previous']);
    }

    // ---------------------------------------------------------------
    // Get
    // ---------------------------------------------------------------

    function testGetSuccess()
    {
        $complianceId = '767bc62c-2332-4a34-959c-1f6416186254';
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/PhoneNumber/Compliance/' . $complianceId . '/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/phoneNumberComplianceGetResponse.json');

        $this->mock(new PlivoResponse($request, 200, $body));

        $actual = $this->client->phoneNumberCompliance->get($complianceId);

        $this->assertRequest($request);

        self::assertNotNull($actual);
        self::assertEquals($complianceId, $actual->id);
    }

    function testGetWithExpand()
    {
        $complianceId = '767bc62c-2332-4a34-959c-1f6416186254';
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/PhoneNumber/Compliance/' . $complianceId . '/',
            ['expand' => 'true']);
        $body = file_get_contents(__DIR__ . '/../Mocks/phoneNumberComplianceGetExpandResponse.json');

        $this->mock(new PlivoResponse($request, 200, $body));

        $actual = $this->client->phoneNumberCompliance->get($complianceId, ['expand' => 'true']);

        $this->assertRequest($request);

        self::assertNotNull($actual);
        self::assertEquals($complianceId, $actual->id);
    }

    function testGet404Error()
    {
        $complianceId = 'nonexistent-id-12345';
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/PhoneNumber/Compliance/' . $complianceId . '/',
            []);
        $body = json_encode(['error' => 'Compliance application not found.']);

        $this->mock(new PlivoResponse($request, 404, $body));

        $this->expectPlivoException('Plivo\Exceptions\PlivoResponseException');

        $this->client->phoneNumberCompliance->get($complianceId);
    }

    function testGetOptionalFields()
    {
        $complianceId = '767bc62c-2332-4a34-959c-1f6416186254';
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/PhoneNumber/Compliance/' . $complianceId . '/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/phoneNumberComplianceGetExpandResponse.json');

        $this->mock(new PlivoResponse($request, 200, $body));

        $actual = $this->client->phoneNumberCompliance->get($complianceId);

        $this->assertRequest($request);

        self::assertNotNull($actual);
        self::assertNotNull($actual->endUser);
        self::assertNotNull($actual->documents);
        self::assertEquals('rejected', $actual->status);
    }

    // ---------------------------------------------------------------
    // Update (PATCH)
    // ---------------------------------------------------------------

    function testUpdateSuccess()
    {
        $complianceId = 'f812efe4-a461-4f00-b6ae-bdfb40fcc343';
        $data = [
            'alias' => 'patched-alias-2084'
        ];

        $multipart = [
            [
                'name' => 'data',
                'contents' => json_encode($data),
            ]
        ];

        $request = new PlivoRequest(
            'PATCH',
            'Account/MAXXXXXXXXXXXXXXXXXX/PhoneNumber/Compliance/' . $complianceId . '/',
            ['multipart' => $multipart]);
        $body = file_get_contents(__DIR__ . '/../Mocks/phoneNumberComplianceUpdateResponse.json');

        $this->mock(new PlivoResponse($request, 200, $body));

        $actual = $this->client->phoneNumberCompliance->update($complianceId, $data);

        $this->assertRequest($request);

        self::assertNotNull($actual);
        self::assertEquals('Compliance application updated and resubmitted for review.', $actual->getMessage());
        self::assertEquals('ef28ebe6-31a5-11f1-bf86-d2d6f5435dea', $actual->getApiId());
    }

    function testUpdateVerifyPatchMethod()
    {
        $complianceId = 'f812efe4-a461-4f00-b6ae-bdfb40fcc343';
        $data = [
            'alias' => 'new-alias'
        ];

        $multipart = [
            [
                'name' => 'data',
                'contents' => json_encode($data),
            ]
        ];

        $request = new PlivoRequest(
            'PATCH',
            'Account/MAXXXXXXXXXXXXXXXXXX/PhoneNumber/Compliance/' . $complianceId . '/',
            ['multipart' => $multipart]);
        $body = file_get_contents(__DIR__ . '/../Mocks/phoneNumberComplianceUpdateResponse.json');

        $this->mock(new PlivoResponse($request, 200, $body));

        $actual = $this->client->phoneNumberCompliance->update($complianceId, $data);

        $this->assertRequest($request);

        self::assertNotNull($actual);
    }

    // ---------------------------------------------------------------
    // Delete
    // ---------------------------------------------------------------

    function testDeleteSuccess()
    {
        $complianceId = 'd73b0188-08a8-4bb0-8acf-25e23e274120';
        $request = new PlivoRequest(
            'DELETE',
            'Account/MAXXXXXXXXXXXXXXXXXX/PhoneNumber/Compliance/' . $complianceId . '/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/phoneNumberComplianceDeleteResponse.json');

        $this->mock(new PlivoResponse($request, 204, $body));

        $actual = $this->client->phoneNumberCompliance->delete($complianceId);

        $this->assertRequest($request);

        self::assertNull($actual);
    }

    function testDelete404Error()
    {
        $complianceId = 'nonexistent-id-12345';
        $request = new PlivoRequest(
            'DELETE',
            'Account/MAXXXXXXXXXXXXXXXXXX/PhoneNumber/Compliance/' . $complianceId . '/',
            []);
        $body = json_encode(['error' => 'Compliance application not found.']);

        $this->mock(new PlivoResponse($request, 404, $body));

        $this->expectPlivoException('Plivo\Exceptions\PlivoResponseException');

        $this->client->phoneNumberCompliance->delete($complianceId);
    }

    // ---------------------------------------------------------------
    // Link
    // ---------------------------------------------------------------

    function testLinkSuccess()
    {
        $numbers = [
            'numbers' => ['+912248885512', '+912248885513'],
            'compliance_id' => '767bc62c-2332-4a34-959c-1f6416186254'
        ];

        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/PhoneNumber/Compliance/Link/',
            $numbers);
        $body = file_get_contents(__DIR__ . '/../Mocks/phoneNumberComplianceLinkResponse.json');

        $this->mock(new PlivoResponse($request, 200, $body));

        $actual = $this->client->phoneNumberComplianceLink->link($numbers);

        $this->assertRequest($request);

        self::assertNotNull($actual);
        self::assertEquals('Numbers linked successfully.', $actual['message']);
        self::assertEquals('afd51000-31aa-11f1-ab48-d2d6f5435dea', $actual['api_id']);
    }

    function testLinkEmptyReport()
    {
        $numbers = [
            'numbers' => [],
            'compliance_id' => '767bc62c-2332-4a34-959c-1f6416186254'
        ];

        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/PhoneNumber/Compliance/Link/',
            $numbers);
        $body = file_get_contents(__DIR__ . '/../Mocks/phoneNumberComplianceLinkEmptyReportResponse.json');

        $this->mock(new PlivoResponse($request, 200, $body));

        $actual = $this->client->phoneNumberComplianceLink->link($numbers);

        $this->assertRequest($request);

        self::assertNotNull($actual);
        self::assertEquals('No numbers were linked.', $actual['message']);
    }

    function testLinkRequestBodyStructure()
    {
        $numbers = [
            'numbers' => ['+912248885512'],
            'compliance_id' => '074d687f-5630-483d-8349-5b9d7686d673'
        ];

        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/PhoneNumber/Compliance/Link/',
            $numbers);
        $body = file_get_contents(__DIR__ . '/../Mocks/phoneNumberComplianceLinkResponse.json');

        $this->mock(new PlivoResponse($request, 200, $body));

        $actual = $this->client->phoneNumberComplianceLink->link($numbers);

        $this->assertRequest($request);

        self::assertNotNull($actual);
    }

    // ---------------------------------------------------------------
    // Edge cases
    // ---------------------------------------------------------------

    function testRequirementsUrlPath()
    {
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/PhoneNumber/Compliance/Requirements/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/phoneNumberComplianceRequirementGetResponse.json');

        $this->mock(new PlivoResponse($request, 200, $body));

        $actual = $this->client->phoneNumberComplianceRequirement->getList();

        $this->assertRequest($request);

        self::assertNotNull($actual);
        self::assertArrayHasKey('api_id', $actual);
        self::assertArrayHasKey('document_types', $actual);
    }
}

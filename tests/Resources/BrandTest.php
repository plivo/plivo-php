<?php

namespace Plivo\Tests\Resources;




use Plivo\Http\PlivoRequest;
use Plivo\Http\PlivoResponse;
use Plivo\Tests\BaseTestCase;


/**
 * Class MessageTest
 * @package Plivo\Tests\Resources
 */
class BrandTest extends BaseTestCase {

    public function testBrandCreate()
    {
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/10dlc/Brand/',
            [
                'brand_alias' => "vishnu128",
                'profile_uuid' => "3cf3e991-2f94-4910-9712-61442987a2d0",
                'brand_type' => "starter",
                'secondary_vetting' => false
            ]);
        $body = file_get_contents(__DIR__ . '/../Mocks/brandCreationResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->brand->create("vishnu128", "3cf3e991-2f94-4910-9712-61442987a2d0","starter", false);

        self::assertNotNull($actual);
    }

    public function testGetBrand()
    {
        $brandID = "BRPXS6E";
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/10dlc/Brand/'.$brandID.'/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/brandGetResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->brand->get($brandID);
        self::assertNotNull($actual);
        $this->assertRequest($request);

    }
   
    
    function testBrandList()
    {
        $request = new PlivoRequest(
            'Get',
            'Account/MAXXXXXXXXXXXXXXXXXX/10dlc/Brand/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/brandListResponse.json');
        
        $this->mock(new PlivoResponse($request,202, $body));
        
        $actual = $this->client->brand->list();
        
        $this->assertRequest($request);
        
        self::assertNotNull($actual);
    }

    public function testGetBrandUsecase()
    {
        $brandID = "BRPXS6E";
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/10dlc/Brand/'.$brandID.'/usecases' . '/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/brandGetUsecasesResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->brand->get_brand_usecases($brandID);
        self::assertNotNull($actual);
        $this->assertRequest($request);

    }

    public function testDeleteBrandUsecase()
    {
        $brandID = "BRPXS6E";
        $request = new PlivoRequest(
            'DELETE',
            'Account/MAXXXXXXXXXXXXXXXXXX/10dlc/Brand/'.$brandID.'/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/brandDeleteResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->brand->delete($brandID);
        self::assertNotNull($actual);
        $this->assertRequest($request);

    }

}
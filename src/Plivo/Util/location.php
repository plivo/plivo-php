<?php

namespace Plivo\Util;

class Location {
    public $latitude;
    public $longitude;
    public $name;
    public $address;

    public function __construct(array $data)
    {
        $this->latitude = $data['latitude'] ?? null;
        $this->longitude = $data['longitude'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->address = $data['address'] ?? null;
    }

    public function validateLocation(string $location)
    {
        if(is_null(json_decode($location, true))) {
            return "Invalid JSON data for location messages!";
        }
        $location = new Location(json_decode($location, true));
        return null;
    }
}


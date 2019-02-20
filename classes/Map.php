<?php

class Map
{
    public function getCoord($spot)
    {
        $spot = urlencode($spot);
        $json = file_get_contents("https://api.tomtom.com/search/2/geocode/$spot.json?key=20aPL0ALOkwuqGVfp9GE7dBv7maAHbsl");
        $obj = json_decode($json);
        $lat = $obj->results[0]->position->lat;
        $lon = $obj->results[0]->position->lon;
        $coord = $lat . ',' . $lon;

        return $coord;
    }

    public function getDistance($source, $destination)
    {
        $json = file_get_contents("https://api.tomtom.com/routing/1/calculateRoute/$source:$destination/json?key=20aPL0ALOkwuqGVfp9GE7dBv7maAHbsl");
        $obj = json_decode($json);
        $distance = ($obj->routes[0]->summary->lengthInMeters)/1000;

        return $distance;
    }
}
<?php

class Aircraft{
    //Arrays of aircraft info including name and capacity of passengers
     protected array $aircrafts = array(
        array("name"=>"SyberJet SJ30i", "capacity"=>"6"),
        array("name"=>"Cirrus SF50", "capacity"=>"4"),
        array ("name"=>"HondaJet Elite", "capacity"=>"5"));

    function _aircraftInfo ($aircraftCode)
    {
        $info = "The aircraft for the flight is: " . $this->aircrafts[$aircraftCode]["name"] .
            ", and the number of passengers capacity is: ". $this->aircrafts[$aircraftCode]["capacity"].
        "<br>";
        print_r($info);
    }

}

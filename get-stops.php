<?php

    include_once("./classes/Ride.php");

    try {
        $rides = Ride::getRidesByDate("2021-06-09");
    } catch (Exception $e) {
        $error = $e->getMessage();
    }

    if(!isset($error)) {

        $data = [];

        foreach($rides as $ride) {

            $array = [
                "id" => $ride["id"],
                "name" => $ride["name"],
                "address_street" => $ride["address_street"],
                "address_number" => $ride["address_number"],
                "postal_code" => $ride["postal_code"],
                "city" => $ride["city"],
                "is_ready" => $ride["is_ready"]
            ];

            array_push($data, $array);

        }

        $response = [
            "status" => "success",
            "data" => $data
        ];
    } else {
        $response = [
            "status" => "error",
            "message" => $error
        ];
    }

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Content-Type: application/json");
    echo json_encode($response);
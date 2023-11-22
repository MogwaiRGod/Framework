<?php

namespace ORM;
use Model\User as User;
use Exception;
use Utils\Functions as Functions;
// include_once './Utils/Functions.php';

class UserORM {
    public function create($iptUser): User | Exception 
    {
        // user id
        $id;
        // retrieving json data file
        $json = file_get_contents(JSON_FILE_URL);
        // decoding the file
        $data = json_decode($json, true);

        // if there is data already in the JSON file
        if (!empty($data["users"])) {
            // looping through data to check that neither the username nor the email is already taken (<=> checking user inputs)
            foreach($data["users"] as $user ) {
                // var_dump($user);
                if ($user["username"] == $iptUser->getUsername()) {
                    throw new Exception("Username already taken");
                } // if
                elseif ($user["email"] == $iptUser->getEmail()) {
                    throw new Exception("Email already taken");
                } // if
            } // foreach
            // getting the highest ID from the json to define the user ID
            $id = Functions::sortByKeyValue($data["users"], "id", "r")[0]["id"] + 1;
        } 
        else {
            $id = 1;
        } // if else

        // encoding the new user
        $userObject = json_encode($iptUser->setId($id));
        // var_dump($userObject);
        // adding the new user to the array
        array_push($data["users"], $iptUser);
        // encoding the json with readbable formatting
        $encodedJSON = json_encode($data, JSON_PRETTY_PRINT);
        // sending data to the file
        file_put_contents(JSON_FILE_URL, $encodedJSON);

        // return the user
        return $iptUser;
    } // create

    public function read(int $id): User | Exception
    {
        // retrieving json data file
        $json = file_get_contents(JSON_FILE_URL);
        // decoding the file
        $data = json_decode($json, true);
        // searching through data 
        foreach($data["users"] as $user ) {
            if ($user["id"] == $id) {
                $userFound = new User($user["username"], $user["email"], $user["password"], $user["id"]);
                return $userFound;
            } // if
        } // foreach

        throw new Exception("User not found");
    } // read

    public function update($updatedUser): User | Exception 
    {
        // retrieving json data file
        $json = file_get_contents(JSON_FILE_URL);
        // decoding the file
        $data = json_decode($json, true);
        $counter = 0;

        // searching corresponding user through data 
        foreach($data["users"] as $user) {
            if ($user["id"] == $updatedUser->getId()) {
                $props = $updatedUser->getProps();
                // looping through the user properties to update them in the json file
                foreach ($props as $nameProp => $value) {
                    if ($nameProp != "id") {
                        $method = "get" . ucfirst($nameProp);
                        $user[$nameProp] = $updatedUser->$method();
                    } // if
                } // foreach
                $data["users"][$counter] = $user;
                break;
            } // if
            $counter++;
        } // foreach

        // encoding the json with readbable formatting
        $encodedJSON = json_encode($data, JSON_PRETTY_PRINT);
        // sending data to the file
        file_put_contents(JSON_FILE_URL, $encodedJSON);

        return $updatedUser;
    } // update

    public function delete(int $id): ?Exception
    {
        // retrieving json data file
        $json = file_get_contents(JSON_FILE_URL);
        // decoding the file
        $data = json_decode($json, true);
        $counter = 0;

        // looping through data file to find the user with the corresponding ID
        foreach($data["users"] as $user ) {
            if ($user["id"] == $id) {
                unset($data["users"][$counter]);
                // encoding the json with readbable formatting
                $encodedJSON = json_encode($data, JSON_PRETTY_PRINT);
                // sending data to the file
                file_put_contents(JSON_FILE_URL, $encodedJSON);
                return null;
            } // if
            $counter++;
        } // foreach

        throw new Exception("User not found");
    } // delete
} // CRUD
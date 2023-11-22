<?php

namespace core;
use Model\User as User;
use Exception;
use Utils\Functions as Functions;
use ReflectionClass;

abstract class AbstractORM implements ORMInterface {
    public $tableName;
    public $uniqueProps;
    public $className;
    public $modelName;
    public $propsNames;

    /**
     * @param mixed $object class instance of the data to push to the JSON file
     * @return mixed Return value of each child ORM will be: the Model or an Exception
     */
    public function create(mixed $object): mixed
    {
        // object id
        $id;
        // decoded JSON file
        $data = $this->retrieveData();

        // // if there is data already in the JSON file
        if (!empty($data[$this->tableName])) {
            // looping through data to check that neither the username nor the email is already taken (<=> checking user inputs)
            foreach($data[$this->tableName] as $obj ) {
                foreach($this->uniqueProps as $prop ) {
                    $method = "get" . ucfirst($prop);
                    if ($obj[$prop] == $object->$method()) {
                        return new Exception("Warning: " . $prop . " should be unique\n");
                    } // if
                } // foreach
            } // foreach
            // getting the highest ID from the json to define the user ID
            var_dump(Functions::sortByKeyValue($data[$this->tableName], "id", "r")[0]);
            $id = (int)Functions::sortByKeyValue($data[$this->tableName], "id", "r")[0] + 1;
        } 
        else {
            $id = 1;
        } // if else

        // adding an id to the object
        $object = $object->setId($id);

        // if the "table" key doesn't exist in the json file
        if (!isset($data[$this->tableName])) {
            $data[$this->tableName] = [$object];
        }
        else {
            // adding the new object to the array
            array_push($data[$this->tableName], $object);
        } // if else
        

        // saving the updated data in the JSON file
        if (!$this->saveData($data)) {
            throw new Exception("Something went wrong while saving the data");
        }

        // return the object
        return $object;

    } // create

    /**
     * @param int $id ID of the requested data
     * @return mixed Return value of each child ORM will be: the Model or an Exception
     */
    public function read(int $id) : mixed
    {
        // decoded JSON file
        $data = $this->retrieveData();

        // searching through data 
        foreach($data[$this->tableName] as $object ) {
            if ($object["id"] == $id) {
                // associative array property name => value
                $arrayOfProps = [];
                foreach($this->propsNames as $prop) {
                    $arrayOfProps[$prop] = $object[$prop];
                }

                // using an instance of ReflectionClass in order to create the object with the associative array as argument
                $reflector = new ReflectionClass($this->modelName);
                // returning the data as an instance
                return $reflector->newInstanceArgs($arrayOfProps);
            } // if
        } // foreach

        throw new Exception($this->modelName . " not found");
    } // read

    /**
     * @param mixed $updatedObject Updated object
     * @return mixed Return value of each child ORM will be: the Model or an Exception
     */
    public function update(mixed $updatedObject): mixed 
    {
        // decoded JSON file
        $data = $this->retrieveData();
        // counter to save the index of the corresponding data in the json file in order to update it
        $counter = 0;

        // searching corresponding user through data 
        foreach($data[$this->tableName] as $object) {
            if ($object["id"] == $updatedObject->getId()) {
                // looping through the user properties to update them in the json file
                foreach ($this->propsNames as $nameProp) {
                    if ($nameProp != "id") {
                        $method = "get" . ucfirst($nameProp);
                        $object[$nameProp] = $updatedObject->$method();
                    } 
                    // if
                } // foreach
                $data[$this->tableName][$counter] = $object;
                break;
            } // if
            $counter++;
        } // foreach

        // saving the updated data in the JSON file
        if (!$this->saveData($data)) {
            throw new Exception("Something went wrong while saving the data");
        }

        // returning the updated object
        return $updatedObject;
    } // update

    /**
     * @param mixed $object Object to be deleted
     * @return mixed Return value of each child ORM will be: bool if success, Exception if error
     */
    public function delete(mixed $object): mixed
    {
        return $this->deleteById($object->getId());
    } // delete

    /**
     * @param int $id ID of the object to be deleted
     * @return mixed Return value of each child ORM will be: bool if success, Exception if error
     */
    public function deleteById(int $id): mixed
    {
        // decoded JSON file
        $data = $this->retrieveData();
        // counter to save the index of the corresponding data in the json file in order to update it
        $counter = 0;

        // looping through data file to find the user with the corresponding ID
        foreach($data[$this->tableName] as $object ) {
            if ($object["id"] == $id) {
                unset($data[$this->tableName][$counter]);

                // saving the updated data in the JSON file
                if (!$this->saveData($data)) {
                    throw new Exception("Something went wrong while saving the data");

                } // if
                return true;
            } // if
            $counter++;
        } // foreach

        throw new Exception("User not found");
    } // delete

    /**
     * @return array Decoded JSON file as an array
     */
    private function retrieveData(): array
    {
        // retrieving json data file
        $json = file_get_contents(JSON_FILE_URL);
        // returning the decoded the file
        return json_decode($json, true);
    } // retrieveData

    /**
     * @param array Updated array
     * @return bool Boolean if the updated file is saved successfully or not
     */
    private function saveData(array $jsonToSave): bool
    {
        try {
            // encoding the json with readbable formatting
            $encodedJSON = json_encode($jsonToSave, JSON_PRETTY_PRINT);
            // sending data to the file
            file_put_contents(JSON_FILE_URL, $encodedJSON);

            return true;
        } // try
        catch (Exception $e) {
            return false;
        } // catch
    } // saveData
} // CRUD
<?php
namespace core;
use Exception;
use ReflectionClass;

abstract class AbstractController {
    public $ORMName;
    
    public function add() : mixed
    {
        try {
            $ORM = new $this->ORMName();
            // object generation with data stored in $_REQUEST
            foreach($ORM->propsNames as $prop) {
                // first we check that all necessary data are provided
                if(in_array($prop, $ORM->notNull) && isset($_REQUEST[$prop]) && is_null($_REQUEST[$prop])) {
                    throw new Exception("Invalid inputs");
                } // if
            } // foreach
              
            // using an instance of ReflectionClass in order to create the object with the associative array as argument
            $reflector = new ReflectionClass($ORM->modelName);
            // loading all inputs to instanciate the object
            $newObject = $reflector->newInstanceArgs($_REQUEST);
            // saving the object to the json
            $newObject = $ORM->create($newObject);

            // emptying $_REQUEST to avoid any trouble with future inputs
            unset($_REQUEST);

            var_dump($newObject);
            return $newObject;
        } // try
        catch (Exception $e) {
            echo("Warning " . $e->getMessage() . "\n");
            return $e;
        } // catch
    } // add

    public function get(int $id) : mixed
    {
        try {
            $ORM = new $this->ORMName();
            // get object from the json
            $object = $ORM->read($id);

            var_dump($object);
            return $object;
        } // try
        catch (Exception $e) {
            // defining HTTP response code (internal error)
            echo("Warning " . $e->getMessage() . "\n");
            return $e;
        } // catch
    } // get

    public function update(int $id) : mixed
    {
        try {
            $ORM = new $this->ORMName();
            // get the object
            $object = $ORM->read($id);
            // check if the input keys are invalid
            if (empty(array_diff($ORM->propsNames, array_keys($_REQUEST)))) {
                throw new Exception("Invalid inputs");
            }
            // updating the object
            foreach(array_keys($_REQUEST) as $nameProp) {
                if ($nameProp != "id") {
                    $method = "set" . ucfirst($nameProp);
                    $object = $object->$method($_REQUEST[$nameProp]);
                } 
                // if
            } // foreach
            // updating object from the json
            $object = $ORM->update($object);

            var_dump($object);
            return $object;
        } // try
        catch (Exception $e) {
            echo("Warning " . $e->getMessage() . "\n");
            return $e;
        } // catch
    } // update

    public function deleteById(int $id) : bool | Exception
    {
        try {
            $ORM = new $this->ORMName();
            // delete object from the json
            return $ORM->deleteById($id);
        } // try
        catch (Exception $e) {
            echo("Warning " . $e->getMessage() . "\n");
        } // catch
    } // delete

    public function delete(mixed $object) : bool | Exception
    {
        try {
            $ORM = new $this->ORMName();
            // delete object from the json
            return $ORM->delete($object);
        } // try
        catch (Exception $e) {
            echo("Warning " . $e->getMessage() . "\n");
        } // catch
    } // delete
}
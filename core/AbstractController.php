<?php
namespace core;
use Exception;

abstract class AbstractController {
    public $ORMName;
    
    public function add(mixed $object) : mixed
    {
        $ORM = new $this->ORMName();
        try {
            // add object to the json
            var_dump($ORM->create($user));
        }
        catch (Exception $e) {
            echo("Warning " . $e->getMessage() . "\n");
        }
    }

    public function get(int $id) : mixed
    {
        $ORM = new $this->ORMName();
        try {
            // get object from the json
            $object = $ORM->read($id);
            var_dump($object);
            return $object;
        }
        catch (Exception $e) {
            echo("Warning " . $e->getMessage() . "\n");
        }
    }

    public function update(mixed $updatedObject) : mixed
    {
        $ORM = new $this->ORMName();
        try {
            // update object from the json
            $object = $ORM->update($updatedObject);
            return $object;
        }
        catch (Exception $e) {
            echo("Warning " . $e->getMessage() . "\n");
        }
    }

    public function delete(int $id) : bool | Exception
    {
        $ORM = new $this->ORMName();
        try {
            // delete object from the json
            return $ORM->delete($id);
        }
        catch (Exception $e) {
            echo("Warning " . $e->getMessage() . "\n");
        }
    }
}
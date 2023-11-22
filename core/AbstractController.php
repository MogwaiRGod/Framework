<?php
namespace core;
use Exception;

abstract class AbstractController {
    private $ORMName;
    
    public static function add(mixed $object) : mixed
    {
        $ORM = new $ORMName();
        try {
            // add object to the json
            $ORM->create($user);
        }
        catch (Exception $e) {
            echo("Warning " . $e->getMessage() . "\n");
        }
    }

    public static function get(int $id) : mixed
    {
        $ORM = new $ORMName();
        try {
            // get object from the json
            $object = $ORM->read($id);
            return $object;
        }
        catch (Exception $e) {
            echo("Warning " . $e->getMessage() . "\n");
        }
    }

    public static function update(mixed $updatedObject) : mixed
    {
        $ORM = new $ORMName();
        try {
            // update object from the json
            $object = $ORM->update($updatedObject);
            return $object;
        }
        catch (Exception $e) {
            echo("Warning " . $e->getMessage() . "\n");
        }
    }

    public static function delete(int $id) : bool | Exception
    {
        $ORM = new $ORMName();
        try {
            // delete object from the json
            return $ORM->delete($id);
        }
        catch (Exception $e) {
            echo("Warning " . $e->getMessage() . "\n");
        }
    }
}
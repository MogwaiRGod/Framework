<?php
namespace core;
use ORM\UserORM as UserORM;
use Model\User as User;
use Exception;

abstract class AbstractController {
    protected 
    public static function add(mixed $object) : mixed
    {
        $ORM = new UserORM();
        try {
            // add user to the json
            $ORM->create($user);
        }
        catch (Exception $e) {
            echo("Warning " . $e->getMessage() . "\n");
        }
    }

    public static function get(int $id) : mixed
    {
        $ORM = new UserORM();
        try {
            // get user from the json
            $user = $ORM->read($id);
            return $user;
        }
        catch (Exception $e) {
            echo("Warning " . $e->getMessage() . "\n");
        }
    }

    public static function update(User $updatedUser) : User | Exception
    {
        $ORM = new UserORM();
        try {
            // get user from the json
            $user = $ORM->update($updatedUser);
            return $user;
        }
        catch (Exception $e) {
            echo("Warning " . $e->getMessage() . "\n");
        }
    }

    public static function delete(int $id) : ?Exception
    {
        $ORM = new UserORM();
        try {
            // delete user from the json
            return $ORM->delete($id);
        }
        catch (Exception $e) {
            echo("Warning " . $e->getMessage() . "\n");
        }
    }
}
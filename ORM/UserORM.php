<?php

namespace ORM;
use Model\User as User;
use core\AbstractORM as AbstractORM;
use Exception;
use Utils\Functions as Functions;

/**
 * Documentation
 * 
 * @method create(User $user) : User|Exception Returns the argument user if success, Exception if an error occured.
 * @method read(int $id) : User|Exception Returns the user created with the data from the JSON file if success, Exception if an error occured.
 * @method update(User $user) : User|Exception Returns the argument user if success, Exception if an error occured.
 * @method delete(int $id) : bool|Exception Returns true if success, Exception if an error occured.
 */
class UserORM extends AbstractORM {
    public function __construct($tb = "users", $uq = ["username"], $class = "UserORM", $model = "Model\User", $propsNames = null) {
        $this->tableName = $tb;
        $this->uniqueProps = $uq;
        $this->className = $class;
        $this->modelName = $model;
        $this->propsNames = $this->loadProps();
    } // __construct

    /**
     * @return array Property names of User
     */
    private function loadProps(): array
    {
        $tmp = new User("x", "x", "x");
        return array_keys($tmp->getProps());
    }

} // UserORM
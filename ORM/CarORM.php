<?php

namespace ORM;
use Model\Car as Car;
use core\AbstractORM as AbstractORM;
use core\ORMInterface as ORMInterface;
use Exception;
use Utils\Functions as Functions;

/**
 * Documentation
 * 
 * @method create(car $car) : car|Exception Returns the argument Car if success, Exception if an error occured.
 * @method read(int $id) : car|Exception Returns the Car created with the data from the JSON file if success, Exception if an error occured.
 * @method update(car $car) : car|Exception Returns the argument Car if success, Exception if an error occured.
 * @method deleteById(int $id) : bool|Exception Returns true if success, Exception if an error occured.
 * @method delete(car $car) : bool|Exception Returns true if success, Exception if an error occured.
 * @method loadProps() : array Property names of the model
 */
class carORM extends AbstractORM implements ORMInterface {
    public function __construct($tb = "cars", $uq = [], $class = "CarORM", $model = "Model\Car", $propsNames = null) {
        $this->tableName = $tb;
        $this->uniqueProps = $uq;
        $this->className = $class;
        $this->modelName = $model;
        $this->notNull = ["brand", "price"];
        $this->propsNames = $this->loadProps();
    } // __construct

    /**
     * @return array Property names of car
     */
    public function loadProps(): array
    {
        $tmp = new Car("x", 1);
        return array_keys($tmp->getProps());
    } // loadProps
} // carORM
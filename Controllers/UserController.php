<?php

namespace Controllers;
use ORM\UserORM as UserORM;
use Model\Car as Car;
use core\AbstractController;

class UserController extends AbstractController {
    public $ORMName = "ORM\\UserORM";
}
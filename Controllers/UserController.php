<?php

namespace Controllers;
use ORM\UserORM as UserORM;
use Model\User as User;
use core\AbstractController;

class UserController extends AbstractController {
    public $ORMName = "ORM\\UserORM";
}
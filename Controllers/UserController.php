<?php

namespace Controllers;
use ORM\UserORM as UserORM;
use Model\User as User;
use core\AbstractController;

class UserController extends AbstractController {
    private $ORMName;

    public function __construct()
    {
        $this->ORMName = "UserORM";
    }
}
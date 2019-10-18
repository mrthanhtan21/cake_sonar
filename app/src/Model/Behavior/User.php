<?php


namespace App\Model\Behavior;


class User extends AppModel
{
    public $hasMany = array('User_address');
}

<?php


namespace App\Model\Behavior;


class Order extends AppModel
{
    public $hasMany = array('Order_detail');
}

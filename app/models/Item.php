<?php

namespace Models;

use Phalcon\Mvc\MongoCollection as MongoCollection;

class Item extends MongoCollection
{
    public $uuid;
    public $userId;
    public $itemName;
    public $dateIn;
    public $status;
    /**
     * Sets the Model's collection
     *
     * @return string
     */
    public function getSource()
    {
        return 'items';
    }
    /**
     * Returns all users from the Users collection
     *
     * @return array
     */
    public static function getAll()
    {
        return Item::find();
    }
    /**
     * Inserts a new user into the collection
     *
     * @param $req
     * @return bool
     */
    public static function insert($req)
    {
        $item = new Item();
        $item->uuid = uniqid(md5(random_bytes(10)));
        $item->userId = $req->userId;
        $item->itemName = $req->itemName;
        $item->status = 0;
        $item->dateIn = strtotime("now");

        # Create() returns bool
        if($item->create())
        {
            return true;
        }
        return false;
    }
}
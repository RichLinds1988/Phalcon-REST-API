<?php

namespace Models;

use Phalcon\Mvc\MongoCollection as MongoCollection;

class User extends MongoCollection
{
    public $firstName;
    public $lastName;
    public $email;

    /**
     * Sets the Model's collection
     *
     * @return string
     */
    public function getSource()
    {
        return 'users';
    }

    /**
     * Returns all users from the Users collection
     *
     * @return array
     */
    public static function getAll()
    {
        return User::find();
    }

    /**
     * Inserts a new user into the collection
     *
     * @param $req
     * @return bool
     */
    public static function insert($req)
    {
        $user = new User();
        $user->first = $req->first;
        $user->last = $req->last;
        $user->dob = $req->dob;
        $user->email = $req->email;

        # Create() returns bool
        if($user->create())
        {
            return true;
        }

        return false;
    }
}
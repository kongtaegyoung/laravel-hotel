<?php

namespace App;

use Eclair\Database\Adaptor;
class User
{
    public function create()
    {
        return Adaptor::exec(
            'insert into users(`email`, `password`) values(?, ?)',
            [ $this->email, $this->password ]
        );
    }
    public function getUsername()
    {
        return current(explode('@', $this->email));
    }
}
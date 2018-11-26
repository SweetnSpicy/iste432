<?php

class User {
    private $username;
    private $role;

    public function whoIsI(){
        return "My username: {$this->username}\n My role: {$this->role}";
    }
}




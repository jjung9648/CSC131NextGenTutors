<?php
require_once 'user.php';

abstract class UserDecorator implements User {
    protected $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function signIn($email, $password) {
        return $this->user->signIn($email, $password);
    }

    public function register($email, $password) {
        return $this->user->register($email, $password);
    }
}
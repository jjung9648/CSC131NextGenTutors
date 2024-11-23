<?php
interface User {
    public function signIn($email, $password);
    public function register($email, $password);
}
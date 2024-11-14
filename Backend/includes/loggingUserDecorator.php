<?php
require_once 'userDecorator.php';

class LoggingUserDecorator extends UserDecorator {
    public function signIn($email, $password) {
        $result = parent::signIn($email, $password);
        if ($result) {
            error_log("User signed in: " . $email);
        } else {
            error_log("Failed sign in attempt: " . $email);
        }
        return $result;
    }

    public function register($email, $password) {
        $result = parent::register($email, $password);
        if ($result) {
            error_log("User registered: " . $email);
        } else {
            error_log("Failed registration attempt: " . $email);
        }
        return $result;
    }
}
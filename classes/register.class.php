<?php
class RegisterUser
{
    private $username;
    private $country;
    private $email;
    private $raw_password;
    private $encrypted_password;
    private $storage = 'data.json';
    private $stored_users;
    private $new_user;
    public $valid_feedback;
    public $invalid_feedback;

    public function __construct($username, $password, $country, $email)
    {
        $this->username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $this->email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $this->country = filter_input(INPUT_POST, "country", FILTER_SANITIZE_SPECIAL_CHARS);

        $this->raw_password = trim($password);
        $this->encrypted_password = password_hash($this->raw_password, PASSWORD_DEFAULT);

        $this->stored_users = json_decode(file_get_contents($this->storage), true);

        $this->new_user = [
            "username" => $this->username,
            "password" => $this->encrypted_password,
            "country" => $this->country,
            "email" => $this->email,
        ];

        if ($this->checkFieldValues()) {
            $this->insertUser();
        }
    }

    private function checkFieldValues()
    {
        if (empty($this->username) || empty($this->raw_password) || empty($this->country) || empty($this->email)) {
            $this->invalid_feedback = "All fields are required.";

            return false;
        } else {
            return true;
        }
    }

    private function usernameExists()
    {
        foreach ($this->stored_users as $user) {
            if ($this->username == $user['username']) {
                $this->invalid_feedback = "Username already taken, please choose a differnet one.";
                return true;
            }
        }
        return false;
    }

    private function emailExists()
    {
        foreach ($this->stored_users as $user) {
            if ($this->email == $user['email']) {
                $this->invalid_feedback = "email already taken, please choose a differnet one.";
                return true;
            }
        }
        return false;
    }

    private function insertUser()
    {
        if ($this->usernameExists() == FALSE && $this->emailExists() == FALSE) {
            array_push($this->stored_users, $this->new_user);

            if (file_put_contents($this->storage, json_encode($this->stored_users, JSON_PRETTY_PRINT))) {
                header("Location: login.php");
                exit();
            } else {
                return $this->invalid_feedback = "Something went wrong, please try again.";
            }
        }
    }
}

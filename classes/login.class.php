<?php 
class LoginUser{
    private $username;
    private $password;
    private $storage = 'data.json';
    private $stored_users;
    public $valid_feedback;
    public $invalid_feedback;


    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
        $this->stored_users = json_decode(file_get_contents($this->storage), true);
        $this->login();
    }

    private function login(){
        foreach ($this->stored_users as $user) {
            if ($user['username'] == $this->username){
                if(password_verify($this->password, $user['password'])){
                    session_start();
                    $_SESSION['user'] = $this->username;
                    header("Location: index.php");
                    exit();
                }
            }
        }
        return $this->invalid_feedback = "Wrong username or password";
    }
}
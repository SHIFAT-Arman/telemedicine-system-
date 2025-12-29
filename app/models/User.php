<?php

class User
{
    use Model;

    protected $table = 'users';
    protected $allowedColumns = [
        'email',
        'password',
        'role'
    ]; // specify which columns are allowed to be inserted or updated

    public function validate($data)
    {
        $this->errors = [];

        //email
        if (empty($data['email'])) {
            $this->errors['email'] = "Email is required";
        } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Email is not valid";
        }
        // password
        if (empty($data['password'])) {
            $this->errors['password'] = "Password is required";
        }
        if (empty($this->errors)) {
            return true;
        }
        return false;
    }

    public function find_by_email($email)
    {
        return $this->first(['email' => $email]);
    }

    public function authenticate($email, $password)
    {
        $user = $this->find_by_email($email);
        if ($user) {
            if (password_verify($password, $user->password)) {
                return $user;
            }
        }
        return false;
    }

    public function hasRole($userId, $role)
    {
        $user = $this->first(['id' => $userId]);
        if ($user) {
            if ($user->role == $role) {
                return true;
            }
        }
        return false;
    }
}
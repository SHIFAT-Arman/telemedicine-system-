<?php

class Login
{
    use Controller;

    public function index()
    {
        //check if user is already logged in
        if(is_logged_in()){
            $user = get_user();
            redirect_by_role($user->role);
        }
        
        $errors = [];
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user = new User();
            $arr['email'] = $_POST['email'];
            $row=$user->first($arr);
            if($row)
            {
                if($row->password === $_POST['password'])
                {
                    init_session();
                    login_user($row);
                    redirect_by_role($row->role);
                    // after redirects it dies here, so no code will work after this
                }
            }
            $user->errors = ["Invalid email or password."];
            $errors = $user->errors;
        }

        $this->view('login', ['errors' => $errors]);
    }
}
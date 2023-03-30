<?php
/**
 * Author: Firoz Ahmad Likhon <likh.deshi@gmail.com>
 * Website: https://github.com/firoz-ahmad-likhon
 *
 * Copyright (c) 2018 Firoz Ahmad Likhon
 * Released under the MIT license
 *       ___            ___  ___    __    ___      ___  ___________  ___      ___
 *      /  /           /  / /  /  _/ /   /  /     /  / / _______  / /   \    /  /
 *     /  /           /  / /  /_ / /    /  /_____/  / / /      / / /     \  /  /
 *    /  /           /  / /   __|      /   _____   / / /      / / /  / \  \/  /
 *   /  /_ _ _ _ _  /  / /  /   \ \   /  /     /  / / /______/ / /  /   \    /
 *  /____________/ /__/ /__/     \_\ /__/     /__/ /__________/ /__/     /__/
 * Likhon the hackman, who claims himself as a hacker but really he isn't.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth
{
    /*
    |--------------------------------------------------------------------------
    | Auth Library
    |--------------------------------------------------------------------------
    |
    | This Library handles authenticating users for the application and
    | redirecting them to your home screen.
    |
    */
    protected $CI;

    public $user = null;
    public $id = null;
    public $username = null;
    public $password = null;
    public $role = 0;  // [ public $role = null ] codeIgniter where_in() omitted for null.
    public $permissions = null;
    public $loginStatus = false;
    public $error = array();

    public function __construct()
    {
        $this->CI =& get_instance();

        $this->init();
        // $this->load->library('session');
    }

    /**
     * Initialization the Auth class
     */
    protected function init()
    {
        if ($this->CI->session->has_userdata("id") && $this->CI->session->loginStatus) {
            $this->id = $this->CI->session->id;
            $this->username = $this->CI->session->username;
            $this->role = $this->CI->session->role;
            $this->loginStatus = true;
        }

        return;
    }

    /**
     * Show The Login Form
     *
     * @param array $data
     * @return mixed
     */
    public function showLoginForm($data = array())
    {
        return $this->CI->load->view("auth/login", $data);
    }

    /**
     * Handle Login
     *
     * @param $request
     * @return array|bool|void
     */
    public function login($request) 
    {
        if ($this->validate($request)) {
            $this->user = $this->credentials($this->username, $this->password);
            if ($this->user) {
                return $this->setUser();
            } else {
                return $this->failedLogin($request);
            }
        }

        return false;
    }

    /**
     * Validate the login form
     *
     * @param $request
     * @return bool
     */
    protected function validate($request)
    {
        $this->CI->form_validation->set_rules('username', 'User Name', 'required');
        $this->CI->form_validation->set_rules('password', 'Password', 'required');

        if ($this->CI->form_validation->run() == TRUE) {
            /*$this->username = $request["username"];
            $this->password = $request["password"];*/
            $this->username = $this->CI->input->post("username", TRUE);
            $this->password = $this->CI->input->post("password", TRUE);
            return true;
        }

        return false;
    }

    /**
     * Check the credentials
     *
     * @param $username
     * @param $password
     * @return mixed
     */
    protected function credentials($username, $password)
    {
        $user = $this->CI->db->get_where("login", array("username" => $username, "status" => 1))->row(0);
        if($user && password_verify($password, $user->password)) {
            return $user;
        }

        return false;
    }

    /**
     * Setting session for authenticated user
     */
    protected function setUser()
    {
        $this->id = $this->user->id;

        $this->CI->session->set_userdata(array(
            "id" => $this->user->id,
            "username" => $this->user->username,
            "role" => $this->userWiserole(),
            "loginStatus" => true
        ));

        return redirect("home");
    }

    /**
     * Get the error message for failed login
     *
     * @param $request
     * @return array
     */
    protected function failedLogin($request)
    {
        $this->error["failed"] = "username or Password Incorrect.";

        return $this->error;
    }

    /**
     * Check login status
     *
     * @return bool
     */
    public function loginStatus()
    {
        return $this->loginStatus;
    }

    /**
     * Determine if the current user is authenticated.
     *
     * @return bool
     */
    public function authenticate()
    {
        if (!$this->loginStatus()) {
            return redirect('login');
        }

        return true;
    }

    /**
     * Determine if the current user is authenticated. Identical of authenticate()
     *
     * @return bool
     */
    public function check($methods = 0)
    {
        if (is_array($methods) && count(is_array($methods))) {
            foreach ($methods as $method) {
                if ($method == (is_null($this->CI->uri->segment(2)) ? "index" : $this->CI->uri->segment(2))) {
                    return $this->authenticate();
                }
            }
        }
        return $this->authenticate();
    }

    /**
     * Determine if the current user is a guest.
     *
     * @return bool
     */
    public function guest()
    {
        return !$this->loginStatus();
    }

    /**
     * Read authenticated user ID
     *
     * @return int
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * Read authenticated user Name
     *
     * @return string
     */
    public function username()
    {
        return $this->username;
    }

    /**
     * Read authenticated user role
     *
     * @return array
     */
    public function role()
    {
        // "<pre>";print_r($this->role);die();
        // return $this->session->userdata['logged_in']['role'];

       return explode(',', $this->CI->session->userdata['logged_in']['role']);

   }

    /**
     * Read authenticated user permissions
     *
     * @return array
     */
    public function permissions()
    {
        return $this->permissions;
    }

    /**
     * Read the current user role ID
     *
     * @param $id
     * @return string
     */
    public function userWiserole()
    {
        return array_map(function ($item) {
            return $item["role_id"];
        }, $this->CI->db->get_where("role_users", array("user_id" => $this->id()))->result_array());
    }

    /**
     * Read the current user role name
     *
     * @return array
     */
    public function userrole()
    {
        return array_map(function ($item) {
            return $item["name"];
        }, $this->CI->db
        ->select("role.*")
        ->from("role")
        ->join("role_users", "role.id = role_users.role_id", "inner")
        ->where(array("role_users.user_id" => $this->id(),"role.status" => 1, "deleted_at" => null))
        ->get()->result_array());
    }

    /**
     * Read current user permissions name
     *
     * @return mixed
     */
    public function userPermissions()
    {
        return array_map(function ($item) {
            return $item["name"];
        }, $this->CI->db
        ->select("permissions.*")
        ->from("permissions")
        ->join("permission_role", "permissions.id = permission_role.permission_id", "inner")
        ->where_in("permission_role.role_id",$this->role())
        ->where(array("permissions.status" => 1, "deleted_at" => null))
        ->group_by("permission_role.permission_id")
        ->get()->result_array()

    );


    }

    /**
     * Determine if the current user is authenticated for specific methods.
     *
     * @param array $methods
     * @return bool
     */
    public function only($methods = array())
    {
        if (is_array($methods) && count(is_array($methods))) {
            foreach ($methods as $method) {
                if ($method == (is_null($this->CI->uri->segment(2)) ? "index" : $this->CI->uri->segment(2))) {
                    return $this->route_access();
                }
            }
        }

        return true;
    }

    /**
     * Determine if the current user is authenticated except specific methods.
     *
     * @param array $methods
     * @return bool
     */
    public function except($methods = array())
    {
        if (is_array($methods) && count(is_array($methods))) {
            foreach ($methods as $method) {
                if ($method == (is_null($this->CI->uri->segment(2)) ? "index" : $this->CI->uri->segment(2))) {
                    return true;
                }
            }
        }

        return $this->route_access();
    }

    /**
     * Determine if the current user is authenticated to view the route/url
     *
     * @return bool|void
     */
    public function route_access()
    {
        // $this->check();

        $routeName = (is_null($this->CI->uri->segment(2)) ? "index" : $this->CI->uri->segment(2)) . "-" . $this->CI->uri->segment(1);


        // "<pre>";print_r(is_null($this->CI->uri->segment(2)));
        // die();

        if ($routeName=="index-admin")
            return true;
        else
        {
            if($this->can($routeName))
            {

                return true;
            }
            // else if($this->can($routeName)=="")
            // {
            //     return true;
            // }
            else
            {
               redirect('error_page');
           }
       }




   }


   public function special_permission($routeName)
   {
    $this->CI->db->select('*');
    $this->CI->db->from('permissions');
    $where = 'name="'.$routeName.'"';
    $this->CI->db->where($where);
    $query = $this->CI->db->get();
    if ($query->num_rows()==0) {
        return true;
    } else {
        return false;
    }
}

    /**
     * Checks if the current user has a role by its name.
     *
     * @param $role
     * @param bool $requireAll
     * @return bool
     */
    public function hasRole($role, $requireAll = false)
    {
        if (is_array($role)) {
            foreach ($role as $role) {
                if ($this->checkRole($role) && !$requireAll)
                    return true;
                elseif (!$this->checkRole($role) && $requireAll) {
                    return false;
                }
            }
        }
        else {
            return $this->checkRole($role);

        }
        // If we've made it this far and $requireAll is FALSE, then NONE of the perms were found
        // If we've made it this far and $requireAll is TRUE, then ALL of the perms were found.
        // Return the value of $requireAll;
        return $requireAll;
    }

    /**
     * Check current user has specific role
     *
     * @param $role
     * @return bool
     */
    public function checkRole($role)
    {
        return in_array($role, $this->userrole());
    }

    /**
     * Check if current user has a permission by its name.
     *
     * @param $permissions
     * @param bool $requireAll
     * @return bool
     */
    public function can($permissions, $requireAll = false)
    { 

      if ($this->special_permission($permissions)) 
      {
         return true;

     }

     if($this->CI->session->userdata['logged_in']['role']==1)
     {
        return true;
     }
     
     if (is_array($permissions)) {
        foreach ($permissions as $permission) {
            if ($this->checkPermission($permission) && !$requireAll)
                return true;
            elseif (!$this->checkPermission($permission) && $requireAll) {
                return false;
            }
        }


    }
    else {


        return $this->checkPermission($permissions);


    }
        // If we've made it this far and $requireAll is FALSE, then NONE of the perms were found
        // If we've made it this far and $requireAll is TRUE, then ALL of the perms were found.
        // Return the value of $requireAll;

    return $requireAll;
}

    /**
     * Check current user has specific permission
     *
     * @param $permission
     * @return bool
     */
    public function checkPermission($permission)
    {

        // "<pre>";print_r($this->userPermissions());die();

        return in_array($permission, $this->userPermissions());
        // die();



    }

    /**
     * Logout
     *
     * @return bool
     */
    public function logout()
    {
        $this->CI->session->unset_userdata(array("id", "username", "loginStatus"));
        $this->CI->session->sess_destroy();

        return true;
    }
}

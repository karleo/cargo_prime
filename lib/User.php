<?php
// *************************************************************************
// *                                                                       *
// * DEPRIXA PRO -  Integrated Web Shipping System                         *
// * Copyright (c) JAOMWEB. All Rights Reserved                            *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * Email: support@jaom.info                                              *
// * Website: http://www.jaom.info                                         *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * This software is furnished under a license and may be used and copied *
// * only  in  accordance  with  the  terms  of such  license and with the *
// * inclusion of the above copyright notice.                              *
// * If you Purchased from Codecanyon, Please read the full License from   *
// * here- http://codecanyon.net/licenses/standard                         *
// *                                                                       *
// *************************************************************************



class User
{

    public $logged_in = null;
    public $uid = 0;
    public $userid = 0;
    public $username;
    public $email;
    public $name;
    public $userlevel;
    public $last;

    private $db;
    private $result;
    public $sWhere;
    public $sql;
    public $errors   = array();


    function __construct()
    {
        $this->db = new Conexion;
        $this->cdp_startSession();
    }


    /**
     * Users::cdp_startSession()
     */
    private function cdp_startSession()
    {
        if (strlen(session_id()) < 1)
            session_start();

        $this->logged_in = $this->cdp_loginCheck();

        if (!$this->logged_in) {
            $this->username = $_SESSION['username'] = "Guest";
            $this->userlevel = 0;
        }
    }

    /**
     * Users::cdp_loginCheck()
     */
    public function cdp_loginCheck()
    {
        if (isset($_SESSION['username']) && $_SESSION['username'] != "Guest") {

            $row = $this->cdp_getUserInfo($_SESSION['username']);
            $this->uid = $row->id;
            $this->username = $row->username;
            $this->locker = $row->locker;
            $this->name_off = $row->name_off;
            $this->email = $row->email;
            $this->name = $row->fname . ' ' . $row->lname;
            $this->userlevel = $row->userlevel;
            $this->last = $row->lastlogin;
            return true;
        } else {
            return false;
        }
    }

    /**
     * Users::cdp_is_Admin()
     */
    public function cdp_is_Admin()
    {
        if ($this->userlevel == 9) {
            return true;
        } else  if ($this->userlevel == 2) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Users::cdp_login()
     */
    public function cdp_login($username, $pass)
    {

        if ($username == "" && $pass == "") {

            $this->errors[] = "Enter a valid username and password.";
        } else {

            $status = $this->cdp_checkStatus($username, $pass);

            if ($status == 0) {

                $this->errors[] = 'The login and / or password do not match the database.';
            } else if ($status == 2) {

                $this->errors[] = 'Your account is not activated.';
            }
        }


        if ($status == 1) {

            $user = $this->cdp_getUserInfo($username);

            $this->uid = $_SESSION['userid'] = $user->id;
            $this->username = $_SESSION['username'] = $user->username;
            $this->email = $_SESSION['email'] = $user->email;
            $this->name_off = $_SESSION['name_off'] = $user->name_off;
            $this->name = $_SESSION['name'] = $user->fname . ' ' . $user->lname;
            $this->userlevel = $_SESSION['userlevel'] = $user->userlevel;
            $this->last = $_SESSION['last'] = $user->lastlogin;

            $this->db->cdp_query('UPDATE cdb_users SET  lastlogin=:lastlogin, lastip=:lastip where username=:user');

            $this->db->bind(':lastlogin', date("Y-m-d H:i:s"));
            $this->db->bind(':lastip', trim($_SERVER['REMOTE_ADDR']));
            $this->db->bind(':user', $username);

            $this->db->cdp_execute();
            return true;
        }
    }


    /**
     * Users::cdp_checkStatus()
     */
    public function cdp_checkStatus($username, $password)
    {

        $username = trim($username);
        $password = trim($password);

        $this->db->cdp_query('SELECT * FROM cdb_users WHERE username=:user OR email=:user');

        $this->db->bind(':user', $username);

        $this->db->cdp_execute();
        $user = $this->db->cdp_registro();
        $numrows = $this->db->cdp_rowCount();

        if ($numrows == 1) {

            if (password_verify($password, $user->password)) {

                if ($user->active == 1) {
                    return 1;
                } else {
                    return 2;
                }
            } else {

                return 0;
            }
        } else {

            return 0;
        }
    }

    /**
     * Users::cdp_logout()
     */
    public function cdp_logout()
    {
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        unset($_SESSION['name']);
        unset($_SESSION['userid']);
        session_destroy();

        $this->logged_in = false;
        $this->username = "Guest";
        $this->userlevel = 0;
    }

    /**
     * Users::cdp_getUserInfo()
     */
    private function cdp_getUserInfo($username)
    {
        $username = trim($username);

        $this->db->cdp_query('SELECT * FROM cdb_users WHERE username=:user OR email=:user');

        $this->db->bind(':user', $username);

        $this->db->cdp_execute();
        return $user = $this->db->cdp_registro();
    }





    /**
     * Users::cdp_getUserData()
     */
    public function cdp_getUserData()
    {

        $this->db->cdp_query("SELECT *,
                       DATE_FORMAT(created, '%a. %d, %M %Y') as cdate,
                        DATE_FORMAT(lastlogin, '%a. %d, %M %Y') as ldate
                       FROM cdb_users WHERE id=:uid");

        $this->db->bind(':uid', $this->uid);

        $this->db->cdp_execute();
        return $user = $this->db->cdp_registro();
    }

    /**
     * Users::cdp_usernameExists()
     */
    public function cdp_usernameExists($username)
    {
        $username = trim($username);
        if (strlen($username) < 4)
            return 1;

        //Username should contain only alphabets, numbers, underscores or hyphens.Should be between 4 to 15 characters long
        $valid_uname = "/^[A-Z-a-z0-9_-]{4,55}$/";
        if (!preg_match($valid_uname, $username))
            return 2;

        $this->db->cdp_query("SELECT username FROM cdb_users where username = :user LIMIT 1");

        $this->db->bind(':user', $username);

        $this->db->cdp_execute();

        return $numrows = $this->db->cdp_rowCount();
    }

    /**
     * User::cdp_emailExists()
     */
    public function cdp_emailExists($email, $id = null)
    {

        $where = '';
        if ($id != null) {

            $where = "and id!='$id'";
        }

        $this->db->cdp_query("SELECT email FROM cdb_users where email = :email $where LIMIT 1");

        $this->db->bind(':email', trim($email));

        $this->db->cdp_execute();


        if ($this->db->cdp_rowCount() == 1) {
            return true;
        } else {

            return false;
        }
    }



    /**
     * User::cdp_isValidEmail()
     */
    public function cdp_isValidEmail($email)
    {
        if (function_exists('filter_var')) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return true;
            } else
                return false;
        } else
            return preg_match('/^[a-zA-Z0-9._+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/', $email);
    }




    /**
     * Users::cdp_getUserLevels()
     * 
     * @return
     */
    public function cdp_getUserLevels($level = false)
    {
        $arr = array(
            9 => 'Super Admin',
            2 => 'Registered Manager'
        );

        $list = '';
        foreach ($arr as $key => $val) {
            if ($key == $level) {
                $list .= "<option selected=\"selected\" value=\"$key\">$val</option>\n";
            } else
                $list .= "<option value=\"$key\">$val</option>\n";
        }
        unset($val);
        return $list;
    }



    // used All Drivers
    public function cdp_userAllDriver()
    {

        // query to select all user records
        $sql = "SELECT * FROM cdb_users WHERE userlevel='3' AND active='1'";

        $this->db->cdp_query($sql);
        $this->db->cdp_execute();
        $row = $this->db->cdp_registros();

        return $row;
    }
}

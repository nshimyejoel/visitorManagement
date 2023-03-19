<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Login_Model extends CI_Model
{
    public function validatelogin($username, $password)
    {
        $query = $this->db->where(['UserName' => $username, 'Password' => $password]);
        $account = $this->db->get('tbladmin')->row();
        if ($account != null) {
            return $account->ID;
        }

        return null;
    }
}

<?php
namespace App\Models;
use CodeIgniter\Model;

class UserHelperModel extends Model
{
    public $page_data = array();
    public $request;
    public $session;

    public function __construct()
    {
        parent::__construct();
        $this->request = \Config\Services::request();
        $this->session = session();
    }

    function verify_user_password($user_input = null, $user_db = null)
    {
        $result = false;
        if ($user_input['password'] == $user_db['password'])
        {
            $result = true;
        }

        return $result;
    }

    function verify_user_email($obj = null)
    {
        $builder = $this->db->table('users');
        if ($obj != null && isset($obj['email']) && $obj['email'] != "")
        {
            $builder->where('users.email', $obj['email']);
        }
        $data_object = $builder->get()->getResultArray();
        return count($data_object);
    }

    function verify_user_phone($obj = null)
    {
        $builder = $this->db->table('users');
        if ($obj != null && isset($obj['phone']) && $obj['phone'] != "")
        {
            $builder->where('users.phone', $obj['phone']);
        }
        $data_object = $builder->get()->getResultArray();
        return count($data_object);
    }

    function verify_user_password1($obj = null, $user_id = null)
    {
        $builder = $this->db->table('users');
        if ($obj != null && isset($user_id) && $user_id != "")
        {
            $builder->where('users.user_id', $user_id);
        }
        if ($obj != null && isset($obj['password']) && $obj['password'] != "")
        {
            $builder->where('users.password', $obj['password']);
        }
        $data_object = $builder->get()->getResultArray();
        return count($data_object);
    }

    function verify_user_status($user_db = null)
    {
        $result = false;
        if ($user_db['status'] == 'active')
        {
            $result = true;
        }
        return $result;
    }
}
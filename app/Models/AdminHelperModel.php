<?php
namespace App\Models;
use CodeIgniter\Model;

class AdminHelperModel extends Model
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

    function verify_admin_email($obj = null)
    {
        $builder = $this->db->table('admin');
        if ($obj != null && isset($obj['email']) && $obj['email'] != "")
        {
            $builder->where('admin.email', $obj['email']);
        }
        $data_object = $builder->get()->getResultArray();
        return count($data_object);
    }

    function verify_admin_password1($obj = null, $admin_id = null)
    {
        $builder = $this->db->table('admin');
        if ($obj != null && isset($admin_id) && $admin_id != "")
        {
            $builder->where('admin.admin_id', $admin_id);
        }
        if ($obj != null && isset($obj['password']) && $obj['password'] != "")
        {
            $builder->where('admin.password', $obj['password']);
        }
        $data_object = $builder->get()->getResultArray();
        return count($data_object);
    }

    function verify_admin_password($user_input = null, $user_db = null)
    {
        $result = false;
        if ($user_input['password'] == $user_db['password'])
        {
            $result = true;
        }

        return $result;
    }

}
<?php
namespace App\Models;
use CodeIgniter\Model;

class VisitModel extends Model
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

    function add_visit_entry()
    {

    }

    function get_visits_by_condition($obj = null)
    {
        return 1;
    }

    // function get_visits_by_condition($obj = null)
    // {
    //     $builder = $this->db->table('visit');
    //     if ($obj != null && isset($obj['visit_id']))
    //     {
    //         $builder->where('visit.visit_id', $obj['visit_id']);
    //     }
    //     if ($obj != null && isset($obj['name']))
    //     {
    //         $builder->like('visit.name', $obj['name'], 'BOTH');
    //     }
    //     if ($obj != null && isset($obj['phone']))
    //     {
    //         $builder->like('visit.phone', $obj['phone'], 'BOTH');
    //     }
    //     if ($obj != null && isset($obj['subject']) && $obj['subject'] > -1)
    //     {
    //         $builder->like('visit.subject', $obj['subject']);
    //     }
    //     if ($obj != null && isset($obj['created_on']) && strlen($obj['created_on']) > 0)
    //     {
    //         $builder->where('DATE_FORMAT(user.created_on,"%Y-%m-%d")', $obj['created_on']);
    //     }
    //     if ($obj != null && isset($obj['status']))
    //     {
    //         $builder->where('visit.status', $obj['status']);
    //     }
    //     if ($obj != null && isset($obj['count']) && ($obj['count'] == 1))
    //     {
    //         //$data_object = $builder->get()->getNumRows();
    //         $builder->select('count(1) as count');
    //         $data_object = $builder->get()->getRowArray()['count'];
    //     }
    //     else
    //     {
    //         if ($obj != null && isset($obj['limit']) && isset($obj['offset']))
    //         {
    //             $builder->limit($obj['limit'], $obj['offset']);
    //         }
    //         $data_object = $builder->get()->getResultArray();
    //     }
    //     return $data_object;
    // }

}
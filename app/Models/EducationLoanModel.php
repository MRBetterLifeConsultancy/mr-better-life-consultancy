<?php
namespace App\Models;
use CodeIgniter\Model;

class EducationLoanModel extends Model
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

    function viewEducationLoanUser($params, $controller_data)
    {
        $this->page_data = array_merge($this->page_data, $controller_data);
        if (isset($params[2]) && $params[2] != "")
        {
            $helperModel = new HelperModel();
            $params_data = $helperModel->build_query_params_data($params[2]);
            $this->page_data = array_merge($this->page_data, $params_data);
        }

        $agent = $this->request->getUserAgent();
        if (empty($this->page_data['view_type']))
        {
            //0 - for desktop view, 1 - for mobile view
            if ($agent->isMobile())
            {
                $this->page_data['view_type'] = 1;
            }
            else
            {
                $this->page_data['view_type'] = 0;
            }
        }

        $banking_partners = array(
            array('name' => 'HDFC Credila', 'logo' => 'hdfcc.png'),
            array('name' => 'Avanse', 'logo' => 'avanse.png'),
            array('name' => 'Auxilo', 'logo' => 'auxilo.png'),
            array('name' => 'SBI', 'logo' => 'sbi.png'),
            array('name' => 'Bank of Baroda', 'logo' => 'bob.png'),
            array('name' => 'Bano of India', 'logo' => 'boi.png'),
            array('name' => 'Union Bank', 'logo' => 'ubi.png'),
            array('name' => 'Bank of Maharashtra', 'logo' => 'bom.png'),
            array('name' => 'Punjab National Bank', 'logo' => 'pnb.png'),
            array('name' => 'Saraswat Bank', 'logo' => 'sb.png'),
            array('name' => 'ICICI Bank', 'logo' => 'icici.png'),
            array('name' => 'IDFC First Bank', 'logo' => 'idfcfb.png'),
            array('name' => 'AXIS Bank', 'logo' => 'axb.png'),
            array('name' => 'Yes Bank', 'logo' => 'yesb.png'),
            array('name' => 'Incred', 'logo' => 'incred.png'),
            array('name' => 'Tata capital', 'logo' => 'tata.png'),
            array('name' => 'MPower', 'logo' => 'mpower.png'),
            array('name' => 'Prodigy', 'logo' => 'prodigy.png')

        );

        $this->page_data['banking_partners'] = $banking_partners;
        $this->page_data['page_name'] = 'view_loans';
        $this->page_data['page_path'] = $this->page_data['view_files_path'];
        $this->page_data['page_title'] = 'Education Loan';
        $this->page_data['page_class_name'] = 'about-page';
        $this->page_data['menu_name'] = $this->page_data['menu_name'];
        echo view($this->page_data['controller_file_path'] . DIRECTORY_SEPARATOR . 'index', $this->page_data);
    }

    // /*** AJAX REQUESTS HANDLER ***/

    // function processServicesAjax($params, $controller_data)
    // {
    //     $this->page_data = array_merge($this->page_data, $controller_data);
    //     if (isset($params[1]) && $params[1] == "ajax_request" && isset($params[2]) && $params[2] == "service")
    //     {
    //         if (isset($params[3]) && $params[3] == "services_list")
    //         {
    //             try
    //             {
    //                 $services_list = $this->get_services_by_condition();
    //                 $data_object['services'] = $services_list;
    //                 $data_object['success'] = 1;
    //             }
    //             catch (\Exception $ex)
    //             {
    //                 $data_object['success'] = 0;
    //                 $data_object['message'] = 'Could not process your request. Please try again';
    //                 $data_object['error'] = $ex->getMessage();
    //             }
    //             finally
    //             {
    //                 echo json_encode($data_object);
    //                 exit;
    //             }
    //         }
    //         else if (isset($params[3]) && $params[3] == "info")
    //         {
    //             $submittedData = $this->request->getPost("submittedData");
    //             $dataSearch['service_id'] = $submittedData['service_id'];
    //             try
    //             {
    //                 $services_list = $this->get_services_by_condition($dataSearch);
    //                 $data_object['service'] = $services_list;
    //                 $data_object['success'] = 1;
    //             }
    //             catch (\Exception $ex)
    //             {
    //                 $data_object['success'] = 0;
    //                 $data_object['message'] = 'Could not process your request. Please try again';
    //                 $data_object['error'] = $ex->getMessage();
    //             }
    //             finally
    //             {
    //                 echo json_encode($data_object);
    //                 exit;
    //             }
    //         }
    //     }
    // }

    // /*** DATA HANDLER ***/

    function get_services_by_condition($obj = null)
    {
        $builder = $this->db->table('service');
        if ($obj != null && isset($obj['service_id']) && $obj['service_id'] > 0)
        {
            $builder->where('service.service_id', $obj['service_id']);
        }
        if ($obj != null && isset($obj['service_name']) && $obj['service_name'] != "")
        {
            $builder->like('service.service_name', $obj['service_name'], 'BOTH');
        }
        if ($obj != null && isset($obj['status']) && $obj['status'] != "")
        {
            $builder->where('service.status', $obj['status']);
        }
        if ($obj != null && isset($obj['count']) && ($obj['count'] == 1))
        {
            //$data_object = $builder->get()->getNumRows();
            $builder->select('count(1) as count');
            $data_object = $builder->get()->getRowArray()['count'];
        }
        else
        {
            if ($obj != null && isset($obj['limit']) && isset($obj['offset']))
            {
                $builder->limit($obj['limit'], $obj['offset']);
            }
            $data_object = $builder->get()->getResultArray();
        }
        return $data_object;
    }

    // /*** DATABASE HANDLER ***/

    // function create_service($data)
    // {
    //     $data_object = NULL;
    //     $data_object['transaction_status'] = "0";
    //     try
    //     {
    //         if (isset($data))
    //         {
    //             $builder = $this->db->table('service');
    //             if (!$builder->insert($data))
    //             {
    //                 $data_object['transaction_status'] = "0";
    //                 $data_object['error'] = $this->db->error();
    //             }

    //             if ($this->db->transStatus() === TRUE)
    //             {
    //                 $data_object['transaction_status'] = "1";
    //                 $data_object['insert_id'] = $this->db->insertID();
    //             }
    //         }
    //     }
    //     catch (\Exception $ex)
    //     {
    //         $data_object['transaction_status'] = "0";
    //         $data_object['error'] = $ex->getMessage();
    //     }

    //     return $data_object;
    // }

    // function update_service($data, $id, $user_id = null)
    // {
    //     $data_object = NULL;
    //     $data_object['transaction_status'] = "0";
    //     try
    //     {
    //         if (isset($data))
    //         {
    //             $builder = $this->db->table('service');
    //             $builder->where('service.service_id', $id);
    //             if (isset($user_id) && $user_id > 0)
    //             {
    //                 $builder->where('user_id', $user_id);
    //             }
    //             if (!$builder->update($data))
    //             {
    //                 $data_object['transaction_status'] = "0";
    //                 $data_object['error'] = $this->db->error();
    //             }

    //             if ($this->db->transStatus() === TRUE)
    //             {
    //                 $data_object['transaction_status'] = "1";
    //             }
    //         }
    //     }
    //     catch (\Exception $ex)
    //     {
    //         $data_object['transaction_status'] = "0";
    //         $data_object['error'] = $ex->getMessage();
    //     }

    //     return $data_object;
    // }

    // function delete_service($id)
    // {

    //     $data_object = NULL;
    //     $data_object['transaction_status'] = "0";
    //     try
    //     {
    //         if (isset($id))
    //         {
    //             $builder = $this->db->table('service');
    //             $builder->where('service.service_id', $id);
    //             if (!$builder->delete())
    //             {
    //                 $data_object['transaction_status'] = "0";
    //                 $data_object['error'] = $this->db->error();
    //             }

    //             if ($this->db->transStatus() === TRUE)
    //             {
    //                 $data_object['transaction_status'] = "1";
    //             }
    //         }
    //     }
    //     catch (\Exception $ex)
    //     {
    //         $data_object['transaction_status'] = "0";
    //         $data_object['error'] = $ex->getMessage();
    //     }

    //     return $data_object;
    // }
}
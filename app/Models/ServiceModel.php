<?php
namespace App\Models;
use CodeIgniter\Model;

class ServiceModel extends Model
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

    /*** REQUEST HANDLER ***/

    // function createService($params, $controller_data)
    // {
    //     $this->page_data = array_merge($this->page_data, $controller_data);
    //     if (isset($params[1]) && $params[1] == "create_service" && isset($params[2]) && $params[2] == "create")
    //     {
    //         $data_to_insert['service_name'] = $this->request->getPost('service_name');
    //         $data_to_insert['is_country'] = $this->request->getPost('is_country');
    //         $data_to_insert['is_continent'] = $this->request->getPost('is_continent');
    //         $now = date('Y-m-d H:i:s');
    //         $data_to_insert['created_on'] = $now;

    //         $message = "";
    //         try
    //         {
    //             $this->db->transBegin();
    //             $transaction_status = $this->create_service($data_to_insert);
    //             if ($transaction_status['transaction_status'] == 0)
    //             {
    //                 $this->db->transRollback();
    //                 $data_object['success'] = 0;
    //                 $message = 'Could not submit request, Please try again later.';
    //                 $data_object['message'] = $message;
    //             }
    //             else
    //             {
    //                 $this->db->transCommit();
    //                 $data_object['success'] = 1;
    //                 $message .= 'Request sent successfully';
    //                 $data_object['message'] = $message;
    //                 $data_object['redirect_url'] = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/create_service';
    //                 $this->session->setFlashData('type', 'success');
    //                 $this->session->setFlashData('message', $message);
    //             }
    //         }
    //         catch (\Exception $ex)
    //         {
    //             $this->db->transRollback();
    //             $data_object['success'] = 0;
    //             $message = 'Could not submit request, Please try again later.';
    //             $data_object['message'] = $message;
    //             $data_object['error'] = $ex->getMessage();
    //         }
    //         finally
    //         {
    //             echo json_encode($data_object);
    //             exit;
    //         }
    //     }
    //     else
    //     {
    //         if (isset($params[2]) && $params[2] != "")
    //         {
    //             $helperModel = new HelperModel();
    //             $params_data = $helperModel->build_query_params_data($params[2]);
    //             $this->page_data = array_merge($this->page_data, $params_data);
    //         }

    //         $this->page_data['page_name'] = 'contact';
    //         $this->page_data['page_path'] = $this->page_data['view_files_path'];
    //         $this->page_data['page_title'] = 'Contact Us';
    //         $this->page_data['menu_name'] = $this->page_data['menu_name'];
    //         echo view($this->page_data['controller_file_path'] . DIRECTORY_SEPARATOR . 'index', $this->page_data);
    //     }
    // }

    // function viewEditServices($params, $controller_data)
    // {
    //     $this->page_data = array_merge($this->page_data, $controller_data);
    //     if (isset($params[1]) && $params[1] == "view_edit_services" && isset($params[2]) && $params[2] == "edit")
    //     {
    //         $submittedData = $this->request->getPost("submittedData");
    //         $service_id = $submittedData['service_id'];
    //         $data_to_update['service_name'] = $submittedData['service_name'];
    //         $data_to_update['is_country'] = $submittedData['is_country'];
    //         $data_to_update['is_continent'] = $submittedData['is_continent'];
    //         $now = date('Y-m-d H:i:s');
    //         $data_to_update['last_updated_on'] = $now;
    //         try
    //         {
    //             $this->db->transBegin();
    //             $transaction_status = $this->update_service($data_to_update, $service_id);
    //             if ($transaction_status['transaction_status'] == 0)
    //             {
    //                 $this->db->transRollback();
    //                 $data_object['success'] = 0;
    //                 $message = 'Could not update service, Please try again';
    //                 $data_object['message'] = $message;
    //             }
    //             else
    //             {
    //                 $this->db->transCommit();
    //                 $data_object['success'] = 1;
    //                 $message = 'Service updated successfully';
    //                 $data_object['message'] = $message;
    //                 $data_object['redirect_url'] = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/view_edit_services';
    //                 $this->session->setFlashData('type', 'success');
    //                 $this->session->setFlashData('message', $message);
    //             }
    //         }
    //         catch (\Exception $ex)
    //         {
    //             $this->db->transRollback();
    //             $data_object['success'] = 0;
    //             $message = 'Could not update service, Please try again';
    //             $data_object['message'] = $message;
    //             $data_object['error'] = $ex->getMessage();
    //         }
    //         finally
    //         {
    //             echo json_encode($data_object);
    //             exit;
    //         }
    //     }
    //     else if (isset($params[1]) && $params[1] == "view_edit_services" && isset($params[2]) && $params[2] == "search")
    //     {
    //         $submittedData = $this->request->getPost("submittedData");
    //         $service_name = $submittedData['service_name'];
    //         $offset = $submittedData['offset'];
    //         $data_object['success'] = 0;
    //         try
    //         {
    //             $redirect_url = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/view_edit_services/offset=' . $offset
    //                     . "&name=" . $service_name . "&phone=" . $phone. "&subject=" . $subject;
    //             $data_object['success'] = 1;
    //             $data_object['redirect_url'] = $redirect_url;
    //         }
    //         catch (\Exception $ex)
    //         {
    //             $data_object['success'] = 0;
    //             $message = 'Could not search, Please try again';
    //             $data_object['message'] = $message;
    //             $data_object['error'] = $ex->getMessage();
    //         }
    //         finally
    //         {
    //             echo json_encode($data_object);
    //             exit;
    //         }
    //     }
    //     else
    //     {
    //         if (isset($params[2]) && $params[2] != "")
    //         {
    //             $helperModel = new HelperModel();
    //             $params_data = $helperModel->build_query_params_data($params[2]);
    //             $this->page_data = array_merge($this->page_data, $params_data);
    //         }
    //         if (empty($this->page_data['service_name']))
    //         {
    //             $this->page_data['service_name'] = "";
    //         }
    //         if (empty($this->page_data['phone']))
    //         {
    //             $this->page_data['phone'] = "";
    //         }
    //         if (empty($this->page_data['limit']))
    //         {
    //             $this->page_data['limit'] = 100;
    //         }
    //         if (!isset($this->page_data['subject']))
    //         {
    //             $this->page_data['subject'] = -1;
    //         }
    //         if (empty($this->page_data['offset']))
    //         {
    //             $this->page_data['offset'] = 0;
    //         }
    //         $search_filters = array();
    //         $search_filters['status'] = 'active';
    //         $search_filters['service_name'] = $this->page_data['service_name'];
    //         $search_filters['phone'] = $this->page_data['phone'];
    //         $search_filters['subject'] = $this->page_data['subject'];
    //         $serviceModel = new ServiceModel();
    //         $search_filters['count'] = 1;
    //         $this->page_data['services_count'] = $this->get_services_by_condition($search_filters);
    //         if ($this->page_data["services_count"] > 0 && $this->page_data["services_count"] >= $this->page_data['offset'])
    //         {
    //             // no changes
    //         }
    //         else
    //         {
    //             $this->page_data['offset'] = 0;
    //         }
    //         if (isset($this->page_data['limit']))
    //         {
    //             $search_filters['limit'] = $this->page_data['limit'];
    //         }
    //         if (isset($this->page_data['offset']))
    //         {
    //             $search_filters['offset'] = $this->page_data['offset'];
    //         }
    //         $search_filters['count'] = 0;
    //         $services_list = $serviceModel->get_services_by_condition($search_filters);
    //         $this->page_data['services_list'] = $services_list;
    //         $this->page_data['page_name'] = 'view_edit_services';
    //         $this->page_data['page_path'] = $this->page_data['view_files_path'];
    //         $this->page_data['page_title'] = 'Welcome';
    //         $this->page_data['menu_name'] = $this->page_data['menu_name'];
    //         echo view($this->page_data['controller_file_path'] . DIRECTORY_SEPARATOR . 'index', $this->page_data);
    //     }
    // }

    // function deletedServices($params, $controller_data)
    // {
    //     $this->page_data = array_merge($this->page_data, $controller_data);
    //     if (isset($params[1]) && $params[1] == "deleted_services" && isset($params[2]) && $params[2] == "restore")
    //     {
    //         $submittedData = $this->request->getPost("submittedData");
    //         $service_id = $submittedData['service_id'];
    //         $data_to_update['status'] = "active";
    //         $now = date('Y-m-d H:i:s');
    //         $data_to_update['last_updated_on'] = $now;
    //         try
    //         {
    //             $this->db->transBegin();
    //             $transaction_status = $this->update_service($data_to_update, $service_id);
    //             if ($transaction_status['transaction_status'] == 0)
    //             {
    //                 $this->db->transRollback();
    //                 $data_object['success'] = 0;
    //                 $message = 'Could not restore service, Please try again';
    //                 $data_object['message'] = $message;
    //             }
    //             else
    //             {
    //                 $this->db->transCommit();
    //                 $data_object['success'] = 1;
    //                 $message = 'Service restored successfully';
    //                 $data_object['message'] = $message;
    //                 $data_object['redirect_url'] = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/view_edit_services';
    //                 $this->session->setFlashData('type', 'success');
    //                 $this->session->setFlashData('message', $message);
    //             }
    //         }
    //         catch (\Exception $ex)
    //         {
    //             $this->db->transRollback();
    //             $data_object['success'] = 0;
    //             $message = 'Could not restore service, Please try again';
    //             $data_object['message'] = $message;
    //             $data_object['error'] = $ex->getMessage();
    //         }
    //         finally
    //         {
    //             echo json_encode($data_object);
    //             exit;
    //         }
    //     }
    //     else if (isset($params[1]) && $params[1] == "deleted_services" && isset($params[2]) && $params[2] == "search")
    //     {
    //         $submittedData = $this->request->getPost("submittedData");
    //         $service_name = $submittedData['service_name'];
    //         $phone = $submittedData['phone'];
    //         $offset = $submittedData['offset'];
    //         $data_object['success'] = 0;
    //         try
    //         {
    //             $redirect_url = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/view_edit_services/offset=' . $offset
    //                     . "&name=" . $service_name . "&phone=" . $phone;
    //             $data_object['success'] = 1;
    //             $data_object['redirect_url'] = $redirect_url;
    //         }
    //         catch (\Exception $ex)
    //         {
    //             $data_object['success'] = 0;
    //             $message = 'Could not search, Please try again';
    //             $data_object['message'] = $message;
    //             $data_object['error'] = $ex->getMessage();
    //         }
    //         finally
    //         {
    //             echo json_encode($data_object);
    //             exit;
    //         }
    //     }
    //     else
    //     {
    //         if (isset($params[2]) && $params[2] != "")
    //         {
    //             $helperModel = new HelperModel();
    //             $params_data = $helperModel->build_query_params_data($params[2]);
    //             $this->page_data = array_merge($this->page_data, $params_data);
    //         }
    //         if (empty($this->page_data['service_name']))
    //         {
    //             $this->page_data['service_name'] = "";
    //         }
    //         if (empty($this->page_data['phone']))
    //         {
    //             $this->page_data['phone'] = "";
    //         }
    //         if (empty($this->page_data['subject']))
    //         {
    //             $this->page_data['subject'] = -1;
    //         }
    //         if (empty($this->page_data['limit']))
    //         {
    //             $this->page_data['limit'] = 100;
    //         }
    //         if (empty($this->page_data['offset']))
    //         {
    //             $this->page_data['offset'] = 0;
    //         }
    //         $search_filters = array();
    //         $search_filters['status'] = 'deleted';
    //         $search_filters['service_name'] = $this->page_data['service_name'];
    //         $search_filters['phone'] = $this->page_data['phone'];
    //         $search_filters['subject'] = $this->page_data['subject'];
    //         $serviceModel = new ServiceModel();
    //         $search_filters['count'] = 1;
    //         $this->page_data['services_count'] = $this->get_services_by_condition($search_filters);
    //         if ($this->page_data["services_count"] > 0 && $this->page_data["services_count"] >= $this->page_data['offset'])
    //         {
    //             // no changes
    //         }
    //         else
    //         {
    //             $this->page_data['offset'] = 0;
    //         }
    //         if (isset($this->page_data['limit']))
    //         {
    //             $search_filters['limit'] = $this->page_data['limit'];
    //         }
    //         if (isset($this->page_data['offset']))
    //         {
    //             $search_filters['offset'] = $this->page_data['offset'];
    //         }
    //         $search_filters['count'] = 0;
    //         $services_list = $serviceModel->get_services_by_condition($search_filters);
    //         $this->page_data['services'] = $services_list;
    //         $this->page_data['page_name'] = 'deleted_services';
    //         $this->page_data['page_path'] = $this->page_data['view_files_path'];
    //         $this->page_data['page_title'] = 'Welcome';
    //         $this->page_data['menu_name'] = $this->page_data['menu_name'];
    //         echo view($this->page_data['controller_file_path'] . DIRECTORY_SEPARATOR . 'index', $this->page_data);
    //     }
    // }

    function viewServiceUser($params, $controller_data)
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

        if(!isset($this->page_data['sid']))
        {
            $this->page_data['sid'] = -1;
        }
        
        $search_filters = array();
        $search_filters['count'] = 1;
        $search_filters['service_id'] = $this->page_data['sid'];
        $this->page_data['services_count'] = $this->get_services_by_condition($search_filters);

        $search_filters['count'] = 0;
        $services = $this->get_services_by_condition($search_filters);

        if($this->page_data['sid'] == -1)
        {
            $this->page_data['services'] = $services; 
            $this->page_data['page_name'] = 'view_all_services';
            $this->page_data['page_path'] = $this->page_data['view_files_path'];
            $this->page_data['page_title'] = 'Services';
        }
        else
        {
            if(count($services) == 1 && $services[0]['brief_document'] != null)
            {
                $this->page_data['service_data'] = $services[0]; 

                $universityModel = new UniversityModel();
                $this->page_data['universities'] = $universityModel->get_universities_by_condition($search_filters);
                $this->page_data['page_name'] = 'view_service';
                $this->page_data['page_path'] = $this->page_data['view_files_path'];
                $this->page_data['page_title'] = 'Services';
            }
            else
            {
                $this->page_data['page_name'] = 'error-404';
                $this->page_data['page_path'] = 'errors';
                $this->page_data['page_title'] = 'View Service';
            }
        }
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
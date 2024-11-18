<?php
namespace App\Models;
use CodeIgniter\Model;

class UniversityModel extends Model
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

    // Didnt implement the code properly
    // function createUniversity($params, $controller_data)
    // {
    //     $this->page_data = array_merge($this->page_data, $controller_data);
    //     if (isset($params[1]) && $params[1] == "create_university" && isset($params[2]) && $params[2] == "create")
    //     {
    //         $data_to_insert['university_name'] = $this->request->getPost('university_name');
    //         $data_to_insert['subject'] = $this->request->getPost('subject');
    //         $data_to_insert['phone'] = $this->request->getPost('phone');
    //         $data_to_insert['email'] = $this->request->getPost('email');
    //         $data_to_insert['description'] = $this->request->getPost('description');
    //         $now = date('Y-m-d H:i:s');
    //         $data_to_insert['created_on'] = $now;

    //         $message = "";
    //         try
    //         {
    //             $this->db->transBegin();
    //             $transaction_status = $this->create_university($data_to_insert);
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
    //                 $data_object['redirect_url'] = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/create_university';
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

    function viewEdituniversities($params, $controller_data)
    {
        $this->page_data = array_merge($this->page_data, $controller_data);
        if (isset($params[1]) && $params[1] == "view_edit_universities" && isset($params[2]) && $params[2] == "edit")
        {
            $submittedData = $this->request->getPost("submittedData");
            $university_id = $submittedData['university_id'];
            $data_to_update['university_name'] = $submittedData['university_name'];
            $data_to_update['phone'] = $submittedData['phone'];
            $data_to_update['email'] = $submittedData['email'];
            $data_to_update['subject'] = $submittedData['subject'];
            $data_to_update['description'] = $submittedData['description'];
            $now = date('Y-m-d H:i:s');
            $data_to_update['last_updated_on'] = $now;
            try
            {
                $this->db->transBegin();
                $transaction_status = $this->update_university($data_to_update, $university_id);
                if ($transaction_status['transaction_status'] == 0)
                {
                    $this->db->transRollback();
                    $data_object['success'] = 0;
                    $message = 'Could not update university, Please try again';
                    $data_object['message'] = $message;
                }
                else
                {
                    $this->db->transCommit();
                    $data_object['success'] = 1;
                    $message = 'University updated successfully';
                    $data_object['message'] = $message;
                    $data_object['redirect_url'] = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/view_edit_universities';
                    $this->session->setFlashData('type', 'success');
                    $this->session->setFlashData('message', $message);
                }
            }
            catch (\Exception $ex)
            {
                $this->db->transRollback();
                $data_object['success'] = 0;
                $message = 'Could not update university, Please try again';
                $data_object['message'] = $message;
                $data_object['error'] = $ex->getMessage();
            }
            finally
            {
                echo json_encode($data_object);
                exit;
            }
        }
        else if (isset($params[1]) && $params[1] == "view_edit_universities" && isset($params[2]) && $params[2] == "search")
        {
            $submittedData = $this->request->getPost("submittedData");
            $region_id = $submittedData['region'];
            $name = $submittedData['name'];
            $offset = $submittedData['offset'];
            $data_object['success'] = 0;
            try
            {
                $redirect_url = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/view_edit_universities/offset=' . $offset
                        . "&region_id=" . $region_id . "&name=" . $name;
                $data_object['success'] = 1;
                $data_object['redirect_url'] = $redirect_url;
            }
            catch (\Exception $ex)
            {
                $data_object['success'] = 0;
                $message = 'Could not search, Please try again';
                $data_object['message'] = $message;
                $data_object['error'] = $ex->getMessage();
            }
            finally
            {
                echo json_encode($data_object);
                exit;
            }
        }
        else
        {
            if (isset($params[2]) && $params[2] != "")
            {
                $helperModel = new HelperModel();
                $params_data = $helperModel->build_query_params_data($params[2]);
                $this->page_data = array_merge($this->page_data, $params_data);
            }
            if (empty($this->page_data['region_id']))
            {
                $this->page_data['region_id'] = -1;
            }
            if (empty($this->page_data['name']))
            {
                $this->page_data['name'] = "";
            }
            if (empty($this->page_data['limit']))
            {
                $this->page_data['limit'] = 100;
            }
            if (empty($this->page_data['offset']))
            {
                $this->page_data['offset'] = 0;
            }
            $search_filters = array();
            // $search_filters['status'] = 'active';
            $search_filters['region_id'] = $this->page_data['region_id'];
            $search_filters['name'] = $this->page_data['name'];
            $universityModel = new UniversityModel();
            $search_filters['count'] = 1;
            $this->page_data['universities_count'] = $this->get_universities_by_condition($search_filters);
            if ($this->page_data["universities_count"] > 0 && $this->page_data["universities_count"] >= $this->page_data['offset'])
            {
                // no changes
            }
            else
            {
                $this->page_data['offset'] = 0;
            }
            if (isset($this->page_data['limit']))
            {
                $search_filters['limit'] = $this->page_data['limit'];
            }
            if (isset($this->page_data['offset']))
            {
                $search_filters['offset'] = $this->page_data['offset'];
            }
            $search_filters['count'] = 0;
            $universities_list = $universityModel->get_universities_by_condition($search_filters);
            $this->page_data['universities'] = $universities_list;

            $regionModel = new RegionModel();
            $regions = $regionModel->get_regions_by_condition();

            $this->page_data['regions'] = $regions;
            $this->page_data['page_name'] = 'view_edit_universities';
            $this->page_data['page_path'] = $this->page_data['view_files_path'];
            $this->page_data['page_title'] = 'Welcome';
            $this->page_data['menu_name'] = $this->page_data['menu_name'];
            echo view($this->page_data['controller_file_path'] . DIRECTORY_SEPARATOR . 'index', $this->page_data);
        }
    }

    function viewUniversitiesUser($params, $controller_data)
    {
        $this->page_data = array_merge($this->page_data, $controller_data);
        if (isset($params[1]) && $params[1] == "universities" && isset($params[2]) && $params[2] == "search")
        {
            $submittedData = $this->request->getPost("submittedData");
            $r_id = $submittedData['region'];
            $u_name = $submittedData['university'];
            $offset = $submittedData['offset'];
            $data_object['success'] = 0;
            try
            {
                $redirect_url = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/universities/offset=' . $offset . "&r_id=" . $r_id. "&u_name=" . $u_name;
                $data_object['success'] = 1;
                $data_object['redirect_url'] = $redirect_url;
            }
            catch (\Exception $ex)
            {
                $data_object['success'] = 0;
                $message = 'Could not search, Please try again';
                $data_object['message'] = $message;
                $data_object['error'] = $ex->getMessage();
            }
            finally
            {
                echo json_encode($data_object);
                exit;
            }
        }
        else
        {
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
            if (empty($this->page_data['r_id']))
            {
                $this->page_data['r_id'] = 1;
            }
            if (empty($this->page_data['u_name']))
            {
                $this->page_data['u_name'] = "";
            }
            if (empty($this->page_data['name']))
            {
                $this->page_data['name'] = "";
            }
            if (empty($this->page_data['limit']))
            {
                $this->page_data['limit'] = UNIVERSITY_PAGE_LIMIT;
            }
            if (empty($this->page_data['offset']))
            {
                $this->page_data['offset'] = 0;
            }
            $search_filters = array();
            // $search_filters['status'] = 'active';
            $search_filters['university_name'] = $this->page_data['u_name'];
            $search_filters['region_id'] = $this->page_data['r_id'];
            $search_filters['name'] = $this->page_data['name'];
            $universityModel = new UniversityModel();
            $search_filters['count'] = 1;
            $this->page_data['universities_count'] = $this->get_universities_by_condition($search_filters);
            // $search_filters['count'] = 0;
            // $this->page_data['all_universities'] = $this->get_universities_by_condition($search_filters);
            if ($this->page_data["universities_count"] > 0 && $this->page_data["universities_count"] >= $this->page_data['offset'])
            {
                // no changes
            }
            else
            {
                $this->page_data['offset'] = 0;
            }
            if (isset($this->page_data['limit']))
            {
                $search_filters['limit'] = $this->page_data['limit'];
            }
            if (isset($this->page_data['offset']))
            {
                $search_filters['offset'] = $this->page_data['offset'];
            }
            $search_filters['count'] = 0;
            $universities_list = $universityModel->get_universities_by_condition($search_filters);
            $this->page_data['universities'] = $universities_list;
            // $this->page_data['all_universities'] = $universities_list;

            $regionModel = new RegionModel();
            $regions = $regionModel->get_regions_by_condition();

            $search_filters = array();
            $search_filters['region_id'] = $this->page_data['r_id'];
            $selected_region = $regionModel->get_regions_by_condition($search_filters)[0];

            $this->page_data['regions'] = $regions;
            $this->page_data['selected_region'] = $selected_region;
            $this->page_data['page_class_name'] = 'about-page';
            $this->page_data['page_name'] = 'view_universities';
            $this->page_data['page_path'] = $this->page_data['view_files_path'];
            $this->page_data['page_title'] = 'Welcome';
            $this->page_data['menu_name'] = $this->page_data['menu_name'];
            echo view($this->page_data['controller_file_path'] . DIRECTORY_SEPARATOR . 'index', $this->page_data);
        }
    }

    function viewUniversityUser($params, $controller_data)
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
        if (empty($this->page_data['u_id']))
        {
            $this->page_data['u_id'] = -1;
        }
        $search_filters = array();
        $search_filters['university_id'] = $this->page_data['u_id'];
        $universityModel = new UniversityModel();
        $university = $universityModel->get_universities_by_condition($search_filters);
        $this->page_data['university'] = $university;
        $this->page_data['page_class_name'] = 'about-page';
        $this->page_data['page_name'] = 'view_university';
        $this->page_data['page_path'] = $this->page_data['view_files_path'];
        $this->page_data['page_title'] = 'Welcome';
        $this->page_data['menu_name'] = $this->page_data['menu_name'];
        echo view($this->page_data['controller_file_path'] . DIRECTORY_SEPARATOR . 'index', $this->page_data);
    }

    function deletedUniversities($params, $controller_data)
    {
        $this->page_data = array_merge($this->page_data, $controller_data);
        if (isset($params[1]) && $params[1] == "deleted_universities" && isset($params[2]) && $params[2] == "restore")
        {
            $submittedData = $this->request->getPost("submittedData");
            $university_id = $submittedData['university_id'];
            $data_to_update['status'] = "active";
            $now = date('Y-m-d H:i:s');
            $data_to_update['last_updated_on'] = $now;
            try
            {
                $this->db->transBegin();
                $transaction_status = $this->update_university($data_to_update, $university_id);
                if ($transaction_status['transaction_status'] == 0)
                {
                    $this->db->transRollback();
                    $data_object['success'] = 0;
                    $message = 'Could not restore university, Please try again';
                    $data_object['message'] = $message;
                }
                else
                {
                    $this->db->transCommit();
                    $data_object['success'] = 1;
                    $message = 'University restored successfully';
                    $data_object['message'] = $message;
                    $data_object['redirect_url'] = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/view_edit_universities';
                    $this->session->setFlashData('type', 'success');
                    $this->session->setFlashData('message', $message);
                }
            }
            catch (\Exception $ex)
            {
                $this->db->transRollback();
                $data_object['success'] = 0;
                $message = 'Could not restore university, Please try again';
                $data_object['message'] = $message;
                $data_object['error'] = $ex->getMessage();
            }
            finally
            {
                echo json_encode($data_object);
                exit;
            }
        }
        else if (isset($params[1]) && $params[1] == "deleted_universities" && isset($params[2]) && $params[2] == "search")
        {
            $submittedData = $this->request->getPost("submittedData");
            $name = $submittedData['name'];
            $region_id = $submittedData['region_id'];
            $offset = $submittedData['offset'];
            $data_object['success'] = 0;
            try
            {
                $redirect_url = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/view_edit_universities/offset=' . $offset
                        . "&name=" . $name . "&region_id=" . $region_id;
                $data_object['success'] = 1;
                $data_object['redirect_url'] = $redirect_url;
            }
            catch (\Exception $ex)
            {
                $data_object['success'] = 0;
                $message = 'Could not search, Please try again';
                $data_object['message'] = $message;
                $data_object['error'] = $ex->getMessage();
            }
            finally
            {
                echo json_encode($data_object);
                exit;
            }
        }
        else
        {
            if (isset($params[2]) && $params[2] != "")
            {
                $helperModel = new HelperModel();
                $params_data = $helperModel->build_query_params_data($params[2]);
                $this->page_data = array_merge($this->page_data, $params_data);
            }
            if (empty($this->page_data['name']))
            {
                $this->page_data['name'] = "";
            }
            if (empty($this->page_data['region_id']))
            {
                $this->page_data['region_id'] = -1;
            }
            if (empty($this->page_data['limit']))
            {
                $this->page_data['limit'] = 100;
            }
            if (empty($this->page_data['offset']))
            {
                $this->page_data['offset'] = 0;
            }
            $search_filters = array();
            $search_filters['status'] = 'deleted';
            $search_filters['university_name'] = $this->page_data['name'];
            $search_filters['region_id'] = $this->page_data['region_id'];
            $universityModel = new UniversityModel();
            $search_filters['count'] = 1;
            $this->page_data['universities_count'] = $this->get_universities_by_condition($search_filters);
            if ($this->page_data["universities_count"] > 0 && $this->page_data["universities_count"] >= $this->page_data['offset'])
            {
                // no changes
            }
            else
            {
                $this->page_data['offset'] = 0;
            }
            if (isset($this->page_data['limit']))
            {
                $search_filters['limit'] = $this->page_data['limit'];
            }
            if (isset($this->page_data['offset']))
            {
                $search_filters['offset'] = $this->page_data['offset'];
            }
            $search_filters['count'] = 0;
            $universities_list = $universityModel->get_universities_by_condition($search_filters);
            $this->page_data['universities'] = $universities_list;
            $this->page_data['page_name'] = 'deleted_universities';
            $this->page_data['page_path'] = $this->page_data['view_files_path'];
            $this->page_data['page_title'] = 'Welcome';
            $this->page_data['menu_name'] = $this->page_data['menu_name'];
            echo view($this->page_data['controller_file_path'] . DIRECTORY_SEPARATOR . 'index', $this->page_data);
        }
    }

    /*** AJAX REQUESTS HANDLER ***/

    function processuniversitiesAjax($params, $controller_data)
    {
        $this->page_data = array_merge($this->page_data, $controller_data);
        if (isset($params[1]) && $params[1] == "ajax_request" && isset($params[2]) && $params[2] == "university")
        {
            if (isset($params[3]) && $params[3] == "universities_list")
            {
                try
                {
                    $universities_list = $this->get_universities_by_condition();
                    $data_object['universities'] = $universities_list;
                    $data_object['success'] = 1;
                }
                catch (\Exception $ex)
                {
                    $data_object['success'] = 0;
                    $data_object['message'] = 'Could not process your request. Please try again';
                    $data_object['error'] = $ex->getMessage();
                }
                finally
                {
                    echo json_encode($data_object);
                    exit;
                }
            }
            if (isset($params[3]) && $params[3] == "universities_list_ol")
            {
                $submittedData = $this->request->getPost("submittedData");
                $search_filters = array();
                if(isset($submittedData['region_id']))
                {
                    $search_filters['region_id'] = $submittedData['region_id'];
                }
                if(isset($submittedData['university_name']))
                {
                    $search_filters['university_name'] = $submittedData['university_name'];
                }
                if(isset($submittedData['offset']))
                {
                    $search_filters['offset'] = $submittedData['offset'];
                }
                else
                {
                    $search_filters['offset'] = 0;
                }
                try
                {
                    $search_filters['count'] = 1;
                    $universities_count = $this->get_universities_by_condition($search_filters);

                    $search_filters['count'] = 0;
                    $search_filters['limit'] = UNIVERSITY_PAGE_LIMIT;
                    $universities_list = $this->get_universities_by_condition($search_filters);

                    $data_object['universities_count'] = $universities_count;
                    $data_object['universities'] = $universities_list;
                    $data_object['success'] = 1;
                }
                catch (\Exception $ex)
                {
                    $data_object['success'] = 0;
                    $data_object['message'] = 'Could not process your request. Please try again';
                    $data_object['error'] = $ex->getMessage();
                }
                finally
                {
                    echo json_encode($data_object);
                    exit;
                }
            }
            else if (isset($params[3]) && $params[3] == "info")
            {
                $submittedData = $this->request->getPost("submittedData");
                $dataSearch['university_id'] = $submittedData['university_id'];
                try
                {
                    $universities_list = $this->get_universities_by_condition($dataSearch);
                    $data_object['university'] = $universities_list;
                    $data_object['success'] = 1;
                }
                catch (\Exception $ex)
                {
                    $data_object['success'] = 0;
                    $data_object['message'] = 'Could not process your request. Please try again';
                    $data_object['error'] = $ex->getMessage();
                }
                finally
                {
                    echo json_encode($data_object);
                    exit;
                }
            }
        }
    }

    /*** DATA HANDLER ***/

    function get_universities_by_condition($obj = null)
    {
        $builder = $this->db->table('university');
        if ($obj != null && isset($obj['university_id']) && $obj['university_id'] > 0)
        {
            $builder->where('university.university_id', $obj['university_id']);
        }
        if ($obj != null && isset($obj['region_id']) && $obj['region_id'] > 0)
        {
            $builder->where('university.region_id', $obj['region_id']);
        }
        if ($obj != null && isset($obj['university_name']) && strlen($obj['university_name']) > 0)
        {
            $builder->like('university.university_name', $obj['university_name'], 'BOTH');
        }
        if ($obj != null && isset($obj['phone']))
        {
            $builder->like('university.phone', $obj['phone'], 'BOTH');
        }
        // if ($obj != null && isset($obj['status']))
        // {
        //     $builder->where('university.status', $obj['status']);
        // }
        $builder->select('university.*, region.region_name');
        $builder->join('region', 'region.region_id = university.region_id', 'LEFT');
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

    /*** DATABASE HANDLER ***/

    function create_university($data)
    {
        $data_object = NULL;
        $data_object['transaction_status'] = "0";
        try
        {
            if (isset($data))
            {
                $builder = $this->db->table('university');
                if (!$builder->insert($data))
                {
                    $data_object['transaction_status'] = "0";
                    $data_object['error'] = $this->db->error();
                }

                if ($this->db->transStatus() === TRUE)
                {
                    $data_object['transaction_status'] = "1";
                    $data_object['insert_id'] = $this->db->insertID();
                }
            }
        }
        catch (\Exception $ex)
        {
            $data_object['transaction_status'] = "0";
            $data_object['error'] = $ex->getMessage();
        }

        return $data_object;
    }

    function update_university($data, $id, $user_id = null)
    {
        $data_object = NULL;
        $data_object['transaction_status'] = "0";
        try
        {
            if (isset($data))
            {
                $builder = $this->db->table('university');
                $builder->where('university.university_id', $id);
                if (isset($user_id) && $user_id > 0)
                {
                    $builder->where('user_id', $user_id);
                }
                if (!$builder->update($data))
                {
                    $data_object['transaction_status'] = "0";
                    $data_object['error'] = $this->db->error();
                }

                if ($this->db->transStatus() === TRUE)
                {
                    $data_object['transaction_status'] = "1";
                }
            }
        }
        catch (\Exception $ex)
        {
            $data_object['transaction_status'] = "0";
            $data_object['error'] = $ex->getMessage();
        }

        return $data_object;
    }

    function delete_university($id)
    {

        $data_object = NULL;
        $data_object['transaction_status'] = "0";
        try
        {
            if (isset($id))
            {
                $builder = $this->db->table('university');
                $builder->where('university.university_id', $id);
                if (!$builder->delete())
                {
                    $data_object['transaction_status'] = "0";
                    $data_object['error'] = $this->db->error();
                }

                if ($this->db->transStatus() === TRUE)
                {
                    $data_object['transaction_status'] = "1";
                }
            }
        }
        catch (\Exception $ex)
        {
            $data_object['transaction_status'] = "0";
            $data_object['error'] = $ex->getMessage();
        }

        return $data_object;
    }
}
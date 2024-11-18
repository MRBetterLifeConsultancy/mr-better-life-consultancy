<?php
namespace App\Models;
use CodeIgniter\Model;

class RegionModel extends Model
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

    function createRegion($params, $controller_data)
    {
        $this->page_data = array_merge($this->page_data, $controller_data);
        if (isset($params[1]) && $params[1] == "create_region" && isset($params[2]) && $params[2] == "create")
        {
            $data_to_insert['region_name'] = $this->request->getPost('region_name');
            $data_to_insert['is_country'] = $this->request->getPost('is_country');
            $data_to_insert['is_continent'] = $this->request->getPost('is_continent');
            $now = date('Y-m-d H:i:s');
            $data_to_insert['created_on'] = $now;

            $message = "";
            try
            {
                $this->db->transBegin();
                $transaction_status = $this->create_region($data_to_insert);
                if ($transaction_status['transaction_status'] == 0)
                {
                    $this->db->transRollback();
                    $data_object['success'] = 0;
                    $message = 'Could not submit request, Please try again later.';
                    $data_object['message'] = $message;
                }
                else
                {
                    $this->db->transCommit();
                    $data_object['success'] = 1;
                    $message .= 'Request sent successfully';
                    $data_object['message'] = $message;
                    $data_object['redirect_url'] = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/create_region';
                    $this->session->setFlashData('type', 'success');
                    $this->session->setFlashData('message', $message);
                }
            }
            catch (\Exception $ex)
            {
                $this->db->transRollback();
                $data_object['success'] = 0;
                $message = 'Could not submit request, Please try again later.';
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
            $this->page_data['page_name'] = 'contact';
            $this->page_data['page_path'] = $this->page_data['view_files_path'];
            $this->page_data['page_title'] = 'Contact Us';
            $this->page_data['menu_name'] = $this->page_data['menu_name'];
            echo view($this->page_data['controller_file_path'] . DIRECTORY_SEPARATOR . 'index', $this->page_data);
        }
    }

    function viewEditRegions($params, $controller_data)
    {
        $this->page_data = array_merge($this->page_data, $controller_data);
        if (isset($params[1]) && $params[1] == "view_edit_regions" && isset($params[2]) && $params[2] == "edit")
        {
            $submittedData = $this->request->getPost("submittedData");
            $region_id = $submittedData['region_id'];
            $data_to_update['region_name'] = $submittedData['region_name'];
            // $data_to_update['is_country'] = $submittedData['is_country'];
            // $data_to_update['is_continent'] = $submittedData['is_continent'];
            $data_to_update['brief_document'] = $submittedData['brief_document'];
            $now = date('Y-m-d H:i:s');
            // $data_to_update['last_updated_on'] = $now;
            try
            {
                $this->db->transBegin();
                $transaction_status = $this->update_region($data_to_update, $region_id);
                if ($transaction_status['transaction_status'] == 0)
                {
                    $this->db->transRollback();
                    $data_object['success'] = 0;
                    $message = 'Could not update region, Please try again';
                    $data_object['message'] = $message;
                }
                else
                {
                    $this->db->transCommit();
                    $data_object['success'] = 1;
                    $message = 'Region updated successfully';
                    $data_object['message'] = $message;
                    $data_object['redirect_url'] = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/view_edit_regions';
                    $this->session->setFlashData('type', 'success');
                    $this->session->setFlashData('message', $message);
                }
            }
            catch (\Exception $ex)
            {
                $this->db->transRollback();
                $data_object['success'] = 0;
                $message = 'Could not update region, Please try again';
                $data_object['message'] = $message;
                $data_object['error'] = $ex->getMessage();
            }
            finally
            {
                echo json_encode($data_object);
                exit;
            }
        }
        else if (isset($params[1]) && $params[1] == "view_edit_regions" && isset($params[2]) && $params[2] == "search")
        {
            $submittedData = $this->request->getPost("submittedData");
            $region_name = $submittedData['region_name'];
            $offset = $submittedData['offset'];
            $data_object['success'] = 0;
            try
            {
                $redirect_url = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/view_edit_regions/offset=' . $offset
                        . "&region_name=" . $region_name;
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
            if (empty($this->page_data['region_name']))
            {
                $this->page_data['region_name'] = "";
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
            $search_filters['status'] = 'active';
            $search_filters['region_name'] = $this->page_data['region_name'];
            $regionModel = new RegionModel();
            $search_filters['count'] = 1;
            $this->page_data['regions_count'] = $this->get_regions_by_condition($search_filters);
            if ($this->page_data["regions_count"] > 0 && $this->page_data["regions_count"] >= $this->page_data['offset'])
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
            $regions_list = $regionModel->get_regions_by_condition($search_filters);
            $this->page_data['regions'] = $regions_list;
            $this->page_data['page_name'] = 'view_edit_regions';
            $this->page_data['page_path'] = $this->page_data['view_files_path'];
            $this->page_data['page_title'] = 'Welcome';
            $this->page_data['menu_name'] = $this->page_data['menu_name'];
            echo view($this->page_data['controller_file_path'] . DIRECTORY_SEPARATOR . 'index', $this->page_data);
        }
    }

    function deletedRegions($params, $controller_data)
    {
        $this->page_data = array_merge($this->page_data, $controller_data);
        if (isset($params[1]) && $params[1] == "deleted_regions" && isset($params[2]) && $params[2] == "restore")
        {
            $submittedData = $this->request->getPost("submittedData");
            $region_id = $submittedData['region_id'];
            $data_to_update['status'] = "active";
            $now = date('Y-m-d H:i:s');
            $data_to_update['last_updated_on'] = $now;
            try
            {
                $this->db->transBegin();
                $transaction_status = $this->update_region($data_to_update, $region_id);
                if ($transaction_status['transaction_status'] == 0)
                {
                    $this->db->transRollback();
                    $data_object['success'] = 0;
                    $message = 'Could not restore region, Please try again';
                    $data_object['message'] = $message;
                }
                else
                {
                    $this->db->transCommit();
                    $data_object['success'] = 1;
                    $message = 'Region restored successfully';
                    $data_object['message'] = $message;
                    $data_object['redirect_url'] = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/view_edit_regions';
                    $this->session->setFlashData('type', 'success');
                    $this->session->setFlashData('message', $message);
                }
            }
            catch (\Exception $ex)
            {
                $this->db->transRollback();
                $data_object['success'] = 0;
                $message = 'Could not restore region, Please try again';
                $data_object['message'] = $message;
                $data_object['error'] = $ex->getMessage();
            }
            finally
            {
                echo json_encode($data_object);
                exit;
            }
        }
        else if (isset($params[1]) && $params[1] == "deleted_regions" && isset($params[2]) && $params[2] == "search")
        {
            $submittedData = $this->request->getPost("submittedData");
            $region_name = $submittedData['region_name'];
            $phone = $submittedData['phone'];
            $offset = $submittedData['offset'];
            $data_object['success'] = 0;
            try
            {
                $redirect_url = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/view_edit_regions/offset=' . $offset
                        . "&name=" . $region_name . "&phone=" . $phone;
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
            if (empty($this->page_data['region_name']))
            {
                $this->page_data['region_name'] = "";
            }
            if (empty($this->page_data['phone']))
            {
                $this->page_data['phone'] = "";
            }
            if (empty($this->page_data['subject']))
            {
                $this->page_data['subject'] = -1;
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
            $search_filters['region_name'] = $this->page_data['region_name'];
            $search_filters['phone'] = $this->page_data['phone'];
            $search_filters['subject'] = $this->page_data['subject'];
            $regionModel = new RegionModel();
            $search_filters['count'] = 1;
            $this->page_data['regions_count'] = $this->get_regions_by_condition($search_filters);
            if ($this->page_data["regions_count"] > 0 && $this->page_data["regions_count"] >= $this->page_data['offset'])
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
            $regions_list = $regionModel->get_regions_by_condition($search_filters);
            $this->page_data['regions'] = $regions_list;
            $this->page_data['page_name'] = 'deleted_regions';
            $this->page_data['page_path'] = $this->page_data['view_files_path'];
            $this->page_data['page_title'] = 'Welcome';
            $this->page_data['menu_name'] = $this->page_data['menu_name'];
            echo view($this->page_data['controller_file_path'] . DIRECTORY_SEPARATOR . 'index', $this->page_data);
        }
    }

    function viewRegionUser($params, $controller_data)
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

        if(!isset($this->page_data['rid']))
        {
            $this->page_data['rid'] = -1;
        }
        
        $search_filters = array();
        $search_filters['count'] = 1;
        $search_filters['region_id'] = $this->page_data['rid'];
        $this->page_data['regions_count'] = $this->get_regions_by_condition($search_filters);

        $search_filters['count'] = 0;
        $regions = $this->get_regions_by_condition($search_filters);
        if(count($regions) == 1 && $regions[0]['brief_document'] != null)
        {
            $this->page_data['region_data'] = $regions[0]; 

            $search_filters['limit'] = 10;
            $search_filters['offset'] = 0;
            $universityModel = new UniversityModel();
            $this->page_data['universities'] = $universityModel->get_universities_by_condition($search_filters);
            $this->page_data['page_name'] = 'view_region';
            $this->page_data['page_path'] = $this->page_data['view_files_path'];
            $this->page_data['page_title'] = 'Study Destinations';
        }
        else
        {
            $this->page_data['page_name'] = 'error-404';
            $this->page_data['page_path'] = 'errors';
            $this->page_data['page_title'] = 'View Region';
        }
        $this->page_data['page_class_name'] = 'about-page';
        $this->page_data['menu_name'] = $this->page_data['menu_name'];
        echo view($this->page_data['controller_file_path'] . DIRECTORY_SEPARATOR . 'index', $this->page_data);
    }

    /*** AJAX REQUESTS HANDLER ***/

    function processRegionsAjax($params, $controller_data)
    {
        $this->page_data = array_merge($this->page_data, $controller_data);
        if (isset($params[1]) && $params[1] == "ajax_request" && isset($params[2]) && $params[2] == "region")
        {
            if (isset($params[3]) && $params[3] == "regions_list")
            {
                try
                {
                    $regions_list = $this->get_regions_by_condition();
                    $data_object['regions'] = $regions_list;
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
                $dataSearch['region_id'] = $submittedData['region_id'];
                try
                {
                    $regions_list = $this->get_regions_by_condition($dataSearch);
                    $data_object['region'] = $regions_list;
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

    function get_regions_by_condition($obj = null)
    {
        $builder = $this->db->table('region');
        if ($obj != null && isset($obj['region_id']))
        {
            $builder->where('region.region_id', $obj['region_id']);
        }
        if ($obj != null && isset($obj['region_name']))
        {
            $builder->like('region.region_name', $obj['region_name'], 'BOTH');
        }
        if ($obj != null && isset($obj['status']))
        {
            $builder->where('region.status', $obj['status']);
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

    /*** DATABASE HANDLER ***/

    function create_region($data)
    {
        $data_object = NULL;
        $data_object['transaction_status'] = "0";
        try
        {
            if (isset($data))
            {
                $builder = $this->db->table('region');
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

    function update_region($data, $id)
    {
        $data_object = NULL;
        $data_object['transaction_status'] = "0";
        try
        {
            if (isset($data))
            {
                $builder = $this->db->table('region');
                $builder->where('region_id', $id);
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

    function delete_region($id)
    {

        $data_object = NULL;
        $data_object['transaction_status'] = "0";
        try
        {
            if (isset($id))
            {
                $builder = $this->db->table('region');
                $builder->where('region.region_id', $id);
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
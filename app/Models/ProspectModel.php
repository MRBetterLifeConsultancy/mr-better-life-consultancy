<?php
namespace App\Models;
use CodeIgniter\Model;

class ProspectModel extends Model
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

    function createProspect($params, $controller_data)
    {
        $this->page_data = array_merge($this->page_data, $controller_data);
        if (isset($params[1]) && $params[1] == "create_prospect" && isset($params[2]) && $params[2] == "create")
        {
            $submittedData = $this->request->getPost("submittedData");
            $data_to_insert['prospect_name'] = $submittedData['name'];
            $data_to_insert['subject'] = $submittedData['subject'];
            $data_to_insert['phone'] = $submittedData['phone'];
            $data_to_insert['email'] = $submittedData['email'];
            $data_to_insert['description'] = $submittedData['message'];
            $now = date('Y-m-d H:i:s');
            $data_to_insert['created_on'] = $now;

            $message = "";
            try
            {
                $this->db->transBegin();
                $transaction_status = $this->create_prospect($data_to_insert);
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
                    $message .= 'Your session request have been sent successfully';
                    $data_object['message'] = $message;
                    $data_object['redirect_url'] = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/create_prospect';
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

    function viewEditProspects($params, $controller_data)
    {
        $this->page_data = array_merge($this->page_data, $controller_data);
        if (isset($params[1]) && $params[1] == "view_edit_prospects" && isset($params[2]) && $params[2] == "edit")
        {
            $submittedData = $this->request->getPost("submittedData");
            $prospect_id = $submittedData['prospect_id'];
            $data_to_update['name'] = $submittedData['name'];
            $data_to_update['phone'] = $submittedData['phone'];
            $data_to_update['email'] = $submittedData['email'];
            $data_to_update['subject'] = $submittedData['subject'];
            $data_to_update['description'] = $submittedData['message'];
            $now = date('Y-m-d H:i:s');
            $data_to_update['last_updated_on'] = $now;
            try
            {
                $this->db->transBegin();
                $transaction_status = $this->update_prospect($data_to_update, $prospect_id);
                if ($transaction_status['transaction_status'] == 0)
                {
                    $this->db->transRollback();
                    $data_object['success'] = 0;
                    $message = 'Could not update prospect, Please try again';
                    $data_object['message'] = $message;
                }
                else
                {
                    $this->db->transCommit();
                    $data_object['success'] = 1;
                    $message = 'Prospect updated successfully';
                    $data_object['message'] = $message;
                    $data_object['redirect_url'] = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/view_edit_prospects';
                    $this->session->setFlashData('type', 'success');
                    $this->session->setFlashData('message', $message);
                }
            }
            catch (\Exception $ex)
            {
                $this->db->transRollback();
                $data_object['success'] = 0;
                $message = 'Could not update prospect, Please try again';
                $data_object['message'] = $message;
                $data_object['error'] = $ex->getMessage();
            }
            finally
            {
                echo json_encode($data_object);
                exit;
            }
        }
        if (isset($params[1]) && $params[1] == "view_edit_prospects" && isset($params[2]) && $params[2] == "add_follow_up")
        {
            $submittedData = $this->request->getPost("submittedData");
            $prospect_id = $submittedData['prospect_id'];
            $message = $submittedData['message'];
            $now = date('Y-m-d H:i:s');

            $search_filters = array();
            $search_filters['prospect_id'] = $prospect_id;
            $prospect_data = $this->get_prospects_by_condition($search_filters)[0];

            $follow_ups = json_decode($prospect_data['follow_up_timeline'], true);

            array_push($follow_ups, array(
                'datetime' => $now,
                'message' => $message
            ));

            $data_to_update['follow_up_timeline'] = json_encode($follow_ups);
            $data_to_update['last_updated_on'] = $now;
            try
            {
                $this->db->transBegin();
                $transaction_status = $this->update_prospect($data_to_update, $prospect_id);
                if ($transaction_status['transaction_status'] == 0)
                {
                    $this->db->transRollback();
                    $data_object['success'] = 0;
                    $message = 'Could not update prospect, Please try again';
                    $data_object['message'] = $message;
                }
                else
                {
                    $this->db->transCommit();
                    $data_object['success'] = 1;
                    $message = 'Prospect updated successfully';
                    $data_object['message'] = $message;
                    $data_object['redirect_url'] = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/view_edit_prospects';
                    $this->session->setFlashData('type', 'success');
                    $this->session->setFlashData('message', $message);
                }
            }
            catch (\Exception $ex)
            {
                $this->db->transRollback();
                $data_object['success'] = 0;
                $message = 'Could not update prospect, Please try again';
                $data_object['message'] = $message;
                $data_object['error'] = $ex->getMessage();
            }
            finally
            {
                echo json_encode($data_object);
                exit;
            }
        }
        else if (isset($params[1]) && $params[1] == "view_edit_prospects" && isset($params[2]) && $params[2] == "search")
        {
            $submittedData = $this->request->getPost("submittedData");
            $df = $submittedData['date_from'];
            $dt = $submittedData['date_to'];
            $name = $submittedData['name'];
            $phone = $submittedData['phone'];
            $email = $submittedData['email'];
            $offset = $submittedData['offset'];
            $data_object['success'] = 0;
            try
            {
                $redirect_url = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/view_edit_prospects/offset=' . $offset. "&name=" . $name . "&phone=" . $phone. "&email=" . $email. "&df=" . $df. "&dt=" . $dt;
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
            if (empty($this->page_data['name']))
            {
                $this->page_data['name'] = "";
            }
            if (empty($this->page_data['df']))
            {
                $this->page_data['df'] = "";
            }
            if (empty($this->page_data['dt']))
            {
                $this->page_data['dt'] = "";
            }
            if (empty($this->page_data['phone']))
            {
                $this->page_data['phone'] = "";
            }
            if (empty($this->page_data['email']))
            {
                $this->page_data['email'] = "";
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
            $search_filters['date_from'] = $this->page_data['df'];
            $search_filters['date_to'] = $this->page_data['dt'];
            $search_filters['prospect_name'] = $this->page_data['name'];
            $search_filters['phone'] = $this->page_data['phone'];
            $prospectModel = new ProspectModel();
            $search_filters['count'] = 1;
            $this->page_data['prospects_count'] = $this->get_prospects_by_condition($search_filters);
            if ($this->page_data["prospects_count"] > 0 && $this->page_data["prospects_count"] >= $this->page_data['offset'])
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
            $prospects_list = $prospectModel->get_prospects_by_condition($search_filters);
            $this->page_data['prospects'] = $prospects_list;
            $this->page_data['page_name'] = 'view_edit_prospects';
            $this->page_data['page_path'] = $this->page_data['view_files_path'];
            $this->page_data['page_title'] = 'Welcome';
            $this->page_data['menu_name'] = $this->page_data['menu_name'];
            echo view($this->page_data['controller_file_path'] . DIRECTORY_SEPARATOR . 'index', $this->page_data);
        }
    }

    function deletedProspects($params, $controller_data)
    {
        $this->page_data = array_merge($this->page_data, $controller_data);
        if (isset($params[1]) && $params[1] == "deleted_prospects" && isset($params[2]) && $params[2] == "restore")
        {
            $submittedData = $this->request->getPost("submittedData");
            $prospect_id = $submittedData['prospect_id'];
            $data_to_update['status'] = "active";
            $now = date('Y-m-d H:i:s');
            $data_to_update['last_updated_on'] = $now;
            try
            {
                $this->db->transBegin();
                $transaction_status = $this->update_prospect($data_to_update, $prospect_id);
                if ($transaction_status['transaction_status'] == 0)
                {
                    $this->db->transRollback();
                    $data_object['success'] = 0;
                    $message = 'Could not restore prospect, Please try again';
                    $data_object['message'] = $message;
                }
                else
                {
                    $this->db->transCommit();
                    $data_object['success'] = 1;
                    $message = 'Prospect restored successfully';
                    $data_object['message'] = $message;
                    $data_object['redirect_url'] = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/view_edit_prospects';
                    $this->session->setFlashData('type', 'success');
                    $this->session->setFlashData('message', $message);
                }
            }
            catch (\Exception $ex)
            {
                $this->db->transRollback();
                $data_object['success'] = 0;
                $message = 'Could not restore prospect, Please try again';
                $data_object['message'] = $message;
                $data_object['error'] = $ex->getMessage();
            }
            finally
            {
                echo json_encode($data_object);
                exit;
            }
        }
        else if (isset($params[1]) && $params[1] == "deleted_prospects" && isset($params[2]) && $params[2] == "search")
        {
            $submittedData = $this->request->getPost("submittedData");
            $name = $submittedData['name'];
            $phone = $submittedData['phone'];
            $offset = $submittedData['offset'];
            $data_object['success'] = 0;
            try
            {
                $redirect_url = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/view_edit_prospects/offset=' . $offset
                        . "&name=" . $name . "&phone=" . $phone;
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
            if (empty($this->page_data['name']))
            {
                $this->page_data['name'] = "";
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
            $search_filters['name'] = $this->page_data['name'];
            $search_filters['phone'] = $this->page_data['phone'];
            $search_filters['subject'] = $this->page_data['subject'];
            $prospectModel = new ProspectModel();
            $search_filters['count'] = 1;
            $this->page_data['prospects_count'] = $this->get_prospects_by_condition($search_filters);
            if ($this->page_data["prospects_count"] > 0 && $this->page_data["prospects_count"] >= $this->page_data['offset'])
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
            $prospects_list = $prospectModel->get_prospects_by_condition($search_filters);
            $this->page_data['prospects'] = $prospects_list;
            $this->page_data['page_name'] = 'deleted_prospects';
            $this->page_data['page_path'] = $this->page_data['view_files_path'];
            $this->page_data['page_title'] = 'Welcome';
            $this->page_data['menu_name'] = $this->page_data['menu_name'];
            echo view($this->page_data['controller_file_path'] . DIRECTORY_SEPARATOR . 'index', $this->page_data);
        }
    }

    /*** AJAX REQUESTS HANDLER ***/

    function processProspectsAjax($params, $controller_data)
    {
        $this->page_data = array_merge($this->page_data, $controller_data);
        if (isset($params[1]) && $params[1] == "ajax_request" && isset($params[2]) && $params[2] == "prospect")
        {
            if (isset($params[3]) && $params[3] == "prospects_list")
            {
                try
                {
                    $prospects_list = $this->get_prospects_by_condition();
                    $data_object['prospects'] = $prospects_list;
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
                $dataSearch['prospect_id'] = $submittedData['prospect_id'];
                try
                {
                    $prospects_list = $this->get_prospects_by_condition($dataSearch);
                    $data_object['prospects'] = $prospects_list;
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
            else if (isset($params[3]) && $params[3] == "follow_up")
            {
                $submittedData = $this->request->getPost("submittedData");
                $dataSearch['prospect_id'] = $submittedData['prospect_id'];
                try
                {
                    $prospects_list = $this->get_prospects_by_condition($dataSearch);
                    $prospect = [];
                    foreach ($prospects_list as $key => $value) 
                    {
                        $prospect = $value;
                    }
                    $data_object['follow_ups'] = json_decode($prospect['follow_up_timeline'], true);
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

    function get_prospects_by_condition($obj = null)
    {
        $builder = $this->db->table('prospect');
        if ($obj != null && isset($obj['prospect_id']) && $obj['prospect_id'] != 1)
        {
            $builder->where('prospect.prospect_id', $obj['prospect_id']);
        }
        if ($obj != null && isset($obj['prospect_name']) && strlen($obj['prospect_name']) > 0)
        {
            $builder->like('prospect.prospect_name', $obj['prospect_name'], 'BOTH');
        }
        if ($obj != null && isset($obj['phone']) && strlen($obj['phone']) > 0)
        {
            $builder->like('prospect.phone', $obj['phone'], 'BOTH');
        }
        if ($obj != null && isset($obj['subject']) && strlen($obj['subject']) > 0)
        {
            $builder->like('prospect.subject', $obj['subject']);
        }
        if ($obj != null && isset($obj['created_on']) && strlen($obj['created_on']) > 0)
        {
            $builder->where('DATE_FORMAT(prospect.created_on,"%Y-%m-%d")', $obj['created_on']);
        }
        if ($obj != null && isset($obj['date_from']) && strlen($obj['date_from']) > 0)
        {
            $builder->where('DATE_FORMAT(prospect.created_on,"%Y-%m-%d") >= ', $obj['date_from']);
        }
        if ($obj != null && isset($obj['date_to']) && strlen($obj['date_to']) > 0)
        {
            $builder->where('DATE_FORMAT(prospect.created_on,"%Y-%m-%d") <= ', $obj['date_to']);
        }
        if ($obj != null && isset($obj['status']) && strlen($obj['status']) > 0)
        {
            $builder->where('prospect.status', $obj['status']);
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

    function create_prospect($data)
    {
        $data_object = NULL;
        $data_object['transaction_status'] = "0";
        try
        {
            if (isset($data))
            {
                $builder = $this->db->table('prospect');
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

    function update_prospect($data, $id, $user_id = null)
    {
        $data_object = NULL;
        $data_object['transaction_status'] = "0";
        try
        {
            if (isset($data))
            {
                $builder = $this->db->table('prospect');
                $builder->where('prospect.prospect_id', $id);
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

    function delete_prospect($id)
    {

        $data_object = NULL;
        $data_object['transaction_status'] = "0";
        try
        {
            if (isset($id))
            {
                $builder = $this->db->table('prospect');
                $builder->where('prospect.prospect_id', $id);
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
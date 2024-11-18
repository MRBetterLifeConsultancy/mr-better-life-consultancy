<?php
namespace App\Models;
use CodeIgniter\Model;

class AdminModel extends Model
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

    function login($params, $controller_data)
    {
        $this->page_data = array_merge($this->page_data, $controller_data);
        if (isset($params[1]) && $params[1] == "admin_login" && isset($params[2]) && $params[2] == "sign_in")
        {
            $submittedData = $this->request->getPost("submittedData");
            $data_to_insert['email'] = $submittedData['email'];
            $data_to_insert['password'] = $submittedData['password'];
            //
            try
            {
                $this->db->transBegin();
                $result_object = $this->get_admins_by_condition($data_to_insert);
                $count = count($result_object);
                if ($count == 0)
                {
                    $this->db->transRollback();
                    $data_object['success'] = 0;
                    $data_object['message'] = 'No user exists with this email';
                }
                else
                {
                    $adminHelperModel = new AdminHelperModel();
                    $result = $adminHelperModel->verify_admin_password($data_to_insert, $result_object[0]);
                    if ($result == false)
                    {
                        $this->db->transRollback();
                        $data_object['success'] = 0;
                        $data_object['message'] = 'Incorrect password';
                    }
                    else
                    {
                        $helperModel = new HelperModel();
                        $helperModel->set_user_session_data($result_object[0], "admin");
                        $this->db->transCommit();
                        $data_object['success'] = 1;
                        $data_object['redirect_url'] = $this->page_data['custom_site_url'] . ADMIN_URL . '/dashboard';
                    }
                }
            }
            catch (\Exception $ex)
            {
                $this->db->transRollback();
                $data_object['success'] = 0;
                $data_object['message'] = 'Could not process your request. Please try again';
                $data_object['error'] = $ex->getMessage();
            }
            finally
            {
                echo json_encode($data_object);
                exit();
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
            $this->page_data['page_name'] = 'admin';
            $this->page_data['page_path'] = $this->page_data['view_files_path'];
            $this->page_data['page_title'] = 'Welcome';
            $this->page_data['menu_name'] = $this->page_data['menu_name'];
            echo view($this->page_data['controller_file_path'] . DIRECTORY_SEPARATOR . 'index', $this->page_data);
        }
    }

    function dashboard($params, $controller_data)
    {
        $this->page_data = array_merge($this->page_data, $controller_data);
        if (isset($params[2]) && $params[2] != "")
        {
            $helperModel = new HelperModel();
            $params_data = $helperModel->build_query_params_data($params[2]);
            $this->page_data = array_merge($this->page_data, $params_data);
        }

        $search_filters = array();
        $search_filters['count'] = 1;
        $search_filters['created_on'] = date('Y-m-h');

        $userModel = new UserModel();
        $visitModel = new VisitModel();
        $prospectModel = new ProspectModel();
        $regionModel = new RegionModel();
        $universityModel = new UniversityModel();
        $universityCourseModel = new UniversityCourseModel();
        $testimonialModel = new TestimonialModel();
        $this->page_data['users_visited'] = $visitModel->get_visits_by_condition($search_filters);
        $this->page_data['users_registered'] = $userModel->get_users_by_condition($search_filters);
        $this->page_data['prospects_created'] = $prospectModel->get_prospects_by_condition($search_filters);
        $this->page_data['regions_count'] = $regionModel->get_regions_by_condition($search_filters);
        $this->page_data['universities_count'] = $universityModel->get_universities_by_condition($search_filters);
        $this->page_data['university_courses_count'] = $universityCourseModel->get_university_courses_by_condition($search_filters);
        $this->page_data['testimonials_count'] = $testimonialModel->get_testimonials_by_condition($search_filters);

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
        $this->page_data['page_name'] = 'admin';
        $this->page_data['page_path'] = $this->page_data['view_files_path'];
        $this->page_data['page_title'] = 'Welcome';
        $this->page_data['menu_name'] = $this->page_data['menu_name'];
        echo view($this->page_data['controller_file_path'] . DIRECTORY_SEPARATOR . 'index', $this->page_data);
    }

    function viewEditProfile($params, $controller_data)
    {
        $this->page_data = array_merge($this->page_data, $controller_data);
        if (isset($params[2]) && $params[2] == "profile") 
        {
            $submittedData = $this->request->getPost("submittedData");
            $admin_id = $submittedData['admin_id'];
            $data_to_insert['first_name'] = $submittedData['first_name'];
            $data_to_insert['last_name'] = $submittedData['last_name'];
            $data_to_insert['phone'] = $submittedData['phone'];
            //
            try
            {-
                $this->db->db_debug = false;
                $this->db->transBegin();
                $result_object = $this->update_admin($data_to_insert,$admin_id);
                if ($result_object['transaction_status'] == "0")
                {
                    $this->db->transRollback();
                    $data_object['success'] = 0;
                    $data_object['message'] = 'Could not update. Please try again';
                    $data_object['error'] = $result_object['error']; 
                }
                else
                {
                    $this->db->transCommit();
                    $data_object['success'] = 1;
                    $data_object['message'] = 'Profile updated successfully';
                    $data_object['redirect_url'] = $this->page_data['custom_site_url'] . ADMIN_URL . '/view_edit_profile';
                }
            }
            catch (Exception $ex)
            {
                $this->db->transRollback();
                $data_object['success'] = 0;
                $data_object['message'] = 'Could not update. Please try again';
                $data_object['error'] = $ex->getMessage();
            }
            finally
            {
                echo json_encode($data_object);
                exit();
            }
        } 
        else if (isset($params[2]) && $params[2] == "edit_password") 
        {
            $submittedData = $this->request->getPost("submittedData");
            $admin_id = $submittedData['admin_id'];
            $data_to_insert['password'] = $submittedData['current_password'];
            // $data_to_insert['password'] = $submittedData['confirm_password'];
            //
            try
            {
                $adminHelperModel = new AdminHelperModel();
                $count = $adminHelperModel->verify_admin_password1($data_to_insert,$admin_id);
                if($count == 1)
                {
                    $data_to_insert['password'] = $submittedData['confirm_password'];
                    $this->db->db_debug = false;
                    $this->db->transBegin();
                    $result_object = $this->update_admin($data_to_insert,$admin_id);
                    if ($result_object['transaction_status'] == "0")
                    {
                        $this->db->transRollback();
                        $data_object['success'] = 0;
                        $data_object['message'] = 'Could not update password Please try again';
                        $data_object['error'] = $result_object['error']; 
                    }
                    else
                    {
                        $this->db->transCommit();
                        $data_object['success'] = 1;
                        $data_object['redirect_url'] = $this->page_data['custom_site_url'] . ADMIN_URL . '/view_edit_profile';
                    }
                }
                else
                {
                    $data_object['success'] = 0;
                    $data_object['message'] = 'Current password not matched Please try again';
                }
            }
            catch (Exception $ex)
            {
                $this->db->transRollback();
                $data_object['success'] = 0;
                $data_object['message'] = 'Could not update password. Please try again';
                $data_object['error'] = $ex->getMessage();
            }
            finally
            {
                echo json_encode($data_object);
                exit();
            }
        } 
        else if (isset($params[2]) && $params[2] == "edit_email")
        {
            $submittedData = $this->request->getPost("submittedData");
            $admin_id = $submittedData['admin_id'];
            $data_to_insert['email'] = $submittedData['new_email'];
            try
            {
                $adminHelperModel = new AdminHelperModel();
                $count = $adminHelperModel->verify_admin_email($data_to_insert);
                //if count == 0 then update_user
                //else return success 0
                if($count == 0)
                {
                    $this->db->db_debug = false;
                    $this->db->transBegin();
                    $result_object = $this->update_admin($data_to_insert, $admin_id);
                    if ($result_object['transaction_status'] == "0")
                    {
                        $this->db->transRollback();
                        $data_object['success'] = 0;
                        $data_object['message'] = 'Could not update email id Please try again';
                        $data_object['error'] = $result_object['error']; 
                    }
                    else
                    {
                        $this->db->transCommit();
                        $data_object['success'] = 1;
                        $data_object['redirect_url'] = $this->page_data['custom_site_url'] . ADMIN_URL . '/view_edit_profile';
                    }

                }
                else
                {
                        $data_object['success'] = 0;
                        $data_object['message'] = 'Email id already present.Please try with another email id';
                }
            }
            catch (Exception $ex)
            {
                $this->db->transRollback();
                $data_object['success'] = 0;
                $data_object['message'] = 'Could not update mail id. Please try again';
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
                $this->page_data = $this->process_model->build_query_params_data($params[2]);
            }
            $this->page_data['page_name']     = "profile";
            $this->page_data['page_path']     = $this->page_data['view_files_path'];
            $this->page_data['menu_name']     = "profile";
            $this->page_data['title']         = ucwords(strtolower("View profile"));
            $this->page_data['page_title'] = 'profile';
            
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
            $search_filters = array();
            $search_filters["admin_id"] = $this->page_data["g_admin_id"];
            $this->page_data["admin_data"] = $this->get_admins_by_condition($search_filters);
            echo view($this->page_data['controller_file_path'] . DIRECTORY_SEPARATOR . 'index', $this->page_data);
        }
    }

    /*** DATA HANDLER ***/

    function get_admins_by_condition($obj = null)
    {
        $builder = $this->db->table('admin');
        if ($obj != null && isset($obj['email']))
        {
            $builder->where('admin.email', $obj['email']);
        }
        if ($obj != null && isset($obj['admin_id']))
        {
            $builder->where('admin.admin_id', $obj['admin_id']);
        }
        $data_object = $builder->get()->getResultArray();
        return $data_object;
    }

    /*** DB HANDLER ***/

    function update_admin($data, $id)
    {
        $data_object = NULL;
        $data_object['transaction_status'] = "0";
        try
        {
            if (isset($data))
            {
                $builder = $this->db->table('admin');
                $builder->where('admin_id', $id);
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
}
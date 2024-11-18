<?php
namespace App\Models;
use CodeIgniter\Model;

class HomeModel extends Model
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
    function viewHomePage($params, $controller_data)
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

        $regionModel = new RegionModel();
        $regions_list = $regionModel->get_regions_by_condition();
        $this->page_data['regions'] = $regions_list;

        $universityHelperModel = new UniversityHelperModel();
        $universities_list = $universityHelperModel->get_region_wise_universities_by_condition();
        $this->page_data['region_universities'] = $universities_list;
        
        $search_filters = array();
        $search_filters['count'] = 1;
        $userModel = new UserModel();
        $universityModel = new UniversityModel();
        $this->page_data['universities_count'] = $universityModel->get_universities_by_condition($search_filters);
        $this->page_data['users_count'] = $userModel->get_users_by_condition($search_filters);

        $search_filters = array();
        $testimonialModel = new TestimonialModel();
        $search_filters['limit'] = 5;
        $testimonials_list = $testimonialModel->get_testimonials_by_condition($search_filters);
        $this->page_data['testimonials'] = $testimonials_list;

        $serviceModel = new ServiceModel();
        $services_list = $serviceModel->get_services_by_condition($search_filters);
        $this->page_data['services'] = $services_list;

        $this->page_data['page_class_name'] = 'index-page';
        $this->page_data['page_name'] = 'home';
        $this->page_data['page_path'] = $this->page_data['view_files_path'];
        $this->page_data['page_title'] = 'Welcome';
        $this->page_data['menu_name'] = $this->page_data['menu_name'];
        echo view($this->page_data['controller_file_path'] . DIRECTORY_SEPARATOR . 'index', $this->page_data);
    }


    function contact($params, $controller_data)
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
        if(!isset($this->page_data['subject']))
        {
            $this->page_data['subject'] = '';
        }
        else
        {
            $this->page_data['subject'] = str_replace('%20', ' ', $this->page_data['subject']);
        }
        
        $search_filters = array();
        $search_filters['count'] = 1;
        $userModel = new UserModel();
        $universityModel = new UniversityModel();
        $this->page_data['universities_count'] = $universityModel->get_universities_by_condition($search_filters);
        $this->page_data['users_count'] = $userModel->get_users_by_condition($search_filters);

        $this->page_data['page_class_name'] = 'contact-page';
        $this->page_data['page_name'] = 'contact';
        $this->page_data['page_path'] = $this->page_data['view_files_path'];
        $this->page_data['page_title'] = 'Contact';
        $this->page_data['menu_name'] = $this->page_data['menu_name'];
        echo view($this->page_data['controller_file_path'] . DIRECTORY_SEPARATOR . 'index', $this->page_data);
    }

    function about($params, $controller_data)
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
        
        // $search_filters = array();
        // $search_filters['count'] = 1;
        // $userModel = new UserModel();
        // $universityModel = new UniversityModel();
        // $this->page_data['universities_count'] = $universityModel->get_universities_by_condition($search_filters);
        // $this->page_data['users_count'] = $userModel->get_users_by_condition($search_filters);

        $this->page_data['page_class_name'] = 'about-page';
        $this->page_data['page_name'] = 'about';
        $this->page_data['page_path'] = $this->page_data['view_files_path'];
        $this->page_data['page_title'] = 'About';
        $this->page_data['menu_name'] = $this->page_data['menu_name'];
        echo view($this->page_data['controller_file_path'] . DIRECTORY_SEPARATOR . 'index', $this->page_data);
    }

    function register($params, $controller_data)
    {
        $this->page_data = array_merge($this->page_data, $controller_data);
        if (isset($params[1]) && $params[1] == "register" && isset($params[2]) && $params[2] == "sign_up")
        {
            $submittedData = $this->request->getPost('submittedData');
            $data_to_insert['first_name'] = $submittedData['first_name'];
            $data_to_insert['middle_name'] = $submittedData['middle_name'];
            $data_to_insert['last_name'] = $submittedData['last_name'];
            $data_to_insert['gender'] = $submittedData['gender'];
            $data_to_insert['date_of_birth'] = $submittedData['date_of_birth'];
            $data_to_insert['phone'] = $submittedData['phone'];
            $data_to_insert['email'] = $submittedData['email'];
            $data_to_insert['password'] = $submittedData['password'];
            $now = date('Y-m-d H:i:s');
            $data_to_insert['created_on'] = $now;

            $message = "";
            try
            {
                $this->db->transBegin();
                $search_filters['phone'] = $data_to_insert['phone'];
                $userHelperModel = new UserHelperModel();
                $count = $userHelperModel->verify_user_phone($search_filters);
                if ($count != 0)
                {
                    $this->db->transRollback();
                    $data_object['success'] = 0;
                    $message = 'Already an user registered with this phone, Please try with different phone';
                    $data_object['message'] = $message;
                }
                else
                {
                    $userModel = new UserModel();
                    $transaction_status = $userModel->create_user($data_to_insert);
                    if ($transaction_status['transaction_status'] == 0)
                    {
                        $this->db->transRollback();
                        $data_object['success'] = 0;
                        $message = 'Could not create user, Please try again';
                        $data_object['message'] = $message;
                    }
                    else
                    {
                        $this->db->transCommit();
                        $data_object['success'] = 1;
                        $message = 'User account created successfully';
                        $data_object['message'] = $message;
                        $data_object['redirect_url'] = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/login';
                    }
                }
            }
            catch (\Exception $ex)
            {
                $this->db->transRollback();
                $data_object['success'] = 0;
                $message = 'Could not create user, Please try again';
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
            $helperModel = new HelperModel();
            if (isset($params[2]) && $params[2] != "")
            {
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

            $gender_type_str = $helperModel->get_settings_value('gender_type');
            $gender_types = json_decode($gender_type_str);
            
            $this->page_data['page_class_name'] = 'contact-page';
            $this->page_data['page_name'] = 'register';
            $this->page_data['page_path'] = $this->page_data['view_files_path'];
            $this->page_data['page_title'] = 'Welcome';
            $this->page_data['menu_name'] = $this->page_data['menu_name'];
            echo view($this->page_data['controller_file_path'] . DIRECTORY_SEPARATOR . 'index', $this->page_data);
        }
    }

}
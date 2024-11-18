<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\AdminHelperModel;
use App\Models\UserModel;
use App\Models\HomeModel;
use App\Models\ProspectModel;
use App\Models\RegionModel;
use App\Models\UniversityModel;
use App\Models\ServiceModel;
use App\Models\HelperModel;
use App\Models\EducationLoanModel;

class User extends BaseController
{
    public $custom_site_url;
    public $controller_data = array();
    public $session;
    public $uri_segments = array();

    public function __construct()
    {
        $url = str_replace("http://", "https://", base_url());
        $this->custom_site_url = $url . '/';
        $this->controller_data['custom_site_url'] = $this->custom_site_url;
        $this->controller_data['controller'] = USER_URL;
        $request = \Config\Services::request();
        $this->uri_segments = $request->uri->getSegments();
        $this->session = session();
        $regionModel = new RegionModel();
        $serviceModel = new ServiceModel();
        $this->controller_data['g_user_type'] = $this->session->get('user_type');
        $this->controller_data['g_regions'] = $regionModel->get_regions_by_condition();
        $this->controller_data['g_services'] = $serviceModel->get_services_by_condition();
        $this->controller_data['g_user_id'] = session()->get('user_id');
    }

    public function index()
    {
        $this->controller_data['controller_file_path'] = 'user_index';
        $this->controller_data['view_files_path'] = 'user';
        $this->controller_data['menu_name'] = 'home';
        $homeModel = new HomeModel();
        $homeModel->viewHomePage($this->uri_segments, $this->controller_data);
    }

    public function profile()
    {
        $this->controller_data['controller_file_path'] = 'user_index';
        $this->controller_data['view_files_path'] = 'user';
        $this->controller_data['menu_name'] = 'profile';
        $userModel = new UserModel();
        $userModel->viewEditProfile($this->uri_segments, $this->controller_data);
    }



    /* Create Prospect */
    public function create_prospect()
    {
        $this->controller_data['controller_file_path'] = 'user_index';
        $this->controller_data['view_files_path'] = 'user';
        $this->controller_data['menu_name'] = 'contact';
        $prospectModel = new ProspectModel();
        $prospectModel->createProspect($this->uri_segments, $this->controller_data);
    }

    /* Region*/
    public function view_region()
    {
        $this->controller_data['controller_file_path'] = 'user_index';
        $this->controller_data['view_files_path'] = 'region';
        $this->controller_data['menu_name'] = 'view_region';
        $regionModel = new RegionModel();
        $regionModel->viewRegionUser($this->uri_segments, $this->controller_data);
    }
 
    /* Service*/
    public function view_service()
    {
        $this->controller_data['controller_file_path'] = 'user_index';
        $this->controller_data['view_files_path'] = 'service';
        $this->controller_data['menu_name'] = 'services';
        $serviceModel = new ServiceModel();
        $serviceModel->viewServiceUser($this->uri_segments, $this->controller_data);
    }

    /* University*/
    public function universities()
    {
        $this->controller_data['controller_file_path'] = 'user_index';
        $this->controller_data['view_files_path'] = 'university';
        $this->controller_data['menu_name'] = 'universities';
        $universityModel = new UniversityModel();
        $universityModel->viewUniversitiesUser($this->uri_segments, $this->controller_data);
    }

    /* University*/
    public function view_university()
    {
        $this->controller_data['controller_file_path'] = 'user_index';
        $this->controller_data['view_files_path'] = 'university';
        $this->controller_data['menu_name'] = 'universities';
        $universityModel = new UniversityModel();
        $universityModel->viewUniversityUser($this->uri_segments, $this->controller_data);
    }

    /* Education Loan*/
    public function view_loans()
    {
        $this->controller_data['controller_file_path'] = 'user_index';
        $this->controller_data['view_files_path'] = 'education_loan';
        $this->controller_data['menu_name'] = 'services';
        $educationLoanModel = new EducationLoanModel();
        $educationLoanModel->viewEducationLoanUser($this->uri_segments, $this->controller_data);
    }

    /* About page */
    public function about()
    {
        $this->controller_data['controller_file_path'] = 'user_index';
        $this->controller_data['view_files_path'] = 'user';
        $this->controller_data['menu_name'] = 'about';
        $homeModel = new HomeModel();
        $homeModel->about($this->uri_segments, $this->controller_data);
    }

    /* Contact page */
    public function contact()
    {
        $this->controller_data['controller_file_path'] = 'user_index';
        $this->controller_data['view_files_path'] = 'user';
        $this->controller_data['menu_name'] = 'contact';
        $homeModel = new HomeModel();
        $homeModel->contact($this->uri_segments, $this->controller_data);
    }

    /* AJAX REQUESTS */

    public function ajax_request($param1 = "", $param2 = "", $param3 = "")
    {
        if ($param1 == "prospect")
        {
            $prospectModel = new ProspectModel();
            $prospectModel->processProspectsAjax($this->uri_segments, $this->controller_data);
        }
        if ($param1 == "university")
        {
            $universityModel = new UniversityModel();
            $universityModel->processUniversitiesAjax($this->uri_segments, $this->controller_data);
        }
        if ($param1 == "user")
        {
            $userModel = new UserModel();
            $userModel->processUsersAjax($this->uri_segments, $this->controller_data);
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to($this->custom_site_url);
    }
}
?>
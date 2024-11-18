<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\UserModel;
use App\Models\HomeModel;
use App\Models\ProspectModel;
use App\Models\TestimonialModel;
use App\Models\RegionModel;
use App\Models\ServiceModel;
use App\Models\UniversityModel;
use App\Models\UniversityCourseModel;
use App\Models\HelperModel;

class Admin extends BaseController
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
        $this->controller_data['controller'] = ADMIN_URL;
        $request = \Config\Services::request();
        $this->uri_segments = $request->uri->getSegments();
        $this->session = session();
        $regionModel = new RegionModel();
        $serviceModel = new ServiceModel();
        $this->controller_data['g_user_type'] = $this->session->get('user_type');
        $this->controller_data['g_regions'] = $regionModel->get_regions_by_condition();
        $this->controller_data['g_services'] = $serviceModel->get_services_by_condition();
    }

    public function index()
    {
        return redirect()->to($this->custom_site_url . ADMIN_URL . "/dashboard");
    }
    /* Dashboard */

    public function dashboard()
    {
        $this->controller_data['controller_file_path'] = 'admin_index';
        $this->controller_data['view_files_path'] = 'dashboard';
        $this->controller_data['menu_name'] = 'dashboard';
        $adminModel = new AdminModel();
        $adminModel->dashboard($this->uri_segments, $this->controller_data);
    }

    public function view_edit_prospects()
    {
        $this->controller_data['controller_file_path'] = 'admin_index';
        $this->controller_data['view_files_path'] = 'prospect_a';
        $this->controller_data['menu_name'] = 'view_edit_prospects';
        $prospectModel = new ProspectModel();
        $prospectModel->viewEditProspects($this->uri_segments, $this->controller_data);
    }

    public function view_edit_testimonials()
    {
        $this->controller_data['controller_file_path'] = 'admin_index';
        $this->controller_data['view_files_path'] = 'testimonial_a';
        $this->controller_data['menu_name'] = 'view_edit_testimonials';
        $testimonialModel = new TestimonialModel();
        $testimonialModel->viewEditTestimonials($this->uri_segments, $this->controller_data);
    }

    public function create_user()
    {
        $this->controller_data['controller_file_path'] = 'admin_index';
        $this->controller_data['view_files_path'] = 'user_a';
        $this->controller_data['menu_name'] = 'create_user';
        $userModel = new UserModel();
        $userModel->createUser($this->uri_segments, $this->controller_data);
    }

    public function view_edit_users()
    {
        $this->controller_data['controller_file_path'] = 'admin_index';
        $this->controller_data['view_files_path'] = 'user_a';
        $this->controller_data['menu_name'] = 'view_edit_users';
        $userModel = new UserModel();
        $userModel->viewEditUsers($this->uri_segments, $this->controller_data);
    }

    public function deleted_users()
    {
        $this->controller_data['controller_file_path'] = 'admin_index';
        $this->controller_data['view_files_path'] = 'user_a';
        $this->controller_data['menu_name'] = 'deleted_users';
        $userModel = new UserModel();
        $userModel->deletedUsers($this->uri_segments, $this->controller_data);
    }

    public function view_edit_regions()
    {
        $this->controller_data['controller_file_path'] = 'admin_index';
        $this->controller_data['view_files_path'] = 'region_a';
        $this->controller_data['menu_name'] = 'view_edit_regions';
        $regionModel = new RegionModel();
        $regionModel->viewEditRegions($this->uri_segments, $this->controller_data);
    }

    public function view_edit_universities()
    {
        $this->controller_data['controller_file_path'] = 'admin_index';
        $this->controller_data['view_files_path'] = 'university_a';
        $this->controller_data['menu_name'] = 'view_edit_universities';
        $universityModel = new UniversityModel();
        $universityModel->viewEditUniversities($this->uri_segments, $this->controller_data);
    }

    public function view_edit_university_courses()
    {
        $this->controller_data['controller_file_path'] = 'admin_index';
        $this->controller_data['view_files_path'] = 'university_course_a';
        $this->controller_data['menu_name'] = 'view_edit_university_courses';
        $universityCourseModel = new UniversityCourseModel();
        $universityCourseModel->viewEditUniversityCourses($this->uri_segments, $this->controller_data);
    }

    /* AJAX REQUESTS */

    public function ajax_request($param1 = "", $param2 = "", $param3 = "")
    {
        if ($param1 == "prospect")
        {
            $prospectModel = new ProspectModel();
            $prospectModel->processProspectsAjax($this->uri_segments, $this->controller_data);
        }
        if ($param1 == "user")
        {
            $userModel = new UserModel();
            $userModel->processUsersAjax($this->uri_segments, $this->controller_data);
        }
        if ($param1 == "testimonial")
        {
            $testimonialModel = new TestimonialModel();
            $testimonialModel->processTestimonialsAjax($this->uri_segments, $this->controller_data);
        }
        if ($param1 == "region")
        {
            $regionModel = new RegionModel();
            $regionModel->processRegionsAjax($this->uri_segments, $this->controller_data);
        }
        if ($param1 == "university")
        {
            $universityModel = new UniversityModel();
            $universityModel->processUniversitiesAjax($this->uri_segments, $this->controller_data);
        }
        if ($param1 == "university_course")
        {
            $universityCourseModel = new UniversityCourseModel();
            $universityCourseModel->processUniversityCoursesAjax($this->uri_segments, $this->controller_data);
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to($this->custom_site_url);
    }
}
?>
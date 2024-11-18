<?php
namespace App\Models;
use CodeIgniter\Model;

class UniversityHelperModel extends Model
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

    /*** DATA HANDLER ***/

    function get_region_wise_universities_by_condition($obj = null)
    {
        $data_object = array();

        $regionModel = new RegionModel();
        $regions = $regionModel->get_regions_by_condition($obj);

        $universityModel = new UniversityModel();
        $universities = $universityModel->get_universities_by_condition($obj);

        foreach ($regions as $idx => $region) 
        {
            $rid = $region['region_id'];
            $data_object[$rid] = array(
                'region_name' => $region['region_name'],
                'shortcode' => $region['shortcode'],
                'universities' => array(),
                'no_of_universities' => 0
            );
        }

        foreach ($universities as $idx => $university) 
        {
            $rid = $university['region_id'];
            $uid = $university['university_id'];
            $data_object[$rid]['universities'][$uid] = $university;
        }

        return $data_object;
    }

}
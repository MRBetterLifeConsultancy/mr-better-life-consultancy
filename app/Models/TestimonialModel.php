<?php
namespace App\Models;
use CodeIgniter\Model;

class TestimonialModel extends Model
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

    function createTestimonial($params, $controller_data)
    {
        $this->page_data = array_merge($this->page_data, $controller_data);
        if (isset($params[1]) && $params[1] == "create_testimonial" && isset($params[2]) && $params[2] == "create")
        {
            $submittedData = $this->request->getPost("submittedData");
            $data_to_insert['user_id'] = $submittedData['user_id'];
            $data_to_insert['review'] = $submittedData['review'];
            $data_to_insert['no_of_stars'] = $submittedData['no_of_stars'];
            $data_to_insert['person_role'] = $submittedData['person_role'];
            $data_to_insert['is_anonymous'] = $submittedData['is_anonymous'];
            $now = date('Y-m-d H:i:s');
            $data_to_insert['created_on'] = $now;

            $message = "";
            try
            {
                $this->db->transBegin();
                $transaction_status = $this->create_testimonial($data_to_insert);
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
                    $data_object['redirect_url'] = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/create_testimonial';
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

            $this->page_data['page_name'] = 'contact';
            $this->page_data['page_path'] = $this->page_data['view_files_path'];
            $this->page_data['page_title'] = 'Contact Us';
            $this->page_data['menu_name'] = $this->page_data['menu_name'];
            echo view($this->page_data['controller_file_path'] . DIRECTORY_SEPARATOR . 'index', $this->page_data);
        }
    }

    function viewEditTestimonials($params, $controller_data)
    {
        $this->page_data = array_merge($this->page_data, $controller_data);
        if (isset($params[1]) && $params[1] == "view_edit_testimonials" && isset($params[2]) && $params[2] == "edit")
        {
            $submittedData = $this->request->getPost("submittedData");
            $testimonial_id = $submittedData['testimonial_id'];
            $data_to_update['user_id'] = $submittedData['user_id'];
            $data_to_update['no_of_stars'] = $submittedData['no_of_stars'];
            $data_to_update['person_role'] = $submittedData['person_role'];
            $data_to_update['review'] = $submittedData['review'];
            $data_to_update['is_anonymous'] = $submittedData['is_anonymous'];
            $now = date('Y-m-d H:i:s');
            $data_to_update['last_updated_on'] = $now;
            try
            {
                $this->db->transBegin();
                $transaction_status = $this->update_testimonial($data_to_update, $testimonial_id);
                if ($transaction_status['transaction_status'] == 0)
                {
                    $this->db->transRollback();
                    $data_object['success'] = 0;
                    $message = 'Could not update testimonial, Please try again';
                    $data_object['message'] = $message;
                }
                else
                {
                    $this->db->transCommit();
                    $data_object['success'] = 1;
                    $message = 'Testimonial updated successfully';
                    $data_object['message'] = $message;
                    $data_object['redirect_url'] = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/view_edit_testimonials';
                    $this->session->setFlashData('type', 'success');
                    $this->session->setFlashData('message', $message);
                }
            }
            catch (\Exception $ex)
            {
                $this->db->transRollback();
                $data_object['success'] = 0;
                $message = 'Could not update testimonial, Please try again';
                $data_object['message'] = $message;
                $data_object['error'] = $ex->getMessage();
            }
            finally
            {
                echo json_encode($data_object);
                exit;
            }
        }
        else if (isset($params[1]) && $params[1] == "view_edit_testimonials" && isset($params[2]) && $params[2] == "search")
        {
            $submittedData = $this->request->getPost("submittedData");
            $df = $submittedData['date_from'];
            $dt = $submittedData['date_to'];
            $user_id = $submittedData['user_id'];
            $no_of_stars = $submittedData['no_of_stars'];
            $offset = $submittedData['offset'];
            $is_anonymous = $submittedData['is_anonymous'];
            $data_object['success'] = 0;
            try
            {
                $redirect_url = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/view_edit_testimonials/offset=' . $offset
                        . "&user_id=" . $user_id . "&no_of_stars=" . $no_of_stars. "&is_anonymous=" . $is_anonymous. "&df=" . $df. "&dt=" . $dt;
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
            if (empty($this->page_data['df']))
            {
                $this->page_data['df'] = "";
            }
            if (empty($this->page_data['dt']))
            {
                $this->page_data['dt'] = "";
            }
            if (empty($this->page_data['user_id']))
            {
                $this->page_data['user_id'] = "";
            }
            if (empty($this->page_data['no_of_stars']))
            {
                $this->page_data['no_of_stars'] = "";
            }
            if (empty($this->page_data['limit']))
            {
                $this->page_data['limit'] = 100;
            }
            if (!isset($this->page_data['is_anonymous']))
            {
                $this->page_data['is_anonymous'] = -1;
            }
            if (empty($this->page_data['offset']))
            {
                $this->page_data['offset'] = 0;
            }
            $search_filters = array();
            $search_filters['status'] = 'active';
            $search_filters['user_id'] = $this->page_data['user_id'];
            $search_filters['no_of_stars'] = $this->page_data['no_of_stars'];
            $search_filters['is_anonymous'] = $this->page_data['is_anonymous'];
            $testimonialModel = new TestimonialModel();
            $search_filters['count'] = 1;
            $this->page_data['testimonials_count'] = $this->get_testimonials_by_condition($search_filters);
            if ($this->page_data["testimonials_count"] > 0 && $this->page_data["testimonials_count"] >= $this->page_data['offset'])
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
            $testimonials_list = $testimonialModel->get_testimonials_by_condition($search_filters);
            $this->page_data['testimonials'] = $testimonials_list;
            $this->page_data['page_name'] = 'view_edit_testimonials';
            $this->page_data['page_path'] = $this->page_data['view_files_path'];
            $this->page_data['page_title'] = 'Welcome';
            $this->page_data['menu_name'] = $this->page_data['menu_name'];
            echo view($this->page_data['controller_file_path'] . DIRECTORY_SEPARATOR . 'index', $this->page_data);
        }
    }

    /*** AJAX REQUESTS HANDLER ***/

    function processTestimonialsAjax($params, $controller_data)
    {
        $this->page_data = array_merge($this->page_data, $controller_data);
        if (isset($params[1]) && $params[1] == "ajax_request" && isset($params[2]) && $params[2] == "testimonial")
        {
            if (isset($params[3]) && $params[3] == "testimonials_list")
            {
                try
                {
                    $testimonials_list = $this->get_testimonials_by_condition();
                    $data_object['testimonials'] = $testimonials_list;
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
                $dataSearch['testimonial_id'] = $submittedData['testimonial_id'];
                try
                {
                    $testimonials_list = $this->get_testimonials_by_condition($dataSearch);
                    $data_object['testimonial'] = $testimonials_list;
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

    function get_testimonials_by_condition($obj = null)
    {
        $builder = $this->db->table('testimonial');
        if ($obj != null && isset($obj['testimonial_id']) && $obj['testimonial_id'] > 0)
        {
            $builder->where('testimonial.testimonial_id', $obj['testimonial_id']);
        }
        if ($obj != null && isset($obj['user_id']) && $obj['user_id'] > 0)
        {
            $builder->where('testimonial.user_id', $obj['user_id'], 'BOTH');
        }
        if ($obj != null && isset($obj['no_of_stars']))
        {
            $builder->like('testimonial.no_of_stars', $obj['no_of_stars'], 'BOTH');
        }
        if ($obj != null && isset($obj['is_anonymous']) && $obj['is_anonymous'] > -1)
        {
            $builder->like('testimonial.is_anonymous', $obj['is_anonymous']);
        }
        if ($obj != null && isset($obj['status']) && strlen($obj['status']) > 0)
        {
            $builder->where('testimonial.status', $obj['status']);
        }
        if ($obj != null && isset($obj['date_from']) && strlen($obj['date_from']) > 0)
        {
            $builder->where('DATE_FORMAT(testimonial.created_on,"%Y-%m-%d") >= ', $obj['date_from']);
        }
        if ($obj != null && isset($obj['date_to']) && strlen($obj['date_to']) > 0)
        {
            $builder->where('DATE_FORMAT(testimonial.created_on,"%Y-%m-%d") <= ', $obj['date_to']);
        }
        $builder->select('testimonial.*, CONCAT(users.first_name, " ", users.middle_name, " ", users.last_name) as user_name,  ');
        $builder->join('users', 'users.user_id = testimonial.user_id', 'LEFT');
        $builder->orderBy('testimonial.testimonial_id', 'DESC');
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

    function create_testimonial($data)
    {
        $data_object = NULL;
        $data_object['transaction_status'] = "0";
        try
        {
            if (isset($data))
            {
                $builder = $this->db->table('testimonial');
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

    function update_testimonial($data, $id, $user_id = null)
    {
        $data_object = NULL;
        $data_object['transaction_status'] = "0";
        try
        {
            if (isset($data))
            {
                $builder = $this->db->table('testimonial');
                $builder->where('testimonial.testimonial_id', $id);
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

    function delete_testimonial($id)
    {
        $data_object = NULL;
        $data_object['transaction_status'] = "0";
        try
        {
            if (isset($id))
            {
                $builder = $this->db->table('testimonial');
                $builder->where('testimonial.testimonial_id', $id);
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
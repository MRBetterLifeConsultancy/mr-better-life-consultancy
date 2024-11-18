<?php
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
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
    /*     * * REQUEST HANDLER ** */

    function createUser($params, $controller_data)
    {
        $this->page_data = array_merge($this->page_data, $controller_data);
        if (isset($params[1]) && $params[1] == "create_user" && isset($params[2]) && $params[2] == "create")
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
                $users = $this->get_users_by_condition($search_filters);
                if (count($users) != 0)
                {
                    $this->db->transRollback();
                    $data_object['success'] = 0;
                    $message = 'Already an user registered with this phone, Please try with different phone';
                    $data_object['message'] = $message;
                }
                else
                {
                    $transaction_status = $this->create_user($data_to_insert);
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
                        $data_object['redirect_url'] = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/create_user';
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

            $helperModel = new HelperModel();
            $gender_type_str = $helperModel->get_settings_value('gender_type');
            $gender_types = json_decode($gender_type_str);

            $this->page_data['gender_types'] = $gender_types;
            $this->page_data['page_name'] = 'create_user';
            $this->page_data['page_path'] = $this->page_data['view_files_path'];
            $this->page_data['page_title'] = 'Create User';
            $this->page_data['menu_name'] = $this->page_data['menu_name'];
            echo view($this->page_data['controller_file_path'] . DIRECTORY_SEPARATOR . 'index', $this->page_data);
        }
    }

    function viewEditUsers($params, $controller_data)
    {
        $this->page_data = array_merge($this->page_data, $controller_data);
        if (isset($params[1]) && $params[1] == "view_edit_users" && isset($params[2]) && $params[2] == "edit")
        {
            $user_id = $this->request->getPost('user_id');
            $user_details_id = $this->request->getPost('user_details_id');
            $data_to_update['first_name'] = $this->request->getPost('first_name');
            $data_to_update['middle_name'] = $this->request->getPost('middle_name');
            $data_to_update['last_name'] = $this->request->getPost('last_name');
            $data_to_update['gender'] = $this->request->getPost('gender');
            $data_to_update['date_of_birth'] = $this->request->getPost('date_of_birth');
            // $data_to_update['phone'] = $this->request->getPost('phone');
            $data_to_update['alternate_phone'] = $this->request->getPost('alternate_phone');
            $data_to_update['permanent_address'] = $this->request->getPost('permanent_address');
            $data_to_update['current_address'] = $this->request->getPost('current_address');
            $data_to_update['email'] = $this->request->getPost('email');
            $data_to_update['alternate_email'] = $this->request->getPost('alternate_email');

            $now = date('Y-m-d H:i:s');
            $data_to_update['last_updated_on'] = $now; 
            try
            {
                $count = 0;
                $this->db->transBegin();
                $transaction_status = $this->update_user($data_to_update, $user_id);
                if ($transaction_status['transaction_status'] == 0)
                {
                    $this->db->transRollback();
                    $data_object['success'] = 0;
                    $message = 'Could not update user, Please try again';
                    $data_object['message'] = $message;
                }
                else
                {
                    $this->db->transCommit();
                    $data_object['success'] = 1;
                    $message = 'User updated successfully';
                    $data_object['message'] = $message;
                    $this->session->setFlashData('type', 'success');
                    $this->session->setFlashData('message', $message);
                    $data_object['redirect_url'] = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/view_edit_users';
                }
            }
            catch (\Exception $ex)
            {
                $this->db->transRollback();
                $data_object['success'] = 0;
                $message = 'Could not update user, Please try again';
                $data_object['message'] = $message;
                $data_object['error'] = $ex->getMessage();
            }
            finally
            {
                echo json_encode($data_object);
                exit;
            }
        }
        if (isset($params[1]) && $params[1] == "view_edit_users" && isset($params[2]) && $params[2] == "edit_phone")
        {
            $submittedData = $this->request->getPost("submittedData");
            $user_id = $submittedData['user_id'];
            $data_to_update['phone'] = $submittedData['new_phone'];
            try
            {
                $count = 0;
                $userHelperModel = new UserHelperModel();
                $count = $userHelperModel->verify_user_phone($data_to_update);
                if ($count == 0)
                {
                    $this->db->db_debug = false;
                    $this->db->transBegin();
                    $result_object = $this->update_user($data_to_update, $user_id);
                    if ($result_object['transaction_status'] == "0")
                    {
                        $this->db->transRollback();
                        $data_object['success'] = 0;
                        $data_object['message'] = 'Could not update phone. Please try again';
                        $data_object['error'] = $result_object['error'];
                    }
                    else
                    {
                        $this->db->transCommit();
                        $data_object['success'] = 1;
                        $data_object['message'] = 'Phone number updated successfully';
                        $data_object['redirect_url'] = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/view_edit_users';
                        //SYNC DATA to TRACKER APP
                        $userHelperModel = new UserHelperModel();
                        $sync_result = $userHelperModel->sync_user_data($user_id);
                        if ($sync_result['success'] == 0)
                        {
                            $message .= ' Unable to sync User data to tracker app';
                            $data_object['message'] = $message;
                        }
                    }
                }
                else
                {
                    $data_object['success'] = 0;
                    $data_object['message'] = 'Phone number already present. Please try with another phone number';
                }
            }
            catch (Exception $ex)
            {
                $this->db->transRollback();
                $data_object['success'] = 0;
                $data_object['message'] = 'Could not update phone. Please try again';
                $data_object['error'] = $ex->getMessage();
            }
            finally
            {
                echo json_encode($data_object);
                exit;
            }
        }
        if (isset($params[1]) && $params[1] == "view_edit_users" && isset($params[2]) && $params[2] == "edit_profile_picture")
        {
            try
            {
                $profilePicturesDir = 'uploads' . DIRECTORY_SEPARATOR . 'user_files' . DIRECTORY_SEPARATOR;
                if (file_exists($profilePicturesDir))
                {
                    //directory exists
                }
                else
                {
                    //directory doesnt exist, so creating it
                    mkdir($profilePicturesDir);
                }
                // Uploading user profile picture and updating its filepath in user table
                $fileName = "";
                $filePathName = "";
                $uploadStatus = 0;
                $uploadDir = 'uploads' . DIRECTORY_SEPARATOR . 'user_files' . DIRECTORY_SEPARATOR . $user_id . DIRECTORY_SEPARATOR;
                if (file_exists($uploadDir))
                {
                    //directory exists
                }
                else
                {
                    //directory doesnt exist, so creating it
                    mkdir($uploadDir);
                }
                $uploadedFile = '';
                $targetFilePath = "";
                if (!empty($_FILES["profile_picture"]["name"]))
                {
                    // File path config 
                    $fileName = basename($_FILES["profile_picture"]["name"]);
                    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
                    $targetFilePath = $uploadDir . $user_id . "." . $fileType;
                    $data_to_update_3['profile_picture'] = $user_id . "." . $fileType;
                    // Allow certain file formats 
                    $allowTypes = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                    if (in_array($fileType, $allowTypes))
                    {
                        // Upload file to the server 
                        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $targetFilePath))
                        {
                            $result_object1 = $this->update_user($data_to_update_3, $user_id);
                            if ($result_object1['transaction_status'] == "0")
                            {
                                $this->db->transRollback();
                                $data_object['success'] = 0;
                                $message .= ' Could not add profile picture to user.';
                                $data_object['message'] = $message;
                            }
                        }
                        else
                        {
                            $this->db->transRollback();
                            $data_object['success'] = 0;
                            $message .= 'Sorry, error uploading profile picture.';
                            $data_object['message'] = $message;
                        }
                    }
                    else
                    {
                        $this->db->transRollback();
                        $data_object['success'] = 0;
                        $message .= 'Sorry, only image files are allowed to upload as profile picture.';
                        $data_object['message'] = $message;
                    }
                }

                $this->db->transCommit();
                $data_object['success'] = 1;
                $message = 'User profile picture updated successfully';
                $data_object['message'] = $message;
                $this->session->setFlashData('type', 'success');
                $this->session->setFlashData('message', $message);
                $data_object['redirect_url'] = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/view_edit_users';
            }
            catch (\Exception $ex)
            {
                $this->db->transRollback();
                $data_object['success'] = 0;
                $message = 'Could not update user, Please try again';
                $data_object['message'] = $message;
            }
            finally
            {
                echo json_encode($data_object);
                exit;
            }

        }
        if (isset($params[1]) && $params[1] == "view_edit_users" && isset($params[2]) && $params[2] == "delete_profile_picture")
        {
            $submittedData = $this->request->getPost("submittedData");
            $user_id = $submittedData['user_id'];
            $data_to_update['profile_picture'] = "";
            $now = date('Y-m-d H:i:s');
            $data_to_update['last_updated_on'] = $now;
            try
            {
                $this->db->transBegin();
                $transaction_status = $this->update_user($data_to_update, $user_id);
                if ($transaction_status['transaction_status'] == 0)
                {
                    $this->db->transRollback();
                    $data_object['success'] = 0;
                    $message = 'Could not delete user profile picture, Please try again';
                    $data_object['message'] = $message;
                }
                else
                {
                    $this->db->transCommit();
                    $data_object['success'] = 1;
                    $message = 'User profile picture deleted successfully';
                    $data_object['message'] = $message;
                    $this->session->setFlashData('type', 'success');
                    $this->session->setFlashData('message', $message);
                    $data_object['redirect_url'] = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/view_edit_users';
                }
            }
            catch (\Exception $ex)
            {
                $this->db->transRollback();
                $data_object['success'] = 0;
                $message = 'Could not deleted user profile picture, Please try again';
                $data_object['message'] = $message;
                $data_object['error'] = $ex->getMessage();
            }
            finally
            {
                echo json_encode($data_object);
                exit;
            }
        }
        if (isset($params[1]) && $params[1] == "view_edit_users" && isset($params[2]) && $params[2] == "delete")
        {
            $submittedData = $this->request->getPost("submittedData");
            $user_id = $submittedData['user_id'];
            $data_to_update['status'] = "deleted";
            $now = date('Y-m-d H:i:s');
            $data_to_update['last_updated_on'] = $now;
            try
            {
                $this->db->transBegin();
                $transaction_status = $this->update_user($data_to_update, $user_id);
                if ($transaction_status['transaction_status'] == 0)
                {
                    $this->db->transRollback();
                    $data_object['success'] = 0;
                    $message = 'Could not delete user, Please try again';
                    $data_object['message'] = $message;
                }
                else
                {
                    $this->db->transCommit();
                    $data_object['success'] = 1;
                    $message = 'User deleted successfully';
                    $data_object['message'] = $message;
                    $this->session->setFlashData('type', 'success');
                    $this->session->setFlashData('message', $message);
                    $data_object['redirect_url'] = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/view_edit_users';
                    //SYNC DATA to TRACKER APP
                    $userHelperModel = new UserHelperModel();
                    $sync_result = $userHelperModel->sync_user_data($user_id);
                    if ($sync_result['success'] == 0)
                    {
                        $message .= ' Unable to sync User data to tracker app';
                        $data_object['message'] = $message;
                    }
                }
            }
            catch (\Exception $ex)
            {
                $this->db->transRollback();
                $data_object['success'] = 0;
                $message = 'Could not deleted user, Please try again';
                $data_object['message'] = $message;
                $data_object['error'] = $ex->getMessage();
            }
            finally
            {
                echo json_encode($data_object);
                exit;
            }
        }
        if (isset($params[1]) && $params[1] == "view_edit_users" && isset($params[2]) && $params[2] == "deactivate")
        {
            $submittedData = $this->request->getPost("submittedData");
            $user_id = $submittedData['user_id'];
            $data_to_update['is_active'] = 0;
            $now = date('Y-m-d H:i:s');
            $data_to_update['last_updated_on'] = $now;
            try
            {
                $this->db->transBegin();
                $transaction_status = $this->update_user($data_to_update, $user_id);
                if ($transaction_status['transaction_status'] == 0)
                {
                    $this->db->transRollback();
                    $data_object['success'] = 0;
                    $message = 'Could not de-activate user, Please try again';
                    $data_object['message'] = $message;
                }
                else
                {
                    $this->db->transCommit();
                    $data_object['success'] = 1;
                    $message = 'User deactivated successfully';
                    $data_object['message'] = $message;
                    $this->session->setFlashData('type', 'success');
                    $this->session->setFlashData('message', $message);
                    $data_object['redirect_url'] = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/view_edit_users';
                    //SYNC DATA to TRACKER APP
                    $userHelperModel = new UserHelperModel();
                    $sync_result = $userHelperModel->sync_user_data($user_id);
                    if ($sync_result['success'] == 0)
                    {
                        $message .= ' Unable to sync User data to tracker app';
                        $data_object['message'] = $message;
                    }
                }
            }
            catch (\Exception $ex)
            {
                $this->db->transRollback();
                $data_object['success'] = 0;
                $message = 'Could not deactivate user, Please try again';
                $data_object['message'] = $message;
                $data_object['error'] = $ex->getMessage();
            }
            finally
            {
                echo json_encode($data_object);
                exit;
            }
        }
        if (isset($params[1]) && $params[1] == "view_edit_users" && isset($params[2]) && $params[2] == "activate")
        {
            $submittedData = $this->request->getPost("submittedData");
            $user_id = $submittedData['user_id'];
            $data_to_update['is_active'] = 1;
            $now = date('Y-m-d H:i:s');
            $data_to_update['last_updated_on'] = $now;
            try
            {
                $this->db->transBegin();
                $transaction_status = $this->update_user($data_to_update, $user_id);
                if ($transaction_status['transaction_status'] == 0)
                {
                    $this->db->transRollback();
                    $data_object['success'] = 0;
                    $message = 'Could not activate user, Please try again';
                    $data_object['message'] = $message;
                }
                else
                {
                    $this->db->transCommit();
                    $data_object['success'] = 1;
                    $message = 'User activated successfully';
                    $data_object['message'] = $message;
                    $this->session->setFlashData('type', 'success');
                    $this->session->setFlashData('message', $message);
                    $data_object['redirect_url'] = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/view_edit_users';
                    //SYNC DATA to TRACKER APP
                    $userHelperModel = new UserHelperModel();
                    $sync_result = $userHelperModel->sync_user_data($user_id);
                    if ($sync_result['success'] == 0)
                    {
                        $message .= ' Unable to sync User data to tracker app';
                        $data_object['message'] = $message;
                    }
                }
            }
            catch (\Exception $ex)
            {
                $this->db->transRollback();
                $data_object['success'] = 0;
                $message = 'Could not activate user, Please try again';
                $data_object['message'] = $message;
                $data_object['error'] = $ex->getMessage();
            }
            finally
            {
                echo json_encode($data_object);
                exit;
            }
        }
        if (isset($params[1]) && $params[1] == "view_edit_users" && isset($params[2]) && $params[2] == "enable_profile_lock")
        {
            $submittedData = $this->request->getPost("submittedData");
            $user_id = $submittedData['user_id'];
            $data_to_update['profile_lock'] = 1;
            $now = date('Y-m-d H:i:s');
            $data_to_update['last_updated_on'] = $now;
            try
            {
                $this->db->transBegin();
                $transaction_status = $this->update_user($data_to_update, $user_id);
                if ($transaction_status['transaction_status'] == 0)
                {
                    $this->db->transRollback();
                    $data_object['success'] = 0;
                    $message = 'Could not enable user profile lock, Please try again';
                    $data_object['message'] = $message;
                }
                else
                {
                    $this->db->transCommit();
                    $data_object['success'] = 1;
                    $message = 'User profile lock enabled successfully';
                    $data_object['message'] = $message;
                    $this->session->setFlashData('type', 'success');
                    $this->session->setFlashData('message', $message);
                    $data_object['redirect_url'] = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/view_edit_users';
                    //SYNC DATA to TRACKER APP
                    $userHelperModel = new UserHelperModel();
                    $sync_result = $userHelperModel->sync_user_data($user_id);
                    if ($sync_result['success'] == 0)
                    {
                        $message .= ' Unable to sync User data to tracker app';
                        $data_object['message'] = $message;
                    }
                }
            }
            catch (\Exception $ex)
            {
                $this->db->transRollback();
                $data_object['success'] = 0;
                $message = 'Could not enable user profile lock, Please try again';
                $data_object['message'] = $message;
                $data_object['error'] = $ex->getMessage();
            }
            finally
            {
                echo json_encode($data_object);
                exit;
            }
        }
        if (isset($params[1]) && $params[1] == "view_edit_users" && isset($params[2]) && $params[2] == "disable_profile_lock")
        {
            $submittedData = $this->request->getPost("submittedData");
            $user_id = $submittedData['user_id'];
            $data_to_update['profile_lock'] = 0;
            $now = date('Y-m-d H:i:s');
            $data_to_update['last_updated_on'] = $now;
            try
            {
                $this->db->transBegin();
                $transaction_status = $this->update_user($data_to_update, $user_id);
                if ($transaction_status['transaction_status'] == 0)
                {
                    $this->db->transRollback();
                    $data_object['success'] = 0;
                    $message = 'Could not disable user profile lock, Please try again';
                    $data_object['message'] = $message;
                }
                else
                {
                    $this->db->transCommit();
                    $data_object['success'] = 1;
                    $message = 'User profile lock disabled successfully';
                    $data_object['message'] = $message;
                    $this->session->setFlashData('type', 'success');
                    $this->session->setFlashData('message', $message);
                    $data_object['redirect_url'] = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/view_edit_users';
                    //SYNC DATA to TRACKER APP
                    $userHelperModel = new UserHelperModel();
                    $sync_result = $userHelperModel->sync_user_data($user_id);
                    if ($sync_result['success'] == 0)
                    {
                        $message .= ' Unable to sync User data to tracker app';
                        $data_object['message'] = $message;
                    }
                }
            }
            catch (\Exception $ex)
            {
                $this->db->transRollback();
                $data_object['success'] = 0;
                $message = 'Could not disable user profile lock, Please try again';
                $data_object['message'] = $message;
                $data_object['error'] = $ex->getMessage();
            }
            finally
            {
                echo json_encode($data_object);
                exit;
            }
        }
        if (isset($params[1]) && $params[1] == "view_edit_users" && isset($params[2]) && $params[2] == "sync_user")
        {
            $submittedData = $this->request->getPost("submittedData");
            $user_id = $submittedData['user_id'];
            try
            {
                //SYNC DATA to TRACKER APP
                $userHelperModel = new UserHelperModel();
                $sync_result = $userHelperModel->sync_user_data($user_id);
                if ($sync_result['success'] == 0)
                {
                    $message = 'Unable to sync User data to tracker app';
                    $data_object['message'] = $message;
                    $data_object['success'] = 0;
                }
                else
                {
                    $data_object['success'] = 1;
                    $data_object['message'] = 'User data synched successfully';
                }
            }
            catch (Exception $ex)
            {
                $this->db->transRollback();
                $data_object['success'] = 0;
                $data_object['message'] = 'Unable to sync User data to tracker app. Please try again';
                $data_object['error'] = $ex->getMessage();
            }
            finally
            {
                echo json_encode($data_object);
                exit;
            }
        }
        else if (isset($params[1]) && $params[1] == "view_edit_users" && isset($params[2]) && $params[2] == "search")
        {
            $submittedData = $this->request->getPost("submittedData");
            $f_name = $submittedData['first_name'];
            $l_name = $submittedData['last_name'];
            $phone = $submittedData['phone'];
            $email = $submittedData['email'];
            $offset = $submittedData['offset'];
            $df = $submittedData['date_from'];
            $dt = $submittedData['date_to'];
            $is_active = $submittedData['is_active'];
            $view_type = $submittedData['view_type'];
            $data_object['success'] = 0;
            try
            {
                $redirect_url = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/view_edit_users/offset=' . $offset . '&df=' . $df . '&dt=' . $dt. "&fname=" . $f_name . "&lname=" . $l_name . "&email=" . $email . "&phone=" . $phone . "&is_active=" . $is_active . "&view_type=" . $view_type;
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
            if (empty($this->page_data['df']))
            {
                $this->page_data['df'] = "";
            }
            if (empty($this->page_data['dt']))
            {
                $this->page_data['dt'] = "";
            }
            if (empty($this->page_data['fname']))
            {
                $this->page_data['fname'] = "";
            }
            if (empty($this->page_data['lname']))
            {
                $this->page_data['lname'] = "";
            }
            if (empty($this->page_data['email']))
            {
                $this->page_data['email'] = "";
            }
            if (empty($this->page_data['phone']))
            {
                $this->page_data['phone'] = "";
            }
            if (empty($this->page_data['limit']))
            {
                $this->page_data['limit'] = 100;
            }
            if (empty($this->page_data['offset']))
            {
                $this->page_data['offset'] = 0;
            }
            if (!isset($this->page_data['is_active']))
            {
                $this->page_data['is_active'] = -1;
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
            $search_filters = array();
            $search_filters['status'] = 'active';
            $search_filters['first_name'] = $this->page_data['fname'];
            $search_filters['last_name'] = $this->page_data['lname'];
            $search_filters['email'] = $this->page_data['email'];
            $search_filters['phone'] = $this->page_data['phone'];
            $search_filters['is_active'] = $this->page_data['is_active'];
            
            $userModel = new UserModel();
            $search_filters['count'] = 1;
            $this->page_data['users_count'] = $userModel->get_users_by_condition($search_filters);
            if ($this->page_data["users_count"] > 0 && $this->page_data["users_count"] >= $this->page_data['offset'])
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
            $users_list = $userModel->get_users_by_condition($search_filters);

            $this->page_data['users'] = $users_list;
            $this->page_data['page_name'] = 'view_edit_users';
            $this->page_data['page_path'] = $this->page_data['view_files_path'];
            $this->page_data['page_title'] = 'View Edit Users';
            $this->page_data['menu_name'] = $this->page_data['menu_name'];
            echo view($this->page_data['controller_file_path'] . DIRECTORY_SEPARATOR . 'index', $this->page_data);
        }
    }

    function deletedUsers($params, $controller_data)
    {
        $this->page_data = array_merge($this->page_data, $controller_data);
        if (isset($params[1]) && $params[1] == "deleted_users" && isset($params[2]) && $params[2] == "restore")
        {
            $submittedData = $this->request->getPost("submittedData");
            $user_id = $submittedData['user_id'];
            $data_to_update['status'] = "active";
            $now = date('Y-m-d H:i:s');
            $data_to_update['last_updated_on'] = $now;
            try
            {
                $this->db->transBegin();
                $transaction_status = $this->update_user($data_to_update, $user_id);
                if ($transaction_status['transaction_status'] == 0)
                {
                    $this->db->transRollback();
                    $data_object['success'] = 0;
                    $message = 'Could not restore user, Please try again';
                    $data_object['message'] = $message;
                }
                else
                {
                    $this->db->transCommit();
                    $data_object['success'] = 1;
                    $message = 'User restored successfully';
                    $data_object['message'] = $message;
                    $this->session->setFlashData('type', 'success');
                    $this->session->setFlashData('message', $message);
                    $data_object['redirect_url'] = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/view_edit_users';
                }
            }
            catch (\Exception $ex)
            {
                $this->db->transRollback();
                $data_object['success'] = 0;
                $message = 'Could not restore user, Please try again';
                $data_object['message'] = $message;
                $data_object['error'] = $ex->getMessage();
            }
            finally
            {
                echo json_encode($data_object);
                exit;
            }
        }
        else if (isset($params[1]) && $params[1] == "deleted_users" && isset($params[2]) && $params[2] == "search")
        {
            $submittedData = $this->request->getPost("submittedData");
            $f_name = $submittedData['first_name'];
            $l_name = $submittedData['last_name'];
            $phone = $submittedData['phone'];
            $email = $submittedData['email'];
            $offset = $submittedData['offset'];
            $df = $submittedData['date_from'];
            $dt = $submittedData['date_to'];
            $view_type = $submittedData['view_type'];
            $data_object['success'] = 0;
            try
            {
                $redirect_url = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/deleted_users/offset=' . $offset . '&df=' . $df. '&dt=' . $dt . "&fname=" . $f_name . "&lname=" . $l_name . "&email=" . $email . "&phone=" . $phone . "&view_type=" . $view_type;
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
            if (empty($this->page_data['fname']))
            {
                $this->page_data['fname'] = "";
            }
            if (empty($this->page_data['lname']))
            {
                $this->page_data['lname'] = "";
            }
            if (empty($this->page_data['email']))
            {
                $this->page_data['email'] = "";
            }
            if (empty($this->page_data['phone']))
            {
                $this->page_data['phone'] = "";
            }
            if (empty($this->page_data['limit']))
            {
                $this->page_data['limit'] = 100;
            }
            if (empty($this->page_data['offset']))
            {
                $this->page_data['offset'] = 0;
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
            $search_filters = array();
            $search_filters['status'] = 'deleted';
            $search_filters['first_name'] = $this->page_data['fname'];
            $search_filters['last_name'] = $this->page_data['lname'];
            $search_filters['email'] = $this->page_data['email'];
            $search_filters['phone'] = $this->page_data['phone'];
            $userModel = new UserModel();
            $search_filters['count'] = 1;
            $this->page_data['users_count'] = $userModel->get_users_by_condition($search_filters);
            if ($this->page_data["users_count"] > 0 && $this->page_data["users_count"] >= $this->page_data['offset'])
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
            $users_list = $userModel->get_users_by_condition($search_filters);

            $this->page_data['users'] = $users_list;
            $this->page_data['page_name'] = 'deleted_users';
            $this->page_data['page_path'] = $this->page_data['view_files_path'];
            $this->page_data['page_title'] = 'Deleted Users';
            $this->page_data['menu_name'] = $this->page_data['menu_name'];
            echo view($this->page_data['controller_file_path'] . DIRECTORY_SEPARATOR . 'index', $this->page_data);
        }
    }

    function login($params, $controller_data)
    {
        $this->page_data = array_merge($this->page_data, $controller_data);
        if (isset($params[1]) && $params[1] == "login" && isset($params[2]) && $params[2] == "sign_in")
        {
            $submittedData = $this->request->getPost("submittedData");
            $data_to_insert['phone'] = $submittedData['phone'];
            $data_to_insert['password'] = $submittedData['password'];
            try
            {
                $this->db->transBegin();
                $result_object = $this->get_users_by_condition($data_to_insert);
                $count = count($result_object);
                if ($count == 0)
                {
                    $this->db->transRollback();
                    $data_object['success'] = 0;
                    $data_object['message'] = 'No user exists with this phone';
                }
                else if ($count > 1)
                {
                    $this->db->transRollback();
                    $data_object['success'] = 0;
                    $data_object['message'] = 'Multiple user exists with this phone';
                }
                else
                {
                    $userHelperModel = new UserHelperModel();
                    $result = $userHelperModel->verify_user_status($result_object[0]);
                    if ($result == false)
                    {
                        $this->db->transRollback();
                        $data_object['success'] = 0;
                        $data_object['message'] = 'Your account is freezed. Please contact admin';
                    }
                    else
                    {
                        $userHelperModel = new UserHelperModel();
                        $result = $userHelperModel->verify_user_password($data_to_insert, $result_object[0]);
                        if ($result == false)
                        {
                            $this->db->transRollback();
                            $data_object['success'] = 0;
                            $data_object['message'] = 'Incorrect password';
                        }
                        else
                        {
                            $helperModel = new HelperModel();
                            $helperModel->set_user_session_data($result_object[0], "user");
                            $this->db->transCommit();
                            $data_object['success'] = 1;
                            $data_object['message'] = "User authentication successfully.";
                            $data_object['redirect_url'] = $this->page_data['custom_site_url'] . USER_URL . '/home';
                        }
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

            $this->page_data['page_class_name'] = 'about-page';
            $this->page_data['page_name'] = 'login';
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
        $search_filters['user_id'] = $this->page_data['g_user_id'];
        $this->page_data['page_name'] = 'user';
        $this->page_data['page_path'] = $this->page_data['view_files_path'];
        $this->page_data['page_title'] = 'Dashboard';
        $this->page_data['menu_name'] = $this->page_data['menu_name'];
        echo view($this->page_data['controller_file_path'] . DIRECTORY_SEPARATOR . 'index', $this->page_data);
    }

    function viewEditProfile($params, $controller_data)
    {
        $this->page_data = array_merge($this->page_data, $controller_data);
        if (isset($params[2]) && $params[2] == "edit")
        {
            $submittedData = $this->request->getPost('submittedData');
            $user_id = $submittedData['user_id'];
            $data_to_update['first_name'] = $submittedData['first_name'];
            $data_to_update['middle_name'] = $submittedData['middle_name'];
            $data_to_update['last_name'] = $submittedData['last_name'];
            $data_to_update['gender'] = $submittedData['gender'];
            $data_to_update['date_of_birth'] = $submittedData['date_of_birth'];
            $data_to_update['email'] = $submittedData['email'];
            $now = date('Y-m-d H:i:s');
            $data_to_update['last_updated_on'] = $now;

            try
            {
                $count = 0;
                $this->db->transBegin();
                $transaction_status = $this->update_user($data_to_update, $user_id);
                if ($transaction_status['transaction_status'] == 0)
                {
                    $this->db->transRollback();
                    $data_object['success'] = 0;
                    $message = 'Could not update profile, Please try again';
                    $data_object['message'] = $message;
                }
                else
                {
                    $this->db->transCommit();
                    $data_object['success'] = 1;
                    $message = 'Profile updated successfully';
                    $data_object['message'] = $message;
                    $data_object['redirect_url'] = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/profile';
                }
            }
            catch (\Exception $ex)
            {
                $this->db->transRollback();
                $data_object['success'] = 0;
                $message = 'Could not update profile, Please try again';
                $data_object['message'] = $message;
                $data_object['error'] = $ex->getMessage();
            }
            finally
            {
                echo json_encode($data_object);
                exit;
            }
        }
        if (isset($params[2]) && $params[2] == "profile")
        {
            $submittedData = $this->request->getPost("submittedData");
            $user_id = $submittedData['user_id'];
            $data_to_insert['first_name'] = $submittedData['first_name'];
            $data_to_insert['last_name'] = $submittedData['last_name'];
            $data_to_insert['email'] = $submittedData['email'];
            //
            try
            {
                $this->db->db_debug = false;
                $this->db->transBegin();
                $result_object = $this->update_user($data_to_insert, $user_id);
                if ($result_object['transaction_status'] == "0")
                {
                    $this->db->transRollback();
                    $data_object['success'] = 0;
                    $data_object['message'] = 'Could not update profile. Please try again';
                    $data_object['error'] = $result_object['error'];
                }
                else
                {
                    $this->db->transCommit();
                    $data_object['success'] = 1;
                    $data_object['message'] = 'Profile updated successfully';
                    $data_object['redirect_url'] = $this->page_data['custom_site_url'] . USER_URL . '/view_edit_profile';
                }
            }
            catch (Exception $ex)
            {
                $this->db->transRollback();
                $data_object['success'] = 0;
                $data_object['message'] = 'Could not update profile. Please try again';
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
            $user_id = $submittedData['user_id'];
            $data_to_insert['password'] = $submittedData['current_password'];
            // $data_to_insert['password'] = $submittedData['confirm_password'];
            //
            try
            {
                $userHelperModel = new UserHelperModel();
                $count = $userHelperModel->verify_user_password1($data_to_insert, $user_id);
                if ($count == 1)
                {
                    $data_to_insert['password'] = $submittedData['confirm_password'];
                    $this->db->db_debug = false;
                    $this->db->transBegin();
                    $result_object = $this->update_user($data_to_insert, $user_id);
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
                        $data_object['message'] = 'Password updated successfully';
                        $data_object['redirect_url'] = $this->page_data['custom_site_url'] . USER_URL . '/view_edit_profile';
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
        else if (isset($params[2]) && $params[2] == "edit_phone")
        {
            $submittedData = $this->request->getPost("submittedData");
            $user_id = $submittedData['user_id'];
            $data_to_insert['phone'] = $submittedData['new_phone'];
            try
            {
                $userHelperModel = new UserHelperModel();
                $count = $userHelperModel->verify_user_phone($data_to_insert);
                //if count == 0 then update_user
                //else return success 0
                if ($count == 0)
                {
                    $this->db->db_debug = false;
                    $this->db->transBegin();
                    $result_object = $this->update_user($data_to_insert, $user_id);
                    if ($result_object['transaction_status'] == "0")
                    {
                        $this->db->transRollback();
                        $data_object['success'] = 0;
                        $data_object['message'] = 'Could not update phone number. Please try again';
                        $data_object['error'] = $result_object['error'];
                    }
                    else
                    {
                        $this->db->transCommit();
                        $data_object['success'] = 1;
                        $data_object['redirect_url'] = $this->page_data['custom_site_url'] . USER_URL . '/view_edit_profile';
                    }
                }
                else
                {
                    $data_object['success'] = 0;
                    $data_object['message'] = 'Phone number already present. Please try with another phone no';
                }
            }
            catch (Exception $ex)
            {
                $this->db->transRollback();
                $data_object['success'] = 0;
                $data_object['message'] = 'Could not update phone number. Please try again';
                $data_object['error'] = $ex->getMessage();
            }
            finally
            {
                echo json_encode($data_object);
                exit;
            }
        }
        if (isset($params[2]) && $params[2] == "edit_profile_picture")
        {
            try
            {
                $user_id = $this->request->getPost('user_id');
                $profilePicturesDir = 'uploads' . DIRECTORY_SEPARATOR . 'user_files' . DIRECTORY_SEPARATOR;
                if (file_exists($profilePicturesDir))
                {
                    //directory exists
                }
                else
                {
                    //directory doesnt exist, so creating it
                    mkdir($profilePicturesDir);
                }
                // Uploading user profile picture and updating its filepath in user table
                $fileName = "";
                $filePathName = "";
                $uploadStatus = 0;
                $uploadDir = 'uploads' . DIRECTORY_SEPARATOR . 'user_files' . DIRECTORY_SEPARATOR . $user_id . DIRECTORY_SEPARATOR;
                if (file_exists($uploadDir))
                {
                    //directory exists
                }
                else
                {
                    //directory doesnt exist, so creating it
                    mkdir($uploadDir);
                }
                $uploadedFile = '';
                $targetFilePath = "";
                if (!empty($_FILES["profile_picture"]["name"]))
                {
                    // File path config 
                    $fileName = basename($_FILES["profile_picture"]["name"]);
                    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
                    $targetFilePath = $uploadDir . $user_id . "." . $fileType;
                    $data_to_update_3['profile_picture'] = $user_id . "." . $fileType;
                    // Allow certain file formats 
                    $allowTypes = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
                    if (in_array($fileType, $allowTypes))
                    {
                        // Upload file to the server 
                        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $targetFilePath))
                        {
                            $result_object1 = $this->update_user($data_to_update_3, $user_id);
                            if ($result_object1['transaction_status'] == "0")
                            {
                                $this->db->transRollback();
                                $data_object['success'] = 0;
                                $message .= ' Could not add profile picture to user.';
                                $data_object['message'] = $message;
                            }
                        }
                        else
                        {
                            $this->db->transRollback();
                            $data_object['success'] = 0;
                            $message .= 'Sorry, error uploading profile picture.';
                            $data_object['message'] = $message;
                        }
                    }
                    else
                    {
                        $this->db->transRollback();
                        $data_object['success'] = 0;
                        $message .= 'Sorry, only image files are allowed to upload as profile picture.';
                        $data_object['message'] = $message;
                    }
                }

                $this->db->transCommit();
                $data_object['success'] = 1;
                $message = 'User profile picture updated successfully';
                $data_object['message'] = $message;
                $this->session->setFlashData('type', 'success');
                $this->session->setFlashData('message', $message);
                $data_object['redirect_url'] = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/view_edit_users';
            }
            catch (\Exception $ex)
            {
                $this->db->transRollback();
                $data_object['success'] = 0;
                $message = 'Could not update user, Please try again';
                $data_object['message'] = $message;
            }
            finally
            {
                echo json_encode($data_object);
                exit;
            }

        }
        if (isset($params[2]) && $params[2] == "delete_profile_picture")
        {
            $submittedData = $this->request->getPost("submittedData");
            $user_id = $submittedData['user_id'];
            $data_to_update['profile_picture'] = "";
            $now = date('Y-m-d H:i:s');
            $data_to_update['last_updated_on'] = $now;
            try
            {
                $this->db->transBegin();
                $transaction_status = $this->update_user($data_to_update, $user_id);
                if ($transaction_status['transaction_status'] == 0)
                {
                    $this->db->transRollback();
                    $data_object['success'] = 0;
                    $message = 'Could not delete user profile picture, Please try again';
                    $data_object['message'] = $message;
                }
                else
                {
                    $this->db->transCommit();
                    $data_object['success'] = 1;
                    $message = 'User profile picture deleted successfully';
                    $data_object['message'] = $message;
                    $this->session->setFlashData('type', 'success');
                    $this->session->setFlashData('message', $message);
                    $data_object['redirect_url'] = $this->page_data['custom_site_url'] . $this->page_data['controller'] . '/view_edit_users';
                }
            }
            catch (\Exception $ex)
            {
                $this->db->transRollback();
                $data_object['success'] = 0;
                $message = 'Could not deleted user profile picture, Please try again';
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
            
            $this->page_data['page_class_name'] = 'about-page';
            $this->page_data['page_name'] = "profile";
            $this->page_data['page_path'] = $this->page_data['view_files_path'];
            $this->page_data['menu_name'] = "profile";
            $this->page_data['title'] = ucwords(strtolower("User profile"));
            $this->page_data['page_title'] = 'profile';

            $search_filters = array();
            $search_filters["user_id"] = $this->page_data["g_user_id"];
            $this->page_data["user_data"] = $this->get_users_by_condition($search_filters)[0];
            echo view($this->page_data['controller_file_path'] . DIRECTORY_SEPARATOR . 'index', $this->page_data);
        }
    }

    function processUsersAjax($params, $controller_data)
    {
        $this->page_data = array_merge($this->page_data, $controller_data);
        if (isset($params[1]) && $params[1] == "ajax_request" && isset($params[2]) && $params[2] == "user")
        {
            if (isset($params[3]) && $params[3] == "user_list")
            {
                $submittedData = $this->request->getPost("submittedData");
                try
                {
                    $search_filters['status'] = 'active';
                    $users_list = $this->get_users_by_condition($search_filters);
                    $data_object['users'] = $users_list;
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
                $user_id = $submittedData['user_id'];
                try
                {
                    $search_filters['user_id'] = $user_id;
                    $users_list = $this->get_users_by_condition($search_filters);
                    $data_object['users'] = $users_list;
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
    /*     * * DATA HANDLER ** */

    function get_users_by_condition($obj = null)
    {
        $builder = $this->db->table('users');
        if ($obj != null && isset($obj['user_id']) && $obj['user_id'] > 0)
        {
            $builder->where('users.user_id ', $obj['user_id']);
        }
        if ($obj != null && isset($obj['first_name']) && strlen($obj['first_name']) > 0)
        {
            $builder->like('users.first_name ', $obj['first_name'], 'BOTH');
        }
        if ($obj != null && isset($obj['last_name']) && strlen($obj['last_name']) > 0)
        {
            $builder->like('users.last_name ', $obj['last_name'], 'BOTH');
        }
        if ($obj != null && isset($obj['phone']) && strlen($obj['phone']) > 0)
        {
            $builder->where('users.phone ', $obj['phone']);
        }
        if ($obj != null && isset($obj['email']) && strlen($obj['email']) > 0)
        {
            $builder->like('users.email ', $obj['email'], 'BOTH');
        }
        if ($obj != null && isset($obj['created_on']) && strlen($obj['created_on']) > 0)
        {
            $builder->where('DATE_FORMAT(users.created_on,"%Y-%m-%d")', $obj['created_on']);
        }
        if ($obj != null && isset($obj['status']) && strlen($obj['status']) > 0)
        {
            $builder->where('users.status ', $obj['status']);
        }
        $builder->select('users.*');
        $builder->orderBy('users.user_id desc, users.first_name asc, users.last_name asc');
        if ($obj != null && isset($obj['count']) && ($obj['count'] == 1))
        {
            $data_object = $builder->get()->getNumRows();
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
    /*     * * DB HANDLER ** */

    function create_user($data)
    {
        $data_object = NULL;
        $data_object['transaction_status'] = "0";
        try
        {
            if (isset($data))
            {
                $builder = $this->db->table('users');
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

    function update_user($data, $id)
    {
        $data_object = NULL;
        $data_object['transaction_status'] = "0";
        try
        {
            if (isset($data))
            {
                $builder = $this->db->table('users');
                $builder->where('user_id', $id);
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

    function delete_user($id)
    {

        $data_object = NULL;
        $data_object['transaction_status'] = "0";
        try
        {
            if (isset($id))
            {
                $builder = $this->db->table('users');
                $builder->where('users.user_id', $id);
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

    function create_user_details($data)
    {
        $data_object = NULL;
        $data_object['transaction_status'] = "0";
        try
        {
            if (isset($data))
            {
                $builder = $this->db->table('user_details');
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

    function update_user_details($data, $id)
    {
        $data_object = NULL;
        $data_object['transaction_status'] = "0";
        try
        {
            if (isset($data))
            {
                $builder = $this->db->table('user_details');
                $builder->where('user_details_id', $id);
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

    function delete_user_details($id)
    {

        $data_object = NULL;
        $data_object['transaction_status'] = "0";
        try
        {
            if (isset($id))
            {
                $builder = $this->db->table('user_details');
                $builder->where('user_details.user_details_id', $id);
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
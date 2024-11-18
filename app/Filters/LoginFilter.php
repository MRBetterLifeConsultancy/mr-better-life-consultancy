<?php
namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class LoginFilter implements FilterInterface
{
    public $custom_site_url;
    public $page_data = array();

    public function __construct()
    {
        $this->custom_site_url = base_url() . '';
        $this->page_data['custom_site_url'] = $this->custom_site_url;
    }

    public function before(RequestInterface $request, $arguments = null)
    {
        // Do something here


        $router = service('router');
        $controller = $router->controllerName();
        $method = $router->methodName();
        $user_type = session()->get('user_type');
        if (isset($user_type) && $user_type == 'user')
        {
            if (!($controller == '\App\Controllers\User'))
            {
                return redirect()->to($this->custom_site_url . "/" . USER_URL . "");
            }
        }
        else if (isset($user_type) && $user_type == 'admin')
        {
            if (!($controller == '\App\Controllers\Admin'))
            {
                return redirect()->to($this->custom_site_url . "/" . ADMIN_URL . "");
            }
        }
        else
        {
            return redirect()->to($this->custom_site_url . "/" . HOME_URL . "/");
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
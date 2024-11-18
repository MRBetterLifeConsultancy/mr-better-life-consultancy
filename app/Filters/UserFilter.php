<?php
namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class UserFilter implements FilterInterface
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
        // if(session()->get('user_id'))
        // {
        //     return redirect()->to($this->custom_site_url . "/" . USER_URL . "/home");
        // }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
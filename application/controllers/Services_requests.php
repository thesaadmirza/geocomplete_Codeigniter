<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @property services_requests_model services_requests
 */
class Services_requests extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('services_requests_model', 'services_requests');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters("<span style='color: red' class='incorrect'>", "</span>");
    }

    /**
     *  create new new_category then redirect my_services_requests.
     */
    public function create()
    {
        $this->load->model('places/area_category_model', 'area_category');
        $this->form_validation->set_rules('sr_address', "sr_address", 'required');
        $this->form_validation->set_rules('sr_lat', "sr_lat", 'decimal|required');
        $this->form_validation->set_rules('sr_lng', "sr_lng", 'decimal|required');

        if ($this->form_validation->run() == false) {
            $this->services_requests->create();
            $this->load->view('services_requests_create');
        } else {
             $this->load->view('services_requests_create');
           }
     }







}

/* End of file dashboard.php */
/* Location: ./system/application/modules/matchbox/controllers/dashboard.php */
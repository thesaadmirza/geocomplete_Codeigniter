<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class services_requests_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /* This function create new category. */

    function create() {

        $this->db->set('sr_address', $this->input->post('sr_address'));
        $this->db->set('sr_lat', $this->input->post('sr_lat'));
        $this->db->set('sr_lng', $this->input->post('sr_lng'));
        $this->db->set('sr_created', time());
        $this->db->insert('services_requests');

    }


}
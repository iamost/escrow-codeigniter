<?php

Class Transactions extends CI_Controller {
    /*
     * @desciption: Show the transactions view.
     * @created: 02/10/2018
     */

    public function index() {
        if (!file_exists(APPPATH . 'views/transactions/index.php')) {
            show_404();
        }

        $data['title'] = ucfirst('transactions');
        $user_id = $this->session->userdata('user_id');
        if (!$this->session->userdata('logged_in'))
            redirect('users/login');
        $data['transactions'] = $this->transaction_model->getTransactionsByUserId($user_id);

        $this->load->view('templates/header');
        $this->load->view('transactions/index', $data);
        $this->load->view('templates/footer');
    }

    /**
     * @description: show the buyer form.
     */
    public function buyer() {
        $user_id = $this->session->userdata('user_id');
        if (!$this->session->userdata('logged_in'))
            redirect('users/login');
        $userdata = $this->user_model->getUserById($user_id);

        $this->load->view('templates/header');
        $this->load->view('transactions/buyer', $userdata);
        $this->load->view('templates/footer');
    }

    /**
     * @description: receive the buyer form submits.
     */
    public function register() {
        $user_id = $this->session->userdata('user_id');
        if (!$this->session->userdata('logged_in'))
            redirect('users/login');
        $userdata = $this->user_model->getUserById($user_id);

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('streetadr', 'Street Address', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('zipcode', 'Zipcode', 'required');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required');
        $this->form_validation->set_rules('item', 'item', 'required');
        $this->form_validation->set_rules('seller_name', 'Seller', 'required');

        if ($this->form_validation->run() == FALSE) {
            $arr['success'] = false;
            $arr['notif'] = validation_errors();
        } else {
            $data = array(
                'buyer_id' => $user_id,
                'buyer_name' => $this->input->post('name'),
                'zipcode' => $this->input->post('zipcode'),
                'streetadr' => $this->input->post('streetadr'),
                'address' => $this->input->post('address'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                'phone' => $this->input->post('phone'),
                'item' => $this->input->post('item'),
            );
            $sellerData = $this->user_model->getUserDataByUserName($this->input->post('seller_name'));
            if (count($sellerData) == 0) {
                $data['seller_email'] = $this->input->post('seller_name');
            } else {
                $data['seller_id'] = $sellerData['id'];
                $data['seller_username'] = $sellerData['username'];
                $data['seller_email'] = $sellerData['email'];
            }

            $this->transaction_model->insertNewData($data);
            // Set message
            $this->session->set_flashdata('buyer_submitted', 'Your transaction is successfully submitted.');
//            redirect('transactions');
            $arr['success'] = true;
            
        }
        echo json_encode($arr);
    }

}

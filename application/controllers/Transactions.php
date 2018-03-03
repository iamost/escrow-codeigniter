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
     * @description: create new transaction by buyer.
     */
    public function register() {
        //configuration for email library.
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'demonkcm5555@gmail.com', // change it to yours
            'smtp_pass' => 'kcm19940903', // change it to yours
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );
        //current user id
        $user_id = $this->session->userdata('user_id');
        //array for storing to the transaction table.
        $data = array(
            'buyer_id' => $user_id,
            'buyer_username' => $this->input->post('username'),
            'buyer_name' => $this->input->post('name'),
            'zipcode' => $this->input->post('zipcode'),
            'streetadr' => $this->input->post('streetadr'),
            'address' => $this->input->post('address'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'phone' => $this->input->post('phone'),
            'buyer_email' => $this->input->post('email'),
            'item' => $this->input->post('item'),
        );
        $sellerData = $this->user_model->getUserDataByUserName($this->input->post('seller_name'));

        // If seller has not registered yet, send email for sign up.
        if (count($sellerData) == 0) {
            $data['seller_email'] = $this->input->post('seller_name');
            $message = '<h3>' . $data['buyer_name'] . ' has started transaction for ' . $data['item'] . ' in our Escrow Website.</h3>';
            $message .= '<h3>Please sign up here.</h3>';
            $message .= '<a href="http://localhost/thejota/register">Sign UP</a>';
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->set_mailtype("html");
            $this->email->from('demonkcm5555@gmail.com', 'thejota'); // change it to yours
            $this->email->to($data['seller_email']); // change it to yours
            $this->email->subject('Invitation for Sign Up.');
            $this->email->message($message);
            $this->email->send();
        } else {
            $data['seller_id'] = $sellerData['id'];
            $data['seller_username'] = $sellerData['username'];
            $data['seller_email'] = $sellerData['email'];
        }
        //Insert New transaction to the table.
        $this->transaction_model->insertNewData($data);

        // Set message
        $this->session->set_flashdata('buyer_submitted', 'Your transaction is successfully submitted.');

        $arr['success'] = true;
        echo json_encode($arr);
    }

    /**
     * @description: show the seller form.
     */
    public function seller($transactionID) {
        $user_id = $this->session->userdata('user_id');
        if (!$this->session->userdata('logged_in'))
            redirect('users/login');
        $transData = $this->transaction_model->getTransactionsByID($transactionID);
        $this->load->view('templates/header');
        $this->load->view('transactions/seller', $transData);
        $this->load->view('templates/footer');
    }

    /**
     * @description: complete the transactions by seller
     */
    public function complete() {
        $data = array(
            'description' => $this->input->post('description'),
            'item_price' => $this->input->post('item_price'),
            'shipping' => $this->input->post('shipping'),
            'status' => 1
        );
        $transID = $this->input->post('id');
        $result = $this->transaction_model->updateTrans(array('id' => $transID), $data);
        // Set message
        $this->session->set_flashdata('seller_submitted', 'Your transaction is successfully submitted.');
//            redirect('transactions');
        $arr['success'] = true;
        echo json_encode($arr);
    }

    /**
     * @description: load unread transactions
     */
    public function getnotifications() {
        $viewType = $_POST['view'];
        $user_id = $this->session->userdata('user_id');
        $transData = $this->transaction_model->getSellerTrans($user_id, $viewType);
        $contData = $this->contract_model->getContractForSign($user_id);
        $arr['notifications'] = "";
        $arr['count'] = $this->transaction_model->getCountUnread($user_id);
        $arr['count'] = $arr['count'] > 0 ? $arr['count'] : null;
        if (count($contData) > 0) {
            foreach ($contData as $row) {
                $arr['notifications'] .= '<a class="dropdown-item text-dark " href="' . base_url() . 'contracts/index/' . $row['id'] . '">'
                        . 'Admin has sent Contracts.'
                        . '</a>';
            }
        }
        if (count($transData) > 0) {
            foreach ($transData as $row) {
                $arr['notifications'] .= '<a class="dropdown-item text-dark " href="' . base_url() . 'transactions/seller/' . $row['id'] . '">'
                        . $row['buyer_name'] . ' has sent Transactions.'
                        . '</a>';
            }
        }
        echo json_encode($arr);
    }

}

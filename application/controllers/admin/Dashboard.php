<?php

class Dashboard extends CI_Controller {
    /*
     * @description: Show the login view and check the validation if this user is admin.
     */

    public function login() {
        $data['title'] = 'Admin Panel';

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('admin/templates/header');
            $this->load->view('admin/login', $data);
            $this->load->view('admin/templates/footer');
        } else {

            // Get username
            $username = $this->input->post('username');
            // Get and encrypt the password
            $password = md5($this->input->post('password'));

            // Login user
            $user_id = $this->user_model->login($username, $password, 1);

            if ($user_id) {
                // Create session
                $user_data = array(
                    'user_id' => $user_id,
                    'username' => $username,
                    'logged_in' => true,
                    'admin' => 1
                );
                $this->session->set_userdata($user_data);

                // Set message
                $this->session->set_flashdata('user_loggedin', 'You are now logged in');

                redirect('admin/dashboard');
            } else {
                // Set message
                $this->session->set_flashdata('login_failed', 'Login is invalid');

                redirect('admin');
            }
        }
    }

    /*
     * @description: Show the Dashboard. Show all transactions on this website.
     */

    public function index() {
        if (!file_exists(APPPATH . 'views/transactions/index.php')) {
            show_404();
        }

        $data['title'] = ucfirst('transactions');

        $this->load->view('admin/templates/header');
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/transactions', $data);
        $this->load->view('admin/templates/footer');
    }

    public function logout() {
        // Unset user data
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('admin');

        // Set message
        $this->session->set_flashdata('user_loggedout', 'You are now logged out');

        redirect('admin');
    }

    /*
     * @Description: Shows all Transactions.
     * 
     */

    public function getalltrans() {
        $user_id = $this->session->userdata('user_id');
        $data = $this->transaction_model->getAllTransactions();
        $html = "";
        foreach ($data as $key => $row) {
            $itemReceived = "";
            $approve = "";
            $disapprove = "";
            $itemShipped = "";
            $close = "";
            if ($row['status'] == 0)
                $status = "Ongoing";
            else if ($row['status'] == 1)
                $status = "Request has been filled by seller";
            else if ($row['status'] == 2)
                $status = "Contract sent";
            else if ($row['status'] == 3)
                $status = "Contract has been approved.";
            else if ($row['status'] == 4)
                $status = "Buyer has made Payment.";
            else if ($row['status'] == 5) {
                $status = "Seller has sent Item.";
                $itemReceived = '<li class="list-group-item border-0">'
                        . '<label class="form-check-label">'
                        . '<input class="form-check-input item-received" type="checkbox" value="1" name="itemreceived" onchange="item_Received(' . $row['id'] . ', this.checked);">Item Received'
                        . '</label></li>';
            } else if ($row['status'] == 6) {
                $status = "Item Received.";
                $approve = '<li class="list-group-item border-0">'
                        . '<button class="btn btn-primary" onclick="approve(' . $row['id'] . ');">Approve</button>'
                        . '</li>';
                $disapprove = '<li class="list-group-item border-0">'
                        . '<button class="btn btn-danger" onclick="disapprove(' . $row['id'] . ');">Disapprove</button>'
                        . '</li>';
            } else if ($row['status'] == 7) {
                $status = "Item Approved.";
                $itemShipped = '<li class="list-group-item border-0">'
                        . '<label class="form-check-label">'
                        . '<input class="form-check-input" type="checkbox" value="1" name="itemshipped" onchange="item_Shipped(' . $row['id'] . ', this.checked);">Item shipped to buyer'
                        . '</label></li>';
            } else if ($row['status'] == 8) {
                $status = "Item Shipped to buyer.";
                $close = '<li class="list-group-item border-0">'
                        . '<button class="btn btn-danger" onclick="closeTransaction(' . $row['id'] . ');">Close Transaction</button>'
                        . '</li>';
            } else if ($row['status'] == 9) {
                $status = "Transaction is closed.";
            } else if ($row['status'] == 10) {
                $status = "Item Disapproved.";
                $close = '<li class="list-group-item border-0">'
                        . '<button class="btn btn-danger" onclick="closeTransaction(' . $row['id'] . ');">Close Transaction</button>'
                        . '</li>';
            }
            $html .= '<div class="card my-3">'
                    . '<div class="card-header" id="' . $key . '">'
                    . '<a class="btn btn-block" data-toggle="collapse" data-target="#' . $row['id'] . '" aria-expanded="false" aria-controls="' . $row['id'] . '">'
                    . '<div class="row">'
                    . '<div class="col-md-3">ID:#' . $row['id'] . '</div>'
                    . '<div class="col-md-3">Date: ' . $row['start_date'] . '</div>'
                    . '<div class="col-md-6">' . $status . '</div>'
                    . '</div>'
                    . '</a>'
                    . '</div>'
                    . '<div id="' . $row['id'] . '" class="collapse" aria-labelledby="' . $key . '" data-parent="#accordion">'
                    . '<div class="card-body">'
                    . '<div class="row">'
                    . '<ul class="list-group col">'
                    . '<li class="list-group-item border-0">Buyer:@' . $row['buyer_username'] . '</li>'
                    . '<li class="list-group-item border-0">Buyer Form</li>'
                    . '<li class="list-group-item border-0">Request</li>'
                    . $itemReceived . $approve . $itemShipped . $close
                    . '</ul><ul class="list-group col">'
                    . '<li class="list-group-item border-0">Seller:@' . $row['seller_username'] . '</li>'
                    . '<li class="list-group-item border-0">Seller Form</li>'
                    . '<li class="list-group-item border-0">Request</li>'
                    . $disapprove
                    . '</ul>'
                    . '<div class="col my-auto"><a href="' . base_url() . 'admin/dashboard/contract/' . $row['id'] . '">Contract</a></div>'
                    . '</div>'
                    . '</div></div></div>';
        }
        echo $html;
    }

    /*
     * @description: Show the contract of specific transaction.
     * @param: $transID -- Transaction Id to create contract
     */

    public function contract($transID) {
        $transData = $this->transaction_model->getTransactionsByID($transID);
        $this->load->view('admin/templates/header');
        $this->load->view('admin/contract', $transData);
        $this->load->view('admin/templates/footer');
    }

    /*
     * @description: Create a new contract and Save it.
     * 
     */

    public function newcontract() {
        $transData = $this->transaction_model->getTransactionsByID($this->input->post('trans_id'));
        $data = array(
            'trans_id' => $this->input->post('trans_id'),
            'total_price' => $this->input->post('total_price'),
            'refund_amount' => $this->input->post('refund_amount'),
            'term' => $this->input->post('term'),
            'buyer_id' => $transData['buyer_id'],
            'seller_id' => $transData['seller_id'],
        );
        $this->contract_model->insertNewData($data);
        $arr['success'] = true;
        echo json_encode($arr);
    }

    /*
     * @description: Check if item received.
     */

    public function itemreceived() {
        $trans_id = $this->input->post('trans_id');
        $data = array('status' => 6);
        $this->transaction_model->updateTrans(array('id' => $trans_id), $data);
        $arr['success'] = true;
        echo json_encode($arr);
    }

    public function itemshipped() {
        $trans_id = $this->input->post('trans_id');
        $data = array('status' => 8);
        $this->transaction_model->updateTrans(array('id' => $trans_id), $data);
        $arr['success'] = true;
        echo json_encode($arr);
    }

    public function approve() {
        $trans_id = $this->input->post('trans_id');
        $data = array('status' => 7);
        $this->transaction_model->updateTrans(array('id' => $trans_id), $data);
        $arr['success'] = true;
        echo json_encode($arr);
    }

    public function disapprove() {
        $trans_id = $this->input->post('trans_id');
        $data = array('status' => 10);
        $this->transaction_model->updateTrans(array('id' => $trans_id), $data);
        $arr['success'] = true;
        echo json_encode($arr);
    }

    public function closetrans() {
        $trans_id = $this->input->post('trans_id');
        $data = array('status' => 9);
        $this->transaction_model->updateTrans(array('id' => $trans_id), $data);
        $arr['success'] = true;
        echo json_encode($arr);
    }

}

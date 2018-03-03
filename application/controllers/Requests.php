<?php

Class Requests extends CI_Controller {
    /*
     * @desciption: Show the request view.
     * @created: 02/10/2018
     */

    public function getrequest() {
        $user_id = $this->session->userdata('user_id');
        //Get transactions which contract has been approved.
        $payRequests = $this->contract_model->getPayRequest($user_id);
        $itemRequests = $this->contract_model->getItemRequest($user_id);
        $arr['count'] = count($payRequests) + count($itemRequests);
        $arr['count'] = $arr['count'] > 0 ? $arr['count'] : null;
        $arr['requests'] = '';
        if (count($payRequests) > 0) {
            foreach ($payRequests as $row) {
                $arr['requests'] .= '<a class="dropdown-item text-dark " href="' . base_url() . 'requests/view/buy/' . $row['id'] . '">'
                        . 'Admin has sent Payment Request for Transaction #' . $row['trans_id']
                        . '</a>';
            }
        }
        if (count($itemRequests) > 0) {
            foreach ($itemRequests as $row) {
                $arr['requests'] .= '<a class="dropdown-item text-dark " href="' . base_url() . 'requests/view/sell/' . $row['id'] . '">'
                        . 'Admin has sent Item Request for Transaction #' . $row['trans_id']
                        . '</a>';
            }
        }
        echo json_encode($arr);
    }

    public function view($viewType, $contractID) {
        $contData = $this->contract_model->getContractByID($contractID);
        if ($viewType == 'buy') {
//        $transData = $this->transaction_model->getTransactionsByID($trans_id);
            $this->load->view('templates/header');
            $this->load->view('requests/payrequest', $contData);
            $this->load->view('templates/footer');
        } else if ($viewType == 'sell') {
            $this->load->view('templates/header');
            $this->load->view('requests/itemrequest', $contData);
            $this->load->view('templates/footer');
        }
    }

    public function itemsent() {
        $trans_id = $this->input->post('trans_id');
        $data = array('status' => 5);
        $this->transaction_model->updateTrans(array('id' => $trans_id), $data);
        $arr['success'] = true;
        echo json_encode($arr);
    }

}

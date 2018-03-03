<?php

Class Contracts extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('paypal_lib');
        $this->load->model('product');
    }

    /*
     * @desciption: Show the Contract view.
     * @created: 02/10/2018
     */

    public function index($contractID) {
        if (!file_exists(APPPATH . 'views/contracts/index.php')) {
            show_404();
        }

        $user_id = $this->session->userdata('user_id');
        if (!$this->session->userdata('logged_in'))
            redirect('users/login');
        $contractData = $this->contract_model->getContractByID($contractID);
        $transData = $this->transaction_model->getTransactionsByID($contractData['trans_id']);
        $data['contr'] = $contractData;
        $data['trans'] = $transData;
        $this->load->view('templates/header');
        $this->load->view('contracts/index', $data);
        $this->load->view('templates/footer');
    }

    public function sign() {
        $contract_id = $this->input->post('contract_id');
        $contData = $this->contract_model->getContractByID($contract_id);
        $user_id = $this->session->userdata('user_id');
        if ($user_id == $contData['buyer_id']) {
            if ($contData['seller_sign'] == null || $contData['seller_sign'] == '')
                $status = 0;
            else {
                $status = 1;
                $this->transaction_model->updateTrans(array('id' => $contData['trans_id']), array('status' => 3));
            }
            $data = array(
                'buyer_sign' => $this->input->post('sign'),
                'status' => $status
            );
        } else if ($user_id == $contData['seller_id']) {
            if ($contData['buyer_sign'] == null || $contData['buyer_sign'] == '')
                $status = 0;
            else {
                $status = 1;
                $this->transaction_model->updateTrans(array('id' => $contData['trans_id']), array('status' => 3));
            }
            $data = array(
                'seller_sign' => $this->input->post('sign'),
                'status' => $status
            );
        }
        $result = $this->contract_model->updateContract($contract_id, $data);
        $arr['success'] = true;
        echo json_encode($arr);
    }

    public function pay($id) {
        //Set variables for paypal form
        $returnURL = base_url() . 'paypal/success'; //payment success url
        $cancelURL = base_url() . 'paypal/cancel'; //payment cancel url
        $notifyURL = base_url() . 'paypal/ipn'; //ipn url
        //get particular product data
        $contract = $this->contract_model->getContractByID($id);
        $user_id = $this->session->userdata('user_id');
        $logo = base_url() . 'assets/images/codexworld-logo.png';

        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('cancel_return', $cancelURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);
        $this->paypal_lib->add_field('item_name', $contract['item']);
        $this->paypal_lib->add_field('custom', $user_id);
//        $this->paypal_lib->add_field('item_number',  $contract['id']);
        $this->paypal_lib->add_field('amount', $contract['total_price']);
        $this->paypal_lib->image($logo);

        $this->paypal_lib->paypal_auto_form();
    }

}

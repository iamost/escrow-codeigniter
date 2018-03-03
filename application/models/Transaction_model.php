<?php

class Transaction_model extends CI_Model {

    public function insertNewData($data) {
        return $this->db->insert('transactions', $data);
    }

    public function getTransactionsByUserId($buyer_id, $viewType = 'all') {
        if ($viewType == 'all')
            $result = $this->db->get_where('transactions', array('buyer_id' => $buyer_id));
        else {
            $result = $this->db->get_where('transactions', array('buyer_id' => $buyer_id, 'status' => $viewType));
        }
        return $result->result_array();
    }

    public function getTransactionsByID($transactionID) {
        $this->db->select('a.*,b.name as seller_name,b.streetadr as seller_streetadr, b.address as seller_address, b.city as seller_city, b.state as seller_state, b.zipcode as seller_zipcode');
        $this->db->from('transactions as a');
        $this->db->join('users as b', 'a.seller_id=b.id', 'left');
        $this->db->where('a.id', $transactionID);
        $result = $this->db->get()->row_array();
//        $result = $this->db->get_where('transactions', array('id' => $transactionID))->row_array();
        return $result;
    }

    /*
     * @Description: get all transactions
     * @params: $viewType: 0- all
     *                     1- status=1
     *                     2- status=2
     *                     3- status=3
     */

    public function getAllTransactions($viewType = 0) {
        if ($viewType == 1)
            $result = $this->db->get_where('transactions', array('status' => 1));
        else
            $result = $this->db->get('transactions');
        return $result->result_array();
    }

    public function getSellerTrans($seller_id, $viewType) {
        $result = $this->db->get_where('transactions', array('seller_id' => $seller_id, 'status' => '0'));
        return $result->result_array();
    }

    public function getCountUnread($seller_id) {
        $result = $this->db->where(array('status' => '0', 'seller_id' => $seller_id))->count_all_results('transactions');
        return $result;
    }

    public function updateTrans($where, $data) {
        $result = $this->db->where($where)->update('transactions', $data);
        return $result;
    }

}

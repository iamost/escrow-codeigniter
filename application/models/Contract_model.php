<?php

class Contract_model extends CI_Model {

    public function insertNewData($data) {
        $this->db->where('id', $data['trans_id'])->update('transactions', array('status' => '2'));
        return $this->db->insert('contracts', $data);
    }

    public function getContractForSign($user_id) {
        $this->db->where(array('buyer_id' => $user_id, 'status' => 0));
        $this->db->or_where(array('seller_id' => $user_id, 'status' => 0));
        $result = $this->db->get('contracts')->result_array();
        return $result;
    }

    public function getContractByID($id) {
        $this->db->select('a.*, b.item,b.description,b.item_price, b.shipping');
        $this->db->from('contracts as a');
        $this->db->join('transactions as b', 'a.trans_id=b.id', 'left');
        $this->db->where('a.id', $id);
        $result = $this->db->get()->row_array();
//        $result = $this->db->get_where('contracts', array('id' => $id))->row_array();
        return $result;
    }

    public function updateContract($contID, $data) {
        $result = $this->db->where('id', $contID)->update('contracts', $data);
        return $result;
    }

    public function getPayRequest($user_id) {
        $this->db->select('a.*, b.item,b.description,b.item_price, b.shipping');
        $this->db->from('contracts as a');
        $this->db->join('transactions as b', 'a.trans_id=b.id', 'left');
        $this->db->where('a.buyer_id', $user_id);
        $this->db->where('b.status', 3);
        $result = $this->db->get()->result_array();
//        $result = $this->db->get_where('contracts', array('buyer_id' => $user_id, 'status' => 1));
        return $result;
    }

    public function getItemRequest($user_id) {
        $this->db->select('a.*, b.item,b.description,b.item_price, b.shipping');
        $this->db->from('contracts as a');
        $this->db->join('transactions as b', 'a.trans_id=b.id', 'left');
        $this->db->where('a.seller_id', $user_id);
        $this->db->where('b.status', 4);
        $result = $this->db->get()->result_array();
//        $result = $this->db->get_where('contracts', array('buyer_id' => $user_id, 'status' => 1));
        return $result;
    }

}

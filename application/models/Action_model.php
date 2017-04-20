<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Action_model extends CI_Model{

        public function login($username, $password){

            $condition = array('username' => $username, 'password' => md5($password));

            $this->db->where($condition);

            $query = $this->db->get('users');

            $response = array('count'=> $query->num_rows(), 'names' => $query->row(0)->names );

            return $response;
        }

        public function statements(){
            $query=$this->db->get('transactions');

            return $query->result_array();
        }

        public function statement($account){
            $this->db->where('member', $account);
            $query=$this->db->get('transactions');

            return $query->result_array();
        }

        public function inputsum(){
            $this->db->select_sum('input','inputot');
            $query=$this->db->get('transactions');
            return $query->result_array();
        }
        public function outputsum(){
            $this->db->select_sum('output','outputot');
            $query=$this->db->get('transactions');
            return $query->result_array();
        }

        public function members(){
            $query=$this->db->get('members');

            return $query->result_array();
        }
        public function memberdetails($account){
            $this->db->where('account', $account);
            $query=$this->db->get('members');

            return $query->result_array();
        }
        public function createmember($account,$name,$username, $password,$address,$email,$date){
            $data = array(
                'account' => $account ,
                'name' => $name ,
                'username' => $username,
                'password' => $password ,
                'address' => $address ,
                'email' => $email ,
                'created_at' => $date
            );

            $query = $this->db->insert('members', $data);

            return $query;
        }
        public function recordtransaction($account,$in,$out, $amount,$reason,$date){

            $thebalance = $this->db->query("SELECT * FROM transactions WHERE member='$account' ORDER BY id DESC LIMIT 1");

            $row = $thebalance->row();

            if (isset($row))
            {
                $balance = $row->balance;
            }
            if ($in!=0) {
                $balance=$balance+$amount;
            }else{
                $balance=$balance-$amount;
            }

            $data = array(
                'member' => $account ,
                'input' => $in ,
                'output' => $out,
                'balance' => $balance ,
                'reason' => $reason ,
                'done_at' => $date
            );

            $query = $this->db->insert('transactions', $data);

            return $query;
        }
    }
    ?>
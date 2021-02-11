<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Query_model extends CI_Model {

    //for session check
    function check_session(){
        if ($this->session->userdata('logged_in') == FALSE){
            redirect(base_url()."login", 'refresh');
        }
    }

    //get the session of the user
    function get_user_session_data(){
        $this->check_session();
        $user_session_id = $this->session->userdata('id');
        $user_session_data=$this->db->get_where('login', array('login_id' => $user_session_id));
        if($user_session_data){
            return $user_session_data;
        }else{
            return false;
        }
    }

	
	 ////////IMAGE URL//////////
    function get_image_url($type = '', $id = '') {
		if($type=='user'){
        $this->check_session();
		//check whether file exists
        if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg'))
            $image_url = base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
        else//if not, replace with a temporary image
            $image_url = base_url() . 'uploads/temp.jpg';

        return $image_url;
		}
        //checking logo image
        if($type=='logo'){
        if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg'))
            $image_url = base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
        else
            $image_url = base_url() . 'uploads/logo.png';

        return $image_url;
        }
    }


    //clients queries
    public function clients($param1=null,$param2=null){
        $this->check_session();
        if($param1=="countClients"){
            $where=array("role"=>'client',"user_deleted"=>0);
            $this->db->select('*');
            $this->db->from('login');
            $this->db->where($where);
            return  $this->db->count_all_results();
        }
        if($param1=="queryClients"){
            $where=array("role"=>'client',"user_deleted"=>0);
            $this->db->select('*');
            $this->db->from('login');
            $this->db->where($where);
            $this->db->order_by('login_id','desc');
            return $this->db->get()->result_array();
        }
    }


    //clients queries
    public function gadgets($param1=null,$param2=null){
        $this->check_session();
        if($param1=="countGadgets"){
            $where=array("deleted_gadget"=>0);
            $this->db->select('*');
            $this->db->from('gadgets');
            $this->db->where($where);
            return  $this->db->count_all_results();
        }
        if($param1=="queryGadgets"){
            $where=array("deleted_gadget"=>0);
            $this->db->select('*');
            $this->db->from('gadgets');
            $this->db->where($where);
            $this->db->order_by('gadget_id','desc');
            return $this->db->get()->result_array();
        }
    }


    //disposes queries
    public function disposes($param1=null,$param2=null){
        $this->check_session();
        if($param1=="countDisposes"){
            $where=array("transaction_id"=>$param2);
            $this->db->select('*');
            $this->db->from('disposes');
            $this->db->where($where);
            return  $this->db->count_all_results();
        }
        if($param1=="clientQueryDisposes"){
            $where=array("login_id"=>$this->session->userdata('id'));
            $this->db->select('*');
            $this->db->from('transaction');
            $this->db->where($where);
            $this->db->order_by('transaction_id','desc');
            //$this->db->join('disposes', 'disposes.transaction_id = transaction.transaction_id');
            return $this->db->get()->result_array();
        }
        if($param1=="clientQuerySpecificDisposes"){
            $where=array("login_id"=>$this->session->userdata('id'),"transaction_code"=>$param2);
            $this->db->select('*');
            $this->db->from('transaction');
            $this->db->where($where);
            return $this->db->get()->result_array();
        }
        if($param1=="adminQueryDisposes"){
            $this->db->select('*');
            $this->db->from('transaction');
            $this->db->order_by('transaction_id','desc');
            return $this->db->get()->result_array();
        }
        if($param1=="adminApprovedQueryDisposes"){
            $where=array("payment_status"=>1);
            $this->db->select('*');
            $this->db->from('transaction');
            $this->db->where($where);
            $this->db->order_by('transaction_id','desc');
            return $this->db->get()->result_array();

        }//end
        if($param1=="adminPendingQueryDisposes"){
            $where=array("payment_status"=>0);
            $this->db->select('*');
            $this->db->from('transaction');
            $this->db->where($where);
            $this->db->order_by('transaction_id','desc');
            return $this->db->get()->result_array();

        }//end
        if($param1=="ClientPendingDisposes"){
            $where=array(
                "payment_status"=>0,
                "login_id"=>$this->session->userdata('id')
            );
            $this->db->select('*');
            $this->db->from('transaction');
            $this->db->where($where);
            $this->db->order_by('transaction_id','desc');
            return  $this->db->count_all_results();

        }//end
        if($param1=="CountPendingDisposes"){
            $where=array(
                "payment_status"=>0,
            );
            $this->db->select('*');
            $this->db->from('transaction');
            $this->db->where($where);
            return  $this->db->count_all_results();

        }//end
        if($param1=="CountApprovedDisposes"){
            $where=array(
                "payment_status"=>1,
            );
            $this->db->select('*');
            $this->db->from('transaction');
            $this->db->where($where);
            return  $this->db->count_all_results();

        }//end
        if($param1=="ClientApprovedDisposes"){
            $where=array(
                "payment_status"=>1,
                "login_id"=>$this->session->userdata('id')
            );
            $this->db->select('*');
            $this->db->from('transaction');
            $this->db->where($where);
            return  $this->db->count_all_results();

        }//end
    }

    //get due collection date
    public function dueDate($collectDate){
        $this->check_session();
        $enddate=date('m/d/Y',$collectDate);
        //today date
        $today_date=date("m/d/Y");
        
        //get date difference
        $start=new DateTime($today_date);
        $end=new DateTime($enddate);
        $interval=$start->diff($end);
        $days_difference=$interval->format('%R'.'%d');
        
        return $days_difference;
    }


    //query payments total
    public function payments($p1="",$p2=""){
        $this->check_session();
        if($p1=="AdminApprovedPayments"){
            $where=array("payment_status"=>1);
            $this->db->select_sum('transaction_total');
            $this->db->from('transaction');
            $this->db->where($where);
            $desc=$this->db->get()->result_array();
            $approved_total=0;
            foreach($desc as $row):
            $approved_total+=$row['transaction_total'];
            endforeach;

            return $approved_total;
        }//end
        if($p1=="AdminPendingPayments"){
            $where=array("payment_status"=>0);
            $this->db->select_sum('transaction_total');
            $this->db->from('transaction');
            $this->db->where($where);
            $desc=$this->db->get()->result_array();
            $pending_total=0;
            foreach($desc as $row):
            $pending_total+=$row['transaction_total'];
            endforeach;

            return $pending_total;
        }//end
        if($p1=="ClientApprovedPayments"){
            $where=array(
                "payment_status"=>1,
                "login_id"=>$this->session->userdata('id')
            );
            $this->db->select_sum('transaction_total');
            $this->db->from('transaction');
            $this->db->where($where);
            $desc=$this->db->get()->result_array();
            $approved_total=0;
            foreach($desc as $row):
            $approved_total+=$row['transaction_total'];
            endforeach;

            return $approved_total;
        }//end
        if($p1=="ClientPendingPayments"){
            $where=array(
                "payment_status"=>0,
                "login_id"=>$this->session->userdata('id')
            );
            $this->db->select_sum('transaction_total');
            $this->db->from('transaction');
            $this->db->where($where);
            $desc=$this->db->get()->result_array();
            $pending_total=0;
            foreach($desc as $row):
            $pending_total+=$row['transaction_total'];
            endforeach;

            return $pending_total;
        }//end

    }

    

    //format prices
    function formatMoney($number, $fractional=false) {
        if ($fractional) {
            $number = sprintf('%.2f', $number);
        }
        while (true) {
            $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
            if ($replaced != $number) {
                $number = $replaced;
            } else {
                break;
            }
        }
        return $number;
    }

    //send message to client
    function sendNotification($code){
        $this->check_session();
        //get the valid data
        $name=$this->db->get_where('transaction' , array('transaction_code'=>$code))->row()->name;
        $phone=$this->db->get_where('transaction' , array('transaction_code'=>$code))->row()->phone;
        $formatedphone="254".$phone;
        $collection_date=$this->db->get_where('transaction' , array('transaction_code'=>$code))->row()->collection_date;
        $transaction_total=$this->db->get_where('transaction' , array('transaction_code'=>$code))->row()->transaction_total;

        $message='Hello '.$name. '? Your dispose request has been recieved successfully. Your dispose ID is '.$code.'. Please pay KSH: '. $this->formatMoney($transaction_total,true). ' before '.date("m/d/Y",$collection_date).' to approve your disposes.';
        //send message
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.sandbox.africastalking.com/version1/messaging',
          // CURLOPT_URL => 'https://api.africastalking.com/version1/messaging',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => array('username' => 'sandbox','to' => $formatedphone,'message' => $message),
          CURLOPT_HTTPHEADER => array(
            'apiKey: 70199fe55f6ee027343f11b809230e3a74fa62f699b0906167ea68aded3c890c'

          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // echo $response;

    }

    public function requestPayment($dispose_id="", $phone="", $amount=""){
        // echo "hello";
        $formatedphone="254".$phone;
        $this->check_session();

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Authorization: Basic Vng4U2ZNaEExdWE2RDlQQjJCMmhiWXh0cTlBRXdBVjk6Mk1oM3ZZSU1NeG50SEZBRA=='
          ),
        ));

        $response = curl_exec($curl);
            
        curl_close($curl);

        $mpesa_response = json_decode($response);

        $access_token = $mpesa_response->access_token;

        // echo $access_token;

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
            "BusinessShortCode": "174379",
            "Password": "MTc0Mzc5YmZiMjc5ZjlhYTliZGJjZjE1OGU5N2RkNzFhNDY3Y2QyZTBjODkzMDU5YjEwZjc4ZTZiNzJhZGExZWQyYzkxOTIwMjAwMjAzMDIxMjAw",
            "Timestamp": "20200203021200",
            "TransactionType": "CustomerPayBillOnline",
            "Amount": "1",
            "PartyA": "'.$formatedphone.'",
            "PartyB": "174379",
            "PhoneNumber": "'.$formatedphone.'",
            "CallBackURL": "https://2febfe5c3ae3.ngrok.io/hooks/mpesa",
            "AccountReference": "'.$dispose_id.'",
            "TransactionDesc": "E-Waste"
        }',
          CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$access_token,
            'Content-Type: application/json'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        //$stk_push=json_decode($response_stk_push);
        //$response_code=$stk_push->ResponseCode;

        // echo $response_code;
        //return $response_code;
    }

    //query logs
    public function queryLogs($p1="",$p2=""){
        if($p1=="admin"){
            // $where=array("payment_status"=>0);
            $this->db->select('*');
            $this->db->from('logs');
            $this->db->limit(5);
            $this->db->order_by('trigger_date','desc');
            return $this->db->get()->result_array();
        }
        if($p1=="client"){
            $where=array("user_id"=>$this->session->userdata('id'));
            $this->db->select('*');
            $this->db->from('logs');
            $this->db->where($where);
            $this->db->limit(5);
            $this->db->order_by('trigger_date','desc');
            return $this->db->get()->result_array();

        }
    }//clients queries
    public function logs($param1=null,$param2=null){
        $this->check_session();
        if($param1=="adminCountLogs"){
            // $where=array("deleted_gadget"=>0);
            $this->db->select('*');
            $this->db->from('logs');
            // $this->db->where($where);
            return  $this->db->count_all_results();
        }
        if($param1=="adminQuery"){
            // $where=array("deleted_gadget"=>0);
            $this->db->select('*');
            $this->db->from('logs');
            // $this->db->where($where);
            $this->db->order_by('trigger_date','desc');
            return $this->db->get()->result_array();
        }
        if($param1=="clientCountLogs"){
            $where=array("user_id"=>$this->session->userdata('id'));
            $this->db->select('*');
            $this->db->from('logs');
            $this->db->where($where);
            return  $this->db->count_all_results();
        }
        if($param1=="clientQuery"){
            $where=array("user_id"=>$this->session->userdata('id'));
            $this->db->select('*');
            $this->db->from('logs');
            $this->db->where($where);
            $this->db->order_by('trigger_date','desc');
            return $this->db->get()->result_array();
        }
    }

//end of Admin model class bracket
}
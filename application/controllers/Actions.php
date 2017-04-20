<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Actions extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('home');
	}
	public function admin()
	{
		$this->load->view('admin');
	}
	public function login()
    {
        $this->form_validation->set_rules('username','Username','trim|required');
        $this->form_validation->set_rules('password','Password','trim|min_length[8]|required');

        if($this->form_validation->run() == TRUE)
        {
            $val_errors = array('errors' => validation_errors());
            $this->session->set_flashdata($val_errors);
            redirect('Actions/admin');
        }
        else
        {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $results = $this->alm->login($username, $password);

            if($results['count'] > 0){
                $sessiondata = array(
                    'username' => $username,
                    'names' => $results['names'],
                    'loginuser' => TRUE
                );
                $this->session->set_userdata($sessiondata);
                redirect("Actions/dashboard");
            }else{
                $val_errors = array('errors' => 'Invalid Login Credentials');
                $this->session->set_flashdata($val_errors);
                redirect('Actions/admin');
            }
        }
    }
    public function dashboard()
    {
        $this->load->view('admin_dashboard');
    }
    public function fullstatement()
    {
        $data['intotal']=$this->alm->inputsum();
        $data['outotal']=$this->alm->outputsum();
    	$data['statements']=$this->alm->statements();
    	$this->load->view('view_statements',$data);
    }
    public function onestatement()
    {
    	$account = $this->uri->segment(3);
        $data['details']=$this->alm->memberdetails($account);
    	$data['statement']=$this->alm->statement($account);
    	$this->load->view('one_statements',$data);
    }
    public function members()
    {
    	$data['members']=$this->alm->members();
    	$this->load->view('members',$data);
    }
    
    public function createtransaction()
    {
    	$this->load->view('createtransaction');
    }
    public function recordtransaction()
    {
    	$this->form_validation->set_rules('account','Account','trim|required');
    	$this->form_validation->set_rules('type','Type','trim|required');
    	$this->form_validation->set_rules('amount','Amount','trim|required');
        $this->form_validation->set_rules('reason','Reason','trim|required');

        if($this->form_validation->run() == FALSE)
        {
            $val_errors = array('errors' => validation_errors());
            $this->session->set_flashdata($val_errors);
            redirect('Actions/createtransaction');
        }
        else
        {
            $account = $this->input->post('account');
            $type = $this->input->post('type');
            $amount = $this->input->post('amount');
            if ($type=='payment') {
            	$in=$amount;
            	$out='0';
            }else{
            	$in='0';
            	$out=$amount;
            }
            
            $reason = $this->input->post('reason');
            $date=date('Y-m-d');

            $results = $this->alm->recordtransaction($account,$in,$out, $amount,$reason,$date);

            if($results){
                redirect("Actions/fullstatement");
            }else{
                redirect('Actions/createtransaction');
            }
        }
    }
    public function createmember()
    {
    	$this->load->view('create_member');
    }
    public function createamember()
    {
    	$this->form_validation->set_rules('account','Account','trim|required');
    	$this->form_validation->set_rules('name','Name','trim|required');
    	$this->form_validation->set_rules('username','Username','trim|required');
        $this->form_validation->set_rules('password','Password','trim|min_length[8]|required');
        $this->form_validation->set_rules('address','Address','trim');
        $this->form_validation->set_rules('email','Email','trim|valid_email');

        if($this->form_validation->run() == TRUE)
        {
            $val_errors = array('errors' => validation_errors());
            $this->session->set_flashdata($val_errors);
            redirect('Actions/createmember');
        }
        else
        {
            $account = $this->input->post('account');
            $name = $this->input->post('name');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $password = md5($password);
            $address = $this->input->post('address');
            $email = $this->input->post('email');
            $date=date('Y-m-d');

            $results = $this->alm->createmember($account,$name,$username, $password,$address,$email,$date);

            if($results){
                redirect("Actions/members");
            }else{
                redirect('Actions/createmember');
            }
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->sess_destroy();

        redirect("Actions/admin");
    }
}

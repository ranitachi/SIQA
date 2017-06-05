<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged')=='true')
			redirect('siqa','location');
	} 
	public function index()
	{
		$data=[
			'title'=>'Login - Qutubuladmin.org',
			// 'sidebar'=>'template/sidebar',
			'active' => 'login'	
		];
		$this->load->view('template/login',$data);
		
		// $plain_txt = "55c3b5386c486feb662a0785f340938f518d547f";
		// echo $plain_txt.'<br>';

		// $encrypted_txt = encrypt_decrypt('encrypt', $plain_txt);
		// echo "Encrypted Text = $encrypted_txt<br>";

		// $decrypted_txt = encrypt_decrypt('decrypt', $encrypted_txt);
		// echo "Decrypted Text = $decrypted_txt<br>";

		// if( $plain_txt === $decrypted_txt ) echo "SUCCESS";
		// else echo "FAILED";

		// echo "\n";
	}
	public function cek()
	{
		if(!empty($_POST))
		{
			$user=$this->input->post('username');
			$us=$user;
			$us=encrypt_decrypt('encrypt', $user);
			$pass=sha1(md5($this->input->post('password')));
			$ps=$pass;
			$ps=encrypt_decrypt('encrypt', $pass);
			$qry=$this->db->query('select * from v_users where username="'.$us.'" and password="'.$ps.'" and status_tampil="1" and u_status="t"');
			if(count($qry->result())!=0)
			{
				$this->session->set_userdata('user',$qry->result());
				$this->session->set_userdata('logged','true');
				redirect('siqa/index','location');
			}
			
			redirect(base_url(),'location');
			
		
		}
		redirect(base_url(),'location');
	}
}
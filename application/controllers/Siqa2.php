<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siqa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged')!='true')
			redirect('login','location');
	} 
	public function index()
	{


		$data=[
			'title'=>'Dashboard - Qutubuladmin.org',
			'sidebar'=>'template/sidebar',
			'active' => 'home'			
		];
		$this->load->view('template/header',$data);
		$this->load->view('template/navbar');
		$this->load->view('template/sidebar',$data);
		$this->load->view('isi/home',$data);
		$this->load->view('template/footer');
	}

	function headertable($table)
	{
		// $this->load->view('isi/member/data');
		$fields = $this->db->list_fields($table);
		return $fields;
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login','location');
	}

	function urutanseat($nomor=null,$idevent=null,$kelamin=null)
	{
		if($kelamin=='w')
			$kl=encrypt_decrypt('encrypt','perempuan');
		else
			$kl=encrypt_decrypt('encrypt','laki-laki');
		$ns=array();
		$noseat=$this->db->query('select * from seat where status_tampil="t"  and kategori="'.$kl.'" order by huruf,angka');
		if(count($noseat->result())!=0)
		{
			foreach ($noseat->result() as $k => $v) 
			{
				//echo '<option value="'.$v->nomor.'">'.$v->nomor.'</option>';
				$ns[trim($v->huruf)][$v->angka]=$v->nomor;
			}
		}

		$noseatsudah=$this->db->query('select * from people_has_event as phe 
										inner join people as pp on (pp.id=phe.people_id) 
										where event_id="'.$idevent.'" and (nomorseat!="" || nomorseat is not null)
										and pp.kelamin="'.$kelamin.'"');
		if(count($noseatsudah->result())!=0)
		{
			foreach ($noseatsudah->result() as $k => $v) 
			{
				//echo '<option value="'.$v->nomor.'">'.$v->nomor.'</option>';
				$nss[$v->nomorseat]=$v->nomorseat;
			}
		}
		else
			$nss=array();
		// echo '<pre>';
		// print_r($ns);
		// echo '</pre>';
		$seathuruf=$this->db->query('select * from seat where status_tampil="t" and kategori="'.$kl.'" group by trim(huruf) order by huruf,angka');
		if(count($seathuruf->result())!=0)
		{
			foreach ($seathuruf->result() as $k => $v) 
			{				
			echo '<div style="width:100%;margin:0 auto 3px auto !important;text-align:center;float:left">';
				foreach ($ns[trim($v->huruf)] as $kk => $vv) 
				{

					$war='#95a5a6';

					if($vv==$nomor)
						$war='#4b77be';

					if(count($nss)!=0)
					{
						if(in_array($vv, $nss))
						{						// echo '<br>ada</br>';
							echo '<div style="width:36px;height:20px;margin-right:2px;padding:2px;border:1px solid #ccc;float:left;cursor:pointer;font-size:9px;margin-bottom:3px;background-color:#e43a45;color:#fff;">'.$vv.'</div>';
						}
						else
							echo '<div style="width:36px;height:20px;margin-right:2px;padding:2px;border:1px solid #ccc;float:left;cursor:pointer;font-size:9px;margin-bottom:3px;background-color:'.$war.';color:#fff;" onclick="gantiseat(\''.$vv.'\',\''.$kelamin.'\')">'.$vv.'</div>';
					}
					else
							echo '<div style="width:36px;height:20px;margin-right:2px;padding:2px;border:1px solid #ccc;float:left;cursor:pointer;font-size:9px;margin-bottom:3px;background-color:'.$war.';color:#fff;" onclick="gantiseat(\''.$vv.'\',\''.$kelamin.'\')">'.$vv.'</div>';


				}
				// echo '<br>';
			// echo '<br>';
			echo '</div>';
			}
		}
	}
}

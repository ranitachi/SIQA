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

		$data['member'] = $this->db->where('member', 't')->where('usia !=', null)->get('people')->result_id->num_rows;
		$data['member_male'] = $this->db->where('member', 't')->where('usia >', 10)->where('kelamin', 'p')->get('people')->result_id->num_rows;
		$data['member_female'] = $this->db->where('member', 't')->where('usia >', 10)->where('kelamin', 'w')->get('people')->result_id->num_rows;
		$data['member_child'] = $this->db->where('member', 't')->where('usia <=', 10)->get('people')->result_id->num_rows;

		$data['nonmember'] = $this->db->where('member', 'f')->where('usia !=', null)->get('people')->result_id->num_rows;
		$data['nonmember_male'] = $this->db->where('member', 'f')->where('usia >', 10)->where('kelamin', 'p')->get('people')->result_id->num_rows;
		$data['nonmember_female'] = $this->db->where('member', 'f')->where('usia >', 10)->where('kelamin', 'w')->get('people')->result_id->num_rows;
		$data['nonmember_child'] = $this->db->where('member', 'f')->where('usia <=', 10)->get('people')->result_id->num_rows;

		$this->load->view('template/header',$data);
		$this->load->view('template/navbar');
		$this->load->view('template/sidebar',$data);
		$this->load->view('isi/home',$data);
		$this->load->view('template/footer');
	}

	public function tes()
	{
		echo "<pre>";
		print_r($this->config);
		echo "</pre>";
	}

	public function json()
	{
		// Start Chart Pie
		$asal = $this->db->get('people')->result();
		foreach ($asal as $key => $value) {
			$asal[$key]->asal = encrypt_decrypt('decrypt', $asal[$key]->asal);
		}
		$asal2 = unique_multidim_array($asal, 'asal');

		foreach ($asal2 as $row2)
		{
			$count[$row2->asal] = 0;
		}

		foreach ($asal as $row)
		{
			if ($row->member == 't' && $row->asal != '')
			{
				$count[$row->asal]++;
			}
		}

		foreach ($asal2 as $row2)
		{
			if ($count[$row2->asal] >= 50)
			{
				$data[] = array($row2->asal, $count[$row2->asal]);
			}
		}

		foreach ($data as $key => $row) {
		    $name[$key] = $row[0];
		    $sum[$key] = $row[1];
		}

		array_multisort($sum, SORT_DESC, $sum, SORT_DESC, $data);
		$pie['data'] = $data;
		$container_pie = array($pie);
		// End Chart Pie


		// Start Chart Area
		$event = $this->db->where('status', 't')->order_by('id', 'desc')->get('event')->result();
		
		foreach ($event as $key => $value) {
			$event[$key]->event_name = encrypt_decrypt('decrypt', $event[$key]->event_name);
			$event[$key]->jenis = encrypt_decrypt('decrypt', $event[$key]->jenis);
			$event[$key]->sum_person = $this->db->where('event_id', $event[$key]->id)->get('people_has_event')->result_id->num_rows;
		}

		for ($i = date('Y')-4; $i <= date('Y'); $i++) { 
			$sum_person['member'][$i] = 0;
			$sum_person['umum'][$i] = 0;
		}

		foreach ($event as $row)
		{
			if ($row->jenis == 'member' || $row->jenis == 'umum')
			{
				$sum_person[$row->jenis][substr($row->event_time, 0, 4)] += $row->sum_person;
			}
		}

		foreach ($sum_person['member'] as $key => $value) {
			$member[] = $value;
		}
		foreach ($sum_person['umum'] as $key => $value) {
			$umum[] = $value;
		}

		$area1['name'] = 'Event Umum';
		$area1['data'] = $umum;
		$area2['name'] = 'Event Khusus Member';
		$area2['data'] = $member;
		$container_umum = array($area1);
		$container_khusus = array($area2);
		// End Chart Area


		// Start Xaxis Area
		for ($i = date('Y')-4; $i <= date('Y'); $i++) { 
			$categories['categories'][] = $i;
		}
		$categories['crosshair'] = true;
		$xaxis = array($categories);
		// End Xaxis Area


		// Start Xaxis Column
		$j1=$j2=0;
		$show=5;
		foreach ($event as $key => $value) {
			if ($value->jenis == 'umum' && $j1 < $show) {
				$categories1['categories'][] = $value->event_name;
				$column1[0]['type'] = 'column';
				$column1[0]['name'] = 'Laki-laki';
				$jlh0 = $this->db->query('select count(*) as jlh from people_has_event as phe
				    inner join people as p on (p.id=phe.people_id)
				    where phe.event_id="'.$value->id.'" and p.kelamin="p" ')->result();
				$column1[0]['data'][] = (int) $jlh0[0]->jlh;

				$column1[1]['type'] = 'column';
				$column1[1]['name'] = 'Perempuan';
				$jlh1 = $this->db->query('select count(*) as jlh from people_has_event as phe
				    inner join people as p on (p.id=phe.people_id)
				    where phe.event_id="'.$value->id.'" and p.kelamin="w" ')->result();
				$column1[1]['data'][] = (int) $jlh1[0]->jlh;
				
				$column1[2]['type'] = 'spline';
				$column1[2]['name'] = 'Total';
				$column1[2]['data'][] = (int) $jlh0[0]->jlh + (int) $jlh1[0]->jlh;
				$j1++;
			}
			elseif ($value->jenis == 'member' && $j2 < $show) {
				$categories2['categories'][] = $value->event_name;
				$column2[0]['type'] = 'column';
				$column2[0]['name'] = 'Laki-laki';
				$jlh0 = $this->db->query('select count(*) as jlh from people_has_event as phe
				    inner join people as p on (p.id=phe.people_id)
				    where phe.event_id="'.$value->id.'" and p.kelamin="p" ')->result();
				$column2[0]['data'][] = (int) $jlh0[0]->jlh;

				$column2[1]['type'] = 'column';
				$column2[1]['name'] = 'Perempuan';
				$jlh1 = $this->db->query('select count(*) as jlh from people_has_event as phe
				    inner join people as p on (p.id=phe.people_id)
				    where phe.event_id="'.$value->id.'" and p.kelamin="w" ')->result();
				$column2[1]['data'][] = (int) $jlh1[0]->jlh;
				
				$column2[2]['type'] = 'spline';
				$column2[2]['name'] = 'Total';
				$column2[2]['data'][] = (int) $jlh0[0]->jlh + (int) $jlh1[0]->jlh;
				$j2++;
			}
		}
		$categories1['crosshair'] = true;
		$categories2['crosshair'] = true;
		$xaxis1 = array($categories1);
		$xaxis2 = array($categories2);
		// End Xaxis Column


		// Start Chart Column
		$container_umum_detail = $column1;
		$container_khusus_detail = $column2;
		// End Chart Column


		$array = array();
		array_push($array, $container_pie);
		array_push($array, $xaxis);
		array_push($array, $container_umum);
		array_push($array, $container_khusus);
		array_push($array, $xaxis1);
		array_push($array, $container_umum_detail);
		array_push($array, $xaxis2);
		array_push($array, $container_khusus_detail);
		print json_encode($array);
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

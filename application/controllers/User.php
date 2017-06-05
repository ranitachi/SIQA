<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once('Siqa.php');
class User extends Siqa {

	public function index()
	{
		$d=$this->db->query('select * from v_users where level is not null and status_tampil="1" order by u_status,nama asc');
		$data=[
			'title'=>'Member - Qutubuladmin.org',
			'sidebar'=>'template/sidebar',
			'active' => 'user',
			'd' => $d->result()			
		];
		$this->load->view('template/header',$data);
		$this->load->view('template/navbar');
		$this->load->view('template/sidebar',$data);
		$this->load->view('isi/user/index',$data);
		$this->load->view('template/footer');
	}

	public function profile($id,$pid)
	{
		$d=$this->db->query('select * from v_users where id="'.$id.'"');
		// $dd=$this->db->query('select * from people where id="'.$id.'"')->result();
		// $x=$this->db->field_data('people');
		// foreach ($x as $k => $v) 
		// {
		// 	if($v->type=='varchar' || $v->type=='text')
		// 	{
		// 		if($dd[0]->{$v->name}!="")
		// 		{
		// 			$data[$v->name]=encrypt_decrypt('encrypt', $dd[0]->{$v->name});
		// 			// echo $v->name.':'.encrypt_decrypt('encrypt', $dd[0]->{$v->name}).'<br>';
		// 		}
		// 	}
		// }
		// 		// echo '<pre>';
		// 		// print_r($data);
		// 		// echo '</pre>';

		// $this->db->where('id',$id);
		// $this->db->update('people',$data);
		$data=[
			'title'=>'Member - Qutubuladmin.org',
			'sidebar'=>'template/sidebar',
			'active' => 'user',
			'id' => $id,
			'pid' => $pid,
			'd' => $d->result()			
		];
		$this->load->view('template/header',$data);
		$this->load->view('template/navbar');
		$this->load->view('template/sidebar',$data);
		$this->load->view('isi/user/profile',$data);
		$this->load->view('template/footer');
	} 

	function form($id=-1,$pid=-1)
	{
		if($id!=-1)
		{
			$d=$this->db->from('v_users')->where('p_id',$pid)->get();
			// $d=$this->db->query('select * from v_users where p_id="'.$pid.'"');
			$data['member']= $d->row('member');
			$data['d']=$d->result();
		}
		$data['id']=$id;
		$data['pid']=$pid;
		$this->load->view('isi/user/form',$data);
	}
	function proses($id=-1,$user='user',$pid=-1)
	{
		if(!empty($_POST))
		{
			$data=$_POST;
			$data['status_tampil']='1';

			$data['nama']=encrypt_decrypt('encrypt',$_POST['nama']);
			$data['no_identitas']=encrypt_decrypt('encrypt',$_POST['no_identitas']);
			$data['email']=encrypt_decrypt('encrypt',$_POST['email']);
			$data['telp']=encrypt_decrypt('encrypt',$_POST['telp']);
			$data['tempat_lahir']=encrypt_decrypt('encrypt',$_POST['tempat_lahir']);
			$data['tanggal_lahir']=encrypt_decrypt('encrypt',$_POST['tanggal_lahir']);
			$data['alamat']=encrypt_decrypt('encrypt',$_POST['alamat']);
			// if($user=='pro')
			$dd['level']=$data['level'];
			$dd['username']=encrypt_decrypt('encrypt',$data['username']);
			$dd['password']=$data['password'];
			unset($data['level']);
			unset($data['username']);
			unset($data['password']);

			if($id!=-1)
			{
				$this->db->where('id',$pid);
				$c=$this->db->update('people',$data);
				

				if($dd['password']!='')
				{
					$ps=encrypt_decrypt('encrypt',sha1(md5($dd['password'])));
					$dd['password']=$ps;

				}
				else
				{
					unset($dd['password']);
				}
					$this->db->where('id',$id);
					$this->db->update('users',$dd);

				if($c)
					echo 'Data Berhasil Di Edit';
				else
					echo 'Data Gagal Di Edit';

			}
			else
			{
				$c=$this->db->insert('people',$data);
				$people_id=$this->db->insert_id();	
				if($dd['password']!='')
				{
					$ps=encrypt_decrypt('encrypt',sha1(md5($dd['password'])));
					$dd['password']=$ps;
					$dd['status']='t';
					$dd['people_id']=$people_id;
					$this->db->insert('users',$dd);
				}

				if($c)
					echo 'Data Berhasil Di Simpan';
				else
					echo 'Data Gagal Di Simpan';
			}	
		}
		else
			echo 'Data Gagal Di Simpan';
	}
	function hapus($id)
	{
		$this->db->query('update people set status_tampil="0" where id="'.$id.'"');
		echo 'Data Berhasil Di Hapus';
	}

	function aktivasi($id,$status)
	{
		$this->db->query('update users set status="'.$status.'" where id="'.$id.'"');
		echo 'User Berhasil Di '.($status=='t'?'Aktifkan' : 'Non Aktifkan').'';
	}

	function containerdata($id=-1)
	{
		if($id!=-1)
		{
			$d=$this->db->from('v_users')->where('id',$id)->get();
			$data['d']=$d->result();
		}
		$data['id']=$id;
		$this->load->view('isi/user/data',$data);
	}
	
	function data()
	{
		// $this->load->view('isi/member/data');
		$d=$this->db->from('v_users')
			->where('status_tampil','1')
			->where('level IS NOT NULL',null,false)
			->order_by('u_status,nama')
			->get();

		$data=array();
		$field=$this->db->list_fields('v_users');
		
		//echo count($field);

		foreach ($d->result() as $k => $v) 
		{
			$id=$v->{$field[0]};			
			$pid=$v->{$field[7]};			
			// if($pid==1)
			// {
				$data[$k]['no']=($k+1);	

				if($v->{$field[5]}=='t')
				{
					$btn='<button class="btn btn-xs red" type="button" onclick="aktivasi(\''.$id.'\',\'f\')"><i class="fa fa-lock"></i></button>';
				}
				else
				{
					$btn='<button class="btn btn-xs green" type="button" onclick="aktivasi(\''.$id.'\',\'t\')"><i class="fa fa-unlock"></i></button>';
				}

				$data[$k]['action']='<button class="btn btn-xs green" type="button" onclick="edit(\'user\',\''.$id.'\',\''.$pid.'\')"><i class="fa fa-edit"></i></button>'.$btn.'<button class="btn btn-xs purple" type="button" onclick="hapus(\'user\',\''.$id.'\',\''.$pid.'\')"><i class="fa fa-trash"></i></button>';				
				$data[$k][$field[0]]=$id;
				$data[$k][$field[1]]=encrypt_decrypt('decrypt', $v->{$field[1]});
				$data[$k][$field[2]]=encrypt_decrypt('decrypt', $v->{$field[2]});
				$data[$k][$field[3]]=($v->{$field[3]} == 0 ? '<span class="label label-primary"> Admin </span>' : '<span class="label label-warning"> Non Admin </span>');
				$data[$k][$field[4]]=$v->{$field[4]};
				$data[$k][$field[5]]=($v->{$field[5]} == 't' ? '<span class="label label-success"> Active </span>' : '<span class="label label-danger"> Non Active </span>');
				$data[$k][$field[6]]=$v->{$field[6]};
				$data[$k][$field[7]]=$v->{$field[7]};
				$data[$k][$field[8]]=encrypt_decrypt('decrypt', $v->{$field[8]});
				$data[$k][$field[9]]=$v->{$field[9]};
				$data[$k][$field[10]]=$v->{$field[10]};
				$data[$k][$field[11]]=encrypt_decrypt('decrypt', $v->{$field[11]});
				$data[$k][$field[12]]=encrypt_decrypt('decrypt', $v->{$field[12]});
				$data[$k][$field[13]]=encrypt_decrypt('decrypt', $v->{$field[13]});
				$data[$k][$field[14]]=encrypt_decrypt('decrypt', $v->{$field[14]});
				$data[$k][$field[15]]=encrypt_decrypt('decrypt', $v->{$field[15]});
				$data[$k][$field[16]]=encrypt_decrypt('decrypt', $v->{$field[16]});
				$data[$k][$field[17]]=encrypt_decrypt('decrypt', $v->{$field[17]});
				$data[$k][$field[18]]=encrypt_decrypt('decrypt', $v->{$field[18]});
				$data[$k][$field[19]]=encrypt_decrypt('decrypt', $v->{$field[19]});
				$data[$k][$field[20]]=$v->{$field[20]};
				$data[$k][$field[21]]=encrypt_decrypt('decrypt', $v->{$field[21]});
				$data[$k][$field[22]]=encrypt_decrypt('decrypt', $v->{$field[22]});
				$data[$k][$field[23]]=$v->{$field[23]};
				$data[$k][$field[24]]=$v->{$field[24]};
				$data[$k][$field[25]]=$v->{$field[25]};
				$data[$k][$field[26]]=encrypt_decrypt('decrypt', $v->{$field[26]});
			// }

		}
		// echo '<pre>';
		// print_r($data);
		$json='{"data":'.json_encode($data).'}';
		echo $json;
	}
	
}

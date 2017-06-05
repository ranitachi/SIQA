<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once('Siqa.php');
class Config extends Siqa {

	public function configurasi()
	{
		$d=$this->db->from('app_config')->get();
		$data=[
			'title'=>'Konfigurasi - Qutubuladmin.org',
			'sidebar'=>'template/sidebar',
			'active' => 'config',
			'd'=>$d->result()
		];
		$this->load->view('template/header',$data);
		$this->load->view('template/navbar');
		$this->load->view('template/sidebar',$data);
		$this->load->view('isi/config/config',$data);
		$this->load->view('template/footer');
	}
	public function saveconfig()
	{
		if(!empty($_POST))
		{
			$s=$_POST['save'];
			foreach($s as $i => $si)
			{
				$sv=array('value'=>$si);
				$this->db->where('id',$i);
				$this->db->update('app_config',$sv);
			}
			$this->session->set_flashdata('pesan','Simpan Config Berhasil');
			redirect('config/configurasi','location');
		}
		$this->session->set_flashdata('pesan','Simpan Config Gagal');
		redirect('config/configurasi','location');
	}
//---------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------
	public function kaji()
	{
		$data=[
			'title'=>'Data Kaji - Qutubuladmin.org',
			'sidebar'=>'template/sidebar',
			'active' => 'config',
		];
		$this->load->view('template/header',$data);
		$this->load->view('template/navbar');
		$this->load->view('template/sidebar',$data);
		$this->load->view('isi/config/kaji-index',$data);
		$this->load->view('template/footer');
	}
	function kajiform($id=-1)
	{
		if($id!=-1)
		{
			// $wh='eve like "%'.$id.'%" or id="'.$id.'" or no_identitas like "%'.$id.'%"';
			$d=$this->db->from('level')->where('id',$id)->get();
			$dd=$d->result();
			$data['d']=$dd[0];
		}
		$data['id']=$id;
		$this->load->view('isi/config/kaji-form',$data);
	}
	function kajiproses($id=-1)
	{
		if(!empty($_POST))
		{
			$data=$_POST;
			$data['status_tampil']='t';

			if($id!=-1)
			{
				$this->db->where('id',$id);
				$c=$this->db->update('level',$data);
				
				if($c)
					$ps= 'Data Kaji Berhasil Di Edit';
				else
					$ps= 'Data Kaji Gagal Di Edit';

			}
			else
			{
				$c=$this->db->insert('level',$data);
				
				if($c)
					$ps= 'Data Kaji Berhasil Di Simpan';
				else
					$ps= 'Data Kaji Gagal Di Simpan';
			}	
		}
		else
			$ps= 'Data Kaji Gagal Di Simpan';

		$this->session->set_flashdata('pesan',$ps);
		redirect('config/kaji','location');
	}
	function kajihapus($id)
	{
		$this->db->query('update level set status_tampil="f" where id="'.$id.'"');
		echo 'Data Kaji Berhasil Di Hapus';
	}

	function kajicontainerdata($id=-1)
	{
		if($id!=-1)
		{
			// $wh='nama like "%'.$id.'%" or id="'.$id.'" or no_identitas like "%'.$id.'%"';
			$d=$this->db->from('level')->where('id',$id)->get();
			$data['d']=$d->result();
		}
		$data['id']=$id;
		$this->load->view('isi/config/kaji-data',$data);
	}
	function kajidata()
	{
		// $this->load->view('isi/member/data');
		$d=$this->db->from('level')
			->where('status_tampil','t')
			->order_by('level','asc')
			->get();

		$data=array();
		$field=$this->db->list_fields('level');
		foreach ($d->result() as $k => $v) 
		{
			$data[$k]['no']=$k+1;	
			$data[$k]['background']='<div style="width:100px;height:25px;padding:3px 2px;text-align:center;background:'.encrypt_decrypt('decrypt',$v->{$field[4]}).';color:'.encrypt_decrypt('decrypt',$v->{$field[5]}).'">T E X T</div>';	
			$id=$v->{$field[0]};						
			$data[$k][$field[0]]=$id;
			$data[$k][$field[1]]=encrypt_decrypt('decrypt',$v->{$field[1]});
			$data[$k][$field[2]]=encrypt_decrypt('decrypt',$v->{$field[2]});
			$data[$k][$field[3]]=$v->{$field[3]};
			$data[$k][$field[4]]=encrypt_decrypt('decrypt',$v->{$field[4]});
			$data[$k][$field[5]]=encrypt_decrypt('decrypt',$v->{$field[5]});
			$data[$k]['action']='<button class="btn btn-xs green" type="button" onclick="edit(\'level\',\''.$id.'\')"><i class="fa fa-edit"></i></button>			
								 <button class="btn btn-xs red" type="button" onclick="hapus(\'level\',\''.$id.'\')"><i class="fa fa-trash"></i></button>';
		}
		// echo '<pre>';
		// print_r($data);
		$json='{"data":'.json_encode($data).'}';
		echo $json;
	}
//---------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------	
	public function surau()
	{
		$data=[
			'title'=>'Data Surau - Qutubuladmin.org',
			'sidebar'=>'template/sidebar',
			'active' => 'config',
		];
		$this->load->view('template/header',$data);
		$this->load->view('template/navbar');
		$this->load->view('template/sidebar',$data);
		$this->load->view('isi/config/surau-index',$data);
		$this->load->view('template/footer');
	}
	function surauform($id=-1)
	{
		if($id!=-1)
		{
			// $wh='eve like "%'.$id.'%" or id="'.$id.'" or no_identitas like "%'.$id.'%"';
			$d=$this->db->from('surau')->where('id',$id)->get();
			$data['d']=$d->result();
		}
		$data['id']=$id;
		$this->load->view('isi/config/surau-form',$data);
	}
	function surauproses($id=-1)
	{
		if(!empty($_POST))
		{
			$data=$_POST;
			$data['status_tampil']='1';
			// $data['status']='1';

			if($id!=-1)
			{
				$this->db->where('id',$id);
				$c=$this->db->update('surau',$data);
				
				if($c)
					$ps= 'Data Surau Berhasil Di Edit';
				else
					$ps= 'Data Surau Gagal Di Edit';

			}
			else
			{
				$c=$this->db->insert('surau',$data);
				
				if($c)
					$ps= 'Data Surau Berhasil Di Simpan';
				else
					$ps= 'Data Surau Gagal Di Simpan';
			}	
		}
		else
			$ps= 'Data Surau Gagal Di Simpan';

		$this->session->set_flashdata('pesan',$ps);
		redirect('config/surau','location');
	}
	function surauhapus($id)
	{
		$this->db->query('update surau set status_tampil="0" where id="'.$id.'"');
		echo 'Data Surau Berhasil Di Hapus';
	}

	function suraucontainerdata($id=-1)
	{
		if($id!=-1)
		{
			// $wh='nama like "%'.$id.'%" or id="'.$id.'" or no_identitas like "%'.$id.'%"';
			$d=$this->db->from('surau')->where('id',$id)->get();
			$data['d']=$d->result();
		}
		$data['id']=$id;
		$this->load->view('isi/config/surau-data',$data);
	}
	function suraudata()
	{
		// $this->load->view('isi/member/data');
		$d=$this->db->from('surau')
			->where('status_tampil','1')
			->order_by('namasurau','asc')
			->get();

		$data=array();
		$field=$this->db->list_fields('surau');
		foreach ($d->result() as $k => $v) 
		{
			$data[$k]['no']=$k+1;							
			$id=$v->{$field[0]};						
			$data[$k][$field[0]]=$id;
			$data[$k][$field[1]]=encrypt_decrypt('decrypt',$v->{$field[1]});
			$data[$k][$field[2]]=encrypt_decrypt('decrypt',$v->{$field[2]});
			$data[$k][$field[3]]=$v->{$field[3]};
			$data[$k]['action']='<button class="btn btn-xs green" type="button" onclick="edit(\'surau\',\''.$id.'\')"><i class="fa fa-edit"></i></button>			
								 <button class="btn btn-xs red" type="button" onclick="hapus(\'surau\',\''.$id.'\')"><i class="fa fa-trash"></i></button>';
		}
		// echo '<pre>';
		// print_r($data);
		$json='{"data":'.json_encode($data).'}';
		echo $json;
	}
//---------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------
	public function backup()
	{
		$data=[
			'title'=>'Backup Database - Qutubuladmin.org',
			'sidebar'=>'template/sidebar',
			'active' => 'config',
		];
		$this->load->view('template/header',$data);
		$this->load->view('template/navbar');
		$this->load->view('template/sidebar',$data);
		$this->load->view('isi/config/backup-index',$data);
		$this->load->view('template/footer');
	}
	function backupcontainerdata($id=-1)
	{
		if($id!=-1)
		{
			// $wh='nama like "%'.$id.'%" or id="'.$id.'" or no_identitas like "%'.$id.'%"';
			$d=$this->db->from('backup_database')->where('id',$id)->get();
			$data['d']=$d->result();
		}
		$data['id']=$id;
		$this->load->view('isi/config/backup-data',$data);
	}
	function backupdata()
	{
		// $this->load->view('isi/member/data');
		$d=$this->db->from('backup_database')
			->order_by('tanggal_backup','desc')
			->get();

		$data=array();
		$field=$this->db->list_fields('backup_database');
		foreach ($d->result() as $k => $v) 
		{
			
			$data[$k]['no']=$k+1;							
			$data[$k][$field[0]]=$v->{$field[0]};
			$data[$k][$field[1]]=$v->{$field[1]};
			$data[$k][$field[2]]=encrypt_decrypt('decrypt',$v->{$field[2]});
		}

		// echo '<pre>';
		// print_r($data[$kategori]);
		// $json='{"data":'.json_encode($data).'}';
		// echo '<pre>';
		$json='{"data":'.json_encode($data).'}';
		echo $json;
	}
//---------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------
	public function seat()
	{
		$data=[
			'title'=>'Data Seat - Qutubuladmin.org',
			'sidebar'=>'template/sidebar',
			'active' => 'config',
		];
		$this->load->view('template/header',$data);
		$this->load->view('template/navbar');
		$this->load->view('template/sidebar',$data);
		$this->load->view('isi/config/seat-index',$data);
		$this->load->view('template/footer');
	}
	function seatform($id=-1)
	{
		if($id!=-1)
		{
			// $wh='eve like "%'.$id.'%" or id="'.$id.'" or no_identitas like "%'.$id.'%"';
			$d=$this->db->from('seat')->where('id',$id)->get();
			$data['d']=$d->result();
		}
		$data['id']=$id;
		$this->load->view('isi/config/seat-form',$data);
	}
	function seatproses($id=-1)
	{
		if(!empty($_POST))
		{
			$data=$_POST;
			$data['status_tampil']='t';
			$data['nomor']=$data['huruf'].'-'.$data['angka'];

			if($id!=-1)
			{
				$this->db->where('id',$id);
				$c=$this->db->update('seat',$data);
				
				if($c)
					$ps= ucwords('Data Seat Berhasil Di Edit');
				else
					$ps= ucwords('Data seat Gagal Di Edit');

			}
			else
			{
				$c=$this->db->insert('seat',$data);
				
				if($c)
					$ps= ucwords('Data seat Berhasil Di Simpan');
				else
					$ps= ucwords('Data seat Gagal Di Simpan');
			}	
		}
		else
			$ps= ucwords('Data seat Gagal Di Simpan');

		$this->session->set_flashdata('pesan',$ps);
		redirect('config/seat','location');
	}
	function seathapus($id)
	{
		$this->db->query('update seat set status_tampil="f" where id="'.$id.'"');
		echo 'Data Seat Berhasil Di Hapus';
	}

	function seatcontainerdata($id=-1)
	{
		if($id!=-1)
		{
			// $wh='nama like "%'.$id.'%" or id="'.$id.'" or no_identitas like "%'.$id.'%"';
			$d=$this->db->from('seat')->where('id',$id)->get();
			$data['d']=$d->result();
		}
		$data['id']=$id;
		$this->load->view('isi/config/seat-data',$data);
	}
	function seatdata($kategori)
	{
		// $this->load->view('isi/member/data');
		$d=$this->db->from('seat')
			->where('status_tampil','t')
			->order_by('huruf asc, angka asc')
			->get();

		$data=array();
		$field=$this->db->list_fields('seat');
		$idxp=$idxl=0;
		foreach ($d->result() as $k => $v) 
		{
			$kat=encrypt_decrypt('decrypt',$v->kategori);
			if($kat=='laki-laki')
			{
				$kk=$idxl;
				$idxl++;
			}	
			else
			{
				$kk=$idxp;
				$idxp++;
			}
			// $kl=$kk;
			$data[$kat][$kk]['no']=$kk+1;		
			$id=$v->{$field[0]};					
			$data[$kat][$kk][$field[0]]=$id;
			$data[$kat][$kk][$field[1]]=$v->{$field[1]};
			$data[$kat][$kk][$field[2]]=$v->{$field[2]};
			$data[$kat][$kk][$field[3]]=$v->{$field[3]};
			$data[$kat][$kk][$field[4]]=$v->{$field[4]};
			$data[$kat][$kk][$field[5]]=encrypt_decrypt('decrypt',$v->{$field[5]});
			$data[$kat][$kk][$field[6]]=encrypt_decrypt('decrypt',$v->{$field[6]});
			$data[$kat][$kk]['action']='<button class="btn btn-xs green" type="button" onclick="edit(\'seat\',\''.$id.'\')"><i class="fa fa-edit"></i></button><button class="btn btn-xs red" type="button" onclick="hapus(\'seat\',\''.$id.'\')"><i class="fa fa-trash"></i></button>';
		}

		// echo '<pre>';
		// print_r($data[$kategori]);
		// $json='{"data":'.json_encode($data).'}';
		// echo '<pre>';
		$json=substr(json_encode($data[$kategori]), 1, -1);
		echo '{"data":['.$json.']}';
	}
}
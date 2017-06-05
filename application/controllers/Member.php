<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once('Siqa.php');
class Member extends Siqa {

	public function index($member='t')
	{
		$data=[
			'title'=>'Member - Qutubuladmin.org',
			'sidebar'=>'template/sidebar',
			'active' => 'member',
			'member' => $member,
			'headertable' => $this->headertable('people')			
		];
		$this->load->view('template/header',$data);
		$this->load->view('template/navbar');
		$this->load->view('template/sidebar',$data);
		$this->load->view('isi/member/index',$data);
		$this->load->view('template/footer');
	}

	function form($member,$id=-1)
	{
		if($id!=-1)
		{
			$wh='id="'.$id.'"';
			$d=$this->db->from('people')->where($wh)->get();
			$dd=$d->result();
			$data['d']=$dd[0];
		}
		$data['id']=$id;
		$data['member']=$member;
		$this->load->view('isi/member/form',$data);
	}
	function proses($id=-1)
	{
		// echo '<pre>';
		// print_r($_POST);
		// echo '</pre>';
		if(!empty($_POST))
		{
			$data=$_POST;
			$data['status_tampil']='1';

			// if()
			$data['no_identitas']=encrypt_decrypt('encrypt',$data['no_identitas']);
			$data['asal']=encrypt_decrypt('encrypt',$data['asal']);
			$data['alamat']=encrypt_decrypt('encrypt',$data['alamat']);
			$data['nama']=encrypt_decrypt('encrypt',$data['nama']);
			$data['email']=encrypt_decrypt('encrypt',$data['email']);
			$data['telp']=encrypt_decrypt('encrypt',$data['telp']);
			$data['foto']=encrypt_decrypt('encrypt',$data['foto']);
			$data['tempat_lahir']=encrypt_decrypt('encrypt',$data['tempat_lahir']);
			$data['tanggal_lahir']=encrypt_decrypt('encrypt',$data['tanggal_lahir']);
			$data['status']=encrypt_decrypt('encrypt',$data['status']);
			$data['pendidikan']=encrypt_decrypt('encrypt',$data['pendidikan']);
			$data['nama_orang_tua']=encrypt_decrypt('encrypt',$data['nama_orang_tua']);
			$data['itikafke']=$data['itikafke'];
			$data['kaji']=$data['kaji'];
			$data['pekerjaan']=encrypt_decrypt('encrypt',$data['pekerjaan']);
			// list($tg1,$bl1,$th1)=explode('/', $_POST['tanggal_lahir']);
			// list($tg2,$bl2,$th2)=explode('/', $_POST['tgl_pelantikan']);
			// list($tg3,$bl3,$th3)=explode('/', $_POST['tgl_terdaftar']);
			// $data['tanggal_lahir']=$th1.'-'.$bl1.'-'.$tg1;
			// $data['tgl_pelantikan']=$th2.'-'.$bl2.'-'.$tg2;
			// $data['tgl_terdaftar']=$th3.'-'.$bl3.'-'.$tg3;
			if($id!=-1)
			{
				$this->db->where('id',$id);
				$c=$this->db->update('people',$data);
				
				if($c)
					echo 'Data Berhasil Di Edit';
				else
					echo 'Data Gagal Di Edit';

			}
			else
			{
				$c=$this->db->insert('people',$data);
				
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

	function containerdata($member,$id=-1)
	{
		if($id!=-1)
		{
			$wh='nama like "%'.$id.'%" or id="'.$id.'" or no_identitas like "%'.$id.'%"';
			$d=$this->db->from('people')->where($wh)->get();
			$data['d']=$d->result();
		}
		$data['id']=$id;
		$data['member']=$member;
		$this->load->view('isi/member/data',$data);
	}
	
	function data($member)
	{
		// $this->load->view('isi/member/data');
		$d=$this->db->from('people')
			->where('status_tampil','1')
			->where('member',$member)
			->order_by('nama')
			->get();

		$data=array();
		$field=$this->db->list_fields('people');
		
		//echo count($field);

		foreach ($d->result() as $k => $v) 
		{
			$data[$k]['no']=$k+1;				
			$id=$v->{$field[0]};
			$data[$k][$field[0]]=$id;
			$data[$k][$field[1]]=(encrypt_decrypt('decrypt', $v->{$field[1]})==false ? '': encrypt_decrypt('decrypt', $v->{$field[1]}));
			// $data[$k][$field[1]]=$v->{$field[1]};
			$data[$k][$field[2]]=$v->{$field[2]};
			$data[$k][$field[3]]=$v->{$field[3]};
			$data[$k][$field[4]]=$v->{$field[4]};
			$data[$k][$field[5]]=encrypt_decrypt('decrypt', $v->{$field[5]});
			// $data[$k][$field[5]]=$v->{$field[5]};
			// $data[$k][$field[6]]=$v->{$field[6]};
			$data[$k][$field[6]]=encrypt_decrypt('decrypt', $v->{$field[6]});
			$data[$k][$field[7]]=$v->{$field[7]};
			// $data[$k][$field[8]]=$v->{$field[8]};
			$data[$k][$field[8]]=encrypt_decrypt('decrypt', $v->{$field[8]});
			$data[$k][$field[9]]=$v->{$field[9]};
			$data[$k][$field[10]]=$v->{$field[10]};
			$data[$k][$field[11]]=$v->{$field[11]};
			$data[$k][$field[12]]=$v->{$field[12]};
			$data[$k][$field[13]]=$v->{$field[13]};
			$data[$k][$field[14]]=$v->{$field[14]};
			$data[$k][$field[15]]=$v->{$field[15]};
			$data[$k][$field[16]]=$v->{$field[16]};
			$data[$k][$field[17]]=$v->{$field[17]};
			$data[$k][$field[18]]=$v->{$field[18]};
			$data[$k][$field[19]]=$v->{$field[19]};
			$data[$k][$field[20]]=$v->{$field[20]};
			$data[$k][$field[21]]=$v->{$field[21]};
			$data[$k][$field[22]]=$v->{$field[22]}. ($v->{$field[22]}>0 ? '&nbsp;&nbsp;&nbsp;&nbsp;<i style="cursor:pointer" class="fa fa-plus-square" onclick="additikaf(\''.$id.'\',\''.$v->{$field[22]}.'\')"></i>' : '');
			$data[$k][$field[23]]=$v->{$field[23]};
			$data[$k][$field[24]]=$v->{$field[24]};
			$data[$k]['action']='<button class="btn btn-xs green" type="button" onclick="edit(\'people\',\''.$id.'\')"><i class="fa fa-edit"></i></button>			
								 <button class="btn btn-xs red" type="button" onclick="hapus(\'people\',\''.$id.'\')"><i class="fa fa-trash"></i></button>';
		}
		// echo '<pre>';
		// print_r($data);
		$json='{"data":'.json_encode($data).'}';
		echo $json;
	}

	function datamember($id=null,$event_id=null,$jenisevent=null,$tgllahir=null)
	{
		$noseat='';
		$ik=1;
		$iden=encrypt_decrypt('encrypt',$id);
		if($tgllahir==null)
		{
			$tglhr='0000-00-00';
			list($th_,$bl_,$tg_)=explode('-', $tglhr);
		}
		else
		{
			list($tg_,$bl_,$th_)=explode('-', $tgllahir);
			$tglhr=$th_.'-'.$bl_.'-'.$tg_;
		}

		if($id!=null)
		{
			$adn=$this->db->query('select * from v_users where status_tampil=1 and (no_identitas="'.$iden.'" or p_id="'.$id.'") and (tanggal_lahir="'.encrypt_decrypt('encrypt',$tglhr).'" or tanggal_lahir="'.encrypt_decrypt('encrypt',$tg_.'/'.$bl_.'/'.$th_).'")');

			if(count($adn->result())!=0)
			{
				if($jenisevent=='member')
				{
					if($adn->row('kelamin')=='w')
						$kl=encrypt_decrypt('encrypt','perempuan');
					else
						$kl=encrypt_decrypt('encrypt','laki-laki');

					$nn=$this->db->query('select * from seat where status_tampil="t" and kategori="'.$kl.'" order by rand() limit 1');
					$nomor=$nn->row('nomor');
					$noseat=$this->rekseat($nomor,$event_id,$kl);			

					$itikafke=$this->db->query('select max(itikafke) as mm from itikaf where people_id="'.$id.'"');
					$ik=$adn->row('itikafke')+1;
					//$noseat=$this->rekseat($nomor,$event_id);
				}

				$cek=$this->db->query('select * from people_has_event where people_id="'.$adn->row('p_id').'" and event_id="'.$event_id.'"');
				if(count($cek->result())!=0)
				{
					$a='{"Error" : "1"}';
					echo $a;
				}
				else
				{
					$json = array();
					if(count($adn->result())!=0)
					{
						// $json=$adn->result_array();
						// unset($json['asal']);
						// echo '<pre>';
						// print_r($adn->result_array());
						// echo '</pre>';
						foreach ($adn->result_array() as $k => $v) 
						{
							foreach ($v as $kv => $vv) 
							{
								# code...
								// if($kv=="p_status")
								// 	$json[$kv]=encrypt_decrypt('decrypt',$vv);

								if(encrypt_decrypt('decrypt',$vv)==false)
									$json[$kv]=$vv;
								else
									$json[$kv]=encrypt_decrypt('decrypt',$vv);

								if($kv=='tanggal_lahir')
								{
									if(strpos(encrypt_decrypt('decrypt',$vv), '/')!==false)
									{
										list($tg,$bl,$th)=explode('/', encrypt_decrypt('decrypt',$vv));
										$json[$kv]=$th.'-'.$bl.'-'.$tg;
									}
									else
										$json[$kv]=encrypt_decrypt('decrypt',$vv);
										
								}
							}
							// $json['asal']=encrypt_decrypt('decrypt',$v->asal);
							// $json['no_identitas']=encrypt_decrypt('decrypt',$v->no_identitas);
							// $json['alamat']=encrypt_decrypt('decrypt',$v->alamat);
							// $json['nama']=encrypt_decrypt('decrypt',$v->nama);
							# code...
							// if(encrypt_decrypt('decrypt',$v->)==false)
						}
					}
					$a=json_encode($json);
					$a=str_replace('[','',$a);
					$a=str_replace('}',',"Error":"0","noseat":"'.$noseat.'","itikafke":"'.$ik.'"}',$a);
					//$bar=htmlentities(bar128(stripslashes($d->row('no_identitas'))));
					// $a.=;
					echo $a;
				}
			}
			else
			{
				$a='{"Error" : "1"}';
				echo $a;
			}
		}
		// $adnn=$this->db->query('select * from v_users where status_tampil=1 and level is null order by nama');
		// if($adnn->num_rows!=0)
		// {


		// 	$a.='[';
		// 	foreach($adnn->result() as $ad)
		// 	{
		// 		$a.='"'.$ad->nama.'",';
		// 	}
		// 	$a=substr($a,0,-1).']';

		// 	// echo $a;
		// }
	}
	
	function rekseat($nomor,$idevent,$kelamin)
	{
		$seat=$this->db->query('select * from people_has_event where event_id="'.$idevent.'" and nomorseat="'.$nomor.'"');
		if(count($seat->result())==0)
		{
			return $nomor;
		}
		else
		{
			$nn=$this->db->query('select * from seat where status_tampil="t" and kategori="'.$kelamin.'" order by rand() limit 1');
			$nomor=$nn->row('nomor');
			$this->rekseat($nomor,$idevent);
		}
	}

	function formitikaf($id,$jlh)
	{
		$data=array(
			'id'=>$id,
			'jlh'=>$jlh
		);
		$this->load->view('isi/member/itikaf',$data);

	}

	function simpanitikaf($id)
	{
		// print_r($_POST);
		if(!empty($_POST))
		{
			$people=$this->db->from('people')->where('id',$id)->get()->result();
			foreach ($_POST['event'] as $k => $v) 
			{
				list($idevent,$event)=explode('__', $v);
				$in['people_id']=$id;
				$in['event_id']=$idevent;
				$in['event']=encrypt_decrypt('encrypt',$event);
				$in['nama']=$people[0]->nama;
				$in['tgl_ikut']=$_POST['tglikut'][$k];
				$in['yang_ke']=$_POST['itikafke'][$k];
				$c=$this->db->insert('event_att',$in);
			}
			if($c)
				echo 'Data Record Itikaf Berhasil Disimpan';
			else
				echo 'Data Record Itikaf Gagal Disimpan';
		}
	}

	function hapusitikaf($id,$i)
	{
		$this->db->query('delete from event_att where people_id="'.$id.'" and yang_ke="'.$i.'"');
		echo 'Data Record Itikaf Berhasil Di Hapus';
	}

	function datamemberjson()
	{
		$data=$this->db->from('people')->where('status_tampil',1)->get()->result();
		$d=array();
		foreach ($data as $k => $v) 
		{
			$d[$k]['id']=$v->id;
			$d[$k]['jenis_identitas']=$v->jenis_identitas;
			$d[$k]['nama']=encrypt_decrypt('decrypt',$v->nama);
			$d[$k]['no_identitas']=encrypt_decrypt('decrypt',$v->no_identitas);
			$d[$k]['alamat']=encrypt_decrypt('decrypt',$v->alamat);
			$d[$k]['tanggal_lahir']=encrypt_decrypt('decrypt',$v->tanggal_lahir);
		}
		echo json_encode($d);
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once('Siqa.php');
class Event extends Siqa {

	public function index($member='umum')
	{
		$data=[
			'title'=>'Event - Qutubuladmin.org',
			'sidebar'=>'template/sidebar',
			'active' => 'event',
			'member' => $member,
			'headertable' => $this->headertable('event')			
		];
		$this->load->view('template/header',$data);
		$this->load->view('template/navbar');
		$this->load->view('template/sidebar',$data);
		$this->load->view('isi/event/index',$data);
		$this->load->view('template/footer');
	}

	function form($member,$id=-1)
	{
		if($id!=-1)
		{
			// $wh='eve like "%'.$id.'%" or id="'.$id.'" or no_identitas like "%'.$id.'%"';
			$d=$this->db->from('event')->where('id',$id)->get();
			$dd=$d->result();
			$data['d']=$dd[0];
		}
		$data['id']=$id;
		$data['member']=$member;
		$this->load->view('isi/event/form',$data);
	}
	function proses($id=-1)
	{
		if(!empty($_POST))
		{
			$d=$_POST;
			list($time_start,$time_finish)=explode('-', $_POST['waktu']);
			list($tgg,$bll,$thh)=explode('/', trim($time_start));
			list($tgg2,$bll2,$thh2)=explode('/', trim($time_finish));

			$date1=date_create($thh.'-'.$bll.'-'.$tgg);
																//$date1=date_create((date('Y')+1).'-'.date('m-d'));
			$date2=date_create($thh2.'-'.$bll2.'-'.$tgg2);
			$diff=date_diff($date1,$date2);
			$jlhhari=(int)$diff->format("%a") + 1;	
			
			$d['event_time']=($thh.'-'.$bll.'-'.$tgg);
			$d['event_time_finish']=$thh2.'-'.$bll2.'-'.$tgg2;
			$d['count_of_day']=$jlhhari;
			unset($d['waktu']);
			// 	$data=$_POST;
			// 	$data['status']='t';

			$d['event_name']=encrypt_decrypt('encrypt',$_POST['event_name']);
			$d['event_place']=encrypt_decrypt('encrypt',$_POST['event_place']);
			$d['jenis']=encrypt_decrypt('encrypt',$_POST['jenis']);

			if($id!=-1)
			{
				// echo '<pre>';
				// print_r($d);
				// echo '</pre>';
				$this->db->where('id',$id);
				$c=$this->db->update('event',$d);
				
				if($c)
					echo 'Data Event Berhasil Di Edit';
				else
					echo 'Data Event Gagal Di Edit';
			}
			else
			{
				$c=$this->db->insert('event',$d);
				
				if($c)
					echo 'Data Event Berhasil Di Simpan';
				else
					echo 'Data Event Gagal Di Simpan';
			}	
		}
		else
			echo 'Data Event Gagal Di Simpan';
	}
	function hapus($id)
	{
		$this->db->query('update event set status="f" where id="'.$id.'"');
		echo 'Data Event Berhasil Di Hapus';
	}

	function containerdata($member,$id=-1)
	{
		if($id!=-1)
		{
			// $wh='nama like "%'.$id.'%" or id="'.$id.'" or no_identitas like "%'.$id.'%"';
			$d=$this->db->from('event')->where('id',$id)->get();
			$data['d']=$d->result();
		}
		$data['id']=$id;
		$data['member']=$member;
		$this->load->view('isi/event/data',$data);
	}
	
	function data($member)
	{
		// $this->load->view('isi/member/data');
		$d=$this->db->from('event')
			->where('status','t')
			->where('jenis',encrypt_decrypt('encrypt',$member))
			->order_by('event_time','desc')
			->get();

		$data=array();
		$field=$this->db->list_fields('event');
		
		//echo count($field);

		foreach ($d->result() as $k => $v) 
		{
			$jlhpeserta=$this->jlhpeserta($v->{$field[0]});
			$data[$k]['no']=$k+1;				
			$data[$k]['jlhpeserta']='<span class="badge badge-info"> '.$jlhpeserta.' Orang</span>';				
			$id=$v->{$field[0]};
			$data[$k][$field[0]]=$id;
			$data[$k][$field[1]]='<a href="'.site_url().'event/detail/'.$member.'/'.$id.'">'.encrypt_decrypt('decrypt',$v->{$field[1]}).'</a>';
			$data[$k][$field[2]]=tgl_indo2($v->{$field[2]}).' - '.tgl_indo2($v->{$field[8]});
			$data[$k][$field[3]]=encrypt_decrypt('decrypt',$v->{$field[3]});
			$data[$k][$field[4]]=($v->{$field[4]} == 't' ? '<span class="label label-success"> Active </span>' : '<span class="label label-danger"> Non Active </span>');
			$data[$k][$field[5]]=$v->{$field[5]};
			$data[$k][$field[6]]=$v->{$field[6]};
			$data[$k][$field[7]]=$v->{$field[7]};
			$data[$k][$field[8]]=$v->{$field[8]};
			$data[$k][$field[9]]=$v->{$field[9]};
			$data[$k]['action']='<button class="btn btn-xs green" type="button" onclick="edit(\'event\',\''.$id.'\')"><i class="fa fa-edit"></i></button>			
								 <button class="btn btn-xs red" type="button" onclick="hapus(\'event\',\''.$id.'\')"><i class="fa fa-trash"></i></button>';
		}
		// echo '<pre>';
		// print_r($data);
		$json='{"data":'.json_encode($data).'}';
		echo $json;
	}

	function jlhpeserta($event_id)
	{
		$db=$this->db->from('people_has_event')
				->where('event_id',$event_id)
				->get();
		return count($db->result());
	}
	function detailinfo($member,$id)
	{
		$d=$this->db->from('event')->where('id',$id)->get()->result();
		$tot=$this->db->query('select sum(sedekah) as sedekah, sum(biaya_makan) as biayamakan from record_ikut where event_id="'.$id.'"')->result();
		$jpes=$this->db->query('select p.kelamin,phe.id idh,count(*) jlhpes from people_has_event as phe inner join people as p on (p.id=phe.people_id) where phe.event_id="'.$id.'" group by kelamin order by p.nama')->result();
		$jlhpr=$jlhwb=0;
		foreach ($jpes as $k => $v) 
		{
			if($v->kelamin=='p')
				$jlhpr+=$v->jlhpes;
			else if($v->kelamin=='w')
				$jlhwb+=$v->jlhpes;
												// $jlhwb++;
		}

		$data=[
			'jlhsedekah' => $tot[0]->sedekah,
			'biayamakan' => $tot[0]->biayamakan,
			'jlhpr' => $jlhpr,
			'jlhwb' => $jlhwb,
			'member' => $member,
			'd' => $d
		];
		$this->load->view('isi/event/detail-info',$data);
	}
	function detail($member,$id)
	{
		$d=$this->db->from('event')->where('id',$id)->get()->result();
		
		// $dd=$d->result();
		$data=[
			'title'=>'Detail Event - Qutubuladmin.org',
			'sidebar'=>'template/sidebar',
			'active' => 'event',
			'member' => $member,
			'd' => $d,
			'headertable' => $this->headertable('event')			
		];
		$this->load->view('template/header',$data);
		$this->load->view('template/navbar');
		$this->load->view('template/sidebar',$data);
		$this->load->view('isi/event/detail',$data);
		$this->load->view('template/footer');
	}
	function countainerdetaildata()
	{
		$this->load->view('isi/event/data-detail');
	}
	function detaildata($idevent,$kelamin,$member='umum')
	{
		// $this->load->view('isi/member/data');
		//$d=
		$d=$this->db->query('select *,phe.id idh from people_has_event as phe inner join people as p on (p.id=phe.people_id) where phe.event_id="'.$idevent.'" and kelamin="'.$kelamin.'" order by p.nama');

		$data=array();
		foreach ($d->result() as $k => $v) 
		{
			$data[$k]['no']=$k+1;		
			$data[$k]['nama']=encrypt_decrypt('decrypt',$v->nama);				
			$data[$k]['asal']=encrypt_decrypt('decrypt',$v->asal);				
			$data[$k]['tanggal_lahir']=str_replace('undefined/','',encrypt_decrypt('decrypt',$v->tanggal_lahir));


			$cekpeople=$this->db->query('select * from people_has_event where event_id="'.$idevent.'" and people_id="'.$v->people_id.'"');
			if($cekpeople->row('form')=='t')
				$fn='font-red';
			else
				$fn='';

			if($cekpeople->row('barcode')=='t')
				$fcb='font-red';
			else
				$fcb='';



			if($member!='umum')
			{



				$data[$k]['action']='
				<i class="fa fa-trash font-dark" onclick="hapus(\'people_has_event\',\''.$v->idh.'\',\''.$idevent.'\')" style="cursor:pointer"></i>&nbsp;&nbsp;
				<i class="fa fa-barcode '.$fcb.'" onclick="barcodeevent(\''.$v->idh.'\',\''.$idevent.'\')" style="cursor:pointer"></i>&nbsp;&nbsp;
				<i class="fa fa-book '.$fn.'" alt="Generate Formulir" onclick="formulir(\''.$idevent.'\',\''.$v->people_id.'\')" style="cursor:pointer"></i>&nbsp;&nbsp;
				<i class="fa fa-credit-card" alt="Generate Sertifikat" onclick="setifikat(\''.$v->idh.'\',\''.$idevent.'\')" style="cursor:pointer"></i>';

			}		
			else{
				$data[$k]['action']='
				<i class="fa fa-trash font-dark" onclick="hapus(\'people_has_event\',\''.$v->idh.'\',\''.$idevent.'\')" style="cursor:pointer"></i>&nbsp;&nbsp;
				<i class="fa fa-barcode '.$fcb.'" onclick="barcodeevent(\''.$v->idh.'\',\''.$idevent.'\')" style="cursor:pointer"></i>';

			}		
		}
		// echo '<pre>';
		// print_r($data);
		$json='{"data":'.json_encode($data).'}';
		echo $json;
	}


	function countaineragenda($id)
	{
		$data['id']=$id;
		$d=$this->db->from('event')->where('id',$id)->get()->result();

		$data['d']=$d[0];
		$this->load->view('isi/event/agenda',$data);
	}
	function agendadata($id)
	{
		$dd=$this->db->query('select * from event_detail where event_id="'.$id.'" and status!="f" order by detail_time')->result();
		$data['data']=$dd;
		$data['id']=$id;
		$this->load->view('isi/event/agenda-data',$data);
	}
	function formagenda($id=-1)
	{
		if($id!=-1)
		{
			// $wh='eve like "%'.$id.'%" or id="'.$id.'" or no_identitas like "%'.$id.'%"';
			$d=$this->db->from('event')->where('id',$id)->get();
			$data['d']=$d->result();
		}
		$data['id']=$id;
		$this->load->view('isi/event/agenda-form',$data);
	}
	function agendaposes($id)
	{
		if(!empty($_POST))
		{
			$data['detail_name']=encrypt_decrypt('encrypt',$_POST['detail_name']);
			$data['detail_time']=$_POST['date'].' '.$_POST['hour'].':'.$_POST['minute'];
			$data['event_id']=$id;
			$data['status']=encrypt_decrypt('encrypt','t');
			$in=$this->db->insert('event_detail',$data);
			if($in)
				echo 'Data Detail Agenda Berhasil Disimpan';
			else
				echo 'Data Detail Agenda Gagal Disimpan';
		}
	}
	function hapusagenda($id)
	{
		$this->db->set('status','f');
		$this->db->where('id',$id);
		$this->db->update('event_detail');
		echo  'Data Agenda Berhasil Di Hapus';
	}
	function containeragendadatadetail()
	{
		$this->load->view('isi/event/agenda-data-detail');
	}
	function caripesertaform($agendaid,$eventid)
	{
		$d=$this->db->from('event')->where('id',$eventid)->get();
		$data['det']=$d->result();
		$data['agendaid']=$agendaid;
		$data['eventid']=$eventid;
		$this->load->view('isi/event/agenda-data-cari',$data);
	}
	function addagendamember($event_id,$eventDetailId,$data=null)
	{


			// echo $event_id.'<br>'.$eventDetailId.'<br>'.$data;
			list($ev_id,$list_id,$thn,$bln,$tgl)=explode('%20',$data);
			$detEvent=$this->db->query('select * from event_detail where event_id="'.$ev_id.'" and id="'.$eventDetailId.'"');

			if(count($detEvent->result())!=0)
			{
				$cek=$this->db->query('select * from people_has_event_detail where kode_barcode="'.$data.'" and event_detail_id="'.$eventDetailId.'"');
				if(count($cek->result())!=0)
				{
					echo '<div style="padding:50px 0 150px 0;width:100%;left:0px;height:250px;font-size:100px;background:red;color:white;text-align:center;">FAIL</div>';
				}
				else
				{
					$add=array(
						'people_id'=>$list_id,
						'event_detail_id'=> $eventDetailId,
						'kode_barcode' => $data,
						'waktu_record' => date('Y-m-d H:i:s'),
					);
					$this->db->insert('people_has_event_detail',$add);
					echo '<div style="padding:50px 0 150px 0;width:100%;height:250px;left:0px;font-size:100px;background:green;color:white;text-align:center;" >OK</div>';
				}
			}
			else
			{
				echo '<div style="padding:50px 0 150px 0;width:100%;left:0px;height:250px;font-size:100px;background:red;color:white;text-align:center;">FAIL</div>';
			}

	}
	function agendadatadetail($agendaid,$eventid)
	{
		$d=$this->db->query('select * 
							from people_has_event_detail as phed 
							inner join event_detail as ed on (ed.id=phed.event_detail_id)
							inner join people_has_event as phe on (phed.people_id=phe.id)
							inner join people as p on (p.id=phe.people_id)
							where ed.event_id="'.$eventid.'" and phed.event_detail_id="'.$agendaid.'"  group by p.id order by phed.id desc');
		foreach ($d->result() as $k => $v) 
		{
			$data[$k]['no']=$k+1;		
			$data[$k]['nama']=encrypt_decrypt('decrypt',$v->nama);				
			$data[$k]['tanggal_lahir']=encrypt_decrypt('decrypt',$v->tanggal_lahir);				
			$data[$k]['waktu_record']=$v->waktu_record;				
		}
		// echo '<pre>';
		// print_r($data);
		$json='{"data":'.json_encode($data).'}';
		echo $json;
	}
	function addpeserta($member,$id)
	{
		$data['member']=$member;
		$data['id']=$id;
		$d=$this->db->from('event')->where('id',$id)->get()->result();
		$data['det']=$d[0];
		if($member=='umum')
			$this->load->view('isi/event/peserta-add-form',$data);
		else
			$this->load->view('isi/event/peserta-add-form-khusus',$data);
	}
	function hapusdatapeserta($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('people_has_event');
		echo "Data Kepesertaan Sudah Dihapus";
	}
	function addmember($event_id=null,$jenis_event=null)
	{
		if($event_id!=null)
		{
			$evn=$this->db->query('select * from event where id="'.$event_id.'"');
			if(!empty($_POST))
			{

				$d=$_POST;
				$d['foto']='';
				if(strpos($d['tanggal_lahir'],'/')!==false)
					list($tggl,$blln,$thhn)=explode('/', $d['tanggal_lahir']);
				else
					list($thhn,$blln,$tggl)=explode('-', $d['tanggal_lahir']);

				$d['tanggal_lahir']=$tanggal_lahir=$thhn.'-'.$blln.'-'.$tggl;
				$d['usia']=(date('Y')-strtok($tanggal_lahir,'-'));
				if(!empty($_POST['id']))
				{
					$d['id']=$_POST['id'];
				}
				else
				{
					$inp=$_POST;

					if($jenis=='umum')
					{
						unset($inp['id']);
						unset($inp['biaya_makan']);
						unset($inp['sedekah']);
						unset($inp['tgl_ikut']);
						unset($inp['noseat']);
						unset($inp['dataikut']);
					}
					else
					{
						unset($inp['rfid_number']);
						$inp['itikafke']=encrypt_decrypt('encrypt',$inp['itikafke']);
						$inp['kaji']=encrypt_decrypt('encrypt',$inp['kaji']);
					}

					$inp['no_identitas']=encrypt_decrypt('encrypt',$inp['no_identitas']);
					$inp['asal']=encrypt_decrypt('encrypt',$inp['asal']);
					$inp['alamat']=encrypt_decrypt('encrypt',$inp['alamat']);
					$inp['nama']=encrypt_decrypt('encrypt',$inp['nama']);
					$inp['email']=encrypt_decrypt('encrypt',$inp['email']);
					$inp['telp']=encrypt_decrypt('encrypt',$inp['telp']);
					$inp['tempat_lahir']=encrypt_decrypt('encrypt',$inp['tempat_lahir']);
					$inp['tanggal_lahir']=encrypt_decrypt('encrypt',$inp['tanggal_lahir']);
					$inp['status']=encrypt_decrypt('encrypt',$inp['status']);
					$inp['pendidikan']=encrypt_decrypt('encrypt',$inp['pendidikan']);
					$inp['pekerjaan']=encrypt_decrypt('encrypt',$inp['pekerjaan']);

					$this->db->insert('people',$inp);
					$d['id']=$this->db->insert_id();
				}
					
					if(isset($_POST['dilantik']))
					{
						list($t_l,$b_l,$th_l)=explode('/', $_POST['dilantik']);
						$tgllantik=$th_l.'-'.$b_l.'-'.$t_l;
					}
					else
						$tgllantik='';

					// echo '<pre>';
					// print_r($d);
					// echo '</pre>';
					if($jenis_event=='umum')
					{
						$d['itikafke']='';
						$mem=array(
							'people_id'=>$d['id'],
							'event_id'=>$event_id,
							'rfid_number'=>$_POST['rfid_number']
						);
						$this->db->insert('people_has_event',$mem);	
						
						unset($d['rfid_number']);
						// unset($d['rfid_number']);

						$d['no_identitas']=encrypt_decrypt('encrypt',$d['no_identitas']);
						$d['asal']=encrypt_decrypt('encrypt',$d['asal']);
						$d['alamat']=encrypt_decrypt('encrypt',$d['alamat']);
						$d['nama']=encrypt_decrypt('encrypt',$d['nama']);
						$d['email']=encrypt_decrypt('encrypt',$d['email']);
						$d['telp']=encrypt_decrypt('encrypt',$d['telp']);
						$d['tempat_lahir']=encrypt_decrypt('encrypt',$d['tempat_lahir']);
						$d['tanggal_lahir']=encrypt_decrypt('encrypt',$d['tanggal_lahir']);
						$d['status']=encrypt_decrypt('encrypt',$d['status']);
						$d['pendidikan']=encrypt_decrypt('encrypt',$d['pendidikan']);
						$d['pekerjaan']=encrypt_decrypt('encrypt',$d['pekerjaan']);

						$this->db->where('id',$d['id']);
						$this->db->update('people',$d);
					}
					else
					{
						$noseat=$d['noseat'];
						$itikafke=$d['itikafke'];
						$mem=array(
							'people_id'=>$d['id'],
							'event_id'=>$event_id,
							'nomorseat'=>$noseat
						);
						$this->db->insert('people_has_event',$mem);

						$ddd['dataikut']=$d['dataikut'];
						unset($d['dataikut']);
						$ddd['biaya_makan']=$d['biaya_makan'];
						unset($d['biaya_makan']);
						$ddd['sedekah']=$d['sedekah'];
						unset($d['sedekah']);
						unset($d['tgl_ikut']);



						$cekitikafke=$this->db->query('select * from itikaf where people_id="'.$d['id'].'"');
						if(count($cekitikafke->result())!=0)
						{
							$this->db->query('update itikaf set itikafke="'.($cekitikafke->row('itikafke') + 1).'" where people_id="'.$d['id'].'"');
							$this->db->query('update people set itikafke="'.($cekitikafke->row('itikafke') + 1).'" where id="'.$d['id'].'"');
						}
						else
							$this->db->query('insert into itikaf(people_id,event_id,itikafke) values("'.$d['id'].'","'.$event_id.'","'.$itikafke.'")');

						$ea=array(
							'people_id' => $d['id'],
							'event_id' => $event_id,
							'nama' => encrypt_decrypt('encrypt',$d['nama']),
							'tgl_ikut' => $evn->row('event_time'),
							'event' => $evn->row('event_name'),
							'yang_ke' =>  $itikafke
						);
						$this->db->insert('event_att',$ea);

						unset($d['noseat']);
						$d['no_identitas']=encrypt_decrypt('encrypt',$d['no_identitas']);
						$d['asal']=encrypt_decrypt('encrypt',$d['asal']);
						$d['alamat']=encrypt_decrypt('encrypt',$d['alamat']);
						$d['nama']=encrypt_decrypt('encrypt',$d['nama']);
						$d['email']=encrypt_decrypt('encrypt',$d['email']);
						$d['telp']=encrypt_decrypt('encrypt',$d['telp']);
						$d['tempat_lahir']=encrypt_decrypt('encrypt',$d['tempat_lahir']);
						$d['tanggal_lahir']=encrypt_decrypt('encrypt',$d['tanggal_lahir']);
						$d['status']=encrypt_decrypt('encrypt',$d['status']);
						$d['pendidikan']=encrypt_decrypt('encrypt',$d['pendidikan']);
						$d['pekerjaan']=encrypt_decrypt('encrypt',$d['pekerjaan']);
						$d['kaji']=$d['kaji'];

						$this->db->where('id',$d['id']);
						$this->db->update('people',$d);

						// if(isset($_POST['dataikut']))
						// {
							$wwh=array(
								'event_id'=>$event_id,
								'people_id'=>$d['id'],
								'nama'=>encrypt_decrypt('encrypt',$d['nama']),
								'tanggal_ikut' => encrypt_decrypt('encrypt',$ddd['dataikut']),
								'biaya_makan' => $ddd['biaya_makan'],
								'sedekah' => $ddd['sedekah']
							);
							$this->db->insert('record_ikut',$wwh);
						// }
					}
				
				
			}
		}
	}

	function reportgrafik($eventid)
	{
		$data['event_id']=$eventid;
		$this->load->view('isi/event/report-grafik',$data);
	}
	function exportpdf($event_id,$jenismember)
	{
		$this->load->library('pdf');
		$data['event_id']=$event_id;
		$event=$this->db->query('select * from event where id="'.$event_id.'"');
		if(count($event->result())!=0)
		{
		// $this->load->view('isi/event/exportpdf',$data);

			ob_start();
			$pdf = new TCPDF('P', PDF_UNIT, 'F4', true, 'UTF-8', false);

			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('Data Peserta Event '.encrypt_decrypt('decrypt',$event->row('event_name')).'');
			$pdf->SetTitle('Data Peserta Event : '.encrypt_decrypt('decrypt',$event->row('event_name')).'');
			$pdf->SetSubject('Data Peserta Event : '.encrypt_decrypt('decrypt',$event->row('event_name')).'');
			//$pdf->SetSubject('TCPDF Tutorial');
			//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

			// set default header data
			$pdf->SetHeaderData('', '', 'Data Peserta Event '.encrypt_decrypt('decrypt',$event->row('event_name')).'', '', '');

			// set header and footer fonts
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

			// set margins
			$pdf->SetMargins(5, 20, 5);
			$pdf->SetHeaderMargin(5);
			$pdf->SetFooterMargin(5);

			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
				require_once(dirname(__FILE__).'/lang/eng.php');
				$pdf->setLanguageArray($l);
			}

			$pdf->SetFont('times', '', 9);

			$jlh_pria_member=$jlh_pria_non_member=$jlh_wanita_member=$jlh_wanita_non_member=0;

			$pria_m = $this->db->query('select count(*) as jlh from people_has_event as phe inner join people as p on (p.id=phe.people_id) where phe.event_id="'.$event_id.'" and p.member="t" and p.kelamin="p" and p.member="'.$jenismember.'"');
			$pria_n_m = $this->db->query('select count(*) as jlh from people_has_event as phe inner join people as p on (p.id=phe.people_id) where phe.event_id="'.$event_id.'" and p.member="f" and p.kelamin="p" and p.member="'.$jenismember.'"');			
			$wanita_m = $this->db->query('select count(*) as jlh from people_has_event as phe inner join people as p on (p.id=phe.people_id) where phe.event_id="'.$event_id.'" and p.member="t" and p.kelamin="w" and p.member="'.$jenismember.'"');
			$wanita_n_m = $this->db->query('select count(*) as jlh from people_has_event as phe inner join people as p on (p.id=phe.people_id) where phe.event_id="'.$event_id.'" and p.member="f" and p.kelamin="w" and p.member="'.$jenismember.'"');

			if(count($pria_m->result())!=0)
				$jlh_pria_member=$pria_m->row('jlh');			

			if(count($pria_n_m->result())!=0)
				$jlh_pria_non_member=$pria_n_m->row('jlh');

			if(count($wanita_m->result())!=0)
				$jlh_wanita_member=$wanita_m->row('jlh');			

			if(count($wanita_n_m->result())!=0)
				$jlh_wanita_non_member=$wanita_n_m->row('jlh');

			// add a page
			$pdf->AddPage();
			$tbl='<table style="margin-top:30px;font-weight:bold" cellpadding="3">';
			$tbl.='<tr>';
				$tbl.='<td style="width:100px" colspan="4">'.($jenismember=='t' ?'<u>Jumlah Member</u>' : '' ).'</td>';
				$tbl.='<td></td>';
				$tbl.='<td></td>';
				$tbl.='<td></td>';
				$tbl.='<td style="" colspan="4">'.($jenismember=='f' ?'<u>Jumlah Non Member</u>' : '' ).'</td>';
				$tbl.='<td></td>';
				$tbl.='<td style="" colspan="4"><u>TOTAL</u></td>';
			$tbl.='</tr>';			
			$tbl.='<tr>';
				$tbl.='<td></td>';
				$tbl.='<td style="width:90px;">'.($jenismember=='t' ?'Laki-laki' : '' ).'</td>';
				$tbl.='<td style="width:10px;">'.($jenismember=='t' ?':' : '' ).'</td>';
				$tbl.='<td style="width:70px;text-align:right">'.($jenismember=='t' ? $jlh_pria_member.' Orang' : '' ).'</td>';
				$tbl.='<td>&nbsp;</td>';

				$tbl.='<td style="width:90px;">'.($jenismember=='f' ?'Laki-laki' : '' ).'</td>';
				$tbl.='<td style="width:10px;">'.($jenismember=='f' ?':' : '' ).'</td>';
				$tbl.='<td style="width:70px;text-align:right">'.($jenismember=='f' ? $jlh_pria_non_member.' Orang' : '' ).'</td>';
				$tbl.='<td>&nbsp;</td>';

				$tbl.='<td style="width:100px;">Laki-laki</td>';
				$tbl.='<td style="width:10px;">:</td>';
				$tbl.='<td style="width:70px;text-align:right">'.($jlh_pria_non_member+$jlh_pria_member).' Orang</td>';
			$tbl.='</tr>';			
			$tbl.='<tr>';
				$tbl.='<td></td>';
				$tbl.='<td style="width:90px;">'.($jenismember=='t' ?'Perempuan' : '' ).'</td>';
				$tbl.='<td style="width:10px;">'.($jenismember=='t' ?':' : '' ).'</td>';
				$tbl.='<td style="width:70px;text-align:right;">'.($jenismember=='t' ?$jlh_wanita_member.' Orang' : '' ).'</td>';
				$tbl.='<td>&nbsp;</td>';
	
				$tbl.='<td style="width:90px;">'.($jenismember=='f' ?'Perempuan' : '' ).'</td>';
				$tbl.='<td style="width:10px;">'.($jenismember=='f' ?':' : '' ).'</td>';
				$tbl.='<td style="width:70px;text-align:right;">'.($jenismember=='f' ?$jlh_wanita_non_member.' Orang' : '' ).'</td>';
				$tbl.='<td>&nbsp;</td>';
	
				$tbl.='<td style="width:100px;">Perempuan</td>';
				$tbl.='<td style="width:10px;">:</td>';
				$tbl.='<td style="width:70px;text-align:right">'.($jlh_wanita_non_member+$jlh_wanita_member).' Orang</td>';
			$tbl.='</tr>';			
			$tbl.='<tr>';
				$tbl.='<td></td>';
				$tbl.='<td style="width:90px;border-top:1px solid #888">'.($jenismember=='t' ?'JUMLAH' : '' ).'</td>';
				$tbl.='<td style="width:10px;border-top:1px solid #888">'.($jenismember=='t' ?':' : '' ).'</td>';
				$tbl.='<td style="width:70px;text-align:right;border-top:1px solid #888">'.($jenismember=='t' ?$jlh_pria_member+$jlh_wanita_member.' Orang' : '' ).'</td>';
				$tbl.='<td></td>';

				$tbl.='<td style="width:90px;border-top:1px solid #888">'.($jenismember=='f' ?'JUMLAH' : '' ).'</td>';
				$tbl.='<td style="width:10px;border-top:1px solid #888">'.($jenismember=='f' ?':' : '' ).'</td>';
				$tbl.='<td style="width:70px;text-align:right;border-top:1px solid #888">'.($jenismember=='f' ?($jlh_pria_non_member+$jlh_wanita_non_member).' Orang' : '' ).'</td>';
				$tbl.='<td></td>';

				$tbl.='<td style="width:100px;border-top:1px solid #888">JUMLAH TOTAL</td>';
				$tbl.='<td style="width:10px;border-top:1px solid #888">:</td>';
				$tbl.='<td style="width:70px;text-align:right;border-top:1px solid #888">'.(($jlh_pria_member+$jlh_wanita_member)+($jlh_pria_non_member+$jlh_wanita_non_member)).' Orang</td>';
			$tbl.='</tr>';			
			
			$tbl.='</table>';
			$tbl.='<br><br><table style="" cellpadding="3">
				<tr>
					<th style="width:30px;border:1px solid #888;text-align:center;background-color:#ccc;font-weight:bold;">No</th>
					<th style="'.($jenismember=='f' ? 'width:35%' : 'width:20%').';border:1px solid #888;text-align:center;background-color:#ccc;font-weight:bold;">Nama</th>
					<th style="width:13%;border:1px solid #888;text-align:center;background-color:#ccc;font-weight:bold;">Asal</th>
					<th style="width:28%;border:1px solid #888;text-align:center;background-color:#ccc;font-weight:bold;">Asal Surau</th>';
				if($jenismember=='t')	
					$tbl.='<th style="width:15%;border:1px solid #888;text-align:center;background-color:#ccc;font-weight:bold;">Kaji</th>';
				$tbl.='<th style="width:10%;border:1px solid #888;text-align:center;background-color:#ccc;font-weight:bold;">Gender</th>
					<th style="width:10%;border:1px solid #888;text-align:center;background-color:#ccc;font-weight:bold;">Umur</th>
				</tr>';

			$qry=$this->db->query('select * from people_has_event as phe 
									inner join people as p on (phe.people_id=p.id) where phe.event_id="'.$event_id.'" and p.member="'.$jenismember.'" order by p.nama');	
			
			if(count($qry->result())!=0)
			{
				foreach ($qry->result() as $k => $v) 
				{
					if($k%2!=0)
						$stl='background-color:#eee;';
					else
						$stl='';

					$tbl.='<tr>';
					$tbl.='<td style="'.$stl.'text-align:center;border:1px solid #888">'.($k+1).'</td>';
					$tbl.='<td style="'.$stl.'text-align:left;border:1px solid #888">'.ucwords(strtolower(encrypt_decrypt('decrypt',$v->nama))).'</td>';
					$tbl.='<td style="'.$stl.'text-align:center;border:1px solid #888">'.ucwords(strtolower(encrypt_decrypt('decrypt',$v->asal))).'</td>';
					$tbl.='<td style="'.$stl.'text-align:left;border:1px solid #888">'.ucwords(strtolower(encrypt_decrypt('decrypt',$v->status))).'</td>';
					if($jenismember=='t')
						$tbl.='<td style="'.$stl.'text-align:center;border:1px solid #888">'.($v->kaji).'</td>';
						// $tbl.='<td style="'.$stl.'text-align:center;border:1px solid #888">'.($v->member=='t' ? 'Member' : 'Non Member').'</td>';
					$tbl.='<td style="'.$stl.'text-align:center;border:1px solid #888">'.($v->kelamin=='p' ? 'Laki-laki' : 'Perempuan').'</td>';
					$tbl.='<td style="'.$stl.'text-align:center;border:1px solid #888">'.($v->usia).' tahun</td>';
					$tbl.='</tr>';

					if($v->kelamin=='w')
					{
						if($v->member=='t')
							$jlh_wanita_member++;
						else
							$jlh_wanita_non_member++;
					}
					else
					{
						if($v->member=='t')
							$jlh_pria_member++;
						else
							$jlh_pria_non_member++;
					}
				}
			}
			else
			{
				$tbl.='<tr><td colspan="8" style="font-style:italic;text-align:center;font-weight:bold;border:1px solid #ccc;">Data Peserta Belum tersedia</td></tr>';
			}


			$tbl.='</table>';

			

			$pdf->writeHTML($tbl, true, false, false, false, '');

			

			$pdf->Output('Data Peserta Event '.$event->row('event_name').'', 'I');
			// force_download('/path/to/photo.jpg', NULL);
		}
		else
			redirect('event','location');
	}

	function ikuthari($idevent,$tglikut)
	{
		$ev=$this->db->query('select * from event where id="'.$idevent.'"');
		if($ev->row('count_of_day') != '' || !is_null($ev->row('count_of_day')))
		{
			$tgl=strtok($ev->row('event_time'), ' ');
			// echo $tgl;
			echo '<div style="width:100%;margin:0 auto;text-align:center">';
			// $ikutin=$ev->row('count_of_day')-$jikut;

			$dataikut='';
			for ($i=1; $i <= $ev->row('count_of_day'); $i++) 
			{ 
				list($thn,$bln,$tg)=explode('-', $tgl);
				$dt1=strtotime($tgl);
				$dt2=strtotime($tglikut);
				if($dt1>=$dt2)
				{
					echo '<div style="width:45px;height:20px;margin-right:2px;padding:2px;border:1px solid #ccc;float:left;cursor:pointer;font-size:9px;margin-bottom:2px;background-color:#888;color:#fff;">'.$tg.'-'.getBulanSingkat($bln).'</div>';
					$dataikut.=$tgl.',';
				}
				else
				{
					echo '<div style="width:45px;height:20px;margin-right:2px;padding:2px;border:1px solid #ccc;float:left;cursor:pointer;font-size:9px;margin-bottom:2px;">'.$tg.'-'.getBulanSingkat($bln).'</div>';
				}
				$tgl=date('Y-m-d', strtotime($tgl. ' + 1 days'));
			}
			echo '<input type="hidden" name="dataikut" value="'.$dataikut.'">';
			echo '</div>';
		}
	}

	function getMemberEvent($idh)
	{
		$warna='#000000';
		$d=$this->db->query('select *,phe.id idh from people_has_event as phe inner join people as p on (p.id=phe.people_id) where phe.id="'.$idh.'" order by p.nama');
		if(count($d->result())!=0)
		{
			$lvl=$this->config->item('level');
			// $itikafke=$this->db->query('select max(itikafke) as mm from itikaf where people_id="'.$d->row('people_id').'"');
			$itikafke=$d->row('itikafke');
			$event=$this->db->query('select * from event where id="'.$d->row('event_id').'"');

			$level=encrypt_decrypt('encrypt',$d->row('kaji'));
			$kaji=$this->db->query('select * from level where keterangan="'.$level.'"');
			$warna='';
			$warnafont='';
			if(count($kaji->result())!=0)
			{
				$warna=encrypt_decrypt('decrypt',$kaji->row('warna'));
				$warnafont=encrypt_decrypt('decrypt',$kaji->row('warnafont'));
			}

			if(count($lvl)!=0)
			{
				// if(isset($lvl[$itikafke]))
				// {
				// 	$level=$lvl[$itikafke];
				// }
			}



			$json = array();
			if(count($d->result())!=0)
			{
				foreach ($d->result() as $k => $v) 
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
					}
				}
			}

			$a=json_encode($json);
			$a=str_replace(array('[',']'),'',$a);
			$bar=htmlentities(bar128(stripslashes($d->row('event_id').' '.$d->row('idh').' '.str_replace('-',' ',strtok($event->row('event_time'),' ')))));
			$a=str_replace('}',',"barcode" : "'.$bar.'","itikafke":"'.($itikafke).'","levell":"'.encrypt_decrypt('decrypt',$level).'","warna":"'.$warna.'","warnafont":"'.$warnafont.'","jenis_event":"'.encrypt_decrypt('decrypt',$event->row('jenis')).'","namaeventaja":"'.encrypt_decrypt('decrypt',$event->row('event_name')).'"}',$a);
			echo $a;
				
			//echo '<pre>'.$bar.'</pre>';
		}
	}

	function cetakform($event_id,$people_id)
	{
		$d=$this->db->query('select * from event as e 
								inner join people_has_event as phe on (e.id=phe.event_id) 
								inner join people as p on (phe.people_id=p.id)
								where phe.event_id="'.$event_id.'" and phe.people_id="'.$people_id.'"')->result();
		if(count($d)!=0)
		{
			$data['d']=$d[0];
			$data['event_id']=$event_id;	
			$data['people_id']=$people_id;	
			$record=$this->db->query('select * from record_ikut where event_id="'.$event_id.'" and people_id="'.$people_id.'"');
			$data['record']=$record->result();
			$this->db->query('update people_has_event set form="t" where event_id="'.$event_id.'" and people_id="'.$people_id.'"');
			$this->load->view('isi/event/cetakform',$data);
		}
	}
	function cetaknametag($idevent,$idphe)
	{
		$qry='select *,phe.id idh from people_has_event as phe 
					inner join people as p on (p.id=phe.people_id) 
					where phe.event_id="'.$idevent.'" and phe.id="'.$idphe.'" order by p.nama';


		$event=$this->db->query('select * from event where id="'.$idevent.'"');
		$data['evv']=$event->result();

		$d=$this->db->query($qry);
		// echo '<pre>';
		// print_r($d->result());
		// echo '</pre>';
		if(count($d->result())!=0)
		{
			$level=$this->db->query("select * from level where keterangan='".encrypt_decrypt('encrypt',$d->row('kaji'))."'");
			$data['d']=$d->result();
			$data['lv']=$level->result();
			$this->load->view('isi/event/cetaknametag',$data);
		}
	}
	function printBarcode($idh)
	{
		$this->db->query('update people_has_event set barcode="t" where id="'.$idh.'"');
		$this->session->set_flashdata('pesan','Kode Barcode Sudah Tercetak');
		// echo 'Kode Barcode Sudah Tercetak';
	}
}

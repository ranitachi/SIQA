<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Zis extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged')!='true')
			redirect('login','location');
	}
	public function index()
	{
		$data=[
			'title'=>'Zakat, Infaq, Shodaqoh - Qutubuladmin.org',
			'sidebar'=>'template/sidebar',
			'active' => 'home'
		];
		$this->load->view('template/header',$data);
		$this->load->view('template/navbar');
		$this->load->view('template/sidebar',$data);
		$this->load->view('isi/zis/index',$data);
		$this->load->view('template/footer');
	}

	public function form($id=-1)
	{
		// $people=$this->db->from('people')->where('status_tampil',1)->get()->result();
		// $p=array();
		// $opt='<option>&nbsp;<option>';
		// foreach ($people as $k => $v)
		// {
		// 	$opt.='<option value="'.$v->id.'__'.encrypt_decrypt('decrypt',$v->nama).'">'.encrypt_decrypt('decrypt',$v->no_identitas).' - '.encrypt_decrypt('decrypt',$v->nama).'</option>';
		// }

		// $data['opt']=$opt;
		// $data['infak']=$infak;
		$data['id']=$id;
		$jenis=$this->db->from('jenis_zakat_infak')->where('kat != ',0,false)->get()->result();
		$zakat=$infak=array();
		$jn=array();
		foreach ($jenis as $k => $v)
		{
			if($v->kat==1)
				$jn[$v->id]=$v;
			else
				$infak[$v->id]=$v;
		}
		$idd=date('YmdHi').'-'.abs(crc32(sha1(rand())));
		$data['idd']=$idd;
		$data['zakat']=$jn;
		$data['infak']=$infak;
		$this->load->view('isi/zis/form',$data);
	}

	function proses($id=-1)
	{
		if(!empty($_POST))
		{
			$d['no_transaksi']=$kwitansi=encrypt_decrypt('encrypt',$_POST['kwitansi']);
			$d['tanggal']=$tgl=date('Y-m-d H:i:s');
			// list($member_id,$nama)=explode('__', $_POST['nama']);
			$member_id=strtok($_POST['nama'], '-');
			$mid=$this->db->from('people')->where('no_identitas',encrypt_decrypt('encrypt',$member_id))->get()->result();
			$d['member_id']=$mid[0]->id;
			$d['total']=$total=str_replace(array(',','.'), '', $_POST['totalinput']);
			$kel='';
			foreach ($_POST['nama_keluarga'] as $k => $v)
			{
				if($v!='')
				{
					$kel.=$v.',';
				}
			}
			$d['keterangan']=encrypt_decrypt('encrypt',$kel);
			$this->db->insert('transaksi',$d);
			$idtrans=$this->db->insert_id();

			$dd['transaksi_id']=$idtrans;
			foreach ($_POST['tr'] as $kr => $vr)
			{
				foreach ($vr as $kv => $vv)
				{
					# code...
					if($vv!=0)
					{
						$dd['jenis_id']=$kr;
						$dd['jumlah']=str_replace(array(',','.'), '', $vv);
						$this->db->insert('transaksi_detail',$dd);
					}

				}

			}
			echo 'Transaksi Berhasil Di Simpan';
			// echo '<pre>';
			// print_r($_POST);
			// echo '</pre>';
		}
	}

	function cetak($kwitansi)
	{
		// echo encrypt_decrypt('encrypt','201706050945-62076239');
		// echo $kwitansi;
		$jenis=$this->db->from('jenis_zakat_infak')->where('kat != ',0,false)->get()->result();
		$zakat=$infak=array();
		$jn=array();
		foreach ($jenis as $k => $v)
		{
			if($v->kat==1)
				$jn[$v->id]=$v;
			else
				$infak[$v->id]=$v;
		}
		$data['zakat']=$jn;
		$data['infak']=$infak;
		
		$kwi=encrypt_decrypt('encrypt',$kwitansi);
		$data['kwitansi']=$kwitansi;
		$d=$this->db->query('select * from transaksi as tr inner join transaksi_detail as td on (td.transaksi_id=tr.id) where tr.no_transaksi="'.$kwi.'"')->result();
		$data['d']=$d;
		$p=$this->db->from('people')->where('id',$d[0]->member_id)->get()->result();
		$data['people']=$p[0];
		$j=$this->db->from('jenis_zakat_infak')->get()->result();
		$jn=array();
		foreach ($j as $k => $v) {
			$jn[$v->id]=$v;
		}
		$data['j']=$jn;
		$data['people']=$p[0];
		$this->load->view('isi/zis/cetakform',$data);
	}

	function data($date=null)
	{
		if($date!=null)
			$tgl=$date;
		else {
			$tgl=date('Y-m-d');
		}
		$d=$this->db->query('select * from transaksi as tr inner join transaksi_detail as td on (td.transaksi_id=tr.id) where tr.tanggal like "%'.$tgl.'%" order by tr.tanggal')->result();
		$dd=array();
		foreach ($d as $k => $v) {
				$dd[$v->transaksi_id][]=$v;
		}

		$p=$this->db->from('people')->where('status_tampil',1)->get()->result();
		$pp=array();
		foreach ($p as $k => $v) {
			$pp[$v->id]=$v;
		}

		$j=$this->db->from('jenis_zakat_infak')->get()->result();
		$jn=array();
		foreach ($j as $k => $v) {
			$jn[$v->id]=$v;
		}
		$data['j']=$jn;
		$data['people']=$pp;
		$data['dd']=$dd;

		$this->load->view('isi/zis/data',$data);
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
	}
	function cektable()
	{
		$this->load->dbforge();
		$tables=$this->db->list_tables();
		foreach ($tables as $kt => $vt) 
		{
			$field=$this->db->field_data($vt);
			if($vt!='v_users' && $vt!='tbl_event' && $vt!='tbl_pages' && $vt!='tbl_users' && $vt!='tbl_visitor' && $vt!='transaksi' && $vt!='transaksi_detail' && $vt!='people_has_event' && $vt!='itikaf' )
			{
				
				// echo $vt.'<br>';

				if(!$this->db->field_exists('update_table',$vt))
				{
					// echo 'alter<br>';
					$kolom = array(
					        'update_table' => array('type' => 'INT')
					);
					$this->dbforge->add_column($vt, $kolom);
				}
				$select=$id=array();
				foreach ($field as $kf => $vf) 
				{

					if($vf->primary_key==1)
					{
						$select['id']=$vf->name;
						//echo '&nbsp;&nbsp;&nbsp;&nbsp;<u>'.($vf->name).'</u><br>';		
						
					}
					else if($vf->type=='varchar' || $vf->type=='text')
					{
						// if($dd[0]->{$v->name}!="")
						// {
						$select[]=$vf->name;
						//echo '&nbsp;&nbsp;&nbsp;&nbsp;'.($vf->name).'<br>';		
						// }
					}
					$select[]='update_table';

					// if($vf->type=='varchar')
					// {
					// 	// echo $vt.'<br>'.$vf->name.':'.$vf->max_length.'<br>';
					// 	// 'type' => 'VARCHAR',
     //  					// 'constraint' => '100',
     //            		$ubahkolom = array(
					// 	        ''.$vf->name.'' => array(
					// 	                'name' => $vf->name,
					// 	                'type' => 'VARCHAR',
					// 	                'constraint' => '255',
					// 	        ),
					// 	);
					// 	$this->dbforge->modify_column($vt, $ubahkolom);
					// }
				}
				if($vt!='event_barcode' && $vt!='people_has_event_detail')
				{
					// echo '<br>--------------<br>';
					// echo $vt.'<br>--------------<br>';
					$db=$this->db->select($select)->from($vt)->get()->result();
					// echo count($db);
					foreach ($db as $k => $v) 
					{
						$up=$sel=array();
						$id='';
						foreach ($v as $kv => $vv) 
						{
							if($kv=='id')
								$idt=$vv;

							if($kv!='id')
							{
								if($vv!='')
								{
									//echo '<br>----';
									// echo $kv.'----<br>';
									$encrypt=encrypt_decrypt('encrypt',$vv);
									// echo $idt.'-'.$vv.':'. $encrypt.'<br>';
									if($v->update_table!=1)
									{
										$up[$kv]=$encrypt;
										$up['update_table']=1;
										$sel['id']=$idt;
									}
									// echo ($kv=='update_table' ? $kv.' - '.$vv : $kv).' :'. encrypt_decrypt('decrypt',$vv).'<br>';
								}
							}
						}
						if($idt!='')
						{
							if(isset($sel['id']))
							{
								// echo $sel['id'];
								// // print_r($sel);
								// echo '<pre>';
								// print_r($up);
								// echo '</pre>';
								$this->db->where($sel);
								$this->db->update($vt,$up);							
							}

						}
					}
				}
				// echo '--------------------------------<br>';
			}
		}
		// echo '<br>--------------------------------';
	}
}

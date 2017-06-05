<?php
//Loads configuration from database into global CI config
function load_config()
{
	$CI =& get_instance();
	$config=$CI->db->from('app_config')
				->order_by('key','asc')->get();
	foreach($config->result() as $app_config)
	{
		$CI->config->set_item($app_config->key,$app_config->value);
		$CI->config->set_item(encrypt_decrypt('decrypt',$app_config->key),encrypt_decrypt('decrypt',$app_config->value));
	}

	$uri=count($CI->uri->segments);
	$path='';
	if($uri>1)
	{
		foreach ($CI->uri->segments as $k => $v) 
		{
			$path.='../';
		}
		$path=substr($path,0, -3);
	}
	$CI->config->set_item('path',$path);

	if (!$CI->db->field_exists('waktu_record', 'people_has_event_detail'))
	{
	   $sql="alter table people_has_event_detail add column `waktu_record` datetime";
	   $CI->db->query($sql);
	}

	if (!$CI->db->table_exists('v_users'))
	{
	   $sql="create VIEW v_users as 
	select `u`.`id` AS `id`,`u`.`username` AS `username`,`u`.`password` AS `password`,`u`.`level` AS `level`,`u`.`people_id` AS `people_id`,`u`.`status` AS `u_status`,`p`.`kelamin` AS `kelamin`,`p`.`id` AS `p_id`,`p`.`no_identitas` AS `no_identitas`,`p`.`jenis_identitas` AS `jenis_identitas`,`p`.`usia` AS `usia`,`p`.`asal` AS `asal`,`p`.`alamat` AS `alamat`,`p`.`nama` AS `nama`,`p`.`email` AS `email`,`p`.`telp` AS `telp`,`p`.`foto` AS `foto`,`p`.`tempat_lahir` AS `tempat_lahir`,`p`.`tanggal_lahir` AS `tanggal_lahir`,`p`.`status` AS `p_status`,`p`.`member` AS `member`,`p`.`nama_orang_tua` AS `nama_orang_tua`,`p`.`pendidikan` AS `pendidikan`,`p`.`status_tampil` AS `status_tampil`,`p`.`itikafke` AS `itikafke`,`p`.`kaji` AS `kaji`,`p`.`pekerjaan` AS `pekerjaan` from (`people` `p` left join `users` `u` on((`p`.`id` = `u`.`people_id`)))";
	   	$CI->db->query($sql);	
	}
	
}
?>
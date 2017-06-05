<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	</head>
	<body onLoad="window.print()">
	<?
	// echo '<pre>';
	// print_r($lv);
	// echo '</pre>';
	?>

		<div style="width:440px !important;" class="body">
			<div style="width:440px;margin:0px;padding-bottom:30px;">
								<div style="width:100%;border-bottom:3px solid #bbb;float:left;font-size:30px;padding-bottom:10px;text-align:center;font-weight:bold;line-height:25px">
									SURAU QUTUBUL AMIN<br>Arco - Depok<br>
									<div style="font-size:20px;"><?=encrypt_decrypt('decrypt',$evv[0]->event_name)?></div>
								</div>
								<!-- border-bottom:3px solid #bbb; -->
								<div style="width:100%;float:left">
									<div style="float:left;width:76%;text-align:left;padding-top:35px;">
										<div id="nomorseatmember" style="height:50px;font-size:80px;font-family:verdana;letter-spacing:10px;"><?=$d[0]->nomorseat?></div>
										<div style="float:right;text-align:left;width:100%;padding-left:3px;padding-bottom:5px;">
											<div style="float:left;text-align:left;font-size:18px;width:100%">Nama</div>
											<?
											if(strlen(encrypt_decrypt('decrypt',$d[0]->nama))>19)
											{
												$selisih=(strlen(encrypt_decrypt('decrypt',$d[0]->nama))-19);
												$fontsize=(30-$selisih).'px';
											}
											else
												$fontsize='30px';
											?>
											<div style="padding-top:5px;float:left;text-align:left;font-size:<?=$fontsize?>;text-transform:capitalize;width:100%;font-weight:bold;z-index:100000" id="name_user_member"><?=encrypt_decrypt('decrypt',$d[0]->nama)?></div>
										</div>
										<div style="float:right;text-align:left;width:100%;margin-top:10px;padding-left:3px;padding-bottom:5px;">
											<div style="float:left;text-align:left;font-size:18px;width:100%">Asal</div>
											<div style="padding-top:5px;float:left;text-align:left;font-size:30px;text-transform:capitalize;width:100%;font-weight:bold" id="asal_user_member"><?=encrypt_decrypt('decrypt',$d[0]->asal)?></div>
										</div>
									</div>
									<div style="float:left;width:24%">
										<div style="float:right;text-align:left;width:100%;border-left:2px solid #ccc;padding-left:3px;margin-top:5px;padding-bottom:5px;background-color:<?=encrypt_decrypt('decrypt',$lv[0]->warna)?>;color:<?=encrypt_decrypt('decrypt',$lv[0]->warnafont)?>" id="buatbackground">
											<div style="float:left;text-align:left;font-size:16px;width:100%">Kaji</div>
											<div style="float:left;text-align:left;font-size:27px;text-transform:capitalize;width:100%;font-weight:bold" id="levelid"><?=$d[0]->kaji?></div>
										</div>
										<div style="float:right;text-align:left;width:100%;border-left:2px solid #ccc;padding-left:3px;margin-top:5px;padding-bottom:5px;">
											<div style="float:left;text-align:left;font-size:16px;width:100%">I'tikaf Ke </div>
											<div style="float:left;text-align:left;font-size:27px;text-transform:capitalize;width:100%;font-weight:bold" id="itikafkeprint"><?=$d[0]->itikafke?></div>
										</div>
									</div>
									<?
									$event=$this->db->query('select * from event where id="'.$d[0]->event_id.'"');
									$bar=bar128(stripslashes($d[0]->event_id.' '.$d[0]->idh.' '.str_replace('-',' ',strtok($event->row('event_time'),' '))));
									?>
									<div style="float:right;text-align:center;width:100%;margin-bottom:5px;margin-top:15px;">
										<div style="float:left;text-align:center;font-size:23px;text-transform:capitalize;width:100%;font-weight:bold" id="barcode_user_member"><?=$bar?></div>
									</div>
								</div>

							<input type="hidden" name="idididid" id="idididid_member">
		</div>
	</body>
</html>
<style type="text/css">
*
{
	line-height: 17px;
}
.tabel th,
.tabel td
{
	border-right:0.1em solid #aaa;
	border-bottom:0.1em solid #aaa;
	vertical-align: top;
	padding:3px;
}
.tabel th
{
	background: #ddd;
	vertical-align: middle !important;
}

h1,h2,h3,h4,h5,h6
{
	padding: 1px !important;
	margin: 1px !important;
}
/*div
{
	font-size: 12px !important;
	padding-top:0px;
	padding-bottom:0px;
	margin-top:-1px !important;
	margin-bottom:0px;
}*/
ol li 
{
	margin-top:-3px !important;
	margin-bottom:0px !important;
}
div.b128{
	border-left: 1px black solid;
	height: 40px !important;
}
div.body
{
	width:100%;
	padding:0px;
	
	position: absolute;
	background:transparent;
	
	background-size:80%;
	background-position: center;
	z-index: 1000;
}
</style>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	</head>
	<body onLoad="window.print()">


		<div style="width:1000px !important;padding:10px;" class="body">
			<table border="0" style="width:100%" cellpadding="0" cellspacing="0">
				<tr>
					<td style="width:15%;text-align:center;vertical-align:top">
						
					</td>
					<td style="width:70%;vertical-align:top;text-align:center">
						<h1 style="font-size:40px !important;">SURAU QUTUBUL AMIN ARCO</h1>
						<h3>Jl. Buni No. 11 Telp 0251 - 8619189 Arco - Sawangan, Depok</h3>
					</td>
					<td style="width:15%;vertical-align:top;text-align:center;border:1px solid #ccc;padding:4px;background:#eee">Tanggal Dituakan<br><b><?
						if(strpos($d->tgl_pelantikan, '0000')!==false)
							echo '';
						else
							echo tgl_indo($d->tgl_pelantikan);
						?></b></td>
				</tr>
			</table>
			<hr>
			<table style="border-bottom: 0px !important;border-right: 0px !important;width:100%;margin-top:20px;" class="tabel" cellpadding="2" cellspacing="0">
				<tr>
					<th style="text-align:left;width:70%">I. PERSYARATAN UNTUK MENGIKUTI I'TIKAF</th>
					<th style="text-align:right;width:30%;">Seat : <span style="font-size:30px;"><?=$d->nomorseat?></span></th>
				</tr>
				<tr>
					<td colspan="2">
						I'tikaf hanya dapat diikuti oleh anak-anak Surau yang memenuhi persyaratan sebagai berikut :
						<ol>
							<li>Akil Baligh : termasuk pengertian sehat jasmani dan pikiran</li>
							<li>Telah masuk tharikat selama paling sedikit 6 (enam) bulan dengan rajin beramal, wirid dan berubudiyah</li>
							<li>Ada izin dari orang tua atau suami</li>
							<li>Menyediakan belanja untuk keluarga yang ditinggalkan : telah menyelesaikan segala urusan tanggung jawab sebagaimana yang diisyaratkan dalam Agama Islam</li>
							<li>Tidak sedang terlibat suatu kejahatan kriminal</li>
							<li>Atas kemauan sendiri yang suci bersih</li>
							<li>TUjuan mengikuti I'tikaf semata-mata untuk "Beramal saleh berdasarkan Ajaran Agama Islam", tidak ada tujuan lain yang bersifat duniawi, politis dan pamtih-pamtih lainnya.</li>
						</ol>
					</td>
				</tr>
				<tr>
					<th style="text-align:left" colspan="2">&nbsp;
						<br>II. PERMOHONAN MENGIKUTI I'TIKAF <u><?=strtoupper(encrypt_decrypt('decrypt',$d->event_name))?></u>
						<?
							if(count($record)!=0)
							{	
								// echo encrypt_decrypt('decrypt',$record[0]->tanggal_ikut);
								$evt=explode(',', encrypt_decrypt('decrypt',$record[0]->tanggal_ikut));
								$sel=tgl_indo($evt[count($evt)-2]);
								$mul=tgl_indo($evt[0]);
								$sedekah=$record[0]->sedekah;
								$biayamakan=$record[0]->biaya_makan;
							}
							else
							{
								$sel=$mul='';
								$sedekah=$biayamakan=0;
							}
						?>
						<br>(Dari Tanggal <u><?=($mul)?></u> s/d tanggal  <u><?=$sel?></u>
					</th>
				</tr>
				<tr>
					<td colspan="2">
						<br>
						Setelah membaca dan meresapi syarat-syarat mengikuti I'tikaf tersebut di atas, maka saya yang bertanda tangan di bawah ini, atas dasar kemauan saya sendiri yang tulis ikhlas suci bersih, mengajukan permohonan untuk dapat mengikuti I'tikaf yang akan dilangsungkan ini. Di bawah ini saya terakan data/identitas saya : 
					</td>
					
				</tr>
			</table>
			<table border="0" style="width:100%" cellpadding="0" cellspacing="0">
				<tr>
					<td style='width:30px;vertical-align:top;'>1</td>
					<td style='width:10px;vertical-align:top;'>:</td>
					<td style='width:300px;vertical-align:top;'>Nama</td>
					<td style='width:10px;vertical-align:top;'>:</td>
					<td style='font-weight:bold;'><?=encrypt_decrypt('decrypt',$d->nama)?></td>
				</tr>
				<tr>
					<td style='width:30px;vertical-align:top;'>2</td>
					<td style='width:10px;vertical-align:top;'>:</td>
					<td style='width:300px;vertical-align:top;'>Jenis Kelamin</td>
					<td style='width:10px;vertical-align:top;'>:</td>
					<td style=''><?=($d->kelamin == 'p' ? 'Laki-laki' : 'Perempuan')?></td>
				</tr>
				<tr>
					<td style='width:30px;vertical-align:top;'>3</td>
					<td style='width:10px;vertical-align:top;'>:</td>
					<td style='width:300px;vertical-align:top;'>Umur</td>
					<td style='width:10px;vertical-align:top;'>:</td>
					<td style='font-weight:bold;'>
					<?
					$tahun=strtok(encrypt_decrypt('decrypt',$d->tanggal_lahir), '-');
					echo (date('Y')-$tahun);
					?> Tahun</td>
				</tr>
				<tr>
					<td style='width:30px;vertical-align:top;'>4</td>
					<td style='width:10px;vertical-align:top;'>:</td>
					<td style='width:300px;vertical-align:top;'>Pendidikan Umum</td>
					<td style='width:10px;vertical-align:top;'>:</td>
					<td style='border-bottom:1px dotted #aaa;font-weight:bold;'><?=strtoupper(encrypt_decrypt('decrypt',$d->pendidikan))?></td>
				</tr>
				<tr>
					<td style='width:30px;vertical-align:top;'>&nbsp;</td>
					<td style='width:10px;vertical-align:top;'>:</td>
					<td style='width:300px;vertical-align:top;'>Pendidikan Agama</td>
					<td style='width:10px;vertical-align:top;'>:</td>
					<td style='border-bottom:1px dotted #aaa;font-weight:bold;'></td>
				</tr>
				<tr>
					<td style='width:30px;vertical-align:top;'>5</td>
					<td style='width:10px;vertical-align:top;'>:</td>
					<td style='width:300px;vertical-align:top;'>Pekerjaan</td>
					<td style='width:10px;vertical-align:top;'>:</td>
					<td style='font-weight:bold;'><?=encrypt_decrypt('decrypt',$d->pekerjaan)?></td>
				</tr>
				<tr>
					<td style='width:30px;vertical-align:top;'>6</td>
					<td style='width:10px;vertical-align:top;'>:</td>
					<td style='width:300px;vertical-align:top;'>Alamat Rumah</td>
					<td style='width:10px;vertical-align:top;'>:</td>
					<td style='font-weight:bold;'><?=encrypt_decrypt('decrypt',$d->alamat)?></td>
				</tr>
				<tr>
					<td style='width:30px;vertical-align:top;'>7</td>
					<td style='width:10px;vertical-align:top;'>:</td>
					<td style='width:300px;vertical-align:top;'>I'tikaf saya ini adalah yang ke </td>
					<td style='width:10px;vertical-align:top;'>:</td>
					<td style='font-weight:bold;'><?=(is_null($d->itikafke) ? 1 : ($d->itikafke))?> Kalinya</td>
				</tr>
				<tr>
					<td style='width:30px;vertical-align:top;'>8</td>
					<td style='width:10px;vertical-align:top;'>:</td>
					<td style='width:300px;vertical-align:top;'>Amalan I'tikaf saya yang terakhir</td>
					<td style='width:10px;vertical-align:top;'>:</td>
					<td style='font-weight:bold;'><?=encrypt_decrypt('decrypt',$d->kaji)?></td>
				</tr>
				<tr>
					<td style='width:30px;vertical-align:top;'>9</td>
					<td style='width:10px;vertical-align:top;'>:</td>
					<td style='width:300px;vertical-align:top;'>Saya masuk Tharikat</td>
					<td style='width:10px;vertical-align:top;'>:</td>
					<td style='font-weight:bold;'>
					<?
					list($thnd,$blnd,$tgld)=explode('-', $d->tgl_terdaftar);
					?>
						Tanggal : <b><?=$tgld?></b> -- Bulan : <b><?=getBulan($blnd)?></b> -- Tahun : <b><?=$thnd?></b></td>
				</tr>
				<tr>
					<td style='width:30px;vertical-align:top;'>10</td>
					<td style='width:10px;vertical-align:top;'>:</td>
					<td style='width:300px;vertical-align:top;'>Saya tidak pernah dikeluarkan dari I'tikaf </td>
					<td style='width:10px;vertical-align:top;'></td>
					<td style='font-weight:bold;'>(Kalau Pernah, jelaskan sewaktu I'tikaf ke : _________, pada hari ke : __________)</td>
				</tr>
				<tr>
					<td style='width:30px;vertical-align:top;'>11</td>
					<td style='width:10px;vertical-align:top;'>:</td>
					<td colspan="3" style='width:300px;vertical-align:top;'>Sebelum masuk Tharikat / selama ini, saya telah mempunyai pegangan, amalan
					_________________________________________________________ <br>yang telah saya amalkan sejak _______________________________________</td>
				</tr>				
				<tr>
					<td style='width:30px;vertical-align:top;'>12</td>
					<td style='width:10px;vertical-align:top;'>:</td>
					<td style='width:300px;vertical-align:top;'>Sakit keras yang pernah / sedang saya derita adalah</td>
					<td style='width:10px;vertical-align:top;'>:</td>
					<td style='border-bottom:1px dotted #aaa;font-weight:bold;'></td>
				</tr>
				<tr>
					<td style='width:30px;vertical-align:top;'>13</td>
					<td style='width:10px;vertical-align:top;'>:</td>
					<td style='' colspan="3">Saya tidak sedang berurusan / terlibat dengan pihak berwajib dalam suatu perkara atau kejahatan kriminal dan G.30.S.PKI</td>
				</tr>
				<tr>
					<td style='width:30px;vertical-align:top;'>14</td>
					<td style='width:10px;vertical-align:top;'>:</td>
					<td style='' colspan="3">Saya telah memperoleh izin dari suami untuk ikut I'tikaf</td>
				</tr>
				<tr>
					<td style='width:30px;vertical-align:top;'>15</td>
					<td style='width:10px;vertical-align:top;'>:</td>
					<td style='width:300px;vertical-align:top;'>Keterangan Lain-lain</td>
					<td style='width:10px;vertical-align:top;'>:</td>
					<td style='border-bottom:1px dotted #aaa;font-weight:bold;'></td>
				</tr>

			</table>
			<table border="0" style="width:100%" cellpadding="0" cellspacing="0">
				<tr>
					<th>Demikian permohonan ini saya perbuat dalam keadaan sadar dan dengan sebenarnya, bila keterangan-keterangan ini ternyata tidak benar adalah sepenuhnya tanggung jawan saya sendiri.</th>
				</tr>
			</table>
			<table border="0" style="width:100%" cellpadding="0" cellspacing="0">
				<tr>

					<th style="text-align:center;width:50%">
						<br>Diketahui oleh,<br>
						<br> 
						<br> 
						<br> 
						<br>
						(______________________________)<br>
						Pengurus 1
					</th>					
					<th style="text-align:center;width:50%">
						Arco, <?=tgl_indo(date('Y-m-d'))?><br>
						Pemohon
						<br> 
						<br> 
						<br> 
						<br>
						<b>( <?=encrypt_decrypt('decrypt',$d->nama)?> )</b><br>
					</th>
				</tr>
			</table>
			<hr>
			<table border="0" style="width:100%" cellpadding="0" cellspacing="0">
				<tr>

					<th style="text-align:center;width:50%;padding-left:40px;">
						DISAHKAN OLEH PETUGAS
						<br>
						<div style="text-align:left;">
							<div style="width:20%;float:left">
								Biaya Makan
							</div>
							<div style="width:5px;float:left">
								:	
							</div>
							<div style="width:75%;float:left">
								Rp. <?=(number_format($biayamakan))?>
							</div>
						</div>						
						<div style="text-align:left;">
							<div style="width:20%;float:left">
								Sedekah&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</div>
							<div style="width:5px;float:left">
								:	
							</div>
							<div style="width:75%;float:left">
								Rp. <?=(number_format($sedekah))?>
							</div>
						</div>
						<div style="text-align:left;">
							<div style="width:20%;float:left">
								Jumlah&nbsp;&nbsp;&nbsp;&nbsp;
							</div>
							<div style="width:5px;float:left">
								:	
							</div>
							<div style="width:75%;float:left">
								<b><u>Rp. <?=(number_format($biayamakan+$sedekah))?></u></b>
							</div>
						</div>
						
					</th>					
					<th style="text-align:center;width:50%;">
						Depok, <?=tgl_indo(date('Y-m-d'))?><br>
						Petugas Keuangan
						<br> 
						<br> 
						<br> 
						<br>
						(______________________________)<br>
					</th>
				</tr>
			</table>
		</div>
	</body>
</html>
<style type="text/css" media="print">
  @page { 
  	size: A4; 
  }
  @media print {
  html, body {
    width: 210mm;
    height: 297mm;
  }
  /* ... the rest of the rules ... */
}
</style>
<style type="text/css">
*
{
	line-height: 20px;
	font-size : 105%;
}
.tabel th,
.tabel td
{
	
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
div
{
	font-size: 12px !important;
	padding-top:0px;
	padding-bottom:0px;
	margin-top:-1px !important;
	margin-bottom:0px;
}
ol li 
{
	margin-top:3px !important;
	margin-bottom:0px !important;
}
div.b128{
	border-left: 1px black solid;
	height: 40px !important;
}

</style>
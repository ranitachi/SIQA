<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	</head>
	<body onLoad="window.print()">
	<!-- <body> -->
		<div style="width:1000px !important;padding:10px;" class="body">
			<table border="0" style="width:100%" cellpadding="0" cellspacing="0">
				<tr>
					<td style="width:15%;text-align:center;vertical-align:top">

					</td>
					<td style="width:70%;vertical-align:top;text-align:center">
						<h1 style="font-size:40px !important;">SURAU QUTUBUL AMIN ARCO</h1>
						<h3>Jl. Buni No. 11 Telp 0251 - 8619189 Arco - Sawangan, Depok</h3>
					</td>
					<td style="width:15%;vertical-align:top;text-align:center;padding:4px;">&nbsp;</td>
				</tr>
			</table>
			<hr>
			<table style="border-bottom: 0px !important;border-right: 0px !important;width:100%;margin-top:20px;" class="tabel" cellpadding="2" cellspacing="0">
        <tr>
          <td style="width:20%;">&nbsp;</td>
          <td style="width:10%;">Nama</td>
          <td style="width:1%;">:</td>
          <td style="width:68%;font-weight:bold;"><?=encrypt_decrypt('decrypt',$people->nama)?></td>
        </tr>
        <tr>
          <td style="width:20%;">&nbsp;</td>
          <td style="width:10%;">Telepon</td>
          <td style="width:1%;">:</td>
          <td style="width:68%;font-weight:bold;"><?=encrypt_decrypt('decrypt',$people->telp)?></td>
        </tr>
        <tr>
          <td style="width:20%;">&nbsp;</td>
          <td style="width:10%;">Alamat</td>
          <td style="width:1%;">:</td>
          <td style="width:68%;font-weight:bold;"><?=encrypt_decrypt('decrypt',$people->alamat)?></td>
        </tr>
      </table>
      <center>
      <table border="1" style="border-bottom: 0px !important;border-right: 0px !important;width:90%;margin-top:20px;" class="tabel" cellpadding="2" cellspacing="0">
        <tr>
          <th style="width:5%;">No</th>
          <th style="width:20%;">Nama Keluarga</th>
          <?
          // $zkt=$this->Zismodel->getJenis(1,'asc');
          $input_z=$input_i=$jinput_z=$jinput_i='';
          $z=1;
          $xx=0;
          foreach($zakat as $ix => $z)
          {
            echo '<th style="text-align:center;width:90px;font-size:10px;">Zakat<br>'.encrypt_decrypt('decrypt',$z->jenis).'</th>';

          }
          // $inf=$this->Zismodel->getJenis(2,'asc');
          foreach($infak as $ix => $z)
          {
            echo '<th style="text-align:center;width:90px;font-size:10px;">'.encrypt_decrypt('decrypt',$z->jenis).'</th>';
          }
          ?>
          <th style="width:18%;font-weight:bold;text-align:center">Jumlah</th>
        </tr>
        <?
        $jlh=0;
        foreach ($d as $k => $v)
        {
          if(isset($j[$v->jenis_id]))
          {
            $ket=encrypt_decrypt('decrypt',$v->keterangan);
            $kk=explode(',',$ket);
            $kt='';
            echo '<tr>';
            echo '<td style="text-align:center">'.($k+1).'</td>';
            echo '<td style="text-align:left">'.$kk[$k].'</td>';
            foreach($zakat as $ix => $z)
            {
              if($v->jenis_id==$z->id)
                $n=$v->jumlah;
              else
                $n=0;

              echo '<td style="text-align:right;width:90px;font-size:10px;">'.number_format($n,0,',','.').'</td>';
            }
            // $inf=$this->Zismodel->getJenis(2,'asc');
            foreach($infak as $ix => $z)
            {
              if($v->jenis_id==$z->id)
                $m=$v->jumlah;
              else
                $m=0;
              echo '<td style="text-align:right;width:90px;font-size:10px;">'.number_format($m,0,',','.').'</td>';
            }
            echo '<td style="text-align:right;padding-right:15px;">'.number_format($v->jumlah,0,',','.').'</td>';
            echo '</tr>';
            $jlh+=$v->jumlah;
          }
        }
        ?>
        <tr>
          <th colspan="<?=(count($zakat) + count($infak) +2)?>">T O T A L</th>
          <th style="width:15%;font-weight:bold;text-align:right;padding-right:20px;"><?=number_format($jlh,0,',','.')?></th>
        </tr>
        <tr>
          <th colspan="<?=(count($zakat) + count($infak) +3)?>" style="text-align:right"><i>Terbilang : </i><?=ucwords(terbilang($jlh))?> Rupiah</th>
        </tr>
      </table>
    </center>
			<table border="0" style="width:100%" cellpadding="0" cellspacing="0">
				<tr>

					<th style="text-align:center;width:50%">
						<br>Diterima oleh,<br>
						<br>
						<br>
						<br>
						<br>
						(______________________________)<br>

					</th>
					<th style="text-align:center;width:50%">
						Arco, <?=tgl_indo(date('Y-m-d'))?><br>
						Penyetor
						<br>
						<br>
						<br>
						<br>
						<br>
						<b>(______________________________)</b><br>
					</th>
				</tr>
			</table>
			<hr>

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
    height: 150mm;
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

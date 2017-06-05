<div class="row">

     <div class="col-md-12">
         <div class="portlet light bordered">
             <div class="portlet-title">
                <div class="caption">
                	<i class="fa fa-users"></i>Form ZIS
                </div>

			</div>
             <div class="portlet-body form">
				<form id="formzis" method="post" enctype="multipart/form-data">

										<div id="printArea">
											<div class="row" style="margin-bottom:0px;padding-bottom:0px;">

												<div class="row">

													<div class="col-lg-4 col-md-4" style="text-align:left;padding-left:70px;">
														Barcode Transaksi :<br>
														<input type="hidden" name="kwitansi" id="kwitansi" class="span4" value="<?=$idd?>">
														<?
														echo bar128($idd);
														?>
													</div>
													<div class="col-lg-1 col-md-1"  style="margin-top:10px;">
														<h5 style="padding-bottom:7px;">Nama</h5>
														<h5 style="padding-bottom:7px;">Telepon</h5>
														<h5 style="">Alamat</h5>
													</div>
													<div class="col-lg-1 col-md-1"  style="margin-top:10px;width:10px;">
														<h5 style="padding-bottom:7px;">:</h5>
														<h5 style="padding-bottom:7px;">:</h5>
														<h5 style="">:</h5>
													</div>
													<div class="col-lg-3 col-md-3"  style="margin-top:10px;">

															<input type="text" class="form-control" style="width:300px;" autocomplete="off" id="nama" name="nama">
															<input type="text" class="form-control" style="width:200px;" autocomplete="off" id="telepon" name="telepon">
															<input type="text" class="form-control" style="width:550px;" id="alamat" autocomplete="off" name="alamat">

														<input type="hidden" name="id" id="id">
													</div>
													<div class="col-lg-3 col-md-3"  style="margin-top:10px;">&nbsp;
													</div>
												</div>
												<div class="row">

													<!-- <div class="col-lg-12 col-md-12"  style="margin-top:10px;">
															<div style="float: right;margin-top: 10px;">
																<button class="btn btn-primary btn-xs pull-right" type="button" style="float:right;" id="namakeluarga">Keluarga</button>
															</div>
													</div> -->
												</div>

												<div class="row" style="padding:10px;margin-bottom:0px;padding-bottom:0px;float:left;"">
													<div class="col-lg-12 col-md-12" id="form_zakat">
														<table class="table table-striped table-bordered table-hover">
															<thead>
																<th style="text-align:center;">No</th>
																<th style="text-align:center;">Nama Keluarga</th>
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
																<th style="text-align:center;">Total</th>
															</thead>
															<tbody>
															<?
															for($i=0;$i<10;$i++)
															{
																echo '<tr>
																	<td style="text-align:center">'.($i+1).'</td>
																	<td style="text-align:center"><input type="text" name="nama_keluarga[]" id="nama_keluarga" style="width:100%" class="nama_keluarga_'.$i.'"></td>';
																$xx=0;
																$input_z=$input_i=$jinput_z=$jinput_i='';
																$z=1;
																foreach($zakat as $ix => $z)
																{
																	echo '<td>
																		<input type="text" autocomplete="off" name="tr['.$z->id.']['.$i.']" style="margin:0px;text-align:right;width:90%;font-size:11px;" id="nzakat_'.$ix.'" class="nnn_'.$i.'" value="0" onkeyup="hitungaja('.$ix.',this.value,'.$i.')">
																		</td>';

																	$xx++;
																}
																foreach($infak as $ix => $z)
																{
																	echo '<td><input type="text" autocomplete="off" name="tr['.$z->id.']['.$i.']" style="margin:0px;text-align:right;width:90%;font-size:11px;" id="ninfak_'.$ix.'" class="nnn_'.$i.'" value="0" onkeyup="hitungaja('.$ix.',this.value,'.$i.')"></td>';

																	$xx++;
																}
																echo '<td style="text-align:right;font-weight:bold" ><span id="total_'.$i.'" class="tot">0</span></td>
																</tr>';
															}
															?>
															</tbody>
															<thead>
																<tr>
																	<th style="text-align:center"></th>
																	<?
																	$xx=0;
																	foreach($zakat as $ix => $z)
																	{

																		echo '<th><input type="hidden" autocomplete="off"  style="margin:0px;text-align:right;width:90%;font-size:11px;" id="jzakat_'.$ix.'" class="jzakat" value="0">
																		<div class="jzakat_'.$ix.'" style="text-align:right">0</div>
																		</th>';
																		$xx++;
																	}
																	foreach($infak as $ix => $z)
																	{

																		echo '<th><input type="hidden" autocomplete="off" style="margin:0px;text-align:right;width:90%;font-size:11px;" id="jinfak_'.$ix.'" class="jinfak" value="0">
																		<div class="jinfak_'.$ix.'" style="text-align:right">0</div>
																		</th>';
																		$xx++;
																	}
																	?>
																	<th style="text-align:right;font-weight:bold;font-size:14px;" id="totalsemua">0</th>
																	<input type="hidden" name="totalinput" id="totalinput">
																</tr>
																<tr>
																	<th colspan="10" style="text-align:right;font-size:12px;">
																	Terbilang : <span id="terbilang"></span>
																	</th>
																</tr>
															</thead>
														</table>

													</div>
													<div class="col-lg-3 col-md-3" id="namakeluarga">
													<?
													for ($i=0;$i<10;$i++)
													{
													?>
														<div class="row">
															<div class="col-lg-12 col-md-12">
																<input type="text" name="keluarga[]" class="form-control" id="namakeluarga">
															</div>
														</div>
													<?
													}
													?>
													</div>
											</div>
											<style>
											div#a1{
												padding-left:0px !important;
												margin-left:0px !important;
											}
											div#a2{
												text-align:left !important;
												margin-left:0px !important;
											}
											input[type="text"]
											{
												border:0px !important;
												border-bottom:1px solid #eee !important;
												box-shadow:0px !important;
												-webkit-box-shadow:inset 0 0 0 rgba(0, 0, 0, 0) !important;
												box-shadow: inset 0 0 0 rgba(0, 0, 0, 0) !important;
											}

											div.b128{
												border-left: 1px black solid;
												height: 30px !important;
											}
											</style>
										</div>
										<div class="form-actions" style="padding-left:300px;">
											<button type="button" id="saveZIS" class="btn btn-primary">Simpan</button>
											<button class="btn" type="button" id="Cancel">Cancel</button>
										</div>
									</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('button#namakeluarga').click(function(){
		$('div#namakeluarga').show();
		$('div#form_zakat').removeClass('col-lg-12 col-md-12').addClass('col-lg-9 col-md-9');
	});
	function hitungaja(n,vl,id)
	{
		//alert(n);

		// var l='<?=$xx?>';
		var jlh=$('input#nzakat_'+n).size();
		//alert(l);
		var j_=i_=tj_=ti_=sm=0;
		/*for(var x=0;x<jlh;x++)
		{
			var _ = parseFloat($('#nzakat_'+x).val());
			j_ += _;
		}*/
		$('span.tot').each(function(i){
			var n=$(this).text();
			var __s = parseFloat(n.replace(/,/g,''));
			sm += __s;
		});
		$('input#totalinput').val(sm);
		$('#totalsemua').text(numeral(sm).format('0,0'));
		$('#terbilang').text(terbilang(sm));


		$('input.nnn_'+id).each(function(i)
		{
			var __ = parseFloat(str_replace(',','',$(this).val()));
			tj_ += __;
			// alert(__);
			// $(this).val(numeral(_).format('0,0'));
		});
		$('span#total_'+id).text(tj_);
		$('span#total_'+id).text(numeral(tj_).format('0,0'));

		$('input#nzakat_'+n).each(function(i)
		{
			//parseInt(str_replace(',','',jZakat)
			var _ = parseFloat(str_replace(',','',$(this).val()));
			j_ += _;
			$(this).val(numeral(_).format('0,0'));
		});

		$('div.jzakat_'+n).text(j_);
		$('div.jzakat_'+n).text(numeral(j_).format('0,0'));
		// $('div.jzakat_'+n).formatCurrency({ symbol:'' });

		$('input#ninfak_'+n).each(function(i)
		{
			//parseInt(str_replace(',','',jZakat)
			var _ = parseFloat(str_replace(',','',$(this).val()));
			i_ += _;
			$(this).val(numeral(_).format('0,0'));
		});

		$('div.jinfak_'+n).text(i_);
		$('div.jinfak_'+n).text(numeral(i_).format('0,0'));

		// $('div.jinfak_'+n).formatCurrency({ symbol:'' });

	}
</script>

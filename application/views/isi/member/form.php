<div class="row">
     
     <div class="col-md-12">
         <div class="portlet light bordered">
         
             <div class="portlet-title">
                <div class="caption">
                	<i class="fa fa-users"></i>Form <?=$id==-1 ? 'Tambah' : 'Edit'?> Data 
                </div>
                
			</div>
             <div class="portlet-body form">
				<form class="form-horizontal" method="post" id="addMemberBaru" enctype="multipart/form-data" role="form">
					
					<fieldset>
						<div class="row">
							<div class="col-md-6">
								<div>
									
								  <div class="form-group">
									<label class="col-md-3 control-label" for="input01">Nama Lengkap *</label>
									<div class="col-md-9">
									  <!-- <input type="text" class="input-xlarge" id="idnama" name="nama" required maxlength="28"> -->
									  <div class="input-group">
                                        <span class="input-group-addon">
                                        	<i class="fa fa-bars"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama" value="<?=($id!=-1 ? encrypt_decrypt('decrypt', $d->nama) : '')?>"> 
                                       </div>
									</div>
								  </div>
								 
								 <div class="form-group">
									<label class="col-md-3 control-label" for="input01">Jenis Identitas</label>
									<div class="col-md-9">
									  <!-- <input type="text" class="input-xlarge" id="idnama" name="nama" required maxlength="28"> -->
										  <select id="idjenis" name="jenis_identitas" class="form-control">
											<option value="ktp">KTP</option>
											<option value="sim">SIM</option>
											<option value="pasport">PASSPORT</option>
											<option value="lain-lain">Lain-lain</option>
										  </select>
									
									</div>
								  </div>
								  <div class="form-group">
									<label class="col-md-3 control-label" for="input01">No Identitas</label>
									<div class="col-md-9">
									  <!-- <input type="text" class="input-xlarge" id="idnama" name="nama" required maxlength="28"> -->
									  <div class="input-group">
                                        <span class="input-group-addon">
                                        	<i class="fa fa-bars"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="No.Identitas" name="no_identitas" value="<?=($id!=-1 ? encrypt_decrypt('decrypt', $d->no_identitas) : '')?>"> 
                                       </div>
									</div>
								  </div>
								  <div class="form-group">
									<label class="col-md-3 control-label" for="input01">Email</label>
									<div class="col-md-9">
									  <!-- <input type="text" class="input-xlarge" id="idnama" name="nama" required maxlength="28"> -->
									  <div class="input-group">
                                        <span class="input-group-addon">
                                        	<i class="fa fa-at"></i>
                                        </span>
                                        <input type="email" class="form-control" placeholder="Email" name="email" value="<?=($id!=-1 ? encrypt_decrypt('decrypt', $d->email) : '')?>"> 
                                       </div>
									</div>
								  </div>
								  <div class="form-group">
									<label class="col-md-3 control-label" for="input01">No. Telp/HP</label>
									<div class="col-md-9">
									  <!-- <input type="text" class="input-xlarge" id="idnama" name="nama" required maxlength="28"> -->
									  <div class="input-group">
                                        <span class="input-group-addon">
                                        	<i class="fa fa-phone"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="No Telp" name="telp" value="<?=($id!=-1 ? encrypt_decrypt('decrypt', $d->telp) : '')?>"> 
                                       </div>
									</div>
								  </div>

								  <div class="form-group">
									<label class="col-md-3 control-label" for="input01">Jenis Kelamin</label>
									<div class="col-md-9">
									  <!-- <input type="text" class="input-xlarge" id="idnama" name="nama" required maxlength="28"> -->
										  <select id="idjenis" name="kelamin" class="form-control input-small">
											<option value="p" <?
													if($id!=-1)
													{
														if($d->kelamin=='p')
															echo 'selected="selected"';
													}
												?>>Pria</option>
											<option value="w" <?
													if($id!=-1)
													{
														if($d->kelamin=='w')
															echo 'selected="selected"';
													}
												?>>Wanita</option>
										  </select>
									
									</div>
								  </div>
								  <div class="form-group">
									<label class="col-md-3 control-label" for="input01">Member</label>
									<div class="col-md-9">
									  <!-- <input type="text" class="input-xlarge" id="idnama" name="nama" required maxlength="28"> -->
										  <select id="idjenis" name="member" class="form-control input-small">
											<option value="t" <?=$member=='t' ? 'Selected="selected"' : ''?> <?
													if($id!=-1)
													{
														if($d->member=='t')
															echo 'selected="selected"';
													}
												?>>Ya</option>
											<option value="f" <?=$member=='f' ? 'Selected="selected"' : ''?> <?
													if($id!=-1)
													{
														if($d->member=='f')
															echo 'selected="selected"';
													}
												?>>Tidak</option>
										  </select>
									
									</div>
								  </div>
								  <div class="form-group">
								  <?
								  $tgldaftar=$tgllantik=$tgllahir='';
								  if($id!=-1)
								  {
								  	if(strpos(encrypt_decrypt('decrypt',$d->tanggal_lahir),'/')!==false)
								  	{
								  		list($tgl,$bln,$thn)=explode('/', encrypt_decrypt('decrypt',$d->tanggal_lahir));
								  		$tgllahir=$thn.'-'.$bln.'-'.$tgl;
								  	}
								  	else
								  	{
								  		$tgllahir=encrypt_decrypt('decrypt',$d->tanggal_lahir);
								  	}
								  	// echo $tgllahir;
								  	$tgldaftar=date('Y-m-d',strtotime($d->tgl_terdaftar));
								  	$tgllantik=date('Y-m-d',strtotime($d->tgl_pelantikan));
								  	$tgllahir=date('Y-m-d',strtotime($tgllahir));
								  }
								  ?>
									<label class="col-md-3 control-label" for="input01">Tanggal Daftar</label>
									<div class="col-md-9">
									  <!-- <input type="text" class="input-xlarge" id="idnama" name="nama" required maxlength="28"> -->
									  <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Tanggal Daftar" id="tglll" name="tgl_terdaftar" value="<?=($id!=-1 ? $tgldaftar : date('Y-m-d'))?>"> 
                                        <span class="input-group-addon">
                                        	<i class="fa fa-calendar"></i>
                                        </span>
                                       </div>
									</div>
								  </div>
								  <div class="form-group">
									<label class="col-md-3 control-label" for="input01">Tanggal Dilantik</label>
									<div class="col-md-9">
									  <!-- <input type="text" class="input-xlarge" id="idnama" name="nama" required maxlength="28"> -->
									  <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Tanggal Daftar" id="tgllll" name="tgl_pelantikan" value="<?=($id!=-1 ? $tgllantik : date('Y-m-d'))?>"> 
                                        <span class="input-group-addon">
                                        	<i class="fa fa-calendar"></i>
                                        </span>
                                       </div>
									</div>
								  </div>
								  
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="col-md-3 control-label" for="input01">Tempat Lahir</label>
									<div class="col-md-9">
									  <!-- <input type="text" class="input-xlarge" id="idnama" name="nama" required maxlength="28"> -->
									  <div class="input-group">
                                        <span class="input-group-addon">
                                        	<i class="fa fa-map-marker"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Tempat Lahir" id="tempat_lahir" name="tempat_lahir" value="<?=($id!=-1 ? encrypt_decrypt('decrypt', $d->tempat_lahir) : '')?>"> 
                                       </div>
									</div>
								  </div>

								  <div class="form-group">
									<label class="col-md-3 control-label" for="input01">Tanggal Lahir</label>
									<div class="col-md-9">
									  <!-- <input type="text" class="input-xlarge" id="idnama" name="nama" required maxlength="28"> -->
									  <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Tanggal Lahir" id="tgl_lahir" name="tanggal_lahir" value="<?=($id!=-1 ? $tgllahir : date('Y-m-d'))?>"> 
                                        <span class="input-group-addon">
                                        	<i class="fa fa-calendar"></i>
                                        </span>
                                       </div>
									</div>
								  </div>

								  <div class="form-group">
									<label class="col-md-3 control-label" for="input01">Asal Peserta</label>
									<div class="col-md-9">
									  <!-- <input type="text" class="input-xlarge" id="idnama" name="nama" required maxlength="28"> -->
									  <div class="input-group">
                                        <span class="input-group-addon">
                                        	<i class="fa fa-map-marker"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Asal" id="asal" name="asal" value="<?=($id!=-1 ? encrypt_decrypt('decrypt', $d->asal) : '')?>"> 
                                       </div>
									</div>
								  </div>
								  <div class="form-group">
									<label class="col-md-3 control-label" for="input01">Status Peserta</label>
									<div class="col-md-9">
									  <!-- <input type="text" class="input-xlarge" id="idnama" name="nama" required maxlength="28"> -->
									  <!-- <div class="input-group"> -->
									  	<select id="status" name="status" class="form-control input-large">
										  <option value=""></option>
									  <?

									  	$status=$this->db->from('surau')->where('status_tampil','1')->get()->result();
									  	// echo $d->status;
										  foreach ($status as $k => $v) 
										  {
										  	if(encrypt_decrypt('decrypt',$d->status)==(encrypt_decrypt('decrypt',$v->namasurau).' - '.encrypt_decrypt('decrypt',$v->alamat)))
										  		echo '<option value="'.$d->status.'" selected="selected">'.(encrypt_decrypt('decrypt',$v->namasurau).' - '.encrypt_decrypt('decrypt',$v->alamat)).'</option>';
										  	else
										  		echo '<option value="'.(encrypt_decrypt('decrypt',$v->namasurau).' - '.encrypt_decrypt('decrypt',$v->alamat)).'">'.(encrypt_decrypt('decrypt',$v->namasurau).' - '.encrypt_decrypt('decrypt',$v->alamat)).'</option>';
										  }
										 ?>
										 </select>
                                        <!-- <span class="input-group-addon">
                                        	<i class="fa fa-bars"></i>
                                        </span> -->
                                        
                                       <!-- </div> -->
									</div>
								  </div>
								  <div class="form-group">
                                        <label class="col-md-3 control-label">Alamat</label>
                                        <div class="col-md-9">
                                        	<textarea class="form-control" rows="3" id="textarea" rows="3" name="alamat"><?=($id!=-1 ? encrypt_decrypt('decrypt', $d->alamat) : '')?></textarea>
                                        </div>
                                  </div>
                                  <div class="form-group">
									<label class="col-md-3 control-label" for="input01">Nama Orang Tua</label>
									<div class="col-md-9">
									  <!-- <input type="text" class="input-xlarge" id="idnama" name="nama" required maxlength="28"> -->
									  <div class="input-group">
                                        <span class="input-group-addon">
                                        	<i class="fa fa-map-bars"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Nama Orang Tua" id="nama_orang_tua" name="nama_orang_tua" value="<?=($id!=-1 ? encrypt_decrypt('decrypt', $d->nama_orang_tua) : '')?>"> 
                                       </div>
									</div>
								  </div>
								  <div class="form-group">
									<label class="col-md-3 control-label" for="input01">Pendidikan</label>
									<div class="col-md-9">
									  <!-- <input type="text" class="input-xlarge" id="idnama" name="nama" required maxlength="28"> -->
									  <div class="input-group">
                                        <span class="input-group-addon">
                                        	<i class="fa fa-map-bars"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Pendidikan" id="pendidikan" name="pendidikan" value="<?=($id!=-1 ? encrypt_decrypt('decrypt', $d->pendidikan) : '')?>"> 
                                       </div>
									</div>
								  </div>
								  <div class="form-group">
									<label class="col-md-3 control-label" for="input01">Pekerjaan</label>
									<div class="col-md-9">
									  <!-- <input type="text" class="input-xlarge" id="idnama" name="nama" required maxlength="28"> -->
									  <div class="input-group">
                                        <span class="input-group-addon">
                                        	<i class="fa fa-map-bars"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Pekerjaan" id="pekerjaan" name="pekerjaan" value="<?=($id!=-1 ? encrypt_decrypt('decrypt', $d->pekerjaan) : '')?>"> 
                                       </div>
									</div>
								  </div>
								  <?
								  if($id!=-1)
								  {
								  	$level=$this->db->from('level')->where('status_tampil','t')->get()->result();
								  ?>
								  <div class="form-group">
									<label class="col-md-3 control-label" for="input01">Kaji</label>
									<div class="col-md-9">
									  <!-- <input type="text" class="input-xlarge" id="idnama" name="nama" required maxlength="28"> -->
										  <select id="kaji" name="kaji" class="form-control input-small">
										  <option value=""></option>
										  <?
										  foreach ($level as $k => $v) 
										  {
										  	if($d->kaji==encrypt_decrypt('decrypt',$v->keterangan))
										  		echo '<option value="'.$d->kaji.'" selected="selected">'.encrypt_decrypt('decrypt',$v->keterangan).'</option>';
										  	else
										  		echo '<option value="'.encrypt_decrypt('decrypt',$v->keterangan).'">'.encrypt_decrypt('decrypt',$v->keterangan).'</option>';
										  }
										  ?>
										  </select>
									
									</div>
								  </div>
								  <div class="form-group">
									<label class="col-md-3 control-label" for="input01">Itikaf Ke</label>
									<div class="col-md-9">
									  <!-- <input type="text" class="input-xlarge" id="idnama" name="nama" required maxlength="28"> -->
									  <div class="input-group">
                                        <span class="input-group-addon">
                                        	<i class="fa fa-map-bars"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Itikaf Ke" id="itikafke" name="itikafke" value="<?=($id!=-1 ? $d->itikafke : '0')?>"> 
                                       </div>
									</div>
								  </div>
								  <?	
								  }
								  ?>
                                  <div class="form-group">
                                        <label class="col-md-3 control-label">Foto</label>
                                        <div class="col-md-9">
											  <div class="input-group input-medium">
											  	<span class="input-group-addon">
		                                        	<i class="fa fa-file-image-o"></i>
		                                        </span>
			                                    <input type="text" class="form-control" name="foto" placeholder="Foto" readonly="readonly">
			                                    <span class="input-group-btn">
			                                    	<button class="btn blue" type="button"><i class="fa fa-camera"></i> Foto</button>
			                                    </span>
			                                  </div>
			                            </div>
			                      </div>
							</div>
						</div>

					  
					  <div class="form-actions" style="padding-left:300px;">
						<button type="button" id="saveAddMember" class="btn btn-primary">Simpan</button>
						<button class="btn" type="button" id="Cancel">Cancel</button>
					  </div>
					</fieldset>
					</form>
				</div>
         </div>
     </div>
 </div>
<script type="text/javascript">
	$('#tglll,#tgllll,#tgl_lahir').datepicker({
		format:'yyyy-mm-dd',
		autoclose:true,
	});

	$('#saveAddMember').click(function(){
        $('#dynamic-content-confirm').html('<h3>Apakah Data Member Sudah Benar ?</h3>'); // load here
        $('#modal-loader-confirm').hide(); // hide loader  
        $('#confirm').modal();

		$('#confirmbutton').click(function(){
			$.ajax({
				url: '<?=site_url()?>member/proses/<?=$id?>',
				data : $('#addMemberBaru').serialize(),
				type :'POST',
				success: function(a)
				{
					$('#confirm').modal('hide');
                    $('#dynamic-content-pesan').html('<h3>'+a+'</h3>');
                    $('#pesan').modal();
                    $('.nav-tabs a[href="#tab_1_1_1"]').tab('show');
                    loaddatamember();
				}
			});
		});

	});
	$('#Cancel').click(function(){
			$('.nav-tabs a[href="#tab_1_1_1"]').tab('show');
			$('#tab_1_1_3').load('<?=site_url()?>member/form/<?=$member?>/-1');
		});
</script>
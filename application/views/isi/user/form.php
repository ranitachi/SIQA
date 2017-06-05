<div class="row">
     
     <div class="col-md-12">
         <div class="portlet light bordered">
             <div class="portlet-title">
                <div class="caption">
                	<i class="fa fa-users"></i>Form <?=$id==-1 ? 'Tambah' : 'Edit'?> Data 
                </div>
                
			</div>
             <div class="portlet-body form">
				<form class="form-horizontal" action="<?=site_url()?>user/proses/<?=$id?>/profil" method="post" id="addMemberBaru" enctype="multipart/form-data" role="form">
					
					<fieldset>
					<?
					// echo '<pre>';
					// print_r($d);
					// echo '</pre>';
					?>
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
                                        <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama" value="<?=($id!=-1 ? encrypt_decrypt('decrypt', $d[0]->nama):'')?>"> 
                                       </div>
									</div>
								  </div>
								 
								 <div class="form-group">
									<label class="col-md-3 control-label" for="input01">Jenis Identitas</label>
									<div class="col-md-9">
									  <!-- <input type="text" class="input-xlarge" id="idnama" name="nama" required maxlength="28"> -->
										  <select id="idjenis" name="jenis_identitas" class="form-control">
											<option value="ktp" <?=($id!=-1 ? ($d[0]->jenis_identitas=='ktp' ? 'selected=selected"' : '' ) : '')?>>KTP</option>
											<option value="sim" <?=($id!=-1 ? ($d[0]->jenis_identitas=='sim' ? 'selected="selected"' : '' ) : '')?>>SIM</option>
											<option value="pasport" <?=($id!=-1 ? ($d[0]->jenis_identitas=='pasport' ? 'selected="selected"' : '' ) : '')?>>PASSPORT</option>
											<option value="lain-lain" <?=($id!=-1 ? ($d[0]->jenis_identitas=='lain-lain' ? 'selected="selected"' : '' ) : '')?>>Lain-lain</option>
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
                                        <input type="text" class="form-control" placeholder="No.Identitas" value="<?=($id!=-1 ? encrypt_decrypt('decrypt', $d[0]->no_identitas):'')?>" name="no_identitas"> 
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
                                        <input type="email" class="form-control" placeholder="Email" value="<?=($id!=-1 ?encrypt_decrypt('decrypt', $d[0]->email):'')?>" name="email"> 
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
                                        <input type="text" class="form-control" placeholder="No Telp" value="<?=($id!=-1 ? encrypt_decrypt('decrypt', $d[0]->telp):'')?>" name="telp"> 
                                       </div>
									</div>
								  </div>

								  <div class="form-group">
									<label class="col-md-3 control-label" for="input01">Level</label>
									<div class="col-md-9">
									  <!-- <input type="text" class="input-xlarge" id="idnama" name="nama" required maxlength="28"> -->
										  <select id="level" name="level" class="form-control input-small">
											<option value="0" <?=($id!=-1 ? ($d[0]->level=='0' ? 'selected="selected"' : '' ) : '')?>>Admin</option>
											<option value="1" <?=($id!=-1 ? ($d[0]->level=='1' ? 'selected="selected"' : '' ) : '')?>>Level 1</option>
											<option value="2" <?=($id!=-1 ? ($d[0]->level=='2' ? 'selected="selected"' : '' ) : '')?>>Level 2</option>
											<option value="3" <?=($id!=-1 ? ($d[0]->level=='3' ? 'selected="selected"' : '' ) : '')?>>Level 3</option>
										  </select>
									
									</div>
								  </div>
								  <div class="form-group">
									<label class="col-md-3 control-label" for="input01">Member</label>
									<div class="col-md-9">
									  <!-- <input type="text" class="input-xlarge" id="idnama" name="nama" required maxlength="28"> -->
										  <select id="idjenis" name="member" class="form-control input-small">
											<option value="t"  <?=($id!=-1 ? ($d[0]->member=='t' ? 'selected="selected"' : ($member=='t' ? 'Selected="selected"' : '') ) : '')?>>Ya</option>
											<option value="f"  <?=($id!=-1 ? ($d[0]->member=='f' ? 'selected="selected"' : ($member=='f' ? 'Selected="selected"' : '') ) : '')?>>Tidak</option>
										  </select>
									
									</div>
								  </div>
								 
								  <div class="form-group">
									<label class="col-md-3 control-label" for="input01">Username</label>
									<div class="col-md-9">
									  <!-- <input type="text" class="input-xlarge" id="idnama" name="nama" required maxlength="28"> -->
									  <div class="input-group">
                                        <span class="input-group-addon">
                                        	<i class="fa fa-user"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Username" name="username" value="<?=($id!=-1 ? encrypt_decrypt('decrypt', $d[0]->username):'')?>"> 
                                       </div>
									</div>
								  </div>
								  
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="input01">Password</label>
									<div class="col-md-9">
										<div class="input-group">
										    <span class="input-group-addon">
										    	<i class="fa fa-lock"></i>
										    </span>
										    <input type="password" class="form-control" placeholder="Password" name="password" value=""> 
										    <span class="input-group-addon" style="cursor:pointer;">
										    	<i class="fa fa-eye"></i>
										    </span>
										</div>
									</div>
									<div class="col-md-3"></div>
									<div class="col-md-9">
                                        <small><i><?=($id!=-1 ? 'Biarkan Kosong jika Tidak Diganti':'')?></i></small>
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
                                        <input type="text" class="form-control" placeholder="Tempat Lahir" id="tempat_lahir" name="tempat_lahir" value="<?=($id!=-1 ? encrypt_decrypt('decrypt',$d[0]->tempat_lahir):'')?>"> 
                                       </div>
									</div>
								  </div>

								  <div class="form-group">
									<label class="col-md-3 control-label" for="input01">Tanggal Lahir</label>
									<div class="col-md-9">
									  <!-- <input type="text" class="input-xlarge" id="idnama" name="nama" required maxlength="28"> -->
									  <div class="input-group">
									  <?
									  	if($id!=-1)
									  	{
									  		if($d[0]->tanggal_lahir!='')
									  		{

										  		$t=str_replace('undefined/', '', encrypt_decrypt('decrypt',$d[0]->tanggal_lahir));
										  		$t1=explode('/', $t);
										  		$t2=explode('-', $t);
										  		$thn='0000';
										  		$bln='00';
										  		$tgl='00';
										  		if(count($t1)>1)
										  		{
										  			$tgl=$t1[0];
										  			$bln=$t1[1];
										  			$thn=$t1[2];									  			
										  		}
										  		else
										  		{
										  			if(strlen($t2[0])==4)
										  			{
										  				$tgl=$t2[2];
											  			$bln=$t2[1];
											  			$thn=$t2[0];
										  			}
										  			else
										  			{
											  			// $tgl=$t2[0];
											  			// $bln=$t2[1];
											  			// $thn=$t2[2];	
										  			}
										  		}
										  		$tgl_lahir=$thn.'-'.$bln.'-'.$tgl;
									  		}
										  	else
										  		$tgl_lahir='';
									  	}
									  	else
									  		$tgl_lahir='';
									  ?>
                                        <input type="text" class="form-control" placeholder="Tanggal Lahir" id="tgl_lahir" name="tanggal_lahir" value="<?=$tgl_lahir?>"> 
                                        <span class="input-group-addon">
                                        	<i class="fa fa-calendar"></i>
                                        </span>
                                       </div>
									</div>
								  </div>

								  
								  <div class="form-group">
                                        <label class="col-md-3 control-label">Alamat</label>
                                        <div class="col-md-9">
                                        	<textarea class="form-control" rows="3" id="textarea" rows="3" name="alamat" required><?=($id!=-1 ? encrypt_decrypt('decrypt',$d[0]->alamat):'')?></textarea>
                                        </div>
                                  </div>

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

					  
					  <div class="form-actions" style="text-align: right;">
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
	$('#tgl_lahir').datepicker({
		format:'yyyy-mm-dd',
		autoclose:true,
	});
	$('#saveAddMember').click(function(){
        $('#dynamic-content-confirm').html('<h3>Apakah Data yang Diisi Sudah Benar ?</h3>'); // load here
        $('#modal-loader-confirm').hide(); // hide loader  
        $('#confirm').modal();

		$('#confirmbutton').click(function(){
			$.ajax({
				url: '<?=site_url()?>user/proses/<?=$id?>/profile/<?=$pid?>',
				data : $('#addMemberBaru').serialize(),
				type :'POST',
				success: function(a)
				{
					$('#confirm').modal('hide');
                    $('#dynamic-content-pesan').html('<h3>'+a+'</h3>');
                    $('#pesan').modal();
                    $('#profile').load('<?=site_url()?>user/form/<?=$id?>/<?=$pid?>');
                     tampildata();
                     $('.nav-tabs a[href="#tab_1_1_1"]').tab('show');
				}
			});
		});
	});
	$('#Cancel').click(function(){
			$('.nav-tabs a[href="#tab_1_1_1"]').tab('show');
			 $('#tab_1_1_3').load('<?=site_url()?>user/form/-1/-1');
		});
</script>
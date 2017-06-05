<div class="row">
     
     <div class="col-md-12">
         <div class="portlet light bordered">
             <div class="portlet-title">
                <div class="caption">
                	<i class="fa fa-bars"></i>Form <?=$id==-1 ? 'Tambah' : 'Edit'?> Data Kaji
                </div>
                
			</div>
             <div class="portlet-body form">
				<form class="form-horizontal" action="<?=site_url()?>config/kajiproses/<?=$id?>" method="post" id="addMemberBaru" enctype="multipart/form-data" role="form">
					
					<fieldset>
						<div class="row">
							<div class="col-md-6">
								<div>
									
								  <div class="form-group">
									<label class="col-md-3 control-label" for="input01">Kaji *</label>
									<div class="col-md-9">
									  <!-- <input type="text" class="input-xlarge" id="idnama" name="nama" required maxlength="28"> -->
									  <div class="input-group">
                                        <span class="input-group-addon">
                                        	<i class="fa fa-bars"></i>
                                        </span>
                                        <input type="text" class="form-control input-xsmall" placeholder="Kaji" name="level" value="<?=($id!=-1 ? encrypt_decrypt('decrypt',$d->level) : '')?>"> 
                                       </div>
									</div>
								  </div>
								  <div class="form-group">
									<label class="col-md-3 control-label" for="input01">Keterangan</label>
									<div class="col-md-9">
									  <!-- <input type="text" class="input-xlarge" id="idnama" name="nama" required maxlength="28"> -->
									  <div class="input-group">
                                        <span class="input-group-addon">
                                        	<i class="fa fa-bars"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Keterangan Kaji" name="keterangan" value="<?=($id!=-1 ? encrypt_decrypt('decrypt',$d->keterangan) : '')?>"> 
                                       </div>
									</div>
								  </div>
								  <div class="form-group">
									<label class="col-md-3 control-label" for="input01">Warna Background</label>
									<div class="col-md-9">
									  <!-- <input type="text" class="input-xlarge" id="idnama" name="nama" required maxlength="28"> -->
									  <div class="input-group">
                                        <span class="input-group-addon">
                                        	<i class="fa fa-bars"></i>
                                        </span>
                                        <input type="text" class="form-control input-small demo" placeholder="Warna Background" name="warna" value="<?=($id!=-1 ? encrypt_decrypt('decrypt',$d->warna) : '')?>"> 
                                       </div>
									</div>
								  </div>
								  <div class="form-group">
									<label class="col-md-3 control-label" for="input01">Warna Tulisan</label>
									<div class="col-md-9">
									  <!-- <input type="text" class="input-xlarge" id="idnama" name="nama" required maxlength="28"> -->
									  <div class="input-group">
                                        <span class="input-group-addon">
                                        	<i class="fa fa-bars"></i>
                                        </span>
                                        <input type="text" class="form-control input-small demo" placeholder="Warna Font" name="warnafont" value="<?=($id!=-1 ? encrypt_decrypt('decrypt',$d->warnafont) : '')?>"> 
                                       </div>
									</div>
								  </div>
								 
								  
							</div>
							

					  
					  <div class="form-actions" style="padding-left:300px;">
						<button type="submit" id="saveAddMember" class="btn btn-primary">Simpan</button>
						<button class="btn" type="button" onclick="location.href='<?=site_url()?>config/kaji'">Cancel</button>
					  </div>
					</fieldset>
					</form>
				</div>
         </div>
     </div>
 </div>
 <script type="text/javascript">
 	$('input.demo').each(function(){
 		$(this).minicolors({
	 		 theme: 'bootstrap'
	 	});		
 	});
 </script>

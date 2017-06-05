<div class="row">
     
     <div class="col-md-12">
         <div class="portlet light bordered">
             <div class="portlet-title">
                <div class="caption">
                	<i class="fa fa-bars"></i>Form <?=$id==-1 ? 'Tambah' : 'Edit'?> Data Surau
                </div>
                
			</div>
             <div class="portlet-body form">
				<form class="form-horizontal" action="<?=site_url()?>config/surauproses/<?=$id?>" method="post" id="addMemberBaru" enctype="multipart/form-data" role="form">
					
					<fieldset>
						<div class="row">
							<div class="col-md-6">
								<div>
									
								  <div class="form-group">
									<label class="col-md-3 control-label" for="input01">Nama Surau *</label>
									<div class="col-md-9">
									  <!-- <input type="text" class="input-xlarge" id="idnama" name="nama" required maxlength="28"> -->
									  <div class="input-group">
                                        <span class="input-group-addon">
                                        	<i class="fa fa-bars"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Nama Surau" name="namasurau" value="<?=($id!=-1 ? encrypt_decrypt('decrypt',$d[0]->namasurau) : '')?>"> 
                                       </div>
									</div>
								  </div>
								  <div class="form-group">
									<label class="col-md-3 control-label" for="input01">Alamat Surau *</label>
									<div class="col-md-9">
									  <!-- <input type="text" class="input-xlarge" id="idnama" name="nama" required maxlength="28"> -->
									  <div class="input-group">
                                        <span class="input-group-addon">
                                        	<i class="fa fa-bars"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Alamat Surau" name="alamat"  value="<?=($id!=-1 ? encrypt_decrypt('decrypt',$d[0]->alamat) : '')?>"> 
                                       </div>
									</div>
								  </div>
								 
								  
							</div>
							

					  
					  <div class="form-actions" style="padding-left:300px;">
						<button type="submit" id="saveAddMember" class="btn btn-primary">Simpan</button>
						<button class="btn" type="button" onclick="location.href='<?=site_url()?>config/surau'">Cancel</button>
					  </div>
					</fieldset>
					</form>
				</div>
         </div>
     </div>
 </div>

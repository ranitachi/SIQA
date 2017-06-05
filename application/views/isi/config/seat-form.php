<div class="row">
     
     <div class="col-md-12">
         <div class="portlet light bordered">
             <div class="portlet-title">
                <div class="caption">
                	<i class="fa fa-bars"></i>Form <?=$id==-1 ? 'Tambah' : 'Edit'?> Data Seat
                </div>
                
			</div>
             <div class="portlet-body form">
				<form class="form-horizontal" action="<?=site_url()?>config/seatproses/<?=$id?>" method="post" id="addMemberBaru" enctype="multipart/form-data" role="form">
					
					<fieldset>
						<div class="row">
							<div class="col-md-6">
								<div>
									

									<div class="form-group">
									<label class="col-md-3 control-label" for="input01">Nomor Huruf</label>
									<div class="col-md-9">
									  <!-- <input type="text" class="input-xlarge" id="idnama" name="nama" required maxlength="28"> -->
										  <select id="huruf" name="huruf" class="form-control input-xsmall">
										  <?
										  for ($i=65; $i <=90 ; $i++) 
										  { 
										  	// if($d[0]->huruf==chr($))
										  ?>
											<option value="<?=chr($i)?>" <?=$id!=-1 ? ($d[0]->huruf==chr($i) ? 'Selected="selected"' : '') : ''?>><?=chr($i)?></option>
										  <?
										  }
										  ?>
										  </select>
									
									</div>
								  </div>
								  <div class="form-group">
									<label class="col-md-3 control-label" for="input01">Nomor Angka *</label>
									<div class="col-md-9">
									  <!-- <input type="text" class="input-xlarge" id="idnama" name="nama" required maxlength="28"> -->
									  <div class="input-group">
                                        <span class="input-group-addon">
                                        	<i class="fa fa-bars"></i>
                                        </span>
                                        <input type="text" class="form-control input-xsmall" placeholder="Angka" name="angka" value="<?=($id!=-1 ? $d[0]->angka : '')?>"> 
                                       </div>
									</div>
								  </div>
								 
								  <div class="form-group">
									<label class="col-md-3 control-label" for="input01">Kategori</label>
									<div class="col-md-9">
									  <!-- <input type="text" class="input-xlarge" id="idnama" name="nama" required maxlength="28"> -->
										  <select id="kategori" name="kategori" class="form-control input-small">
										 
											<option value="laki-laki" <?=$id!=-1 ? (encrypt_decrypt('decrypt',$d[0]->kategori)=='laki-laki' ? 'Selected="selected"' : '') : ''?>>Laki-laki</option>
											<option value="perempuan" <?=$id!=-1 ? (encrypt_decrypt('decrypt',$d[0]->kategori)=='perempuan' ? 'Selected="selected"' : '') : ''?>>Perempuan</option>
										  </select>
									
									</div>
								  </div>
							</div>
							

					  
					  <div class="form-actions" style="padding-left:300px;">
						<button type="submit" id="saveAddMember" class="btn btn-primary">Simpan</button>
						<button class="btn" type="button" onclick="location.href='<?=site_url()?>config/seat'">Cancel</button>
					  </div>
					</fieldset>
					</form>
				</div>
         </div>
     </div>
 </div>

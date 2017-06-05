<div class="row">
     
     <div class="col-md-12">
         <div class="portlet light bordered">
             <div class="portlet-title">
                <div class="caption">
                	<i class="fa fa-users"></i>Form <?=$id==-1 ? 'Tambah' : 'Edit'?> Data Event
                </div>
                
			</div>
             <div class="portlet-body form">
				<form class="form-horizontal" action="<?=site_url()?>event/proses/<?=$id?>" method="post" id="addEvent" enctype="multipart/form-data" role="form">
					
					<fieldset>
						<div class="row">
							<div class="col-md-6">
								<div>
									
								  <div class="form-group">
									<label class="col-md-3 control-label" for="input01">Nama Event *</label>
									<div class="col-md-9">
									  <!-- <input type="text" class="input-xlarge" id="idnama" name="nama" required maxlength="28"> -->
									  <div class="input-group">
                                        <span class="input-group-addon">
                                        	<i class="fa fa-bars"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Nama Event" name="event_name" value="<?=($id!=-1 ? encrypt_decrypt('decrypt',$d->event_name) : '')?>"> 
                                       </div>
									</div>
								  </div>
								 <div class="form-group">
									<label class="col-md-3 control-label" for="input01">Waktu *</label>
									<?
									$tglawal=$tglakhir='';
									if($id!=-1)
									{
										$tglawal=date('d/m/Y',strtotime($d->event_time));
										if($d->event_time_finish!="")
											$tglakhir=date('d/m/Y',strtotime($d->event_time_finish));
									}
									?>
									<div class="col-md-9">
									  <!-- <input type="text" class="input-xlarge" id="idnama" name="nama" required maxlength="28"> -->
									  <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Waktu" id="tglll" name="waktu" value="<?=$tglawal?> - <?=$tglakhir?>"> 
                                        <span class="input-group-addon">
                                        	<i class="fa fa-calendar"></i>
                                        </span>
                                       </div>
									</div>
								  </div>
								  <script type="text/javascript">
                                        	$('#tglll').daterangepicker(
                                        		{
                                        			locale: {
												      format: 'DD/MM/YYYY'
												    }
                                        		});
                                        </script>
								  <div class="form-group">
									<label class="col-md-3 control-label" for="input01">Tempat *</label>
									<div class="col-md-9">
									  <!-- <input type="text" class="input-xlarge" id="idnama" name="nama" required maxlength="28"> -->
									  <div class="input-group">
                                        <span class="input-group-addon">
                                        	<i class="fa fa-map-marker"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Tempat" name="event_place" value="<?=($id!=-1 ? encrypt_decrypt('decrypt',$d->event_place) : '')?>"> 
                                       </div>
									</div>
								  </div>
								  
								  <div class="form-group">
									<label class="col-md-3 control-label" for="input01">Status</label>
									<div class="col-md-9">
									  <!-- <input type="text" class="input-xlarge" id="idnama" name="nama" required maxlength="28"> -->
										  <select id="idjenis" name="status" class="form-control input-small">
											<option value="t" <?=$member=='t' ? 'Selected="selected"' : ''?> 
												<?
													if($id!=-1)
													{
														if($d->status=='t')
															echo 'selected="selected"';
													}
												?>
											>Ya</option>
											<option value="f" <?=$member=='f' ? 'Selected="selected"' : ''?>
												<?
													if($id!=-1)
													{
														if($d->status=='f')
															echo 'selected="selected"';
													}
												?>
											>Tidak</option>
										  </select>
									
									</div>
								  </div>

								  <input type="hidden" name="jenis" value="<?=$member?>">
								  
							</div>
							

					  
					  <div class="form-actions" style="text-align: right;">
						<button type="button" id="saveAddMember" class="btn btn-primary">Simpan</button>
						<button class="btn">Cancel</button>
					  </div>
					</fieldset>
					</form>
				</div>
         </div>
     </div>
 </div>
<script type="text/javascript">
	$('#saveAddMember').click(function(){
        $('#dynamic-content-confirm').html('<h3>Apakah Data Event Sudah Benar ?</h3>'); // load here
        $('#modal-loader-confirm').hide(); // hide loader  
        $('#confirm').modal();

		$('#confirmbutton').click(function(){
			$.ajax({
				url: '<?=site_url()?>event/proses/<?=$id?>',
				data : $('#addEvent').serialize(),
				type :'POST',
				success: function(a)
				{
					$('#confirm').modal('hide');
                    $('#dynamic-content-pesan').html('<h3>'+a+'</h3>');
                    $('#pesan').modal();
                    $('.nav-tabs a[href="#tab_1_1_1"]').tab('show');
                    // loaddataevent();
                    location.href='<?=site_url()?>event/index/<?=$member?>';
				}
			});
		});
	});
</script>
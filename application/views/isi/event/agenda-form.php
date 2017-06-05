<form class="form-horizontal"  method="post" id="addagendabaru" enctype="multipart/form-data" role="form">
	
	<fieldset>
		<div class="row">
			<div class="col-md-6">
				<div>
					
				  <div class="form-group">
					<label class="col-md-3 control-label" for="input01">Agenda</label>
					<div class="col-md-9">
					  <!-- <input type="text" class="input-xlarge" id="idnama" name="nama" required maxlength="28"> -->
					  <div class="input-group">
                        <span class="input-group-addon">
                        	<i class="fa fa-bars"></i>
			            </span>
            			<input type="text" class="form-control input-xlarge" placeholder="Agenda" name="detail_name"> 
                       </div>
					</div>
				  </div>
				 <div class="form-group">
					<label class="col-md-3 control-label" for="input01">Tanggal</label>
					<div class="col-md-9">
					  <!-- <input type="text" class="input-xlarge" id="idnama" name="nama" required maxlength="28"> -->
					  <div class="input-group">
                        <input type="text" class="form-control" placeholder="Tanggal" id="date" name="date"> 
                        	<span class="input-group-addon">
                            	<i class="fa fa-calendar"></i>
				            </span>
                      </div>
					</div>
				  </div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label" for="input01">Waktu</label>
					<div class="col-md-9">
					  <!-- <input type="text" class="input-xlarge" id="idnama" name="nama" required maxlength="28"> -->
					  <div class="input-group">
                        <select name="hour" id="hour" class="form-control input-xsmall">
						<?
							for($i=0;$i<=23;$i++)
							{
								if($i<10)
									$i='0'.$i;
								
								echo '<option value="'.$i.'">'.$i.'</option>';
							}
						?>
						</select>
						<select name="minute" id="minute" class="form-control input-xsmall">
						<?
							for($i=0;$i<=60;$i++)
							{
								if($i<10)
									$i='0'.$i;
								
								echo '<option value="'.$i.'">'.$i.'</option>';
							}
						?>
						</select>
                      </div>
					</div>
				  </div>
				</div>
			</div>
		</div>
	</fieldset>
</form>
<script type="text/javascript">
	$('#date').datepicker({
		format:'yyyy-mm-dd',
		autoclose:true,
	});
</script>
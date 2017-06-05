<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Dashboard</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!--basic styles-->

		<link href="<?=base_url()?>media/css/bootstrap.min.css" rel="stylesheet" />
		<link href="<?=base_url()?>media/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="<?=base_url()?>media/css/font-awesome.min.css" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="<?=base_url()?>media/css/font-awesome-ie7.min.css" />
		<![endif]-->
		<link rel="stylesheet" href="<?=base_url()?>media/css/jquery-ui-1.10.3.custom.min.css" />
		<link rel="stylesheet" href="<?=base_url()?>media/css/chosen.css" />
		<link rel="stylesheet" href="<?=base_url()?>media/css/datepicker.css" />
		<link rel="stylesheet" href="<?=base_url()?>media/css/bootstrap-timepicker.css" />
		<link rel="stylesheet" href="<?=base_url()?>media/css/daterangepicker.css" />
		<link rel="stylesheet" href="<?=base_url()?>media/css/colorpicker.css" />

		<!--fonts-->

		<link rel="stylesheet" href="<?=base_url()?>media/css/ace-fonts.css" />
		<!--page specific plugin styles-->

		<!--fonts-->

		<link rel="stylesheet" href="<?=base_url()?>media/css/ace-fonts.css" />
		<link rel="stylesheet" href="<?=base_url()?>media/css/chosen.css" />

		<!--ace styles-->

		<link rel="stylesheet" href="<?=base_url()?>media/css/ace.min.css" />
		<link rel="stylesheet" href="<?=base_url()?>media/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="<?=base_url()?>media/css/ace-skins.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="<?=base_url()?>media/css/ace-ie.min.css" />
		<![endif]-->

		<!--inline styles related to this page-->

		<!--ace settings handler-->

		<script src="<?=base_url()?>media/js/ace-extra.min.js"></script>
	</head>

	<body class="login-layout" style="background:#fff !important">
		<div style="width:100%;float:left;height:100%;">
		  <div style="width:50%;float:left;">
			<div style="width:100%;margin:0 auto;text-align:center;padding-top:280px;">
				<h2>Welcome to <?=$this->config->item('nama')?></h2>
				<h4><?=$this->config->item('kepanjangan')?></h4>
				<div style="position:fixed;bottom:0px;width:50%;text-align:center">
				&copy; <?=date('Y')?> <?=$this->config->item('nama')?>. All Rights Reserved.
			</div>
			</div>
			
		  </div>
		  <div style="width:50%;float:left;background:#A6DB6E;height:100%;position:fixed;right:0">
			<div style="width:100%;text-align:center;padding-top:200px;">
			<?=form_open('login/cek')?>	 
				 <div class="control-group">
				  
				  <div class="controls">
					<input type="text" class="input-xlarge" name="username" placeholder=" Username" id="input-success" style="padding:10px;">
				  </div>
				</div>
				 <div class="control-group">
				  
				  <div class="controls">
					<input type="password" class="input-xlarge" name="password" placeholder=" password" id="input-success" style="padding:10px">
				  </div>
				</div>
				 <div class="control-group">
				  
				  <div class="controls">
					<input type="submit" class="btn btn-success" value="Login" style="padding:10px;background:green !important;width:290px">
				  </div>
				</div>
			<?=form_close()?>
			</div>
		  </div>
		</div><!--/.main-container-->


		<!--basic scripts-->

		<!--[if !IE]>-->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?=base_url()?>media/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!--<![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='<?=base_url()?>media/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='<?=base_url()?>media/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="<?=base_url()?>media/js/bootstrap.min.js"></script>

		<!--page specific plugin scripts-->

		<!--ace scripts-->

		<script src="<?=base_url()?>media/js/ace-elements.min.js"></script>


		<!--inline scripts related to this page-->

		<script type="text/javascript">


			$(document).ready(function(){
				setInterval(function(){ 
					$('div#alerterror').fadeOut('slow');
				}, 5000);
			})
		</script>
	</body>
</html>

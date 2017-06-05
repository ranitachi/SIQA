<div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    <!-- BEGIN THEME PANEL -->
                    
                    <!-- END THEME PANEL -->
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="icon-users"></i>
                                <a href="#">User</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <span>Profile User</span>
                            </li>
                        </ul>
                        
                    </div>
                    <!-- END PAGE HEADER-->
                    <div class="row">
                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                             <div class="portlet box green-meadow bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-folder-open-o"></i>
                                            <span class="caption-subject bold uppercase">PROFILE USER</span>
                                        </div>
                                       
                                    </div>
                                    </div>
                                    <div class="portlet-body" id="profile">
                            </div>
                        </div>
                    </div>
                 </div>
</div>
<script type="text/javascript">
    $('#profile').load('<?=site_url()?>user/form/<?=$id?>/<?=$pid?>');
</script>

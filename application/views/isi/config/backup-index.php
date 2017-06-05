<div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    <!-- BEGIN THEME PANEL -->
                    
                    <!-- END THEME PANEL -->
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="icon-settings"></i>
                                <a href="#">Pengaturan</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <span>Backup Database</span>
                            </li>
                        </ul>
                        
                    </div>
                    <!-- END PAGE HEADER-->
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                             <div class="portlet box green-meadow bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-database"></i>
                                            <span class="caption-subject bold uppercase">Backup Database</span>
                                        </div>
                                       
                                    </div>
                                    <div class="portlet-body">
                                        <div class="tabbable-custom nav-justified">
                                             <ul class="nav nav-tabs nav-justified">
                                                 <li class="active">
                                                     <a href="#tab_1_1_1" data-toggle="tab" aria-expanded="true">Data Log Backup</a>
                                                 </li>
                                                 <li>
                                                 </li>
                                                
                                             </ul>
                                             <div class="tab-content">
                                                 <div class="tab-pane active" id="tab_1_1_1">
                                                 </div>

                                                
                                             </div>
                                         </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
</div>
<script type="text/javascript">
    $('#tab_1_1_1').load('<?=site_url()?>config/backupcontainerdata',function(){
        $('#backupdata').DataTable( {
            "ajax": "<?=site_url()?>config/backupdata",
            "columns": [
                { "data": "no" },
                { "data": "tanggal_backup" },
                { "data": "nama_file" }
            ],
            // "responsive": true
        } );
    });
</script>
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
                                <span>Kaji</span>
                            </li>
                        </ul>
                        
                    </div>
                    <!-- END PAGE HEADER-->
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                             <div class="portlet box green-meadow bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-bars"></i>
                                            <span class="caption-subject bold uppercase">Data Kaji</span>
                                        </div>
                                       
                                    </div>
                                    <div class="portlet-body">
                                        <div class="tabbable-custom nav-justified">
                                             <ul class="nav nav-tabs nav-justified">
                                                 <li class="active">
                                                     <a href="#tab_1_1_1" data-toggle="tab" aria-expanded="true">Data Kaji</a>
                                                 </li>
                                                 <li class="">
                                                     <a href="#tab_1_1_3" data-toggle="tab" aria-expanded="false">Add Data Kaji</a>
                                                 </li>
                                             </ul>
                                             <div class="tab-content">
                                                 <div class="tab-pane active" id="tab_1_1_1">
                                                 </div>

                                                 <div class="tab-pane" id="tab_1_1_3">
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
    
    tampildata();
    function tampildata()
    {
        $('#tab_1_1_1').load('<?=site_url()?>config/kajicontainerdata',function(){
            $('#kajidata').DataTable( {
                "ajax": "<?=site_url()?>config/kajidata",
                "columns": [
                    { "data": "no" },
                    { "data": "level" },
                    { "data": "keterangan" },
                    { "data": "background" },
                    { "data": "warna" },
                    { "data": "warnafont" },
                    { "data": "action" }
                ],
                // "responsive": true
            } );
        });
        $('#tab_1_1_3').load('<?=site_url()?>config/kajiform/-1');
    }

    function edit(table,id)
    {
        $('#tab_1_1_3').load('<?=site_url()?>config/kajiform/'+id);
        $('.nav-tabs a:last').tab('show');
    }

    function hapus(table,id)
    {
        $('#dynamic-content-confirm').html('<h3>Yakin Ingin menghapus Data ini ?</h3>'); // load here
        $('#modal-loader-confirm').hide(); // hide loader  
        $('#confirm').modal();
        $('#confirmbutton').click(function(){
            $.ajax({
                url: '<?=site_url()?>config/kajihapus/'+id,
                success: function(a)
                {
                    $('#confirm').modal('hide');
                    $('#dynamic-content-pesan').html('<h3>'+a+'</h3>');
                    $('#pesan').modal();
                    tampildata();
                }
            });
        });
    }
</script>
<div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    <!-- BEGIN THEME PANEL -->
                    
                    <!-- END THEME PANEL -->
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="icon-calendar"></i>
                                <a href="#">Event</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <span>Data Event <?=$member=='member'?'Khusus Member':'Umum'?></span>
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
                                            <span class="caption-subject bold uppercase">DATA EVENT <?=$member=='member'?'KHUSUS MEMBER' : 'UMUM'?></span>
                                        </div>
                                       
                                    </div>
                                    <div class="portlet-body">
                                <div class="tabbable-custom nav-justified">
                                     <ul class="nav nav-tabs nav-justified">
                                         <li class="active">
                                             <a href="#tab_1_1_1" data-toggle="tab" aria-expanded="true">Event <?=$member=='member'?'Khusus Member' : 'Umum'?></a>
                                         </li>
                                         <li class="">
                                             <a href="#tab_1_1_3" data-toggle="tab" aria-expanded="false">Add Data Event <?=$member=='member'?'Khusus Member':'Umum'?></a>
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
    loaddataevent();
    function loaddataevent()
    {
        $('#tab_1_1_1').load('<?=site_url()?>event/containerdata/<?=$member?>',function(){
            $('#eventdata').DataTable( {
                "ajax": "<?=site_url()?>event/data/<?=$member?>",
                "columns": [
                    { "data": "no" },
                    { "data": "event_name" },
                    { "data": "event_time" },
                    { "data": "event_place" },
                    { "data": "jlhpeserta" },
                    { "data": "status" },
                    { "data": "action" }
                ],
                // "responsive": true
            } );
        });
        $('#tab_1_1_3').load('<?=site_url()?>event/form/<?=$member?>/-1');
    }

    function edit(table,id)
    {
        $('#tab_1_1_3').load('<?=site_url()?>event/form/<?=$member?>/'+id);
        $('.nav-tabs a:last').tab('show');
    }

    function hapus(table,id)
    {
        $('#dynamic-content-confirm').html('<h3>Yakin Ingin menghapus Data Event ini ?</h3>'); // load here
        $('#modal-loader-confirm').hide(); // hide loader  
        $('#confirm').modal();
        $('#confirmbutton').click(function(){
            $.ajax({
                url: '<?=site_url()?>event/hapus/'+id,
                success: function(a)
                {
                    $('#confirm').modal('hide');
                    $('#dynamic-content-pesan').html('<h3>'+a+'</h3>');
                    $('#pesan').modal();
                    loaddataevent();
                }
            });
        });
    }
</script>
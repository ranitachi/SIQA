<div class="row">
     
     <div class="col-md-12">
         <div class="portlet light bordered">
             <div class="portlet-title">
                <div class="caption">
                	<i class="fa fa-calendar"></i>Data Agenda 
                </div>
                
			</div>
             <div class="portlet-body">
                 <table class="table table-striped table-bordered table-hover" width="100%" id="agendadata">
                    <thead>
                        <tr>
                            <th class="all">No</th>
                            <th class="min-phone-l">Nama Agenda</th>
                            <th class="min-tablet">Waktu</th>
                            <th class="none">Jlh Peserta</th>
                            <th class="none">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?
                    foreach ($data as $k => $v) {
                        $jlh=$this->db->query('select * from people_has_event_detail where event_detail_id="'.$v->id.'" group by people_id')->result();
                        $jp='';
                        if(count($jlh)==0)
                        {
                            $jp='<span class="label label-warning">';
                            $jp.='<b>0</b> Terdaftar</span>';
                        }
                        else
                        {
                            
                            $jp='<span class="label label-success"><b>';
                            $jp.=count($jlh).'</b> Terdaftar</span>';
                        }
                        echo '<tr>';
                        echo '<td class="text-center">'.($k+1).'</td>';
                        echo '<td class="">'.encrypt_decrypt('decrypt',$v->detail_name).'</td>';
                        echo '<td class="text-center">'.($v->detail_time).'</td>';
                        echo '<td class="text-center">'.($jp).'</td>';
                        echo '<td class="text-center">
                            <button class="btn btn-xs btn-primary" onclick="proses(\''.$v->id.'\',\''.$id.'\')"><i class="fa fa-search"></i></button>
                            <button class="btn btn-xs btn-danger" onclick="hapusagenda(\'agenda\',\''.$v->id.'\',\''.$id.'\')"><i class="fa fa-trash"></i></button>
                            </td>';
                        echo '</tr>';
                    }
                    ?>
                    </tbody>
                </table>
             </div>
         </div>
     </div>
 </div>
 <script type="text/javascript">
     function proses(idagenda,idevent)
     {
        $('#caripeserta').load('<?=site_url()?>event/caripesertaform/'+idagenda+'/'+idevent,function(){
            $('#idPeserta').focus();
        });
        $('#large').modal();
        $('#modal-loader-large').show();
        $('#dynamic-content-large').html(''); // leave this div blank
        $.ajax({
              url: '<?=site_url()?>event/containeragendadatadetail',
              dataType: 'html'
         })
         .done(function(data){
             //console.log(data); 
            $('#dynamic-content-large').html(''); // blank before load.
            $('#dynamic-content-large').html(data); // load here
            $('#modal-loader-large').hide(); // hide loader  


             $('#agendadatadetail').DataTable({
                    "ajax": "<?=site_url()?>event/agendadatadetail/"+idagenda+'/'+idevent,
                    "columns": [
                        { "data": "no" },
                        { "data": "nama" },
                        { "data": "tanggal_lahir" },
                        { "data": "waktu_record" }
                    ]
                });

            
            //$('#basic').modal();

         })
         .fail(function(){
              $('#dynamic-content-large').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
              $('#modal-loader-large').hide();
         });
        // $('#large').modal();
     }

    function hapusagenda(table,id,idevent)
    {
        $('#dynamic-content-confirm').html('<h3>Yakin Ingin menghapus Data ini ?</h3>'); // load here
        $('#modal-loader-confirm').hide(); // hide loader  
        $('#confirm').modal();
        $('#confirmbutton').click(function(){
            $.ajax({
                url: '<?=site_url()?>event/hapusagenda/'+id,
                success: function(a)
                {
                    $('#confirm').modal('hide');
                    $('#dynamic-content-pesan').html('<h3>'+a+'</h3>');
                    $('#pesan').modal();
                    ambildata();
                }
            });
        });
    }
 </script>
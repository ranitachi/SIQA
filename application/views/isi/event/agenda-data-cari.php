<form role="form" id="idformku">
    <div class="form-body">
        <div class="form-group">
            <label>ID Peserta</label>
            <div class="input-group">
                <!-- <select class="select2 form-control" placeholder="Scan atau Ketik Barcode" id="idPeserta" name="idbarcode">
                    <option selected=""></option>
                </select> -->
                <input type="text" class="form-control input-large" id="idPeserta" name="idbarcode" placeholder="Scan atau Ketik Barcode"> 
            </div>
        </div>
    </div>
</form>
<?
        // echo '<pre>';
        // print_r($agendaid);
        // echo '</pre>';
    $d=$this->db->query('select * from people_has_event where event_id="'.$eventid.'"')->result();
        
    $nama='[ ';
    // $nama=array();
    if(count($d)!=0)
    {
        foreach($d as $k=> $n)
        {
            $p=$this->db->query('select * from people where id="'.$n->people_id.'"');
            $nama.='"'.addslashes(trim($n->event_id.' '.$n->id.' '.str_replace('-',' ',strtok($det[0]->event_time,' ')))).' | '.addslashes(encrypt_decrypt('decrypt',$p->row('nama'))).'",';
            // $nama[$k]['id']=addslashes(trim($n->event_id.' '.$n->id.' '.str_replace('-',' ',strtok($det[0]->event_time,' '))));
            // $nama[$k]['name']=addslashes(trim($n->event_id.' '.$n->id.' '.str_replace('-',' ',strtok($det[0]->event_time,' ')))).' | '.addslashes($p->row('nama'));
        }
    }
    $nama=substr($nama,0,-1);
    $nama.=']';
    // $data= json_encode($nama);
    // echo $data;
?>
<script type="text/javascript">
    $('#idPeserta').scannerDetection(function(){
        var data=$(this).val(); 
        //$('#add_item_form').submit(); 
    });

    $('#idPeserta').typeahead(
    {
        source : <?=$nama?>,
        autoSelect: true,
        updater : function(item)
        {
            var i=item.split('|');
            var x=i[0].split(' ');
            var event_id=x[0];
            var time_y=x[2];
            var time_m=x[3];
            var time_d=x[4];
            // $('#idPeserta').val(item);
            // alert(item);
            $.ajax({
                url : '<?=site_url()?>event/addagendamember/<?=$eventid?>/<?=$agendaid?>/'+i[0],
                success : function(s)
                {
                    //alert(s);
                    $('#pesanOuput').html(s);
                    table = $('#agendadatadetail').DataTable();
                    table.destroy();
                    table = $('#agendadatadetail').DataTable({
                        "ajax": "<?=site_url()?>event/agendadatadetail/<?=$agendaid?>/<?=$eventid?>",
                        "columns": [
                            { "data": "no" },
                            { "data": "nama" },
                            { "data": "tanggal_lahir" },
                            { "data": "waktu_record" }
                        ]
                    });
                    $('#idPeserta').val('');
                    $('#idPeserta').focus();
                    setTimeout(function()
                    {
                        $('#pesanOuput').html('');
                        
                    }, 3000);
                }
            });
            
            return i[1];
        }
    });
</script>
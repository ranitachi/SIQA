<form id="simpanitikaf">
    
<table class="table table-striped table-bordered table-hover" width="100%" id="member">
    <thead>
        <tr>
            <th class="all" style="width:20px;">No</th>
            <th class="min-">Event</th>
            <th class="min-phone-l">Itikaf Ke</th>
            <th class="min-tablet">Tanggal Ikut</th>
            <th class="none"  style="width:80px;">Action</th>

        </tr>
    </thead>
    <tbody>
    <?
    $event=$this->db->from('event')
            ->where('status','t')
            ->where('jenis',encrypt_decrypt('encrypt','member'))
            ->order_by('event_time','desc')
            ->get();

    $eventatt=$this->db->from('event_att')
            ->where('people_id',$id)
            ->get();

    $e_att=array();
    foreach ($eventatt->result() as $k => $v) {
        $e_att[$v->yang_ke]=$v;
    }

    // echo '<pre>';
    // print_r($e_att)
    // echo '</pre>';
    $op=array();
    for ($i=1; $i <=$jlh ; $i++) 
    { 
        echo '<tr>';
        echo '<td>'.($i).'</td>';
        echo '<td style="padding:0px;width:250px;">
            <select name="event[]" class="form-control chosen-select" data-placeholder="Pilih Event">';
        echo '<option>&nbsp;</option>';
            foreach ($event->result() as $k => $v) 
            {
                if(isset($e_att[$i]))
                {
                    if($e_att[$i]->event_id==$v->id)
                        echo '<option selected="selected" value="'.$v->id.'__'.encrypt_decrypt('decrypt',$v->event_name).'">'.encrypt_decrypt('decrypt',$v->event_name).'</option>';
                    else
                        echo '<option value="'.$v->id.'__'.encrypt_decrypt('decrypt',$v->event_name).'">'.encrypt_decrypt('decrypt',$v->event_name).'</option>';
                }
                else
                    echo '<option value="'.$v->id.'__'.encrypt_decrypt('decrypt',$v->event_name).'">'.encrypt_decrypt('decrypt',$v->event_name).'</option>';
            }
            
        echo '</select></td>';
        echo '<td style="padding:0px;width:40px;"><input type="text" style="width:100%;height:100%" name="itikafke[]" class="form-control" value="'.(isset($e_att[$i]) ? $e_att[$i]->yang_ke : '').'"></td>';
        echo '<td style="padding:0px;width:100px;"><input type="text" style="width:100%;height:100%" name="tglikut[]" id="tglikut" class="form-control" value="'.(isset($e_att[$i]) ? $e_att[$i]->tgl_ikut : '').'"></td>';
        echo '<td style="padding:0px;width:100px;text-align:center"><button class="btn btn-danger btn-xs" type="button" onclick="hapusrecord(\''.$id.'\',\''.$i.'\',\''.$jlh.'\')"><i class="fa fa-trash" ></i></button></td>';
        echo '</tr>';
    }
    ?>
    </tbody>
</table>
</form>
<script type="text/javascript">
    $('input#tglikut').datepicker({
        format:'yyyy-mm-dd',
        autoclose:true,
    });
</script>
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
                                <a href="#">Event</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <span>Data ZIS</span>
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
                                            <span class="caption-subject bold uppercase">Zakat, Infaq, Shodaqoh</span>
                                        </div>

                                    </div>
                                    <div class="portlet-body">
                                <div class="tabbable-custom nav-justified">
                                     <ul class="nav nav-tabs nav-justified">
                                         <li class="active">
                                             <a href="#tab_1_1_1" data-toggle="tab" aria-expanded="true">Data ZIS</a>
                                         </li>
                                         <li class="">
                                             <a href="#tab_1_1_3" data-toggle="tab" aria-expanded="false">Form ZIS</a>
                                         </li>
                                     </ul>
                                     <div class="tab-content">
                                         <div class="tab-pane active" id="tab_1_1_1">
                                           <div class="pull-right" style="margin-bottom:10px;">
                                             Tanggal Transaksi&nbsp;
                                             <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
                                                <input type="text" class="form-control" readonly="" value="<?=date('Y-m-d')?>">
                                                  <span class="input-group-btn">
                                                    <button class="btn default" type="button">
                                                      <i class="fa fa-calendar"></i>
                                                    </button>
                                                  </div>
                                                    </span>
                                            </div>

                                            <div id="data"></div>
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
<?
$d=$this->db->query('select * from v_users where level is null and tanggal_lahir is not null order by nama');
$nama='[';
if(count($d->result())!=0)
{
    foreach($d->result() as $n)
    {
        if(encrypt_decrypt('decrypt',$n->tanggal_lahir)!='0000-00-00')
        {
            $cb=explode('-', encrypt_decrypt('decrypt',$n->tanggal_lahir));
            if(count($cb)!=1)
                list($thl,$bll,$tgl)=explode('-',encrypt_decrypt('decrypt',$n->tanggal_lahir));
            else
            {
                if(strpos(encrypt_decrypt('decrypt',$n->tanggal_lahir), '/')!==false)
                    list($tgl,$bll,$thl)=explode('/',encrypt_decrypt('decrypt',$n->tanggal_lahir));
                else
                    list($thl,$bll,$tgl)=explode('-','0000-00-00');
            }
        }
        else

            list($thl,$bll,$tgl)=explode('-','0000-00-00');

        $no_idn=(encrypt_decrypt('decrypt',$n->no_identitas)==false ? $n->no_identitas : encrypt_decrypt('decrypt',$n->no_identitas));

        $nama.='"'.trim(trim($no_idn.'-'.encrypt_decrypt('decrypt',$n->nama)).'|'.$tgl.'/'.$bll.'/'.$thl).'",';
    }
}
$nama=substr($nama,0,-1);
$nama.=']';
// echo $nama;
?>
<script type="text/javascript">
$('.date-picker').datepicker({
    rtl: App.isRTL(),
    orientation: "right",
    autoclose: true
}).on('changeDate', function(ev){
  // alert(ev.format());
  $('#data').load('<?=site_url()?>zis/data/'+ev.format());
});

    $('#data').load('<?=site_url()?>zis/data');
    $('#tab_1_1_3').load('<?=site_url()?>zis/form/-1',function(){
        $('input#nama').typeahead(
        {
            source : <?=$nama?>,
            autoSelect: true,
            updater : function(item)
            {
                var tt=item.split('|');
                var tg=tt[1].replace(/\//g,'-');
                var i=tt[0].split('-');
                // alert(tt[0]);
                $.ajax({
                    url : '<?=site_url()?>member/datamember/'+i[0]+'/-1/umum/'+tg,
                    dataType : 'JSON',
                    success:function(suc)
                    {
                        $('#telepon').val(suc.telp);
                        $('#alamat').val(suc.alamat);
                    }
                });
                $('input.nama_keluarga_0').val(i[1]);
                return tt[0];
            }
        });
        $('input#nama_keluarga').typeahead(
        {
            source : <?=$nama?>,
            autoSelect: true,
            updater : function(item)
            {
                var tt=item.split('|');
                var tg=tt[1].replace(/\//g,'-');
                var i=tt[0].split('-');
                // alert(tt[0]);
                return i[1];
            }
        });
            $('#saveZIS').click(function(){
            $('#dynamic-content-confirm').html('<h3>Apakah Data ZIS Sudah Benar ?</h3>'); // load here
            $('#modal-loader-confirm').hide(); // hide loader
            $('#confirm').modal();

            $('#confirmbutton').click(function(){
                $.ajax({
                    url: '<?=site_url()?>zis/proses/-1',
                    data : $('#formzis').serialize(),
                    type :'POST',
                    success: function(a)
                    {

                        $('#confirm').modal('hide');
                        $('#dynamic-content-pesan').html('<h3>'+a+'</h3>');
                        $('#pesan').modal();
                        // $('.nav-tabs a[href="#tab_1_1_1"]').tab('show');
                        var kwi=$('input#kwitansi').val();
                        window.open(
                          '<?=site_url()?>zis/cetak/'+kwi,
                          '_blank'
                        );
                        location.href='<?=site_url()?>zis';
                    }
                });
            });

        });
        $('div#namakeluarga').hide();
    });

    function getjenis(val,i)
    {
        if(val==5)
        {
            $('div#fitrah_'+i).css({'display':'block'});
        }
        else
        {
            $('div#fitrah_'+i).css({'display':'none'});
        }
    }
</script>

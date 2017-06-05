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
                                <span>Detail Event</span>
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
    <span class="caption-subject bold uppercase">EVENT : <?=strtoupper(encrypt_decrypt('decrypt',$d[0]->event_name))?></span>
</div>
                                       
                                    </div>
                                    <div class="portlet-body">
                                <div class="tabbable-custom nav-justified">
                                     <ul class="nav nav-tabs nav-justified">
                                         <li class="active">
                                             <a href="#tab_1_1_1" data-toggle="tab" aria-expanded="true">Peserta Event</a>
                                         </li>
                                         <li class="">
                                             <a href="#tab_1_1_3" data-toggle="tab" aria-expanded="false">Agenda Event</a>
                                         </li>
                                                                             </ul>
                                                                             <div class="tab-content">
                                         <div class="tab-pane active" id="tab_1_1_1">

                                            <div class="row">
                                             <div class="col-md-12">
                                                 <div class="portlet light bordered">
                                                     <div class="portlet-title">
                                                        <div class="actions">
                                                            <a class="btn btn-sm btn-success" href="javascript:addpeserta(<?=$d[0]->id?>);">
                                                                <i class="fa fa-plus-circle"></i> Add Peserta
                                                            </a>

                                                            <a class="btn btn-sm  btn-primary" href="javascript:grafik(<?=$d[0]->id?>);">
                                                                <i class="fa fa-bar-chart"></i> Report
                                                            </a>
                                                            <div class="btn-group">
                                                                    <button class="btn blue btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true"> 
                                                                        <i class="fa fa-file-pdf-o"></i>
                                                                        To PDF
                                                                        <i class="fa fa-angle-down"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu" role="menu">
                                                                        <li>
                                                                            <a href="javascript:exportpdf(<?=$d[0]->id?>,'t')"> Member </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="javascript:exportpdf(<?=$d[0]->id?>,'f')"> Non Member </a>
                                                                        </li>
                                                                       
                                                                    </ul>
                                                                </div>
                                                        </div>
                                                    </div>
                                                     <div class="portlet-body">
                                                        <div class="row">
                                                            <div id="infodetail"></div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12" id="data"></div>
                                                        </div>
                                                    </div>
                                                    
                                                 </div>
                                             </div>
                                            </div>
                                            
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
    ambildata();
    function ambildata()
    {
        $('#infodetail').load('<?=site_url()?>event/detailinfo/<?=$member?>/<?=$d[0]->id?>');
        $('#data').load('<?=site_url()?>event/countainerdetaildata',function(){
            $('#dataeventdetaillk').DataTable( {
                "ajax": "<?=site_url()?>event/detaildata/<?=$d[0]->id?>/p/<?=$member?>",
                "columns": [
                    { "data": "no" },
                    { "data": "nama" },
                    { "data": "asal" },
                    { "data": "tanggal_lahir" },
                    { "data": "action" }
                ],
                "columnDefs": [
                    { width: "5%", targets: 0 },
                    { width: "40%", targets: 1 },
                    { width: "25%", targets: 4 },
                ],
                bAutoWidth: false
                // "responsive": true
            } );
            $('#dataeventdetailpr').DataTable( {
                "ajax": "<?=site_url()?>event/detaildata/<?=$d[0]->id?>/w/<?=$member?>",
                "columns": [
                    { "data": "no" },
                    { "data": "nama" },
                    { "data": "asal" },
                    { "data": "tanggal_lahir" },
                    { "data": "action" }
                ],
                "columnDefs": [
                    { width: "5%", targets: 0 },
                    { width: "40%", targets: 1 },
                    { width: "25%", targets: 4 },
                ],
                bAutoWidth: false

                // "responsive": true
            } );
        });
        $('#tab_1_1_3').load('<?=site_url()?>event/countaineragenda/<?=$d[0]->id?>',function(){
            $('#dataagenda').load('<?=site_url()?>event/agendadata/<?=$d[0]->id?>');
        });
    }
    function addagenda(idevent)
    {
        $('#dynamic-content').html(''); // leave this div blank
        $('#modal-loader').show();
        $.ajax({
              url: '<?=site_url()?>event/formagenda/'+idevent,
              dataType: 'html'
         })
         .done(function(data){
             //console.log(data); 
            $('#dynamic-content').html(''); // blank before load.
            $('#dynamic-content').html(data); // load here
            $('#modal-loader').hide(); // hide loader  
            $('#basic').modal();
            //$('#basic').modal();

         })
         .fail(function(){
              $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
              $('#modal-loader').hide();
         });
    }
    function simpanagenda(idevent)
    {
        // alert(idevent);
        $.ajax({
            url : '<?=site_url()?>event/agendaposes/'+idevent,
            data : $('#addagendabaru').serialize(),
            type : 'POST',
            success : function(a)
            {
                $('#basic').modal('hide');
                // alert(data);
                $('#dynamic-content-pesan').html('<h3>'+a+'</h3>');
                $('#pesan').modal();
                $('#dataagenda').load('<?=site_url()?>event/agendadata/'+idevent);
            }
        });
    }
    function hapus(kategori,id,idevent)
    {
        if(kategori=='agenda')
        {
            $('.modal-title-confirm').text('Konfirmasi Hapus');
            $('#dynamic-content-confirm').html('<h3>Yakin Ingin Menghapus Data Agenda Ini ?</h3>'); // leave this div blank
            $('#confirm').modal();

            var url='<?=site_url()?>event/hapusagenda/'+id;
            var form=$('#addagendabaru');
            var urldata='<?=site_url()?>event/agendadata/'+idevent;
            var cdata=$('#dataagenda');
            
            // $('.modal-title-confirm').text('Konfirmasi Hapus');
        }
        else if(kategori=='people_has_event')
        {
            $('.modal-title-confirm').text('Konfirmasi Hapus');
            $('#dynamic-content-confirm').html('<h3>Yakin Ingin Menghapus Data Kepesertaan Ini ?</h3>'); // leave this div blank
            $('#confirm').modal();
            var url='<?=site_url()?>event/hapusdatapeserta/'+id;
            var form=$('#addagendabaru');
            // var urldata='<?=site_url()?>event/agendadata/'+idevent;
            var cdata='';
        }
            
        $('button#confirmbutton').click(function(){
               $.ajax({
               url : url,
               data : form.serialize(),
               type : 'POST',
               success : function(a)
               {
                   $('#confirm').modal('hide');        
                   $('#dynamic-content-pesan').html('<h3>'+a+'</h3>');
                   $('#pesan').modal();
                   if(cdata=='')
                   {
                        ambildata();
                   }
                   else
                   {
                        cdata.load(urldata);
                   }
               }
           });
        });
    }
    function addpeserta(id)
    {
        $('#modaladdpeserta').modal();
        $('#dynamic-content-addpeserta').html(''); // leave this div blank
        $('#modal-loader-addpeserta').show();
        $.ajax({
              url: '<?=site_url()?>event/addpeserta/<?=$member?>/'+id,
              dataType: 'html'
         })
         .done(function(data){
             //console.log(data); 
            $('#idPeserta').focus();
            $('#dynamic-content-addpeserta').html(''); // blank before load.
            $('#dynamic-content-addpeserta').html(data); // load here
            $('#modal-loader-addpeserta').hide(); // hide loader  
            //$('#basic').modal();

         })
         .fail(function(){
              $('#dynamic-content-addpeserta').html('<h3><i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...</h3>');
              $('#modal-loader-addpeserta').hide();
         });
    }
    //-------------------------------------------------
    function simpanpeserta(id)
    {
        //formaddpeserta
        var nama=$('#nama').val();
        var no=$('#no_identitas').val();
        var telp=$('#telp').val();
        var tgl=$('#tanggal_lahir').val();
        var asal=$('#asal').val();
        var seat=$('#noseat').val();
        if(nama=='')
        {
            $('#dynamic-content-pesan').html('<h3>Nama Tidak Boleh Kosong</h3>');
            $('#pesan').modal();
        }
        else if(no=='')
        {
            $('#dynamic-content-pesan').html('<h3>Nomor Identitas Tidak Boleh Kosong</h3>');
            $('#pesan').modal();
        }
        else if(telp=='')
        {
            $('#dynamic-content-pesan').html('<h3>Telepon Tidak Boleh Kosong</h3>');
            $('#pesan').modal();
        }
        else if(tgl=='')
        {
            $('#dynamic-content-pesan').html('<h3>Tanggal Lahir Tidak Boleh Kosong</h3>');
            $('#pesan').modal();
        }
        else if(asal=='')
        {
            $('#dynamic-content-pesan').html('<h3>Asal Tidak Boleh Kosong</h3>');
            $('#pesan').modal();
        }
        else if(seat=='')
        {
            $('#dynamic-content-pesan').html('<h3>Nomor Seat Belum Dipilih</h3>');
            $('#pesan').modal();
        }
        else
        {
            $.ajax({
                    url : '<?=site_url()?>event/addmember/'+id+'/<?=$member?>',
                    type : 'POST',
                    data : $('form#formaddpeserta').serialize(),
                    success : function(s)
                    {
                        // location.href='<?=site_url()?>event/detail/'+event_id;
                        $('#modaladdpeserta').modal('hide');
                        $('#dynamic-content-pesan').html('<h3>Data Peserta Berhasil Disimpan</h3>');
                        $('#pesan').modal();
                        ambildata();
                    }
                });
        }
    }

//-----------------------------------------------
    function grafik(id)
    {

        $('#modalgrafik').modal();
        $('#dynamic-content-grafik').html(''); // leave this div blank
        $('#modal-loader-grafik').show();
       
        $.ajax({
            url : '<?=site_url()?>event/reportgrafik/'+id,
            dataType: 'html'
         })
         .done(function(data){
            $('#dynamic-content-grafik').html(''); // blank before load.
            $('#dynamic-content-grafik').html(data); // load here
            $('#modal-loader-grafik').hide(); // hide loader  
            //$('#basic').modal();

         })
         .fail(function(){
              $('#dynamic-content-grafik').html('<h3><i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...</h3>');
              $('#modal-loader-grafik').hide();
         });
    }
//----------------------------------------------------
    function exportpdf(event_id,jenis_member)
    {
        window.open(
            '<?=site_url()?>event/exportpdf/'+event_id+'/'+jenis_member,
            '_blank' // <- This is what makes it open in a new window.
        );
    }
    function barcodeevent(people_id,event_id)
    {
        $('#printBarcodeEvent').modal();
        $.ajax({
            url : '<?=site_url()?>event/getMemberEvent/'+people_id,
            type : 'POST',
            dataType : 'JSON',
            success:function(a)
            {
                var barcode=html_entity_decode(a.barcode);
                var nama=a.nama;
                var nn=nama.split(' ');
                var status=a.status;

                // if(nn.length>1)
                // {
                //  var nm = nn[0]+' '+nn[1];
                // }
                // else
                    var nm = nama;

                nm=nm.toLowerCase();

                $('#name_user_member').text(nm);
                if(a.jenis_event!='umum')
                {
                    $('#nomorseatmember').show();
                    $('#kajiitikaf').show();
                    // $('#itikafkeprint').show();
                    $('#nomorseatmember').text(a.nomorseat);
                }
                else
                {
                    $('#nomorseatmember').hide();
                    // $('#levelid').hide();
                    $('#kajiitikaf').hide();

                }
                //$('#name_user').text('Muhammad Abdullah Situmorang');
                $('#barcode_user_member').html(barcode);
                $('#status_event_user_member').text(status);
                $('#asal_user_member').text(a.asal.toLowerCase());
                $('#idididid_member').val(a.idh);
                $('#itikafkeprint').text(a.itikafke);
                $('#levelid').text(a.levell);
                $('#namaevent').text(a.namaeventaja);
                // $('#levelid').css({'color':a.warnafont});
                if(a.warna=='')
                {
                    var sty='div#buatbackground{ background-color : #ffffff !important;color : black !important}';
                    $('#styletambahan').html(sty);                  
                    $('#buatbackground').css({'background-color':'#ffffff','color':'black'});
                }
                else if(a.warna=='#ffffff')
                {
                    var sty='div#buatbackground{ background-color : #ffffff !important;color : black !important}';
                    $('#styletambahan').html(sty);
                    $('#buatbackground').css({'background-color':'#ffffff','color':'black'});
                }
                else
                {
                    var sty='div#buatbackground{ background-color : '+a.warna+' !important; color : '+a.warnafont+' !important}';
                    $('#styletambahan').html(sty);
                    $('#buatbackground').css({'background-color':a.warna,'color':a.warnafont});
                }
                
                $("#printmember").click(function(){
                    $('#printBarcodeEvent').modal('hide');
                    var idididid=$('#idididid_member').val();
                    $.ajax({
                        url : '<?=site_url()?>event/printBarcode/'+idididid,
                        success : function(i)
                        {
                            
                        }
                    });
                    cetak(event_id,idididid);
                    setTimeout(function()
                    {
                        location.href='<?=site_url()?>event/detail/<?=$member?>/'+event_id;  
                    }, 500);
                });
            }

        });
    }
    function cetak(idevent,idd)
    {
        window.open(
            '<?=site_url()?>event/cetaknametag/'+idevent+'/'+idd,
            '_blank' // <- This is what makes it open in a new window.
        );
    }
    function formulir(event_id,people_id)
    {
        window.open(
            '<?=site_url()?>event/cetakform/'+event_id+'/'+people_id,
            '_blank' // <- This is what makes it open in a new window.
        );
       
        loaddataevent();
    }

//----------------------------------------------------
</script>
<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Tambah Agenda</h4>
            </div>
            <div class="modal-body">
                <div id="modal-loader" style="display: none; text-align: center;">
                    <img src="<?=$this->config->item('path')?>/assets/global/img/loading-spinner-grey.gif" alt="" class="loading">
                    <span> &nbsp;&nbsp;Loading... </span>
                </div>
                <div id="dynamic-content"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                <button type="button" class="btn green" onclick="simpanagenda(<?=$d[0]->id?>)">Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade bs-modal-lg" id="large" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Detail Agenda</h4>
            </div>
            <div class="modal-body">
            <div class="row">
             <div class="col-md-5">
                 <div class="portlet light bordered">
                     <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-search"></i>Cari Data Peserta
                        </div>
                        
                    </div>
                     <div class="portlet-body form">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="caripeserta"></div>
                            </div>
                            <div class="col-md-12">
                                <div id="pesanOuput" style="width:100%;height:400px"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div id="modal-loader-large" style="display: none; text-align: center;">
                    <img src="<?=$this->config->item('path')?>/assets/global/img/loading-spinner-grey.gif" alt="" class="loading">
                    <span> &nbsp;&nbsp;Loading... </span>
                </div>
                <div id="dynamic-content-large"></div>
            </div>
        </div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal">OK</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>
</div>

<div class="modal fade bs-modal-lg" id="modaladdpeserta" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add Peserta</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="modal-loader-addpeserta" style="display: none; text-align: center;">
                            <img src="<?=$this->config->item('path')?>/assets/global/img/loading-spinner-grey.gif" alt="" class="loading">
                            <span> &nbsp;&nbsp;Loading... </span>
                        </div>
                        <div id="dynamic-content-addpeserta"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                <button type="button" class="btn green" onclick="simpanpeserta(<?=$d[0]->id?>,'<?=$member?>')">Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    <!-- /.modal-dialog -->
    </div>
</div>

<div class="modal fade bs-modal-lg" id="modalgrafik" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Jumlah Peserta</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="modal-loader-grafik" style="display: none; text-align: center;">
                            <img src="<?=$this->config->item('path')?>/assets/global/img/loading-spinner-grey.gif" alt="" class="loading">
                            <span> &nbsp;&nbsp;Loading... </span>
                        </div>
                        <div id="dynamic-content-grafik"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn green btn-outline" data-dismiss="modal">OK</button>
            </div>
        </div>
        <!-- /.modal-content -->
    <!-- /.modal-dialog -->
    </div>
</div>

<div class="modal fade bs-modal-lg" id="printBarcodeEvent" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Print Name Tag</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div style="text-align:center;margin:0 auto;padding:10px;max-height:350px">
                            <div id="printAreaMember" style="width:430px;height:auto;">
                                    <!-- <div style="width:90%;height:30px;background:#bbb;margin:0 auto"></div> -->
                                    <div style="width:420px;margin:0px auto 0 auto;padding-bottom:30px;">
                                        <div style="width:100%;border-bottom:3px solid #bbb;float:left;font-size:20px;padding-bottom:5px;text-align:center;font-weight:bold">
                                            SURAU QUTUBUL AMIN<br>Arco - Depok<br>
                                            <div id="namaevent" style="font-size:15px;"></div>
                                        </div>
                                        <div style="width:100%;border-bottom:3px solid #bbb;float:left">
                                            <div style="float:left;width:76%;text-align:left;padding-top:0px;">
                                                <div id="nomorseatmember" style="height:50px;font-size:80px;font-family:verdana;letter-spacing:10px;margin-top: -20px;margin-bottom: 40px"></div>
                                                <div style="float:right;text-align:left;width:100%;padding-left:3px;padding-bottom:5px;">
                                                    <div style="float:left;text-align:left;font-size:18px;width:100%">Nama</div>
                                                    <div style="padding-top:5px;float:left;text-align:left;text-transform:capitalize;width:320px;font-weight:bold;font-size:1.6vw" id="name_user_member">
                                                        aaaa
                                                    </div>
                                                </div>
                                                <div style="float:right;text-align:left;width:100%;margin-top:10px;padding-left:3px;padding-bottom:5px;">
                                                    <div style="float:left;text-align:left;font-size:18px;width:100%">Asal</div>
                                                    <div style="padding-top:5px;float:left;text-align:left;font-size:30px;text-transform:capitalize;width:100%;font-weight:bold" id="asal_user_member"></div>
                                                </div>
                                            </div>
                                            <div style="float:left;width:24%" id="kajiitikaf">
                                                <div style="float:right;text-align:left;width:100%;border-left:2px solid #ccc;padding-left:3px;margin-top:5px;padding-bottom:5px;" id="buatbackground">
                                                    <div style="float:left;text-align:left;font-size:16px;width:100%">Kaji</div>
                                                    <div style="float:left;text-align:left;font-size:27px;text-transform:capitalize;width:100%;font-weight:bold" id="levelid"></div>
                                                </div>
                                                <div style="float:right;text-align:left;width:100%;border-left:2px solid #ccc;padding-left:3px;margin-top:5px;padding-bottom:5px;">
                                                    <div style="float:left;text-align:left;font-size:16px;width:100%">I'tikaf Ke </div>
                                                    <div style="float:left;text-align:left;font-size:27px;text-transform:capitalize;width:100%;font-weight:bold" id="itikafkeprint"></div>
                                                </div>
                                            </div>
                                            <div style="float:right;text-align:left;width:100%;margin-bottom:5px;margin-top:15px;">
                                                <div style="float:left;text-align:left;font-size:23px;text-transform:capitalize;width:100%;font-weight:bold" id="barcode_user_member"></div>
                                            </div>
                                        </div>

                                    <input type="hidden" name="idididid" id="idididid_member">

                                    <!-- <div style="width:100%;font-size:20px;text-align:center;letter-spacing:-1px;font-size:24px;font-weight:bold;padding:5px 0px 0 0;padding-top:200px;text-transform:capitalize;" id="name_user_member"></div>
                                    <div style="width:100%;font-size:20px;text-decoration:upperline;text-align:center;font-size:24px;font-weight:bold;padding:5px 0px 0 0;text-transform:capitalize;" id="asal_user_member"></div>
                                    <div style="margin:0 auto;width:100%;text-align:center;padding:10px 0px 0 0" id="barcode_user_member">
                                    
                                    </div>
                                     -->
                                    <style type="text/css" id="styletambahan"></style>
                                    <style type="text/css">
                                    div.b128{
                                        border-left: 1px black solid;
                                        height: 20px;
                                    }

                                    </style>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
<!--                 <a href="#" class="btn" data-dismiss="modal">Tidak</a>
                <a href="#" class="btn btn-primary" id="printmember">Print</a> -->
               <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                <button type="button" class="btn green btn-outline" id="printmember" data-dismiss="modal">Print</button>
            </div>
        </div>
        <!-- /.modal-content -->
    <!-- /.modal-dialog -->
    </div>
</div>

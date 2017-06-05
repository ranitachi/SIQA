<div class="row">
     
     <div class="col-md-12">
         <div class="portlet light bordered">
             <div class="portlet-body">
                <form role="form" id="formaddpeserta">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form">
                                <div class="form-group">
                                    <label>ID Peserta</label>
                                    <div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-search"></i>
                                            </span>
                                            <input type="hidden" id="id" name="id">

                                            <input type="text" class="form-control input-medium" id="idPeserta" autocomplete="off" placeholder="Scan atau Ketik Barcode"> 
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Nama Peserta</label>
                                    <div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </span>
                                            <input type="text" class="form-control input-medium" id="nama" name="nama" placeholder="Nama Peserta"> 
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Identitas</label>
                                    <div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-bars"></i>
                                            </span>
                                            <select class="form-control input-medium" name="jenis_identitas" id="jenis_identitas">
                                                <option></option>
                                                <option value="ktp">KTP</option>
                                                <option value="sim">SIM</option>
                                                <option value="pasport">Pasport</option>
                                                <option  value="lain-lain">Lain-lain</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>No Identitas</label>
                                    <div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-bars"></i>
                                            </span>
                                            <input type="text" class="form-control input-medium" id="no_identitas" name="no_identitas" placeholder="No Identitas"> 
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-genderless"></i>
                                            </span>
                                            <select class="form-control input-medium" name="kelamin" id="kelamin">
                                                <option></option>
                                                <option value="p">Pria</option>
                                                <option value="w">Wanita</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Member</label>
                                    <div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-bars"></i>
                                            </span>
                                            <select class="form-control input-medium" name="member" id="member">
                                                <option></option>
                                                <option value="t">Member</option>
                                                <option value="f">Non Member</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <div>
                                        <div class="input-group">
                                             <span class="input-group-addon">
                                                @
                                            </span>
                                            <input type="text" class="form-control input-medium" id="email" name="email" placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Telp</label>
                                    <div>
                                        <div class="input-group">
                                             <span class="input-group-addon">
                                                <i class="fa fa-phone-square"></i>
                                            </span>
                                            <input type="text" class="form-control input-medium" id="telp" name="telp" placeholder="Telepon">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <div>
                                        <div class="input-group">
                                             <span class="input-group-addon">
                                                <i class="fa fa-map-marker"></i>
                                            </span>
                                            <input type="text" class="form-control input-medium" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <div>
                                        <div class="input-group">
                                             <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <input type="text" class="form-control input-medium" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tempat Lahir">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <div>
                                        <div class="input-group">
                                            <!-- <input type="text" class="form-control input-xlarge" id="alamat" name="alamat" placeholder="Alamat"> -->
                                            <textarea class="form-control" rows="3" style="width: 100% !important" name="alamat" id="alamat"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-bars"></i>
                                            </span>
                                            <select class="form-control input-medium" name="status" id="status">
                                            <option></option>
                                            <?
                                            $status=$this->db->from('surau')->where('status_tampil','1')->get()->result();
                                            // echo $d->status;
                                              foreach ($status as $k => $v) 
                                              {
                                                
                                                    echo '<option value="'.(encrypt_decrypt('decrypt',$v->namasurau).' - '.encrypt_decrypt('decrypt',$v->alamat)).'">'.(encrypt_decrypt('decrypt',$v->namasurau).' - '.encrypt_decrypt('decrypt',$v->alamat)).'</option>';
                                              }
                                            ?>
                                        </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Asal</label>
                                    <div>
                                        <div class="input-group">
                                             <span class="input-group-addon">
                                                <i class="fa fa-map-marker"></i>
                                            </span>
                                            <input type="text" class="form-control input-medium" id="asal" name="asal" placeholder="Asal">
                                        </div>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label>Pendidikan</label>
                                    <div>
                                        <div class="input-group">
                                             <span class="input-group-addon">
                                                <i class="fa fa-bars"></i>
                                            </span>
                                            <input type="text" class="form-control input-medium" id="pendidikan" name="pendidikan" placeholder="Pendidikan">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Pekerjaan</label>
                                    <div>
                                        <div class="input-group">
                                             <span class="input-group-addon">
                                                <i class="fa fa-bars"></i>
                                            </span>
                                            <input type="text" class="form-control input-medium" id="pekerjaan" name="pekerjaan" placeholder="Pekerjaan">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-body">
                                  
                                <div class="form-group">
                                    <label style="font-size:10px !important">Kaji</label>
                                        <div class="input-group">
                                             <span class="input-group-addon">
                                                <i class="fa fa-bars"></i>
                                            </span>
                                            <select id="kaji" name="kaji" class="form-control input-small">
                                                <option value=""></option>
                                              <?
                                                $level=$this->db->from('level')->where('status_tampil','t')->get()->result();
                                              foreach ($level as $k => $v) 
                                              {
                                                
                                                    echo '<option value="'.encrypt_decrypt('decrypt',$v->keterangan).'">'.encrypt_decrypt('decrypt',$v->keterangan).'</option>';
                                              }
                                              ?>
                                              </select>
                                        </div>
                                </div>
                                <div class="form-group">
                                    <label style="font-size:10px !important">Itikaf Ke</label>
                                        <div class="input-group">
                                             <span class="input-group-addon">
                                                <i class="fa fa-bars"></i>
                                            </span>
                                            <input type="text" class="form-control input-medium" id="itikafke" name="itikafke" autocomplete="off" value="0">
                                        </div>
                                </div>
                                <div class="form-group">
                                    <label style="font-size:10px !important">Biaya Makan</label>
                                        <div class="input-group">
                                             <span class="input-group-addon">
                                                Rp
                                            </span>
                                            <input type="text" class="form-control input-medium" id="email" name="biaya_makan" placeholder="Biaya Makan">
                                        </div>
                                </div>
                                <div class="form-group">
                                    <label style="font-size:10px !important">Sedekah</label>
                                        <div class="input-group">
                                             <span class="input-group-addon">
                                                Rp
                                            </span>
                                            <input type="text" class="form-control input-medium" id="email" name="sedekah" placeholder="Sedekah">
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label style="font-size:10px !important">Tanggal Ikut</label>
                                        <div class="input-group">
                                             <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <input type="text" class="form-control input-medium" id="tglkut" name="tgl_ikut" placeholder="Tanggal Ikut">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div id="ikuthari"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label style="font-size:10px !important">Nomor Seat</label>
                                        <div class="input-group">
                                             <span class="input-group-addon">
                                                <i class="fa fa-bars"></i>
                                            </span>
                                            <select name="noseat" class="form-control" id="noseat" style="width:100px">
                                                <option value="0">Pilih No Seat</option>
                                              <?
                                              $noseat=$this->db->query('select * from seat where status_tampil="t" order by huruf,angka');
                                              if(count($noseat->result())!=0)
                                              {
                                                foreach ($noseat->result() as $k => $v) 
                                                {
                                                    echo '<option value="'.$v->nomor.'">'.$v->nomor.'</option>';
                                                    $ns[trim($v->huruf)][$v->angka]=$v->nomor;
                                                }
                                              }
                                              ?>
                                              </select>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <div class="input-group">
                                        <div id="seatno"></div>
                                    </div>
                                </div>
                            </div>
                        </div>                    
                    </div>

                </form>
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
                if(strpos($n->tanggal_lahir, '/')!==false)
                {
                    list($tgl,$bll,$thl)=explode('/',encrypt_decrypt('decrypt',$n->tanggal_lahir));
                }
                else
                {
                    if(strpos(encrypt_decrypt('decrypt',$n->tanggal_lahir), '/')!==false)
                        list($tgl,$bll,$thl)=explode('/',encrypt_decrypt('decrypt',$n->tanggal_lahir));
                    else
                        list($thl,$bll,$tgl)=explode('-','0000-00-00');
                }
            }
        }
        else
            list($thl,$bll,$tgl)=explode('-','0000-00-00');
                
        $nama.='"'.trim(trim(encrypt_decrypt('decrypt',$n->no_identitas).'-'.encrypt_decrypt('decrypt',$n->nama)).'|'.$tgl.'/'.$bll.'/'.$thl).'",';
    }
}
$nama=substr($nama,0,-1);
$nama.=']';
// echo $nama;
?>
<script type="text/javascript">
    $('#ikuthari').load('<?=site_url()?>event/ikuthari/<?=$id?>/7');
    // $('#tglkut').datepicker({
    //     format :'yyyy-mm-dd',
    //     autoclose:true,
    //     todayHighlight:'TRUE'
    // });
    $('#tanggal_lahir').datepicker({
        format:'yyyy-mm-dd',
        autoclose:true,
    });
    $('#tglkut').datepicker({
        format:'yyyy-mm-dd',
    }).on('changeDate', function (ev) {
         $(this).datepicker('hide');
         // alert(ev.date.getDate());
         var tgl=ev.date.getFullYear()+'-'+(ev.date.getMonth()+1)+'-'+ev.date.getDate();
         $('#ikuthari').load('<?=site_url()?>event/ikuthari/<?=$id?>/'+tgl);

    });
    $('#idPeserta').typeahead(
    {
        source : <?=$nama?>,
        autoSelect: true,
        updater : function(item)
        {
            var tt=item.split('|');
            var tg=tt[1].replace(/\//g,'-');
            var i=tt[0].split('-');
            $.ajax({
                url : '<?=site_url()?>member/datamember/'+i[0]+'/<?=$id?>/<?=$member?>/'+tg,
                dataType : 'JSON',
                success:function(suc)
                {
                    if(suc.Error==0)
                    {
                        var t=suc.tanggal_lahir;
                        var tgl=t.split('-');
                        
                        if(tgl.length==1)
                        {
                            // var t=suc.tanggal_lahir;
                            var tgll=t.split('/');
                            tgl_=tgll[0];
                            bln_=tgll[1];
                            thn_=tgll[2];
                        }
                        else
                        {
                            var tgl_=tgl[2];
                            var bln_=tgl[1];
                            var thn_=tgl[0];
                        }

                        $('#id').val(suc.p_id);
                        $('#nama').val(suc.nama);
                        $('#pendidikan').val(suc.pendidikan);
                        $('#status').val(suc.p_status);
                        $('#alamat').val(suc.alamat);
                        $('#tanggal_lahir').val(thn_+'-'+bln_+'-'+tgl_);
                        $('#tempat_lahir').val(suc.tempat_lahir);
                        $('#email').val(suc.email);
                        $('#no_identitas').val(suc.no_identitas);
                        $('#jenis_identitas').val(suc.jenis_identitas);
                        $('#telp').val(suc.telp);
                        $('#asal').val(suc.asal);
                        $('#kelamin').val(suc.kelamin);
                        $('#member').val(suc.member);
                        $('#kaji').val(suc.kaji);
                        $('#noseat').val(suc.noseat);
                        $('#seatno').load('<?=site_url()?>siqa/urutanseat/'+suc.noseat+'/<?=$id?>/'+suc.kelamin);
                        $('#itikafke').val(suc.itikafke);
                        $('#pekerjaan').val(suc.pekerjaan);
                    }
                    else
                    {
                        $('#dynamic-content-pesan').html('<h3>Nama Peserta Sudah Pernah Diinput Sebelumnya</h3>');
                        $('#pesan').modal();
                        $('#idPeserta').focus();
                        $('#idPeserta').val('');
                    }
                }
            });
            return i[0].trim();
        }
    });

    function gantiseat(noseat,kelamin)
    {
        $('#noseat').val(noseat);
        $('#seatno').load('<?=site_url()?>siqa/urutanseat/'+noseat+'/<?=$id?>/'+kelamin)
    } 
</script>
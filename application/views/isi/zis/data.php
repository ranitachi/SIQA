<div class="row">

     <div class="col-md-12">
         <div class="portlet light bordered">
             <div class="portlet-title">
                <div class="caption">
                	<i class="fa fa-users"></i>Data
                </div>

			</div>
             <div class="portlet-body">
                 <table class="table table-striped table-bordered table-hover" width="100%" id="zisdata">
                    <thead>
                        <tr>
                            <th class="all">No</th>
                            <th class="min-phone-l">No Kwitansi</th>
                            <th class="min-phone-l">Tanggal</th>
                            <th class="min-tablet">Nama</th>
                            <!-- <th class="none">Jumlah</th> -->
                            <th class="desktop">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
                        $no=1;
                        $total=0;
                        if(count($dd)!=0)
                        {
                          foreach ($dd as $k => $v)
                          {
                            if(isset($people[$v[0]->member_id]))
                              $nama=encrypt_decrypt('decrypt',$people[$v[0]->member_id]->nama);
                            else {
                              $nama='';
                            }
                            $ket='';
                            if($v[0]->keterangan!='')
                            {
                              $kt=explode(',',encrypt_decrypt('decrypt',$v[0]->keterangan));
                            }
                            $jns=$jlh='';
                            $jl=0;
                            $zf=0;
                            foreach ($v as $kv => $vv)
                            {
                              if(isset($j[$vv->jenis_id]))
                              {
                                if($vv->jenis_id==5)
                                  $zf=1;
                                if($j[$vv->jenis_id]->kat==1)
                                    $jj='Zakat ';
                                else {
                                    $jj='';
                                  }
                                $jns.=$jj.encrypt_decrypt('decrypt',$j[$vv->jenis_id]->jenis).'<br>';
                                $jlh.=number_format($vv->jumlah,0,',','.').'<br>';
                              }
                            }


                            echo '<tr>';
                            echo '<td style="text-align:center">'.$no.'</td>';
                            echo '<td style="text-align:center">'.encrypt_decrypt('decrypt',$v[0]->no_transaksi).'</td>';
                            echo '<td style="text-align:center">'.tgl_indo($v[0]->tanggal).'</td>';
                            echo '<td style="text-align:left">'.($nama).'</td>';
                            // echo '<td style="text-align:right">'.$jlh.'</td>';
                            echo '<td style="text-align:right">'.number_format($v[0]->total,0,',','.').'</td>';
                            echo '</tr>';
                            $no++;
                            $total+=$v[0]->total;
                          }
                        }
                        else {
                          echo '<tr><td colspan="7" style="text-align:center;">Data Transaksi Tidak Ditemukan</td></td>';
                        }
                        ?>
                    </tbody>
                    <thead>
                        <tr>
                            <th class="all" colspan="4" style="text-align:right">T O T A L</th>
                            <th class="none" style="text-align:right"><?=number_format($total,0,',','.')?></th>

                        </tr>
                        <tr>
                            <th class="all" colspan="5" style="text-align:right"><i>Terbilang : <?=ucwords(terbilang($total))?> Rupiah</i></th>

                        </tr>
                    </thead>
                </table>
             </div>
         </div>
     </div>
 </div>

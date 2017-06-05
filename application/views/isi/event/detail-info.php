<div class="col-lg-4">
    <div class="well">
        <div class="row">
            <div class="col-lg-5 text-right">Waktu Event :</div>
            <div class="col-lg-7"><b><?=strtok($d[0]->event_time,' ')?></b></div>
        </div>
        <div class="row">
            <div class="col-lg-5 text-right">Lokasi :</div>
            <div class="col-lg-7"><b><?=encrypt_decrypt('decrypt',$d[0]->event_place)?></b></div>
        </div>
    </div>
</div>
<div class="col-lg-4">
    <div class="well">
        <div class="row">
            <div class="col-lg-8 text-right">Jlh Peserta Pria :</div>
            <div class="col-lg-4"><b><?=number_format($jlhpr)?></b></div>
        </div>
        <div class="row">
            <div class="col-lg-8 text-right">Jlh Peserta Perempuan :</div>
            <div class="col-lg-4"><b><?=number_format($jlhwb)?></b></div>
        </div>
                                         
    </div>
</div>
<div class="col-lg-4">
    <div class="well">
        <div class="row">
            <div class="col-lg-7 text-right">Total Peserta :</div>
            <div class="col-lg-5"><b><?=number_format($jlhpr+$jlhwb)?></b></div>
        </div>
        <?
        if(encrypt_decrypt('decrypt',$d[0]->jenis)!='umum')
        {
        ?>
        <div class="row">
            <div class="col-lg-7 text-right">Total Biaya Makan :</div>
            <div class="col-lg-5"><b><?=number_format($biayamakan)?></b></div>
        </div>
        <div class="row">
            <div class="col-lg-7 text-right">Total Sedekah :</div>
            <div class="col-lg-5"><b><?=number_format($jlhsedekah)?></b></div>
        </div>
        <?
        }
        ?>                                 
    </div>
</div>
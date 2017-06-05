<div class="row">
     
     <div class="col-md-12">
         <div class="portlet light bordered">
             <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-users"></i>Agenda Event
                </div>
                 <div class="actions">
                    <a class="btn btn-sm btn-success" href="javascript:addagenda(<?=$id?>);">
                        <i class="fa fa-plus-circle"></i> Add Agenda
                    </a>

                    
                </div>
            </div>
             <div class="portlet-body">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="well">
                            <div class="row">
                                <div class="col-lg-5 text-right">Waktu Event :</div>
                                <div class="col-lg-7"><b><?=strtok($d->event_time,' ')?></b></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 text-right">Lokasi :</div>
                                <div class="col-lg-7"><b><?=encrypt_decrypt('decrypt',$d->event_place)?></b></div>                                    
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7" id="dataagenda">
                    </div>
                </div>
            </div>
         </div>
     </div>
 </div>

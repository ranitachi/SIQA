<div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    <!-- BEGIN THEME PANEL -->
                    
                    <!-- END THEME PANEL -->
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="icon-settings"></i>
                                <a href="#">Pengaturan</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <span>Konfigurasi</span>
                            </li>
                        </ul>
                        
                    </div>
                    <!-- END PAGE HEADER-->
                    <div class="row">
                        <div class="col-lg-12 col-md-3 col-sm-6 col-xs-12">
                             <div class="portlet box green-meadow bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-settings"></i>
                                            <span class="caption-subject bold uppercase">Konfigurasi</span>
                                        </div>
                                       
                                    </div>
                                    <div class="portlet-body">
                                        <div class="row">
     
                                         <div class="col-md-12">
                                             <div class="portlet light bordered">
                                                 <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="icon-settings"></i>Form Data Konfigurasi
                                                    </div>
                                                    
                                                </div>
                                                 <div class="portlet-body form">
                                                    <form class="form-horizontal" action="<?=site_url()?>config/saveconfig" method="post" id="addMemberBaru" enctype="multipart/form-data" role="form">
                                                        
                                                        <fieldset>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div>
                                                                    <?
                                                                    foreach ($d as $k => $v) 
                                                                    {
                                                                    ?>
                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="input01"><?=ucwords(encrypt_decrypt('decrypt',$v->key))?></label>
                                                                        <div class="col-md-9">
                                                                          <!-- <input type="text" class="input-xlarge" id="idnama" name="nama" required maxlength="28"> -->
                                                                          <div class="input-group">
                                                                            <span class="input-group-addon">
                                                                                <i class="icon-settings"></i>
                                                                            </span>
                                                                            <input type="text" class="form-control" name="save[<?=$v->id?>]" placeholder="<?=ucwords(encrypt_decrypt('decrypt',$v->key))?>" value="<?=$v->value?>"> 
                                                                           </div>
                                                                        </div>
                                                                      </div>
                                                                    <?    # code...
                                                                    }
                                                                    ?>
                                                                      
                                                                      
                                                                </div>
                                                                

                                                          
                                                          <div class="form-actions" style="padding-left:300px;">
                                                            <button type="submit" id="saveAddMember" class="btn btn-primary">Simpan</button>
                                                            <button class="btn">Cancel</button>
                                                          </div>
                                                        </fieldset>
                                                        </form>
                                                    </div>
                                             </div>
                                         </div>
                                     </div>

                                    </div>
                            </div>
                        </div>
                    </div>
                 </div>
</div>

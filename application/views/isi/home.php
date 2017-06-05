    
            <!-- BEGIN SIDEBAR -->
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    <!-- BEGIN THEME PANEL -->
                    
                    <!-- END THEME PANEL -->
<!--                     <h1 class="page-title"> Dashboard
                        <small>statistics, charts, recent events and reports</small>
                    </h1>
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="icon-home"></i>
                                <a href="index.html">Home</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <span>Dashboard</span>
                            </li>
                        </ul>
                       
                    </div> -->
                    <!-- END PAGE HEADER-->

                    <div class="row widget-row">
                        <div class="col-md-3">
                            <!-- BEGIN WIDGET THUMB -->
                            <div class="widget-thumb widget-bg-color-white margin-bottom-20 bordered" style="background: #7cb5ec; padding-top: 10px; text-align: center;">
                                <h4 class="widget-thumb-heading" style="color: #fff; font-family: 'Lucida Grande', 'Lucida Sans Unicode', Arial, Helvetica, sans-serif; font-size: 18px; font-weight: normal; margin-bottom: 24px;">Member : <span data-counter="counterup" data-value="<?=$member?>">0</span></h4>
                                <div class="widget-thumb-wrap" style="margin-bottom: 15px; height: 60px;">
                                    <i class="widget-thumb-icon fa fa-male"></i>
                                    <div class="widget-thumb-body" style="text-align: right;">
                                        <span class="widget-thumb-subtitle"></span>
                                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?=$member_male?>">0</span>
                                    </div>
                                </div>
                                <div class="widget-thumb-wrap" style="margin-bottom: 15px; height: 60px;">
                                    <i class="widget-thumb-icon fa fa-female"></i>
                                    <div class="widget-thumb-body" style="text-align: right;">
                                        <span class="widget-thumb-subtitle"></span>
                                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?=$member_female?>">0</span>
                                    </div>
                                </div>
                                <div class="widget-thumb-wrap" style="margin-bottom: 15px; height: 60px;">
                                    <i class="widget-thumb-icon fa fa-child"></i>
                                    <div class="widget-thumb-body" style="text-align: right;">
                                        <span class="widget-thumb-subtitle"></span>
                                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?=$member_child?>">0</span>
                                    </div>
                                </div>
                            </div>
                            <!-- END WIDGET THUMB -->
                        </div>
                        <div class="col-md-3">
                            <!-- BEGIN WIDGET THUMB -->
                            <div class="widget-thumb widget-bg-color-white margin-bottom-20 bordered" style="background: #90ed7d; padding-top: 10px; text-align: center;">
                                <h4 class="widget-thumb-heading" style="color: #fff; font-family: 'Lucida Grande', 'Lucida Sans Unicode', Arial, Helvetica, sans-serif; font-size: 18px; font-weight: normal; margin-bottom: 24px;">Non Member : <span data-counter="counterup" data-value="<?=$nonmember?>">0</span></h4>
                                <div class="widget-thumb-wrap" style="margin-bottom: 15px; height: 60px;">
                                    <i class="widget-thumb-icon fa fa-male"></i>
                                    <div class="widget-thumb-body" style="text-align: right;">
                                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?=$nonmember_male?>">0</span>
                                    </div>
                                </div>
                                <div class="widget-thumb-wrap" style="margin-bottom: 15px; height: 60px;">
                                    <i class="widget-thumb-icon fa fa-female"></i>
                                    <div class="widget-thumb-body" style="text-align: right;">
                                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?=$nonmember_female?>">0</span>
                                    </div>
                                </div>
                                <div class="widget-thumb-wrap" style="margin-bottom: 15px; height: 60px;">
                                    <i class="widget-thumb-icon fa fa-child"></i>
                                    <div class="widget-thumb-body" style="text-align: right;">
                                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?=$nonmember_child?>">0</span>
                                    </div>
                                </div>
                            </div>
                            <!-- END WIDGET THUMB -->
                        </div>

                        <div class="col-md-6">
                            <div id="container-pie" class="margin-bottom-20" style="height:300px;"></div>
                        </div>

                    </div>

<!--                     <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="font-size: 7em; text-align: center;">
                            <div class="col-lg-12" style="background: #1bbc9b; height: 50px;">
                                <div style="font-weight: bold; color: #fff; font-size: 20px; height: 100%; padding: 10px 0px;">Total Members : <?=$member?></div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="color: #364150;">
                                <i class="fa fa-male"></i>
                                <h2 style="font-weight: bold; margin: 0px;"><?=$member_male?></h2>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="color: #364150;">
                                <i class="fa fa-female"></i>
                                <h2 style="font-weight: bold; margin: 0px;"><?=$member_female?></h2>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="color: #364150;">
                                <i class="fa fa-child"></i>
                                <h2 style="font-weight: bold; margin: 0px;"><?=$member_child?></h2>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="font-size: 7em; text-align: center;">
                            <div class="col-lg-12" style="background: #1bbc9b; height: 50px;">
                                <div style="font-weight: bold; color: #fff; font-size: 20px; height: 100%; padding: 10px 0px;">Total Non Members : <?=$nonmember?></div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="color: #7cb5ec;">
                                <i class="fa fa-male"></i>
                                <h2 style="font-weight: bold; margin: 0px;"><?=$nonmember_male?></h2>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="color: #7cb5ec;">
                                <i class="fa fa-female"></i>
                                <h2 style="font-weight: bold; margin: 0px;"><?=$nonmember_female?></h2>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="color: #7cb5ec;">
                                <i class="fa fa-child"></i>
                                <h2 style="font-weight: bold; margin: 0px;"><?=$nonmember_child?></h2>
                            </div>
                        </div>
                        
                    </div> -->

                    <div class="row widget-row">
                        
                        <div class="col-md-6">
                            <div id="container-umum" class="margin-bottom-20" style="height:300px;"></div>
                        </div>

                        <div class="col-md-6">
                            <div id="container-khusus" class="margin-bottom-20" style="height:300px;"></div>
                        </div>

                    </div>


                    <div class="row widget-row">
                        
                        <div class="col-md-6">
                            <div id="container-umum-detail" class="margin-bottom-20" style="height:300px;"></div>
                        </div>

                        <div class="col-md-6">
                            <div id="container-khusus-detail" class="margin-bottom-20" style="height:300px;"></div>
                        </div>

                    </div>

                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->

          
            <!-- END QUICK SIDEBAR -->
        </div>


<div class="page-sidebar-wrapper">
                <!-- END SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                        <li class="nav-item start <?=$active=='home' ? 'active open' : ''?>">
                            <a href="<?=base_url()?>" class="nav-link nav-toggle">
                                <i class="icon-home"></i>
                                <span class="title">Dashboard</span>
                                <span class="<?=$active=='home' ? 'selected' : ''?>"></span>
                            </a>
                            
                        </li>
                        <li class="nav-item <?=$active=='member' ? 'active open' : ''?> ">
                            <a href="javascript:;" class="nav-link nav-toggle ">
                                <i class="icon-users"></i>
                                <span class="title">Member</span>
                                <span class="arrow"></span>
                                <span class="<?=$active=='member' ? 'selected' : ''?>"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="<?=site_url()?>member" class="nav-link ">
                                        <span class="title">Data Member</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="<?=site_url()?>member/index/f" class="nav-link ">
                                        <span class="title">Data Non Member</span>
                                    </a>
                                </li>
                                <!-- <li class="nav-item  ">
                                    <a href="ui_general.html" class="nav-link ">
                                        <span class="title">Import Data</span>
                                    </a>
                                </li> -->
                                
                            </ul>
                        </li>
                        <li class="nav-item <?=$active=='event' ? 'active open' : ''?> ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-calendar"></i>
                                <span class="title">Event</span>
                                <span class="arrow"></span>
                                <span class="<?=$active=='event' ? 'selected' : ''?>"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="<?=site_url()?>event" class="nav-link ">
                                        <span class="title">Event Umum</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="<?=site_url()?>event/index/member" class="nav-link ">
                                        <span class="title">Event Khusus Member</span>
                                        <!-- <span class="badge badge-danger">2</span> -->
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="<?=site_url()?>zis" class="nav-link ">
                                        <span class="title">Menu ZIS</span>
                                        <!-- <span class="badge badge-danger">2</span> -->
                                    </a>
                                </li>
                                
                            </ul>
                        </li>
                        <li class="nav-item  <?=$active=='config' ? 'active open' : ''?> ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-settings"></i>
                                <span class="title">Pengaturan</span>
                                <span class="arrow"></span>
                                <span class="<?=$active=='config' ? 'selected' : ''?>"></span>
                            </a>
                            <ul class="sub-menu">
                            
                                <li class="nav-item  ">
                                    <a href="<?=site_url()?>config/configurasi" class="nav-link ">
                                        <span class="title">Pengaturan Konfigurasi</span>
                                    </a>
                                </li>
                            <?
                            $user=$this->session->userdata('user');
                            if($user[0]->p_id==1 ||$user[0]->p_id==30 || $user[0]->p_id==521)
                            {

                            ?>
                                <li class="nav-item  ">
                                    <a href="<?=site_url()?>config/backup" class="nav-link ">
                                        <span class="title">Backup Database</span>
                                    </a>
                                </li>
                            <?
                            }
                            ?>
                                <li class="nav-item  ">
                                    <a href="<?=site_url()?>config/surau" class="nav-link ">
                                        <span class="title">Data Surau</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="<?=site_url()?>config/seat" class="nav-link ">
                                        <span class="title">Data Seat</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="<?=site_url()?>config/kaji" class="nav-link ">
                                        <span class="title">Data Kaji</span>
                                    </a>
                                </li>
                                
                            </ul>
                        </li>
                        <li class="nav-item <?=$active=='user' ? 'active open' : ''?> ">
                            <a href="<?=site_url()?>user" class="nav-link nav-toggle <?=$active=='user' ? 'active open' : ''?>">
                                <i class="icon-user"></i>
                                <span class="title">User</span>
                                <span class="<?=$active=='user' ? 'selected' : ''?>"></span>
                            </a>
                            
                        </li>
                        
                        
                    </ul>
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
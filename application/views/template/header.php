
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?=$title?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #2 for statistics, charts, recent events and reports" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="<?=$this->config->item('path')?>assets/fonts/font.css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?=$this->config->item('path')?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=$this->config->item('path')?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=$this->config->item('path')?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=$this->config->item('path')?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=$this->config->item('path')?>assets/global/plugins/typeahead/typeahead.css" rel="stylesheet" type="text/css" />
        <link href="<?=$this->config->item('path')?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=$this->config->item('path')?>assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <link href="<?=$this->config->item('path')?>assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=$this->config->item('path')?>assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?=$this->config->item('path')?>assets/global/css/components-rounded.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?=$this->config->item('path')?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?=$this->config->item('path')?>assets/layouts/layout2/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=$this->config->item('path')?>assets/layouts/layout2/css/themes/blue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?=$this->config->item('path')?>assets/layouts/layout2/css/custom.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=$this->config->item('path')?>assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=$this->config->item('path')?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="<?=$this->config->item('path')?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=$this->config->item('path')?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=$this->config->item('path')?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=$this->config->item('path')?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=$this->config->item('path')?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=$this->config->item('path')?>assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
        <link href="<?=$this->config->item('path')?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=$this->config->item('path')?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=$this->config->item('path')?>assets/global/plugins/typeahead/typeahead.css" rel="stylesheet" type="text/css" />
        <link href="<?=$this->config->item('path')?>assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css" rel="stylesheet" type="text/css" />
        <link href="<?=$this->config->item('path')?>assets/global/plugins/jquery-minicolors/jquery.minicolors.css" rel="stylesheet" type="text/css" />
        <link href="<?=$this->config->item('path')?>assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <!-- END THEME LAYOUT STYLES -->
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?=$this->config->item('path')?>assets/global/css/components-md.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?=$this->config->item('path')?>assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
        <!-- END HEAD -->
        <script src="<?=$this->config->item('path')?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?=$this->config->item('path')?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?=$this->config->item('path')?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?=$this->config->item('path')?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?=$this->config->item('path')?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?=$this->config->item('path')?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <script src="<?=$this->config->item('path')?>assets/global/plugins/moment.min.js" type="text/javascript"></script>
        <script src="<?=$this->config->item('path')?>assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
        <script src="<?=$this->config->item('path')?>assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
        <script src="<?=$this->config->item('path')?>assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
        <script src="<?=$this->config->item('path')?>assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
        <script src="<?=$this->config->item('path')?>assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="<?=$this->config->item('path')?>assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="<?=$this->config->item('path')?>assets/pages/scripts/ui-modals.min.js" type="text/javascript"></script>
        <script src="<?=$this->config->item('path')?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?=$this->config->item('path')?>assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
        <script src="<?=$this->config->item('path')?>assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?=$this->config->item('path')?>assets/pages/scripts/table-datatables-responsive.min.js" type="text/javascript"></script>
        <script src="<?=$this->config->item('path')?>assets/pages/scripts/charts-highcharts.min.js" type="text/javascript"></script>

        <script src="<?=$this->config->item('path')?>assets/layouts/layout2/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?=$this->config->item('path')?>assets/layouts/layout2/scripts/demo.min.js" type="text/javascript"></script>
        <script src="<?=$this->config->item('path')?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="<?=$this->config->item('path')?>assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <script src="<?=$this->config->item('path')?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
        <script src="<?=$this->config->item('path')?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="<?=$this->config->item('path')?>assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <script src="<?=$this->config->item('path')?>assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
        <script src="<?=$this->config->item('path')?>assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
        <script src="<?=$this->config->item('path')?>assets/js/jquery.scannerdetection.js" type="text/javascript"></script>
        <script src="<?=$this->config->item('path')?>assets/js/highcharts.js" type="text/javascript"></script>
        <script src="<?=$this->config->item('path')?>assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="<?=$this->config->item('path')?>assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
        <script src="<?=$this->config->item('path')?>assets/global/plugins/bootstrap-typeahead/bootstrap3-typeahead.min.js" type="text/javascript"></script>
        <script src="<?=$this->config->item('path')?>assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js" type="text/javascript"></script>
        <script src="<?=$this->config->item('path')?>assets/global/plugins/jquery-minicolors/jquery.minicolors.min.js" type="text/javascript"></script>
        <script src="<?=$this->config->item('path')?>assets/pages/scripts/components-color-pickers.min.js" type="text/javascript"></script>
        <script src="<?=$this->config->item('path')?>assets/js/js.js" type="text/javascript"></script>
        <script src="<?=$this->config->item('path')?>assets/js/numeral.min.js" type="text/javascript"></script>

<style type="text/css">
    body
    {
        /*background: #1BBC9B;*/
        background: #364150;
        /*font-family: inherit;*/
    }
</style>


    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid">

        <!-- <??> -->
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->

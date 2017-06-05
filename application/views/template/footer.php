
        </div>
           
        <div class="page-footer" style="padding: 0px; background: #1BBC9B; height: 100%;">
            <div class="page-footer-inner" style="width: 100%; margin: 10px 0px;"> 
                <p class="text-center font-white" style="margin: 0px; font-size: 13px;">
                <?=date('Y')?> &copy; 
                <?=$this->config->item('NXZZb2d6L1J6dUtaOXZYK2J5bGp1Zz09')?>
                </p>
                <div class="scroll-to-top">
                    <i class="icon-arrow-up"></i>
                </div>
            </div>
            <!-- END FOOTER -->
            <!-- BEGIN QUICK NAV -->
            
        </div>
            <!-- END THEME LAYOUT SCRIPTS -->
    </body>
    <div class="modal fade" id="confirm" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title-confirm"></h4>
                </div>
                <div class="modal-body">
                    <div id="modal-loader-confirm" style="display: none; text-align: center;">
                        <img src="<?=$this->config->item('path')?>assets/global/img/loading-spinner-grey.gif" alt="" class="loading">
                        <span> &nbsp;&nbsp;Loading... </span>
                    </div>
                    <div id="dynamic-content-confirm"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <button type="button" class="btn green" id="confirmbutton">OK</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade" id="pesan" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title-pesan">Pesan</h4>
                </div>
                <div class="modal-body">
                    <div id="modal-loader-pesan" style="display: none; text-align: center;">
                        <img src="<?=$this->config->item('path')?>assets/global/img/loading-spinner-grey.gif" alt="" class="loading">
                        <span> &nbsp;&nbsp;Loading... </span>
                    </div>
                    <div id="dynamic-content-pesan"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">OK</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

</html>
<script type="text/javascript">

    var pesan='<?=$this->session->flashdata('pesan')?>';
    // alert(pesan)
    if(pesan!='')
    {
        $('#dynamic-content-pesan').html('<h3>'+pesan+'</h3>'); // load here
        $('#modal-loader-pesan').hide();
        $('#pesan').modal();
    }

    $(function () {

        $.getJSON('<?=site_url()?>siqa/json', function (json) {

            // Build the chart
            $('#container-pie').highcharts({
                chart: {
                    type: 'pie',
                    options3d: {
                        enabled: true,
                        alpha: 45,
                        beta: 0
                    }
                },
                title: {
                    text: 'Peserta Berdasarkan Daerah Asal',
                },
                tooltip: {
                    headerFormat: '',
                    pointFormat: '{point.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        depth: 35,
                        dataLabels: {
                            enabled: true,
                            format: '{point.name}: <b>{point.percentage:.1f}%</b>'
                        }
                    }
                },
                series: json[0]
            });

            $('#container-umum').highcharts({
                chart: {
                    type: 'area'
                },
                title: {
                    text: 'Jumlah Peserta Event Umum',
                },
                xAxis: json[1],
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Peserta'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y}</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    },
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.y}</b>'
                        }
                    }
                },
                series: json[2]
            });

            $('#container-khusus').highcharts({
                chart: {
                    type: 'area'
                },
                title: {
                    text: 'Jumlah Peserta Event Khusus Member',
                },
                xAxis: json[1],
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Peserta'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y}</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    },
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.y}</b>'
                        }
                    }
                },
                series: json[3]
            });

            $('#container-umum-detail').highcharts({
                title: {
                    text: 'Detail Peserta Event Umum'
                },
                xAxis: json[4],
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Peserta'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y}</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    },
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.y}</b>'
                        }
                    }
                },
                series: json[5]
            });

            $('#container-khusus-detail').highcharts({
                title: {
                    text: 'Detail Peserta Event Khusus Member',
                },
                xAxis: json[6],
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Peserta'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y}</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    },
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.y}</b>'
                        }
                    }
                },
                series: json[7]
            });

        });
    });
</script>
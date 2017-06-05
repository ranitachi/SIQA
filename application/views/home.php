			<div class="breadcrumbs" id="breadcrumbs">
					<script type="text/javascript">
						try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
					</script>

					<ul class="breadcrumb">
						<li>
							<i class="icon-home home-icon"></i>
							<a href="#">Home</a>

							
						</li>
					</ul><!--.breadcrumb-->

				</div>

				<div class="page-content">
					
					<div class="row-fluid">
						<div class="span12">
							<div class="row-fluid" style="">
							
								<div class="well">
										<h1 class="green smaller lighter" >Welcome to <?=$this->config->item('nama')?></h1>
										<?=$this->config->item('kepanjangan')?>
									</div>	
								
								<div class="hr hr12 dotted"></div>
							</div>
							<!--PAGE CONTENT BEGINS-->
							<div class="space-6">
							</div>
								<div id="containerww" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
							
							

							

							<!--PAGE CONTENT ENDS-->
						</div><!--/.span-->
					</div><!--/.row-fluid-->

				</div><!--/.page-content-->
<style type="text/css">
.infobox:hover
{
	background:#eee;
}
</style>
<?
$p_member=$this->db->query('select count(*) as jlh from v_users where kelamin="w" and member="t" and level is null and status_tampil=1');
$p_non_member=$this->db->query('select count(*) as jlh from v_users where kelamin="w" and (member="f" || member="") and level is null  and status_tampil=1');
$l_member=$this->db->query('select count(*) as jlh from v_users where (kelamin="p" || kelamin="") and member="t" and level is null and status_tampil=1');
$l_non_member=$this->db->query('select count(*) as jlh from v_users where (kelamin="p" || kelamin="") and (member="f" || member="") and level is null  and status_tampil=1');
?>
<script src="<?=base_url()?>media/js/highcharts.js"></script>
<script src="<?=base_url()?>media/js/data.js"></script>
<script src="<?=base_url()?>media/js/drilldown.js"></script>
<script type="text/javascript">
$(document).ready(function(){


	$('#containerww').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Jumlah Member'
        },
        xAxis: {
            categories: [
                'Member',
                'Non member',
                'Total'
            ]
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Orang'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y} Orang</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Pria',
            data: [<?=$l_member->row('jlh')?>, <?=$l_non_member->row('jlh')?>,<?=($l_member->row('jlh')+$l_non_member->row('jlh'))?>],
            dataLabels: {
                enabled: true,
                color: '#000000',
                align: 'center',
                x: 4,
                y: 20,
                style: {
                    fontSize: '11px',
                    fontFamily: 'Verdana, sans-serif',
                    textShadow: '0 0 3px white'
                }
            }

        }, {
            name: 'Wanita',
            data: [<?=$p_member->row('jlh')?>, <?=$p_non_member->row('jlh')?>,<?=($p_member->row('jlh')+$p_non_member->row('jlh'))?>],
            dataLabels: {
                enabled: true,
                color: '#000000',
                align: 'center',
                x: 4,
                y: 20,
                style: {
                    fontSize: '11px',
                    fontFamily: 'Verdana, sans-serif',
                    textShadow: '0 0 3px white'
                }
            }

        }, 
        {
            name: 'Jumlah',
            data: [<?=($p_member->row('jlh')+$l_member->row('jlh'))?>, <?=($p_non_member->row('jlh')+$l_non_member->row('jlh'))?>,<?=($p_member->row('jlh')+$p_non_member->row('jlh')+$l_member->row('jlh')+$l_non_member->row('jlh'))?>],
            dataLabels: {
                enabled: true,
                color: '#000000',
                align: 'center',
                x: 4,
                y: 20,
                style: {
                    fontSize: '11px',
                    fontFamily: 'Verdana, sans-serif',
                    textShadow: '0 0 3px white'
                }
            }

        }]

    });
});
</script>
<pre id="tsv" style="display:none"></pre>
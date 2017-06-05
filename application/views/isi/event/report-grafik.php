<div id="containerww" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<?
/*select * from people_has_event as phe
inner join people as p on (p.id=phe.people_id)
where event_id=12;*/
$w_member=$this->db->query('select count(*) as jlh from people_has_event as phe
    inner join people as p on (p.id=phe.people_id)
    where phe.event_id="'.$event_id.'" and p.kelamin="w" and p.member="t" ');
$w_non_member=$this->db->query('select count(*) as jlh from people_has_event as phe
    inner join people as p on (p.id=phe.people_id)
    where phe.event_id="'.$event_id.'" and p.kelamin="w" and (p.member="f" || p.member="") ');
$p_member=$this->db->query('select count(*) as jlh from people_has_event as phe
    inner join people as p on (p.id=phe.people_id)
    where phe.event_id="'.$event_id.'" and p.kelamin="p" and p.member="t" ');
$p_non_member=$this->db->query('select count(*) as jlh from people_has_event as phe
    inner join people as p on (p.id=phe.people_id)
    where phe.event_id="'.$event_id.'" and p.kelamin="p" and (p.member="f" || p.member="") ');

$sql=$this->db->query("select count(*) as jlh,p.kaji,p.kelamin from people_has_event as phe
    inner join people as p on (p.id=phe.people_id)
    where phe.event_id='".$event_id."' and p.member='t' group by p.kelamin,p.kaji");
$drill=array();
$kpria=$kwanita=$ktotal=$catp=$catw='';
$datalbl="dataLabels: {
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
            }";
foreach ($sql->result() as $ks => $vs) 
{
    if($vs->kaji!=null)
    {   
        if($vs->kelamin=='p')
        {
            $catp.=$vs->kaji.',';
            $kpria.='{name :"'.$vs->kaji.'",y:'.$vs->jlh.",".$datalbl."},";
        }  
        else
        {
            $catw.=$vs->kaji.',';
            $kwanita.='{name:"'.$vs->kaji.'",y:'.$vs->jlh.",".$datalbl."},";
        }
        // $drill[$vs->kelamin][$vs->kaji][]=$vs;
    }
}
// echo $kwanita;
// echo '<pre>';
// print_r($drill);
// echo '</pre>';
// $sqlkaji=$this->db->query('select * from level order by keterangan');
// foreach ($sqlkaji->result() as $kj => $vj) 
// {
//     # code...
// }
?>
<script type="text/javascript">
    $('#containerww').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Jumlah Peserta'
        },
        xAxis: {
            type : 'category'
            // categories : ['Member','Non Member','Total']
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
            data: [{
                    name : 'Member',
                    y : <?=$p_member->row('jlh')?>,
                    drilldown : 'PriaMember'
                },
                {
                    name : 'Non Member',
                    y : <?=$p_non_member->row('jlh')?>,
                    drilldown : ''
                }
                ,{
                    name : 'Total',
                    y : <?=($p_member->row('jlh')+$p_non_member->row('jlh'))?>,
                    drilldown : ''    
                }]
            ,
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
            name: 'Wanita',
            data: [{
                    name : 'WanitaMember',
                    y : <?=$w_member->row('jlh')?>,
                    drilldown : 'WanitaMember'
                },
                {
                    name : 'WanitaNonMember',
                    y : <?=$w_non_member->row('jlh')?>,
                    drilldown : ''
                }
                ,{
                    name : 'TotalWanita',
                    y : <?=($w_member->row('jlh')+$w_non_member->row('jlh'))?>,
                    drilldown : ''    
                }]
            ,
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
        data:  [{
                    name : 'Member',
                    y : <?=($p_member->row('jlh')+$w_member->row('jlh'))?>,
                    drilldown : ''
                },
                {
                    name : 'Non Member',
                    y : <?=($p_non_member->row('jlh')+$w_non_member->row('jlh'))?>,
                    drilldown : ''
                }
                ,{
                    name : 'Total',
                    y : <?=($p_member->row('jlh')+$p_non_member->row('jlh')+($w_member->row('jlh')+$w_non_member->row('jlh')))?>,
                    drilldown : ''    
                }]
            , 
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

        }],
        drilldown: {
            series: [{
                name: 'Member Pria',
                id: 'PriaMember',
                data: [
                    <?=$kpria?>
                ]
            }, {
                name: 'Member Wanita',
                id: 'WanitaMember',
                data: [
                    <?=$kwanita?>
                ]
            }]
        }

    });
</script>
<div class="container-flex">

        <div class="col-md-12">

            <div class="row">

                <div class="col-md-4">
                    <div class="small-box bg-blue">
                        <div class="inner">
                            <h3><?php echo $jumlah_pengunjung;?></h3>
                            <p>Online/Hari ini/Total Kunjungan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="small-box bg-olive">
                        <div class="inner">
                            <h3 id="jumlah_siswa_mendaftar"><?php echo $jumlah_subscriber;?></h3>
                            <p>Subscriber</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3 id="jumlah_siswa_mendaftar_tambahan"><?php echo $jumlah_postingan;?></h3>
                            <p>Postingan Hari ini/Kemarin</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                    </div>
                </div>

            </div>
        </div>



        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">

                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home">Kemajuan</a></li>
                    </ul>

                    <div class="tab-content">

                        <div id="home" class="tab-pane fade in active">
                            <div class="chartWrapper">
                                <div class="chartAreaWrapper">
                                    <canvas id="pengunjungday" width="1200" height="400"></canvas>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>


</div>
<style type="text/css">
    canvas{
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }
    .chartWrapper {
        position: relative;
    }

    .chartWrapper > canvas {
        position: absolute;
        left: 0;
        top: 0;
        pointer-events:none;
    }

    .chartAreaWrapper {
        overflow-x: hidden;
    }
    .contente{
        margin-left:0px;
    }
    .list-group-item {
        background-color: transparent;
        border:0px;
        border-bottom: 1px solid #ddd;
    }
</style>
<script src="<?php echo base_url('assets/admin/js/Chart.min.js') ?>"></script>

<script type="text/javascript">

    <?php
    $borderColor = [
        'rgba(252,94,8, 1)',
        'rgba(204, 204, 204, 1)',
        'rgba(253,46,36, 1)',
        'rgba(73,177,22, 1)',
        'rgb(236,151,31,1)',
        'rgb(60,190,228,1)',
        'rgb(50,180,218,1)',
        'rgb(40,170,198,1)',
        'rgb(30,160,188,1)',
        'rgb(20,150,178,1)',
        'rgb(10,140,168,1)',
        'rgb(60,130,218,1)',
        'rgb(50,120,208,1)',
        'rgb(40,110,168,1)',
        'rgb(30,100,158,1)',
        'rgb(20,90,138,1)',
        'rgb(10,80,118,1)'
    ];
    $backgroundColor = [
        'rgba(252,94,8, 0.2)',
        'rgba(204, 204, 204, 0.2)',
        'rgba(253,46,36, 0.2)',
        'rgba(73,177,22, 0.2)',
        'rgb(236,151,31,0.2)',
        'rgb(60,190,228,0.2)',
        'rgb(50,180,218,0.2)',
        'rgb(40,170,198,0.2)',
        'rgb(30,160,188,0.2)',
        'rgb(20,150,178,0.2)',
        'rgb(10,140,168,0.2)',
        'rgb(60,130,218,0.2)',
        'rgb(50,120,208,0.2)',
        'rgb(40,110,168,0.2)',
        'rgb(30,100,158,0.2)',
        'rgb(20,90,138,0.2)',
        'rgb(10,80,118,0.2)'
    ];
    ?>


    window.pengunjungDayChart = new Chart(document.getElementById("pengunjungday").getContext('2d'), {
        type: 'line',
        data: {
            labels: [],
            datasets: [
                {
                    data: [],
                    label: 'KUNJUNGAN',
                    borderColor: 'rgb(0,0,0)',
                    fill: false,
                },
            ]
        },
        options: {
            responsive: true,
            title: {
                display: false,
                text: 'Kemajuan'
            },
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Tanggal kunjungan'
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Jumlah yang mengunjungi'
                    }
                }]
            }
        }
    });


    $('#loading_ajax').show();

    window.myVar = null;
    window.myVar2 = null;


    _statistik();
    _statistikday();

    setTimeout(function () {

        //window.myVar = setInterval(_statistik, 5000);
        //window.myVar2 = setInterval(_statistikday, 5000);

    },1000);

    function _statistik() {
        $('#loading_ajax').fadeOut("slow");


        $.ajax({
            type:'POST',
            url:'<?php echo base_url('statistik/index') ;?>',
            dataType: 'json',
            success: function(data){



            }
        });

    }

    function _statistikday() {

        $.ajax({
            type:'POST',
            url:'<?php echo base_url('statistik/byday') ;?>',
            dataType: 'json',
            success: function(data){

                window.pengunjungDayChart.data.labels = data.total.labels;
                window.pengunjungDayChart.data.datasets[0].data = data.total.jumlah;
                window.pengunjungDayChart.update();


            }
        });

    }


</script>
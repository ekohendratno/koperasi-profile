<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>CETAK KARTU</title>

    <script>var base_url = '/';</script>

    <link href="<?php echo base_url('css/cetak2.min.css') ?>" rel="stylesheet">

    <script src="<?php echo base_url('js/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('js/jquery-migrate-1.4.1.min.js') ?>"></script>
    <script src="<?php echo base_url('js/qrcode.min.js') ?>"></script>

</head>
<body>
<style>
    .page {
        padding: 1cm;
    }

    td {
        color: #4c4c4c;
        padding-left: 10px;
        padding-right: 10px;
    }

    td strong {
        color:#000;
    }
</style>
<?php
$posisi = 0;
$nomor = 0;
$halaman = 0;
$ruangan = 1;
$kex = 1;
foreach($siswa as $item){


    if($halaman == 0){
        echo '
		<div class="page">
		<center>
			<table align="center" width="100%">
				<tbody>';
    }

    if($posisi == 0){
        echo '<tr>';
    }

    $tahun = date('Y');

    $judul_kartu = "KARTU PERSERTA UJIAN PPDB";

    if(!empty($kustom)) $judul_kartu.= '<br>'.$kustom;

    $judul_kartu.= '<br>SMK NEGERI 1 CANDIPURO';
    $judul_kartu.= '<br>TAHUN AJARAN '.$tahun.'/'.($tahun+1);

    $catatan = 'Kartu ini untuk ditempel pada meja peserta!';

    echo '<td style="padding:10px;" valign="top">';

    echo '
    <table style="width:10.4cm;border:1px solid #112a47;  class="kartu">
        <tbody>
        <tr>
            <td colspan="2" style="border-bottom:1px solid #112a47;">
                <table width="100%" class="kartu">
                    <tbody><tr>
                        <td style="padding: 4px;border-right:1px solid #112a47;"><img src="' .base_url().'img/logoppdb.png" height="40"></td>
                        <td align="center" style="font-weight:bold; padding: 4px;">
                            '.$judul_kartu.'
                        </td>
                        <td style="padding: 4px;border-left:1px solid #112a47; text-align: right">
                            <div style="text-align: center">PESERTA</div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>

        <tr>
            <td>No. Ruangan dan No. Pendaftaran :<br/><strong>'.$ruangan.' / '.$item['siswa_nomor'].'</strong></td>
            <td rowspan="6" valign="top">
            
            
                <table style="width100%;height: 100%;">
                    <tbody>
                    <tr>
                        <td style="text-align: center;"></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;"></td>
                    </tr>
                    </tbody>
                </table>
            
                
            </td>
        </tr>
        <tr>
            <td>Nama Peserta :<br/><strong>'.$item['siswa_nama'].'</strong></td>           
        </tr>
        <tr>
            <td>Pilihan Program Keahlian :<br/><strong>1. '.$item['jurusan1'].'</strong><br/><strong>2. '.$item['jurusan2'].'</strong></td>
        </tr>
        <tr>
            <td>Sekolah Asal :<br/><strong>'.$item['sekolah_asal'].'</strong></td>
        </tr>
        <tr>
            <td>Status Kelengkapan Berkas :<br/><strong>'.$item['kumpul'].' di cek panitia</strong></td>
        </tr>
        <tr>
            <td>Catatan :<br/><i>'.$catatan.'</i></td>
        </tr>

        </tbody>
    </table>
    ';





    $kex++;

    if($kex == 23){
        $kex = 1;
        $ruangan++;
    }

    echo '</td>';

    if($posisi == 1){
        echo '</tr>';
    }

    $posisi++;
    $nomor++;
    $halaman++;

    if($posisi == 2) $posisi = 0;

    if($halaman == 8){
        echo '
				</tbody>
			</table>
		</center>
		</div>';

        if($halaman == 8) $halaman = 0;

    }
}
?>

<script>
    $('.qrcode').each(function(){
        new QRCode(document.getElementById($(this).attr('id')), {
            text: $(this).attr('data-value'),
            width: 60,
            height: 60,
            colorDark : "#000000",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
        });
    });

    window.print();
</script>

</body></html>
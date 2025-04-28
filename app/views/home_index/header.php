 <?php 
error_reporting(0);
session_start();
if(!isset($_SESSION['username'])){
  echo "
  <script>
  alert('Anda Belom Login');
  document.location.href='".BASEURL."/login'
  </script>
  ";
}?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= $data['judul'];?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



    <!-- favicon
    ============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="<?= BASEURL; ?>/assets/img/baz.png">
    <!-- Google Fonts
    ============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i,800" rel="stylesheet">
    <!-- Bootstrap CSS
    ============================================ -->
    <link rel="stylesheet" href="<?=BASEURL;?>/assets/css/bootstrap.min.css">
    <!-- Bootstrap CSS
    ============================================ -->
    <link rel="stylesheet" href="<?=BASEURL;?>/assets/css/font-awesome.min.css">
    <!-- adminpro icon CSS
    ============================================ -->
    <link rel="stylesheet" href="<?=BASEURL;?>/assets/css/adminpro-custon-icon.css">
    <!-- meanmenu icon CSS
    ============================================ -->
    <link rel="stylesheet" href="<?=BASEURL;?>/assets/css/meanmenu.min.css">
    <!-- mCustomScrollbar CSS
    ============================================ -->
    <link rel="stylesheet" href="<?=BASEURL;?>/assets/css/jquery.mCustomScrollbar.min.css">
    <!-- animate CSS
    ============================================ -->
    <link rel="stylesheet" href="<?=BASEURL;?>/assets/css/animate.css">
    <!-- normalize CSS
    ============================================ -->
    <link rel="stylesheet" href="<?=BASEURL;?>/assets/css/data-table/bootstrap-table.css">
    <link rel="stylesheet" href="<?=BASEURL;?>/assets/css/data-table/bootstrap-editable.css">
    <!-- normalize CSS
    ============================================ -->
    <link rel="stylesheet" href="<?=BASEURL;?>/assets/css/normalize.css">
    <!-- charts CSS
    ============================================ -->
    <link rel="stylesheet" href="<?=BASEURL;?>/assets/css/c3.min.css">
    <!-- style CSS
    ============================================ -->
    <link rel="stylesheet" href="<?=BASEURL;?>/assets/style.css">
    <!-- responsive CSS
    ============================================ -->
    <link rel="stylesheet" href="<?=BASEURL;?>/assets/css/responsive.css">
    <!-- modernizr JS
    ============================================ -->
    <script src="<?=BASEURL;?>/assets/js/vendor/modernizr-2.8.3.min.js"></script> </head>

<body class="materialdesign">
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- Header top area start-->
    <?php 
    if($_SESSION['level']=='1'){
      $level = 'Superadmin';
    }
    elseif($_SESSION['level']=='2'){
      $level = 'Amil';
    }
    ?>
    <div class="wrapper-pro">
        <div class="left-sidebar-pro">
            <nav id="sidebar">
                <div class="sidebar-header">
                    <a href="#"><img src="<?=BASEURL;?>/assets/img/message/1.jpg" alt="" />
                    </a>
                    <h3><?= $_SESSION['username'];?></h3>
                    <p><?= $level;?></p>
                    <strong>BAZ</strong>
                </div>
                <div class="left-custom-menu-adp-wrap">
                    <ul class="nav navbar-nav left-sidebar-menu-pro">
                        <li class="nav-item">
                            <a href="<?=BASEURL;?>/home_index"><i class="fa big-icon fa-home"></i> <span class="mini-dn">Home</span> <span class="indicator-right-menu mini-dn"></span></a>
                        </li>

                        <?php if($_SESSION['level']=='2'){ ?>
                        <li class="nav-item">
                            <a href="<?=BASEURL;?>/Pembayaran/pembayaran"><i class="fa big-icon fa-clipboard"></i> <span class="mini-dn">Pembayaran Zakat</span> <span class="indicator-right-menu mini-dn"></span></a>
                        </li>


                        <li class="nav-item">
                            <a href="<?=BASEURL;?>/Pembayar"><i class="fa big-icon fa-user"></i> <span class="mini-dn">Muzakki</span> <span class="indicator-right-menu mini-dn"></span></a>
                        </li>

                        <li class="nav-item">
                            <a href="<?=BASEURL;?>/Penerimaan"><i class="fa big-icon fa-clipboard"></i> <span class="mini-dn">Penyaluran Zakat</span> <span class="indicator-right-menu mini-dn"></span></a>
                        </li>


                        <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa big-icon fa-users"></i> <span class="mini-dn">Mustahik</span> <span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-left"></i></span></a>
                            <div role="menu" class="dropdown-menu left-menu-dropdown animated flipInX">
                                <a href="<?=BASEURL;?>/Penerima" class="dropdown-item">Aktif</a>
                                <a href="<?=BASEURL;?>/Penerima/nonaktif" class="dropdown-item">Tidak Aktif</a>
                            </div>
                        </li>

                        <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa big-icon fa-print"></i> <span class="mini-dn">Laporan</span> <span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-left"></i></span></a>
                            <div role="menu" class="dropdown-menu left-menu-dropdown animated flipInX">
                                <a href="<?=BASEURL;?>/Report/Pembayar" class="dropdown-item" target="blank">Data Pembayar</a>
                                <a href="<?=BASEURL;?>/Report/Penerima" class="dropdown-item" target="blank">Data Penerima</a>
                                <a href="<?=BASEURL;?>/Report/Zakat" class="dropdown-item" target="blank">Data Keuangan Zakat</a>
                                <a href="<?=BASEURL;?>/Report/Infak" class="dropdown-item" target="blank">Data Keuangan Infak</a>
								
								<a href="<?=BASEURL;?>/Donatur/exportLaporanDonaturPdf" class="dropdown-item" target="blank">rport pdf data Donatur</a>
								
								<a href="<?=BASEURL;?>/Qurban/laporanKelompok" class="dropdown-item" target="blank">Data Jumlah Hewan Kurban Per Kelompok</a>
                                <a href="<?=BASEURL;?>/Qurban/grafikDistribusi" class="dropdown-item" target="blank">Grafik Distribusi</a>
                                <a href="<?=BASEURL;?>/Donatur/laporan" class="dropdown-item" target="blank">Laporan Donatur</a>
                                <a href="<?=BASEURL;?>/Donatur/laporanPerTahun" class="dropdown-item" target="blank">Laporan Donatur Per Tahun</a>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a href="<?=BASEURL;?>/Donasi"><i class="fa big-icon fa-clipboard"></i> <span class="mini-dn">Donasi</span> <span class="indicator-right-menu mini-dn"></span></a>
                        </li>

                        <li class="nav-item">
                            <a href="<?=BASEURL;?>/Infak"><i class="fa big-icon fa-clipboard"></i> <span class="mini-dn">Infak</span> <span class="indicator-right-menu mini-dn"></span></a>
                        </li>

                        <li class="nav-item">
                            <a href="<?=BASEURL;?>/Zakat"><i class="fa big-icon fa-clipboard"></i> <span class="mini-dn">Zakat</span> <span class="indicator-right-menu mini-dn"></span></a>
                        </li>
						
						<li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa big-icon fa-print"></i> <span class="mini-dn">Qurban</span> <span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-left"></i></span></a>
                            <div role="menu" class="dropdown-menu left-menu-dropdown animated flipInX">
							 
                                <a href="<?=BASEURL;?>/Donatur" class="dropdown-item" target="blank">Peserta Qurban</a>
                                <a href="<?=BASEURL;?>/KelompokQurban" class="dropdown-item" target="blank">Kelompok Qurban</a>
                                <a href="<?=BASEURL;?>/Qurban/listall" class="dropdown-item" target="blank">Qurban</a>
                                
                            </div>
                        </li>
						
					

                        <li class="nav-item">
                            <a href="<?=BASEURL;?>/Mesjid"><i class="fa big-icon fa-building"></i> <span class="mini-dn">Mesjid</span> <span class="indicator-right-menu mini-dn"></span></a>
                        </li>


                        <li class="nav-item">
                            <a href="<?=BASEURL;?>/Web/lihat_contact"><i class="fa big-icon fa-user"></i> <span class="mini-dn">Kritik & Saran</span> <span class="indicator-right-menu mini-dn"></span></a>
                        </li>

                        <?php } else { ?>
                        <li class="nav-item">
                            <a href="<?=BASEURL;?>/Amil"><i class="fa big-icon fa-user"></i> <span class="mini-dn">Amil</span> <span class="indicator-right-menu mini-dn"></span></a>
                        </li>

                        <?php } ?>

                        
                    </ul>
                </div>
            </nav>
        </div>
        <!-- Header top area start-->
        <div class="content-inner-all">
            <div class="header-top-area">
                <div class="fixed-header-top">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-1 col-md-6 col-sm-6 col-xs-12">
                                <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
                                    <i class="fa fa-bars"></i>
                                </button>
                                <div class="admin-logo logo-wrap-pro">
                                    <a href="#"><img src="<?=BASEURL;?>/assets/img/logo/log.png" alt="" />
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-1 col-sm-1 col-xs-12">
                                <div class="header-top-menu tabl-d-n">
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                                <div class="header-right-info">
                                    <ul class="nav navbar-nav mai-top-nav header-right-menu">
                                        
                                        <li class="nav-item">
                                            <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                                <span class="adminpro-icon adminpro-user-rounded header-riht-inf"></span>
                                                <span class="admin-name">&nbsp;&nbsp;&nbsp;<?= $_SESSION['username'];?>&nbsp;&nbsp;&nbsp;</span>
                                                <span class="author-project-icon adminpro-icon adminpro-down-arrow"></span>
                                            </a>
                                            <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated flipInX">
                                                <li><a href="#"><span class="adminpro-icon adminpro-settings author-log-ic"></span>Settings</a>
                                                </li>
                                                <li><a href="<?=BASEURL;?>/logout"><span class="adminpro-icon adminpro-locked author-log-ic"></span>Log Out</a>
                                                </li>
                                            </ul>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Header top area end-->
            
           <!-- Mobile Menu start -->
<div class="mobile-menu-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="mobile-menu">
                    <nav id="dropdown">
                        <ul class="mobile-menu-nav">
                            <li><a href="<?=BASEURL;?>/home_index"><i class="fa big-icon fa-home"></i> Home</a></li>

                            <?php if($_SESSION['level']=='2'){ ?>
                                <li><a href="<?=BASEURL;?>/Pembayaran/pembayaran"><i class="fa big-icon fa-clipboard"></i> Pembayaran Zakat</a></li>
                                <li><a href="<?=BASEURL;?>/Pembayar"><i class="fa big-icon fa-user"></i> Muzakki</a></li>
                                <li><a href="<?=BASEURL;?>/Penerimaan"><i class="fa big-icon fa-clipboard"></i> Penyaluran Zakat</a></li>
                                <li><a href="<?=BASEURL;?>/Donasi"><i class="fa big-icon fa-user"></i> Donasi</a></li>
                                <li><a href="<?=BASEURL;?>/Infak"><i class="fa big-icon fa-user"></i> Infak</a></li>
                                <li><a href="<?=BASEURL;?>/Zakat"><i class="fa big-icon fa-user"></i> Zakat</a></li>
                                <li><a href="<?=BASEURL;?>/Mesjid"><i class="fa big-icon fa-user"></i> Mesjid</a></li>
                                <li>
                                    <a data-toggle="collapse" data-target="#mustahikMobile" href="#">
                                        <i class="fa big-icon fa-users"></i> Mustahik 
                                        <span class="adminpro-icon adminpro-down-arrow"></span>
                                    </a>
                                    <ul id="mustahikMobile" class="collapse dropdown-header-top">
                                        <li><a href="<?=BASEURL;?>/Penerima">Aktif</a></li>
                                        <li><a href="<?=BASEURL;?>/Penerima/nonaktif">Tidak Aktif</a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a data-toggle="collapse" data-target="#laporanMobile" href="#">
                                        <i class="fa big-icon fa-print"></i> Laporan 
                                        <span class="adminpro-icon adminpro-down-arrow"></span>
                                    </a>
                                    <ul id="laporanMobile" class="collapse dropdown-header-top">
                                        <li><a href="<?=BASEURL;?>/Report/Pembayar" target="_blank">Data Pembayar</a></li>
                                        <li><a href="<?=BASEURL;?>/Report/Penerima" target="_blank">Data Penerima</a></li>
                                        <li><a href="<?=BASEURL;?>/Report/Zakat" target="_blank">Data Keuangan Zakat</a></li>
                                        <li><a href="<?=BASEURL;?>/Report/Infak" target="_blank">Data Keuangan Infak</a></li>
                                        <li><a href="<?=BASEURL;?>/Donatur/exportLaporanDonaturPdf" target="_blank">Report PDF Data Donatur</a></li>
                                        <li><a href="<?=BASEURL;?>/Qurban/laporanKelompok" target="_blank">Jumlah Hewan Kurban Per Kelompok</a></li>
                                    </ul>
                                </li>
                                <li>
                                 <a data-toggle="collapse" data-target="#qurbanmobile" href="#">
                                        <i class="fa big-icon fa-print"></i> Kurban 
                                        <span class="adminpro-icon adminpro-down-arrow"></span>
                                    </a>
                                 <ul id="qurbanmobile" class="collapse dropdown-header-top">
                                        <li><a href="<?=BASEURL;?>/Donatur" target="_blank">Peserta Kurban</a></li>
                                        <li><a href="<?=BASEURL;?>/KelompokQurban" target="_blank">Kelompok Kurban</a></li>
                                        <li><a href="<?=BASEURL;?>/Qurban/listall" target="_blank">Transaksi Kurban</a></li>
                                  </ul>
                                  </li>
                                 <li><a href="<?=BASEURL;?>/Web/lihat_contact"><i class="fa big-icon fa-user"></i> Kritik & Saran</a></li>
                                

                             <?php } else { ?>
                      <li><a href="<?=BASEURL;?>/Amil"><i class="fa big-icon fa-user"></i> Amil</a></li>

                        <?php } ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Mobile Menu end -->

         
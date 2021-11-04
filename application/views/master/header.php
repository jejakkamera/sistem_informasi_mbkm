<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/mbkm.ico">
    <title>MBKM UBP Karawang</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>assets/themplate/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/themplate/horizontal/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="<?php echo base_url(); ?>assets/themplate/horizontal/css/colors/megna.css" id="theme" rel="stylesheet">
    <script src="<?php echo base_url(); ?>assets/themplate/assets/plugins/jquery/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

   
</head>

<body class="fix-header card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo icon -->
                        
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span>
                       
                         <!-- Light Logo text -->    
                         <img src="<?php echo base_url(); ?>assets/themplate/assets/images/logo-official1.png" width="50" class="light-logo" alt="homepage" /></span> </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0 ">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="icon-arrow-left-circle"></i></a> </li>
                  
                     
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                        
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->
                       
                        <!-- ============================================================== -->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url(); ?>assets/themplate/assets/images/user.png" width="50" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right animated flipInY">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img src="<?php echo base_url(); ?>assets/themplate/assets/images/user.png" alt="user"></div>
                                            <div class="u-text">
                                                <h4> <?php echo $this->session->userdata('username');?> </h4>
                                                <p class="text-muted"></p><a href="profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                              
                                    <li><a href="<?php echo base_url(); ?>welcome/logout"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                      
                    </ul>

                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    
                    <ul id="sidebarnav">
                        
                        <li>
                            <a href="<?php echo base_url(); ?>" aria-expanded="false"><i class="fa fa-circle"></i><span class="hide-menu">Dashboard</span></a>
                        </li>

                       <?php if($this->session->userdata('role')=='s_a'){?>
                        <li>
                            <a href="<?php echo base_url(); ?>admin/super" aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">User Login</span></a>
                        </li>
                        <li>
                                    <a href="">
                                        <i class="fa fa-folder-open-o"></i> Importer Feeder
                                        <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav">
                                        <li>
                                            <a href="<?php echo base_url(); ?>admin/feeder/connector">Connector</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url(); ?>admin/feeder/set_periode">Set Periode</a>
                                        </li>
                                        <li>
                                            <a class="has-arrow" href="#" aria-expanded="false">Data PT</a>
                                            <ul aria-expanded="false" class="collapse">
                                                <li>
                                                    <a href="<?php echo base_url(); ?>admin/feeder/prodi">Program Studi</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>admin/feeder/mahasiswa">Mahasiswa</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>admin/feeder/matakuliah">Matakuliah</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>admin/feeder/kurikulum">Kurikulum</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>admin/feeder/matakuliah_kurikulum">Matakuiliah Kurikulum</a>
                                                </li>
                                                
                                                <li>
                                                    <a href="<?php echo base_url(); ?>admin/feeder/dosen">Dosen</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>admin/feeder/riwayatnilai">KRS & KHS</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a class="has-arrow" href="#" aria-expanded="false">Data Dasar</a>
                                            <ul aria-expanded="false" class="collapse">
                                                <li><a href="<?php echo base_url(); ?>admin/feeder/Agama">Agama</a></li>
                                                <li><a href="<?php echo base_url(); ?>admin/feeder/jalurmasuk">Jalur Masuk</a></li>
                                                <li><a href="<?php echo base_url(); ?>admin/feeder/jalurkeluar">Jalur Keluar</a></li>
                                                <li><a href="<?php echo base_url(); ?>admin/feeder/jenispendaftaran">Jenis Pendaftaran</a></li>
                                                <li><a href="<?php echo base_url(); ?>admin/feeder/jenistinggal">Jenis Tinggal</a></li>
                                                <li><a href="<?php echo base_url(); ?>admin/feeder/jenjangpendidikan">jenjang pendidikan</a></li>
                                                <li><a href="<?php echo base_url(); ?>admin/feeder/pekerjaan">pekerjaan</a></li>
                                                <li><a href="<?php echo base_url(); ?>admin/feeder/pembiayaan">pembiayaan</a></li>
                                                <li><a href="<?php echo base_url(); ?>admin/feeder/penghasilan">penghasilan</a></li>
                                                <li><a href="<?php echo base_url(); ?>admin/feeder/wilayah">wilayah</a></li>
                                                <li><a href="<?php echo base_url(); ?>admin/feeder/tahunajaran">tahunajaran</a></li>
                                                <li><a href="<?php echo base_url(); ?>admin/feeder/statusmahasiswa">statusmahasiswa</a></li>
                                                <li><a href="<?php echo base_url(); ?>admin/feeder/statusaktif">statusaktif</a></li>
                                                <li><a href="<?php echo base_url(); ?>admin/feeder/semester">semester</a></li>
                                                <li><a href="<?php echo base_url(); ?>admin/feeder/sdm">sdm</a></li>
                                                <li><a href="<?php echo base_url(); ?>admin/feeder/transportasi">transportasi</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a class="has-arrow" href="#" aria-expanded="false">Perkuliahan</a>
                                            <ul aria-expanded="false" class="collapse">
                                              
                                                <li>
                                                    <a href="<?php echo base_url(); ?>admin/feeder/f_GetNilaiTransferPendidikanMahasiswa_list">Get Nilai Transfer</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>admin/feeder/push_kelas_perkuliahan">Push Kelas Perkuliahan</a>
                                                </li>
                                                
                                            </ul>
                                        </li>
                                        
                                    </ul>
                        </li>
                        <li>
                                    <a href="">
                                        <i class="fa fa-folder-open-o"></i> Baak
                                        <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav">
                                        
                                        <li>
                                            <a class="has-arrow" href="#" aria-expanded="false">Mahasiswa</a>
                                            <ul aria-expanded="false" class="collapse">
                                                <li>
                                                    <a href="<?php echo base_url(); ?>baak/mahasiswa">List mahasiswa</a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li>
                                            <a class="has-arrow" href="#" aria-expanded="false">Program Studi</a>
                                            <ul aria-expanded="false" class="collapse">
                                                <li>
                                                    <a href="<?php echo base_url(); ?>baak/prodi">List Prodi</a>
                                                </li>
                                               
                                            </ul>
                                        </li>

                                        <li>
                                            <a class="has-arrow" href="#" aria-expanded="false">Matakuliah</a>
                                            <ul aria-expanded="false" class="collapse">
                                                <li>
                                                    <a href="<?php echo base_url(); ?>baak/matakuliah/kurikulum">Kurikulum</a>
                                                </li>
                                            </ul>
                                        </li>
                                        
                                        
                                    </ul>
                        </li>

                       <?php }elseif($this->session->userdata('role')=='pegawai_baak'){ ?>
                        <li>
                                    <a href="">
                                        <i class="fa fa-folder-open-o"></i> Baak
                                        <i class="fa arrow"></i>
                                    </a>
                                   
                                    <ul class="sidebar-nav">
                                    <li>
                                                    <a href="<?php echo base_url(); ?>baak/Informasi">Data Informasi</a>
                                                </li>
                                        <li>
                                            <a class="has-arrow" href="#" aria-expanded="false">Mahasiswa</a>
                                            <ul aria-expanded="false" class="collapse">
                                                <li>
                                                    <a href="<?php echo base_url(); ?>baak/mahasiswa">List mahasiswa</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>baak/mahasiswa/kurikulum">Kurikulum mahasiswa</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>baak/mahasiswa/dosen_wali">Dosen Wali Mahasiswa</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>baak/mahasiswa/kelas">Kelas Mahasiswa</a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li>
                                            <a class="has-arrow" href="#" aria-expanded="false">Program Studi</a>
                                            <ul aria-expanded="false" class="collapse">
                                                <li>
                                                    <a href="<?php echo base_url(); ?>baak/prodi">List Prodi</a>
                                                </li>
                                               
                                            </ul>
                                        </li>

                                        <li>
                                            <a class="has-arrow" href="#" aria-expanded="false">Matakuliah</a>
                                            <ul aria-expanded="false" class="collapse">
                                                <li>
                                                    <a href="<?php echo base_url(); ?>baak/matakuliah/kurikulum">Kurikulum</a>
                                                </li>
                                                                                              
                                            </ul>
                                        </li>
                                        <li>
                                            <a class="has-arrow" href="#" aria-expanded="false">Dosen</a>
                                            <ul aria-expanded="false" class="collapse">
                                                <li>
                                                    <a href="<?php echo base_url(); ?>baak/dosen/">List Dosen</a>
                                                </li>
                                                                                              
                                            </ul>
                                        </li>
                                        <li>
                                            <a class="has-arrow" href="#" aria-expanded="false">FRS</a>
                                            <ul aria-expanded="false" class="collapse">
                                                <li>
                                                    <a href="<?php echo base_url(); ?>baak/frs/list_ta/">List Tahun Akademik</a>
                                                </li>
                                            </ul>
                                            <ul aria-expanded="false" class="collapse">
                                                <li>
                                                    <a href="<?php echo base_url(); ?>baak/frs/set_frs/">Set Pengisian FRS</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>baak/frs/set_input_nilai/">Set Input Nilai</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>baak/frs/set_kurikulum/">Set MK FRS</a>
                                                </li>
                                            </ul>
                                        
                                        </li>
                                       

                                        <li>
                                            <a class="has-arrow" href="#" aria-expanded="false">Perkuliahan</a>
                                            <ul aria-expanded="false" class="collapse">
                                                <li>
                                                    <a href="<?php echo base_url(); ?>baak/baak/waktu_kuliah">Waktu Kuliah</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>baak/baak/list_skala_nilai">Skala nilai</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>baak/baak/perkuliahan_rekap">Create Rekap</a>
                                                </li>
                                               
                                            </ul>
                                        </li>
                                    </ul>
                        </li>

                        <li>
                                <a href="">
                                        <i class="fa fa-folder-open-o"></i> Pembelajaran
                                        <i class="fa arrow"></i>
                                    </a>
                                <ul aria-expanded="false" class="collapse">
                                    <li>
                                        <a href="<?php echo base_url(); ?>baak/pembelajaran/set_periode">Set Periode</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>baak/pembelajaran/presensi_dosen_list_prodi">Presensi Dosen</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>baak/pembelajaran/presensi_mahasiswa_list_prodi">Presensi Mahasiswa</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>baak/pembelajaran/rekap_presensi_dosen">Rekap Presensi Dosen</a>
                                    </li>
                                    <li>
                                            <a class="has-arrow" href="#" aria-expanded="false">FRS</a>
                                            <ul aria-expanded="false" class="collapse">
                                                <li>
                                                    <a href="<?php echo base_url(); ?>baak/frs/list_pengisian_frs_mhs/">Pengisian FRS (mahasiswa)</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>baak/frs/list_pengisian_frs_mk/">Pengisian FRS (mk)</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>baak/frs/list_pengisian_frs_prodi/">Pengisian FRS (Prodi)</a>
                                                </li>
                                              
                                            </ul>
                                        </li>
                                    <li>
                                    <li>
                                            <a class="has-arrow" href="#" aria-expanded="false">Nilai</a>
                                            <ul aria-expanded="false" class="collapse">
                                                                                            
                                                        <li>
                                                            <a href="<?php echo base_url(); ?>baak/frs/set_kurikulum/report">Matakuliah</a>
                                                        </li>
                                                        <li>
                                                            <a href="<?php echo base_url(); ?>baak/mahasiswa">Mahasiswa</a>
                                                        </li>
                                                  

                                            </ul>
                                        </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>baak/pembelajaran/rekap_aktivitas_mahasiswa">Rekap Aktivitas Mahasiswa</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>baak/pembelajaran/rekap_administrasi_mahasiswa">Rekap administrasi Mahasiswa</a>
                                    </li>
                                               
                                </ul>
                        </li>
                       
                      
                       <?php }elseif($this->session->userdata('role')=='prodi'){ ?>
                        <li>
                                    <a href="">
                                        <i class="fa fa-folder-open-o"></i> Prodi
                                        <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav">
                                        
                                        <li>
                                            <a class="has-arrow" href="#" aria-expanded="false">Mahasiswa</a>
                                            <ul aria-expanded="false" class="collapse">
                                                <li>
                                                    <a href="<?php echo base_url(); ?>baak/mahasiswa">List mahasiswa</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>baak/mahasiswa/kurikulum">Kurikulum mahasiswa</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>baak/mahasiswa/dosen_wali">Dosen Wali Mahasiswa</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>baak/mahasiswa/kelas">Kelas Mahasiswa</a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li>
                                            <a class="has-arrow" href="#" aria-expanded="false">Program Studi</a>
                                            <ul aria-expanded="false" class="collapse">
                                                <li>
                                                    <a href="<?php echo base_url(); ?>baak/prodi">List Prodi</a>
                                                </li>
                                               
                                            </ul>
                                        </li>

                                        <li>
                                            <a class="has-arrow" href="#" aria-expanded="false">Matakuliah</a>
                                            <ul aria-expanded="false" class="collapse">
                                                <li>
                                                    <a href="<?php echo base_url(); ?>baak/matakuliah/kurikulum">Kurikulum</a>
                                                </li>
                                                                                              
                                            </ul>
                                        </li>
                                        <li>
                                            <a class="has-arrow" href="#" aria-expanded="false">Dosen</a>
                                            <ul aria-expanded="false" class="collapse">
                                                <li>
                                                    <a href="<?php echo base_url(); ?>baak/dosen/">List Dosen</a>
                                                </li>
                                                                                              
                                            </ul>
                                        </li>
                                        <li>
                                            <a class="has-arrow" href="#" aria-expanded="false">FRS Report</a>
                                            <ul aria-expanded="false" class="collapse">
                                                <li>
                                                    <a href="<?php echo base_url(); ?>prodi/frs/list_pengisian_frs_mhs/">Pengisian FRS (mahasiswa)</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>prodi/frs/list_pengisian_frs_mk/">Pengisian FRS (mk)</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>prodi/frs/list_pengisian_frs_prodi/">Pengisian FRS (Prodi)</a>
                                                </li>
                                            </ul>
                                        </li>
                                        
                                    </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="#" aria-expanded="false">Perkuliahan</a>
                                <ul aria-expanded="false" class="collapse">
                                    <li>
                                        <a href="<?php echo base_url(); ?>prodi/perkuliahan/frs">FRS</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>baak/pembelajaran/set_periode">Set Periode</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>baak/pembelajaran/presensi_dosen_list_prodi">Presensi Dosen</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>baak/pembelajaran/presensi_mahasiswa_list_prodi">Presensi Mahasiswa</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>baak/pembelajaran/rekap_presensi_dosen">Rekap Presensi Dosen</a>
                                    </li>
                                    <li>
                                            <a class="has-arrow" href="#" aria-expanded="false">FRS</a>
                                            <ul aria-expanded="false" class="collapse">
                                                <li>
                                                    <a href="<?php echo base_url(); ?>baak/frs/list_pengisian_frs_mhs/">Pengisian FRS (mahasiswa)</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>baak/frs/list_pengisian_frs_mk/">Pengisian FRS (mk)</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>baak/frs/list_pengisian_frs_prodi/">Pengisian FRS (Prodi)</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>baak/frs/set_kurikulum/report">Set MK FRS</a>
                                                </li>
                                            </ul>
                                        </li>
                                    <li>
                                    <li>
                                            <a class="has-arrow" href="#" aria-expanded="false">Nilai</a>
                                            <ul aria-expanded="false" class="collapse">
                                                                                            
                                                        <li>
                                                            <a href="<?php echo base_url(); ?>baak/frs/set_kurikulum/">Matakuliah</a>
                                                        </li>
                                                        <li>
                                                            <a href="<?php echo base_url(); ?>baak/mahasiswa">Mahasiswa</a>
                                                        </li>
                                                  

                                            </ul>
                                        </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>baak/pembelajaran/rekap_aktivitas_mahasiswa">Rekap Aktivitas Mahasiswa</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>baak/pembelajaran/rekap_administrasi_mahasiswa">Rekap administrasi Mahasiswa</a>
                                    </li>
                                               
                                </ul>
                        </li>
                       <?php }elseif($this->session->userdata('role')=='dosen'){ ?>
                        <li>
                            <a href="<?php echo base_url('dosen/profile/dosen_update'); ?>" aria-expanded="false"><i class="fa fa-circle"></i><span class="hide-menu">Profile</span></a>
                        </li>
                        <li>
                            <a class="has-arrow" href="#" aria-expanded="false">Mahasiswa</a>
                                <ul aria-expanded="false" class="collapse">
                                    <li>
                                        <a href="<?php echo base_url(); ?>dosen/mahasiswa">Mahasiswa Wali</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>dosen/mahasiswa/frs">FRS</a>
                                    </li>
                                               
                                </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="#" aria-expanded="false">Perkuliahan</a>
                                <ul aria-expanded="false" class="collapse">
                                    <li>
                                        <a href="<?php echo base_url(); ?>dosen/perkuliahan/kehadiran_dosen_jadwal">Kehadiran Dosen</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>dosen/perkuliahan/presensi_mahasiswa">Kehadiran mahasiswa</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>dosen/perkuliahan/input_nilai">Input Nilai</a>
                                    </li>
                                               
                                </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="#" aria-expanded="false">Pemagangan</a>
                                <ul aria-expanded="false" class="collapse">
                                    <li>
                                        <a href="<?php echo base_url(); ?>dosen/magang/list_mahasiswa">Mahasiswa bimbingan </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>dosen/magang/list_sidang">Sidang</a>
                                    </li>
                                               
                                </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="#" aria-expanded="false">TA & Skripsi</a>
                                <ul aria-expanded="false" class="collapse">
                                    <li>
                                        <a href="<?php echo base_url(); ?>dosen/ta_s1/list_mahasiswa">Bimbingan (S1)</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>dosen/ta_s1/list_sidang">Sidang (S1)</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>dosen/ta_d3/list_mahasiswa">Bimbingan (D3)</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>dosen/ta_d3/list_sidang">Sidang (D3)</a>
                                    </li>
                                </ul>
                        </li>

                       <?php }elseif($this->session->userdata('role')=='mhs'){ ?>
                        <li>
                            <a href="<?php echo base_url(); ?>mahasiswa/profile" aria-expanded="false"><i class="fa fa-circle"></i><span class="hide-menu">Profile</span></a>
                        </li>
                        <li>
                            <a class="has-arrow" href="#" aria-expanded="false">KRS MBKM</a>
                                <ul aria-expanded="false" class="collapse">
                                    
                                    <li>
                                        <a href="<?php echo base_url(); ?>mahasiswa/frs/lihat_select/">Cetak</a>
                                    </li>
                                </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="#" aria-expanded="false">Perkuliahan</a>
                                <ul aria-expanded="false" class="collapse">
                                    <li>
                                        <a href="<?php echo base_url(); ?>mahasiswa/perkuliahan/akademik">Akademik</a>
                                    </li>
                                    <!-- <li>
                                        <a href="<?php echo base_url(); ?>mahasiswa/perkuliahan/riwayat_perkuliahan">Riwayat Perkuliahan</a>
                                    </li> -->
                                    <li>
                                        <a href="<?php echo base_url(); ?>baak/frs/list_ta/">E-learning</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>mahasiswa/perkuliahan/kartu_kehadiran/">Kartu kehadiran</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>mahasiswa/perkuliahan/kartu_ujian/">Kartu Ujian</a>
                                    </li>
                                    
                                </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="#" aria-expanded="false">Hasil Studi</a>
                                <ul aria-expanded="false" class="collapse">
                                    <li>
                                        <a href="<?php echo base_url(); ?>mahasiswa/perkuliahan/hasil_studi">Hasil Studi Persemester</a>
                                    </li>
                                </ul>
                        </li>
                       
                        
                       <?php } ?>
                    
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
            
        </aside>
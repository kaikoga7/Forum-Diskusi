<?php
include '../koneksi.php';

// mengaktifkan session
session_start();

// cek apakah user telah login, jika belum login maka di alihkan ke halaman login
if($_SESSION['status'] !="login"){
    header("location:../index.php");
}

$nama=mysqli_query($koneksi,"SELECT * FROM user WHERE nim='$_SESSION[nim]'");
$tampil=mysqli_fetch_array($nama);

date_default_timezone_set('Asia/Kuala_Lumpur');

?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Home - Project UAS </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="../assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/metisMenu.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="../assets/css/typography.css">
    <link rel="stylesheet" href="../assets/css/default-css.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="../assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>

        <!-- sidebar menu area start -->

        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Project UAS</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="../assets/images/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo "$tampil[fullname]"; ?> <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="logout.php">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-1">

                </div>
                <div class="col-xl-10">
                   <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h6 class="page-title pull-left">Welcome <?php echo "$tampil[fullname]"; ?></h6>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class=" pull-right"><i class="fa fa-calendar"> : <?php echo date('M, d, Y, h:i a');; ?> </i>
                        </div>
                    </div>
                </div>
                </div>
            </div>


            <div class="main-content-inner">
                 <div class="col-12">
                    <div class="card mt-5">
                        <div class="card-body">
                            <h4 class="header-title">New Massages</h4>
                                <form method="post">
                                    <div class="input-group mb-3">
                                        <textarea class="form-control" aria-label="With textarea" name="msg"></textarea>
                                    </div>
                                    <div class="row">
                                      <div class="col-4">
                                        <button type="submit" class="btn btn-primary btn-block btn-flat" name="send"><i class="fa fa-envelope"></i> Send</button>
                                      </div>
                                    </div>
                                </form>
                                <?php
                                if(isset($_POST['send'])){
                                $pesan  = $_POST['msg'];
                                $query=mysqli_query($koneksi,"INSERT INTO msg (datetime, sender, message)
                                    VALUES (NOW(), '$tampil[fullname]', '$pesan') ");

                                    if($query)
                                    {
                                      ?>
                                      <script type="text/javascript">
                                        alert("Pesan Terkirim!");
                                        document.location.href="index.php";
                                      </script>
                                      <?php

                                        }
                                else {
                                    ?>
                                    <script type="text/javascript">
                                        alert("Pesan Tidak Terkirim!");
                                        document.location.href="index.php";
                                      </script>
                                      <?php

                                    }

                                }

                            ?>



                        </div>
                    </div>
                </div>
                <br>
                 <!-- table primary start -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Messages Data</h4>
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table text-center">
                                            <thead class="text-uppercase bg-primary">
                                                <tr class="text-white">
                                                    <th scope="col" width="50px">Date Time</th>
                                                    <th scope="col" width="50px">Sender</th>
                                                    <th scope="col" width="300px">Massage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $query_mysql = mysqli_query($koneksi,"SELECT * FROM msg ORDER BY datetime DESC");
                                            while($data = mysqli_fetch_array($query_mysql)){
                                            ?>
                                            <tr>
                                                <td><?php echo $data['datetime']; ?></td>
                                                <td><?php echo $data['sender']; ?></td>
                                                <td><?php echo $data['message']; ?></td>
                                            </tr>
                                            <?php } ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>Copyright © 2019 <a href="#"> Kai Koga </a>. All right reserved.</p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>

    <!-- offset area end -->
    <!-- jquery latest version -->
    <script src="../assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/owl.carousel.min.js"></script>
    <script src="../assets/js/metisMenu.min.js"></script>
    <script src="../assets/js/jquery.slimscroll.min.js"></script>
    <script src="../assets/js/jquery.slicknav.min.js"></script>

    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="../assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="../assets/js/pie-chart.js"></script>
    <!-- others plugins -->
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/scripts.js"></script>
</body>

</html>

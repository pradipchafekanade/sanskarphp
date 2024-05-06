<?php
    include("../connection.php");
    

    $id=0;
    $name="";
    $email="";
    $mobileno="";
    $password="";
    $registration="";
    
    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $sql = "SELECT * FROM users WHERE id= $id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $email = $row['email'];
        $mobileno = $row['mobileno'];
        $password = $row['password'];
        $registration = $row['registration'];
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title></title>
    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

    <?php include("menus.php"); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content" style="padding-top:50px;">
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800" >User</h1>
                    </div>
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-lg-8 d-block mx-auto border-1 p-5">
                            <form action="usersave.php" method="POST">

                                    <div class="row">
                                        <div class="col-lg-12 mt-3">
                                            <input type="hidden" name="id" value="<?= $id; ?>" id="" >               
                                            <label for="">Name</label>
                                            <input type="text" class="form-control" name="name" value='<?= $name; ?>' >
                                        </div>
                                        <div class="col-lg-12 mt-3">
                                            <label for="">Email</label>
                                            <input type="email" name="email" class="form-control" value='<?= $email; ?>' >
                                        </div>
                                        <div class="col-lg-12 mt-3">
                                            <label for="">Mobile Number</label>
                                            <input type="text" name="mobileno" class="form-control" value='<?= $mobileno; ?>' >
                                        </div>
                                        <div class="col-lg-12 mt-3">
                                            <label for="">password</label>
                                            <input type="text" name="password" class="form-control" value='<?= $password; ?>' >
                                        </div>
                                        <div class="col-lg-12 mt-3">
                                            <label for="">registration</label>
                                            <input type="text" name="registration" class="form-control" value='<?= $registration; ?>' >
                                        </div>
                                        <div class="col-lg-12 mt-3">
                                            <br>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>sanskar</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

   

    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../assets/js/demo/chart-area-demo.js"></script>
    <script src="../assets/js/demo/chart-pie-demo.js"></script>

</body>

</html>
<?php
    include("../connection.php");

    $courseid = $_GET["courseid"];
    $id = $_GET["id"];

    $atype = "";
    $description = "";
    $dayno = 1;


    if($id != 0){
        if($_GET["mode"] == "delete"){
            $sql = "DELETE FROM courseactivities WHERE id = $id";    
            $conn->query($sql);
            header('Location: activities.php?courseid=' . $courseid . '&id=0');
        }
        $sql = "SELECT * FROM courseactivities WHERE id = $id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        $atype = $row['atype'];
        $description = $row['description'];
        $dayno = $row['dayno'];
    }

    
    $sql = "SELECT * FROM courses WHERE id = $courseid";
    $result = $conn->query($sql);
    $course = $result->fetch_assoc();

    $sql = "SELECT * FROM courseactivities WHERE courseid = $courseid ORDER BY dayno";
    $activities = $conn->query($sql);
    if($id == 0){
        $dayno = mysqli_num_rows($activities) + 1;
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
                        <h1 class="h3 mb-0 text-gray-800" ><?= $course["name"] ?> Activities</h1>
                    </div>                   

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-lg-8 d-block mx-auto border-1 p-5">
                            <form action="activitysave.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="courseid"  value="<?= $courseid ?>" />
                                    <input type="hidden" name="id"  value="<?= $id ?>" />
                                    <div class="row">
                                        <div class="col-lg-6 mt-3">
                                            <label for="">Day No*</label>
                                            <input type="number" min="1" max="<?= $course["days"] ?>" name="dayno" class="form-control" value='<?= $dayno; ?>' />
                                        </div>
                                        <div class="col-lg-6 mt-3">
                                            <label for="">Activity Type*</label>
                                            <select id="atype" name="atype" class="form-control" onchange="activityTypeChanged()">
                                                <option value="Video">Video</option>
                                                <option value="Audio">Audio</option>
                                                <option value="Text">Text</option>
                                            </select>
                                        </div>
                                        <!-- <div id="divAudio" class="col-lg-12 mt-3">
                                            <label for="">Audio File*</label>
                                            <input type="file" id="audiofile" name="audiofile" class="form-control" />
                                        </div> -->
                                        <div id="divVideo" class="col-lg-12 mt-3">
                                            <label for="">Youtube Video Path*</label>
                                            <input type="text" id="videofile" name="videofile" class="form-control" value="<?= $description ?>" />

                                        </div>
                                        <div id="divText" class="col-lg-12 mt-3">
                                            <label for="">Description*</label>
                                            <textarea class="form-control" id="description" name="description"><?= $description; ?></textarea>
                                        </div>
                                        <div class="col-lg-12 mt-3">
                                            <br>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 d-block mx-auto border-1 p-5">
                        <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th  style="width:80px;">No</th>
                                            <th>Day No</th>
                                            <th>Activity Type</th>
                                            <th>Activity</th>
                                            <th style="width:150px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $count = 0;
                                            while($row = $activities->fetch_assoc()) {
                                                $count++;   
                                        ?>
                                        <tr>
                                            <td><?= $count; ?></td>
                                            <td><?= $row['dayno']; ?></td>
                                            <td><?= $row['atype']; ?></td>
                                            <td><?= $row['description']; ?></td>
                                            <td>
                                                <a href="activities.php?courseid=<?= $row["courseid"] ?>&id=<?= $row["id"] ?>&mode=edit"  class="btn btn-success btn-sm">Edit</a> &nbsp;&nbsp;
                                                <a href="activities.php?courseid=<?= $row["courseid"] ?>&id=<?= $row["id"] ?>&mode=delete" onclick="return confirm('Sure to delete?')" class="btn btn-danger btn-sm">Delete</a>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
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
    <script>
        function activityTypeChanged(){
            let atype = document.getElementById("atype").value;
            if(atype == "Audio"){
                document.getElementById("divAudio").style.display = "block";
                document.getElementById("divVideo").style.display = "none";
                document.getElementById("divText").style.display = "none";
            }
            else if(atype == "Video"){
                document.getElementById("divAudio").style.display = "none";
                document.getElementById("divVideo").style.display = "block";
                document.getElementById("divText").style.display = "none";
            }
            else if(atype == "Text"){
                document.getElementById("divAudio").style.display = "none";
                document.getElementById("divVideo").style.display = "none";
                document.getElementById("divText").style.display = "block";
            }
        }
        activityTypeChanged();
    </script>

</body>

</html>

<!-- new -->
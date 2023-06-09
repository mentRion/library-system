<!DOCTYPE html>

<html lang="en">
<head>
  <title>IBA NATIONAL HIGH SCHOOL</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--===============================================================================================-->
  <link rel="icon" type="image/png" href="images/icons/favicon.png"/>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
  <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
  <script src="https://rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
  <script type="text/javascript" src="instascan.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<!-- bootstrap 3.0.2 -->
<link href="styles/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- font Awesome -->
<link href="styles/admin/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="styles/admin/css/all.css" rel="stylesheet" type="text/css" />
<!-- Ionicons -->
<link href="styles/admin/css/ionicons.min.css" rel="stylesheet" type="text/css" />
<!-- bootstrap wysihtml5 - text editor -->
<link href="styles/admin/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="styles/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<!-- DATA TABLES -->
<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<SCRIPT LANGUAGE="Javascript" SRC="styles/admin/js/FusionCharts.js"></SCRIPT>


</head>
<body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <?php 

          include_once 'navigation.php';

        ?>

        <!-- Right side column. Contains the navbar and content of the page -->
        <aside class="right-side">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Attendance Record
                    <small>Control panel</small>
                </h1>

            </section>



      <div class="row">
          <div class="col-md-6">

          </div>
          <div class="col-md-12">
            <table class="table table-bordered">
              <th>
                <tr>

                  <td>STUDENT ID</td>
                  <td>TIME IN</td>
                  <td>TIME OUT</td>
                  <td>LOGDATE</td>
                  <td>STATUS</td>
                  <td>ACTION</td>

                </tr>
              </th>
              <tbody>
                <?php
                  $server = "localhost";
                  $username = "root";
                  $password = "";
                  $dbname = "dbs";

                  $conn = new mysqli($server, $username, $password, $dbname);

                  if ($conn->connect_error) {
                      die("Connection failed: " . $conn->connect_error);
                  }

                  $sql = "SELECT * FROM studattendance WHERE DATE(LOGDATE) = CURDATE()";
                  $query = $conn->query($sql);

                  if ($query) {
                      while ($row = $query->fetch_assoc()) {
                          ?>
                          <tr>
                              <td><?php echo $row['STUDENTID']; ?></td>
                              <td><?php echo $row['TIMEIN']; ?></td>
                              <td><?php echo $row['TIMEOUT']; ?></td>
                              <td><?php echo $row['LOGDATE']; ?></td>
                              <td><?php echo $row['STATUS']; ?></td>
                              <td> <button>action</button> </td>
                          </tr>
                          <?php
                      }
                  } else {
                      echo "Error: " . $conn->error;
                  }

                  $conn->close();
                  ?>

              </tbody>

            </table>



          </div>
      </div>

      <button type="submit" class="btn btn-success pull-right" onclick="Export()">

        <i class="fa fa-file-excel-o fa-fw"></i> Export to Excel
      </button>




    </div>
    <script>
      function Export()
      {
        var conf = confirm("Please Confirm if you wish to proceed in exporting the attendance in to Excel file");
        if(conf == true){
          window.open("exports.php", '_blank');
        }
      }
    </script>
    <script src="instascan.min.js"></script>
    <script type="text/javascript">
      let scanner=new Instascan.Scanner({video:document.getElementById('preview')});
        Instascan.Camera.getCameras().then(function(cameras){
          if(cameras.length>0) {
              scanner.start(cameras[0]);
          }
          else{
            alert("No cameras found");
          }

        }).catch(function (e){
          console.error(e);
        });
        scanner.addListener('scan',function(c){
          document.getElementById("text").value=c;
          document.forms[0].submit();//automatic trigger the qr code when scanning
        });
    </script>



<!-- jQuery 2.0.2 -->
<script src="styles/admin/js/jquery.min.js"></script>
<!-- jQuery UI 1.10.3 -->
<script src="styles/admin/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
<!-- Bootstrap -->
<script src="styles/admin/js/bootstrap.min.js" type="text/javascript"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="styles/admin/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<!-- DATA TABES SCRIPT -->
<script src="styles/admin/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="styles/admin/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="styles/admin/js/AdminLTE/app.js" type="text/javascript"></script>
<!-- page script -->
</body>

</html>

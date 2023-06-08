<!DOCTYPE html>
<html lang="en">
<head>
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
<title>1</title>
</head>
<body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <?php include_once('navigation.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li class="active">Home or Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
					<!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-6 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
							<?php 
                            $students = DB:: getInstance()->query("SELECT * FROM students WHERE teacher_id = ".$user->data()->id."");
                            $countStudents =DB:: getInstance()->count($students);?>
                                <div class="inner">
                                    <h3>
                                        <?php echo $countStudents; ?>
                                    </h3>
                                    <p>
                                        Students
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-user"></i>
                                </div>
                                <a href="admin.php?action=listStudents" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-6 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
							<?php 
                            $classInfo = DB:: getInstance()->query("SELECT * FROM class_info WHERE teacher_id = ".$user->data()->id."");
                            $countClass =DB:: getInstance()->count($classInfo);?>
                                <div class="inner">
                                    <h3>
										<?php echo $countClass; ?>
                                    </h3>
                                    <p>
                                        Class
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-book"></i>
                                </div>
                                <a href="admin.php?action=listClass" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    </div><!-- /.row -->

                   <!-- Main row -->
                    <div class="row">
                         <!-- Left col -->
                        <section class="col-lg-6 connectedSortable"> 
                            <!-- Box (with bar chart) -->
                            <div class="box box-success" id="loading-example">
                                <div class="box-header">
                                    <i class="fa fa-user"></i>

                                    <h3 class="box-title">List of Your Students</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="registered" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
												<th>Student ID</th>
                                                <th>Names</th>
                                                <th>Course & Year Level</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $students = DB:: getInstance()->query("SELECT * FROM students WHERE teacher_id = ".$user->data()->id."");							
                                            foreach($students->results() as $students){
                                            ?>
                                            <tr>
												<td><?php echo $students->studentID; ?></td>
                                                <td><?php echo ucwords($students->lname).', '.ucwords($students->fname).' '.ucfirst($students->mname[0]); ?></td>
                                                <td><?php echo strtoupper($students->course).' - '.$students->yearLevel; ?></td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->        
                        </section><!-- /.Left col -->
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                        <section class="col-lg-6 connectedSortable">
                            <!-- Map box -->
                            <div class="box box-danger" id="loading-example">
                                <div class="box-header">
                                    <!-- tools box -->
                                    <i class="fa fa-user"></i>

                                    <h3 class="box-title">List of Your Class</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="unregistered" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Subject</th>
                                                <th>Time Schedule</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php
											$classInfo = DB:: getInstance()->query("SELECT * FROM class_info WHERE teacher_id=".$user->data()->id."");		
											foreach($classInfo->results() as $classInfo){ ?>
                                            <tr>
                                                <td><?php echo $classInfo->subject ; ?></td>
												<td><?php echo $classInfo->schedule ; ?></td>
												<td align="center">
													<?php if($classInfo->has_ended == 1){?>
														<span class="label label-danger"> Class Attendance has ended </span></td>
													<?php }else{?>
														<span class="label label-success"> Attendance has not started </span></td>
													<?php }?>
												</td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </section><!-- right col -->
                    </div><!-- /.row (main row) -->
                    
					
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
                    
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

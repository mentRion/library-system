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
                            <div class="small-box bg-aqua">
                            <?php 
                            $programs = DB:: getInstance()->query("SELECT * FROM programs");
                            $countPrograms =DB:: getInstance()->count($programs);?>
                                <div class="inner">
                                    <h3>
                                        <?php echo $countPrograms; ?>
                                    </h3>
                                    <p>
                                        Programs
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-university"></i>
                                </div>
                                <a href="admin.php?action=listPrograms" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-6 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
							<?php 
                            $programType = DB:: getInstance()->query("SELECT * FROM programtype");
                            $countType =DB:: getInstance()->count($programType);?>
                                <div class="inner">
                                    <h3>
                                        <?php echo $countType; ?>
                                    </h3>
                                    <p>
                                        Program Types
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-book"></i>
                                </div>
                                <a href="admin.php?action=listProgramType" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    </div><!-- /.row -->

                    <!-- top row -->
                    <div class="row">
                        <div class="col-xs-12 connectedSortable">
                            
                        </div><!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-8 connectedSortable"> 
                            <!-- Box (with bar chart) -->
                            <div class="box box-success" id="loading-example">
                                <div class="box-header">
                                    <h3 class="box-title">List of Programs Offered</h3>
									<div class="pull-right box-tools">
										<a href="admin.php?action=listPrograms" type="button" class="btn btn-default btn-md">View All</a>
									</div><!-- /. tools -->
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="registered" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Program Type</th>
                                                <th>Programs Offered</th>
                                                <th>Level of Accreditation</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $programs = DB:: getInstance()->query("SELECT * FROM programs");							
                                            foreach($programs->results() as $programs){
                                            ?>
                                                <tr>
													<?php
													$ptype = DB:: getInstance()->query("SELECT * FROM programtype WHERE id='$programs->programType'");							
													foreach($ptype->results() as $ptype){?>
														<td><?php echo ucwords($ptype->type) ?></td>
													<?php }?>
                                                    <td><?php echo ucwords($programs->programs); ?></td>
													<td><?php echo $programs->accLevel.' '.$programs->accPhase; ?></td>
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
                        <section class="col-lg-4 connectedSortable">
                            <!-- Map box -->
                            <div class="box box-danger" id="loading-example">
                                <div class="box-header">
                                    <!-- tools box -->
                                    <i class="fa fa-address-book"></i>
                                    <h3 class="box-title">Program Type</h3>
									<div class="pull-right box-tools">
										<a href="admin.php?action=listProgramType" type="button" class="btn btn-default btn-md">View All</a>
									</div><!-- /. tools -->
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="unregistered" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Program Type</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $programType = DB:: getInstance()->query("SELECT * FROM programtype");							
                                            foreach($programType->results() as $programType){
                                            ?>
                                            <tr>
                                                <td><?php echo $programType->type; ?></td>
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

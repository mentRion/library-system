<?php
require_once 'core/init.php';

$user = new UserLogin(); //Current

?>

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
<!-- Theme style -->
<link href="styles/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<!-- Bootstrap Validator CSS -->
<link href="styles/admin/css/bootstrapValidator.min.css" rel="stylesheet">
<!-- DATA TABLES -->
<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<title>IBA NATIONAL HIGH SCHOOL</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
<style>
.btn-huge{
	width:100%;
    padding:35px;
}
</style>
</head>
<body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <?php include_once('navigation.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Library Management System
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="admin.php"><i class="fa fa-tachometer-alt"></i> Home</a></li>
                        <li class="active">Library Management System</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
					<div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title"><i class="fa fa-book"></i>  Transactions</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
									<div class="row">
										<div class="col-xs-6">
											<a href="admin.php?action=borrowBooks" type="button" class="btn btn-info btn-lg btn-huge">Borrow Books</a>
											<?php if(Session::exists('Borrowed')){ ?>
												<div class="alert alert-success">
													<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Borrowed'); ?>
												</div>
											<?php }?>
										</div>
										<div class="col-xs-6">
											<a href="admin.php?action=returnBooks" type="button" class="btn btn-warning btn-lg btn-huge">Return Books</a>
											<?php if(Session::exists('Returned')){ ?>
												<div class="alert alert-success">
													<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Returned'); ?>
												</div>
											<?php }?>
										</div>
									</div>
								</div><!-- /.box -->

							</div><!-- /.box -->
						</div><!-- /.col -->
                    </div><!-- /.row (main row) -->
					<div class="row">
                        <div class="col-xs-6">
                            <div class="box box-info">
                                <div class="box-header">
                                    <h3 class="box-title"><i class="fa fa-book"></i>  Borrow Transactions</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
									<div class="box-body table-responsive">
                                    <table class="table table-bordered table-hover" id="borrow">
                                        <thead>
                                            <tr>
												<th>Title of the Book</th>
												<th>Name of Borrower</th>
												<th>Date of Transaction</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
												$bookstransact = DB:: getInstance()->query("SELECT * FROM booktransactions WHERE transactionType='borrow'");
												foreach($bookstransact->results() as $bookstransact){ ?>
														<tr>
															<td><?php echo $bookstransact->bookTitle ; ?></td>
															<td><?php echo $bookstransact->borrower ; ?></td>
															<td><?php echo $bookstransact->transactionDate ; ?></td>
														</tr>
												<?php
												}
												?>
                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->
								</div><!-- /.box -->

							</div><!-- /.box -->
						</div><!-- /.col -->
						<div class="col-xs-6">
                            <div class="box box-warning">
                                <div class="box-header">
                                    <h3 class="box-title"><i class="fa fa-book"></i> Return Transactions</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
									<div class="box-body table-responsive">
                                    <table class="table table-bordered table-hover" id="return">
                                        <thead>
                                            <tr>
												<th>Title of the Book</th>
												<th>Name of Borrower</th>
												<th>Date of Transaction</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
												$bookstransact = DB:: getInstance()->query("SELECT * FROM booktransactions WHERE transactionType='return'");
												foreach($bookstransact->results() as $bookstransact){ ?>
														<tr>
															<td><?php echo $bookstransact->bookTitle ; ?></td>
															<td><?php echo $bookstransact->borrower ; ?></td>
															<td><?php echo $bookstransact->transactionDate ; ?></td>
														</tr>
												<?php
												}
												?>
                                        </tbody>
                                    </table>
								</div><!-- /.box -->

							</div><!-- /.box -->
						</div><!-- /.col -->
                    </div><!-- /.row (main row) -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
	<!-- jQuery 2.0.2 -->
	<script src="styles/admin/js/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="styles/admin/js/bootstrap.min.js" type="text/javascript"></script>
	<!-- DATA TABES SCRIPT -->
	<script src="styles/admin/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
	<script src="styles/admin/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
	<!-- AdminLTE App -->
	<script src="styles/admin/js/AdminLTE/app.js" type="text/javascript"></script>
	<!-- Bootstrap Validator JS -->
	<script src="styles/admin/js/bootstrapValidator.min.js"></script>
	<!-- page script -->
	<script type="text/javascript">
		$(function() {
			$("#borrow").dataTable();
		});
		function printImg(url) {
		  var win = window.open('');
		  win.document.write('<img src="' + url + '" onload="window.print();window.close()" />');
		  win.focus();
		}
	</script>
	<script type="text/javascript">
		$(function() {
			$("#return").dataTable();
		});
		function printImg(url) {
		  var win = window.open('');
		  win.document.write('<img src="' + url + '" onload="window.print();window.close()" />');
		  win.focus();
		}
	</script>
</body>
</html>

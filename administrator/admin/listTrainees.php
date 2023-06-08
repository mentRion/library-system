<?php
if (Input::exists()) {
	$PNG_TEMP_DIR =  dirname(__FILE__).DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'trainees'.DIRECTORY_SEPARATOR;
		
		$trainees = DB:: getInstance()->get('trainees', array('id','=',Input::get('id')));							
		foreach($trainees->results() as $trainees){
			unlink($PNG_TEMP_DIR.$trainees->studentpic);
		}
		
		$contents = DB:: getInstance()->delete('trainees', array('id','=',Input::get('id')));													
		Session::flash('Deleted', 'Record has been successfully deleted.');
		Redirect::to('admin.php?action=listTrainees');
}

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
<!-- Ionicons -->
<link href="styles/admin/css/ionicons.min.css" rel="stylesheet" type="text/css" />
<!-- bootstrap wysihtml5 - text editor -->
<link href="styles/admin/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="styles/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<!-- DATA TABLES -->
<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
        .uploadFile {
        background: url('images/whitecam.png') no-repeat;
        height: 32px;
        width: 32px;
        overflow: hidden;
        cursor: pointer;
        }
        .uploadFile input {
        filter: alpha(opacity=0);
        opacity: 0;
        margin-left: -110px;
        }
        .custom-file-input {
        height: 25px;
        cursor: pointer;
        }
    </style>
<title>SDSSU Cantilan Campus</title>
</head>
<body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <?php include_once('navigation.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Trainees
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="admin.php"><i class="fa fa-tachometer-alt"></i> Home</a></li>
                        <li class="active">Trainees</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">List of Trainees</h3>    
                                    <div class="pull-right box-tools">
                                        <button class="btn btn-primary btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-primary btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                                    </div><!-- /. tools -->                                
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <?php if(Session::exists('Deleted')){ ?>
                                             <div class="alert alert-danger">
                                                <i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Deleted'); ?>
                                             </div>
                                    <?php }?> 
                                    <?php if(Session::exists('Updated')){ ?>
                                             <div class="alert alert-success">
                                                <i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Updated'); ?>
                                             </div>
                                    <?php }?>
									<?php if(Session::exists('PicUpdated')){ ?>
                                             <div class="alert alert-success">
                                                <i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('PicUpdated'); ?>
                                             </div>
                                    <?php }?>
									<?php if(Session::exists('Added')) { ?>
										<div class="alert alert-success">
											<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Added'); ?>
										</div>
									<?php }?>
									<?php if(Session::exists('Error')) { ?>
										<div class="alert alert-danger">
											<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Error'); ?>
										</div>
									<?php }?>
                                    <table class="table table-bordered table-hover" id="articles">
                                        <thead>
                                            <tr>
												<th>Student ID</th>
                                                <th>Name of Trainee</th>
                                                <th>Course & Year Level</th>
												<th>Employers Company</th>
												<th>Account Status</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
												<?php
												$trainees = DB:: getInstance()->query("SELECT * FROM trainees");							
												foreach($trainees->results() as $trainees){
													?>
														<tr>
															<td>
															<?php echo $trainees->studentID ; ?>
															</td>
															<td><?php echo ucwords($trainees->lname), ", " ,ucwords($trainees->fname), " ",ucwords($trainees->mname) ; ?></td>
															<td><?php echo $trainees->yearLevel," ", $trainees->course ; ?></td>
															<td><?php echo $trainees->company_applied ; ?></td>
															<td align="center">
																<?php if($trainees->registered == 1){?>
																	<span class="label label-success"> Registered </span></td>
																<?php }else{?>
																	<span class="label label-danger"> Unregistered </span></td>
																<?php }?>
															</td>
															
															<td align="center">
																<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal_<?php echo ucwords($trainees->id); ?>" >View Other Info</button>
																<!-- Modal -->
																<div id="myModal_<?php echo ucwords($trainees->id); ?>" class="modal fade" role="dialog">
																	<div class="modal-dialog">

																	<!-- Modal content-->
																		<div class="modal-content">
																			<div class="modal-header">
																				<h4 class="modal-title"><?php echo ucwords($trainees->lname), ", " ,ucwords($trainees->fname), " ",ucwords($trainees->mname) ; ?></h4>
																			</div>
																			<div class="modal-body" style="text-align:left">
																				<div class="row">
																					<div class="col-xs-4">
																						<img width="100%" style="border:2px solid grey" src="admin/uploads/trainees/<?php echo $trainees->studentpic;?>">
																						<form enctype="multipart/form-data" method="post" action="uploadTrainee.php" >
																							<div class="row">
																								<div class="col-xs-2">
																									<div class="uploadFile">
																										<input type="file" name="editpic" accept=".jpg,.jpeg,.png" required>
																										<input type="hidden" name="sid" value="<?php echo $trainees->id;?>" >
																									</div>
																								</div>
																								<div class="col-xs-4" style="padding-top:6px;margin-left:2px;">
																									<button type="submit" class="btn btn-xs btn-success">Change Picture</button>
																								</div>
																							</div>
																						</form>
																					</div>
																					<div class="col-xs-8">
																						<table class="table table-hover">
																							<tr>
																								<td>Civil Status : <b><?php echo $trainees->civilstatus;?></b></td>
																								<td>Sex : <b><?php echo $trainees->sex;?></b></td>
																							</tr>
																							<tr>
																								<td>Permanent Address :</td>
																								<td><b><?php echo $trainees->paddress;?></b></td>
																							</tr>
																							<tr>
																								<td>Nationality : <b><?php echo $trainees->nationality;?></b></td>
																								<td>Birthdate : <b><?php echo $trainees->bdate;?></b></td>
																							</tr>
																							<tr>
																								<td>Birth Place:</td>
																								<td><b><?php echo $trainees->bplace;?></b></td>
																							</tr>
																							<tr>
																								<td>Age : <b><?php echo $trainees->age;?></b></td>
																								<td>Height : <b><?php echo $trainees->height;?></b></td>
																							</tr>
																							<tr>
																								<td>Weight : <b><?php echo $trainees->weight;?></b></td>
																							</tr>
																						</table>	
																					</div>
																				</div>
																				<div class="row">
																					<div class="col-xs-12">
																						<h4>Family Background</h4>
																						<table class="table table-hover">
																							<tr>
																								<td>Father : <b><?php echo $trainees->fathername;?></b></td>
																								<td></td>
																							</tr>
																							<tr>
																								<td>Occupation: <b><?php echo $trainees->foccupation;?></b></td>
																								<td>Contact : <b><?php echo $trainees->fcontact;?></b></td>
																							</tr>
																							<tr>
																								<td>Mother : <b><?php echo $trainees->mothername;?></b></td>
																								<td></td>
																							</tr>
																							<tr>
																								<td>Occupation: <b><?php echo $trainees->moccupation;?></b></td>
																								<td>Contact : <b><?php echo $trainees->mcontact;?></b></td>
																							</tr>
																						</table>
																						<h4>Education Background</h4>
																						<table class="table table-hover">
																							<tr>
																								<td>Elementary :</td>
																								<td> <b><?php echo $trainees->elem;?></b></td>
																							</tr>
																							<tr>
																								<td>School Year :</td>
																								<td> <b><?php echo $trainees->esy;?></b></td>
																							</tr>
																							<tr>
																								<td>Secondary :</td>
																								<td> <b><?php echo $trainees->secondary;?></b></td>
																							</tr>
																							<tr>
																								<td>School Year :</td>
																								<td> <b><?php echo $trainees->hsy;?></b></td>
																							</tr>
																							<tr>
																								<td>Tertiary :</td>
																								<td> <b><?php echo $trainees->tertiary;?></b></td>
																							</tr>
																							<tr>
																								<td>Course: <b><?php echo $trainees->course;?></b></td>
																								<td>Major : <b><?php echo $trainees->major;?></b></td>
																							</tr>
																						</table>																				
																					</div>
																				</div>
																			</div>
																			<div class="modal-footer">
																				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																			</div>
																		</div>

																	</div>
																</div>
																<?php require_once ('delete-confirm.php');?>
																<form method="POST" action="" style="display:inline">
																	<input type="hidden" name="id" value="<?php echo $trainees->id;  ?>">
																	<button class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Delete User" data-message="Are you sure you want to delete this?">
																		<i class="glyphicon glyphicon-trash"></i> Delete
																	</button>
																</form>
																<form method="POST" action="admin.php?action=editTrainees&&id=<?php echo $trainees->id; ?>" style="display:inline">
																	<button class="btn btn-xs btn-primary" type="submit">
																		<i class="glyphicon glyphicon-edit"></i> Edit
																	</button>
																</form>
															</td>
														</tr>
                                            <?php 	
												}
												?>
                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->
								<div class="box-footer">
                                	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
									Add New Trainees
									</button>
									<!-- Modal -->
									<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" >
									<div class="modal-dialog modal-dialog-scrollable" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h3 class="modal-title" id="exampleModalLabel"><i class="fa fa-users"></i> Add New Trainees</h3>
											</div>
											<div class="modal-body">
												<form enctype="multipart/form-data" method="post" action="addTrainees.php" >
													<div class="row">
														<div class="col-xs-3">
															<label class="control-label" for="studentID"><font color="#EC0003">*</font> Student ID :</label>
														</div>
														<div class="col-xs-9">
															<div class="form-group">
																<input type="text" class="form-control" id="studentID" name="studentID" placeholder="Input Student ID" required >
																<span id="IDAvailable"></span>
															</div>
														</div>
													</div>
													<label class="control-label" for="upload"><font color="#EC0003">*</font> Upload Student Picture</label>
													<div class="form-group">
														<input type="file" id="fileName" name='upload' accept=".jpg,.jpeg,.png" onchange="validateFileType()" required>
													</div>
														<script type="text/javascript">
															function validateFileType(){
																var fileName = document.getElementById("fileName").value;
																var idxDot = fileName.lastIndexOf(".") + 1;
																var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
																if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
																	//TO DO
																}else{
																	alert("Only jpg/jpeg and png files are allowed!");
																}   
															}
														</script>
													<h3>Personal Data</h3>
													<div class="row">
														<div class="col-lg-4 col-md-4">
															<label class="control-label" for="lname"><font color="#EC0003">*</font> Lastname</label>
															<div class="form-group">
																<input type="text" class="form-control" id="lname" name="lname" placeholder="Input Lastname" required>
															</div>
														</div>
														<div class="col-lg-4 col-md-4">
															<label class="control-label" for="fname"><font color="#EC0003">*</font> Firstname</label>
															<div class="form-group">
																<input type="text" class="form-control" id="fname" name="fname" placeholder="Input Firstname" required>
															</div>
														</div>
														<div class="col-lg-4 col-md-4">
															<label class="control-label" for="mname"><font color="#EC0003">*</font> Middlename</label>
															<div class="form-group">
																<input type="text" class="form-control" id="mname" name="mname" placeholder="Input Middlename" required >
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-6 col-md-6">
															<label class="control-label" for="civilstatus"><font color="#EC0003">*</font> Civil Status</label>
															<div class="form-group">
																<select class="form-control" name="civilstatus" id="civilstatus" required>
																	<option hidden value="">Select One</option>
																	<option value="Single">Single</option>
																	<option value="Married">Married</option>
																	<option value="Separated">Separated</option>
																	<option value="Widow/Widower">Widow/Widower</option>
																</select> 
															</div>
														</div>
														<div class="col-lg-6 col-md-6">
															<label class="control-label" for="sex"><font color="#EC0003">*</font> Sex</label>
															<div class="form-group">
																<select class="form-control" name="sex" id="sex" required>
																	<option hidden value="">Select One</option>
																	<option value="Male">Male</option>
																	<option value="Female">Female</option>
																</select> 
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-8 col-md-8">
															<label class="control-label" for="paddress"><font color="#EC0003">*</font> Permanent Address</label>
															<div class="form-group">
																<input type="text" class="form-control" id="paddress" name="paddress" placeholder="Input Address" required>
															</div>
														</div>
														<div class="col-lg-4 col-md-4">
															<label class="control-label" for="nationality"><font color="#EC0003">*</font> Nationality</label>
															<div class="form-group">
																<input type="text" class="form-control" id="nationality" name="nationality" placeholder="Input Nationality" required>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-4 col-md-4">
															<label class="control-label" for="bdate"><font color="#EC0003">*</font> Birthdate</label>
															<div class="form-group">
																<input type="text" class="form-control" id="bdate" name="bdate" placeholder="mm/dd/yyyy" required  data-provide="datepicker">
															</div>
														</div>
														<div class="col-lg-8 col-md-8">
															<label class="control-label" for="bplace"><font color="#EC0003">*</font> Birthplace</label>
															<div class="form-group">
																<input type="text" class="form-control" id="bplace" name="bplace" placeholder="Input Birthplace" required>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-4 col-md-4">
															<label class="control-label" for="age"><font color="#EC0003">*</font> Age</label>
															<div class="form-group">
																<input type="text" class="form-control" id="age" name="age" placeholder="Input Age" required>
															</div>
														</div>
														<div class="col-lg-4 col-md-4">
															<label class="control-label" for="height"><font color="#EC0003">*</font> Height</label>
															<div class="form-group">
																<input type="text" class="form-control" id="height" name="height" placeholder="Input Height in ft" required>
															</div>
														</div>
														<div class="col-lg-4 col-md-4">
															<label class="control-label" for="weight"><font color="#EC0003">*</font> Weight</label>
															<div class="form-group">
																<input type="text" class="form-control" id="weight" name="weight" placeholder="Input Weight in kls" required> 
															</div>
														</div>
													</div>
													<h3>Family Background</h3>
													<div class="row">
														<div class="col-lg-12 col-md-12">
															<label class="control-label" for="fathername"><font color="#EC0003">*</font> Fathers Name</label>
															<div class="form-group">
																<input type="text" class="form-control" id="fathername" name="fathername" placeholder="Input Fathers Complete Name" required>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-8 col-md-8">
															<label class="control-label" for="foccupation"><font color="#EC0003">*</font> Fathers Occupation</label>
															<div class="form-group">
																<input type="text" class="form-control" id="foccupation" name="foccupation" placeholder="Input Fathers Occupation" required>
															</div>
														</div>
														<div class="col-lg-4 col-md-4">
															<label class="control-label" for="fcontact"><font color="#EC0003">*</font> Fathers Contact Number</label>
															<div class="form-group">
																<input type="text" maxlength="11" class="form-control" id="fcontact" name="fcontact" placeholder="Input Phone Number" required onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" />
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-12 col-md-12">
															<label class="control-label" for="mothername"><font color="#EC0003">*</font> Mothers Name</label>
															<div class="form-group">
																<input type="text" class="form-control" id="mothername" name="mothername" placeholder="Input Fathers Complete Name" required>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-8 col-md-8">
															<label class="control-label" for="moccupation"><font color="#EC0003">*</font> Mothers Occupation</label>
															<div class="form-group">
																<input type="text" class="form-control" id="moccupation" name="moccupation" placeholder="Input Fathers Occupation" required>
															</div>
														</div>
														<div class="col-lg-4 col-md-4">
															<label class="control-label" for="mcontact"><font color="#EC0003">*</font> Mothers Contact Number</label>
															<div class="form-group">
																<input type="text" maxlength="11" class="form-control" id="mcontact" name="mcontact" placeholder="Input Phone Number" required onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" />
															</div>
														</div>
													</div>
													<h3>Educational Background</h3>
													<div class="row">
														<div class="col-lg-8 col-md-8">
															<label class="control-label" for="elem"><font color="#EC0003">*</font> Elementary</label>
															<div class="form-group">
																<input type="text" class="form-control" id="elem" name="elem" placeholder="Input School Name" required>
															</div>
														</div>
														<div class="col-lg-4 col-md-4">
															<label class="control-label" for="esy"><font color="#EC0003">*</font> School Year</label>
															<div class="form-group">
																<input type="text" class="form-control" id="esy" name="esy" placeholder="Input School Year" required>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-8 col-md-8">
															<label class="control-label" for="secondary"><font color="#EC0003">*</font> Secondary</label>
															<div class="form-group">
																<input type="text" class="form-control" id="secondary" name="secondary" placeholder="Input School Name" required>
															</div>
														</div>
														<div class="col-lg-4 col-md-4">
															<label class="control-label" for="hsy"><font color="#EC0003">*</font> School Year</label>
															<div class="form-group">
																<input type="text" class="form-control" id="hsy" name="hsy" placeholder="Input School Year" required>
															</div>
														</div>
													</div>
													<label class="control-label" for="tertiary"><font color="#EC0003">*</font> Tertiary</label>
													<div class="form-group">
														<input type="text" class="form-control" id="tertiary" name="tertiary" placeholder="Input School Name" required>
													</div>
													<div class="row">
														<div class="col-lg-8 col-md-8">
															<label class="control-label" for="course"><font color="#EC0003">*</font> Course</label>
															<div class="form-group">
																<input type="text" class="form-control" id="course" name="course" placeholder="Input Course" required>
															</div>
														</div>
														<div class="col-lg-4 col-md-4">
															<label class="control-label" for="major"><font color="#EC0003">*</font> Major</label>
															<div class="form-group">
																<input type="text" class="form-control" id="major" name="major" placeholder="Input Major" required>
															</div>
														</div>
													</div>
													
													<label class="control-label" for="yearLevel"><font color="#EC0003">*</font> Year Level</label>
													<div class="form-group">
														<select class="form-control" name="yearLevel" id="yearLevel" required>
															<option hidden value="">Select Year Level</option>
															<option value="1st Year">1st Year</option>
															<option value="2nd Year">2nd Year</option>
															<option value="3rd Year">3rd Year</option>
															<option value="4th Year">4th Year</option>
														</select> 
													</div>
													<label class="control-label" for="company"><font color="#EC0003">*</font> Company Applied</label>
													<div class="form-group">
														<input type="text" class="form-control" id="company" name="company" placeholder="Input Company Name" required>
													</div>
											</div>
											<div class="modal-footer">
												<button type="submit" class="btn btn-lg btn-success" value="save"><i class="glyphicon glyphicon-floppy-disk"></i> Save</button>
												<button type="button" class="btn btn-lg btn-danger" data-dismiss="modal">Cancel</button>
												</form>
											</div>
										</div>
										</div>
									</div>
									</div>
                                </div>
                            </div><!-- /.box -->

                        </div><!-- /.col -->
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
<!-- Bootstrap Datepicker -->
<script src="js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="styles/admin/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<!-- DATA TABES SCRIPT -->
<script src="styles/admin/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="styles/admin/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="styles/admin/js/AdminLTE/app.js" type="text/javascript"></script>
<!-- page script -->
<script type="text/javascript">
    $(function() {
        $("#articles").dataTable();
    });
</script>
<script type="text/javascript">
  $('#confirmDelete').on('show.bs.modal', function (e) {
	  var $message = $(e.relatedTarget).attr('data-message');
	  $(this).find('.modal-body p').text($message);
	  $title = $(e.relatedTarget).attr('data-title');
	  $(this).find('.modal-title').text($title);

	  // Pass form reference to modal for submission on yes/ok
	  var form = $(e.relatedTarget).closest('form');
	  $(this).find('.modal-footer #confirm').data('form', form);
  });
  <!-- Form confirm (yes/ok) handler, submits form -->
  $('#confirmDelete').find('.modal-footer #confirm').on('click', function(){
	  $(this).data('form').submit();
  });
</script>
</body>

</html>

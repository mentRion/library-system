<?php
if (Input::exists()) {
    if(Token::check(Input::get('token'))) {
		$requirement = new Requirements();
			try {
				$requirement->update(array(
					'name' => Input::get('rname'),
				), $_GET['id']);
				Session::flash('Updated', 'Requirement Info has been successfully updated.');
				Redirect::to('admin.php?action=listRequirements');
			} catch(Exception $e) {
				$error;
			}
    }
	if(Token::check(Input::get('newfile'))) {
		$PNG_TEMP_DIR =  dirname(__FILE__).DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'ojtrequirements'.DIRECTORY_SEPARATOR;
		
		$attachedFile = DB:: getInstance()->get('ojt_requirements', array('id','=',$_GET['id']));							
		foreach($attachedFile->results() as $attachedFile){
			unlink($PNG_TEMP_DIR.$attachedFile->attachedFile);
		}
		
		$requirement = new Requirements();
		if(isset($_FILES['upload']['tmp_name'])) {
			$upload = new Upload();
			$upload->SetFileName($_FILES['upload']['name']);
			$upload->SetTempName($_FILES['upload']['tmp_name']);
			$upload->SetUploadDirectory("admin/uploads/ojtrequirements/"); 
			$upload->SetValidExtensions(array('pdf'));
			$upload->SetMaximumFileSize(3000000); //Maximum file size in bytes, 
			$upload->UploadFile();
			$image = $upload->GetFileName();
		}
			try {
				$requirement->update(array(
					'attachedFile' => $image,
				), $_GET['id']);
				Session::flash('NewFile', 'New Attachment has been uploaded.');
				Redirect::to('admin.php?action=editRequirement&&id='.$_GET['id']);
			} catch(Exception $e) {
				$error;
			}
    }
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
<!-- Theme style -->
<link href="styles/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<!-- Bootstrap Validator CSS -->
<link href="styles/admin/css/bootstrapValidator.min.css" rel="stylesheet">
<!-- bootstrap wysihtml5 - text editor -->
<link href="styles/admin/css/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
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
                        Downloadables(OJT Requirements) Info
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="admin.php"><i class="fa fa-tachometer-alt"></i> Home</a></li>
                        <li><a href="admin.php?action=listRequirements">Topic Downloadables</a></li>
                        <li class="active">Edit OJT Requirements</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Edit OJT Requirements - <small><font color="#EC0003">*</font> required fields</small></h3>    
                                <div class="pull-right box-tools">
                                    <button class="btn btn-primary btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                    <button class="btn btn-primary btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                                </div><!-- /. tools -->                                
                            </div><!-- /.box-header -->
                            <div class="box-body">
								<?php if(Session::exists('NewFile')){ ?>
									<div class="alert alert-success">
										<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('NewFile'); ?>
                                    </div>
								<?php }?>
                                <?php 
									$requirement = DB:: getInstance()->query("SELECT * FROM ojt_requirements WHERE id=".$_GET['id']."");							
									foreach($requirement->results() as $requirement){
									?>
								<form id="editUser" action="" method="post">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4">
											<label class="control-label" for="rname"><font color="#EC0003">*</font> Requirement Name</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="rname" name="rname" value="<?php echo $requirement->name; ?>">
                                            </div>
                                        </div>
									</div>
									<div class="row">
										<div class="col-lg-5 col-md-5">
											<a href="admin/uploads/ojtrequirements/<?php echo $requirement->attachedFile; ?>" type="button" class="btn btn-success" target="_blank">
												View Attached File
											</a>
											<button type="button" class="btn btn-success" data-toggle="modal" data-target="#uploads">
												Upload a New File
											</button>
										</div>		
									</div>
                                    <div class="clearfix"></div><hr />
                                    <div class="form-actions">
                                        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-edit fa-fw"></i>&nbsp;Save Edits
                                        </button>
                                        <button type="button" class="btn btn" onclick="window.location='admin.php?action=listRequirements'">Cancel</button>
                                    </div>
                                    <br />
                                </form> 
												<!-- Modal -->
													<div class="modal fade" id="uploads" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
													<div class="modal-dialog modal-lg" role="document">
														<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h3 class="modal-title" id="exampleModalLabel">Add New Content</h3>
														</div>
														<div class="modal-body">
															<form enctype="multipart/form-data" method="post" action="">
																<label class="control-label" for="upload"><font color="#EC0003">*</font> Upload New Attachment</label>
																<div class="form-group">
																	<input name='upload' type='file' accept="application/pdf" required/>
																</div>
																<input type="hidden" name="newfile" value="<?php echo Token::generate(); ?>">
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-success" value="save"><i class="glyphicon glyphicon-edit"></i> Save</button>
															<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
															</form>
														</div>
														</div>
													</div>
													</div>
								<?php }?>                 
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->

                    </div><!-- /.col -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
                    
<!-- jQuery 2.0.2 -->
<script src="styles/admin/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="styles/admin/js/bootstrap.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="styles/admin/js/AdminLTE/app.js" type="text/javascript"></script>
<!-- Bootstrap Validator JS -->
<script src="styles/admin/js/bootstrapValidator.min.js"></script>    
<script type="text/javascript">
	$(document).ready(function() {
        var validator = $("#editUser").bootstrapValidator({
			fields : {
				username : {
					message : "This field is required",
					validators : {
						notEmpty :{
							message : "Username cannot be empty.",
						},
					}
				},
				userRole : {
					message : "This field is required",
					validators : {
						notEmpty :{
							message : "Please select a User Role.",
						},
					}
			}
		});
    });
</script>
</body>
</html>
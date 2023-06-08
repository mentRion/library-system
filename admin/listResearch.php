<?php
if (Input::exists()) {
		$PNG_TEMP_DIR =  dirname(__FILE__).DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'researchfiles'.DIRECTORY_SEPARATOR;
		
		$research = DB:: getInstance()->get('research', array('id','=',Input::get('id')));							
		foreach($research->results() as $research){
			unlink($PNG_TEMP_DIR.$research->researchfile);
		}
		
		$programs = DB:: getInstance()->delete('research', array('id','=',Input::get('id')));		
		Session::flash('Deleted', 'Record has been successfully deleted.');
		Redirect::to('admin.php?action=listResearch');
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
<SCRIPT LANGUAGE="Javascript" SRC="styles/js/FusionCharts.js"></SCRIPT>
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
                        Research
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="admin.php"><i class="fa fa-tachometer-alt"></i> Home</a></li>
                        <li class="active">Research</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Research</h3>    
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
									<?php if(Session::exists('Added')) { ?>
											<div class="alert alert-success">
												<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Added'); ?>
											</div>
                                    <?php }?>
                                    <table class="table table-bordered table-hover" id="articles">
                                        <thead>
                                            <tr>
                                                <th>Research Activities</th>
                                                <th>Attached Files</th>
												<th>Date Added</th>
												<th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
												$research = DB:: getInstance()->query("SELECT * FROM research");							
												foreach($research->results() as $research){
													?>
														<tr>
															<td><?php echo $research->research ; ?></td>
															<td>
																<a href="admin/uploads/researchfiles/<?php echo $research->researchfile; ?>" target="_blank">
																	<?php echo $research->researchfile ; ?>
																</a>
															</td>
															<td><?php echo $research->dateAdded ; ?></td>
															
															<td align="center">
																<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal_<?php echo ucwords($research->id); ?>" >View Contents</button>
																<!-- Modal -->
																<div id="myModal_<?php echo ucwords($research->id); ?>" class="modal fade" role="dialog">
																	<div class="modal-dialog">

																	<!-- Modal content-->
																		<div class="modal-content">
																			<div class="modal-header">
																				<h4 class="modal-title"><?php echo ucwords($research->research) ?></h4>
																			</div>
																			<div class="modal-body" style="text-align:left">
																				<?php echo ucwords($research->content) ?>
																			</div>
																			<div class="modal-footer">
																				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																			</div>
																		</div>

																	</div>
																</div>
																<?php require_once ('delete-confirm.php');?>
																<form method="POST" action="" style="display:inline">
																	<input type="hidden" name="id" value="<?php echo $research->id;  ?>">
																	<button class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Delete User" data-message="Are you sure you want to delete this?">
																		<i class="glyphicon glyphicon-trash"></i> Delete
																	</button>
																</form>
																<form method="POST" action="admin.php?action=editResearch&&id=<?php echo $research->id; ?>" style="display:inline">
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
									Add New Research
									</button>
									<!-- Modal -->
									<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h3 class="modal-title" id="exampleModalLabel">Add New Research</h3>
										</div>
										<div class="modal-body">
											<form enctype="multipart/form-data" method="post" action="addResearch.php">
												<label class="control-label" for="research"><font color="#EC0003">*</font> Research Title</label>
												<div class="form-group">
													<input type="text" class="form-control" id="research" name="research" placeholder="Input Program" required>
												</div>
												<label class="control-label" for="content"><font color="#EC0003">*</font> Content</label>
												<div class="form-group">
													<textarea id="content" name="content" rows="10" cols="80" required>
													</textarea>  
												</div>
												<label class="control-label" for="upload"><font color="#EC0003">*</font> Upload Research File</label>
												<div class="form-group">
													<input name='upload' type='file' accept="application/pdf" required/>
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
<!-- CK Editor -->
<script src="styles/admin/js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="styles/admin/js/plugins/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('content');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
    });
</script>
</body>

</html>

<?php
/**
 * Created by Chris on 9/29/2014 3:53 PM.
 */
if (Input::exists()) {
    if(Token::check(Input::get('token'))) {
		$uploads = new Uploads();
		$file = rand(1000,100000)."-".$_FILES['upload']['name'];
		$file_loc = $_FILES['upload']['tmp_name'];
		$file_size = $_FILES['upload']['size'];
		$file_type = $_FILES['upload']['type'];
		$folder="uploads/";
		
		// new file size in KB
		$new_size = $file_size/1024;  
		// new file size in KB
		
		// make file name in lower case
		$FileName = explode(".", $file);
		$new_file_name = ucwords(Input::get('name')) . '.' . end($FileName);
		// make file name in lower case
		
		$final_file=str_replace(' ','',$new_file_name);
		
		$uploaded = DB:: getInstance()->query("SELECT * FROM uploads");							
		foreach($uploaded->results() as $uploaded){
			$uploadedname = $uploaded->file;
		}
		if ($final_file == $uploadedname){
			Session::flash('filenamefound', 'Filename already exists. Upload again and use another name.');
			Redirect::to('admin.php?action=newupload');
		}else{
			if(move_uploaded_file($file_loc,$folder.$final_file))
			{
				try {
				$uploads->create(array(
					'name' => ucwords(Input::get('name')),
					'file' => $final_file,
					'type' => $file_type,
					'size' => $new_size,
				));
				Session::flash('fileUploaded', 'New file has been successfully uploaded.');
				Redirect::to('admin.php?action=newupload');
				} catch(Exception $e) {
					$error;
				}
			}
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
<!-- Theme style -->
<link href="styles/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<!-- Bootstrap Validator CSS -->
<link href="styles/admin/css/bootstrapValidator.min.css" rel="stylesheet">
<!-- DATA TABLES -->
<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<title>Tandag Water District</title>
</head>
<body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <?php include_once('navigation.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        New Upload
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="admin.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="admin.php?action=uploads">Uploads</a></li>
                        <li class="active">New Upload</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Add New File - <small><font color="#EC0003">*</font> required fields</small></h3>    
                                <div class="pull-right box-tools">
                                    <button class="btn btn-primary btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                    <button class="btn btn-primary btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                                </div><!-- /. tools -->                                
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <form id="addNewFile" action="" method="post" enctype="multipart/form-data">
										<?php if(Session::exists('fileUploaded')) { ?>
                                                 <div class="alert alert-success">
                                                    <i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('fileUploaded'); ?>
                                                 </div>
                                        <?php }?>
                                        <?php if(Session::exists('filenamefound')) { ?>
                                             <div class="alert alert-danger">
                                                <i class="glyphicon glyphicon-remove"></i> &nbsp;<?php echo Session::flash('filenamefound'); ?>
                                             </div>
                                    <?php }?>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3">
                                            <label class="control-label" for="name"><font color="#EC0003">*</font>Name</label>
                                            <div class="form-group">
                                                 <input type="text" class="form-control" id="name" name="name" placeholder="Name" style="text-transform:capitalize">
                                            </div>
                                        </div>
                                    </div>       
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3">
                                            <label class="control-label" for="image"><font color="#EC0003">*</font> Upload File</label>
                                            <div class="form-group">
                                                <input name='upload' type='file' />
                                            </div>
                                        </div>
                                    </div>                     
                                    <div class="clearfix"></div><hr />
                                    <div class="form-actions">
                                        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fa fa-plus-circle fa-fw "></i>&nbsp;Upload
                                        </button>
                                        <button type="button" class="btn btn" onclick="window.location='admin.php?action=uploads'">Cancel</button>
                                    </div>
                                    <br />
                                </form>                 
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
	var validator = $("#addNewFile").bootstrapValidator({
		fields : {
			name : {
				message : "Name is required",
				validators : {
					notEmpty :{
					},
				}
			},
			upload : {
				message : "This is required",
				validators : {
					notEmpty :{
					},
				}
			},
		}
	});
});
</script>
</body>
</html>      
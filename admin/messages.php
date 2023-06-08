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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
<link href="css/style.css" rel="stylesheet" id="bootstrap-css">
<style type="text/css">
.text_wrapper{

}
.edit_link{
	color:#0965F1;
}
.change{
	color:#0965F1;
}
.editbox{
	overflow: hidden; 
	border:solid 1px #0099CC; 
	width:190px; font-size:12px;
	padding:5px
}
</style>
<script src="js/jquery.min.js"></script>
<script src="js/chat.js"></script>
<!-- jQuery 2.0.2 -->
<script src="styles/admin/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="styles/admin/js/bootstrap.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="styles/admin/js/AdminLTE/app.js" type="text/javascript"></script>
<!-- Bootstrap Validator JS -->
<script src="styles/admin/js/bootstrapValidator.min.js"></script>
<script>
$(document).ready(function(){
	$("#cancelPass").click(function(){
		$("#change").show();
		$("#changePass").hide();
		$("#changepassmessage").show();				
	});
	
	$("#change").click(function(){
		$("#change").hide();
		$("#changePass").show();
		$("#changepassmessage").hide();			
	});
	
	$("#cancelUsername").click(function(){
		$("#editUsername").show();
		$("#changeUname").hide();
		$("#changeUsernameMessage").show();			
	});
	
	$("#editUsername").click(function(){
		$("#editUsername").hide();
		$("#changeUname").show();
		$("#changeUsernameMessage").hide();			
	});
});
</script>
<script type="text/javascript">
	$(document).ready(function() {
        var validator = $("#changePassword").bootstrapValidator({
			fields : {
				currentPassword : {
					validators : {
						notEmpty :{
							message : "Password is required."
						},
						stringLength :{
							min : 6,
							max : 35,
							message : "Password must be beetween 6 and 35 characters long"
						}
					}
				},
				newPassword : {
					validators : {
						notEmpty :{
							message : "New Password is required."
						},
						stringLength :{
							min : 6,
							max : 35,
							message : "Password must be beetween 6 and 35 characters long"
						}
					}
				},
				confirmNewPassword : {
					validators : {
						notEmpty :{
							message : "Confirm new password is required."
						},
						stringLength :{
							min : 6,
							max : 35,
							message : "Password must be beetween 6 and 35 characters long"
						},
						identical: {
                        	field: 'newPassword',
                        	message: 'This must be the same as the password'
                   	 	}
					}
				},
			}
		});
    });
</script>
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
                        Administrator Settings
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="admin.php"><i class="fa fa-tachometer-alt"></i> Home</a></li>
                        <li class="active">Administrator Settings</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
					<div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title"><i class="fa fa-envelope"></i>  Messages</h3>                           
                                </div><!-- /.box-header -->
                                <div class="box-body">
									<div class="chat">	
										<div id="frame">		
											<div id="sidepanel">
												<div id="profile">
													<div class="wrap">
														<?php
														$chat = new Chat();
														$loggedUser = $chat->getUserDetails($user->data()->id);
														$currentSession = '';
														foreach ($loggedUser as $loggedUser) {
															$currentSession = $loggedUser['current_session'];
															if ($loggedUser['avatar'] == ''){?>
																<img id="profile-img" src="admin/uploads/avatar/default.jpg ?>" class="online" alt="" />
															<?php }else{?>
																<img id="profile-img" src="admin/uploads/avatar/<?php echo $loggedUser['avatar']; ?>" class="online" alt="" />
															<?php }?>
															<p><?php echo $loggedUser['username']?></p>
															<div id="status-options">
																<ul>
																	<li id="status-online" class="active"><span class="status-circle"></span> <p>Online</p></li>
																	<li id="status-away"><span class="status-circle"></span> <p>Away</p></li>
																	<li id="status-busy"><span class="status-circle"></span> <p>Busy</p></li>
																	<li id="status-offline"><span class="status-circle"></span> <p>Offline</p></li>
																</ul>
															</div>
														<?php } ?>
													</div>
												</div>
												<hr>
												<div id="contacts">	
													<ul>
														<?php
														$user = new UserLogin();
														$chatUsers = $chat->chatUsers($user->data()->id);
														foreach ($chatUsers as $chatUser) {
															$status = 'offline';						
															if($chatUser['online']) {
																$status = 'online';
															}
															$activeUser = '';
															if($chatUser['id'] == $currentSession) {
																$activeUser = "active";
															}?>
															<li id="<?php echo $chatUser['id']; ?>" class="contact <?php echo $activeUse?>" data-touserid="<?php echo $chatUser['id']?>" data-tousername="<?php echo $chatUser['username']; ?>">
																<div class="wrap">
																	<span id="status_<?php echo $chatUser['id']; ?>" class="contact-status <?php echo $status; ?>"></span>
																	<?php if ($chatUser['avatar'] == ''){?>
																		<img src="admin/uploads/avatar/default.jpg" alt="" />
																	<?php }else{?>
																		<img src="admin/uploads/avatar/<?php echo $chatUser['avatar']; ?>" alt="" />
																	<?php }?>
																	<div class="meta">
																		<p class="name">
																			<?php echo $chatUser['username']; ?><span id="unread_<?php echo $chatUser['id']?>" class="unread"><?php echo $chat->getUnreadMessageCount($chatUser['id'], $user->data()->id);?></span>
																		</p>
																		<p class="preview"><span id="isTyping_<?php echo $chatUser['id']; ?>" class="isTyping"></span></p>
																	</div>
																</div>
															</li>
														<?php } ?>
													</ul>
												</div>
											</div>			
											<div class="content" id="content"> 
												<div class="contact-profile" id="userSection">	
												<?php
												$userDetails = $chat->getUserDetails($currentSession);
												foreach ($userDetails as $userDetails) {?>	
													<?php if ($userDetails['avatar'] == ''){?>
														<img src="admin/uploads/avatar/default.jpg" alt="" />
													<?php }else{?>
														<img src="admin/uploads/avatar/<?php echo $userDetails['avatar']; ?>" alt="" />
													<?php }?>
														<p><?php echo $userDetails['username']; ?></p>
												<?php }	?>						
												</div>
												<div class="messages" id="conversation">		
													<?php echo $chat->getUserChat($user->data()->id, $currentSession); ?>
												</div>
												<div class="message-input" id="replySection">				
													<div class="message-input" id="replyContainer">
														<div class="wrap">
															<input type="text" class="chatMessage" id="chatMessage<?php echo $currentSession; ?>" placeholder="Write your message..." />
															<button class="submit chatButton" id="chatButton<?php echo $currentSession; ?>"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>	
														</div>
													</div>					
												</div>
											</div>
										</div>
									</div>
								</div><!-- /.box -->
							</div><!-- /.box -->
						</div><!-- /.col -->
                    </div><!-- /.row (main row) -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


</body>
</html>


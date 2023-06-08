<header class="header">
            <a href="#" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                INHS
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
				<?php
					$group = DB:: getInstance()->get('groups', array('id', '=', $user->data()->permission));?>
				<span class="logo-title">
					<!-- Add the class icon to your logo image or logo icon to add the margining -->

				<?php
					foreach($group->results() as $group){
						echo 'You are logged in as ',$group->name;?>
				</span>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>
									<?php
									if ($user->isadmin()){
										echo $user->data()->username;
									}?> <i class="caret"></i>
								</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
									<?php if (!$user->data()->avatar == ''){?>
										<img src="admin/uploads/avatar/<?php echo $user->data()->avatar?>" class="img-circle" alt="User Image" />
									<?php }else{ ?>
										 <img src="admin/uploads/avatar/default.jpg" class="img-circle" alt="User Image" />
									<?php }?>
                                    <p>
                                        <?php
										if ($user->isadmin()){
											echo $user->data()->username;
										}?>
                                        <small><?php echo $group->name;?></small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="admin.php?action=settings" class="btn btn-default btn-flat">Account Settings</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
				<?php }?>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                       <h4 align="center">ADMINISTRATOR PAGE</h4>
                    </div>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
				<?php if($user->isSuperAdmin()) {?>
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="admin.php">
                                <i class="fa fa-tachometer-alt"></i>  <span>Dashboard</span>
                            </a>
                        </li>





						<li class="treeview">
                            <a href="#">
                               <i class="fa fa-building"></i>
                                <span>Library Management</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
								<li><a href="admin.php?action=startLibrarySystem"><i class="fa fa-angle-double-right"></i> Start System</a></li>
								<li><a href="admin.php?action=transactionHistory"><i class="fa fa-angle-double-right"></i> Transaction History</a></li>
								<li><a href="admin.php?action=listBooks"><i class="fa fa-angle-double-right"></i> Manage Books</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="admin.php?action=userList">
                                <i class="fa fa-home"></i> <span>Create User</span>
                            </a>
                        </li>
                    </ul>
				<?php }?>
				<?php if($user->isQaAdmin()) {?>
					<ul class="sidebar-menu">
                        <li class="active">
                            <a href="admin.php">
                                <i class="fa fa-tachometer-alt"></i>  <span>Dashboard</span>
                            </a>
                        </li>
						<li class="treeview">
                            <a href="#">
                               <i class="fa fa-university"></i>
                                <span>Quality Assurance</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
								<li><a href="admin.php?action=listPrograms"><i class="fa fa-angle-double-right"></i> Program Lists</a></li>
								<li><a href="admin.php?action=listProgramType"><i class="fa fa-angle-double-right"></i> Program Type</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="admin.php?action=userList">
                                <i class="fa fa-home"></i> <span>Create User</span>
                            </a>
                        </li>
                    </ul>
				<?php }?>
				<?php if($user->isElAdmin()) {?>
					<ul class="sidebar-menu">
                        <li class="active">
                            <a href="admin.php">
                                <i class="fa fa-tachometer-alt"></i>  <span>Dashboard</span>
                            </a>
                        </li>
						<li class="treeview">
                            <a href="#">
                                <i class="fa fa-book"></i>
                                <span>E-Learning</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="admin.php?action=listTopics"><i class="fa fa-angle-double-right"></i> Topic Lists</a></li>
								<li><a href="admin.php?action=listContents"><i class="fa fa-angle-double-right"></i> Manage Topic Contents</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-home"></i> <span>San Pedro (On Progress)</span>
                            </a>
                        </li>
                    </ul>
				<?php }?>
				<?php if($user->isTeacher()) {?>
					<ul class="sidebar-menu">
                        <li class="active">
                            <a href="admin.php">
                                <i class="fa fa-tachometer-alt"></i>  <span>Dashboard</span>
                            </a>
                        </li>
						<li class="treeview">
                            <a href="#">
                               <i class="fa fa-qrcode"></i>
                                <span>Classroom Attendance</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
								<li><a href="admin.php?action=startAttendance"><i class="fa fa-angle-double-right"></i> Start Attendance</a></li>
								<li><a href="admin.php?action=attendanceReport"><i class="fa fa-angle-double-right"></i> Attendance Report</a></li>
								<li><a href="admin.php?action=listClass"><i class="fa fa-angle-double-right"></i> Manage Class</a></li>
								<li><a href="admin.php?action=listStudents"><i class="fa fa-angle-double-right"></i> Manage Students</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-home"></i> <span>San Pedro (On Progress)</span>
                            </a>
                        </li>
                    </ul>
				<?php }?>
				<?php if($user->isOjtAdmin()) {?>
					<ul class="sidebar-menu">
                        <li class="active">
                            <a href="admin.php">
                                <i class="fa fa-tachometer-alt"></i>  <span>Dashboard</span>
                            </a>
                        </li>
						<li class="treeview">
                            <a href="#">
                               <i class="fa fa-group"></i>
                                <span>On-The-Job Training</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
								<li><a href="admin.php?action=listTrainees"><i class="fa fa-angle-double-right"></i> Manage Trainees</a></li>
								<li><a href="admin.php?action=listRequirements"><i class="fa fa-angle-double-right"></i> Downloadables (OJT Requirements)</a></li>
                            </ul>
                        </li>
						<li>
                            <a href="admin.php?action=messages">
                                <i class="fa fa-envelope"></i> <span>Messages</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-home"></i> <span>San Pedro (On Progress)</span>
                            </a>
                        </li>
                    </ul>
				<?php }?>
				<?php if($user->isLibraryAdmin()) {?>
					<ul class="sidebar-menu">
                        <li class="active">
                            <a href="admin.php">
                                <i class="fa fa-tachometer-alt"></i>  <span>Dashboard</span>
                            </a>
                        </li>
						<li class="treeview">
                            <a href="#">
                               <i class="fa fa-building"></i>
                                <span>Library Management</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
								<li><a href="admin.php?action=startLibrarySystem"><i class="fa fa-angle-double-right"></i> Start System</a></li>
								<li><a href="admin.php?action=transactionHistory"><i class="fa fa-angle-double-right"></i> Transaction History</a></li>
								<li><a href="admin.php?action=listBooks"><i class="fa fa-angle-double-right"></i> Manage Books</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-home"></i> <span>San Pedro (On Progress)</span>
                            </a>
                        </li>
                    </ul>
				<?php }?>
				<?php if($user->isResearchAdmin()) {?>
					<ul class="sidebar-menu">
						<li class="active">
                            <a href="admin.php?action=listResearch">
                                <i class="fa fa-archive"></i> <span>Research</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.php">
                                <i class="fa fa-home"></i> <span>View Site</span>
                            </a>
                        </li>
                    </ul>
				<?php }?>
				<?php if($user->isExtensionAdmin()) {?>
					<ul class="sidebar-menu">
						<li class="active">
                            <a href="admin.php?action=listExtension">
                                <i class="fa fa-file-archive"></i> <span>Extension</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.php">
                                <i class="fa fa-home"></i> <span>View Site</span>
                            </a>
                        </li>
                    </ul>
				<?php }?>
                </section>
                <!-- /.sidebar -->
            </aside>

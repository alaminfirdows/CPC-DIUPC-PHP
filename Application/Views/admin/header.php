<!DOCTYPE html>
<html lang="en">

<head>
    <title>CPC Admin - DIU CPC PC</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/styles/admin.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="app sidebar-mini rtl">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="<?= base_url('admin'); ?>">CPC Admin</a>
        <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar"
            aria-label="Hide Sidebar"></a>
        <!-- Navbar Right Menu-->
        <ul class="app-nav">
            <!-- User Menu-->
            <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown"
                    aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
                <ul class="dropdown-menu settings-menu dropdown-menu-right">
                    <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-cog fa-lg"></i> Settings</a></li>
                    <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-user fa-lg"></i> Profile</a></li>
                    <li><a class="dropdown-item" href="page-login.html"><i class="fa fa-sign-out fa-lg"></i> Logout</a>
                    </li>
                </ul>
            </li>
        </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <div class="app-sidebar__user"><img class="app-sidebar__user-avatar"
                src="<?= base_url('assets/img/avatar.png'); ?>" alt="User Image" style="max-height: 40px">
            <div>
                <p class="app-sidebar__user-name"><?= $_SESSION['firstName'] . ' ' . $_SESSION['lastName'] ?></p>
                <p class="app-sidebar__user-designation">Admin</p>
            </div>
        </div>
        <ul class="app-menu">
            <li><a class="app-menu__item active" href="<?= base_url('admin'); ?>"><i
                        class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a>
            </li>
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i
                        class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Semester
                        Activities</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="<?= base_url('admin'); ?>/semester_activities"><i
                                class="icon fa fa-circle-o"></i> All Semester Activities</a></li>
                    <li><a class="treeview-item" href="<?= base_url('admin'); ?>/semester_activities/add"><i
                                class="icon fa fa-circle-o"></i> Add New</a></li>
                </ul>
            </li>
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i
                        class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Events</span><i
                        class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="<?= base_url('admin'); ?>/events"><i
                                class="icon fa fa-circle-o"></i> All Events</a></li>
                    <li><a class="treeview-item" href="<?= base_url('admin'); ?>/events/add"><i
                                class="icon fa fa-circle-o"></i> Add New</a></li>
                </ul>
            </li>
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i
                        class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Category</span><i
                        class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="<?= base_url('admin'); ?>/categories"><i
                                class="icon fa fa-circle-o"></i> All Categories</a></li>
                    <li><a class="treeview-item" href="<?= base_url('admin'); ?>/categories/add"><i
                                class="icon fa fa-circle-o"></i> Add Category</a></li>
                </ul>
            </li>
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i
                        class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Semester</span><i
                        class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="<?= base_url('admin'); ?>/semesters"><i
                                class="icon fa fa-circle-o"></i> All Semesters</a></li>
                    <li><a class="treeview-item" href="<?= base_url('admin'); ?>/semesters/add"><i
                                class="icon fa fa-circle-o"></i> Add Semester</a></li>
                </ul>
            </li>
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i
                        class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Users</span><i
                        class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="<?= base_url('admin'); ?>/users"><i
                                class="icon fa fa-circle-o"></i> All Users</a></li>
                    <!-- <li><a class="treeview-item" href="<?= base_url('admin'); ?>/users/add"><i class="icon fa fa-circle-o"></i> Add User</a></li> -->
                </ul>
            </li>
            <li><a class="app-menu__item" href="<?= base_url(); ?>" target="_blank"><i
                        class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Visit</span></a></li>
            <li><a class="app-menu__item" href="<?= base_url('auth/logout'); ?>"><i
                        class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Log Out</span></a></li>
        </ul>
    </aside>
    <main class="app-content">
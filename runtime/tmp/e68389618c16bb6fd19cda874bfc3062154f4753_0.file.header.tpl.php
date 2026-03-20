<?php
/* Smarty version 3.1.34-dev-7, created on 2026-03-20 11:36:38
  from 'C:\Users\admin\Documents\company\CompanyToolDevelopment\BugRepoter_0x727\index\view\header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_69bcc0c63fecb4_44923230',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e68389618c16bb6fd19cda874bfc3062154f4753' => 
    array (
      0 => 'C:\\Users\\admin\\Documents\\company\\CompanyToolDevelopment\\BugRepoter_0x727\\index\\view\\header.tpl',
      1 => 1773929768,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69bcc0c63fecb4_44923230 (Smarty_Internal_Template $_smarty_tpl) {
?><!doctype html>
<html lang="en" style="overflow: hidden;">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Responsive Bootstrap4 Dashboard Template">
        <meta name="author" content="ParkerThemes">
        <link rel="shortcut icon" href="./public/index/img/fav.png">
        <title><?php echo $_smarty_tpl->tpl_vars['system_config']->value['name'];?>
</title>
        <link rel="stylesheet" href="./public/index/css/bootstrap.min.css">
        <link rel="stylesheet" href="./public/index/fonts/style.css">
        <link rel="stylesheet" href="./public/index/css/main.css">
        <link rel="stylesheet" href="./public/index/vendor/megamenu/css/megamenu.css">
        <link rel="stylesheet" href="./public/index/vendor/search-filter/search-filter.css">
        <link rel="stylesheet" href="./public/index/vendor/search-filter/custom-search-filter.css">
        <?php echo '<script'; ?>
 src="./public/index/js/jquery.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="./public/index/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="./public/index/js/modernizr.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="./public/index/js/moment.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="./public/layer/layer.js"><?php echo '</script'; ?>
>
        <style>
            table.dataTable td .actions{
                display: -webkit-inline-box !important;
            }
        </style>
    </head>
    <body>
        <div class="page-wrapper">
            <nav class="sidebar-wrapper">
                <div class="sidebar-tabs">
                    <div class="nav" role="tablist" aria-orientation="vertical">
                        <a href="#" class="logo">
                            <img src="./public/index/img/logo.jpg" alt="Uni Pro Admin">
                        </a>
                        <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['url_path']->value == "IndexControllers") {?>active<?php }?>" id="home-tab" data-bs-toggle="tab" href="#tab-home" role="tab" aria-controls="tab-home" aria-selected="true" onclick="javascript:window.location.href='<?php echo $_smarty_tpl->tpl_vars['menu']->value['home'];?>
'">
                            <i class="icon-home2"></i>
                            <span class="nav-link-text">首页</span>
                        </a>
                        <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['url_path']->value == "ProductsControllers") {?>active<?php }?>" id="product-tab" data-bs-toggle="tab" href="#tab-product" role="tab" aria-controls="tab-product" aria-selected="false"  onclick="javascript:window.location.href='<?php echo $_smarty_tpl->tpl_vars['menu']->value['products_index'];?>
'">
                            <i class="icon-layers2"></i>
                            <span class="nav-link-text">项目</span>
                        </a>
                        <?php if ($_smarty_tpl->tpl_vars['user_info']->value['id'] == "1") {?>
                            <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['url_path']->value == "UserControllers") {?>active<?php }?>" id="authentication-tab" data-bs-toggle="tab" href="#tab-authentication" role="tab" aria-controls="tab-authentication" aria-selected="false"  onclick="javascript:window.location.href='<?php echo $_smarty_tpl->tpl_vars['menu']->value['user_member'];?>
'">
                                <i class="icon-users"></i>
                                <span class="nav-link-text">用户管理</span>
                            </a>
                        <?php } else { ?>
                            <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['url_path']->value == "UserControllers") {?>active<?php }?>" id="authentication-tab" data-bs-toggle="tab" href="#tab-authentication" role="tab" aria-controls="tab-authentication" aria-selected="false"  onclick="javascript:window.location.href='<?php echo $_smarty_tpl->tpl_vars['menu']->value['user_index'];?>
'">
                                <i class="icon-user1"></i>
                                <span class="nav-link-text">个人中心</span>
                            </a>
                        <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['user_info']->value['id'] == "1") {?>
                            <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['url_path']->value == "LogControllers" || $_smarty_tpl->tpl_vars['url_path']->value == "SetupControllers") {?>active<?php }?>" id="log-tab" data-bs-toggle="tab" href="#tab-log" role="tab" aria-controls="tab-log" aria-selected="false" onclick="javascript:window.location.href='<?php echo $_smarty_tpl->tpl_vars['menu']->value['setup_index'];?>
'">
                                <i class="icon-settings1"></i>
                                <span class="nav-link-text">网站管理</span>
                            </a>
                        <?php }?>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade <?php if ($_smarty_tpl->tpl_vars['url_path']->value == "IndexControllers") {?>show active<?php }?>" id="tab-home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="tab-pane-header">
                                首页
                            </div>
                            <div class="sidebarMenuScroll">
                                <div class="sidebar-menu">
                                    <ul>
                                        <li>
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['menu']->value['home'];?>
" <?php if ($_smarty_tpl->tpl_vars['url_path']->value == "IndexControllers" && $_smarty_tpl->tpl_vars['url_path_action']->value == "index") {?> class="current-page" <?php }?>>首页</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['menu']->value['index_about_us'];?>
" <?php if ($_smarty_tpl->tpl_vars['url_path']->value == "IndexControllers" && $_smarty_tpl->tpl_vars['url_path_action']->value == "about_us") {?> class="current-page" <?php }?>>关于我们</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade <?php if (($_smarty_tpl->tpl_vars['url_path']->value == "ProductsControllers" || $_smarty_tpl->tpl_vars['url_path']->value == "DocxControllers")) {?>show active<?php }?>" id="tab-product" role="tabpanel" aria-labelledby="product-tab">
                            <div class="tab-pane-header">
                                项目
                            </div>
                            <div class="sidebarMenuScroll">
                                <div class="sidebar-menu">
                                    <ul>
                                        <li>
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['menu']->value['products_index'];?>
" <?php if ($_smarty_tpl->tpl_vars['url_path']->value == "ProductsControllers" && ($_smarty_tpl->tpl_vars['url_path_action']->value == "index" || $_smarty_tpl->tpl_vars['url_path_action']->value == "add_index" || $_smarty_tpl->tpl_vars['url_path_action']->value == "edit_index" || $_smarty_tpl->tpl_vars['url_path_action']->value == "repair_index" || $_smarty_tpl->tpl_vars['url_path_action']->value == "repair_view_index")) {?> class="current-page" <?php }?>>漏洞列表</a>
                                        </li>
                                        <?php if ($_smarty_tpl->tpl_vars['user_info']->value['id'] == "1") {?>
                                            <li>
                                                <a href="<?php echo $_smarty_tpl->tpl_vars['menu']->value['products_classification'];?>
" <?php if ($_smarty_tpl->tpl_vars['url_path']->value == "ProductsControllers" && ($_smarty_tpl->tpl_vars['url_path_action']->value == "classification" || $_smarty_tpl->tpl_vars['url_path_action']->value == "add_classification" || $_smarty_tpl->tpl_vars['url_path_action']->value == "edit_classification")) {?> class="current-page" <?php }?>>项目列表</a>
                                            </li>
                                            <li>
                                                <a href="<?php echo $_smarty_tpl->tpl_vars['menu']->value['products_template'];?>
" <?php if ($_smarty_tpl->tpl_vars['url_path']->value == "DocxControllers" && ($_smarty_tpl->tpl_vars['url_path_action']->value == "template" || $_smarty_tpl->tpl_vars['url_path_action']->value == "add_template" || $_smarty_tpl->tpl_vars['url_path_action']->value == "edit_template")) {?> class="current-page" <?php }?>>模板列表</a>
                                            </li>
                                        <?php }?>
                                        <li>
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['menu']->value['products_loophole_classification'];?>
" <?php if ($_smarty_tpl->tpl_vars['url_path']->value == "ProductsControllers" && ($_smarty_tpl->tpl_vars['url_path_action']->value == "loophole_classification" || $_smarty_tpl->tpl_vars['url_path_action']->value == "add_loophole_classification" || $_smarty_tpl->tpl_vars['url_path_action']->value == "edit_loophole_classification")) {?> class="current-page" <?php }?>>漏洞分类</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade <?php if ($_smarty_tpl->tpl_vars['url_path']->value == "UserControllers") {?>show active<?php }?>" id="tab-authentication" role="tabpanel" aria-labelledby="authentication-tab">
                            <div class="tab-pane-header">
                                用户管理
                            </div>
                            <div class="sidebarMenuScroll">
                                <div class="sidebar-menu">
                                    <ul>
                                        <?php if ($_smarty_tpl->tpl_vars['user_info']->value['id'] == "1") {?>
                                            <li>
                                                <a href="<?php echo $_smarty_tpl->tpl_vars['menu']->value['user_member'];?>
" <?php if ($_smarty_tpl->tpl_vars['url_path']->value == "UserControllers" && $_smarty_tpl->tpl_vars['url_path_action']->value == "member" || $_smarty_tpl->tpl_vars['url_path_action']->value == "add_member" || $_smarty_tpl->tpl_vars['url_path_action']->value == "edit_member") {?> class="current-page" <?php }?>>用户管理</a>
                                            </li>
                                        <?php }?>
                                        <li>
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['menu']->value['user_index'];?>
" <?php if ($_smarty_tpl->tpl_vars['url_path']->value == "UserControllers" && $_smarty_tpl->tpl_vars['url_path_action']->value == "index") {?> class="current-page" <?php }?>>个人中心</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php if ($_smarty_tpl->tpl_vars['user_info']->value['id'] == "1") {?>
                            <div class="tab-pane fade <?php if ($_smarty_tpl->tpl_vars['url_path']->value == "LogControllers" || $_smarty_tpl->tpl_vars['url_path']->value == "SetupControllers") {?>show active<?php }?>" id="tab-log" role="tabpanel" aria-labelledby="log-tab">
                                <div class="tab-pane-header">
                                    网站管理
                                </div>
                                <div class="sidebarMenuScroll">
                                    <div class="sidebar-menu">
                                        <ul>
                                            <li>
                                                <a href="<?php echo $_smarty_tpl->tpl_vars['menu']->value['setup_index'];?>
" <?php if ($_smarty_tpl->tpl_vars['url_path']->value == "SetupControllers" && $_smarty_tpl->tpl_vars['url_path_action']->value == "index") {?> class="current-page" <?php }?>>网站设置</a>
                                            </li>
                                            <li>
                                                <a href="<?php echo $_smarty_tpl->tpl_vars['menu']->value['log_index'];?>
" <?php if ($_smarty_tpl->tpl_vars['url_path']->value == "LogControllers" && $_smarty_tpl->tpl_vars['url_path_action']->value == "index") {?> class="current-page" <?php }?>>网站日志</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </nav>
            <div class="main-container">
                <div class="page-header">
                    <div class="row gutters">
                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-6 col-9">
                            <div class="search-container">
                                <div class="toggle-sidebar" id="toggle-sidebar">
                                    <i class="icon-menu"></i>
                                </div>
                                <div class="ui fluid category search">
                                    <div class="ui icon input">
                                        <input class="prompt" type="text" placeholder="Search">
                                        <i class="search icon icon-search1"></i>
                                    </div>
                                    <div class="results"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-3">

                            <!-- Header actions start -->
                            <ul class="header-actions">
                                <li class="dropdown">
                                    <a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
                                        <span class="avatar">
                                            <img src="<?php ob_start();
echo $_smarty_tpl->tpl_vars['user_info']->value['img'];
$_prefixVariable2 = ob_get_clean();
echo $_prefixVariable2;?>
" onerror="javascript:this.src='./public/index/img/user.svg';" alt="User Avatar">
                                            <span class=""></span>
                                        </span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end md" aria-labelledby="userSettings">
                                        <div class="header-profile-actions">
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['menu']->value['user_index'];?>
"><i class="icon-settings1"></i>个人中心</a>
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['menu']->value['login_logout'];?>
"><i class="icon-log-out1"></i>退出</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <!-- Header actions end -->
                        </div>
                    </div>
                </div>
                <div class="content-wrapper-scroll">
<?php }
}

<?php
/* Smarty version 3.1.34-dev-7, created on 2026-03-20 00:12:45
  from 'C:\Users\admin\Documents\company\CompanyToolDevelopment\BugRepoter_0x727\index\view\login\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_69bc207dec4183_86275832',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fc17f77a21491ccd5b960867dd1fc3256c1e8ac5' => 
    array (
      0 => 'C:\\Users\\admin\\Documents\\company\\CompanyToolDevelopment\\BugRepoter_0x727\\index\\view\\login\\index.tpl',
      1 => 1773929768,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69bc207dec4183_86275832 (Smarty_Internal_Template $_smarty_tpl) {
?><!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="UniPro App">
        <meta name="author" content="ParkerThemes">
        <link rel="shortcut icon" href="./public/index/img/fav.png" />
        <title><?php echo $_smarty_tpl->tpl_vars['system_config']->value['name'];?>
</title>
        <link rel="stylesheet" href="./public/index/css/bootstrap.min.css">
        <link rel="stylesheet" href="./public/index/css/main.css">
    </head>
    <body class="authentication">
        <div id="loading-wrapper">
            <div class="spinner-border"></div>
            加载中...
        </div>
        <div class="login-container">
            <div class="container-fluid h-100">
            <div class="row g-0 h-100">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="login-about">
                        <div class="slogan">
                            <span>欢迎登陆0x727自动化编写报告平台</span>
                        </div>
                        <div class="about-desc">
                            Welcome to the 0x727 automated report writing platform to create the troubles and troubles of security service personnel in writing reports. Let me help you。
                        </div>

                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="login-wrapper">
                        <form action="#" method="post">
                            <div class="login-screen">
                                <div class="login-body">
                                    <a href="#" class="login-logo">
                                        <img src="./public/index/img/logo.svg" alt="iChat">
                                    </a>
                                    <h6>欢迎回来，<br>请登录您的帐户。</h6>
                                    <div class="field-wrapper">
                                        <input type="text" name="name">
                                        <div class="field-placeholder">账户</div>
                                    </div>
                                    <div class="field-wrapper mb-3">
                                        <input type="password" name="password">
                                        <div class="field-placeholder">密码</div>
                                    </div>
                                    <div class="field-wrapper mb-3">
                                        <div style="position: absolute;right: 0px;">
                                            <a href="javascript:void(0);">
                                                <img id="verify_img" src="<?php echo $_smarty_tpl->tpl_vars['verify_img']->value;?>
" alt="点击刷新" />
                                            </a>
                                        </div>
                                        <input type="text" name="verify" maxlength="4">
                                        <div class="field-placeholder">验证码</div>
                                    </div>
                                    <div class="actions">
                                        <button type="button" class="btn btn-primary" id="go_login">登陆</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Row end -->
            </div>
        </div>
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
 src="./public/index/js/main.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="./public/layer/layer.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
>
            $(function() {
                $("#verify_img").click(function() {
                    var src = "<?php echo $_smarty_tpl->tpl_vars['verify_img']->value;?>
";
                    $(this).attr("src", src);
                });
                $("#go_login").click(function() {
                    var name = $("input[name='name']").val();
                    var password = $("input[name='password']").val();
                    var verify = $("input[name='verify']").val();

                    if(name==""){
                        layer.msg('用户名不能为空', {
                            icon: 2
                        }, function(){
                            
                        });
                        return false
                    }
                    if(password==""){
                        layer.msg('密码不能为空', {
                            icon: 2
                        }, function(){
                            
                        });
                        return false
                    }
                    if(verify==""){
                        layer.msg('验证码不能为空', {
                            icon: 2
                        }, function(){
                            
                        });
                        return false
                    }
                    $.post("<?php echo $_smarty_tpl->tpl_vars['ajax_from']->value;?>
",{
                        name:name,
                        password:password,
                        verify:verify,
                    },function(data){
                        if(data.status == '1'){
                            layer.msg(data.msg, {
                                icon: 1
                            }, function(){
                                window.location.href = "<?php echo $_smarty_tpl->tpl_vars['home_index']->value;?>
"
                            });
                        } else {
                            layer.msg(data.msg, {
                                icon: 2
                            }, function(){
                            });
                        }
                        $("input[name='verify']").val("");
                        $("#verify_img").click();
                    },"json");
                })
            })
        <?php echo '</script'; ?>
>
    </body>
</html>
<?php }
}

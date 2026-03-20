<?php
/* Smarty version 3.1.34-dev-7, created on 2026-03-20 15:11:00
  from 'C:\Users\admin\Documents\company\CompanyToolDevelopment\BugRepoter_0x727\index\view\user\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_69bcf3043bc2f9_85983706',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0142342ba68776e7c0e612da2c5c166aa7b5b2f0' => 
    array (
      0 => 'C:\\Users\\admin\\Documents\\company\\CompanyToolDevelopment\\BugRepoter_0x727\\index\\view\\user\\index.tpl',
      1 => 1772504845,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../header.tpl' => 1,
    'file:../footer.tpl' => 1,
  ),
),false)) {
function content_69bcf3043bc2f9_85983706 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<link rel="stylesheet" href="./public/index/vendor/dropzone/dropzone.min.css" />
<div class="content-wrapper">
	<div class="row gutters">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="card">
				<div class="card-header-lg">
					<h4>账户设置</h4>
				</div>
				<div class="card-body">
	                <div class="row gutters">
	                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
	                        <div class="row gutters">
	                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
	                                <img src="<?php ob_start();
echo $_smarty_tpl->tpl_vars['user_info']->value['img'];
$_prefixVariable1 = ob_get_clean();
echo $_prefixVariable1;?>
" onerror="javascript:this.src='./public/index/img/user.svg';" class="img-fluid change-img-avatar" alt="Image">
	                            </div>
	                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
	                                <div id="dropzone-sm" class="mb-4">
	                                    <form action="<?php echo $_smarty_tpl->tpl_vars['menu']->value['user_img'];?>
" class="dropzone needsclick" id="upload">
	                                        <div class="dz-message needsclick">
	                                            <button type="button" class="dz-button">修改头像</button>
	                                        </div>
	                                    </form>
	                                </div>
	                            </div>
	                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
	                                <div class="field-wrapper">
	                                    <input type="text" class="form-control" placeholder="请输入昵称" value="<?php ob_start();
echo $_smarty_tpl->tpl_vars['user_info']->value['username'];
$_prefixVariable2 = ob_get_clean();
echo $_prefixVariable2;?>
" disabled="disabled">
	                                    <div class="field-placeholder">用户昵称</div>
	                                </div>
	                            </div>
	                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
	                                <div class="field-wrapper">
	                                    <input type="password" id="password" class="form-control" placeholder="请输入密码">
	                                    <div class="field-placeholder">用户密码</div>
	                                </div>
	                            </div>
	                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
	                                <div class="field-wrapper">
	                                    <input type="text" id="email" class="form-control" placeholder="请输入邮箱" value="<?php ob_start();
echo $_smarty_tpl->tpl_vars['user_info']->value['email'];
$_prefixVariable3 = ob_get_clean();
echo $_prefixVariable3;?>
">
	                                    <div class="field-placeholder">邮箱</div>
	                                </div>
	                            </div>
	                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
	                                <div class="field-wrapper">
	                                    <input type="text" id="phone" class="form-control" placeholder="请输入手机号" value="<?php ob_start();
echo $_smarty_tpl->tpl_vars['user_info']->value['phone'];
$_prefixVariable4 = ob_get_clean();
echo $_prefixVariable4;?>
">
	                                    <div class="field-placeholder">手机号</div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							<button class="btn btn-primary mb-3" onclick="save()">保存</button>
						</div>
	                </div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo '<script'; ?>
 src="./public/index/vendor/dropzone/dropzone.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
	function save()
	{
		var password = $("#password").val();
		var email = $("#email").val();
		var phone = $("#phone").val();
		var token = "<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
";
		$.post("<?php echo $_smarty_tpl->tpl_vars['menu']->value['user_index'];?>
",{
			password:password,
			email:email,
			phone:phone,
			token:token,
		},function(data){
			if(data.status == 0){
				layer.msg(data.msg, {
					icon: 2
				}, function(){

				});
			} else {
				layer.msg(data.msg, {
					icon: 1
				}, function(){
					if(password){
						window.location.href = "<?php echo $_smarty_tpl->tpl_vars['menu']->value['login_logout'];?>
"
					} else {
						window.location.reload();
					}
				});
			}
		},"json")
	}
<?php echo '</script'; ?>
>
<?php $_smarty_tpl->_subTemplateRender("file:../footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}

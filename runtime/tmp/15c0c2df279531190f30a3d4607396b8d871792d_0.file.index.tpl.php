<?php
/* Smarty version 3.1.34-dev-7, created on 2026-03-20 15:10:51
  from 'C:\Users\admin\Documents\company\CompanyToolDevelopment\BugRepoter_0x727\index\view\setup\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_69bcf2fb043579_52828057',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '15c0c2df279531190f30a3d4607396b8d871792d' => 
    array (
      0 => 'C:\\Users\\admin\\Documents\\company\\CompanyToolDevelopment\\BugRepoter_0x727\\index\\view\\setup\\index.tpl',
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
function content_69bcf2fb043579_52828057 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div class="content-wrapper">
	<div class="row gutters">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="card">
				<div class="card-header-lg">
					<h4>网站设置</h4>
				</div>
				<div class="card-body">
	                <div class="row gutters">
	                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
	                        <div class="row gutters">
	                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
	                                <div class="field-wrapper">
	                                    <input type="text" class="form-control" placeholder="请输入标题" value="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
" name="name">
	                                    <div class="field-placeholder">网站标题</div>
	                                    <div class="form-text">
	                                        请输入网站标题
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
	                                <div class="field-wrapper">
	                                    <div class="checkbox-container form-control">
	                                        <div class="form-check form-check-inline">
	                                            <input class="form-check-input" type="radio" name="repair_time" value="0" <?php if ($_smarty_tpl->tpl_vars['legitimate_type']->value == 0) {?> checked="checked" <?php }?>>
	                                            <label class="form-check-label" for="inlineRadio1">关闭模式</label>
	                                        </div>
	                                        <div class="form-check form-check-inline">
	                                            <input class="form-check-input" type="radio" name="repair_time" value="1" <?php if ($_smarty_tpl->tpl_vars['legitimate_type']->value == 1) {?> checked="checked" <?php }?>>
	                                            <label class="form-check-label" for="inlineRadio2">动态防护后台地址模式</label>
	                                        </div>
	                                        <div class="form-check form-check-inline">
	                                            <input class="form-check-input" type="radio" name="repair_time" value="2" <?php if ($_smarty_tpl->tpl_vars['legitimate_type']->value == 2) {?> checked="checked" <?php }?>>
	                                            <label class="form-check-label" for="inlineRadio2">限制IP模式</label>
	                                        </div>
	                                    </div>
	                                    <div class="field-placeholder">安全模式 <span class="text-danger">*</span></div>
	                                    <div class="form-text">
	                                        请选择安全模式
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
	                                <div class="field-wrapper">
	                                    <textarea class="form-control" rows="5" name="legitimate_ip" placeholder="127.0.0.1
127.0.0.2" rows="5"><?php echo $_smarty_tpl->tpl_vars['legitimate_ip']->value;?>
</textarea>
	                                    <div class="field-placeholder">限制IP</div>
	                                    <div class="form-text">
	                                        请输入限制IP
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
	                                <div class="field-wrapper">
	                                    <div class="checkbox-container form-control">
	                                        <div class="form-check form-check-inline">
	                                            <input class="form-check-input" type="radio" name="config_debug" value="0" <?php if ($_smarty_tpl->tpl_vars['config_debug']->value == 0) {?> checked="checked" <?php }?>>
	                                            <label class="form-check-label" for="inlineRadio1">关闭Debug模式</label>
	                                        </div>
	                                        <div class="form-check form-check-inline">
	                                            <input class="form-check-input" type="radio" name="config_debug" value="1" <?php if ($_smarty_tpl->tpl_vars['config_debug']->value == 1) {?> checked="checked" <?php }?>>
	                                            <label class="form-check-label" for="inlineRadio2">开启Debug模式</label>
	                                        </div>
	                                    </div>
	                                    <div class="field-placeholder">Debug模式 <span class="text-danger">*</span></div>
	                                    <div class="form-text">
	                                        请选择Debug模式
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
	                                <div class="field-wrapper">
	                                    <div class="checkbox-container form-control">
	                                        <div class="form-check form-check-inline">
	                                            <input class="form-check-input" type="radio" name="encryption_url" value="0" <?php if ($_smarty_tpl->tpl_vars['encryption_url']->value == 0) {?> checked="checked" <?php }?>>
	                                            <label class="form-check-label" for="inlineRadio1">关闭URL加密</label>
	                                        </div>
	                                        <div class="form-check form-check-inline">
	                                            <input class="form-check-input" type="radio" name="encryption_url" value="1" <?php if ($_smarty_tpl->tpl_vars['encryption_url']->value == 1) {?> checked="checked" <?php }?>>
	                                            <label class="form-check-label" for="inlineRadio2">开启URL加密</label>
	                                        </div>
	                                    </div>
	                                    <div class="field-placeholder">URL加密模式 <span class="text-danger">*</span></div>
	                                    <div class="form-text">
	                                        请选择URL加密模式
	                                    </div>
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
>
	function save()
	{
		var legitimate_ip = $("textarea[name='legitimate_ip']").val();
		var repair_time = $("input[name='repair_time']:checked").val();
		var config_debug = $("input[name='config_debug']:checked").val();
		var encryption_url = $("input[name='encryption_url']:checked").val();
		var name = $("input[name='name']").val();
		var token = "<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
";
		$.post("<?php echo $_smarty_tpl->tpl_vars['menu']->value['setup_index'];?>
",{
			legitimate_ip:legitimate_ip,
			name:name,
			repair_time:repair_time,
			config_debug:config_debug,
			encryption_url:encryption_url,
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
					window.location.reload();
				});
			}
		},"json")
	}
<?php echo '</script'; ?>
>
<?php $_smarty_tpl->_subTemplateRender("file:../footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}

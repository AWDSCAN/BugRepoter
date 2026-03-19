<?php
/* Smarty version 3.1.34-dev-7, created on 2026-03-19 20:35:47
  from 'C:\Users\admin\Documents\company\CompanyToolDevelopment\BugRepoter_0x727\index\view\products\add_classification.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_69bbeda339f651_01552383',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2990faf6084917ad8977f4ad1c2102dc65aef718' => 
    array (
      0 => 'C:\\Users\\admin\\Documents\\company\\CompanyToolDevelopment\\BugRepoter_0x727\\index\\view\\products\\add_classification.tpl',
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
function content_69bbeda339f651_01552383 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <div class="content-wrapper">
        <div class="row gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">添加项目分类</div>
                    </div>
                    <div class="card-body">
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="field-wrapper">
                                    <input class="form-control" type="text" name="name" value="">
                                    <div class="field-placeholder">项目名称 <span class="text-danger">*</span></div>
                                    <div class="form-text">
                                        请输入项目名称
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="field-wrapper">
                                    <div class="field-wrapper">
                                        <select class="select-single js-states" title="上级项目分类" data-live-search="true" name="pid">
                                            <option value="0">父级</option>
                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list']->value, 'vo');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['vo']->value) {
?>
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['vo']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['vo']->value['title'];?>
</option>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                        </select>
                                        <div class="field-placeholder">上级项目分类</div>
                                    </div>
                                    <div class="form-text">
                                        请选择项目分类
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <input type="hidden" name="token" value="<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
">
                                <button class="btn btn-primary" type="button" id="go_submit">提交</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="./public/index/vendor/bs-select/bs-select.css" />
    <?php echo '<script'; ?>
 src="./public/index/vendor/bs-select/bs-select.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="./public/index/vendor/bs-select/bs-select-custom.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
>
        $(function() {
            $("#go_submit").click(function() {
                var name = $("input[name='name']").val();
                var pid = $("select[name='pid']").find("option:selected").val();
                var token = $("input[name='token']").val();
                
                if(name==""){
                    layer.msg('分类名称不能为空', {
                        icon: 2
                    }, function(){

                    });
                    return false
                }
                if(pid==""){
                    layer.msg('上级分类不能为空', {
                        icon: 2
                    }, function(){

                    });
                    return false
                }
                
                $.post("<?php echo $_smarty_tpl->tpl_vars['menu']->value['add_classification'];?>
",{
                    pid:pid,
                    name:name,
                    token:token,
                },function(data){
                    if(data.status == '1'){
                        layer.msg(data.msg, {
                            icon: 1
                        }, function(){
                            window.location.href = "<?php echo $_smarty_tpl->tpl_vars['menu']->value['products_classification'];?>
"
                        });
                    } else {
                        layer.msg(data.msg, {
                            icon: 2
                        }, function(){
                            window.location.reload()
                        });
                    }
                },"json");
            })
        })
    <?php echo '</script'; ?>
>
<?php $_smarty_tpl->_subTemplateRender("file:../footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}

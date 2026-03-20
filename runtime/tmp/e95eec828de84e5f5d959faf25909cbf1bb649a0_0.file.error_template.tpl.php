<?php
/* Smarty version 3.1.34-dev-7, created on 2026-03-20 15:22:55
  from 'C:\Users\admin\Documents\company\CompanyToolDevelopment\BugRepoter_0x727\index\view\docx\error_template.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_69bcf5cf321b10_58595109',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e95eec828de84e5f5d959faf25909cbf1bb649a0' => 
    array (
      0 => 'C:\\Users\\admin\\Documents\\company\\CompanyToolDevelopment\\BugRepoter_0x727\\index\\view\\docx\\error_template.tpl',
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
function content_69bcf5cf321b10_58595109 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
	<div class="content-wrapper">
        <div class="row gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-body">
						<h2>
							<p>请安装onlyoffice模块。</p>
						</h2>
						<h4>
							<p>docker run -i -t -d -p 8000:80 onlyoffice/documentserver</p>
							<p>docker exec $(docker ps -a | grep -E "(onlyoffice/documentserver)" | awk '{
							print $1
							}') rm -rf /var/www/onlyoffice/documentserver-example</p>
							<p>docker exec $(docker ps -a | grep -E "(onlyoffice/documentserver)" | awk '{
							print $1
							}') /usr/sbin/nginx</p>
						</h4>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $_smarty_tpl->_subTemplateRender("file:../footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}

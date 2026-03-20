<?php
/* Smarty version 3.1.34-dev-7, created on 2026-03-20 16:35:35
  from 'C:\Users\admin\Documents\company\CompanyToolDevelopment\BugRepoter_0x727\index\view\docx\template.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_69bd06d7c4de57_39387224',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2b51f2c341bbbf0abf58247064945daedb2bfd7a' => 
    array (
      0 => 'C:\\Users\\admin\\Documents\\company\\CompanyToolDevelopment\\BugRepoter_0x727\\index\\view\\docx\\template.tpl',
      1 => 1773993784,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../header.tpl' => 1,
    'file:../footer.tpl' => 1,
  ),
),false)) {
function content_69bd06d7c4de57_39387224 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <link rel="stylesheet" href="./public/index/vendor/datatables/dataTables.bs4.css" />
    <link rel="stylesheet" href="./public/index/vendor/datatables/dataTables.bs4-custom.css" />
    <link rel="stylesheet" href="./public/index/vendor/datatables/buttons.bs.css" rel="stylesheet" />
    <div class="content-wrapper">
        <div class="row gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="dt-buttons">
                                <a href="<?php echo $_smarty_tpl->tpl_vars['menu']->value['products_add_template'];?>
">
                                    <button class="dt-button buttons-copy buttons-html5" tabindex="0" aria-controls="copy-print-scroll" type="button">
                                        <span>添加</span>
                                    </button>
                                </a>
                            </div>
                            <table id="template" class="table v-middle" style="text-align: center;">
                                <thead style="text-indent: 1rem;">
                                    <tr>
                                      <th>模板编号</th>
                                      <th>模板名称</th>
                                      <th>提交时间</th>
                                      <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo '<script'; ?>
 src="./public/index/vendor/datatables/dataTables.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="./public/index/vendor/datatables/dataTables.bootstrap.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="./public/index/vendor/datatables/custom/custom-datatables.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
>
        $("#template").DataTable({
            "bJQueryUI": true,
            'aLengthMenu': [[10, 20, 30, 40, 50], ['10', '20', '30', '40', '50']],
            'bFilter': false,
            'bSortClasses': true,
            'bSort': true,
            'order': [[0, 'desc']],
            'bInfo' : true,
            "paging": true,
            "ordering": false,
            "info": true,
            "lengthChange": false,
            "searching": true,
            "serverSide": true,
            "deferRender": true,
            "ajax": {
                "url": "<?php echo $_smarty_tpl->tpl_vars['menu']->value['products_template'];?>
",
                "type":"POST"
            },
            "pagingType": "full_numbers",
            "columns": [
                {
                    "data": "id"
                },
                {
                    "data": "name"
                },
                {
                    "data": "add_time"
                },
                {
                    "data": function (row, type, val, meta) {
                        text = ""
                        text += '<div class="actions">'
                        text += '<a href="'+row.download_template_id+'" data-toggle="tooltip" data-placement="top" title="" data-original-title="下载模板"><i class="icon-download1 text-info"></i>&nbsp;</a>'
                        text += '<a href="'+row.view_template_id+'" data-toggle="tooltip" data-placement="top" title="" data-original-title="查看详情"><i class="icon-eye text-success"></i>&nbsp;</a>'
                        text += '<a href="'+row.edit_template_id+'" data-toggle="tooltip" data-placement="top" title="" data-original-title="替换模板"><i class="icon-upload text-warning"></i>&nbsp;</a>'
                        text += '<a href="'+row.del_template_id+'" data-toggle="tooltip" data-placement="top" title="" data-original-title="删除"><i class="icon-x-circle text-danger"></i>&nbsp;</a>'
                        text += '</div>'
                        return text
                    }
                },
            ],
            "language": {
                "sProcessing": "处理中...",
                "sLengthMenu": "显示 _MENU_ 项结果",
                "sZeroRecords": "没有匹配结果",
                "sInfo": "显示第 _START_ 至 _END_ 项结果，共 _TOTAL_ 项",
                "sInfoEmpty": "显示第 0 至 0 项结果，共 0 项",
                "sInfoFiltered": "(由 _MAX_ 项结果过滤)",
                "sInfoPostFix": "",
                "sSearch": "搜索:",
                "sUrl": "",
                "sEmptyTable": "表中数据为空",
                "sLoadingRecords": "载入中...",
                "sInfoThousands": ",",
                "oPaginate": {
                    "sFirst": "首页",
                    "sPrevious": "上页",
                    "sNext": "下页",
                    "sLast": "末页"
                },
                "oAria": {
                    "sSortAscending": ": 以升序排列此列",
                    "sSortDescending": ": 以降序排列此列"
                }
            }
        });
    <?php echo '</script'; ?>
>
<?php $_smarty_tpl->_subTemplateRender("file:../footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}

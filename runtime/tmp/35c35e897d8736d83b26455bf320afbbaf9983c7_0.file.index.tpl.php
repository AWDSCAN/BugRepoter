<?php
/* Smarty version 3.1.34-dev-7, created on 2026-03-19 20:34:29
  from 'C:\Users\admin\Documents\company\CompanyToolDevelopment\BugRepoter_0x727\index\view\index\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_69bbed55b0a608_49282076',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '35c35e897d8736d83b26455bf320afbbaf9983c7' => 
    array (
      0 => 'C:\\Users\\admin\\Documents\\company\\CompanyToolDevelopment\\BugRepoter_0x727\\index\\view\\index\\index.tpl',
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
function content_69bbed55b0a608_49282076 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <link rel="stylesheet" href="./public/index/vendor/bs-select/bs-select.css" />
    <div class="content-wrapper">
        <div class="row gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="field-wrapper">
                    <div class="field-wrapper">
                        <select class="select-single js-states" title="项目分类" data-live-search="true" name="project_id" id="project_id">
                            <option value="0">全部项目</option>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['project_classification']->value, 'vo');
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
                    </div>
                </div>
            </div>        
        </div>
        <div class="row gutters">
            <div class="col-xl-6 col-lg-4 col-md-4 col-sm-6 col-12">
                <div class="stats-tile">
                    <div class="sale-icon">
                        <i class="icon-shopping-bag1"></i>
                    </div>
                    <div class="sale-details">
                        <h2 id="loophole_num"><?php echo $_smarty_tpl->tpl_vars['loophole_num']->value;?>
</h2>
                        <p>漏洞量</p>
                    </div>
                    <div class="sale-graph">
                        <div id="sparklineLine2"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="stats-tile">
                    <div class="sale-icon">
                        <i class="icon-check-circle"></i>
                    </div>
                    <div class="sale-details">
                        <h2 id="repair_num"><?php echo $_smarty_tpl->tpl_vars['repair_num']->value;?>
</h2>
                        <p>修复量</p>
                    </div>
                    <div class="sale-graph">
                        <div id="sparklineLine3"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row gutters">  
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card h-350">
                    <div class="card-header">
                        <div class="card-title">安全人员提交漏洞统计图</div>
                    </div>
                    <div class="card-body">
                        <div id="byUser"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card h-350">
                    <div class="card-header">
                        <div class="card-title">Top10漏洞统计图</div>
                    </div>
                    <div class="card-body">
                        <div id="byTop"></div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
    <?php echo '<script'; ?>
 src="./public/index/vendor/apex/apexcharts.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="./public/index/vendor/bs-select/bs-select.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="./public/index/vendor/bs-select/bs-select-custom.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
>
        var byUser,byTop;
        // 安全人员提交漏洞统计图
        var byUser_options = {
            chart: {
                height: 310,
                type: 'donut',
            },
            labels: <?php echo $_smarty_tpl->tpl_vars['new_user_labels']->value;?>
,
            series: <?php echo $_smarty_tpl->tpl_vars['new_user_series']->value;?>
,
            legend: {
                position: 'bottom',
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: 8,
                colors: ['#ffffff'],
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return  val+"个"
                    }
                }
            },
        }
        var byUser = new ApexCharts(
            document.querySelector("#byUser"),
            byUser_options
        );
        byUser.render();

        // Top10漏洞统计图
        var byTop_options = {
            chart: {
                height: 310,
                type: 'donut',
            },
            labels: <?php echo $_smarty_tpl->tpl_vars['new_top_labels']->value;?>
,
            series: <?php echo $_smarty_tpl->tpl_vars['new_top_series']->value;?>
,
            legend: {
                position: 'bottom',
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: 8,
                colors: ['#ffffff'],
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return  val+"个"
                    }
                }
            },
        }
        var byTop = new ApexCharts(
            document.querySelector("#byTop"),
            byTop_options
        );
        byTop.render();

        $("#project_id").change(function(){
            var selected = $(this).children('option:selected').val();
            $.post("<?php echo $_smarty_tpl->tpl_vars['menu']->value['home'];?>
",{
                project_id:selected, 
            },function(data){
                $("#loophole_num").html(data.loophole_num)
                $("#repair_num").html(data.repair_num)
                byUser_options['labels'] = data.new_user_labels
                byUser_options['series'] = data.new_user_series
                byUser.updateOptions(byUser_options)
                byTop_options['labels'] = data.new_top_labels
                byTop_options['series'] = data.new_top_series
                byTop.updateOptions(byTop_options)
            },"json")
        });
    <?php echo '</script'; ?>
>
<?php $_smarty_tpl->_subTemplateRender("file:../footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}

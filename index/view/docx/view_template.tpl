{include file="../header.tpl"}
<style>
.info-card {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 5px;
    margin-bottom: 20px;
}
.placeholder-table {
    font-size: 13px;
}
.placeholder-table code {
    background: #e9ecef;
    padding: 2px 6px;
    border-radius: 3px;
    color: #d63384;
}
.action-buttons {
    margin-top: 20px;
}
</style>

<div class="content-wrapper">
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">模板详情：{$template.name}</div>
                </div>
                <div class="card-body">
                    
                    <!-- 模板基本信息 -->
                    <div class="info-card">
                        <h5><i class="icon-file-text"></i> 基本信息</h5>
                        <table class="table table-borderless" style="margin-bottom: 0;">
                            <tr>
                                <td style="width: 150px;"><strong>模板编号：</strong></td>
                                <td>{$template.id}</td>
                            </tr>
                            <tr>
                                <td><strong>模板名称：</strong></td>
                                <td>{$template.name}</td>
                            </tr>
                            <tr>
                                <td><strong>文件名：</strong></td>
                                <td>{$template.file_path}</td>
                            </tr>
                            <tr>
                                <td><strong>文件大小：</strong></td>
                                <td>
                                    {if $file_exists}
                                        {$file_size} KB
                                    {else}
                                        <span class="text-danger">文件不存在</span>
                                    {/if}
                                </td>
                            </tr>
                            <tr>
                                <td><strong>创建时间：</strong></td>
                                <td>{if $template.add_time > 0}{$template.add_time|date_format:"%Y-%m-%d %H:%M:%S"}{else}-{/if}</td>
                            </tr>
                        </table>
                    </div>

                    <!-- 操作按钮 -->
                    <div class="action-buttons">
                        {if $file_exists}
                        <a href="./index.php?{AuthCode("m=Docx&a=download_template&id={$template.id}&token={md5($template.id|cat:time())}","ENCODE",$_SESSION['domain_key'])}" 
                           class="btn btn-primary">
                            <i class="icon-download"></i> 下载模板
                        </a>
                        {/if}
                        <a href="./index.php?{AuthCode("m=Docx&a=edit_template&id={$template.id}","ENCODE",$_SESSION['domain_key'])}" 
                           class="btn btn-warning">
                            <i class="icon-upload"></i> 替换模板
                        </a>
                        <a href="./index.php?{AuthCode("m=Docx&a=template","ENCODE",$_SESSION['domain_key'])}" 
                           class="btn btn-secondary">
                            <i class="icon-arrow-left"></i> 返回列表
                        </a>
                    </div>

                    <hr style="margin: 30px 0;">

                    <!-- 模板占位符说明 -->
                    <div class="info-card">
                        <h5><i class="icon-book"></i> 模板占位符使用指南</h5>
                        <p>在Word模板中使用以下占位符来定义数据位置。格式：<code>{literal}{{ 占位符名称 }}{/literal}</code></p>
                        
                        <h6 class="mt-4">一、基本信息字段</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered placeholder-table">
                                <thead>
                                    <tr>
                                        <th style="width: 25%;">占位符</th>
                                        <th style="width: 20%;">说明</th>
                                        <th style="width: 15%;">数据类型</th>
                                        <th>示例值</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td><code>{literal}{{ name }}{/literal}</code></td><td>项目名称</td><td>字符串</td><td>贵州高速渗透测试</td></tr>
                                    <tr><td><code>{literal}{{ doctype }}{/literal}</code></td><td>文档类型</td><td>整数</td><td>1=安全测试报告, 2=复测报告</td></tr>
                                    <tr><td><code>{literal}{{ time }}{/literal}</code></td><td>报告生成日期</td><td>字符串</td><td>2026年03月20日</td></tr>
                                    <tr><td><code>{literal}{{ producer }}{/literal}</code></td><td>报告生成人</td><td>字符串</td><td>admin</td></tr>
                                    <tr><td><code>{literal}{{ producer_time }}{/literal}</code></td><td>生成时间</td><td>字符串</td><td>2026.03.20</td></tr>
                                    <tr><td><code>{literal}{{ reviewer }}{/literal}</code></td><td>审核人</td><td>字符串</td><td>张三</td></tr>
                                    <tr><td><code>{literal}{{ reviewer_time }}{/literal}</code></td><td>审核时间</td><td>字符串</td><td>2026.03.21</td></tr>
                                    <tr><td><code>{literal}{{ url }}{/literal}</code></td><td>目标URL</td><td>字符串</td><td>*.101.45</td></tr>
                                </tbody>
                            </table>
                        </div>

                        <h6 class="mt-4">二、统计数据字段</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered placeholder-table">
                                <thead>
                                    <tr>
                                        <th style="width: 25%;">占位符</th>
                                        <th style="width: 20%;">说明</th>
                                        <th style="width: 15%;">数据类型</th>
                                        <th>示例值</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td><code>{literal}{{ common }}{/literal}</code></td><td>漏洞总数</td><td>整数</td><td>15</td></tr>
                                    <tr><td><code>{literal}{{ serious }}{/literal}</code></td><td>严重漏洞数量</td><td>整数</td><td>2</td></tr>
                                    <tr><td><code>{literal}{{ high }}{/literal}</code></td><td>高危漏洞数量</td><td>整数</td><td>5</td></tr>
                                    <tr><td><code>{literal}{{ medium }}{/literal}</code></td><td>中危漏洞数量</td><td>整数</td><td>6</td></tr>
                                    <tr><td><code>{literal}{{ low }}{/literal}</code></td><td>低危漏洞数量</td><td>整数</td><td>2</td></tr>
                                    <tr><td><code>{literal}{{ risk_level }}{/literal}</code></td><td>风险等级评估</td><td>字符串</td><td>一般隐患</td></tr>
                                    <tr><td><code>{literal}{{ vulnerability_types }}{/literal}</code></td><td>漏洞类型汇总</td><td>字符串</td><td>SQL注入,XSS</td></tr>
                                </tbody>
                            </table>
                        </div>

                        <h6 class="mt-4">三、循环数据（数组）</h6>
                        <p><strong>主机列表 (hostlist)</strong> - 使用循环遍历：</p>
                        <pre style="background: #f5f5f5; padding: 15px; border-radius: 5px;">{literal}{% for host in hostlist %}
{{ host.id }}       # 主机ID
{{ host.url }}      # 主机URL
{{ host.name }}     # 漏洞名称
{{ host.type }}     # 漏洞类型
{{ host.bugLevel }} # 漏洞等级 (1=低危, 2=中危, 3=高危, 4=严重)
{% endfor %}{/literal}</pre>

                        <p><strong>漏洞详情 (alerts)</strong> - 嵌套循环：</p>
                        <pre style="background: #f5f5f5; padding: 15px; border-radius: 5px;">{literal}{% for alert in alerts %}
{{ alert.name }}    # 漏洞分类名称

  {% for item in alert.path %}
  {{ item.pathname }}     # 漏洞编号和名称
  {{ item.name }}         # 漏洞名称
  {{ item.level }}        # 漏洞等级
  {{ item.url }}          # 漏洞URL
  {{ item.analysis }}     # 漏洞分析
  {{ item.suggestions }}  # 修复建议
  {{ item.repair_time }}  # 建议修复时间(天)
  
    {% for verify in item.verification %}
    # 验证信息：文本或图片
    {{ verify }}
    {% endfor %}
  {% endfor %}
{% endfor %}{/literal}</pre>

                        <div class="alert alert-warning mt-3">
                            <strong><i class="icon-alert-triangle"></i> 注意事项：</strong>
                            <ul style="margin-bottom: 0;">
                                <li>占位符名称区分大小写，必须与系统定义的完全一致</li>
                                <li>图片会自动插入，宽度固定为160mm</li>
                                <li>建议使用Word 2016或更高版本编辑模板</li>
                                <li>保存模板时使用 .docx 格式（不要用 .doc）</li>
                            </ul>
                        </div>

                        <div class="alert alert-info mt-3">
                            <strong><i class="icon-info"></i> 详细文档：</strong>
                            <p style="margin-bottom: 0;">
                                完整的模板占位符说明和示例请查看项目的 README.md 文档<br>
                                GitHub地址：<a href="https://github.com/0x727/BugRepoter_0x727#0x07-word%E6%8A%A5%E5%91%8A%E6%A8%A1%E6%9D%BF%E8%AF%B4%E6%98%8E" target="_blank">
                                    https://github.com/0x727/BugRepoter_0x727
                                </a>
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

{include file="../footer.tpl"}

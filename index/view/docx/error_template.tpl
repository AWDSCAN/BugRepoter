{include file="../header.tpl"}
	<div class="content-wrapper">
        <div class="row gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-body" style="padding: 40px; text-align: center;">
						<i class="icon-alert-circle" style="font-size: 72px; color: #ffc107;"></i>
						<h2 style="margin-top: 20px;">模板功能已升级</h2>
						<p style="font-size: 16px; color: #666; margin-top: 15px;">
							我们已经将模板管理升级为更简单的上传下载方式，<br>
							无需配置复杂的ONLYOFFICE服务即可使用。
						</p>
						<div style="margin-top: 30px;">
							<a href="./index.php?{AuthCode("m=Docx&a=template","ENCODE",$_SESSION['domain_key'])}" 
							   class="btn btn-primary btn-lg">
								<i class="icon-list"></i> 进入模板管理
							</a>
						</div>
						<div style="margin-top: 40px; padding: 20px; background: #f8f9fa; border-radius: 5px; text-align: left;">
							<h5>💡 使用说明</h5>
							<ol style="margin-bottom: 0;">
								<li>点击"添加"上传您自定义的Word模板（.docx格式）</li>
								<li>点击"查看详情"可以看到完整的占位符说明</li>
								<li>点击"下载模板"获取模板文件，在本地使用Word编辑</li>
								<li>编辑完成后，点击"替换模板"重新上传更新</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
{include file="../footer.tpl"}
{include file="../header.tpl"}
<style>
.upload-area {
    border: 2px dashed #ccc;
    border-radius: 8px;
    padding: 40px;
    text-align: center;
    background: #f9f9f9;
    cursor: pointer;
    transition: all 0.3s;
}
.upload-area:hover {
    border-color: #007bff;
    background: #f0f7ff;
}
.upload-area.dragover {
    border-color: #28a745;
    background: #e8f5e9;
}
.file-info {
    margin-top: 20px;
    padding: 15px;
    background: #e7f3ff;
    border-radius: 5px;
    display: none;
}
.template-guide {
    background: #fff3cd;
    padding: 20px;
    border-radius: 5px;
    margin-bottom: 20px;
}
</style>

<div class="content-wrapper">
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{if isset($template)}编辑模板{else}添加模板{/if}</div>
                </div>
                <div class="card-body">
                    <!-- 模板使用说明 -->
                    <div class="template-guide">
                        <h5><i class="icon-info"></i> 模板使用说明</h5>
                        <ul style="margin-bottom: 0;">
                            <li>模板文件必须是 <strong>.docx</strong> 格式（Word 2007及以上版本）</li>
                            <li>在Word模板中使用 <code>{literal}{{ 占位符名称 }}{/literal}</code> 格式定义数据位置</li>
                            <li>完整的占位符列表请参考 <a href="https://github.com/0x727/BugRepoter_0x727#0x07-word%E6%8A%A5%E5%91%8A%E6%A8%A1%E6%9D%BF%E8%AF%B4%E6%98%8E" target="_blank">README文档</a></li>
                            <li>建议先下载默认模板进行修改，确保占位符格式正确</li>
                            <li>文件大小建议不超过10MB</li>
                        </ul>
                    </div>

                    <form id="uploadForm" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="token" value="{$token}">
                        
                        <div class="form-group">
                            <label for="name">模板名称 <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   placeholder="例如：默认安全测试报告模板" 
                                   value="{if isset($template)}{$template.name}{/if}" required>
                            <small class="form-text text-muted">请输入便于识别的模板名称</small>
                        </div>

                        <div class="form-group">
                            <label>模板文件 <span class="text-danger">*{if isset($template)} （不上传则保持原文件）{/if}</span></label>
                            <div class="upload-area" id="uploadArea">
                                <i class="icon-upload" style="font-size: 48px; color: #007bff;"></i>
                                <p style="margin-top: 15px; font-size: 16px;">点击选择文件或拖拽文件到此处</p>
                                <p style="color: #999;">支持 .docx 格式，建议大小不超过10MB</p>
                            </div>
                            <input type="file" id="template_file" name="template_file" 
                                   accept=".docx" style="display: none;" {if !isset($template)}required{/if}>
                            
                            <div class="file-info" id="fileInfo">
                                <strong>已选择文件：</strong><span id="fileName"></span><br>
                                <strong>文件大小：</strong><span id="fileSize"></span>
                                <button type="button" class="btn btn-sm btn-danger" id="removeFile" style="margin-left: 10px;">
                                    <i class="icon-x"></i> 移除
                                </button>
                            </div>

                            {if isset($template)}
                            <div class="alert alert-info mt-3">
                                <strong>当前模板文件：</strong>{$template.file_path}<br>
                                <small>如果不上传新文件，将保持使用当前模板文件</small>
                            </div>
                            {/if}
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="icon-save"></i> {if isset($template)}更新模板{else}上传模板{/if}
                            </button>
                            <a href="./index.php?{AuthCode("m=Docx&a=template","ENCODE",$_SESSION['domain_key'])}" 
                               class="btn btn-secondary">
                                <i class="icon-x"></i> 取消
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    var fileInput = $('#template_file');
    var uploadArea = $('#uploadArea');
    var fileInfo = $('#fileInfo');
    
    // 点击上传区域
    uploadArea.on('click', function() {
        fileInput.click();
    });
    
    // 文件选择
    fileInput.on('change', function(e) {
        handleFiles(e.target.files);
    });
    
    // 拖拽上传
    uploadArea.on('dragover', function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).addClass('dragover');
    });
    
    uploadArea.on('dragleave', function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).removeClass('dragover');
    });
    
    uploadArea.on('drop', function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).removeClass('dragover');
        
        var files = e.originalEvent.dataTransfer.files;
        if (files.length > 0) {
            // 将文件设置到input
            fileInput[0].files = files;
            handleFiles(files);
        }
    });
    
    // 处理文件
    function handleFiles(files) {
        if (files.length === 0) return;
        
        var file = files[0];
        var ext = file.name.split('.').pop().toLowerCase();
        
        if (ext !== 'docx') {
            alert('只支持 .docx 格式的文件！');
            fileInput.val('');
            return;
        }
        
        if (file.size > 10 * 1024 * 1024) {
            alert('文件大小不能超过10MB！');
            fileInput.val('');
            return;
        }
        
        $('#fileName').text(file.name);
        $('#fileSize').text((file.size / 1024).toFixed(2) + ' KB');
        fileInfo.show();
        uploadArea.hide();
    }
    
    // 移除文件
    $('#removeFile').on('click', function() {
        fileInput.val('');
        fileInfo.hide();
        uploadArea.show();
    });
    
    // 表单提交
    $('#uploadForm').on('submit', function(e) {
        e.preventDefault();
        
        var formData = new FormData(this);
        var submitBtn = $('#submitBtn');
        var originalText = submitBtn.html();
        
        submitBtn.prop('disabled', true).html('<i class="icon-loader"></i> 处理中...');
        
        $.ajax({
            url: window.location.href,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.status == 1) {
                    alert(response.msg);
                    window.location.href = response.data.url;
                } else {
                    alert(response.msg);
                    submitBtn.prop('disabled', false).html(originalText);
                }
            },
            error: function() {
                alert('操作失败，请重试！');
                submitBtn.prop('disabled', false).html(originalText);
            }
        });
    });
});
</script>

{include file="../footer.tpl"}

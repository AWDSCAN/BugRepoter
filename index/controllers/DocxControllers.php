<?php
include_once dirname(__FILE__)."/AuthControllers.php";
class DocxControllers extends AuthControllers
{
	
	/**
	 * 模板列表
	 * @access  public
	 * @return html
	 */
	public function template()
	{
		$this->jurisdiction("非法访问模板列表");
		$this->log_db("用户访问模板列表","7");
		$token = md5(code().time().code());
      	$_SESSION['token'] = $token;
      	
      	// 菜单链接
      	$menu = [
      		'products_template' => "./".root_filename.".php?".AuthCode("m=Docx&a=template","ENCODE",$_SESSION['domain_key']),
      		'products_add_template' => "./".root_filename.".php?".AuthCode("m=Docx&a=add_template","ENCODE",$_SESSION['domain_key'])
      	];
      	$this->smarty->assign('menu', $menu);
      	$this->smarty->assign('token',$token);
    	if ($_POST) {
			$draw = isset($_POST['draw']) ? intval($_POST['draw']) : "1";
	      	$start = isset($_POST['start']) ? intval($_POST['start']) : "1";
	      	$length = isset($_POST['length']) ? intval($_POST['length']) : "10";
	      	if($length < 0 || $length > 10) $length = 10;

	      	$value = isset($_POST['value']) ? $_POST['value'] : "";
			$db = $this->Db();
			$sql = "SELECT * FROM domain_template limit ".$start.",".$length;
			$count = "SELECT count(*) as num FROM domain_template";
			if($value){
				$sql = "SELECT * FROM domain_template WHERE name LIKE :name limit ".$start.",".$length;
			  	$db->bind("name", "%".$value."%");
			}
			$list = $db->query($sql);
			if($list){
	        	foreach ($list as $k => $v) {
	          		$list[$k]['add_time'] = $v['add_time'] == 0 ? '-' : date("Y-m-d H:i:s",$v['add_time']);
	          		$list[$k]['download_template_id'] = "./".root_filename.".php?".AuthCode("m=Docx&a=download_template&id=".$v['id']."&token=".$token,"ENCODE",$_SESSION['domain_key']);
          		$list[$k]['view_template_id'] = "./".root_filename.".php?".AuthCode("m=Docx&a=view_template&id=".$v['id'],"ENCODE",$_SESSION['domain_key']);
        		$list[$k]['edit_template_id'] = "./".root_filename.".php?".AuthCode("m=Docx&a=edit_template&id=".$v['id']."&token=".$token,"ENCODE",$_SESSION['domain_key']);        		$list[$k]['del_template_id'] = "./".root_filename.".php?".AuthCode("m=Docx&a=del_template&id=".$v['id']."&token=".$token,"ENCODE",$_SESSION['domain_key']);        	}
		}
		if($value){
				$count = "SELECT count(*) as num FROM domain_template WHERE name LIKE :name";
			  	$db->bind("name", "%".$value."%");
			}
      		$classification_count = $db->find_one($count);
      		$classification_num = isset($classification_count['num']) ? $classification_count['num'] : 0;
	      	$this->json(["draw"=>$draw,"recordsTotal"=>$classification_num,"recordsFiltered"=>$classification_num,"data"=>$list]);
		} else {
	    	$this->smarty->display('docx/template.tpl');
		}
	}

	/**
	 * 下载模板模板
	 * @access  public
	 * @return html
	 */
  	public function download_template()
  	{
		$this->jurisdiction("非法访问下载模板模板");
		$this->log_db("用户访问下载模板模板","9");

	    $db = $this->Db();
	    if($_GET){
	      	$id = isset($_GET['id']) ? intval($_GET['id']) : '';
	      	$token = isset($_GET['token']) ? $_GET['token'] : '';
	      	$session_token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
	      	#IF判断区域
	      	if(empty($id)) $this->json(['status'=>0,'msg'=>'输入ID！',"data"=>["url"=>"/".root_filename.".php?m=Docx&a=template"]]);
	      	if(empty($token)) $this->json(['status'=>0,'msg'=>'输入token！',"data"=>["url"=>"/".root_filename.".php?m=Docx&a=template"]]);
	      	if(empty($session_token)) $this->json(['status'=>0,'msg'=>'token异常！',"data"=>["url"=>"/".root_filename.".php?m=Docx&a=template"]]);
	      	if($token != $session_token) $this->json(['status'=>0,'msg'=>'token验证失败！',"data"=>["url"=>"/".root_filename.".php?m=Docx&a=template"]]);
	      	unset($_SESSION['token']);

	      	$db = $this->Db();
	      	$db->bind("id", $id);
			$list = $db->find_one("SELECT * FROM domain_template WHERE id = :id");
			if($list){
				$file_path = $list['file_path'];
				// 兼容旧格式：如果file_path只是文件名，尝试在用户目录中查找
				if(strpos($file_path, '/') === false) {
					$full_path = ROOT_PATH."/public/docx/".$_SESSION['user_info']['uuid']."/".$file_path;
				} else {
					// 新格式：file_path包含{uuid}/{filename}
					$full_path = ROOT_PATH."/public/docx/".$file_path;
				}
				
				if(file_exists($full_path)){
				    $filename = basename($file_path);
				    $file = fopen($full_path, "rb"); 
				    Header ("Content-type: application/octet-stream"); 
				    Header ("Accept-Ranges: bytes" );  
				    Header ("Accept-Length: " . filesize($full_path));  
				    Header ("Content-Disposition: attachment; filename=" . $filename);    
				    echo fread ($file, filesize($full_path));    
				    fclose($file);    
				    exit();
				} else {
	      			$this->json(["status"=>0,"msg"=>"模板文件不存在！","data"=>["url"=>"/".root_filename.".php?m=Docx&a=template"]]);
				}
			} else {
	      		$this->json(["status"=>0,"msg"=>"模板id不存在！","data"=>["url"=>"/".root_filename.".php?m=Docx&a=template"]]);
			}
	    } else {
	      	$this->json(["status"=>0,"msg"=>"错误异常！","data"=>["url"=>"/".root_filename.".php?m=Docx&a=template"]]);
	    }
	}

	/**
	 * 删除模板
	 * @access  public
	 * @return html
	 */
  	public function del_template()
  	{
		$this->jurisdiction("非法访问删除模板");
		$this->log_db("用户访问删除模板","5");
  		
	    $db = $this->Db();
	    if($_GET){
	      	$id = isset($_GET['id']) ? intval($_GET['id']) : '';
	      	$token = isset($_GET['token']) ? $_GET['token'] : '';
	      	$session_token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
	      	#IF判断区域
	      	if(empty($id)) $this->json(['status'=>0,'msg'=>'输入ID！',"data"=>["url"=>"/".root_filename.".php?".AuthCode("m=Docx&a=template","ENCODE",$_SESSION['domain_key'])]]);
	      	if(empty($token)) $this->json(['status'=>0,'msg'=>'输入token！',"data"=>["url"=>"/".root_filename.".php?".AuthCode("m=Docx&a=template","ENCODE",$_SESSION['domain_key'])]]);
	      	if(empty($session_token)) $this->json(['status'=>0,'msg'=>'token异常！',"data"=>["url"=>"/".root_filename.".php?".AuthCode("m=Docx&a=template","ENCODE",$_SESSION['domain_key'])]]);
	      	if($token != $session_token) $this->json(['status'=>0,'msg'=>'token验证失败！',"data"=>["url"=>"/".root_filename.".php?".AuthCode("m=Docx&a=template","ENCODE",$_SESSION['domain_key'])]]);
	      	unset($_SESSION['token']);

	      	if($id == "1") $this->json(['status'=>0,'msg'=>'默认模板禁止删除！',"data"=>["url"=>"/".root_filename.".php?".AuthCode("m=Docx&a=template","ENCODE",$_SESSION['domain_key'])]]);
	      	$db = $this->Db();
	      	$db->bind("id", $id);
			$list = $db->find_one("SELECT * FROM domain_template WHERE id = :id");
			if($list){
				// 兼容新旧格式
				$file_path = $list['file_path'];
				if(strpos($file_path, '/') === false) {
					// 旧格式：只有文件名
					$full_path = ROOT_PATH."/public/docx/".$_SESSION['user_info']['uuid']."/".$file_path;
				} else {
					// 新格式：{uuid}/{filename}
					$full_path = ROOT_PATH."/public/docx/".$file_path;
				}
				
		      	$db->bind("id", $id);
		      	$info = $db->query("DELETE from domain_template where `id` = :id");
		      	if($info){
		      		// 删除文件和历史记录
					if(file_exists($full_path)) {
						@unlink($full_path);
					}
					$hist_dir = $full_path."-hist";
					if(is_dir($hist_dir)) {
						deldir($hist_dir);
					}
		        	$this->json(["status"=>1,"msg"=>"删除成功！","data"=>["url"=>"/".root_filename.".php?".AuthCode("m=Docx&a=template","ENCODE",$_SESSION['domain_key'])]]);
		      	} else {
		        	$this->json(["status"=>0,"msg"=>"删除失败！","data"=>["url"=>"/".root_filename.".php?".AuthCode("m=Docx&a=template","ENCODE",$_SESSION['domain_key'])]]);
		      	}
			} else {
		        $this->json(["status"=>0,"msg"=>"删除失败！","data"=>["url"=>"/".root_filename.".php?".AuthCode("m=Docx&a=template","ENCODE",$_SESSION['domain_key'])]]);
			}
	    } else {
	      	$this->json(["status"=>0,"msg"=>"错误异常！","data"=>["url"=>"/".root_filename.".php?".AuthCode("m=Docx&a=template","ENCODE",$_SESSION['domain_key'])]]);
	    }
	}

	/**
	 * 添加模板（上传）
	 * @access  public
	 * @return html
	 */
	public function add_template()
	{
		$this->jurisdiction("非法访问添加模板");
		$this->log_db("用户访问添加模板","4");
		
		if ($_POST) {
			// 处理文件上传
			$db = $this->Db();
			$name = isset($_POST['name']) ? trim($_POST['name']) : '';
			$token = isset($_POST['token']) ? $_POST['token'] : '';
			$session_token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
			
			// 验证
			if(empty($name)) $this->json(['status'=>0,'msg'=>'请输入模板名称！']);
			if(empty($token)) $this->json(['status'=>0,'msg'=>'token不能为空！']);
			if(empty($session_token)) $this->json(['status'=>0,'msg'=>'token异常！']);
			if($token != $session_token) $this->json(['status'=>0,'msg'=>'token验证失败！']);
			unset($_SESSION['token']);
			
			// 检查文件上传
			if (!isset($_FILES['template_file']) || $_FILES['template_file']['error'] !== UPLOAD_ERR_OK) {
				$this->json(['status'=>0,'msg'=>'请上传模板文件！']);
			}
			
			$file = $_FILES['template_file'];
			$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
			
			// 只允许上传 .docx 文件
			if ($ext !== 'docx') {
				$this->json(['status'=>0,'msg'=>'只支持 .docx 格式的Word模板文件！']);
			}
			
			// 检查模板名称是否已存在
			$db->bind("name", $name);
			$exists = $db->find_one("SELECT id FROM domain_template WHERE name = :name");
			if ($exists) {
				$this->json(['status'=>0,'msg'=>'模板名称已存在，请使用其他名称！']);
			}
			
			// 生成模板UUID和目录
			$template_uuid = md5(uuid());
			$path = ROOT_PATH."/public/docx/".$template_uuid;
			if(!is_dir($path)){
				superBuilt($path);
			}
			
			// 生成文件名
			$filename = md5(time().code()).".docx";
			$filepath = $path."/".$filename;
			
			// 移动上传的文件
			if (!move_uploaded_file($file['tmp_name'], $filepath)) {
				$this->json(['status'=>0,'msg'=>'文件上传失败，请重试！']);
			}
			
			// 保存到数据库（file_path存储格式：{template_uuid}/{filename}）
			$db->bind("uuid", $template_uuid);
			$db->bind("name", $name);
			$db->bind("file_path", $template_uuid."/".$filename);
			$db->bind("add_time", time());
			$db->query("INSERT INTO domain_template(uuid,name,file_path,add_time) VALUES (:uuid,:name,:file_path,:add_time)");
			
			$this->json(['status'=>1,'msg'=>'模板上传成功！',"data"=>["url"=>"/".root_filename.".php?".AuthCode("m=Docx&a=template","ENCODE",$_SESSION['domain_key'])]]);
		} else {
			// 显示上传表单
			$token = md5(code().time().code());
			$_SESSION['token'] = $token;
			$this->smarty->assign('token',$token);
			$this->smarty->display('docx/upload_template.tpl');
		}
	}

	/**
	 * 编辑模板（重新上传）
	 * @access  public
	 * @return html
	 */
	public function edit_template()
	{
		$this->jurisdiction("非法访问编辑模板");
		$this->log_db("用户访问编辑模板","6");
		
		$db = $this->Db();
		$id = isset($_GET['id']) ? intval($_GET['id']) : '';
		
		if (!$id) {
			$this->json(['status'=>0,'msg'=>'参数错误！',"data"=>["url"=>"/".root_filename.".php?".AuthCode("m=Docx&a=template","ENCODE",$_SESSION['domain_key'])]]);
		}
		
		$db->bind("id", $id);
		$template = $db->find_one("SELECT * FROM domain_template WHERE id = :id");
		
		if (!$template) {
			$this->json(['status'=>0,'msg'=>'模板不存在！',"data"=>["url"=>"/".root_filename.".php?".AuthCode("m=Docx&a=template","ENCODE",$_SESSION['domain_key'])]]);
		}
		
		if ($_POST) {
			// 处理文件替换
			$name = isset($_POST['name']) ? trim($_POST['name']) : '';
			$token = isset($_POST['token']) ? $_POST['token'] : '';
			$session_token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
			
			// 验证
			if(empty($name)) $this->json(['status'=>0,'msg'=>'请输入模板名称！']);
			if(empty($token)) $this->json(['status'=>0,'msg'=>'token不能为空！']);
			if(empty($session_token)) $this->json(['status'=>0,'msg'=>'token异常！']);
			if($token != $session_token) $this->json(['status'=>0,'msg'=>'token验证失败！']);
			unset($_SESSION['token']);
			
			// 检查名称是否与其他模板冲突
			$db->bind("name", $name);
			$db->bind("id", $id);
			$exists = $db->find_one("SELECT id FROM domain_template WHERE name = :name AND id != :id");
			if ($exists) {
				$this->json(['status'=>0,'msg'=>'模板名称已存在，请使用其他名称！']);
			}
			
			// 获取模板存储路径（兼容新旧格式）
			$file_path = $template['file_path'];
			if(strpos($file_path, '/') === false) {
				// 旧格式：只有文件名，使用用户UUID目录
				$template_dir = ROOT_PATH."/public/docx/".$_SESSION['user_info']['uuid'];
				$old_format = true;
			} else {
				// 新格式：包含{uuid}/{filename}
				$path_parts = explode('/', $file_path);
				$template_dir = ROOT_PATH."/public/docx/".$path_parts[0];
				$old_format = false;
			}
			
			// 如果上传了新文件
			if (isset($_FILES['template_file']) && $_FILES['template_file']['error'] === UPLOAD_ERR_OK) {
				$file = $_FILES['template_file'];
				$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
				
				if ($ext !== 'docx') {
					$this->json(['status'=>0,'msg'=>'只支持 .docx 格式的Word模板文件！']);
				}
				
				// 删除旧文件
				$old_file = $template_dir."/".basename($file_path);
				if (file_exists($old_file)) {
					@unlink($old_file);
					// 删除历史记录目录
					$hist_dir = $old_file."-hist";
					if (is_dir($hist_dir)) {
						deldir($hist_dir);
					}
				}
				
				// 保存新文件（保持同一目录）
				$filename = md5(time().code()).".docx";
				$filepath = $template_dir."/".$filename;
				
				if (!move_uploaded_file($file['tmp_name'], $filepath)) {
					$this->json(['status'=>0,'msg'=>'文件上传失败，请重试！']);
				}
				
				// 更新数据库（保持新格式）
				$new_file_path = $old_format ? $filename : basename($template_dir)."/".$filename;
				$db->bind("name", $name);
				$db->bind("file_path", $new_file_path);
				$db->bind("id", $id);
				$db->query("UPDATE domain_template SET name=:name, file_path=:file_path WHERE id=:id");
			} else {
				// 只更新名称
				$db->bind("name", $name);
				$db->bind("id", $id);
				$db->query("UPDATE domain_template SET name=:name WHERE id=:id");
			}
			
			$this->json(['status'=>1,'msg'=>'模板更新成功！',"data"=>["url"=>"/".root_filename.".php?".AuthCode("m=Docx&a=template","ENCODE",$_SESSION['domain_key'])]]);
		} else {
			// 显示编辑表单
			$token = md5(code().time().code());
			$_SESSION['token'] = $token;
			$this->smarty->assign('token',$token);
			$this->smarty->assign('template', $template);
			$this->smarty->display('docx/upload_template.tpl');
		}
	}

	/**
	 * 查看模板信息
	 * @access  public
	 * @return html
	 */
	public function view_template()
	{
		$this->jurisdiction("非法访问查看模板");
		$this->log_db("用户访问查看模板","7");
		
		$db = $this->Db();
		$id = isset($_GET['id']) ? intval($_GET['id']) : '';
		
		if (!$id) {
			$this->json(['status'=>0,'msg'=>'参数错误！',"data"=>["url"=>"/".root_filename.".php?".AuthCode("m=Docx&a=template","ENCODE",$_SESSION['domain_key'])]]);
		}
		
		$db->bind("id", $id);
		$template = $db->find_one("SELECT * FROM domain_template WHERE id = :id");
		
		if (!$template) {
			$this->json(['status'=>0,'msg'=>'模板不存在！',"data"=>["url"=>"/".root_filename.".php?".AuthCode("m=Docx&a=template","ENCODE",$_SESSION['domain_key'])]]);
		}
		
		// 检查文件是否存在（兼容新旧格式）
		$file_path = $template['file_path'];
		if(strpos($file_path, '/') === false) {
			// 旧格式：只有文件名
			$filepath = ROOT_PATH."/public/docx/".$_SESSION['user_info']['uuid']."/".$file_path;
		} else {
			// 新格式：{uuid}/{filename}
			$filepath = ROOT_PATH."/public/docx/".$file_path;
		}
		$file_exists = file_exists($filepath);
		$file_size = $file_exists ? filesize($filepath) : 0;
		
		$this->smarty->assign('template', $template);
		$this->smarty->assign('file_exists', $file_exists);
		$this->smarty->assign('file_size', round($file_size/1024, 2)); // KB
		$this->smarty->display('docx/view_template.tpl');
	}

	/**
	 * 添加编辑公共调用模板
	 * @access  protected
	 * @return json
	 */
	protected function docx_template($docx_file = "")
	{
		$uuid = $_SESSION['user_info']['uuid'];
		$path = ROOT_PATH."/public/docx/".$uuid;
		// 判断文件是否创建，没有创建就进行创建
		if(!is_dir($path)){
			// 递归创建文件
			superBuilt(ROOT_PATH."/public/docx/".$_SESSION['user_info']['uuid']);
		}
	    
		if(empty($docx_file)){
			$docx = md5(md5(code().time()).code()).".docx";
		} else {
			$docx = $docx_file;
		}
		// 判断文件是否存在
		if(!is_file($path."/".$docx)){
			// 创建文件
			touch($path."/".$docx);
		}
		$isJwtEnabled = false;
		$docKey = GenerateRevisionId(filemtime($path."/".$docx).getCurUserHostAddress());
		$filetype = strtolower(pathinfo($path."/".$docx, PATHINFO_EXTENSION));
    	$editorsMode = empty($_GET["action"]) ? "edit" : $_GET["action"];
    	$canEdit = in_array(strtolower('.' . pathinfo($path."/".$docx, PATHINFO_EXTENSION)), array(".docx", ".xlsx", ".csv", ".pptx", ".txt"));
    	$submitForm = $canEdit && ($editorsMode == "edit" || $editorsMode == "fillForms");
    	$mode = $canEdit && $editorsMode != "view" ? "edit" : "view";
    	$type = empty($_GET["type"]) ? "desktop" : $_GET["type"];
   		$templatesImageUrl = get_curl()."/public/docx/css/images/file_docx.svg";
   		$createUrl = get_curl()."/example/doceditor.php?fileExt=docx&user=user-".$_SESSION['user_info']['id']."&type=desktop&1f2018903=".session_id();
   		$templates = [
	        [
	            "image" => "",
	            "title" => "Blank",
	            "url" => $createUrl
	        ],
	        [
	            "image" => $templatesImageUrl,
	            "title" => "With sample content",
	            "url" => $createUrl . "&sample=true"
	        ]
	    ];

	    $config = [
        	"type" => $type,
        	"documentType" => getDocumentType($path."/".$docx),
        	"document" => [
	            "title" => $docx,
	            "url" => get_curl()."/example/webeditor-ajax.php?type=download&fileName=".urlencode($docx)."&userAddress=".getCurUserHostAddress()."&1f2018903=".session_id(),
	            "fileType" => $filetype,
	            "key" => $docKey,
	            "info" => [
	                "owner" => $_SESSION['user_info']['username'],
	                "uploaded" => date('d.m.y'),
	                "favorite" => NULL
	            ],
	            "permissions" => [
	                "comment" => $editorsMode != "view" && $editorsMode != "fillForms" && $editorsMode != "embedded" && $editorsMode != "blockcontent",
	                "copy" => true,
	                "download" => true,
	                "edit" => $canEdit && ($editorsMode == "edit" || $editorsMode == "view" || $editorsMode == "filter" || $editorsMode == "blockcontent"),
	                "print" => true,
	                "fillForms" => $editorsMode != "view" && $editorsMode != "comment" && $editorsMode != "embedded" && $editorsMode != "blockcontent",
	                "modifyFilter" => $editorsMode != "filter",
	                "modifyContentControl" => $editorsMode != "blockcontent",
	                "review" => $canEdit && ($editorsMode == "edit" || $editorsMode == "review"),
	                "reviewGroups" => NULL,
	                "commentGroups" => []
	            ]
	        ],
	        "editorConfig" => [
	            "actionLink" => empty($_GET["actionLink"]) ? null : json_decode($_GET["actionLink"]),
	            "mode" => $mode,
	            "lang" => "zh",
	            "callbackUrl" => get_curl()."/example/webeditor-ajax.php?type=track&fileName=".urlencode($docx)."&userAddress=".getCurUserHostAddress()."&1f2018903=".session_id(),
	            "createUrl" => $createUrl,
	            "templates" => $templates,
	            "user" => [
	                "id" => $_SESSION['user_info']['id'],
	                "name" => $_SESSION['user_info']['username'],
	                "group" => NULL
	            ],
	            "embedded" => [
	                "saveUrl" => get_curl()."/public/docx/".$uuid."/".$docx,
	                "embedUrl" => get_curl()."/public/docx/".$uuid."/".$docx,
	                "shareUrl" => get_curl()."/public/docx/".$uuid."/".$docx,
	                "toolbarDocked" => "top",
	            ],
	            "customization" => [
	                "about" => true,
	                "feedback" => true,
	                "forcesave" => false,
	                "submitForm" => true,
	                "goback" => [
	                    "url" => get_curl(),
	                ]
	            ]
	        ],
	    ];
	    $dataInsertImage = [
	        "fileType" => "png",
	        "url" => get_curl()."/public/docx/css/images/logo.png"
	    ];
	    $dataCompareFile = [
	        "fileType" => "docx",
	        "url" => get_curl() . "/example/webeditor-ajax.php?type=assets&name=sample.docx"."&1f2018903=".session_id()
	    ];

	    $dataMailMergeRecipients = [
	        "fileType" =>"csv",
	        "url" => get_curl() . "/example/webeditor-ajax.php?type=csv"."&1f2018903=".session_id()

	    ];

	    $GLOBALS['docx_template'] = "1";
	    $GLOBALS['1f2018903'] = session_id();
	    
	    include_once ROOT_PATH."/example/jwtmanager.php";
	    if (isJwtEnabled()) {
	        $config["token"] = jwtEncode($config);
	        $dataInsertImage["token"] = jwtEncode($dataInsertImage);
	        $dataCompareFile["token"] = jwtEncode($dataCompareFile);
	        $dataMailMergeRecipients["token"] = jwtEncode($dataMailMergeRecipients);
	    }

	    $usersForMentions = [
	    	[
	    		"name"=>$_SESSION['user_info']['username'],
	    		"email"=>$_SESSION['user_info']['email'],
	    	],
	    ];

	    $out = getHistory(ROOT_PATH."/public/docx/".$uuid."/".$docx, $filetype, $docKey, get_curl()."/public/docx/".$uuid."/".$docx);
	    $history = json_encode($out[0]);
	    $historyData = json_encode($out[1]);
	    if(!$out){
	    	$history = NULL;
	    	$historyData = NULL;
	    }
	    $this->smarty->assign("dataInsertImage",mb_strimwidth(json_encode($dataInsertImage), 1, strlen(json_encode($dataInsertImage)) - 2));
	    $this->smarty->assign("dataCompareFile",json_encode($dataCompareFile));
	    $this->smarty->assign("dataMailMergeRecipients",json_encode($dataMailMergeRecipients));
	    $this->smarty->assign("config",json_encode($config));
	    $this->smarty->assign("history",$history);
	    $this->smarty->assign("historyData",$historyData);
	    $this->smarty->assign("get_curl",get_curl());
	    $this->smarty->assign("usersForMentions",json_encode($usersForMentions));
	    if(empty($docx_file)){
			$db = $this->Db();
		    $info = $db->find_one("SELECT * FROM domain_template WHERE name LIKE '%新建文档%' ORDER BY id desc");
		    if($info){
		    	$name = "新建文档(".intval(str_replace(["新建文档(",")"], "", $info['name'])+1).")";
		    } else {
		    	$name = "新建文档";
		    }
		    $db->bind("uuid", md5(uuid()));
		    $db->bind("name", $name);
		    $db->bind("file_path", $docx);
		    $db->bind("add_time", time());
	      	$db->query("INSERT INTO domain_template(uuid,name,file_path,add_time) VALUES (:uuid,:name,:file_path,:add_time)");
		} else {
			$docx = $docx_file;
		}
	}
}
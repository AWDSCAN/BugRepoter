# 渗透报告协作平台

[![GitHub release](https://img.shields.io/github/release/0x727/BugRepoter_0x727.svg)](https://github.com/0x727/BugRepoter_0x727/releases)

郑重声明：文中所涉及的技术、思路和工具仅供以安全为目的的学习交流使用，任何人不得将其用于非法用途以及盈利等目的，否则后果自行承担。

## 0x01 介绍

| 类别 | 说明 |
| ---- | --- |
| 作者 | [小洲](https://github.com/xz-zone) |
| 团队 | [0x727](https://github.com/0x727) 未来一段时间将陆续开源工具 |
| 定位 | 根据安全团队定制化协同管理项目安全，可快速查找历史漏洞，批量导出报告。 |
| 语言 | Python，PHP，Html，Javascript，css |
| 系统 | Centos/Ubuntu |
| 需要环境 | nginx+php+mysql+python3 |

## 0x02 效果展示
### 1 安装所需文件夹权限

|  文件夹   | 权限要求  |说明  |
|  ----  | ----  |----  |
| classes  | 读写（766） | class类|
| config  | 读写（766） | 配置文件|
| index  | 读写（766） | 主模块|
| lib  | 读写（766） | 插件|
| public  | 读写（766） | 公共文件|
| python_web  | 读写（766） | word表格制作|
| runtime  | 读写（777） | 缓存|

 注意：以上7个目录和目录下文件，除runtime必须具有可写权限777，其他必须具有可写权限766，非ROOT或管理员组权限！

### 2 进入安装界面
现在我们要做的就是安装渗透报告协作平台，在网页地址栏输入框中，输入 http://域名/index.php 后，按回车键，即可进入安装界面，如同：
注册协议

![install_one](./public/img/install_one.png)

网站配置

![install_two](./public/img/install_two.png)

程序安装 【如果使用docker的数据库那么IP：192.168.5.102 账户：root 密码：123456】

![install_three](./public/img/install_three.png)

安装完成

![install_three](./public/img/install_four.png)

## 0x03 功能介绍

### 1 首页

描述：首页统计团队某成员提交漏洞数量，并可以查看到整个项目漏洞类型分类

![index_one](./public/img/index_one.png)

### 2 项目

#### 2.1 漏洞列表

描述：漏洞列表可以直观看到某成员提交漏洞报告，并且可以支持批量导出报告。

![index_two](./public/img/index_two.png)

#### 2.2 项目分类

描述：项目分类可以根据自身的挖掘漏洞需求进行创建项目分类。

![index_three](./public/img/index_three.png)

#### 2.2.1 项目资产

描述：可以查看当前项目域名有哪些。

![index_three](./public/img/index_three_one.png)

#### 2.2.2 漏洞分布图

描述：可以查看到漏洞分布图。

![index_three](./public/img/index_three_two.png)

#### 2.3 模板列表

描述：模板列表可以自定义上传模板，导出报告的时候使用某类型模板。

![index_four](./public/img/index_four.png)

#### 2.4 漏洞分类

描述：漏洞分类可以创建某类型分类，比如：web安全漏洞-》xxe注入。

![index_five](./public/img/index_five.png)

### 3 用户管理

#### 3.1 用户管理

描述：用户管理可以创建团队成员账户，并且可以协同提交漏洞。

![index_six](./public/img/index_six.png)

#### 3.2 个人中心

描述：个人中心可以修改个人信息，方便管理员识别并且联系。

![index_seven](./public/img/index_seven.png)

### 4 网站设置

#### 4.1 网站设置

描述：网站设置可以某ip访问当前报告模板，提高后台访问的权限。

![index_eight](./public/img/index_eight.png)

#### 4.2 网站日志

描述：网站日志可以审计到某成员访问某个控制器，如遇到攻击会进行记录日志。

![index_nine](./public/img/index_nine.png)

## 0x04 Python安装与环境运行

```
yum -y groupinstall "Development tools"
yum -y install zlib-devel bzip2-devel openssl-devel ncurses-devel sqlite-devel readline-devel tk-devel gdbm-devel db4-devel libpcap-devel xz-devel
yum -y install libffi-devel
wget https://www.python.org/ftp/python/3.7.0/Python-3.7.0.tar.xz
tar -xvJf  Python-3.7.0.tar.xz
mkdir /usr/local/python3
cd Python-3.7.0
./configure --prefix=/usr/local/python3
make && make install
ln -s /usr/local/python3/bin/python3 /usr/local/bin/python3
ln -s /usr/local/python3/bin/pip3 /usr/local/bin/pip3
python3 -m pip install docxtpl==0.12.0
```

进入项目目录并且执行

```
nohup ./python_web/run.sh 2>&1 &
```

## 0x05 nginx安全配置

在当前nginx项目中配置以下：

```
# 禁止访问目录列
autoindex off;

# 禁止访问核心目录
location ^~ /index/ {
  deny all;
}
# 禁止访问类模块
location ^~ /classes {
  deny all;
}
# 禁止访问config配置模块
location ^~ /config {
  deny all;
}
# 禁止访问扩展模块
location ^~ /lib {
  deny all;
}
# 禁止访问生成报告模块
location ^~ /python_web {
  deny all;
}
# 禁止访问缓存模块
location ^~ /runtime {
  deny all;
}
# 禁止访问auto目录图片
location ^~ /public/auto/ {
  deny all;
}
# 禁止访问img目录图片
location ^~ /public/img/ {
  deny all;
}
# 禁止访问docker目录
location ^~ /docker {
   deny all;
}
#一键申请SSL证书验证目录相关设置
location ~ \.well-known{
    allow all;
}
#禁止访问文件后缀文件
location ~ .*\.(sh|py|docx|doc|ini|yml) {
  deny all;
}
```
![nginx_config](./public/img/nginx_config.png)

## 0x06 Docker一键安装

```
首先给予目录所有权限
chmod 777 -R BugRepoter_0x727

进去docker目录
cd docker

运行run_docker.sh
```

![run_docker](./public/img/run_docker.png)

## 0x07 Word报告模板说明

### 模板引擎

本系统使用 `python-docx-template` 库来生成Word报告，支持自定义模板上传。

### 模板存储位置

- 模板文件存储路径：`/public/docx/{用户UUID}/`
- 默认模板：`3b2bd38d2e911dc033217dc96cd6675d.docx`
- 模板数据库表：`domain_template`

### 模板占位符说明

在Word模板中，使用 `{{ 占位符名称 }}` 的格式来定义占位符，系统会自动将数据填充到对应位置。

#### 1. 基本信息字段

| 占位符 | 说明 | 数据类型 | 示例 |
|--------|------|---------|------|
| `{{ name }}` | 项目名称 | 字符串 | "贵州高速渗透测试" |
| `{{ doctype }}` | 文档类型 | 整数 | 1=安全测试报告, 2=复测报告 |
| `{{ time }}` | 报告生成日期 | 字符串 | "2026年03月20日" |
| `{{ producer }}` | 报告生成人 | 字符串 | "admin" |
| `{{ producer_time }}` | 生成时间 | 字符串 | "2026.03.20" |
| `{{ reviewer }}` | 审核人 | 字符串 | "张三" |
| `{{ reviewer_time }}` | 审核时间 | 字符串 | "2026.03.21" |
| `{{ url }}` | 目标URL | 字符串 | "*.101.45" |

#### 2. 统计数据字段

| 占位符 | 说明 | 数据类型 | 示例 |
|--------|------|---------|------|
| `{{ common }}` | 漏洞总数 | 整数 | 15 |
| `{{ serious }}` | 严重漏洞数量 | 整数 | 2 |
| `{{ high }}` | 高危漏洞数量 | 整数 | 5 |
| `{{ medium }}` | 中危漏洞数量 | 整数 | 6 |
| `{{ low }}` | 低危漏洞数量 | 整数 | 2 |
| `{{ risk_level }}` | 风险等级评估 | 字符串 | "一般隐患" |
| `{{ vulnerability_types }}` | 漏洞类型汇总 | 字符串 | "SQL注入,XSS" |

#### 3. 主机列表 (hostlist)

主机列表是一个数组，可以使用循环语法遍历：

```
{% for host in hostlist %}
{{ host.id }}       # 主机ID
{{ host.url }}      # 主机URL
{{ host.name }}     # 漏洞名称
{{ host.type }}     # 漏洞类型
{{ host.bugLevel }} # 漏洞等级 (1=低危, 2=中危, 3=高危, 4=严重)
{% endfor %}
```

#### 4. 漏洞详情列表 (alerts)

漏洞详情是嵌套的数组结构，包含多个漏洞和每个漏洞的多个路径：

```
{% for alert in alerts %}
{{ alert.name }}    # 漏洞分类名称

  {% for item in alert.path %}
  {{ item.pathname }}     # 漏洞编号和名称 (如: 2.1.1 SQL注入)
  {{ item.id }}           # 漏洞ID
  {{ item.name }}         # 漏洞名称
  {{ item.level }}        # 漏洞等级 (1=低危, 2=中危, 3=高危, 4=严重)
  {{ item.url }}          # 漏洞URL
  {{ item.analysis }}     # 漏洞分析描述
  {{ item.suggestions }}  # 修复建议
  {{ item.repair_time }}  # 建议修复时间 (天)
  
    {% for verify in item.verification %}
    # verification可以是文本或图片
    # 文本类型: 直接输出
    # 图片类型: 自动插入图片 (宽度160mm)
    {{ verify }}
    {% endfor %}
    
  {% endfor %}
  
{% endfor %}
```

#### 5. 图片插入说明

系统会自动处理漏洞验证截图：
- 图片类型的 `verification` 项会自动转换为内联图片
- 图片宽度固定为 160mm
- 支持的图片格式：PNG, JPG, JPEG

#### 6. 模板示例

```docx
安全测试报告

项目名称：{{ name }}
测试时间：{{ time }}
目标范围：{{ url }}

一、漏洞统计
总计发现 {{ common }} 个安全漏洞，其中：
- 严重: {{ serious }} 个
- 高危: {{ high }} 个
- 中危: {{ medium }} 个
- 低危: {{ low }} 个

风险评估：{{ risk_level }}

二、漏洞详情

{% for alert in alerts %}
{{ alert.name }}

{% for item in alert.path %}
{{ item.pathname }}

漏洞URL: {{ item.url }}
风险等级: {% if item.level == 4 %}严重{% elif item.level == 3 %}高危{% elif item.level == 2 %}中危{% else %}低危{% endif %}

漏洞描述：
{{ item.analysis }}

漏洞验证：
{% for verify in item.verification %}
{{ verify }}
{% endfor %}

修复建议：
{{ item.suggestions }}

建议修复时间：{{ item.repair_time }} 天

{% endfor %}
{% endfor %}

三、漏洞列表汇总

| 序号 | 漏洞名称 | URL | 等级 |
|------|---------|-----|------|
{% for host in hostlist %}
| {{ host.id }} | {{ host.name }} | {{ host.url }} | {{ host.bugLevel }} |
{% endfor %}
```

### 模板管理操作（简化版本）

**v1.13 版本起，模板管理已简化，无需配置ONLYOFFICE即可使用**

#### 基本操作流程

1. **上传模板**
   - 进入"模板列表"，点击"添加"按钮
   - 输入模板名称，上传 .docx 格式的模板文件
   - 系统会自动保存模板

2. **查看模板详情**
   - 点击模板列表中的"查看详情"（眼睛图标）
   - 可查看模板信息和完整的占位符使用说明
   - 复制占位符代码用于编辑模板

3. **编辑/替换模板**
   - 方式一（推荐）：
     - 点击"下载模板"获取当前模板文件
     - 使用本地Word编辑模板内容
     - 点击"替换模板"上传更新后的文件
   - 方式二：
     - 下载默认模板作为参考
     - 创建新模板并使用占位符
     - 点击"添加"上传新模板

4. **删除模板**
   - 点击"删除"图标
   - 注意：默认模板（ID=1）不可删除

5. **应用模板**
   - 在导出报告时选择对应的模板
   - 系统自动使用选定模板生成报告

#### 模板编辑最佳实践

1. **使用Microsoft Word**
   - 建议使用Word 2016或更高版本
   - 确保保存为 `.docx` 格式（不要用 `.doc`）

2. **占位符格式**
   ```
   简单字段：{{ field_name }}
   循环数据：{% for item in list %} ... {% endfor %}
   条件判断：{% if condition %} ... {% endif %}
   ```

3. **调试技巧**
   - 先在小范围测试占位符
   - 检查占位符拼写是否正确
   - 确保循环标签成对出现

4. **版本控制**
   - 建议为模板版本命名（如：安全测试报告模板v2.0）
   - 保留旧版本模板文件作为备份

### 注意事项

1. 模板文件必须是 `.docx` 格式（Word 2007+）
2. 自定义模板时请保持占位符名称与系统定义一致
3. 默认模板（ID=1）不可删除
4. 模板数据通过Python Socket服务（端口5671）进行处理
5. 图片文件会临时存储在 `/python_web/tmp/` 目录，生成报告后自动清理
6. **不再需要配置ONLYOFFICE服务**，简化了部署复杂度

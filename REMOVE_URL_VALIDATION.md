# 移除漏洞URL验证，支持多目标输入 - 2026-03-20

## 修改概述

已移除漏洞添加和编辑时对"漏洞URL"字段的所有验证检查，并将输入框改为多行文本域，支持用户填写多个目标地址。

---

## 修改内容

### 1. 后端验证移除 

**文件**: `index/controllers/ProductsControllers.php`

#### 添加漏洞验证（第166行）
**移除前**:
```php
if(empty($name)) $this->json(['status'=>0,'msg'=>'第'.$k.'份报告，请输入漏洞名称！']);
if(empty($bugDetail)) $this->json(['status'=>0,'msg'=>'第'.$k.'份报告，请输入漏洞Url！']);  // ← 已移除
if(empty($cate_id)) $this->json(['status'=>0,'msg'=>'第'.$k.'份报告，请选择漏洞分类！']);
```

**移除后**:
```php
if(empty($name)) $this->json(['status'=>0,'msg'=>'第'.$k.'份报告，请输入漏洞名称！']);
if(empty($cate_id)) $this->json(['status'=>0,'msg'=>'第'.$k.'份报告，请选择漏洞分类！']);
```

#### 编辑漏洞验证（第258行）
**移除前**:
```php
if(empty($id)) $this->json(['status'=>0,'msg'=>'输入ID！']);
if(empty($name)) $this->json(['status'=>0,'msg'=>'请输入漏洞名称！']);
if(empty($bugDetail)) $this->json(['status'=>0,'msg'=>'请输入漏洞Url！']);  // ← 已移除
if(empty($cate_id)) $this->json(['status'=>0,'msg'=>'请选择漏洞分类！']);
```

**移除后**:
```php
if(empty($id)) $this->json(['status'=>0,'msg'=>'输入ID！']);
if(empty($name)) $this->json(['status'=>0,'msg'=>'请输入漏洞名称！']);
if(empty($cate_id)) $this->json(['status'=>0,'msg'=>'请选择漏洞分类！']);
```

---

### 2. 前端验证移除

**文件**: `index/view/products/add_index.tpl`

**移除前**（第281-293行）:
```javascript
if(bugDetail==""){
    layer.msg("第"+i+"份报告，漏洞URL不能为空", {icon: 2});
    return false
}
if(!fIsUrL(bugDetail)){
    layer.msg("第"+i+"份报告，漏洞URL格式错误", {icon: 2});
    return false
}
```

**移除后**: 完全删除了上述两段验证代码

---

### 3. 输入框改为多行文本域

#### add_index.tpl（第24-30行）

**修改前**:
```html
<div class="field-wrapper">
    <input class="form-control" type="text" name="post[{$foo}][bugDetail]" value="">
    <div class="field-placeholder">漏洞URL <span class="text-danger">*</span></div>
    <div class="form-text">
        请输入漏洞URL
    </div>
</div>
```

**修改后**:
```html
<div class="field-wrapper">
    <textarea class="form-control" name="post[{$foo}][bugDetail]" rows="3" 
              placeholder="请输入目标地址（支持多个，每行一个）"></textarea>
    <div class="field-placeholder">目标地址</div>
    <div class="form-text">
        可填写多个目标地址，每行一个，例如：http://example.com、192.168.1.1等
    </div>
</div>
```

#### edit_index.tpl（第23-29行）

**修改前**:
```html
<div class="field-wrapper">
    <input class="form-control" type="text" name="bugDetail" value="{$post.bugDetail}">
    <div class="field-placeholder">漏洞URL <span class="text-danger">*</span></div>
    <div class="form-text">
        请输入漏洞URL
    </div>
</div>
```

**修改后**:
```html
<div class="field-wrapper">
    <textarea class="form-control" name="bugDetail" rows="3" 
              placeholder="请输入目标地址（支持多个，每行一个）">{$post.bugDetail}</textarea>
    <div class="field-placeholder">目标地址</div>
    <div class="form-text">
        可填写多个目标地址，每行一个，例如：http://example.com、192.168.1.1等
    </div>
</div>
```

---

### 4. JavaScript 选择器更新

#### add_index.tpl（第267行）

**修改前**:
```javascript
var bugDetail = $("input[name='post["+i+"][bugDetail]']").val();
```

**修改后**:
```javascript
var bugDetail = $("textarea[name='post["+i+"][bugDetail]']").val();
```

#### edit_index.tpl（第258行）

**修改前**:
```javascript
var bugDetail = $("input[name='bugDetail']").val();
```

**修改后**:
```javascript
var bugDetail = $("textarea[name='bugDetail']").val();
```

---

## 功能变更说明

### 之前的限制
1. ✗ 必须填写 URL
2. ✗ 必须符合标准 URL 格式（http://、https://等）
3. ✗ 只能填写一个目标
4. ✗ 单行输入框

### 现在的灵活性
1. ✓ **可选字段**：允许不填写目标地址
2. ✓ **格式自由**：支持任意格式（URL、IP、域名、主机名等）
3. ✓ **多目标支持**：每行一个，可填写多个目标
4. ✓ **多行文本域**：3行高度，方便查看和编辑

---

## 使用示例

### 单个目标
```
http://example.com
```

### 多个目标（每行一个）
```
http://example.com
https://api.example.com
192.168.1.100
192.168.1.101:8080
10.0.0.1
test.local
```

### 不同格式混合
```
http://www.site.com/admin
192.168.1.1
内网测试环境
server01.internal.corp
```

### 范围表示（自由格式）
```
192.168.1.0/24网段
172.16.0.1-172.16.0.254
测试环境所有服务器
```

---

## 数据库字段说明

- **字段名**: `bugDetail`
- **类型**: TEXT（文本类型，支持大量内容）
- **存储**: 多行文本以换行符分隔，原样存储
- **显示**: 在漏洞列表和详情页直接显示完整内容

---

## 兼容性

### 已有数据
- ✓ 原有的单个 URL 数据不受影响
- ✓ 可正常显示和编辑
- ✓ 支持随时添加更多目标

### 导出功能
- ✓ Word 报告导出功能不受影响
- ✓ 多行目标地址会完整显示在报告中
- ✓ 保持原有格式

---

## 修改的文件清单

1. `index/controllers/ProductsControllers.php` - 移除后端验证
2. `index/view/products/add_index.tpl` - 移除前端验证 + 改为文本域 + 更新选择器
3. `index/view/products/edit_index.tpl` - 移除前端验证 + 改为文本域 + 更新选择器

---

## 测试建议

### 测试用例

1. **空值测试**
   - 不填写目标地址
   - ✓ 应该能成功保存

2. **单目标测试**
   - 填写一个 URL/IP
   - ✓ 应该能正常保存和显示

3. **多目标测试**
   - 填写多行目标（每行一个）
   - ✓ 应该完整保存所有行
   - ✓ 编辑时应该完整显示

4. **特殊格式测试**
   - 填写非 URL 格式（如：IP、主机名、中文描述等）
   - ✓ 应该能正常保存

5. **导出测试**
   - 导出包含多目标的漏洞报告
   - ✓ Word 文档应该完整显示所有目标

---

## 注意事项

1. **数据验证**：现在目标地址不再有任何格式验证，完全由用户自己控制
2. **最佳实践**：建议用户每行填写一个目标，方便阅读和管理
3. **向后兼容**：原有数据不受影响，可继续正常使用

---

## Git 提交建议

```bash
git add index/controllers/ProductsControllers.php
git add index/view/products/add_index.tpl
git add index/view/products/edit_index.tpl
git commit -m "移除漏洞URL验证，支持多目标输入

- 移除后端和前端的URL格式和非空验证
- 将单行输入框改为多行文本域（textarea）
- 支持填写多个目标地址，每行一个
- 支持任意格式（URL/IP/域名/主机名/描述等）
- 目标地址改为可选字段"
```

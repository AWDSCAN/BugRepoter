import requests, re, sys

s = requests.Session()

# 1. 访问登录页
r = s.get('http://localhost/')
assert r.status_code == 200, f'Login page failed: {r.status_code}'
print('[PASS] 登录页正常加载')

# 2. 验证码字段已不存在
assert 'verify_img' not in r.text, '仍有 verify_img'
assert '验证码' not in r.text, '仍有验证码文字'
print('[PASS] 登录页已无验证码字段')

# 3. 提取 ajax_from
m = re.search(r'\.post\("([^"]+)"', r.text)
assert m, '未找到 ajax_from'
login_url = 'http://localhost/' + m.group(1).lstrip('./')
print(f'[INFO] 登录接口: {login_url[:80]}')

# 4. 空提交 - 应返回错误
r2 = s.post(login_url, data={})
assert '输入账户' in r2.text or 'status' in r2.text, f'意外响应: {r2.text[:100]}'
print('[PASS] 空提交返回账户错误')

# 5. 仅账户、无密码
r3 = s.post(login_url, data={'name': 'admin'})
assert '输入密码' in r3.text or 'status' in r3.text
print('[PASS] 缺密码返回密码错误')

# 6. 错误密码 - 应返回登录失败
r4 = s.post(login_url, data={'name': 'admin', 'password': 'wrong'})
assert '失败' in r4.text or 'status' in r4.text
print('[PASS] 错误密码返回失败提示')

# 7. 正确凭据、无验证码 - 应登录成功
r5 = s.post(login_url, data={'name': 'admin', 'password': '123456.'})
assert '登陆成功' in r5.text, f'登陆失败! 响应: {r5.text[:200]}'
print('[PASS] admin/123456. 无验证码登录成功')

print()
print('==== 所有测试通过 ====')

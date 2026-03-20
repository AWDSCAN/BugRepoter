"""测试按项目导出报告和图片上传功能"""
import asyncio
import zipfile
from pathlib import Path
from playwright.async_api import async_playwright
import time

async def test_project_export():
    async with async_playwright() as p:
        browser = await p.chromium.launch(headless=False)
        context = await browser.new_context()
        page = await context.new_page()
        
        print("=== 1. 登录系统 ===")
        await page.goto('http://localhost/')
        await page.fill('input[name="username"]', 'admin')
        await page.fill('input[name="password"]', '123456.')
        await page.click('button[type="submit"]')
        await page.wait_for_load_state('networkidle')
        print("✓ 登录成功")
        
        print("\n=== 2. 导航到漏洞列表 ===")
        await page.goto('http://localhost/index.php?m=Products&a=index')
        await page.wait_for_load_state('networkidle')
        await asyncio.sleep(1)
        print("✓ 进入漏洞列表页面")
        
        print("\n=== 3. 点击'按项目导出报告'按钮 ===")
        # 等待下载
        downloads_before = list(Path.home().joinpath('Downloads').glob('*.docx'))
        
        async with page.expect_download() as download_info:
            # 点击按钮
            await page.click('text=按项目导出报告')
            await asyncio.sleep(2)
            download = await download_info.value
            
        # 保存文件
        save_path = Path(__file__).parent / f'project_export_{int(time.time())}.docx'
        await download.save_as(save_path)
        print(f"✓ 文件已下载到: {save_path}")
        
        print("\n=== 4. 验证导出文件 ===")
        # 检查文件头
        with open(save_path, 'rb') as f:
            header = f.read(4)
            print(f"文件头: {header.hex()}")
            
            if header[:2] == b'PK':
                print("✓ 文件是有效的 ZIP/DOCX 格式")
                
                # 尝试打开 docx
                try:
                    with zipfile.ZipFile(save_path, 'r') as docx:
                        files = docx.namelist()
                        print(f"✓ DOCX 内部文件数: {len(files)}")
                        
                        # 检查关键文件
                        if 'word/document.xml' in files:
                            print("✓ 包含 word/document.xml")
                            doc_xml = docx.read('word/document.xml').decode('utf-8')
                            
                            # 检查是否有内容
                            if '漏洞' in doc_xml or '未授权' in doc_xml or '贵州高速' in doc_xml:
                                print("✓ 文档包含预期的漏洞内容")
                            else:
                                print("⚠ 文档内容可能不完整，未找到预期文本")
                                print(f"前1000字符: {doc_xml[:1000]}")
                        
                        # 检查图片
                        media_files = [f for f in files if f.startswith('word/media/')]
                        print(f"✓ 文档包含 {len(media_files)} 个图片文件")
                        
                        for media in media_files[:3]:  # 只显示前3个
                            size = len(docx.read(media))
                            print(f"  - {media}: {size:,} bytes")
                            
                except Exception as e:
                    print(f"✗ 无法解析 DOCX: {e}")
            else:
                print(f"✗ 文件格式错误，文件头应为 '504b' (PK)，实际为: {header.hex()}")
                # 显示前100字节
                f.seek(0)
                content = f.read(100)
                print(f"文件前100字节: {content.hex()}")
        
        print("\n=== 5. 测试图片上传功能 ===")
        # 导航到添加漏洞页面
        await page.goto('http://localhost/index.php?m=Products&a=add_index')
        await page.wait_for_load_state('networkidle')
        await asyncio.sleep(1)
        print("✓ 进入添加漏洞页面")
        
        # 创建测试图片
        from PIL import Image
        test_img_path = Path(__file__).parent / 'test_upload_image.png'
        img = Image.new('RGB', (800, 600), color=(73, 109, 137))
        img.save(test_img_path)
        print(f"✓ 创建测试图片: {test_img_path}")
        
        # 等待 Summernote 编辑器加载
        await page.wait_for_selector('.note-editor')
        print("✓ Summernote 编辑器已加载")
        
        # 点击图片按钮
        try:
            # 尝试点击图片上传按钮
            await page.click('.note-icon-picture')
            await asyncio.sleep(1)
            print("✓ 点击了图片上传按钮")
            
            # 上传文件
            file_input = await page.query_selector('input[type="file"]')
            if file_input:
                await file_input.set_input_files(str(test_img_path))
                await asyncio.sleep(2)
                print("✓ 已选择文件")
                
                # 检查编辑器中是否有图片
                images = await page.query_selector_all('.note-editable img')
                print(f"编辑器中的图片数量: {len(images)}")
                
                if images:
                    for i, img in enumerate(images[:3]):
                        src = await img.get_attribute('src')
                        print(f"  图片 {i+1} src: {src[:100] if src else 'None'}{'...' if src and len(src) > 100 else ''}")
            else:
                print("⚠ 未找到文件上传输入框")
        except Exception as e:
            print(f"图片上传测试出错: {e}")
        
        print("\n=== 6. 测试剪贴板粘贴图片 ===")
        # 聚焦到编辑器
        await page.click('.note-editable')
        
        # 模拟剪贴板粘贴（使用 CDP）
        try:
            # 创建一个小的测试图片的 base64
            import base64
            from io import BytesIO
            
            test_img2 = Image.new('RGB', (100, 100), color=(255, 0, 0))
            buffer = BytesIO()
            test_img2.save(buffer, format='PNG')
            img_base64 = base64.b64encode(buffer.getvalue()).decode()
            
            # 使用 JavaScript 模拟粘贴
            paste_script = f"""
            (async () => {{
                const editor = document.querySelector('.note-editable');
                const dataTransfer = new DataTransfer();
                
                // 将 base64 转换为 Blob
                const base64Data = '{img_base64}';
                const byteCharacters = atob(base64Data);
                const byteNumbers = new Array(byteCharacters.length);
                for (let i = 0; i < byteCharacters.length; i++) {{
                    byteNumbers[i] = byteCharacters.charCodeAt(i);
                }}
                const byteArray = new Uint8Array(byteNumbers);
                const blob = new Blob([byteArray], {{ type: 'image/png' }});
                
                // 创建 File 对象
                const file = new File([blob], 'paste.png', {{ type: 'image/png' }});
                
                // 添加到 clipboardData items
                const item = new DataTransferItem();
                dataTransfer.items.add(file);
                
                // 创建粘贴事件
                const pasteEvent = new ClipboardEvent('paste', {{
                    clipboardData: dataTransfer,
                    bubbles: true,
                    cancelable: true
                }});
                
                editor.dispatchEvent(pasteEvent);
                
                // 等待一下看结果
                await new Promise(r => setTimeout(r, 2000));
                
                // 返回图片数量
                return document.querySelectorAll('.note-editable img').length;
            }})();
            """
            
            img_count_before = len(await page.query_selector_all('.note-editable img'))
            print(f"粘贴前图片数量: {img_count_before}")
            
            result = await page.evaluate(paste_script)
            await asyncio.sleep(3)
            
            img_count_after = len(await page.query_selector_all('.note-editable img'))
            print(f"粘贴后图片数量: {img_count_after}")
            print(f"新增图片数量: {img_count_after - img_count_before}")
            
            if img_count_after - img_count_before == 1:
                print("✓ 粘贴图片正常，只增加了1张图片")
            elif img_count_after - img_count_before == 2:
                print("✗ 粘贴图片异常，增加了2张图片（重复问题）")
            else:
                print(f"⚠ 粘贴结果异常，增加了 {img_count_after - img_count_before} 张图片")
                
            # 显示所有图片的 src
            images = await page.query_selector_all('.note-editable img')
            print(f"\n当前编辑器中所有图片:")
            for i, img in enumerate(images):
                src = await img.get_attribute('src')
                is_base64 = src.startswith('data:') if src else False
                is_server = 'public_deup_img' in src if src else False
                print(f"  {i+1}. {'[Base64]' if is_base64 else '[Server]' if is_server else '[Unknown]'} {src[:80] if src else 'None'}...")
                
        except Exception as e:
            print(f"剪贴板粘贴测试出错: {e}")
            import traceback
            traceback.print_exc()
        
        print("\n=== 测试完成 ===")
        await asyncio.sleep(3)
        await browser.close()

if __name__ == '__main__':
    asyncio.run(test_project_export())

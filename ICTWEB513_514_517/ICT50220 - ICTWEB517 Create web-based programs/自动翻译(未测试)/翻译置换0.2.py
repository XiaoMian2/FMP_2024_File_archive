import json
import time
import re
import tkinter as tk
from tkinter import filedialog
from tencentcloud.common import credential
from tencentcloud.common.profile.client_profile import ClientProfile
from tencentcloud.common.profile.http_profile import HttpProfile
from tencentcloud.tmt.v20180321 import tmt_client, models

def translate_php_file(file_path, secret_id, secret_key, output_text):
    output_text.insert(tk.END, f"开始翻译 PHP 文件: {file_path}\n")

    # 初始化腾讯云翻译客户端
    cred = credential.Credential(secret_id, secret_key)
    httpProfile = HttpProfile()
    httpProfile.endpoint = "tmt.tencentcloudapi.com"
    clientProfile = ClientProfile()
    clientProfile.httpProfile = httpProfile
    client = tmt_client.TmtClient(cred, "ap-guangzhou", clientProfile)

    # 打开原始 PHP 文件
    with open(file_path, 'r', encoding='utf-8') as f:
        php_content = f.read()

    # 提取中文文本
    chinese_texts = find_chinese(php_content)

    # 发起翻译请求并替换原始 PHP 文件中的中文文本
    translated_php_content = php_content
    for chinese_text in chinese_texts:
        translated_text = translate_text(client, chinese_text)
        translated_php_content = translated_php_content.replace(chinese_text, translated_text)
        # 控制翻译频率，每秒钟不超过5次
        time.sleep(0.2)
        output_text.insert(tk.END, f"翻译完成: {chinese_text} -> {translated_text}\n")
        output_text.update()

    # 将翻译后的内容写入原文件
    with open(file_path, 'w', encoding='utf-8') as f:
        f.write(translated_php_content)

    output_text.insert(tk.END, f"翻译完成，并替换原文件: {file_path}\n")

def find_chinese(text):
    chinese_pattern = re.compile(r'[\u4e00-\u9fa5]+')
    chinese_texts = chinese_pattern.findall(text)
    return chinese_texts

def translate_text(client, text):
    request = models.TextTranslateRequest()
    request.SourceText = text
    request.Source = "zh"
    request.Target = "en"
    request.ProjectId = 0
    response = client.TextTranslate(request)
    return response.TargetText

def select_file(output_text):
    file_path = filedialog.askopenfilename(filetypes=[("PHP files", "*.php")])
    if file_path:
        translate_php_file(file_path, secret_id_entry.get(), secret_key_entry.get(), output_text)

# 创建GUI界面
root = tk.Tk()
root.title("PHP文件翻译工具")

# 添加输入密钥的文本框和标签
tk.Label(root, text="Secret ID:").pack(pady=5)
secret_id_entry = tk.Entry(root)
secret_id_entry.pack(pady=5)
tk.Label(root, text="Secret Key:").pack(pady=5)
secret_key_entry = tk.Entry(root, show="*")
secret_key_entry.pack(pady=5)

# 添加按钮和输出文本框
button = tk.Button(root, text="选择文件并翻译", command=lambda: select_file(output_text))
button.pack(pady=20)
output_text = tk.Text(root, height=10, width=50)
output_text.pack(pady=10)

# 运行GUI
root.mainloop()

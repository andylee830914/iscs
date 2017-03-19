# ISCS Assignment Platform
Automatic personal assignment pdf generating system.

## Introduction
### 彌補傳統作業的不足
本系統可以使用變數來產生個人化題目，針對同一次作業也能根據設定規則分配不同版本。
在教學上，亦能根據每個人的能力不同，分配不同難度的作業。
### 高品質的題目卷
採用 LaTeX 排版系統，可以產生高品質的中英文 PDF 題目檔。
### 多樣化的出題方式
除了 PDF 格式題目，更能產生個人化的 MATLAB mat 資料檔、csv 檔等等，讓出題更有彈性。
### 試場加密
提供輸入密碼才能下載題目的功能。


## Requirement
* LaTeX


## MySQL Connection
Please make a ```connect.php``` file under the directory. Here is the sample content :
```
<?php
$link=mysql_connect("127.0.0.1","root","mysql_password") or die ("連線失敗");
mysql_select_db("test");
mysql_set_charset('utf8',$link);
?>
```



# xscj
学生成绩管理系统
## 安装步骤
1. `cd your path`
2. `git clone https://github.com/xzjs/xscj.git`
3. `cd xscj`
4. `cp .env.example .env`(就是把前面的文件复制一份，改名为后面的)
5. `composer install`(需要提前安装composer，并设置成中文镜像)
6. `npm install`(需要提前安装好npm并设置成淘宝镜像)
7. `php artisan key:generate`
8. 创建mysql数据库xscj(名字可以不一样)
9. 在.env中填写对应的数据库配置
10. `php artisan migrate`
11. 访问网页的public（http://localhost/xscj/pub/）
## 接口文档地址
[https://www.kancloud.cn/xzjs/xscj](https://www.kancloud.cn/xzjs/xscj)
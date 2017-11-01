## 项目构想

laravel框架升级太快，特别是非LTS版本，速度简直飞起，每次升级就会更改还能多代码，相当麻烦。那能不能写一个依赖于laravel的外层，使其对版本的依赖降低，达到随便更换版本而修改那么一丢丢代码呢

## 项目程序

### loid
本项目名为loid,为达到上述目的而作的一个测试。

loid其功能以模块的形式存在，一个模块一个包，分为强依赖模块（不可拆卸删除）和弱依赖模块（可拆卸删除）；

### loid-frame
loid-frame为核心框架，并加载一些列loid的moudle,所有功能都以moudle存在。

### loid-module-manager-role
loid-module-manager-role为loid的一个模块，顾名思义，一个后台管理人员的role模块，依赖于loid-frame,为loid的强依赖模块；


## >>>
*其余模块还没开发呢，我懒得很。*

## 项目使用
先下载laravel任何版本(目前以5.5为基础)，然后
```base
composer require loid-frame
```
然后模块初始化引导
```base
php artisan loid:boot
```
如果不行，真的怪我，因为我刚从本地gitlab上传至github,没有改`composer.json`,也没有添加任何tag,如果感兴趣，先构思下项目吧，毕竟我还没开发完呢，就刚有个雏形，再说我也翻了很严重的懒癌，github上的其他项目就能看出来，尼玛全是半成品;


## 项目讲解


每个模块都可以存在配置文件，由`loid-frame`负责覆盖laravel>app>config;

每个模块都可以有数据库迁移文件，由由`loid-frame`负责加载;

每个模块都可以有视图文件，由由`loid-frame`负责加载，调用示例：`view('xx::xx/xx')`;

每个模块都必须有`Init.php`文件且必须继承`loid-frame`的`Loid\Frame\Init`类；

每个模块理念上都必须实现A（API）/L（Logic）层面，数据传递为M->L->A->C->V；如果是移动端：M->L->A->app;

没添加一个模块，执行一次`php artisan loid:boot`进行初始化引导,该命令会连带执行`migrate`命令，模块配置文件在`loid-frame`下的storage目录，引导时会把模块数据叠加到`前缀_system_support_moudle`数据表中；

前端插件放在`loid-frame`下的`resources`文件夹中,服务器重定向路径，详见`www.nginx.com.conf`，每个模块的前端资源放在对应的模块位置，在使用时有一个bug未处理，因为我还没开发到那里去哈哈，即`asset_site(string $path, string $sign, string $filename)`中的第一个参数需要在每个模块中做另外调整。

本项目使用blade模板引擎；

*其他想到再说吧。。。*


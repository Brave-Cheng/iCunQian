Make symfony support multiple clients
----
Modified source file

lib\symfony\lib\vendor\propel\Propel.php

-------------------------------------------------------------------------------------------------------

站点切换数据库方法：

    1. 替换Propel.php文件，将附件中的Propel.php替换站点的“symfony库目录”的Propel.php文件。

        1. 在站点的config/config.php文件中查看具体“symfony库目录”位置。例如我本地的目录“d:/usr/local/lib/php/symfony”
        2. 使用附件中的Propel.php替换“d:/usr/local/lib/php/symfony/lib/vender/propel/Propel.php”文件

    2. 配置站点的vhost。在Apache虚拟站点（vhost.conf）添加 “SetEnv DB_CONNECT_NAME oa_demo”参数，表示该站点使用的数据库名称为：oa_demo。
            <VirtualHost *>
                ...
                SetEnv DB_CONNECT_NAME oa_demo
                ...

    3. 修改站点的默认数据库。参考database.yml已有的配置，并重新复制一个数据库链接（dsn）,将其名称修改为:oa_demo。
             oa_demo:
               class: sfPropelDatabase
               param:
                 dsn: mysql://root:root@127.0.0.1/oa_demo [^]
                 encoding: utf8

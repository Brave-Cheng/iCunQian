Rapidmanager Notes:
------

#Apache 

-   **DocumentRoot**    /home/httpd/html/leaguestat/backend/
-   **VhostConfig**     /usr/local/apache2/websites/leaguestat.backend.devel.commer.com.conf
-   **Login**           ssh jmao@devel.trunk.rapidmanager.com            

##[API Adress](http://leaguestat.backend.devel.commer.com/mobile/app/mobileapi.php)







#[devel.trunk.rapidmanager.com](http://devel.trunk.rapidmanager.com/)

##Login
+   brave.cheng
+   123456@a

##SVN

###Trunk Web Root
+   /home/httpd/html/rapidmanager_trunk/ 
###Live Web Root
+   /home/httpd/html/rapidmanager/

##Mysql
+   host:   devel5-mysql.commer.com 
+   user:   rm2_multisite 
+   pass:   lfkjad93ak
+   database:   rm2_multisite 
+   mysqldump -hdevel5-mysql.commer.com -urm2_multisite -plfkjad93ak rm2_multisite > rm.devel.20140619.sql

##Frontend Sites
###SVN
+   svn+ssh://brave@192.168.18.168/data/repo/rm_sites/  




#[admin.rapidmanager.com](http://admin.rapidmanager.com/)
##Login
+   brave.cheng
+   123456@a
##WebRoot
+   /home/httpd/html/rapidmanager/

##Url
+   http://admin.rapidmanager.com/index.php/

##Mysql
+   host:   mysql.commer.com
+   user:   rapidmanager
+   pass:   rm192a
+   database:   rapidmanager2
+   mysqldump -hmysql.commer.com -urapidmanager -prm192a rapidmanager2 --ignore-table=rapidmanager2.mail_queue_archives --ignore-table=rapidmanager2.ppl_mail_queue_archives > rm.admin.20130115.sql

##Frontend Sites
##Ftp
+   sftp://admin.rapidmanager.com/ jmao/uy288a

+   下载Live服务器前端站点文件参考
>
    1、登陆192.168.18.168
    2、使用rsync
>>  rsync jmao@admin.rapidmanager.com:/home/httpd/html/rapidmanager/frontend/sites/<site_code>/ ./ -avz --exclude='web/files/' --exclude='web/temp/'



#[leaguestat.rapidmanager.com](leaguestat.rapidmanager.com)
##Login
+   brave.cheng
+   123456@a

##WebRoot
+   /home/httpd/html/rapidmanager/

##Apache
+   /usr/local/apache2/conf
##Vhosts
+   /usr/local/apache2/conf/access.conf
##Mysql
+   host:   mysql.commer.com
+   user:   rapidmanager_ls
+   pass:   rm192a
+   database:   apidmanager_ls
+   mysqldump -hmysql.commer.com -urapidmanager_ls -prm192a rapidmanager_ls --ignore-table=rapidmanager_ls.mail_queue_archives --ignore-table=rapidmanager_ls.ppl_mail_queue_archives > rm.ls.20130115.sql



#[192.168.18.168](\\192.168.18.168)
##Mysql
+   user:   mysql
+   pass:   rm192a


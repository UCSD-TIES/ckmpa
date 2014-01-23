ckmpa
===============
San Diego Coastkeeper MPA Datasheet web application developed with PHP + [Laravel 4](http://laravel.com/) framework.  

Setting Up the Environment
------
Note: The following instructions are for Windows, please modify the paths and such accordingly for your OS. 
<br>

1. Download and install XAMPP from http://www.apachefriends.org/en/xampp.html
2. Inside the XAMPP directory, open **apache/conf/httpd.conf** and change
    - DocumentRoot "C:/xampp/htdocs" to DocumentRoot "C:/xampp/htdocs/ckmpa/public"
    - &lt;Directory "C:/xampp/htdocs"&gt; to &lt;Directory "C:/xampp/htdocs/ckmpa/public"&gt;
3. Inside the XAMPP directory, open **phpMyAdmin/config.inc.php** and change
    - $cfg['Servers'][$i]['auth_type'] = 'config'; to $cfg['Servers'][$i]['auth_type'] = 'cookie';
4. After you are added as collaborator to UCSD-TIES on Github, from either the graphical Github interface or the command line:
  - git clone https://github.com/UCSD-TIES/ckmpa.git 
      - If you are using git via command line, clone inside **xampp/htdocs** 
      - If you are using graphical Github interface, clone it and make a symlink to the ckmpa folder inside xampp/htdocs from the commandline
(Windows) mklink /D ckmpa C:\Users\\(User)\Documents\GitHub\ckmpa
5. Open XAMPP Control Panel and start both Apache and MySQL modules
6. Click Admin for MySQL (or visit [localhost/phpmyadmin](http://localhost/phpmyadmin/)) and login as username **root** with **no password** 
7. Under General Settings in the main page, change password to **ck**
8. Click Databases on top and create a database named **coastkeeper** 
9. Click the **coastkeeper** database that you just created then click import on top 
10. Import **ck.sql** from inside ckmpa directory 
11. Login to the application by visiting [localhost](http://localhost) or [localhost/admin](http://localhost/admin) on a browser with 
  -  username: ck 
  -  password: testing

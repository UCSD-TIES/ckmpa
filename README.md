ckmpa
===============
San Diego Coastkeeper MPA Datasheet web application developed with PHP + [Laravel 4](http://laravel.com/) framework.  
###Using additional packages:
  - [Confide](https://github.com/Zizaco/confide) for user management
  - [Entrust](https://github.com/Zizaco/entrust) for user permissions
  - [Ardent](https://github.com/laravelbook/ardent) for "self-validating, secure and smart models"
  - [TwigBridge](https://github.com/rcrowe/TwigBridge) for twig templates
  - [PHPExcel](http://phpexcel.codeplex.com/) for exporting Excel sheets
  - [Carbon](https://github.com/briannesbitt/Carbon) for dating. Get it?

###Javascript dependencies:
  - [jQuery](http://jquery.com/) for everything
  - [Chart.js](http://www.chartjs.org/) for charts
  - [Datepicker](https://github.com/eternicode/bootstrap-datepicker) for bootstrap compatible datepicker

###UI Frameworks:
  - [Bootstrap](http://getbootstrap.com/) for admin side
  - [jQuery Mobile](http://jquerymobile.com/) for mobile side

Setting Up the Environment
------
Assuming default installation paths.
###Windows
1. Download and install XAMPP from http://www.apachefriends.org/en/xampp.html
2. Inside **C:/xampp/apache/conf**, open **httpd.conf** and change
    - DocumentRoot "C:/xampp/htdocs" to DocumentRoot "C:/xampp/htdocs/ckmpa/public"
    - &lt;Directory "C:/xampp/htdocs"&gt; to &lt;Directory "C:/xampp/htdocs/ckmpa/public"&gt;
3. Inside **C:/xampp/phpMyAdmin**, open **config.inc.php** and change
    - $cfg['Servers'][$i]['auth_type'] = 'config'; to $cfg['Servers'][$i]['auth_type'] = 'cookie';
4. After you are added as collaborator to UCSD-TIES on Github, from either the graphical Github interface or the command line:
  - git clone https://github.com/UCSD-TIES/ckmpa.git 
      - If you are using git via command line, clone inside **xampp/htdocs** 
      - If you are using graphical Github interface, clone it and make a symlink to the ckmpa folder inside xampp/htdocs from the commandline  
`mklink /D ckmpa C:\Users\\(User)\Documents\GitHub\ckmpa`
5. Open XAMPP Control Panel and start both Apache and MySQL modules
6. Click Admin for MySQL (or visit [localhost/phpmyadmin](http://localhost/phpmyadmin/)) and login as username **root** with **no password** 
7. Under General Settings in the main page, change password to **ck**
8. Click Databases on top and create a database named **coastkeeper** 
9. Click the **coastkeeper** database that you just created then click import on top 
10. Import **ck.sql** from inside ckmpa directory with default settings
11. Login to the application by visiting [localhost](http://localhost) or [localhost/admin](http://localhost/admin) on a browser with 
  -  username: ck 
  -  password: testing

###Mac  
1. Download and install XAMPP from http://www.apachefriends.org/en/xampp.html
2. Inside **/Application/XAMPP/etc/conf**, open **httpd.conf** and change
    - DocumentRoot "/Application/XAMPP/htdocs" to DocumentRoot "/Application/XAMPP/htdocs/ckmpa/public"
    - &lt;Directory "/Application/XAMPP/htdocs"&gt; to &lt;Directory "/Application/XAMPP/htdocs/ckmpa/public"&gt;
3. Inside **/Application/XAMPP/phpMyAdmin**, open **config.inc.php** and change (may need sudo to edit)
    - $cfg['Servers'][$i]['auth_type'] = 'config'; to $cfg['Servers'][$i]['auth_type'] = 'cookie';
4. After you are added as collaborator to UCSD-TIES on Github, from the command line in **/Application/XAMPP/htdocs**:
    - `git clone https://github.com/UCSD-TIES/ckmpa.git`
    - `sudo chown -R daemon:daemon ckmpa/app/storage`
5. Open XAMPP Control Panel and start both Apache and MySQL modules
6. Visit [localhost/phpmyadmin](http://localhost/phpmyadmin/) and login as username **root** with **no password** 
7. Under General Settings in the main page, change password to **ck**
8. Click Databases on top and create a database named **coastkeeper** 
9. Click the **coastkeeper** database that you just created then click import on top 
10. Import **ck.sql** from inside ckmpa directory with default settings
11. Restart Apache if it's already started in XAMPP Control Panel
12. Login to the application by visiting [localhost](http://localhost) or [localhost/admin](http://localhost/admin) on a browser with 
  -  username: ck 
  -  password: testing

# 1dv608-php-project

Author: Johnny Pesola 2015

#Project presentation

##Secure MVC Framework for Fagersta Klätterklubb (Fagersta Climbing Society).

[System requirements](Requirements.md)   

[Online demo of application](http://nya.fagerstaklatterklubb.se)

### Vision

Fagersta klätterklubb (Fagersta Climbing Society) has been in need for a new backend for their homepage.   
The society currently has a very static backend containing two static pages which can be edited. They have   
expressed big plans and desires for the future of the homepage and wished for the following functionality:
*  A multi user login
*  A photo album with video support
*  A file archive for club protocols written on club meetings
*  A calendar functionality for easily displaying coming events.

Theese long going wishes has formed this project into a MVC framework-like web application with thought given  
into the flexibility required for the expandibility of theese long going requirements present in the clubs vision.  
   
The first step was to build an base framework that is fast, secure and is easy to develop in. And the following   
requirements and php application are a product after this first step.

### Installation

The project is tested on nginx and apache2 on a ubuntu server. As mysql database has been used for storage.
*  Install mysql on a windows or linux server.
*  Import the [following mysql database](fagerstaklatterklubb.sql) to the mysql server using your favourite client (perhaps phpmyadmin?).
*  Place the 'App' and 'public' folders on your webserver (nginx or apache2).
*  Configure a site using only the public folder as webroot.
*  If you are using apache, then the .htaccess files should make the application work out of the box.
*  If you are using nginx, you need to add the following line to the sites configuration file (in the location block) as  shown below.
*  use the default credentials: 'admin' as username and 'password' as password to login to the system.   

```
location / {   
      #... other options   
      try_files $uri $uri/ /index.php?url=$uri;   
}
```



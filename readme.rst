#############################
electronic-waste-management-system
#############################
An advanced electronic management system(e-waste) in php using codeigniter framework.


*****************************************************
By `Johnson Matoke <https://github.com/johniez254>`_
*****************************************************

###################
What is CodeIgniter
###################

CodeIgniter is an Application Development Framework - a toolkit - for people
who build web sites using PHP. Its goal is to enable you to develop projects
much faster than you could if you were writing code from scratch, by providing
a rich set of libraries for commonly needed tasks, as well as a simple
interface and logical structure to access these libraries. CodeIgniter lets
you creatively focus on your project by minimizing the amount of code needed
for a given task.

###################
Project Features
###################

	- User identification and authentication
	- Separate Users' (**ADMIN, CLIENT**) privilegdes
	- perform various crud functionalities e.g manage wastes, clients, gadgets
	- Generate customized reports based on the user's priviledges
	- Added SMS and Payment Gateways
	- Plus more awesome features to be explored and to find by yourself.	
	
		- **Admin functionalities**
			+ Manage System settings
			+ add/edit/delete gadgets.
			+ Approve/Dissaprove e-waste disposes.
			+ Mangae clients.
	
		- **Client functionalities**
			+ Add disposes he/she wants to dispose.
			+ Track the disposes individually.

###################
Installing the Electronic waste System
###################
 
One is required to follow the instruction/or procedures as shown in the installation above for Xampp Server. The installation of the above enables the system to have PHP and MySQL installed in the directory; C:\Xampp directory and all other program files.

#######################
Running the E-Waste System
#######################

i)	Create a local folder named "**e-waste**" in htdocs directory found in Xampp Server. 	This is the default publishing folder i.e. C:\Xampp\htdocs for all systems installed using Xampp Server 3.2.2.

ii)	Open command prompt(cmd) and navigate to the folder "**e-waste**" C:\Xampp\htdocs\e-waste.

iii)	Clone the project by running the following bash command:

``` 
$ git clone https://github.com/johniez254/e-waste.git
```

iv) The following files will be available in your cloned project

	.. list-table:: **xampp/htdocs/e-waste/**
	   :widths: 25 75
	   :header-rows: 1

	   * - Folder/File
	     - Description

	   * - ``application/``
	     - contains all the system codeigniterframework files

	   * - ``components/``
	     - contains bootstrap css and javascripsts files, custom system Javascript files e.t.c

	   * - ``hooks/``
	     - Global batch files. (not necessary)

	   * - ``system/``
	     - contains core Codeigniter files

	   * - ``uploads/``
	     - contains all system images, documents, pdf e.t.c

	   * - ``.htaccess``
	     - codeigniter configuration file

	   * - ``.ewaste``
	     - SQL file

	   * - ``.gitignore``
	     - ignored files

	   * - ``.LICENCE``
	     - The MIT standard licence
       
v) Open awaste.sql and copy all the database schemas inside and paste it in your phpmyadmin server under the SQL tab of your mysql server. This action copies all the system tables and queries.

vi) You are almost done. Navigate to your browser open this link URL <http://localhost/e-waste/> to view your already set project.

vi) That's it! Enjoy and have a happy coding experience.


###############################
Super Admin Default Credentials
###############################

username: **admin@gmail.com**

password: **admin123**

N/B: You can always change this credentials once you have logged in with this default credentials in the profile section. Admin can also add client once logged in. There is an option for clients to register themselves too.


*******************
Release Information
*******************

This repo contains in-development code for future releases. To download the
latest stable release please visit the `CodeIgniter Downloads
<https://codeigniter.com/download>`_ page.

**************************
Changelog and New Features
**************************

You can find a list of all changes for each release in the `user
guide change log <https://github.com/bcit-ci/CodeIgniter/blob/develop/user_guide_src/source/changelog.rst>`_.

*******************
Server Requirements
*******************

PHP version 5.6 or newer is recommended.
It should work on 5.3.7 as well, but we strongly advise you NOT to run
such old versions of PHP, because of potential security and performance
issues, as well as missing features.


*******
License
*******

Please see the `license
agreement <https://github.com/bcit-ci/CodeIgniter/blob/develop/user_guide_src/source/license.rst>`_.

*********
Resources
*********

-  `User Guide <https://codeigniter.com/docs>`_
-  `Language File Translations <https://github.com/bcit-ci/codeigniter3-translations>`_
-  `Community Forums <http://forum.codeigniter.com/>`_
-  `Community Wiki <https://github.com/bcit-ci/CodeIgniter/wiki>`_
-  `Community IRC <https://webchat.freenode.net/?channels=%23codeigniter>`_

Report security issues to our `Security Panel <mailto:security@codeigniter.com>`_
or via our `page on HackerOne <https://hackerone.com/codeigniter>`_, thank you.

***************
Acknowledgement
***************

The CodeIgniter team would like to thank EllisLab, all the
contributors to the CodeIgniter project and you, the CodeIgniter user.

## Creator

**Johnson Matoke**

* <https://twitter.com/johnsonnyabayo>
* <https://github.com/johniez254>

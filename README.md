
VideoCMS
=========
VideoCMS is a web based open source video management system developed in PHP and MySQL along with Amazon Web Services integration. 
The System is designed in such a way that user can upload, watch and manage his/her personal videos.The system stores videos either 
in local server or in Amazon S3 based on the user settings. Which means User without Amazon WS account can store videos in local server, and user with Amazon account can store videos in the Amazon S3

Features
--------
&nbsp;&nbsp;&nbsp;Easy video management<br/>
&nbsp;&nbsp;&nbsp;Upload, watch and mange video in the simplest manner<br/>
&nbsp;&nbsp;&nbsp;Categorize Videos efficiently<br/>
&nbsp;&nbsp;&nbsp;Amazon S3 Integration<br/>
&nbsp;&nbsp;&nbsp;Responsive Design<br/>

Required Environment
--------------------
&nbsp;&nbsp;&nbsp;PHP 5 and above<br/>
&nbsp;&nbsp;&nbsp;MySQL<br/>
&nbsp;&nbsp;&nbsp;AWS Account (if any)<br/>

Installation
------------
&nbsp;&nbsp;&nbsp;Copy all files in to your web directory and  for configuring the host and AWS account edit db/db.php and provide necessary credentials. The Database credentials is necessary and the Amazon credentials are optional. Remember that Your directory name must be <b><i>VideoCMS</i></b><br/><br/>
&nbsp;&nbsp;&nbsp;Go to http://your_host_name/VideoCMS/firstrun/ This will create the database and tables in your server. <br/>

&nbsp;&nbsp;&nbsp;If you have an AWS account and you have given the credentials in the db.php, then go to manage link from the Navigation menu. Click the Settings button placed at the right corner of the page. Tick the Upload to S3 check box.<br/><br/>
&nbsp;&nbsp;&nbsp;Yes..!! That's it..<br/><br/>
&nbsp;&nbsp;&nbsp;<b><i>Note: Make sure that Your server upload limit is set to 40M or above in php.ini file and Read-Write permission is set to the entire VideoCMS folder</i></b>
	
How to Use
----------
&nbsp;&nbsp;&nbsp;The home screen will display all of your videos under different categories (Categories that are added by you)<br/><br/>
&nbsp;&nbsp;&nbsp;Now you can start Upload. You have to select both video and thumbnail files. <br/><br/>
&nbsp;&nbsp;&nbsp;The title and description for the video can be added later in the manage page of the application<br/><br/><br/>




Who we are ?
-----------
VideoCMS is developed at [Nethram](http://www.nethram.com). Nethram is a Silicon Valley based telecommunications and cloud innovator. Our mission is to provide the cloud telephony solutions that the big boys use at an affordable price by listening to your needs and providing you with what you actually want.








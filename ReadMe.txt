
1.Table Structure
2.External dependencies
3.Browser Compatibility

************************************************************
I.Table Structure:
************************************************************

1)bait

Field		Type		Null
id		int(11)		No 	 	 	 
odds		double		No
bait_amount	int(11)		No
member_id	tinyint(3)	No
horse_id	tinyint(3)	No
race_id		tinyint(3)	No

============================================================
2)horse

Field		Type		Null
id		int(11)		No 	
horse_name	varchar(255)	No
horse_number	tinyint(3)	No 

============================================================
3)person

Field		Type		Null
id		int(11)		No 	
name		varchar(255)	No
age		varchar(255)	No
sex		varchar(255)	No
contact_number	double		No
addr1		varchar(255)	No
addr2		varchar(255)	No
city		varchar(255)	No
pin		varchar(255)	No
state		varchar(255)	No
nationality	varchar(255)	No

============================================================
4)race

Field		Type		Null
id			int(11)		No 
racing_number	tinyint(3)	No
racing_time	tinyint(3)	No
racing_date	varchar(255)No
duration	tinyint(3)	No

************************************************************
II.External dependencies
************************************************************

	1.For handling keyboard shortcuts in Javascript
	https://github.com/ccampbell/mousetrap
	Include: <script src="mousetrap.min.js"></script>
	
	2.To achieve a fast and concise JavaScript
	http://jquery.com/
	Include: <script type="text/javascript" src="jquery.js"></script>
	
	3.To achieve a popup window while baiting
	Include: <script type="text/javascript" src="popup.js"></script>
	
	4.Install php 5.3.1 or higher version.
	http://php.net/downloads.php
	
	5.Install MySQL server 5.1.41 or higher version
	http://dev.mysql.com/downloads/
	
	6. Create a database in your local and name it as "horserace"
	
************************************************************
III.Browser Compatibility
************************************************************

	1.Internet Explorer 6+
	2.Safari
	3.Firefox
	4.Chrome
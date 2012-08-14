
1.Table Structure
2.External dependencies
3.Browser Compatibility

************************************************************
I.Table Structure:
************************************************************

1)bait

Field		Type		Null
id	int(11)		No 	 	 	 
odds		double		Yes
bait_amount	int(11)		Yes
member_id	tinyint(3)	Yes
horse_id	tinyint(3)	Yes
race_id		tinyint(3)	Yes

============================================================
2)horse

Field			Type		Null
id		int(11)		No 	
horse_name		varchar(255)	
horse_number			tinyint(3)	Yes 

============================================================
3)person

Field			Type			Null
id		int(11)			No 	
name			varchar(255)	Yes
age		varchar(255)	Yes
sex		varchar(255)	Yes
contact_number			double			Yes
addr1			varchar(255)	Yes
addr2			varchar(255)	Yes
city			varchar(255)	Yes
pin		varchar(255)	Yes
state			varchar(255)	Yes
nationality		varchar(255)	Yes

============================================================
4)race

Field			Type			Null
id		int(11)			No 
racing_number			tinyint(3)		Yes
racing_time		tinyint(3)		Yes
racing_date		varchar(255)	Yes
duration		tinyint(3)		Yes

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
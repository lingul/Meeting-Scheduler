# Meeting-Scheduler instructions
<img width="1418" alt="Skärmavbild 2020-11-05 kl  12 05 25" src="https://user-images.githubusercontent.com/57398223/98233894-ec323680-1f5f-11eb-9728-b88034128610.png">

## Overview
**This project is made for the *Individual software project* course available on Blekinge Tekniska Högskola.**
This is a web based application where you can setup meetings and invite people to vote on the meetings or ask them to comment/suggest another time. When developing I used a mac. As my server I used apache web server. For the database I used mysql version 8. And I have written my code in php with javascript.

## Features
Home Page: Application home page where the calendar resides and events are displayed.

Member Sign Up: Page for creation of new accounts.

Member Log In: Page to sign in with existing accounts.

Setup a new event: Create meetings. Click on the event in the calendar to get more information about the meeting.

Add attendens: Inviting participants to vote on meetings by email. The attendens list can be seen at the right top corner.

Voting: Invited participants can vote on meetings.

View event: The host of the event can see the votes and who voted what.

## Project setup
**Make sure that you have mysql database installed**

The commands below are based on Mac OS. Change the commands accordingly if you're using another system.
1. Open up your terminal and do the following:
# Clone the repo
git clone https://github.com/lingul/Meeting-Scheduler.git

2. Go to the mysql webpage:
# Download the database.
You will need the mysql databse. Go to https://dev.mysql.com/downloads/mysql/ if you need to install mysql. I´m using version 8. 

3. Open up your terminal and do the following:
# Setup the database.
Run mysql -h localhost -u root -p < metadata.ddl to setup your database.

4. Go to the apache webpage:
# Make sure you have a webserver.
I´m using XAMPP 7.3.8-2. Go to the link: https://www.apachefriends.org/download.html and download XXAMPP. Then go to Manage Servers and make sure Apache web server is running. Click on Configure and choose a port. I´m using port 8080.

5. Go to localhost
# Done.
* Go to `http://localhost:8080`

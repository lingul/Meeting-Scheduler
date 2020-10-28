Short description: This is a web based application where you can setup meetings and invite people to vote on the meetings or ask them to comment/suggest another time. When developing I used a mac. As my server I used apache web server. For the database I used mysql version 8. And I have written my code in php with javascript.

Home Page: Application home page where the calendar resides and events are displayed.

Member Sign Up: Page for creation of new accounts.

Member Log In: Page to sign in with existing accounts.

Setup a new event: Create meetings. Click on the event in the calendar to get more information about the meeting.

Add attendens: Inviting participants to vote on meetings by email. The attendens list can be seen at the right top corner.

Voting: Invited participants can vote on meetings.

View event: The host of the event can see the votes and who voted what.

To use: 
1. Download the project. Link: https://github.com/lingul/Meeting-Scheduler/tree/master
2. Setup the database. You will need mysql. I´m using version 8. Run mysql -h localhost -u root -p < metadata.ddl to create the database. If you want to have a look at the databse after setup you can login to the database by typing mysql -h localhost -u poll -p poll (with the password poll) in the Terminal.
4. Make sure you have a webserver. I´m using XAMPP 7.3.8-2. Go to link: https://www.apachefriends.org/download.html and download XXAMPP. Then go to Manage Servers and make sure Apache web server is running. Click on Configure and choose a port. I´m using port 8080.
5. Then go to your localhost where you have stored the project using the right port. My adress is http://localhost:8080/dbwebb/meeting-scheduler/.

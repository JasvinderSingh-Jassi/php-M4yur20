# rtlearn PHP ASSIGNMENT(PROBLEM STATEMENT)
## 1. Email a random XKCD challenge
### For random comic fetching, I used a PHP in-built function [rand(min,max)] which returns a random integer between min and max, now here min and max are the minimum and maximum number of comics listed on the XKCD website. After getting a random integer ie. the serial number of a random comic, it is appended to the API link [https://xkcd.com/'.`random_number_here]`.'/info.0.json] then a get request is made in which JSON format of that comic is returned and using this JSON data, that particular comic is then sent to all the users which are subscribed.
### For the repetative nature of email sending, cron job can be used on the local machine and for the platform which I have used for hosting the website [Heroku], it provides add-ons and the one I have used is Heroku Scheduler which is totally free and with help of this scheduler we can schedule any task according to our need to repeat after specific intervals.
### Attributes of the table `users` : 1. id(Primary Key), 2. email(User Email), 3. hash(For verification purposes), 4. is_active(For the purpose of sending email only to subscribed users).
![Screenshot](/images/schema.png)
## Website [https://calm-journey-40539.herokuapp.com]
### This website is developed by using PHP, HTML, CSS and Javascript the database used is MySQL and deployed on Heroku. The website description is as follows:
#### 1. The link for the website will take the user to the Registeration Page, where the user will enter his/her email and according to registeration status, user will get the appropriate message.
![Screenshot](/images/homepage1.png)
![Screenshot](/images/homepage2.png)
#### 2. Verification of email. On the entered email the user will receive a confirmation email with a link, when the user clicks on the link the email id will be successfully verified.
![Screenshot](/images/verifyemail1.png)
![Screenshot](/images/verifyemail2.png)
#### 3. After verification of email, the user will start receiving random comics using the XKCD API at an interval of every 5 minutes(this is done using the Heroku Scheduler add on) and there will also be an unsubscribe link provided in the mail to stop receiving the comic emails.
![Screenshot](/images/comic1.png)
![Screenshot](/images/comic2.png)
#### 4. On clicking the unsubscribe link, the user will no more receive emails of comics.
![Screenshot](/images/unsub1.png)
![Screenshot](/images/unsub2.png)
#### 5. If a registered user again wants to start receiving comics, user can register again and he will start receiving the comic emails again.
![Screenshot](/images/subagain1.png)
![Screenshot](/images/subagain2.png)

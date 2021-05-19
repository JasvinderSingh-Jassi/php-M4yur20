# rtlearn PHP ASSIGNMENT(PROBLEM STATEMENT)
## 1. Email a random XKCD challenge
#### Please create a simple PHP application that accepts a visitor’s email address and emails them random XKCD comics every five minutes.
#### 1. Your app should include email verification to avoid people using others’ email addresses.
#### 2. XKCD image should go as an email attachment as well as inline image content.
#### 3. You can visit https://c.xkcd.com/random/comic/ programmatically to return a random comic URL and then use JSON API for details https://xkcd.com/json.html
#### 4. Please make sure your emails contain an unsubscribe link so a user can stop getting emails.
#### Since this is a simple project it must be done in core PHP including API calls, recurring emails, including attachments should happen in core PHP. Please do not use any libraries.

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

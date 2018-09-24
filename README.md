# TravelGuide

## Project Description
TravelGuide is a **web app** that allows its users to search attractions, hotels and restaurants related to a destination. A user can also search for flight to go from a source to destination. A user can also rate hotel or restaurant.

## Tools and APIs Used
* JetBrains PhpStorm
* Mobirise
* Bootstrap
* XAMPP (Apache Server + MySQL)
* Facebook API

## Functionalities
A user can can searh for a **destination**. A user can search for **attractions** (places to visit), **hotels** and **restaurants** related to a destination. User can also search for **flights** from a source to a destination. User can also apply **filters** to search. For example, user can filter hotels, restaurants and flights on the basis of price range. User can **sort** hotels, restaurants on the basis of Name, Price and Rating. Flights can also be sorted in the order of Company Name, Price and Date.

A user can **Sign Up** using email. Further user can then Sign In using that email. User can also Sing In using Facebook.

A user can also **Rate** restaurants and Hotels. Moreover, a user can also see other users rating and average rating. A user can his/her friends given rating if both have Signed In using Facebook.

A user can also **create a new business** i.e. hotel or restaurant. A user can own a business or can just create it without an owner. A business can have description, contact number, email and address. A user becomes a business user when user owns a business. A business user can do everything plus manage their business. Business user can add new deals, offers etc. to their business.

A **contact us** page is also available in which a user submit a query or a suggestion.


## Requirements
* Apache
* MySQL


## How to Run
Create a new database in MySQL. Run ../master/projectdatabase.sql in that databse. Open ../master/model/DBHelper.php and change $DATABASE_NAME = 'projectdatabase'; to $DATABASE_NAME = '<your database name>';. Then set your MySQL port, user name and password at the end of this file in getMySqliConnection function. Now put view, model and controller folders to your Apache root directory. Then run "localhost:<Apache port number>//view/Home.php".


## Contact
You can get in touch with me on my LinkedIn Profile: [Farhan Shoukat](https://www.linkedin.com/in/farhan-shoukat-782542167/)


## License
[MIT](../master/LICENSE)
Copyright (c) 2018 Farhan Shoukat

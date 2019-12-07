## About Repo
This repo consist on a Admin Panel and a User Interface. The admin can view a simple a dashboard with all users registered on each month, can CRUD a modul called Cars with has a many to many relationship with tags.
User Interface has a simple view that shows all the "products" and user can live search, add to basket, modify cart before checkout.
## After Clone

Please after cloning this repo, to make it work do as following: 
- run "composer dump-autoload"
- run "php artisan migrate"
- run "php artisan db:seed" , this will also create 2 users 1) email: admin@gmail.com pass: admin1234 , 2) email: user@gmail.com pass: user1234

Shopping Cart is a very wide concept and in this task I have tried to cover only the basics.

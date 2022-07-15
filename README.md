# Laravel Whatsapp Clone

## Example

![alt text](https://github.com/WailanTirajoh/laravel-whatsapp-web-clone/blob/main/ex.jpg?raw=true)

## Installation

```
#clone or fork this project
git clone https://github.com/WailanTirajoh/laravel-whatsapp-web-clone.git
#copy .env
cp .env.example .env
#edit .env
nano .env
## at this step you need to configure your database name, and pusher creds, but i already fill it with dummy test.
#install dependency
composer install
#install assets
npm install

#for development
npm run dev

#for deployment
npm run build

#run migration & seeder
php artisan migrate:fresh --seed

#to run websocket (terminal 1)
php artisan websockets:serve

#to run server (terminal 2)
php artisan serve
```

You can login with

user 1
email: wailantirajoh@gmail.com
pass: wailan

user 2
email: putririnding21@gmail.com
pass: putri

or you can create your own account.

You can test this app on https://message.wailantirajoh.tech

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

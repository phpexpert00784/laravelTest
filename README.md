## Instructions to setup

- Clone the project
- RUN composer install
- RUN npm install
- RUN npm run dev
- Add .env file with DB credentials
- Setup in .env for send verfy email

-MAIL_MAILER=smtp
-MAIL_HOST=smtp.gmail.com
-MAIL_PORT=587
-MAIL_USERNAME=EMAIL Acount of gmail with less secured app settings on
-MAIL_PASSWORD=Password OF GMAIL
-MAIL_ENCRYPTION=tls
-MAIL_FROM_ADDRESS=FROM ADDRESS EMAIL

- RUN php artisan migrate 
- RUN php artisan db:seed

-Seeder RUN will add admin user in DB

Credentials :
-Email : admin@gmail.com
-Pass : admin123

Rest all register users are normal users

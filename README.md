# Learn Laravue Starter Kit

### Tech Stacks Used
this project uses a tech stack:
```bash
php version 8.4.11
vue version 3
node version this 22.16.0
composer version 2.8.9
npm version 11.5.1
```

### Installation
#### CLone This Repo
```bash
git clone https://github.com/Zyprush18/learn-laravue.git
cd learn-laravue
```

#### Install Dependencies
```bash
npm install
composer install
```

#### Setup Env And Generate Key
rename file .env.example to .env:
```bash
cp .env.example .env
```
generate key:
```bash
php artisan key:generate
```
setup database (example:if you use mysql):

Change this line:
```bash
DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=
```
To:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```
#### run the migration of the database table along with the seeder
```bash
php artisan migrate --seed
```
#### running app
```bash
composer run dev
```
or

running in terminal 1:
```bash
    php artisan serve
```
and running in terminal 2:
```bash
    npm run dev
```
### Access App
Access App in ```bash http://localhost:8000 ``` and login use:
 - email : test@example.com
 - Password: password

## That's all, thank you

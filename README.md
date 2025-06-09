# Leaving management system

- This is a simple online leaving management single page application(SPA) system built using laravel vue inertia starter kit. Employees can send a leaving request from their user account and admin can view employees request for leaving and take suitable action.

## Features

### Admin features
1. Login
2. View all leave requests
3. Approve or reject leave requests
4. View user statistics
5. View leave request statistics

### Employee features
1. Register
2. Login
3. Send leaving request
4. View leaving request status
6. View leave requests statistics

## Technologies
1. Laravel 12
2. Vue 3
3. Inertia.js 2
4. Mysql 
5. PHP 8.2
6. vue3-toastify (Notification package)
7. NPM

## Installation guide

1. **Clone the repository:**

```bash
git clone <your-repo-url>
cd leaving-management
```

2. **Install PHP dependencies:**
```bash
composer install
```

3. **Copy environment file:**
 ```bash
cp .env.example .env
```
4. **Generate application key:**
```bash
php artisan key:generate
```

5. **Configure `.env` file:**
    Open the `.env` file and set up your database connection details.

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

6.  **Run database migrations:**
```bash
php artisan migrate
```

7.  **Seed the database:**
```bash
php artisan db:seed
```

8.  **Install Node.js dependencies:**
```bash
npm install 
```

9. **Start the Laravel development server:**
```bash
composer run dev
```
The application should now be accessible at `http://127.0.0.1:8000`.


## How to use

### Employee
- After running the system you will see a login form. At the bottom of the form you will find a signup link. By clicking that you will be directed to register form. There you can register as employee and log in to the system. There is side panel. You can navigate to dashboard and leaves form pages.

#### Steps

1. Register as an employee
2. Click on Leaves tab on sidebar
3. Send a leave request by filling the form.
4. View leave requests details under the same page.
5. You can update and delete leave requests by clicking relevant buttons
5. View statistics on dashboard by clicking dashboard tab

### Admin 

After loggin as the admin you will be directed to admin dashboad. There you can manage leave requests.

#### Steps

1. You can log into the system by providing admin credentials below.

```bash
email: admin@example.com
password: password
```

2. Click on Leaves tab on sidebar
3. Accept or reject leave requests
4. Click on the Users tab on sidebar
5. View employees details
6. View statistics on dashboard by clicking dashboard tab


## Project stucture

### Admin panel structure

```
/dashboard -------------------------------- index
/leaves ----------------------------------- index,update 
/users ------------------------------------ index
```

### Employee panel structure

```
/dashboard -------------------------------- index
/leaves ----------------------------------- index,post,update
```






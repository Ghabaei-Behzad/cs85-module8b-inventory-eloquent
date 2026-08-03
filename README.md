Behzad Ghabaei <br>
CS 85 PHP  <br>
Module - Assignment 8B  <br>
Eloquent_inventory database  <br>
Instructor Seno   <br>
7/31/2026  <br>
### Lab Instructions Overview:  <br>
1. Understand how Eloquent connects Laravel models to MySQL tables 
2. Rebuild an inventory database using Laravel migrations and Eloquent 
models 
3. Use a controller and Blade template to display data 
4. Reflect on how ORM changes database workflows 
### Steps
1. Create a new Laravel project 
2. Rebuild the items table using a Laravel migration 
3. Create and configure an Eloquent model 
4. Insert sample data using Laravel Tinker 
5. Use a controller to retrieve data 
6. Display inventory items using Blade 
7. Add a reflection on your experience with Eloquent 

### Set Up and Instructions.
1. Documents\Development can be found in the Command Prompt under 
the C:\Users\etc. path 
run the "laravel new" command first, and call this project 
inventory_eloquent.  
C:\Users\User's Name\Documents\Development> ```laravel new 
inventoy_eloquent ```  <br>
a. ` Update Now? no ` <br>
b. `Starter Kit? None ` <br>
c. `Testing framework? Pest ` <br>
d.` Laravel Boost AI? No ` <br>
`Locking... ` <br>
`Installing... ` <br>
e. `Which database will your application use? mysql`  <br>
f. Default database updated? Run the default database migration? No  <br>
Locking...  <br>
Installing...  <br>
g. Run npm install --ignore scripts and npm run build? no  <br>
2. Documents\Development> ```cd inventory_eloquent ``` (change into the 
project)  <br>
3. inventory_eloquent>```code .```(Open VS Code )  <br>
edit the .env file:  <br>
```
DB_CONNECTION=mysql 
DB_HOST=127.0.0.1 
DB_PORT=3306 
DB_DATABASE=inventory_db 
DB_USERNAME=root 
DB_PASSWORD= you need your mysql password here
```  
4. inventory_eloquent>```php artisan make:migration create_items_table``` 
(Migrations: create a file in database\migrations called 
date_create_items_table ) 
Display this code to the up() function: 
```Schema::create('items', function (Blueprint $table) { 
$table->id(); 
$table->string('item_name'); 
$table->string('category')->nullable(); 
$table->integer('quantity')->default(0); 
$table->date('purchase_date')->nullable(); 
$table->timestamps(); 
});
```
(prepare the database and migration table, however if the table already 
exists it will fail, so you could enter the mysql password into the .env file first and when running "php artisan migrate" if the table does not exist then say yes to create it when the prompt appears.)   <br>
5. inventory_eloquent>```php artisan migrate``` (prepare the database and 
migration table, however if the table already exists it will fail. ) 
remember to add the mysql password to the .env file and run command 
"php artisan migrate"  and answer questions:  <br> -The database "eloquent_inventory" does not exit on the mysql 
connections. would you like to create it? yes  <br>
6. inventory_eloquent>```php artisan make:model Item ```(app\Models\Item.php 
is created.) 
mass assignment for the Items.php file with $fillable:
```
class Item extends Model 
{ 
protected $fillable = ['item_name', 'category', 'quantity', 'purchase_date']; 
} 
```
due to timestamps requring additional code we will make $timestamps = 
false; for this example 
here is our Models\Items.php file:
```
<?php 
namespace App\Models; 
use Illuminate\Database\Eloquent\Model; 
class Item extends Model 
{ 
public $timestamps = false;   
protected $fillable = ['item_name', 'category', 'quantity', 'purchase_date']; 
} 
```  
7. inventory_eloquent>```php artisan tinker ```(tinker is an example of a REPL (Read-Eval-Print Loop), 
now populate the table with inserting sample data)  <br>

>``` \App\Models\Item::create(['item_name' => 'Notebook', 'category' => 
'Stationery', 'quantity' => 10, 'purchase_date' => '2024-07-01']); ```                                      
(Include the path to the file here, for the tinker command) <br>
(An array will return to confirm the insertion)  <br>
```= App\Models\Item {#7946                          
item_name: "Notebook", 
category: "Stationery", 
quantity: 10, 
purchase_date: "2024-07-01", 
id: 6, 
} 
```
>``` \App\Models\Item::create(['item_name' => 'Wireless Mouse', 'category' => 
'Electronics', 'quantity' => 2, 'purchase_date' => '2024-07-10']); ```  <br>
``` = App\Models\Item {#7492 
item_name: "Wireless Mouse", 
category: "Electronics", 
quantity: 2, 
purchase_date: "2024-07-10", 
id: 7, 
} ```
>``` exit  ```  (leave the tinker  REPL (Read-Eval-Print Loop))  <br>
<img width="642" height="218" alt="image" src="https://github.com/user-attachments/assets/bbe642db-5656-4dac-8338-ec9842bcd4f1" />


8. ```inventory_eloquent>php artisan make:controller InventoryController ``` (this 
makes a new file here, at app\Http\Controllers\InventoryController.php) 
Add this to the InventoryController.php file: 
 ```use App\Models\Item; ```// if this line is forgotten then the 
InventoryController.php file does not exist! 
```
public function index() 
{ 
$items = Item::all(); 
return view('inventory.index', ['items' => $items]); 
} 
```
9. make a directory called "```inventory``" in resources\views and create a 
blade file template: name this blade file ```index.blade.php``` with the following 
code: 
```
<ul> 
@foreach($items as $item) 
<li>{{ $item->item_name }} ({{ $item->quantity }}) - {{ $item->category 
}}</li> 
@endforeach 
</ul> 
```
use the right click options on VS Code, or the following,
run commands "cd resources" then run "cd views" then run "mkdir 
inventory" then run "cd../.." to come back to the top of the folder. 
10. Define a route in the routes\web.php file: 
```use App\Http\Controllers\InventoryController; ``` // if this line is forgotten then 
InventoryController.php does not exist! 
```
Route::get('/inventory', [InventoryController::class, 'index']); 
```
11. inventory_eloquent>```php artisan serve``` (to see this table in a browser at 
http://127.0.0.1:8001) 
12. place this Reflection comment in the appropriate file 
resources\views\inventory\index.blade.php with {{--comments--}} syntax 
and save. 
```
{{-- 
Reflection: 
Eloquent simplified how I interacted with the database. 
It helped me write less code and think in objects instead of queries. 
It’s a more modern, scalable way to work with data. --}} 
```
Helpful Mysql commands: 
(In mysql: enter password) 
```SHOW databases; ```  <br>
```USE eloquent_inventory; ```  <br>
```SHOW TABLES; ```  <br>
```SELECT * FROM users;``` (nothing)  <br>
```SELECT * FROM items; ``` <br>
```DESCRIBE users;  ``` <br>
```DESCRIBE items;  ```  <br>



<!--
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
-->

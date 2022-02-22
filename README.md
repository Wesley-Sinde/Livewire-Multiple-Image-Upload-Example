<p align="center"><a href="https://wesley.io.ke" target="_blank"><img src="https://laratutorials.com/wp-content/uploads/2022/02/Laravel-9-Livewire-Multiple-Image-Upload-Example-1024x499.jpg" width="400"></a></p>
<h1>Laravel 9 Livewire Multiple Image Upload Example </h1>
Laravel 9 livewire multiple image upload; Through this tutorial, i am going to show you how to upload multiple image using livewire in laravel 9 apps.


<h2>Laravel 9 Livewire Multiple Image Upload Example</h2>
Follow the below given steps to upload multiple image using livewire in laravel 9 apps:
```php
Step 1 – Install Laravel 9 Application
Step 2 – Database Configuration
Step 3 – Create Model & Migration
Step 4 – Create Multi Upload Routes
Step 5 – Installing Livewire Package
Step 6 – Build Livewire Multiple Image Upload Components
Step 7 – Create Livewire Blade Views
Step 8 – Start Development Server
Step 9 – Run This App On Browser
Step 1 – Install Laravel 9 Application
Go to your local web server directory using the following command:
```
//for windows user
cd xampp/htdocs

//for ubuntu user
cd var/www/html
Then install laravel 9 latest application using the following command:


composer create-project --prefer-dist laravel/laravel blog
Step 2 – Database Configuration
Open downloaded laravel app into any text editor. Then find .env file and configure database detail like following:
```php
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db name
DB_USERNAME=db user name
DB_PASSWORD=db password
```
Step 3 – Create Model & Migration
Run the following command on command prompt to create model and migration file:

php artisan make:model Image -m
The above command will create two files into your laravel livewire multiple image upload application, which is located inside the following locations:


/app/Models/Image.php
/database/migrations/create_contacts_table.php
Now, find Image.php model file inside /app/Models directory. And open it then add the fillable property code into Image.php file, like following:
```php
<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        'title'
    ];
}
Then, find create_images_table.php file inside /database/migrations/ directory. Then open this file and add the following code into function up() on this file:

    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
        });
        
    }
    ```
Now, open again your terminal and type the following command on cmd to create tables into your selected database:

```php
php artisan migrate
```
Step 4 – Create Multi Upload Routes
To open your web.php file, which is located inside routes directory. Then add the following routes into web.php file:

use App\Http\Livewire\MultipleImageUpload;
Route::get('livewire-multiple-image-upload', MultipleImageUpload::class);
Step 5 – Installing Livewire Package
Run following command on command prompt to install livewire package in laravel 9 app:

composer require livewire/livewire
Then install node js package:
```php
npm install
Next run npm

npm run dev
```
Now, run database migration command:

php artisan migrate
Step 6 – Build Livewire Multiple Image Upload Components
Run following command on command prompt to create livewire components in laravel 9 app:
```php
php artisan make:livewire MultipleImageUpload
```
The above command will create two files, which is located on the following locations:

app/Http/Livewire/MultipleImageUpload.php

resources/views/livewire/multiple-image-upload.blade.php
So, open MultipleImageUpload.php, which is located inside app/http/Livewire directory and add the following code into it:

```php
<?php
namespace App\Http\Livewire;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Image;
class MultipleImageUpload extends Component
{
    use WithFileUploads;
    public $images = [];
    public function render()
    {
        return view('livewire.home');
    }
    public function store()
    {
        $this->validate([
            'images.*' => 'image|max:1024', // 1MB Max
        ]);
        foreach ($this->images as $key => $image) {
            $this->images[$key] = $image->store('images','public');
        }
        $this->images = json_encode($this->images);
        Image::create(['title' => $this->images]);
        session()->flash('message', 'Images has been successfully Uploaded.');
        return redirect()->to('/livewire-multiple-image-upload');
    }
}
```
Next, open multiple-image-upload.blade.php, which is located inside resources/views/livewire/ directory and add the following code into it:
```php
<div>
    <form>
        <div class=" add-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="file" class="form-control" wire:model="images" multiple>
                        @error('image.*') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <button class="btn text-white btn-success" wire:click.prevent="store">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>
```
Step 7 – Create Blade View
Go to resources/views/livewire directory and create home.blade.php. Then add the following code into it:
```php
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel 9 Livewire Multiple Image Upload Tutorial - wesley sinde</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
            .full-height {
                height: 100vh;
            }
            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }
            .position-ref {
                position: relative;
            }
            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }
            .content {
                text-align: center;
            }
            .title {
                font-size: 84px;
            }
            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
<body>
    <div class="container mt-5">
        <div class="row mt-5 justify-content-center">
            <div class="mt-5 col-md-8">
                <div class="card">
                  <div class="card-header bg-success">
                    <h2 class="text-white">Laravel 9 Livewire Multiple Image Upload Example - wesley sinde</h2>
                  </div>
                  <div class="card-body">
                    @livewire('image-upload')
                  </div>
                </div>
            </div>
        </div>
    </div>
    @livewireScripts
</body>
</html>
```
Step 8 – Start Development Server
Run the following command on command prompt to start development server for your simple laravel 9 livewire multiple image upload app:

```php
php artisan serve
```
Step 9 – Run This App On Browser
In step 9, open your browser and fire the following url into your browser:
```php
http://127.0.0.1:8000/livewire-multiple-image-upload
```
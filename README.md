#http://laraveldaily.com/how-to-create-a-laravel-5-package-in-10-easy-steps/

    composer require mylaraveldaily/timezones:*@dev
    
    config/app.php

    'providers' => [
        //...
        mylaraveldaily\Timezones\TimezonesServiceProvider::class,

    ],
    



<?php
//http://localhost/timezones/cn/UTC
Route::get('timezones/{locale}/{timezone}', 
  'Mylaraveldaily\Timezones\TimezonesController@index');
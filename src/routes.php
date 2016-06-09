<?php
//http://localhost/timezones/cn/UTC
Route::get('timezones/{locale}/{timezone}', 
  'mylaraveldaily\timezones\TimezonesController@index');
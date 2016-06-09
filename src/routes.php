<?php
//http://localhost/timezones/cn/UTC
Route::get('timezones/{locale}/{timezone}', 
  'Mylaraveldaily\timezones\TimezonesController@index');
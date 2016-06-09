<?php

namespace Mylaraveldaily\Timezones;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App;
use Config;
class TimezonesController extends Controller
{

    public function index($locale="en",$timezone = NULL)
    {
        //获取配置文件
//        print_r(Config::get('Mylaraveldaily.file.myConfog'));die;
        
         App::setLocale($locale);
         //翻译
//        echo trans('trans::messages.welcome');die;
        $current_time = ($timezone)
            ? Carbon::now(str_replace('-', '/', $timezone))
            : Carbon::now();
        return view('timezones::time', compact('current_time'));
    }

}
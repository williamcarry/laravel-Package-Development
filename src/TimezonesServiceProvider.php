<?php

namespace Mylaraveldaily\Timezones;

use Illuminate\Support\ServiceProvider;

class TimezonesServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
        /*
         * loadViewsFrom两个参数，package's name就是你自己起一个facade名称
         * the path to your view templates and your package's name
         * 把所有文件 src\views 变成Facade的
         * 例如以后调用view里面的模板可以用
         * timezones::time 
         * 就是调用了time.blade.php模板
         * 
         */
        $this->loadViewsFrom(__DIR__ . '/views', 'timezones');

        $this->publishes([
            /*
             * 用 php artisan vendor:publish 命令
             * 把模板放在resources/views/Mylaraveldaily/Timezones
             * 这样可以重写
             * 其实在这里添加 $this->publishes 就行了
             * 以后喜欢重写，自己去写
             * 
             * 注意一下两个却别
             * base_path('resources/views/Mylaraveldaily/Timezones')
             * resource_path('views/Mylaraveldaily/Timezones')
             * 
             * php artisan vendor:publish
             */
            __DIR__ . '/views' => base_path('resources/views/Mylaraveldaily/Timezones'),
            //翻译，不知道这么写对不对
            __DIR__ . '/translations' => base_path('resources/lang/Mylaraveldaily/Timezones/trans'),
            /*
             * 配置文件 所有文件	config\Mylaraveldaily\file.php
             * 调用
             * $value=Config::get('Mylaraveldaily.file.myConfog');
             */
            __DIR__ . '/config/file.php' => config_path('Mylaraveldaily/file.php'),
        ]);

        /*
         * assets 例如css js什么的
         * 是网站根目录
         * php artisan vendor:publish --tag=public --force
         * 发布到 public\Mylaraveldaily\Timezones\Mylaraveldaily.css
         */
        $this->publishes([
            __DIR__ . '/assets' => public_path('Mylaraveldaily/Timezones'),
                ], 'public');

        /*
         * 数据库
         * php artisan vendor:publish --tag=migrations --force
         */
        $this->publishes([
            __DIR__ . '/database/migrations' => database_path('migrations')
                ], 'migrations');
        /*
         * 导入src下面的route
         */
        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/routes.php';
        }

        //翻译
        $this->loadTranslationsFrom(__DIR__ . '/translations', 'trans');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        /*
         * 与  config\Mylaraveldaily\file.php 合并
         * 注意路径 要和上面的 $this->publishes 一样
         * This allows your users to include only the options 
         * they actually want to override in the published copy of the configuration. 
         */
        $this->mergeConfigFrom(
                __DIR__ . '/config/file.php', 'Mylaraveldaily/file.php'
        );
        //Resolve the given type from the container.不是太明白
        $this->app->make('Mylaraveldaily\Timezones\TimezonesController');
    }

}

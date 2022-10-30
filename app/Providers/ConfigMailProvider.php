<?php

namespace App\Providers;

use App\Models\ConfigEmail;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class ConfigMailProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (Schema::hasTable('config_emails')) {
            if (!is_null(ConfigEmail::first())){
                $configuration = ConfigEmail::first();
                $config = array(
                    'driver' => $configuration->driver,
                    'host' => $configuration->host,
                    'port' => $configuration->port,
                    'username' => $configuration->username,
                    'password' => $configuration->password,
                    'encryption' => $configuration->encryption,
                    'from' => array('address' => 'choice@gmail.com', 'name' => 'Choice App'),
                );
                Config::set('mail', $config);
            }
            else {
                $config = ConfigEmail::create([
                    "driver" => 'smtp',
                    "host" => 'smtp.gmail.com',
                    "port" => '587',
                    "user_name" => '',
                    "password" => '',
                    "sender_name" => env('APP_NAME'),
                    "sender_email" => ''
                ]);
                Config::set('mail', $config);
            }
        }
    }
}

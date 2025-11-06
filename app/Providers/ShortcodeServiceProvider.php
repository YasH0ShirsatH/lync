<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Thunder\Shortcode\HandlerContainer\HandlerContainer;
use Thunder\Shortcode\Parser\RegularParser;
use Thunder\Shortcode\Processor\Processor;
use App\Shortcodes\LoginFormShortcode;
use App\Shortcodes\RegisterFormShortcode;

class ShortcodeServiceProvider extends ServiceProvider
{
    public function register() {}

    public function boot()
    {
        $handlers = new HandlerContainer();
        $handlers->add('login_form', new LoginFormShortcode());
        $handlers->add('register_form', new RegisterFormShortcode());


        $processor = new Processor(new RegularParser(), $handlers);

        app()->singleton('shortcode', function() use ($processor) {
            return $processor;
        });
    }
}

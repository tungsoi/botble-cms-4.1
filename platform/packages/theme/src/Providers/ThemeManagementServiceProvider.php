<?php

namespace Botble\Theme\Providers;

use Botble\Base\Supports\Helper;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;

class ThemeManagementServiceProvider extends ServiceProvider
{
    /**
     * @throws BindingResolutionException
     */
    public function register()
    {
        $theme = setting('theme');
        if (!empty($theme)) {
            $this->app->make('translator')->addJsonPath(theme_path($theme . '/lang'));
        }
    }

    public function boot()
    {
        $theme = setting('theme');
        if (!empty($theme)) {
            Helper::autoload(theme_path($theme . '/functions'));
        }
    }
}

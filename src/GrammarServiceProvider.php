<?php

namespace Djunehor\Grammar;

use Illuminate\Support\ServiceProvider;

class GrammarServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->publishFiles();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('laravel-grammar', function () {

            return new Word();

        });
    }

    private function publishFiles()
    {
        $publishTag = 'LaravelGrammar';

        $this->publishes([
            __DIR__ . '/config/laravel-grammar.php' => config_path('laravel-grammar.php'),
        ], 'config');
        $this->publishes([
            __DIR__ . "/database/migrations/2019_11_22_145649_create_words_table.php" => database_path('migrations/' . date("Y_m_d_His", time()) . '_create_words_table.php'),
        ], $publishTag);
        $this->publishes([__DIR__ . "/database/seeds/" => database_path('seeds')], $publishTag);
    }

    /**
     * Get the services provided by the provider
     * @return array
     */
    public function provides() : array
    {
        return ['laravel-grammar'];
    }
}

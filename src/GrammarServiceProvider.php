<?php

namespace Djunehor\Grammar;

use Illuminate\Support\Collection;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;

class GrammarServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param Filesystem $filesystem
     * @return void
     */
    public function boot(Filesystem $filesystem)
    {
        $publishTag = 'laravel-grammar';
        if (app() instanceof \Illuminate\Foundation\Application)  {
            $this->publishes([
                __DIR__.'/config/laravel-grammar.php' => config_path('laravel-grammar.php'),
            ], $publishTag);

            $this->publishes([
                __DIR__.'/database/migrations/2019_11_22_145649_create_words_table.php.stub' => $this->getMigrationFileName($filesystem),
            ], $publishTag);

            $this->publishes([
                __DIR__ . "/database/seeds/LaravelGrammarSeeder.php.stub" => database_path('seeds/LaravelGrammarSeeder.php')],
                $publishTag);
            $this->publishes([
                __DIR__ . "/database/seeds/entries.csv.zip" => database_path('seeds/entries.csv.zip')],
                $publishTag);

        }

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

    /**
     * Get the services provided by the provider
     * @return array
     */
    public function provides() : array
    {
        return ['laravel-grammar'];
    }

    /**
     * Returns existing migration file if found, else uses the current timestamp.
     *
     * @param Filesystem $filesystem
     * @return string
     */
    protected function getMigrationFileName(Filesystem $filesystem): string
    {
        $timestamp = date('Y_m_d_His');

        return Collection::make($this->app->databasePath().DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR)
            ->flatMap(function ($path) use ($filesystem) {
                return $filesystem->glob($path.'*_create_laravel_grammars_tables.php');
            })->push($this->app->databasePath()."/migrations/{$timestamp}_create_laravel_grammars_tables.php")
            ->first();
    }
}

<?php

namespace App\Providers;

use App\Services\Parser\Components\{EmojiOutput,
    PrintOutput,
    StringConcatenation,
    SumOfNumbers
};

use App\Services\Parser\ParserService;
use Illuminate\Support\ServiceProvider;


class ParserServiceProvider extends ServiceProvider
{

    private const Parsers = [
        EmojiOutput::class,
        PrintOutput::class,
        SumOfNumbers::class,
        StringConcatenation::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->tag(self::Parsers, 'parsers');

        $this->app->bind(ParserService::class, function ($app) {
            return new ParserService($app->tagged('parsers'));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {

    }
}

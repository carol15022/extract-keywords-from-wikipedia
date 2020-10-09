<?php


namespace App\Facades;

use App\Integrations\WikipediaClient;
use Illuminate\Support\Facades\Facade;

/**
 * @method static object getWikipediaPageContentUsingTitle(string $title)
 */
class Wikipedia extends Facade
{
    protected static function getFacadeAccessor()
    {
        return WikipediaClient::class;
    }
}
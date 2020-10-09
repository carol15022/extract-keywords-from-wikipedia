<?php

namespace App\Commands;

use App\Services\KeywordsService;
use Illuminate\Support\LazyCollection;
use LaravelZero\Framework\Commands\Command;

class GetKeyowrdsFromActorsList extends Command
{
    protected $signature = 'get-keywords-from-actors-list {slice=0 : Get the first n keywords}';

    protected $description = 'Get keywords on wikipedia page for each actor in the actors list';

    public function handle()
    {
        $service = new KeywordsService();
     
        LazyCollection::make(function () {
            $handle = fopen('actors.txt', 'r');
            while (($line = fgets($handle)) !== false) {
                yield trim($line);
            }
        })->each(function (string $actor) use ($service){
            $keywords = $service->getKeywords($actor);
            if($keywords)
            {
                if($this->argument('slice') && is_numeric($this->argument('slice')))
                {
                    $keywords =  array_slice($keywords, 0, $this->argument('slice'));
                }
                $this->line('Actor : '. $actor);
                $this->line('Keywords: ' . implode(' , ', $keywords));
                $this->line('');
                $this->line('');
            }
        });
    }
}

<?php

namespace App\Services;

use App\Facades\Wikipedia;
use DonatelloZa\RakePlus\RakePlus;

class KeywordsService {

    public function getKeywords(string $title)
    {
        $keywords = null;
        
        $wikipediaContent = Wikipedia::getWikipediaPageContentUsingTitle($title);
        if(isset($wikipediaContent->query->pages[0]->extract)) {
            $keywords = RakePlus::create($wikipediaContent->query->pages[0]->extract, 'stopWords_en_US.pattern', 4)->keywords();
        }
        
        return $keywords;
    }

}
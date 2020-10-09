<?php

namespace App\Integrations;

use Illuminate\Support\Facades\Http;

class WikipediaClient {

    public function getWikipediaPageContentUsingTitle(string $title)
    {
        $response = Http::get(config('services.wikipedia.url') . "?action=query&format=json&prop=extracts&exintro&explaintext&titles=". $title. "&formatversion=2");
        return json_decode($response->getBody()->getContents());
    }

}
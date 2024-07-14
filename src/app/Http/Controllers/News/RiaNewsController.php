<?php

namespace App\Http\Controllers\News;

use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;

class RiaNewsController
{
    public function fetchData(Request $request)
    {
        $url = 'https://ria.ru/world/';
        $client = HttpClient::create();

        try {
            $response = $client->request('GET', $url);
            $statusCode = $response->getStatusCode();

            if ($statusCode === 200) {
                $content = $response->getContent();

                // Use DomCrawler to parse HTML content
                $crawler = new Crawler($content);

                // Find all <div> elements with specific class
                $articles = $crawler->filter('div.list-item')-> slice(0, 10) -> each(function (Crawler $node, $i) {
                    $image = $node->filter('.list-item__image img')->attr('src');
                    $heading = $node->filter('.list-item__title')->text();
                    $date = $node->filter('.list-item__date')->text();
                    $post_url = $node->filter('.list-item__content a')->attr('href');

                    return [
                        'heading' => $heading,
                        'image' => $image,
                        'date' => $date,
                    ];
                });

                // $articles now contains an array of associative arrays with 'heading', 'image', 'date', and 'post_url' keys

                return view('ria', [
                    'articles' => $articles,
                ]);
            } else {
                abort(500, "Failed to fetch data from $url");
            }
        } catch (\Exception $e) {
            abort(500, "Failed to fetch data: " . $e->getMessage());
        }
    }
}

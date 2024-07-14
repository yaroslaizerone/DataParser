<?php

namespace App\Http\Controllers\News;

use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class NGSController
{
    /**
     * Fetches and parses data from NGS.ru
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function fetchData(Request $request)
    {
        $url = 'https://ngs.ru/text/';
        $client = HttpClient::create();

        $response = $client->request('GET', $url);
        $statusCode = $response->getStatusCode();

        if ($statusCode === 200) {
            $content = $response->getContent();

            // Use DomCrawler to parse HTML content
            $crawler = new Crawler($content);

            // Find all <article> elements with specific class
            $articles = $crawler->filter('article.OPHIx')->slice(0, 10)->each(function (Crawler $node, $i) {
                $image = $node->filter('._1Swf7.hy967 img')->attr('src');
                $heading = $node->filter('h2.h9Jmx')->text();
                $text = $node->filter('.TdYOd a')->text();
                $date = $node->filter('._2DfZq a')->text();
                $post_url = 'https://ngs.ru' . $node->filter('.h9Jmx a')->attr('href');

                // Fetch full article content
                $client_blog = HttpClient::create();
                $response_blog = $client_blog->request('GET', $post_url);
                $statusCode = $response_blog->getStatusCode();

                if ($statusCode === 200) {
                    $content_blog = $response_blog->getContent();
                    $full_article_crawler = new Crawler($content_blog);
                    $full_text = $full_article_crawler->filter('.uiArticleBlockText_g83x5')->text(); // Assuming this is where the full text is

                    return [
                        'image' => $image,
                        'heading' => $heading,
                        'text' => $text,
                        'date' => $date,
                        'post_url' => $post_url,
                        'full_text' => $full_text,
                    ];
                } else {
                    abort(500, "Failed to fetch data from $post_url");
                }
            });

            // $articles now contains an array of associative arrays with article data

            return view('ngs', [
                'articles' => $articles,
            ]);
        } else {
            abort(500, "Failed to fetch data from $url");
        }
    }
}

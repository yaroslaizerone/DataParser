<?php

namespace App\Http\Controllers\Forecasts;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;
use Illuminate\Support\Facades\Log;

class YandexWeatherController
{
    // Method to fetch weather data from Yandex
    public function fetchData(Request $request)
    {
        // URL for Yandex weather
        $url = 'https://yandex.ru/pogoda?lat=55.030199&lon=82.92043&lang=ru';
        $client = HttpClient::create();

        try {
            // Send GET request to the URL
            $response = $client->request('GET', $url);
            $statusCode = $response->getStatusCode();

            if ($statusCode === 200) {
                // Get the content of the response if the status code is 200
                $content = $response->getContent();

                // Save the HTML content for debugging purposes
                file_put_contents(storage_path('weather.html'), $content);

                // Use DomCrawler to parse HTML content
                $crawler = new Crawler($content);

                // Extract forecasts information
                $forecasts = $crawler->filter('.forecast-briefly__day')->each(function (Crawler $node, $i) {

                    // Extract date, condition, day temperature, and night temperature
                    $date = $node->filter('.forecast-briefly__date')->text();
                    $condition = $node->filter('.forecast-briefly__condition')->text();
                    $tempDay = $node->filter('.forecast-briefly__temp_day .temp__value')->text();
                    $tempNight = $node->filter('.forecast-briefly__temp_night .temp__value')->text();

                    // Fetch the icon URL
                    $iconUrl = $node->filter('.forecast-briefly__icon')->attr('src');

                    // Return extracted data as an associative array
                    return [
                        'date' => $date,
                        'condition' => $condition,
                        'temp_day' => $tempDay,
                        'temp_night' => $tempNight,
                        'icon_url' => $iconUrl,
                    ];
                });

                // Return the view with the extracted forecasts data
                return view('yandex', [
                    'forecasts' => $forecasts,
                ]);
            }
        } catch (\Exception $e) {
            // Handle any exceptions by returning an error response
            return new Response('Error: ' . $e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers\Shops;

use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;

class SlamjamShopController
{
    public function fetchData(Request $request)
    {
        $url = 'https://it.slamjam.com/collections/sneakers?shpxid=e82f1c06-ba18-48f1-879b-debc29c41bde&pagination=5';
        $client = HttpClient::create();

        $response = $client->request('GET', $url);
        $statusCode = $response->getStatusCode();

        if ($statusCode === 200) {
            $content = $response->getContent();
            $crawler = new Crawler($content);

            // Find all product blocks
            $products = $crawler->filter('.product-grid__item')->slice(0, 12) -> each(function (Crawler $node, $i) {
                // Extract product handle
                $productHandle = $node->filter('card-product')->attr('data-product-handle');

                // Extract image URLs
                $imageUrls = $node->filter('.card__media img')->each(function (Crawler $imgNode) {
                    return $imgNode->attr('src');
                });

                // Extract product name
                $productName = trim($node->filter('.card__heading')->text());

                // Extract vendor
                $vendor = trim($node->filter('.vendor')->text());

                // Extract prices
                $priceRegular = trim($node->filter('.price-item--regular')->text());
                $priceSale = $node->filter('.price-item--sale')->count() > 0
                    ? trim($node->filter('.price-item--sale')->text())
                    : null;

                // Extract product link
                $productLink = $node->filter('.card__heading a')->attr('href');

                return [
                    'product_handle' => $productHandle,
                    'image_urls' => $imageUrls,
                    'product_name' => $productName,
                    'vendor' => $vendor,
                    'price_regular' => $priceRegular,
                    'price_sale' => $priceSale,
                    'product_link' => $productLink,
                ];
            });
             return view('slamjam', [
                'products' => $products,
            ]);
        } else {
            echo "Failed to fetch the page. Status code: $statusCode";
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeControllers
{
    // Method to display the home view
    public function index()
    {
        return view('home');
    }

    // Method to handle data fetching based on the source input from the request
    public function fetchData(Request $request)
    {
        // Retrieve the 'source' input from the request
        $source = $request->input('source');

        // Use a match expression to handle different sources and redirect accordingly
        return match ($source) {
            'ngs' => redirect()->route('ngsnews'), // Redirect to 'ngsnews' route if source is 'ngs'
            'ria' => redirect()->route('rianews'), // Redirect to 'rianews' route if source is 'ria'
            'yandex' => redirect()->route('yandexweather'), // Redirect to 'yandexweather' route if source is 'yandex'
            'slamjam' => redirect()->route('slamjam'), // Redirect to 'slamjam' route if source is 'slamjam'
            default => redirect()->back()->with('error', 'Invalid data source'), // Redirect back with error if source is invalid
        };
    }
}

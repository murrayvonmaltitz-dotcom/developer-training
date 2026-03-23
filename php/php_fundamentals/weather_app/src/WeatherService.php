<?php

namespace WeatherApp;

use GuzzleHttp\Client;

class WeatherService {

    private Client $client; 

    public function __construct(
        private readonly string $apiKey = '7246de415ccc5d4ff9c4fbb2852575d6',
        private string $apiUrl = 'https://api.openweathermap.org/data/2.5/weather'
    )
    {        
        //guzzle specific class
        $this->client = new Client();
    }

    public function getWeather(string $city): array 
    {
        //adding parameters to api call (guzzle)
        $response = $this->client->get($this->apiUrl, [
            'query' => [
                'q' => $city,
                'appid' => $this->apiKey,
                'units' => 'metric'
            ]
        ]);
        //response comes back as json string, decoding 
        $weatherData = json_decode($response->getBody()->getContents(), true);

        //return array with data from the response 
        return [
            'city' => $weatherData['name'],
            'temperature' => $weatherData['main']['temp'],
            'decription' => $weatherData['weather'][0]['description'],
            'humidity' => $weatherData['main']['humidity']
        ];
    }
}
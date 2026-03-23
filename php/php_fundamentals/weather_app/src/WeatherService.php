<?php

namespace WeatherApp;

use GuzzleHttp\Client;

class WeatherService {

    private Client $client; 

    public function __construct(
        private readonly string $apiKey = 'dd0d1daa92314679085a7f9f76873df8',
        private string $apiEndpoint = 'https://api.openweathermap.org/data/2.5/weather'
    )
    {        
        //guzzle specific class
        $this->client = new Client();
    }

    public function getWeather(string $city): array 
    {
        //adding parameters to api call (guzzle)
        $response = $this->client->get($this->apiEndpoint, [
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
            'description' => $weatherData['weather'][0]['description'],
            'humidity' => $weatherData['main']['humidity']
        ];
    }
}
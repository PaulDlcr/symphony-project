<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class WeatherController extends AbstractController
{
    //use OpenWeatherMap API
    #[Route('/weather')]
function index(): Response
    {
    $apiKey = "##################";
    $location = 'Paris';
    $url = 'https://api.openweathermap.org/data/2.5/weather?' .
    'q=' . urlencode($location) .
        '&appid=' . $apiKey .
        '&lang=fr';
    $response = file_get_contents($url);
    $weatherData = json_decode($response, true);
    $temperature = $weatherData['main']['temp'] - 273.15;
    $description = $weatherData['weather'][0]['description'];
    $wind = $weatherData['wind']['speed'];
    return $this->render('lucky/weather.html.twig', [
        'temperature' => $temperature,
        'description' => $description,
        'wind' => $wind,
    ]);
}

}

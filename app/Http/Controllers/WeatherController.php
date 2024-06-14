<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function index()
    {
        $response = Http::get(env('WEATHER_API_URL'));

        if ($response->successful()) {
            $weatherData = $response->json();
            $formattedData = $this->formatWeatherData($weatherData);
            return view('dashboard', ['weather' => $formattedData]);
        } else {
            return view('dashboard', ['error' => 'Unable to retrieve weather data']);
        }
    }

    public function index2()
    {
        $response = Http::get(env('WEATHER_API_URL'));

        if ($response->successful()) {
            $weatherData = $response->json();
            $formattedData = $this->formatWeatherData($weatherData);
            return view('test', ['weather' => $formattedData]);
        } else {
            return view('test', ['error' => 'Unable to retrieve weather data']);
        }
    }

    public function updateTimestamp(Request $request)
    {
        $request->validate([
            'sunrise' => 'required|numeric|digits:10',
            'sunset' => 'required|numeric|digits:10',
        ], [
            'sunrise.required' => 'Please fill in the sunrise column with UNIX Timestamp format.',
            'sunset.required' => 'Please fill in the sunset column with UNIX Timestamp format.',
            'sunrise.numeric' => 'The sunrise timestamp must be a valid number.',
            'sunset.numeric' => 'The sunset timestamp must be a valid number.',
            'sunrise.digits' => 'The sunrise timestamp must be a 10-digit UNIX timestamp.',
            'sunset.digits' => 'The sunset timestamp must be a 10-digit UNIX timestamp.',
        ]);

        $sunriseTimestamp = $request->input('sunrise');
        $sunsetTimestamp = $request->input('sunset');

        $formattedSunrise = $this->convertTimestamp($sunriseTimestamp);
        $formattedSunset = $this->convertTimestamp($sunsetTimestamp);

        $response = Http::get(env('WEATHER_API_URL'));

        if ($response->successful()) {
            $weatherData = $response->json();
            $formattedData = $this->formatWeatherData($weatherData);

            $formattedData['sys']['sunrise'] = $formattedSunrise;
            $formattedData['sys']['sunset'] = $formattedSunset;

            return view('test', ['weather' => $formattedData]);
        } else {
            return view('test', ['error' => 'Unable to retrieve weather data']);
        }
    }

    private function formatWeatherData($data)
    {
        return [
            'coord' => $data['coord'],
            'weather' => $data['weather'][0],
            'main' => [
                'temp' => $data['main']['temp'],
                'feels_like' => $data['main']['feels_like'],
                'temp_min' => $data['main']['temp_min'],
                'temp_max' => $data['main']['temp_max'],
                'pressure' => $data['main']['pressure'],
                'humidity' => $data['main']['humidity'],
                'sea_level' => $data['main']['sea_level'],
                'grnd_level' => $data['main']['grnd_level'],
            ],
            'visibility' => $data['visibility'],
            'wind' => $data['wind'],
            'sys' => [
                'sunrise' => $this->convertTimestamp($data['sys']['sunrise']),
                'sunset' => $this->convertTimestamp($data['sys']['sunset']),
                'country' => $data['sys']['country'],
            ],
            'timezone' => $data['timezone'],
            'name' => $data['name'],
        ];
    }

    private function convertTimestamp($timestamp)
    {
        return date('l, d F Y H:i:s', $timestamp);
    }
}

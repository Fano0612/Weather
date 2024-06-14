<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Weather Information</title>
    <link rel="icon" type="image/x-icon" href="{{ URL::asset('https://static.vecteezy.com/system/resources/previews/021/988/565/original/sticker-drizzle-weather-elements-symbol-good-for-prints-web-smartphone-app-posters-infographics-logo-sign-etc-vector.jpg') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .background {
            position: fixed;
            background-size: cover;
            top: 0;
            left: 0;
            z-index: -1;
            width: 100%;
            height: 100%;
        }

        .background video {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            z-index: -1;
            transform: translate(-50%, -50%);
        }

        .weather-info {
            text-align: center;
            color: white;
            max-width: 800px;
            margin: auto;
        }

        .weather-info h1,
        .weather-info h2,
        .weather-info h3,
        .weather-info h4 {
            margin: 0;
            font-weight: 400;
        }

        .combined-box {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 30px;
            border-radius: 10px;
            margin-top: 20px;
        }

        .combined-box p {
            margin: 5px 0;
        }

        .combined-box .row {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin-bottom: 10px;
        }

        .animation {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto;
        }

        .animation img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .sunrise,
        .sunset {
            text-align: center;
            margin: 0 15px;
        }
    </style>
</head>

<body>
    <div class="background">
        <video autoplay muted loop id="bgVideo">
            <source src="{{ asset('Cloudy.mp4') }}" type="video/mp4">
        </video>
    </div>
    <div class="container mt-5 weather-info">
        <h2>Java Island, Indonesia <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9f/Flag_of_Indonesia.svg/1280px-Flag_of_Indonesia.svg.png" alt="Weather Icon" style="width:30px;height:20px;"></h2>
        <h4>Coordinates: Longitude {{ $weather['coord']['lon'] }}, Latitude {{ $weather['coord']['lat'] }}</h4>
        <h1>{{ $weather['main']['temp'] }} &deg;C</h1>
        <h3>{{ $weather['weather']['main'] }} - {{ $weather['weather']['description'] }}</h3>
        <h3>Feels Like: {{ $weather['main']['feels_like'] }} &deg;C</h3>
        <h3>H = {{ $weather['main']['temp_max'] }} &deg;C L = {{ $weather['main']['temp_min'] }} &deg;C</h3>

        <div class="combined-box">
            <div class="row">
                <p>Timezone: {{ $weather['timezone'] }}</p>
                <p>Pressure: {{ $weather['main']['pressure'] }} hPa</p>
            </div>
            <div class="row">
                <p>Humidity: {{ $weather['main']['humidity'] }}%</p>
                <p>Sea Level: {{ $weather['main']['sea_level'] }} hPa</p>
            </div>
            <div class="row">
                <p>Ground Level: {{ $weather['main']['grnd_level'] }} hPa</p>
                <p>Visibility: {{ $weather['visibility'] }} m</p>
            </div>
            <div class="row">
                <p>Wind Speed: {{ $weather['wind']['speed'] }} m/s</p>
                <p>Wind Direction: {{ $weather['wind']['deg'] }}&deg;</p>
                <p>Wind Gust: {{ $weather['wind']['gust'] }} m/s</p>
            </div>
            <div class="row">
                <div class="sunrise">
                    <div class="animation">
                        <img src="{{ asset('Sunrise.gif') }}" alt="Sunrise Animation">
                    </div>
                    <p>Sunrise: {{ $weather['sys']['sunrise'] }}</p>
                </div>
                <div class="sunset">
                    <div class="animation">
                        <img src="{{ asset('Sunrise_out.gif') }}" style="transform: scaleX(-1);" alt="Sunset Animation">
                    </div>
                    <p>Sunset: {{ $weather['sys']['sunset'] }}</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

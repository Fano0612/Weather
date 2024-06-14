<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Timestamp Test</title>
    <link rel="icon" type="image/x-icon" href="https://static.vecteezy.com/system/resources/previews/021/988/565/original/sticker-drizzle-weather-elements-symbol-good-for-prints-web-smartphone-app-posters-infographics-logo-sign-etc-vector.jpg">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

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
            background-color: rgba(0, 0, 0, 0.5);
            padding: 30px;
            border-radius: 10px;
            margin-top: 20px;
        }

        .combined-box .row {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin-bottom: 10px;
        }

        .sunrise,
        .sunset {
            text-align: center;
            flex: 1;
        }

        .sunrise .animation,
        .sunset .animation {
            margin: 0 auto 10px;
        }

        .animation img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .combined-box p {
            margin: 5px 0;
            text-align: left;
        }

        .left-side,
        .right-side,
        .middle {
            flex: 1;
        }

        .left-side,
        .right-side {
            text-align: left;
        }

        .middle {
            text-align: center;
        }

        .left-side .animation,
        .right-side .animation {
            margin: 0 auto 10px;
        }

        .wind-info {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }
    </style>
</head>

<body>
    <div class="background">
        <video autoplay muted loop id="bgVideo">
            <source src="Cloudy.mp4" type="video/mp4">
        </video>
    </div>
    <div class="container mt-5 weather-info">
        <h4>Java Island, Indonesia <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9f/Flag_of_Indonesia.svg/1280px-Flag_of_Indonesia.svg.png" alt="Weather Icon" style="width:30px;height:20px;"></h4>
        <h5>Coordinates: Longitude {{ $weather['coord']['lon'] }}, Latitude {{ $weather['coord']['lat'] }}</h5>
        <h1>{{ $weather['main']['temp'] }} &deg;C</h1>
        <h4>{{ $weather['weather']['main'] }} - {{ $weather['weather']['description'] }}</h4>
        <h4>Feels Like: {{ $weather['main']['feels_like'] }} &deg;C</h4>
        <h4>H = {{ $weather['main']['temp_max'] }} &deg;C L = {{ $weather['main']['temp_min'] }} &deg;C</h4>

        <div class="combined-box">
            <form method="POST" action="/update-timestamp">
                @csrf
                <div class="mb-3">
                    <label for="sunrise" class="form-label">Sunrise Timestamp</label>
                    <input type="text" class="form-control @error('sunrise') is-invalid @enderror" id="sunrise" name="sunrise" placeholder="Enter sunrise timestamp" value="{{ old('sunrise') }}">
                    @error('sunrise')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="sunset" class="form-label">Sunset Timestamp</label>
                    <input type="text" class="form-control @error('sunset') is-invalid @enderror" id="sunset" name="sunset" placeholder="Enter sunset timestamp" value="{{ old('sunset') }}">
                    @error('sunset')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <br>
            <div class="row">
                <div class="col-md-4 left-side">
                    <p>Timezone: {{ $weather['timezone'] }}</p>
                    <p>Humidity: {{ $weather['main']['humidity'] }}%</ p>
                    <p>Ground Level: {{ $weather['main']['grnd_level'] }} hPa</p>
                    <p>Wind Speed: {{ $weather['wind']['speed'] }} m/s</p>
                    <div class="sunrise">
                        <div class="animation" style="width:50px; height:50px">
                            <img src="Sunrise.gif" alt="Sunrise Animation">
                        </div>
                        <p>Sunrise: {{ $weather['sys']['sunrise'] }}</p>
                    </div>
                </div>
                <div class="col-md-4 middle">
                    <div class="wind-info">
                        <p>Wind Direction: {{ $weather['wind']['deg'] }}&deg;</p>
                    </div>
                </div>
                <div class="col-md-4 right-side">
                    <p>Pressure: {{ $weather['main']['pressure'] }} hPa</p>
                    <p>Sea Level: {{ $weather['main']['sea_level'] }} hPa</p>
                    <p>Visibility: {{ $weather['visibility'] }} m</p>
                    <p>Wind Gust: {{ $weather['wind']['gust'] }} m/s</p>
                    <div class="sunset">
                        <div class="animation" style="width:50px; height:50px">
                            <img src="Sunrise_out.gif" style="transform: scaleX(-1);" alt="Sunset Animation">
                        </div>
                        <p>Sunset: {{ $weather['sys']['sunset'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>
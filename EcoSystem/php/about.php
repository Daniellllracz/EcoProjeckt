<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../images/favicon.ico">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <title>Eco Mobility</title>
    <style>
        #map {
            width: 100%;
            height: 500px;
        }
    </style>
</head>

<body>
    <nav>
        <ul>
            <li><a href='../html/home.html'>Kezdőlap</a></li>
            <li><a href="../php/about.php">Töltő állomások</a></li>
        </ul>
    </nav>

    <section>
        <h1>About Eco Mobility</h1>
        <p>Eco Mobility is designed to promote sustainable transportation by reducing carbon emissions and encouraging the use of eco-friendly vehicles. Our system offers efficient rental services, detailed tracking, and environmental insights.</p>
    </section>

    <h1>Elektromos Autók Töltőállomásai Magyarországon</h1>
    <div id="map"></div>

    <section>
    <h2>Elektromos Autók és Rollerek Pontjai</h2>
    <table id="locationTable">
        <thead>
            <tr>
                <th>Város</th>
                <th>Típus</th>
                <th>Jel</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Budapest</td>
                <td>Autótöltő állomás</td>
                <td>Kék nyíl</td>
            </tr>
            <tr>
                <td>Budapest</td>
                <td>Roller gyűjtőhely</td>
                <td>Zöld levél</td>
            </tr>
            <tr>
                <td>Szeged</td>
                <td>Autótöltő állomás</td>
                <td>Kék nyíl</td>
            </tr>
            <tr>
                <td>Szeged</td>
                <td>Roller gyűjtőhely</td>
                <td>Zöld levél</td>
            </tr>
            <!-- További városok hasonló módon -->
        </tbody>
    </table>
</section>



    <script>
        // Térkép inicializálása
        var map = L.map('map').setView([47.1625, 19.5033], 7); // Magyarország középpont

        // OpenStreetMap csempe hozzáadása
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Elektromos autók töltőállomásainak példái
        var carChargerLocations = [
            { lat: 47.498, lng: 19.04, name: "Budapest Töltőállomás" },
            { lat: 46.253, lng: 20.148, name: "Szeged Töltőállomás" },
            { lat: 47.902, lng: 19.041, name: "Gyöngyös Töltőállomás" },
            { lat: 46.845, lng: 16.841, name: "Zalaegerszeg Töltőállomás" },
            { lat: 47.090, lng: 17.911, name: "Veszprém Töltőállomás" },
            { lat: 47.678, lng: 18.056, name: "Esztergom Töltőállomás" },
            { lat: 48.104, lng: 20.791, name: "Miskolc Töltőállomás" },
            { lat: 47.196, lng: 18.410, name: "Székesfehérvár Töltőállomás" },
            { lat: 46.903, lng: 19.689, name: "Kecskemét Töltőállomás" },
            { lat: 46.379, lng: 18.918, name: "Pécs Töltőállomás" },
            { lat: 52.52, lng: 13.405, name: "Berlin Autótöltő"},
            { lat: 48.1351, lng: 11.582, name: "München Autótöltő"},
            { lat: 48.2082, lng: 16.3738, name: "Bécs Autótöltő"},
            { lat: 47.7982, lng: 13.0435, name: "Salzburg Autótöltő"},
            { lat: 48.8566, lng: 2.3522, name: "Párizs Autótöltő"},
            { lat: 43.2965, lng: 5.3698, name: "Marseille Autótöltő"},
            { "lat": 40.7128, "lng": -74.0060, "name": "New York City EV Charging Station" },
            { "lat": 51.5074, "lng": -0.1278, "name": "London EV Charging Station" },
            { "lat": 34.0522, "lng": -118.2437, "name": "Los Angeles EV Charging Station" },
            { "lat": 39.9042, "lng": 116.4074, "name": "Beijing EV Charging Station" },
            { "lat": 35.6762, "lng": 139.6503, "name": "Tokyo EV Charging Station" },
            { "lat": -33.8688, "lng": 151.2093, "name": "Sydney EV Charging Station" },
            { "lat": 40.7306, "lng": -73.9352, "name": "Brooklyn EV Charging Station" },
            { "lat": 52.5200, "lng": 13.4050, "name": "Berlin EV Charging Station" },
            { "lat": 55.7558, "lng": 37.6173, "name": "Moscow EV Charging Station" },
            { "lat": 37.7749, "lng": -122.4194, "name": "San Francisco EV Charging Station" },
            { "lat": 59.3293, "lng": 18.0686, "name": "Stockholm EV Charging Station" },
            { "lat": 48.1351, "lng": 11.5820, "name": "Munich EV Charging Station" },
            { "lat": 40.7306, "lng": -73.9352, "name": "Queens EV Charging Station" },
            { "lat": -34.6037, "lng": -58.3816, "name": "Buenos Aires EV Charging Station" },
            { "lat": 41.9028, "lng": 12.4964, "name": "Rome EV Charging Station" },
            { "lat": 19.4326, "lng": -99.1332, "name": "Mexico City EV Charging Station" },
            { lat: 40.7306, lng: -73.9352, name: "Brooklyn Electric Car Charger" },
            { lat: 51.5074, lng: -0.1278, name: "London EV Charging Hub" },
            { lat: 34.0522, lng: -118.2437, name: "Los Angeles Electric Car Station" },
            { lat: 40.7128, lng: -74.0060, name: "New York City Electric Car Charger" },
            { lat: 37.7749, lng: -122.4194, name: "San Francisco EV Charger Station" },
            { lat: 39.9042, lng: 116.4074, name: "Beijing Electric Car Hub" },
            { lat: 55.7558, lng: 37.6176, name: "Moscow EV Charging Point" },
            { lat: 48.8566, lng: 2.3522, name: "Paris Electric Car Charging Station" },
            { lat: 43.6532, lng: -79.3832, name: "Toronto Electric Car Station" },
            { lat: 51.1657, lng: 10.4515, name: "Berlin Electric Car Charger" },
            { lat: 55.9533, lng: -3.1883, name: "Edinburgh EV Charging Center" },
            { lat: 39.7392, lng: -104.9903, name: "Denver Electric Car Charging Point" },
            { lat: 31.7683, lng: 35.2137, name: "Jerusalem Electric Car Hub" }

        ];

        // Elektromos autók markerei
        carChargerLocations.forEach(function(location) {
            L.marker([location.lat, location.lng]).addTo(map).bindPopup(location.name);
        });

        // Elektromos rollerek gyűjtőhelyeinek markerei
        var scooterLocations = [
            { lat: 47.512, lng: 19.058, name: "Budapest Roller Gyűjtőhely" },
            { lat: 46.271, lng: 20.141, name: "Szeged Roller Gyűjtőhely" },
            { lat: 47.89, lng: 19.05, name: "Gyöngyös Roller Gyűjtőhely" },
            { lat: 46.858, lng: 16.86, name: "Zalaegerszeg Roller Gyűjtőhely" },
            { lat: 47.081, lng: 17.904, name: "Veszprém Roller Gyűjtőhely" },
            { lat: 47.679, lng: 18.071, name: "Esztergom Roller Gyűjtőhely" },
            { lat: 48.103, lng: 20.807, name: "Miskolc Roller Gyűjtőhely" },
            { lat: 47.202, lng: 18.425, name: "Székesfehérvár Roller Gyűjtőhely" },
            { lat: 46.910, lng: 19.703, name: "Kecskemét Roller Gyűjtőhely" },
            { lat: 46.372, lng: 18.931, name: "Pécs Roller Gyűjtőhely" },
            { lat: 53.55, lng: 9.9937, name: "Hamburg Roller Gyűjtőhely"},
            { lat: 50.9375, lng: 6.9603, name: "Köln Roller Gyűjtőhely"},
            { lat: 47.07, lng: 15.4395, name: "Graz Roller Gyűjtőhely"},
            { lat: 47.2692, lng: 11.4041, name: "Innsbruck Roller Gyűjtőhely"},
            { lat: 45.764, lng: 4.8357, name: "Lyon Roller Gyűjtőhely"},
            { lat: 44.8378, lng: -0.5792, name: "Bordeaux Roller Gyűjtőhely"},
            { lat: 40.7128, lng: -74.0060, name: "New York City Electric Car Charger" },
            { lat: 51.5074, lng: -0.1278, name: "London Electric Car Charging Station" },
            { lat: 34.0522, lng: -118.2437, name: "Los Angeles E-scooter Dock" },
            { lat: 35.6895, lng: 139.6917, name: "Tokyo EV Charging Point" },
            { lat: 48.2082, lng: 16.3738, name: "Vienna Bike Rental Station" },
            { lat: 52.3676, lng: 4.9041, name: "Amsterdam Electric Scooter Hub" },
            { lat: 39.9042, lng: 116.4074, name: "Beijing EV Charging Hub" },
            { lat: 41.9028, lng: 12.4964, name: "Rome Scooter Station" },
            { lat: -33.8688, lng: 151.2093, name: "Sydney Electric Car Dock" },
            { lat: -34.6037, lng: -58.3816, name: "Buenos Aires E-bike Station" },
            { lat: 40.7306, lng: -73.9352, name: "Brooklyn Electric Scooter Pickup" },
            { lat: 55.7558, lng: 37.6176, name: "Moscow EV Charging Center" },
            { lat: 37.7749, lng: -122.4194, name: "San Francisco EV Charger Station" },
            { lat: 39.7392, lng: -104.9903, name: "Denver Electric Bike Hub" },
            { lat: 59.3293, lng: 18.0686, name: "Stockholm Electric Vehicle Parking" },
            { lat: -22.9068, lng: -43.1729, name: "Rio de Janeiro Scooter Station" },
            { lat: 40.730610, lng: -73.935242, name: "Manhattan EV Charging Point" },
            { lat: 47.512, lng: 19.058, name: "Budapest Electric Scooter Dock" },
            { lat: 48.2082, lng: 16.3738, name: "Vienna E-scooter Station" },
            { lat: 52.3676, lng: 4.9041, name: "Amsterdam Scooter Hub" },
            { lat: 55.9533, lng: -3.1883, name: "Edinburgh Electric Scooter Dock" },
            { lat: 41.9028, lng: 12.4964, name: "Rome Scooter Rental Dock" },
            { lat: 34.0522, lng: -118.2437, name: "Los Angeles Scooter Pickup" },
            { lat: 40.7306, lng: -73.9352, name: "Brooklyn Electric Scooter Pickup" },
            { lat: 48.8566, lng: 2.3522, name: "Paris E-scooter Rental" },
            { lat: 55.7558, lng: 37.6176, name: "Moscow E-scooter Dock" },
            { lat: 40.730610, lng: -73.935242, name: "Manhattan E-scooter Hub" },
            { lat: 39.9042, lng: 116.4074, name: "Beijing Electric Scooter Station" },
            { lat: 41.0070, lng: 28.9840, name: "Istanbul E-scooter Docking Station" }
        ];

        scooterLocations.forEach(function(location) {
            L.marker([location.lat, location.lng], { icon: L.icon({
                iconUrl: 'https://leafletjs.com/examples/custom-icons/leaf-green.png',
                iconSize: [38, 95],
                iconAnchor: [22, 94],
                popupAnchor: [-3, -76]
            })}).addTo(map).bindPopup(location.name);
        });
        var additionalLocations = [
];

    </script>
    
</body>

</html>

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
            { lat: 43.2965, lng: 5.3698, name: "Marseille Autótöltő"}
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
            { lat: 44.8378, lng: -0.5792, name: "Bordeaux Roller Gyűjtőhely"}
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

function initMap() {
    const hungary = { lat: 47.1625, lng: 19.5033 }; // Magyarország középpontja
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 7,
        center: hungary,
    });

    // Elektromos töltőállomások helyei
    const locations = [
        { lat: 47.498, lng: 19.040 }, // Budapest
        { lat: 46.253, lng: 20.148 }, // Szeged
        { lat: 47.902, lng: 19.041 }, // Gyöngyös
        { lat: 46.845, lng: 16.841 }, // Zalaegerszeg
    ];

    // Marker hozzáadása az összes helyhez
    locations.forEach(location => {
        new google.maps.Marker({
            position: location,
            map: map,
        });
    });
}
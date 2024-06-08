function loadMap() {
    var locations = [
        { name: "Sai samporna Organics", lat: 12.98, lng: 80.19, address: "No. 8b, 2nd Main Road Ram Nagar, Nanganallur, Chennai - 600061 Near Anjenyar Temple Next to CUB ATM ", image: "img/sam.jpeg" },
        { name: "Greengalaxy", lat: 13.041007, lng: 80.199432, address: "No 11/683, 46th street,9th sector,KK nagar, Chennai-600078", image: "img/greengalaxy.jpeg" },
        { name: "Ewalusion", lat: 13.16, lng: 80.3, address: "No:99/60, 3rd Street, Jeevanlal Nagar, Tiruvottiyur, Chennai - 600019 (Opp. to Royal Enfield Motors)", image: "img/evalusion.jpg" },
        { name: "Palmpro", lat: 11.0235778, lng: 76.94258539999998, address: "7a, 2nd Main Road, 2nd Main Roadrajammal Nagar Phase 1 Road, Madambakkam, Coimbatore - 600126", image: "img/palmpro.jpeg" },
        { name: "JK Views Prabha", lat: 13.109045, lng: 80.204941, address: "No 4/122, A Type, 39th Street, Villivakkam, Chennai - 600049 (Near Thilagam Store , Sidco Nagar)", image: "img/JK.jpeg" },
        { name: "Smris Handcrafted From India", lat: 12.88, lng: 80.23, address: "Smris, First Floor, 2/98 D, Service Road, Old Mahabalipuram Road Semmencheri, Sholinganallur, Chennai - 600119 (Opposite to Sathyabama University, Next to Bus Stop, Above Legend Sports)", image: "img/smris.jpeg" }
    ];

    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12,
        center: { lat: 13.08, lng: 80.24 } // Center the map at Kilpauk
    });

    // Loop through the locations array to create markers and info windows
    locations.forEach(function(location) {
        var marker = new google.maps.Marker({
            position: { lat: location.lat, lng: location.lng },
            map: map,
            title: location.name // Set the marker title to the location name
        });

        // Create the content for the info window with address and image
        var content = '<div><h2>' + location.name + '</h2>' +
                      '<p>' + location.address + '</p>' +
                      '<img src="' + location.image + '" width="150" height="100"></div>';

        // Create an info window for each marker
        var infoWindow = new google.maps.InfoWindow({
            content: content // Set the content of the info window to the address and image
        });

        // Add a click event listener to each marker to open the info window
        marker.addListener('click', function() {
            infoWindow.open(map, marker);
        });
    });
}

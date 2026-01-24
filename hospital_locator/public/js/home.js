console.log("home from javascript assets");

// ----------- GLOBAL VARIABLES -----------
const findHospital = document.getElementById('find-hospital');
const hospitalID = document.getElementById('hospital-id');
const btnFormSubmit = document.getElementById('btn-form-submit');
let hospitals = null;

console.log("app url: " + window.APP_URL);
console.log("API KEY: " + window.API_KEY);
const APP_URL = window.APP_URL;
const API_KEY = window.API_KEY;

let map;
let marker;
let extraMarkers = [];
let directionsService;
let directionsRenderer;

// ----------- FETCH HOSPITALS -----------
async function getHospitals() {
    try {
        const res = await fetch('http://localhost/hospital_locator/public/api/hospitals/');

        if (!res.ok) throw new Error('Failed to fetch hospitals');

        hospitals = await res.json();

        hospitals.forEach(hospital => {
            const option = document.createElement('option');
            option.value = JSON.stringify(hospital);
            option.textContent = hospital.hospital_name;
            findHospital.appendChild(option);
        });
    } catch (error) {
        console.error('Error:', error.message);
    }
}

getHospitals();

// ----------- INITIALIZE MAP -----------
function initMap() {
    const defaultLocation = { lat: 6.3350, lng: 5.6037 };

    map = new google.maps.Map(document.getElementById("map"), {
        zoom: 10,
        center: defaultLocation,
    });

    marker = new google.maps.Marker({
        position: defaultLocation,
        map: map,
        title: "Default Location"
    });

    // Directions setup
    directionsService = new google.maps.DirectionsService();
    directionsRenderer = new google.maps.DirectionsRenderer({
        suppressMarkers: false
    });
    directionsRenderer.setMap(map);
}

// Load Google Maps dynamically
const script = document.createElement('script');
script.src = `https://maps.googleapis.com/maps/api/js?key=${API_KEY}&libraries=places&callback=initMap`;
script.async = true;
script.defer = true;
document.head.appendChild(script);

// ----------- CALCULATE ROUTE -----------
function calculateRoute(destination) {
    if (!navigator.geolocation) {
        alert("Geolocation is not supported by your browser");
        return;
    }

    navigator.geolocation.getCurrentPosition(position => {
        const origin = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
        };

        directionsService.route(
            {
                origin: origin,
                destination: destination,
                travelMode: google.maps.TravelMode.DRIVING
            },
            (result, status) => {
                if (status === google.maps.DirectionsStatus.OK || status === "OK") {
                    directionsRenderer.setDirections(result);
                } else {
                    alert("Unable to calculate route: " + status);
                }
            }
        );
    }, () => {
        alert("Unable to get your current location");
    });
}

// ----------- HANDLE HOSPITAL SELECTION -----------
findHospital.addEventListener('change', function () {
    // Clear previous extra markers
    extraMarkers.forEach(m => m.setMap(null));
    extraMarkers = [];

    // Clear previous directions
    directionsRenderer.set('directions', null);

    btnFormSubmit.disabled = true;
    document.getElementById('logo').src = `${APP_URL}images/default_logo.png`;
    document.getElementById("address").innerHTML = `NIL<br>NIL<br>NIL, NIL<br>NIL`;

    if (findHospital.value) {
        btnFormSubmit.disabled = false;

        const hospital = JSON.parse(findHospital.value);
        hospitalID.value = hospital.id;

        const logoPath = `${APP_URL}storage/${hospital.logo_path}`;
        document.getElementById('logo').src = logoPath;

        document.getElementById("address").innerHTML = `
            Accredited:  <b>${hospital.accred_status}</b><br>
            ${hospital.address}<br>
            ${hospital.city}, ${hospital.state}, ${hospital.zipcode} <br>
            ${hospital.country}<br>
            Email: <a href="mailto:${hospital.email}">${hospital.email}</a><br>
            Phone: <a href="tel:${hospital.contact_no}">${hospital.contact_no}</a>
        `;

        const newLocation = {
            lat: parseFloat(hospital.latitude),
            lng: parseFloat(hospital.longitude)
        };

        map.setCenter(newLocation);
        map.setZoom(14);

        marker.setPosition(newLocation);
        marker.setTitle(hospital.hospital_name);
        marker.setMap(map);

        // Only calculate route if hospital is in Nigeria
        if (hospital.country && hospital.country.toLowerCase() === 'nigeria') {
            calculateRoute(newLocation);
        } else {
            alert("Route calculation is only available for hospitals within Nigeria.");
        }

    } else {
        // No hospital selected: show all markers
        marker.setMap(null);

        hospitals.forEach(hospital => {
            const m = new google.maps.Marker({
                position: {
                    lat: parseFloat(hospital.latitude),
                    lng: parseFloat(hospital.longitude)
                },
                map: map,
                title: hospital.hospital_name
            });
            extraMarkers.push(m);
        });

        // Adjust map to show all hospitals
        if (hospitals.length) {
            const bounds = new google.maps.LatLngBounds();
            hospitals.forEach(h => {
                bounds.extend({
                    lat: parseFloat(h.latitude),
                    lng: parseFloat(h.longitude)
                });
            });
            map.fitBounds(bounds);
        }
    }
});

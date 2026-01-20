console.log("home from javascript assets");

// .................   LOAD HOSPITAL SELECTION WITH OPTIONS .................

const findHospital = document.getElementById('find-hospital');
const hospitalID = document.getElementById('hospital-id');
const btnFormSubmit = document.getElementById('btn-form-submit');
let hospitals = null;

async function getHospitals() {
    try {
        const res = await fetch('http://localhost/hospital_locator/public/api/hospitals/');

        if (!res.ok) {
            throw new Error('Failed to fetch posts');
        }

        // const hospitals = await res.json();
        hospitals = await res.json();

        hospitals.forEach(hospital => {
            console.log(hospital);
            // console.log(hospital.id);
            const optionValue = JSON.stringify(hospital);
            console.log(optionValue);
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


//...............................................................

// .................   LOAD MAP ..........................

console.log("app url: "+window.APP_URL);
console.log("API KEY: " + window.API_KEY);
const APP_URL = window.APP_URL;
const API_KEY = window.API_KEY; 
let map;          
let marker;       
let extraMarkers = []; // Store additional markers so we can clear them

function initMap() {
    const defaultLocation = { lat: 5.5908, lng: 6.1001 };
    map = new google.maps.Map(document.getElementById("map"), {
        zoom: 10,
        center: defaultLocation,
    });

    marker = new google.maps.Marker({
        position: defaultLocation,
        map: map,
        title: "Default Location"
    });
}

// Dynamically load Google Maps
const script = document.createElement('script');
script.src = `https://maps.googleapis.com/maps/api/js?key=${API_KEY}&libraries=places&callback=initMap`;
script.async = true;
script.defer = true;
document.head.appendChild(script);
// .................   End LOAD MAP ..........................


// .................   FIND EACH HOSPITAL LOCATION ..............
findHospital.addEventListener('change', function () {
    // Remove extra markers
    extraMarkers.forEach(m => m.setMap(null));
    extraMarkers = [];

    btnFormSubmit.disabled = true;

    document.getElementById('logo').src = `${APP_URL}images/default_logo.png`;
    document.getElementById("address").innerHTML = `
      NIL<br>
      NIL<br>
      NIL, NIL<br>
      NIL
    `;

    if (findHospital.value) {
        btnFormSubmit.disabled = false;
        const hospital = JSON.parse(findHospital.value);
        hospitalID.value = hospital.id;
        // console.log(hospitalID.outerHTML);
        // console.log(hospital.logo_path);
        const logoPath = `${APP_URL}storage/${hospital.logo_path}`;
        console.log(logoPath);
        document.getElementById('logo').src = logoPath;

        // document.getElementById('logo').src = `http://localhost/hospital_locator/public/storage/logos/john_max_well_hospital.png`;


        document.getElementById("address").innerHTML = `
            Accredited:  <b>${hospital.accred_status}</b><br>
            ${hospital.address}<br>
            ${hospital.city}, ${hospital.state}<br>
            ${hospital.country}
            Email: <a href="mailto:${hospital.email}">${hospital.email}</a><br>
            Phone: <a href="tel:${hospital.contact_no}">${hospital.contact_no}</a>
        `;

        const newLocation = {
            lat: parseFloat(hospital.latitude),
            lng: parseFloat(hospital.longitude)
        };

        map.setCenter(newLocation);
        map.setZoom(14);

        // Ensure main marker is visible again
        marker.setPosition(newLocation);
        marker.setTitle(hospital.hospital_name);
        marker.setMap(map);

    } else {

        // Hide main marker
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

//...........................................................................
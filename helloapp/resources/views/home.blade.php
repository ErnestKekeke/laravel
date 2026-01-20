<!-- resources/views/map.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Online Location System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
        }
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }
        .controls {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: 500;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        button {
            background: #4285f4;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: background 0.3s;
        }
        button:hover {
            background: #357ae8;
        }
        #map {
            width: 100%;
            height: 600px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .locations-list {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-top: 20px;
        }
        .location-item {
            padding: 15px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .location-item:last-child {
            border-bottom: none;
        }
        .delete-btn {
            background: #dc3545;
            padding: 8px 16px;
            font-size: 12px;
        }
        .delete-btn:hover {
            background: #c82333;
        }
        .info {
            background: #e3f2fd;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
            font-size: 14px;
            color: #1976d2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📍 Online Location System</h1>
        
        <div class="controls">
            <div class="info">
                Click on the map to add a new location marker
            </div>
            <form id="locationForm">
                <div class="form-group">
                    <label>Location Name *</label>
                    <input type="text" id="name" required placeholder="Enter location name">
                </div>
                <div class="form-group">
                    <label>Latitude *</label>
                    <input type="number" id="latitude" step="any" required readonly>
                </div>
                <div class="form-group">
                    <label>Longitude *</label>
                    <input type="number" id="longitude" step="any" required readonly>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea id="description" rows="3" placeholder="Enter description (optional)"></textarea>
                </div>
                <button type="submit">Save Location</button>
            </form>
        </div>

        <div id="map"></div>

        <div class="locations-list">
            <h2>Saved Locations</h2>
            <div id="locationsList"></div>
        </div>
    </div>

    <script>
        let map;
        let markers = [];
        let tempMarker = null;

        // Initialize map
        function initMap() {
            // Default to Lagos, Nigeria
            map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: 6.5244, lng: 3.3792 },
                zoom: 12
            });

            // Add click listener
            map.addListener('click', function(e) {
                placeMarker(e.latLng);
            });

            // Load existing locations
            loadLocations();
        }

        // Place temporary marker
        function placeMarker(location) {
            if (tempMarker) {
                tempMarker.setMap(null);
            }

            tempMarker = new google.maps.Marker({
                position: location,
                map: map,
                icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'
            });

            document.getElementById('latitude').value = location.lat();
            document.getElementById('longitude').value = location.lng();
        }

        // Load all locations
        async function loadLocations() {
            try {
                const response = await fetch('/locations');
                const locations = await response.json();

                // Clear existing markers
                markers.forEach(m => m.setMap(null));
                markers = [];

                // Add markers
                locations.forEach(loc => {
                    addMarker(loc);
                });

                // Update list
                updateLocationsList(locations);
            } catch (error) {
                console.error('Error loading locations:', error);
            }
        }

        // Add marker to map
        function addMarker(location) {
            const marker = new google.maps.Marker({
                position: { lat: parseFloat(location.latitude), lng: parseFloat(location.longitude) },
                map: map,
                title: location.name
            });

            const infoWindow = new google.maps.InfoWindow({
                content: `<strong>${location.name}</strong><br>${location.description || ''}`
            });

            marker.addListener('click', function() {
                infoWindow.open(map, marker);
            });

            markers.push(marker);
        }

        // Update locations list
        function updateLocationsList(locations) {
            const list = document.getElementById('locationsList');
            
            if (locations.length === 0) {
                list.innerHTML = '<p style="color: #999; padding: 20px; text-align: center;">No locations saved yet</p>';
                return;
            }

            list.innerHTML = locations.map(loc => `
                <div class="location-item">
                    <div>
                        <strong>${loc.name}</strong><br>
                        <small style="color: #666;">${loc.latitude}, ${loc.longitude}</small><br>
                        ${loc.description ? `<small>${loc.description}</small>` : ''}
                    </div>
                    <button class="delete-btn" onclick="deleteLocation(${loc.id})">Delete</button>
                </div>
            `).join('');
        }

        // Save location
        document.getElementById('locationForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const data = {
                name: document.getElementById('name').value,
                latitude: document.getElementById('latitude').value,
                longitude: document.getElementById('longitude').value,
                description: document.getElementById('description').value
            };

            try {
                const response = await fetch('/locations', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(data)
                });

                if (response.ok) {
                    // Reset form
                    this.reset();
                    if (tempMarker) {
                        tempMarker.setMap(null);
                        tempMarker = null;
                    }

                    // Reload locations
                    loadLocations();
                    alert('Location saved successfully!');
                }
            } catch (error) {
                console.error('Error saving location:', error);
                alert('Error saving location');
            }
        });

        // Delete location
        async function deleteLocation(id) {
            if (!confirm('Are you sure you want to delete this location?')) {
                return;
            }

            try {
                const response = await fetch(`/locations/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if (response.ok) {
                    loadLocations();
                    alert('Location deleted successfully!');
                }
            } catch (error) {
                console.error('Error deleting location:', error);
                alert('Error deleting location');
            }
        }
    </script>

    <!-- Replace YOUR_API_KEY with your actual Google Maps API key -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5Ids2no6ktU1Qujo-ZdZwViFPtqVfBSU&callback=initMap" async defer></script>
</body>
</html>
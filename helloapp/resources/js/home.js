console.log('home');

navigator.geolocation.getCurrentPosition(position => {
  const userLocation = {
    lat: position.coords.latitude,
    lng: position.coords.longitude
  };

  console.log(userLocation);
});




// Inisialisasi Peta
const map = L.map("map").setView([-5.5489, 111.0149], 7);
L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution: "&copy; OpenStreetMap contributors",
}).addTo(map);

// WebSocket
const socket = new WebSocket("ws://127.0.0.1:8080");
const markers = {};

// Update Marker Pesawat
function updateMarker(flightData) {
    const {
        latitude,
        longitude,
        id,
        heading,
        altitude,
        groundSpeed,
        aircraftCode,
        callsign,
        onGround,
        verticalSpeed,
    } = flightData;

    if (
        !isFinite(latitude) ||
        !isFinite(longitude) ||
        latitude < -90 ||
        latitude > 90 ||
        longitude < -180 ||
        longitude > 180
    ) {
        console.error("Koordinat tidak valid:", latitude, longitude);
        return;
    }

    const endPos = L.latLng(latitude, longitude);
    const duration = 4000;
    const iconHTML = `
                <div style="transform: rotate(${heading}deg); width: 25px; height: 30px;">
                    <img src="home/assets/images/plane.png" style="width: 100%; height: 100%;" alt="plane" />
                </div>
            `;
    const icon = L.divIcon({
        className: "flight-icon",
        html: iconHTML,
    });

    map.on("click", () => {
        document.getElementById("leftPopupMenuP").classList.remove("active");
    });

    if (!markers[id]) {
        markers[id] = L.marker([latitude, longitude], {
            icon,
        }).addTo(map);
        markers[id].on("click", () => showFlightDetails(flightData));
    } else {
        const startPos = markers[id].getLatLng();
        interpolateMarker(markers[id], startPos, endPos, duration, () => {
            markers[id].setIcon(icon);
        });
    }
}

//informasi data
function showFlightDetails(flightData) {
    const {
        latitude,
        longitude,
        id,
        icao24bit,
        heading,
        altitude,
        groundSpeed,
        aircraftCode,
        registration,
        time,
        originAirportIata,
        destinationAirportIata,
        number,
        airlineIata,
        onGround,
        verticalSpeed,
        callsign,
        airlineIcao,
    } = flightData;

    // Bisa kamu format waktu timestamp jadi readable juga jika perlu
    const timeString = new Date(time * 1000).toLocaleString();

    const popupContentP = `
        <strong>Callsign:</strong> ${callsign}<br>
        <strong>Airline ICAO:</strong> ${airlineIcao}<br>
        <strong>Flight Number:</strong> ${number}<br>
        <strong>Aircraft Code:</strong> ${aircraftCode}<br>
        <strong>Registration:</strong> ${registration}<br>
        <strong>Altitude:</strong> ${altitude} ft<br>
        <strong>Speed:</strong> ${groundSpeed} knots<br>
        <strong>Vertical Speed:</strong> ${verticalSpeed} ft/min<br>
        <strong>Heading:</strong> ${heading}°<br>
        <strong>Status:</strong> ${onGround ? "On Ground" : "In Flight"}<br>
        <strong>Origin Airport:</strong> ${originAirportIata}<br>
        <strong>Destination Airport:</strong> ${destinationAirportIata}<br>
        <strong>Latitude:</strong> ${latitude}<br>
        <strong>Longitude:</strong> ${longitude}<br>
        <strong>ICAO 24-bit:</strong> ${icao24bit}<br>
        <strong>ID:</strong> ${id}<br>
        <strong>Timestamp:</strong> ${timeString}
    `;

    document.getElementById("popupContentP").innerHTML = popupContentP;
    document.getElementById("leftPopupMenuP").classList.add("active");
}

function interpolateMarker(marker, startPos, endPos, duration, updateIcon) {
    const startTime = performance.now();

    function animate(time) {
        const elapsedTime = time - startTime;
        const t = Math.min(elapsedTime / duration, 1);
        const lat = startPos.lat + (endPos.lat - startPos.lat) * t;
        const lng = startPos.lng + (endPos.lng - startPos.lng) * t;
        marker.setLatLng([lat, lng]);

        if (t < 1) requestAnimationFrame(animate);
        else if (updateIcon) updateIcon();
    }

    requestAnimationFrame(animate);
}

socket.onmessage = (event) => {
    try {
        const flightDataArray = JSON.parse(event.data);
        console.log("Data diterima:", flightDataArray);
        flightDataArray.forEach(updateMarker);
    } catch (error) {
        console.error("Kesalahan parsing:", error.message);
    }
};

socket.onopen = () => console.log("WebSocket terhubung");
socket.onerror = (error) => console.error("WebSocket error:", error.message);
socket.onclose = () => console.log("WebSocket ditutup");

// Brightness Control
document.getElementById("brightnessRange").addEventListener("input", (e) => {
    document.getElementById(
        "map"
    ).style.filter = `brightness(${e.target.value})`;
});

// Map Modes
const baseLayers = {
    streets: L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"),
    satellite: L.tileLayer(
        "https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}"
    ),
    dark: L.tileLayer(
        "https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png"
    ),
    topographic: L.tileLayer(
        "https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png"
    ),
    hybrid: L.tileLayer("https://mt1.google.com/vt/lyrs=y&x={x}&y={y}&z={z}"),
};

function setMapMode(mode) {
    map.eachLayer((layer) => map.removeLayer(layer));
    if (baseLayers[mode]) baseLayers[mode].addTo(map);
}

// Popup Menu Control
function closeAllPopups() {
    document
        .querySelectorAll(".left-popup-menu")
        .forEach((p) => p.classList.remove("active"));
}

function togglePopup(id) {
    const popup = document.getElementById(id);
    const isActive = popup.classList.contains("active");
    closeAllPopups();
    if (!isActive) popup.classList.add("active");
}

// Aliases for specific popups
const togglePopupMenu = () => togglePopup("popupMenu");
const toggleLoginPopup = () => togglePopup("loginPopup");
const toggleLeftPopupMenu = () => togglePopup("leftPopupMenu");
const toggleLeftPopupMenuWeather = () => togglePopup("leftPopupMenuWeather");
const toggleLeftPopupMenuStatus = () => togglePopup("leftPopupMenuStatus");
const toggleLeftPopupMenuReport = () => togglePopup("leftPopupMenuReport");
const toggleLeftPopupMenuNotif = () => togglePopup("leftPopupMenuNotif");
const toggleLeftPopupMenuCommands = () => togglePopup("leftPopupMenuCommands");
const toggleLeftPopupMenuDirections = () =>
    togglePopup("leftPopupMenuDirections");
const toggleLeftPopupMenuP = () => togglePopup("leftPopupMenuP");

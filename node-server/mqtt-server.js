const mqtt = require('mqtt');
const WebSocket = require('ws');

// Konfigurasi MQTT
const MQTT_BROKER = 'mqtt://8.215.50.229:1883'; // alamat broker
const MQTT_TOPIC = 'flightradar/filteredFlights';      // Topik
// const MQTT_BROKER = 'mqtt://127.0.0.1:1883'; // dummy
// const MQTT_TOPIC = 'flight/dummy';      // Topik dummy
const client = mqtt.connect(MQTT_BROKER);

// Jalankan WebSocket Server
const wss = new WebSocket.Server({ port: 8080 });

// Sambungkan ke broker MQTT
client.on('connect', () => {
    console.log('Connected to MQTT broker');
    client.subscribe(MQTT_TOPIC, (err) => {
        if (err) console.error('Failed to subscribe:', err.message);
    });
});

// Saat menerima pesan dari broker MQTT
client.on('message', (topic, message) => {
    if (topic === MQTT_TOPIC) {
        const flightData = JSON.parse(message.toString());
        console.log('Received from MQTT:', flightData);

        // Kirim data ke semua klien WebSocket
        wss.clients.forEach(client => {
            if (client.readyState === WebSocket.OPEN) {
                client.send(JSON.stringify(flightData));
            }
        });
    }
});

// Tangani koneksi WebSocket
wss.on('connection', ws => {
    console.log('New WebSocket connection');
});

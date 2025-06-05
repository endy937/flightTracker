@extends('layouts.main')

@section('title', 'Command Center Mpsr')

<body>
    <div id="map" class="map"> </div>
    <!-- popup info pesawat -->
    <div class="left-popup-menu" id="leftPopupMenuP">
        <div class="popup-pesawat-header">
            <div>
                <button class="close-btn" onclick="toggleLeftPopupMenuP()">&times;</button>
            </div>
        </div>
        <div class="popup-content-pesawat" id="popupContentP"></div>
    </div>

    <!-- pop up pilih map -->
    <div class="left-popup-menu" id="leftPopupMenu">
        <button class="close-btn" onclick="toggleLeftPopupMenu()">&times;</button>

        <!-- Popup Header -->
        <div class="popup-header">Settings</div>

        <!-- Popup Content -->
        <div class="judul">
            <h2>MAP STYLE</h2>
        </div>
        <div class="popup-content">
            <div class="map-mode" onclick="setMapMode('streets')">
                <img src="{{ asset('home/assets/images/default.png') }}" alt="">
                <div class="label-bottom">DEFAULT</div>
            </div>
            <div class="map-mode" onclick="setMapMode('hybrid')">
                <img src="{{ asset('home/assets/images/hybrid.png') }}" alt="">
                <div class="label-bottom">HYBRID</div>
            </div>
            <div class="map-mode" onclick="setMapMode('satellite')">
                <img src="{{ asset('home/assets/images/satelit.png') }}" alt="">
                <div class="label-bottom">SATELLITE</div>
            </div>
            <div class="map-mode" onclick="setMapMode('dark')">
                <img src="{{ asset('home/assets/images/dark.png') }}" alt="">
                <div class="label-bottom">DARK</div>
            </div>
            <div class="map-mode" onclick="setMapMode('topographic')">
                <img src="{{ asset('home/assets/images/topog.png') }}" alt="">
                <div class="label-bottom">TOPOGRAPHIC</div>
            </div>
            <div class="map-mode" onclick="setMapMode('topographic')">
                <img src="{{ asset('home/assets/images/topog.png') }}" alt="">
                <div class="label-bottom">TOPOGRAPHIC</div>
            </div>

        </div>

        <!-- Brightness Control -->
        <div class="brightness-control">
            <label for="brightnessRange">Adjust Map Brightness:</label>
            <input type="range" id="brightnessRange" min="0.5" max="1.5" step="0.1" value="1">
        </div>

        Day-Night Control
        <div class="day-night-control" style="display: none;">
            <label for="dayNightToggle"></label>
            <input type="checkbox" id="dayNightToggle">
        </div>
    </div>

    <!-- popup menu weather -->
    <div class="left-popup-menu" id="leftPopupMenuWeather">
        <button class="close-btn" onclick="toggleLeftPopupMenuWeather()">&times;</button>
        <div class="popup-header">Weather</div>
    </div>

    <div class="bottom-bar">
        <button onclick="toggleLeftPopupMenu()"><img src="{{ asset('home/assets/images/settings.png') }}"></button>
        <button onclick="toggleLeftPopupMenuWeather()"><img
                src="{{ asset('home/assets/images/weather.png') }}"></button>
        <button onclick="toggleLeftPopupMenuStatus()"><img
                src="{{ asset('home/assets/images/radarrev.png') }}"></button>
        <button onclick="toggleLeftPopupMenuReport()"><img src="{{ asset('home/assets/images/report.png') }}"></button>
        <button onclick="toggleLeftPopupMenuNotif()"><img src="{{ asset('home/assets/images/notif.png') }}"></button>

    </div>
</body>

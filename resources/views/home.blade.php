@extends('layouts.main')

@section('title', 'Flight Traking')

@section('maps')
    <div id="mapContainer" style="position: relative; width: 100%; height: 100%;">
        <!-- MAP -->
        <div id="map" class="map">
            <!-- popup info pesawat -->
            <div class="left-popup-menu" id="leftPopupMenuP">
                <div class="popup-pesawat-header">
                    <div>
                        <button class="close-btn" onclick="toggleLeftPopupMenuP()">&times;</button>
                    </div>
                </div>
                <div class="popup-content-pesawat" id="popupContentP"></div>
            </div>
        </div>

        <div id="coordinate"></div>

        <!-- Map mode button -->
        <div id="mapModeBtn" class="leaflet-bar leaflet-control leaflet-control-custom"
            style="bottom: 50px; left: 10px; position: absolute; z-index: 1000;">
            <img src="{{ asset('home/assets/images/layers.png') }}" style="width: 30px; height: 30px;" alt="Map Mode">
        </div>

        <!-- Map mode menu -->
        <div id="mapModeMenu"
            style="display: none; position: absolute; bottom: 60px; left: 10px; background: rgba(0,0,0,0.8); color: white; padding: 5px; border-radius: 5px; z-index: 1001;">
            <div class="mode-option" data-mode="streets">Streets</div>
            <div class="mode-option" data-mode="satellite">Satellite</div>
            <div class="mode-option" data-mode="dark">Dark</div>
            <div class="mode-option" data-mode="dark2">Dark 2</div>
            <div class="mode-option" data-mode="topographic">Topographic</div>
            <div class="mode-option" data-mode="hybrid">Hybrid</div>
        </div>

        <!-- Fullscreen button -->
        <div id="fullscreenBtn" class="leaflet-bar leaflet-control leaflet-control-custom"
            style="bottom: 20px; right: 10px; position: absolute; z-index: 1000; cursor: pointer;">
            <img id="fullscreenIcon" src="{{ asset('home/assets/images/full.png') }}" style="width: 30px; height: 30px;"
                alt="Fullscreen">
        </div>
        <div class="">
            <label
                style="position: absolute; top: 10px; right: 10px; z-index: 9999; background: rgba(255,255,255,0.7); padding: 5px 10px; border-radius: 8px;">
                <input type="checkbox" id="toggleSave" />
                Simpan ke Database
            </label>
        </div>

    </div>


@endsection

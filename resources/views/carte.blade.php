@extends('layouts.app')

@section('title', 'Carte de la qualité de l\'air')

@section('content')
<div class="health-card p-6">
    <h2 class="text-2xl font-heading font-semibold mb-6">Carte de la qualité de l'air</h2>
    
    <div id="map" style="height: 500px; width: 100%;" class="rounded-lg"></div>
    
    <div class="mt-6 grid grid-cols-5 gap-2 text-xs">
        <div class="aqi-indicator aqi-good text-xs">1 - Bon</div>
        <div class="aqi-indicator aqi-moderate text-xs">2 - Modéré</div>
        <div class="aqi-indicator aqi-unhealthy-sensitive text-xs">3 - Malsain</div>
        <div class="aqi-indicator aqi-very-unhealthy text-xs">4 - Très malsain</div>
        <div class="aqi-indicator aqi-hazardous text-xs">5 - Dangereux</div>
    </div>
</div>
@endsection
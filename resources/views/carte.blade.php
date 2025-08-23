@extends('layouts.app')

@section('title', 'Carte de la qualité de l\'air')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-6">Carte de la qualité de l'air</h2>
    
    <div id="map" style="height: 500px; width: 100%;" class="rounded-lg"></div>
    
    <div class="mt-6 grid grid-cols-5 gap-2 text-xs">
        <div class="bg-green-100 p-2 text-center rounded">1 - Bon</div>
        <div class="bg-yellow-100 p-2 text-center rounded">2 - Modéré</div>
        <div class="bg-orange-100 p-2 text-center rounded">3 - Malsain</div>
        <div class="bg-red-100 p-2 text-center rounded">4 - Très malsain</div>
        <div class="bg-purple-100 p-2 text-center rounded">5 - Dangereux</div>
    </div>
</div>
@endsection
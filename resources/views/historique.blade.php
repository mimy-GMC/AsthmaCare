@extends('layouts.app')

@section('title', 'Historique des Symptômes')

@section('content')
<div class="space-y-6">
    <h2 class="text-2xl font-heading font-bold text-gray-800">Historique des Symptômes</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="health-card">
            <h3 class="text-lg font-semibold mb-2 text-gray-700">Évolution des crises</h3>
            <canvas id="chartCrises"></canvas>
        </div>

        <div class="health-card">
            <h3 class="text-lg font-semibold mb-2 text-gray-700">Intensité moyenne</h3>
            <canvas id="chartIntensite"></canvas>
        </div>

        <div class="health-card md:col-span-2">
            <h3 class="text-lg font-semibold mb-2 text-gray-700">Déclencheurs fréquents</h3>
            <canvas id="chartDeclencheurs"></canvas>
        </div>
    </div>
</div>
@endsection

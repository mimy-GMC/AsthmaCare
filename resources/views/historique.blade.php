@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-semibold mb-6">Historique des Symptômes</h2>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <canvas id="chartCrises"></canvas>
    <canvas id="chartIntensite"></canvas>
    <canvas id="chartDeclencheurs" class="md:col-span-2"></canvas>
</div>
@endsection

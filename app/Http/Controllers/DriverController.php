<?php

namespace App\Http\Controllers;

use App\Models\Constructor;
use App\Models\Driver;
use App\Models\Franchise;
use App\Models\Result;
use Inertia\Inertia;
use Inertia\Response;

class DriverController extends Controller
{
    public function index(Franchise $franchise): Response
    {
        $constructors = Constructor::query()
            ->where('franchise_id', $franchise->id)
            ->with(['drivers', 'results'])
            ->with('results')
            ->withSum('results', 'points_for_race')
            ->orderBy('results_sum_points_for_race', 'DESC')
            ->get();

        $drivers = Driver::query()
            ->whereIn('constructor_id', $constructors->pluck('id'))
            ->with('constructor')
            ->with('results')
            ->withSum('results', 'points_for_race')
            ->orderBy('results_sum_points_for_race', 'DESC')
            ->get();

        return Inertia::render('Drivers/Index', [
            'drivers' => $drivers,
            'franchise' => $franchise,
            'constructors' => $constructors,
        ]);
    }

    public function show(Franchise $franchise, Driver $driver): Response
    {
        $driver = $driver->load('constructor');

        $points = Driver::query()
            ->where('id', $driver->id)
            ->withSum('results', 'points_for_race')
            ->first()->results_sum_points_for_race;

        $results = Result::query()
            ->where('driver_id', $driver->id)
            ->join('races', 'races.id', 'race_id')
            ->join('tracks', 'races.track_id', 'tracks.id')
            ->orderBy('races.date')
            ->select(
                'results.*',
                'races.*',
                'tracks.name as track_name',
                'tracks.location as track_location'
            )
            ->get();

        return Inertia::render('Drivers/Show', [
            'driver' => $driver,
            'franchise' => $franchise,
            'points' => $points,
            'results' => $results,
        ]);
    }
}

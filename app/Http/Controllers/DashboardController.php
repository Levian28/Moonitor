<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
public function index()
{
    $data = [
        'suhu' => 28, 'kelembaban' => 65, 'amonia' => 12, 'h2s' => 3,
        'status' => 'Aman',
    ];

    // dummy data for the chart (replace with database later)
    $labels = ['10.00','14.00','18.00','22.00','02.00','06.00','10.00'];
    $chart = [
        'suhu'       => [35,39,36,33,31,34,36],
        'kelembaban' => [63,60,65,68,71,69,66],
        'nh3'        => [19,20,18,18,19,18,18],
        'h2s'        => [5,8,6,4,6,6,5],
    ];

    return view('dashboard', compact('data', 'labels', 'chart'));
}
}

<?php

namespace App\Http\Controllers;

use App\Services\SlackNotificationService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $slack;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SlackNotificationService $service)
    {
        $this->middleware('auth');
        $this->slack = $service;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //
        $this->slack->send();

        return view('home');
    }
}

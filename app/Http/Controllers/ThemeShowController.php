<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\Request;

class ThemeShowController extends Controller
{
    public function __invoke() {
        return response(Theme::latest()->first());
    }
}

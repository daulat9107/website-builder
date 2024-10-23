<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\Request;

class StoreThemeController extends Controller
{
    public function __invoke(Request $request) {
        $theme = $request->theme;
        Theme::truncate();
        Theme::create([
            'name' => 'Theme',
            'theme' => json_encode($theme)
        ]);
    }
}

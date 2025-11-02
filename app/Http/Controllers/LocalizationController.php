<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LocalizationController extends Controller
{
    public function setLang($locale)
    {
        app()->setLocale($locale);
        Session::put('locale', $locale);
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NumberController extends Controller
{
    public function isOdd($number) {
        return $number % 2 != 0 ? 'Ya, ini bilangan ganjil' : 'Tidak, ini bilangan genap';
    }
}

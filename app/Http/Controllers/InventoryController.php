<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
     public function index()
    {
        $items = Item::all();
        return view('inventory.index', ['items' => $items]);
    }
}

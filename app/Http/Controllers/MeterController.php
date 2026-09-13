<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meter;

class MeterController extends Controller
{
    // عرض جميع المواد
public function index()
    {
        $meters = Meter::all();
        return view('meters.index', compact('meters'));
    }

    // حفظ المادة الجديدة
public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:meters,name',
        ]);

        Meter::create(['name' => $request->name]);

        return redirect()->route('meters.index')->with('success', 'تمت إضافة المادة بنجاح');
    }
}

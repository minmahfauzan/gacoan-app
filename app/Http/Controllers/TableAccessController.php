<?php

namespace App\Http\Controllers;

use App\Models\TableModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TableAccessController extends Controller
{
    public function showAccessForm()
    {
        return view('table-access');
    }

    public function authenticateTable(Request $request)
    {
        $request->validate([
            'table_number' => 'required|exists:tables,table_number',
        ]);

        // Find the table by number
        $table = TableModel::where('table_number', $request->table_number)
                         ->where('is_active', true)
                         ->first();

        if (!$table) {
            return redirect()->back()->withErrors(['table_number' => 'Table not found or not active.']);
        }

        // Store table in session
        Session::put('table_id', $table->id);
        Session::put('table_number', $table->table_number);

        return redirect()->route('menu.index');
    }

    public function logout()
    {
        Session::forget(['table_id', 'table_number']);
        return redirect()->route('table.access.form');
    }
}
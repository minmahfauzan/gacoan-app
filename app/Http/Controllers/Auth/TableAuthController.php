<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\TableModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TableAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.table-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'table_number' => 'required|exists:tables,table_number,is_active,1',
        ]);

        $table = TableModel::where('table_number', $request->table_number)
                          ->where('is_active', true)
                          ->first();

        if (!$table) {
            return back()->withErrors(['table_number' => 'Table not found or not active.']);
        }

        Session::put('table_id', $table->id);
        Session::put('table_number', $table->table_number);

        return redirect()->route('menu.index');
    }

    public function logout()
    {
        Session::forget(['table_id', 'table_number']);
        return redirect()->route('table.auth.login');
    }

    public function loginWithQr(Request $request)
    {
        $tableNumber = $request->query('table_number');

        if (!$tableNumber) {
            return redirect()->route('table.auth.login')->withErrors(['error' => 'Invalid QR Code.']);
        }

        $table = TableModel::where('table_number', $tableNumber)
                          ->where('is_active', true)
                          ->first();

        if (!$table) {
            return redirect()->route('table.auth.login')->withErrors(['error' => 'Table not found or not active.']);
        }

        Session::put('table_id', $table->id);
        Session::put('table_number', $table->table_number);

        return redirect()->route('menu.index');
    }
}
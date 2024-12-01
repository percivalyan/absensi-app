<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('employees.index', [
            "title" => "Karyawaan"
        ]);
    }

    public function create()
    {
        return view('employees.create', [
            "title" => "Tambah Data Karyawaan"
        ]);
    }

    public function edit()
    {
        $ids = request('ids');
        if (!$ids)
            return redirect()->back();
        $ids = explode('-', $ids);

        // ambil data user yang hanya memiliki User::USER_ROLE_ID / role untuk karyawaan
        $employees = User::query()
            ->whereIn('id', $ids)
            ->get();

        return view('employees.edit', [
            "title" => "Edit Data Karyawaan",
            "employees" => $employees
        ]);
    }

    public function editPassword()
    {
        return view('employees.password', [
            "title" => "Ganti Kata Sandi"
        ]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = auth()->user();

        if (!\Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Kata sandi saat ini salah.']);
        }

        $user->update([
            'password' => \Hash::make($request->password),
        ]);

        return redirect()->route('home.index')->with('success', 'Kata sandi berhasil diperbarui.');
    }
}

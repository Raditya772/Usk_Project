<?php

namespace App\Http\Controllers;

use App\Models\CertificationScheme;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CertificationSchemeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $schemes = CertificationScheme::query()
            ->when($search, function ($query, $search) {
                $query->where('code', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%");
            })
            ->withCount('students')
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('certification-schemes.index', compact('schemes', 'search'));
    }

    public function create()
    {
        return view('certification-schemes.create', ['certificationScheme' => null]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:10', 'unique:certification_schemes,code'],
            'name' => ['required', 'string', 'max:50'],
            'description' => ['nullable', 'string', 'max:150'],
        ]);

        CertificationScheme::create($validated);

        return redirect()->route('certification-schemes.index')->with('success', 'Skema sertifikasi berhasil ditambahkan.');
    }

    public function edit(CertificationScheme $certificationScheme)
    {
        return view('certification-schemes.edit', compact('certificationScheme'));
    }

    public function update(Request $request, CertificationScheme $certificationScheme)
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:10', Rule::unique('certification_schemes', 'code')->ignore($certificationScheme->id)],
            'name' => ['required', 'string', 'max:50'],
            'description' => ['nullable', 'string', 'max:150'],
        ]);

        $certificationScheme->update($validated);

        return redirect()->route('certification-schemes.index')->with('success', 'Skema sertifikasi berhasil diperbarui.');
    }

    public function destroy(CertificationScheme $certificationScheme)
    {
        if ($certificationScheme->students()->exists()) {
            return back()->with('error', 'Skema tidak dapat dihapus karena masih digunakan oleh peserta.');
        }

        $certificationScheme->delete();

        return redirect()->route('certification-schemes.index')->with('success', 'Skema sertifikasi berhasil dihapus.');
    }
}

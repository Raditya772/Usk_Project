<?php

namespace App\Http\Controllers;

use App\Models\CertificationScheme;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $students = Student::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('nisn', 'like', "%{$search}%")
                        ->orWhere('major', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhereHas('certificationScheme', function ($schemeQuery) use ($search) {
                            $schemeQuery->where('name', 'like', "%{$search}%")
                                ->orWhere('code', 'like', "%{$search}%");
                        });
                });
            })
            ->with('certificationScheme')
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('students.index', compact('students', 'search'));
    }

    public function create()
    {
        return view('students.create', [
            'schemes' => CertificationScheme::orderBy('name')->get(),
        ]);
    }

    public function show(Student $student)
    {
        $student->load('certificationScheme');

        return view('students.show', compact('student'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'nisn' => 'required|string|max:10|unique:students',
            'major' => 'required|string|max:50',
            'email' => 'required|email|unique:students',
            'certification_scheme_id' => 'required|exists:certification_schemes,id',
        ]);

        Student::create($validated);

        return redirect()->route('students.index')->with('success', 'Data peserta berhasil ditambahkan.');
    }

    public function edit(Student $student)
    {
        return view('students.edit', [
            'student' => $student,
            'schemes' => CertificationScheme::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'nisn' => 'required|string|max:10|unique:students,nisn,'.$student->id,
            'major' => 'required|string|max:50',
            'email' => 'required|email|unique:students,email,'.$student->id,
            'certification_scheme_id' => 'required|exists:certification_schemes,id',
        ]);

        $student->update($validated);

        return redirect()->route('students.index')->with('success', 'Data peserta berhasil diperbarui.');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Data peserta berhasil dihapus.');
    }
}

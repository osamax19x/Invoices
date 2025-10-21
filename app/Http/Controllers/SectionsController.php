<?php

namespace App\Http\Controllers;

use App\Models\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = sections::all();

        return view('sections.sections', compact('sections'));

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $validated = $request->validate([
        'section_name' => 'required|string|max:255|unique:sections,section_name',
        'description'  => 'required|string|max:500',
    ],

      [
        'section_name.unique' => 'اسم القسم موجود مسبقًا، من فضلك اختر اسم آخر.',
        'section_name.required' => 'اسم القسم مطلوب.',
    ] );

    $section = Sections::create([
        'section_name' => $validated['section_name'],
        'description'  => $validated['description'] ?? null,
        'created_by'   => Auth::user()->name,
    ]);

    return redirect()
        ->route('sections.index')
        ->with('success', 'تم إضافة القسم بنجاح');
}



    /**
     * Display the specified resource.
     */
    public function show(sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(sections $sections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->id;

        $validted = $request->validate([

            'section_name' => 'required|max:255|unique:sections,section_name,'.$id,
            'description' => 'required',
        ],[

            'section_name.required' =>'يرجي ادخال اسم القسم',
            'section_name.unique' =>'اسم القسم مسجل مسبقا',
            'description.required' =>'يرجي ادخال البيان',

        ]);

        $sections = sections::find($id);
        $sections->update([
            'section_name' => $request->section_name,
            'description' => $request->description,
        ]);

    return redirect()->back()->with('success', 'تم تعديل القسم بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        sections::find($id)->delete();
        return redirect()->back()->with('delete', 'تم حذف القسم بنجاح');
    }
}

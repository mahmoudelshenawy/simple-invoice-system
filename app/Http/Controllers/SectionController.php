<?php

namespace App\Http\Controllers;

use App\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{

    public function index()
    {
        $sections = Section::all();
        return view('sections.index', compact('sections'));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'section_name' => 'required|string|unique:sections'
        ]);

        $name = auth()->user()->name;
        Section::create([
            'Created_by' => $name,
            'section_name' => $request->section_name,
            'description' => $request->description
        ]);

        session()->flash('add_section', 'تم اضافة القسم بنجاح');
        return back();
    }

    public function show(Section $section)
    {
        //
    }

    public function edit(Section $section)
    {
        //
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'section_name' => 'required|string|unique:sections',
        ]);
        $section = Section::findOrFail($request->id);
        $name = auth()->user()->name;
        $section->update([
            'Created_by' => $name,
            'section_name' => $request->section_name,
            'description' => $request->description
        ]);

        session()->flash('update_section', 'تم تعديل القسم بنجاح');
        return back();
    }


    public function destroy(Request $request)
    {
        Section::whereId($request->id)->delete();
        session()->flash('delete_section');
        return back();
    }
}

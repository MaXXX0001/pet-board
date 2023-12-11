<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Pet;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        if ($user && $user->isAdmin()) {
            $pets = Pet::all();
        } else {
            $pets = Pet::where('status', 'approved')->get();
        }

        return view('welcome', compact('pets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'breed' => 'required|string',
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $pet = Pet::create([
            'name' => $request->input('name'),
            'breed' => $request->input('breed'),
            'description' => $request->input('description'),
            'image_path' => $request->file('image')->store('images', 'public'),
            'author_id' => auth()->id(),
        ]);

        return redirect()->route('home')->with('success', 'Ви успішно додали свого компаньйона, очікуйте підтвердження!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id, Pet $pet)
    {
        $comments = $pet->comments;
        $pet = Pet::with('owner')->findOrFail($id);


        return view('pets.show', compact('pet', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pet = Pet::findOrFail($id);
        return view('pets.edit', compact('pet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
            'breed' => 'required|string',
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        $pet = Pet::findOrFail($id);

        $pet->update([
            'name' => $request->input('name'),
            'breed' => $request->input('breed'),
            'description' => $request->input('description'),
            'image_path' => $request->hasFile('image') ? $request->file('image')->store('images', 'public') : $pet->image_path,
        ]);

        return redirect()->route('home')->with('success', 'Ви успішно відредагували свого компаньйона!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pet $pet, $id)
    {
        $user = auth()->user();
        $pet = Pet::findOrFail($id);

        if ($user->isAdmin() || $user->id === $pet->author_id) {
            $pet->delete();
            return redirect()->route('home')->with('success', 'Компаньйона видалено успішно.');
        }

        return redirect()->route('home')->with('error', 'У вас немає прав для видалення цього компаньйона.');
    }


    public function approve(Request $request, $id)
    {
        $pet = Pet::findOrFail($id);
        $pet->update(['status' => 'approved']);

        return redirect()->route('home')->with('success', 'Компаньйон підтверджений.');
    }
}

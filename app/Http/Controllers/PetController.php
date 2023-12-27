<?php

namespace App\Http\Controllers;

use App\Http\Requests\PetRequest;
use App\Models\Pet;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
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
     * Show the form for creating a new pet.
     * @return View
     */
    public function create(): View
    {
        return view('pets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PetRequest $request
     * @return RedirectResponse
     */
    public function store(PetRequest $request): RedirectResponse
    {
        $pet = Pet::create([
            'name' => $request->input('name'),
            'breed' => $request->input('breed'),
            'description' => $request->input('description'),
            'author_id' => auth()->id(),
        ]);

        $pet->updateImage($request->file('image'));

        return redirect()->route('home')->with('success', 'Ви успішно додали свого компаньйона, очікуйте підтвердження!');
    }

    /**
     * Display the specified resource.
     *
     * @param Pet $pet
     * @return View
     */
    public function show(Pet $pet): View
    {
        $comments = $pet->comments;
        $pet = $pet->load('owner');

        return view('pets.show', compact('pet', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Pet $pet
     * @return View
     */
    public function edit(Pet $pet): View
    {
        return view('pets.edit', compact('pet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PetRequest $request
     * @param Pet $pet
     * @return RedirectResponse
     */
    public function update(PetRequest $request, Pet $pet): RedirectResponse
    {
        $pet->update([
            'name' => $request->input('name'),
            'breed' => $request->input('breed'),
            'description' => $request->input('description'),
            'image_path' => $request->file('image')->store('', 'public'),
        ]);

        $pet->updateImage($request->file('image'));

        return redirect()->route('home')->with('success', 'Ви успішно відредагували свого компаньйона!');
    }

    /**
     * Destroy the specified resource.
     *
     * @param Pet $pet The pet entity to be deleted
     * @return RedirectResponse
     */
    public function destroy(Pet $pet): RedirectResponse
    {
        $user = auth()->user();

        if ($user->isAdmin() || $user->id === $pet->author_id) {
            $pet->delete();
            return redirect()->route('home')->with('success', 'Компаньйона видалено успішно!');
        }

        return redirect()->route('home')->with('error', 'У вас немає прав для видалення цього компаньйона!');
    }

    /**
     * Approve a pet.
     *
     * @param Pet $pet The pet to be approved.
     * @return RedirectResponse
     */
    public function approve(Pet $pet): RedirectResponse
    {
        $pet->update(['status' => 'approved']);

        return redirect()->route('home')->with('success', 'Компаньйон підтверджений!');
    }

}

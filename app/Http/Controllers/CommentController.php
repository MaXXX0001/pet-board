<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Pet;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create(Pet $pet)
    {

    }

    public function store(Request $request, Pet $pet)
    {
        $request->validate([
            'comment' => 'required|max:255',
            'pets_id' => 'required|integer',
        ]);

        $comment = new Comment([
            'comment' => $request->input('comment'),
            'user_id' => auth()->id(),
            'pets_id' => $request->input('pets_id'),
        ]);

        $comment->save();

        return redirect()->back()->with('success', 'Коментар доданий успішно!');

    }

    public function update()
    {

    }

    public function destroy(Comment $comment)
    {
        $user = auth()->user();
        if ($user->isAdmin() || $user->id === $comment->user_id) {
            $comment->delete();

            return redirect()->back()->with('success', 'Коментар успішно видалено.');
        } else {
            return redirect()->back()->with('error', 'Ви не маєте дозволу видаляти цей коментар.');
        }
    }
}



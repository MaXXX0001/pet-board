<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\CommentRequest;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    /**
     * Store a new comment.
     *
     * @param CommentRequest $request The comment request object that contains the comment details.
     *
     * @return RedirectResponse A redirect response to the previous page with a success message.
     */
    public function store(CommentRequest $request): RedirectResponse
    {
        $comment = new Comment([
            'comment' => $request->input('comment'),
            'user_id' => auth()->id(),
            'pets_id' => $request->input('pets_id'),
        ]);

        $comment->save();

        return redirect()->back()->with('success', 'Коментар доданий успішно!');
    }

    /**
     * Destroy a comment.
     *
     * @param Comment $comment The comment to be destroyed.
     * @return RedirectResponse Redirects back to the previous page with a success or error message.
     */
    public function destroy(Comment $comment): RedirectResponse
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

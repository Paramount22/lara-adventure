<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required',
            'dude_id' => 'required|integer|exists:dudes,id'
        ]);

        $comment =  auth()->user()->comments()->create( $request->all() );

        flash()->success('Comment added');

        return redirect('dudes/' . $comment->dude->slug . '#comments' );

    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'text' => 'required|min:3',
        ]);

        $comment = Comment::findOrFail($id);

        $this->authorize('edit-comment', $comment);

        $comment->update( $request->all() );

        $comment->save();

        flash()->success('Comment updated');

        return redirect('dudes/' . $comment->dude->slug . '#comments' );

    }

    public function destroy($id)
    {
        $comment = Comment::findOrfail($id);

        $this->authorize('edit-comment', $comment);

        $comment->delete();

        flash()->success('Comment deleted');

        return redirect()->back();



    }
}

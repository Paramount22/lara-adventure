<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use App\Dude;
use App\Tag;

class DudeController extends Controller
{
    protected $dude;

    /**
     * DudeController constructor.
     */
    public function __construct()
    {
        $this->dude = new Dude;
    }


    /**
     * Get all dudes
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $dudes = Dude::all();
        $totalDudes = $this->dude->totalDudes();
        $totalComments = $this->dude->totalComments();

        return view('dudes.index')->with( compact('dudes', 'totalDudes', 'totalComments') );
    }


    /**
     * @param Dude $dude
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Dude $dude)
    {
        $dude->load('comments', 'tags', 'comments.user');

        return view('dudes.show', compact('dude'));
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $tags = Tag::all();
        return view('dudes.create')->with( compact('tags') );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'text' => 'required',
        ]);

        $dude = Auth::user()->dudes()->create( $request->all() );

        $dude->tags()->sync( $request->get('tags') ?: [] ); // attach tags

        $dude->save();

        flash()->success('Dude added');

        return redirect( url('dudes/' .$dude->slug ) );

    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($slug)
    {
        $dude =Dude::whereSlug($slug)->firstOrFail();

        $tags = Tag::all();

        $this->authorize('edit-dude', $dude);

        return view('dudes.edit')->with(compact('dude', 'tags'));
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
            'title' => 'required|max:255',
            'text' => 'required',
        ]);

        $dude = Dude::whereSlug($id)->firstOrFail();

        $this->authorize('edit-dude', $dude);

        $dude->update( $request->all() );

        $dude->tags()->sync( $request->get('tags') ?: [] );

        $dude->save();

        flash()->success('Dude updated');

        return redirect('dudes/' . $dude->slug);

    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete($slug)
    {
        $dude =Dude::whereSlug($slug)->firstOrFail();

        $this->authorize('edit-dude', $dude);

        return view('dudes.delete')->with(compact('dude'));

    }

    /**
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($slug)
    {
        $dude = Dude::whereSlug($slug)->firstOrFail();

        $this->authorize('edit-dude', $dude);

        $dude->delete();

        flash()->success('Dude deleted.');

        return redirect('/');

    }



}


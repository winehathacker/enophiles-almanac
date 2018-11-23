<?php

namespace App\Http\Controllers;

use App\Variety;
use App\VarietyAliasGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Ramsey\Uuid\Uuid;

class VarietyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('variety.index', ['varieties' => Variety::simplePaginate()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('variety.create', ['varieties' => Variety::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string'],
        ]);

        $variety = new Variety($request->all());

        if ($inputAlias = $request->get('alias')) {
            $variety->aliasTo(Variety::whereId($inputAlias)->firstOrFail());
        }

        $variety->save();

        return Redirect::route('varieties.show', ['variety' => $variety]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Variety  $variety
     * @return \Illuminate\Http\Response
     */
    public function show(Variety $variety)
    {
        return view('variety.show', ['variety' => $variety]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Variety  $variety
     * @return \Illuminate\Http\Response
     */
    public function edit(Variety $variety)
    {
        return view('variety.edit', [
            'variety' => $variety,
            'varieties' => Variety::all(),
            'alias' => $variety->aliases->first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Variety  $variety
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Variety $variety)
    {
        $variety->fill($request->all());

        if ($inputAlias = $request->get('alias')) {
            $variety->aliasTo(Variety::whereId($inputAlias)->firstOrFail());
        } elseif ($variety->alias_group_id) {
            $variety->removeFromAlias();
        }

        $variety->saveOrFail();

        return Redirect::route('varieties.show', ['variety' => $variety]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Variety  $variety
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Variety $variety)
    {
        $variety->delete();

        return Redirect::route('varieties.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Region;
use Illuminate\Http\Request;
use Redirect;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('region.index', ['regions' => Region::simplePaginate()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('region.create', ['regions' => Region::all(), 'countries' => Region::countries()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $region = new Region($request->all());

        if ($request->get('country')) {
            $region->country()->associate($request->get('country'));
        }

        $region->saveOrFail();

        if ($request->get('outerRegions')) {
            $region->outerRegions()->attach($request->get('outerRegions'));
        }

        if ($request->get('subregions')) {
            $region->subregions()->attach($request->get('subregions'));
        }

        return Redirect::route('regions.show', ['region' => $region->load(['outerRegions', 'subregions', 'country'])]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region)
    {
        return view('region.show', ['region' => $region->load(['outerRegions', 'subregions', 'country'])]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function edit(Region $region)
    {
        return view('region.edit', [
            'region' => $region->load(['outerRegions', 'subregions', 'country']),
            'regions' => Region::all(),
            'countries' => Region::countries()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Region  $region
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Region $region)
    {
        $region->fill($request->all());

        if ($request->get('country')) {
            $region->country()->associate($request->get('country'));
        } else {
            $region->country()->dissociate();
        }

        if ($request->get('outerRegions')) {
            $region->outerRegions()->sync($request->get('outerRegions'));
        }

        if ($request->get('subregions')) {
            $region->subregions()->sync($request->get('subregions'));
        }

        $region->saveOrFail();

        return Redirect::route('regions.show', ['region' => $region->load(['outerRegions', 'subregions', 'country'])]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Region  $region
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Region $region)
    {
        $region->delete();

        return Redirect::route('regions.index');
    }
}

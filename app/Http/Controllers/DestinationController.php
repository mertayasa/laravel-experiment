<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestinationStoreRequest;
use App\Http\Requests\DestinationUpdateRequest;
use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $destinations = Destination::all();

        return view('destination.index', compact('destinations'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('destination.create');
    }

    /**
     * @param \App\Http\Requests\DestinationStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(DestinationStoreRequest $request)
    {
        $destination = Destination::create($request->validated());

        return redirect()->route('destination.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Destination $destination
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Destination $destination)
    {
        return view('destination.edit', compact('destination'));
    }

    /**
     * @param \App\Http\Requests\DestinationUpdateRequest $request
     * @param \App\Models\Destination $destination
     * @return \Illuminate\Http\Response
     */
    public function update(DestinationUpdateRequest $request, Destination $destination)
    {
        $destination->update($request->validated());

        return redirect()->route('destination.index');
    }
}

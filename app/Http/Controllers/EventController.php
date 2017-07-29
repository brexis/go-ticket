<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Events\StoreRequest;
use App\Models\Event as EventModel;

class EventController extends Controller
{
    public function create()
    {
        return view('events.create');
    }

    public function store(StoreRequest $request)
    {
        $event = EventModel::create($request->all());

        return redirect('/events/show/' . $event->id);
    }

    public function show($id)
    {
        $event = EventModel::find($id);

        return view('events.show', ['event' => $event]);
    }
}

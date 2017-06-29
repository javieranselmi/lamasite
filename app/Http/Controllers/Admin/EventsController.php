<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;

class EventsController extends AdminController
{
    use ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        return view('admin.events.index', ['events' => $events]);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.events.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
            'event_at' => 'required|date'
        ]);

        $event = new Event;
        $event->title = $request->input('title');
        $event->description = $request->input('description');
        $event->event_at = $request->input('event_at');
        $event->user()->associate($request->user());
        if ($event->save()) {
            return redirect()->route('events.index')->with(['status' => 'success', 'message' => 'Evento creado!']);
        } else {
            return redirect()->route('events.index')->with(['status' => 'fail', 'message' => 'Error']);
        }
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('admin.events.view', ['event' => $event]);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('admin.events.edit', ['event' => $event]);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
            'event_at' => 'required|date'
        ]);
        $event->title = $request->input('title');
        $event->description = $request->input('description');
        $event->event_at = $request->input('event_at');
        if ($event->save()) {
            return redirect()->route('events.index')->with(['status' => 'success', 'message' => 'Evento editado!']);
        } else {
            return redirect()->route('events.index')->with(['status' => 'fail', 'message' => 'Error']);
        }
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Event $event)
    {
        if ($request->ajax()) {
            $event->delete();
            return response()->json(['status' => 'success', 'message' => "Evento  Borrado"]);
        }
        abort(400);
        //
    }
}

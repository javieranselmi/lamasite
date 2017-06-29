<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class FooterComposer
{
    protected $events;
    protected $contact;

    /**
     * Create a new footer composer.
     *
     * @return void
     */
    public function __construct()
    {
        $this->events = \App\Event::all();
        $this->contact = \App\ContactInformation::first();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('events', json_encode($this->events));
        $view->with('contact', $this->contact);
    }
}
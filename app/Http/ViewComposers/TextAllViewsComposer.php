<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class TextAllViewsComposer
{
    protected $texts;

    /**
     * Create a new footer composer.
     *
     * @return void
     */
    public function __construct()
    {
        $this->texts = \App\Text::all();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('texts', $this->texts);
    }
}
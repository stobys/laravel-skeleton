<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;

class AppComposer
{
    // -- Bind data to the view.
    public function compose(View $view)
    {
        // View::share( 'something_cool', 'this is a cool shared variable' );
        // $view -> with('sidebarCollapse', false);
    }
}

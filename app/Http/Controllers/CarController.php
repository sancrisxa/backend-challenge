<?php

namespace App\Http\Controllers;



class CarController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //

    public function list()
    {
        $html = new \Yangqi\Htmldom\Htmldom();
        $results = $html->file_get_html('http://www.google.com/', false, null, 0);

        foreach($results->find('img') as $element)
            echo $element->src . '<br>';

    }
}

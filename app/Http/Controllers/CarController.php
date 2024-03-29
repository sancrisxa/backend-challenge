<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



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
        $results = $html->file_get_html('https://seminovos.com.br/', false, null, 0);

        $results = $html->find('.thumb-item');
        echo "TOTAL DE RESULTADOS :" .  count($results);

        foreach ($results as $car) {

            $carro = $car->find('.thumb-title', 0)->plaintext ?? '';

            echo $carro . '<br>';

        }

    }

    public function search(Request $request)
    {
        $params = $request->all();

        $params = array_values($params);

        $params = implode("/", $params);

        $html = new \Yangqi\Htmldom\Htmldom();
        $results = $html->file_get_html('https://seminovos.com.br/' .$params, false, null, 0);

        $results = $html->find('.list-of-cards');

        $cars = [];

        foreach ($results as $key => $value) {
            $cars[ $value->find('.card-actions ul li  a', 0)->attr['data-id'] ?? ''] =  $value->find('.card-title', 0)->plaintext ?? '';
        }
        return response()->json($cars);
    }

    public function searchById(Request $request, $id)
    {
        $params = $request->all();

        $params = array_values($params);

        $params = implode("/", $params);

        $html = new \Yangqi\Htmldom\Htmldom();
        $results = $html->file_get_html('https://seminovos.com.br/' .$params, false, null, 0);

        $results = $html->find('.list-of-cards');

        $details = [];

        foreach ($results as $key => $value) {
            if ($value->find('.card-actions ul li  a', 0)->attr['data-id'] == $id) {
                $item['ano']   = $value->find('.list-features li', 0)->plaintext;
                $item['kilometragem'] = $value->find('.list-features li', 1)->plaintext;
                $item['cambio']       = $value->find('.list-features li', 2)->plaintext;

                $details[] = $item;
            }
        }
        return response()->json($details);
    }
}

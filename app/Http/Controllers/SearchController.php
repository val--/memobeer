<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Auth;
use DB;
use Response;

class SearchController extends Controller
{
    public function autocomplete(){

        $term = Input::get('term');
        
        $results = array();
        
        $queries = DB::table('beers')
            ->where('name', 'LIKE', '%'.$term.'%')
            ->orWhere('brewery_name', 'LIKE', '%'.$term.'%')
            ->take(15)->get();

        // $count = DB::table('beers')
        //     ->where('name', 'LIKE', '%'.$term.'%')
        //     ->orWhere('brewery_name', 'LIKE', '%'.$term.'%')->count();
        
        foreach ($queries as $query)
        {

            $results[] = [ 'id' => $query->id, 'value' => $query->name, 'brewery' => $query->brewery_name, 'url' => $query->logo_small_url, 'abv' => $query->abv];
        }


        return Response::json($results);
    }



    public function search($term){

        if(!empty($term) && isset($term) && $term != '' && strlen($term) > 2){

        $results = array();

        $results = DB::table('beers')
            ->where('name', 'LIKE', '%'.$term.'%')
            ->orWhere('brewery_name', 'LIKE', '%'.$term.'%')->paginate(40);

        $count = DB::table('beers')
            ->where('name', 'LIKE', '%'.$term.'%')
            ->orWhere('brewery_name', 'LIKE', '%'.$term.'%')->count();

        return view('search.results', [
            'results' => $results,
            'count' => $count
        ]);
        }
        else{
            return redirect('/');
        }

    }

    public function newsearch(){

        // TODO...
        return redirect('/');

    }
}
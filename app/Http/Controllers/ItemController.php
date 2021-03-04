<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return Item::orderBy('day', 'ASC')
        ->orderBy('from_hour', 'ASC')
        ->get();
    }
    public function today($day)
    {
        $existingItem = Item::where( 'day',$day );
        return $existingItem
        ->orderBy('from_hour', 'ASC')
        ->get();
    }

    public function type($type){
        $existingItem = Item::where( 'type',$type );
        return $existingItem
        ->orderBy('day','ASC')
        ->orderBy('from_hour', 'ASC')
        ->get();
    }
 



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        
        $newItem = new Item;
        switch ($newItem->day = $request->item['day']) {
            case 'lunedì':
                $newItem->day = 1;
                break;
            case 'martedì':
                $newItem->day = 2;
                break;
            case 'mercoledì':
                $newItem->day = 3;
                break;
            case 'giovedì':
                $newItem->day = 4;
                break;
            case 'venerdì':
                $newItem->day = 5;
                break;
            case 'sabato':
                $newItem->day = 6;
                break;
            case 'domenica':
                $newItem->day = 7;
                break;
            
            default:
             
                break;
        }
        $newItem->type = $request->item['type'];
        // $newItem->day = $request->item['day'];
        $newItem->save();

        return $newItem;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $existingItem = Item::find( $id );

        if($existingItem){
            $existingItem->from_hour = $request->item['from_hour'];
            $existingItem->to_hour = $request->item['to_hour'];
            $existingItem->save();
            return $existingItem;
        }
        return "Item not found";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existingItem = Item::find( $id );
        if($existingItem){
            $existingItem->delete();
            return "Items deleted";
        }
        return "Item not found";
    }
}

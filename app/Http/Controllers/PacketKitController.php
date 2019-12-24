<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Packet;
use App\Models\Kit;

class PacketKitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packets = Packet::all();

        return view('packet-kit.index', compact('packets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $packet = Packet::find($request->packet_id);

        foreach ($request->kits as $kit_id) {
            $packet->kits()->attach($kit_id, ['count' => $request->counts[$kit_id]]);
        }
        
        return redirect()->route('packet-kit.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $packet = Packet::find($id);

        $kits = Kit::orderBy('id', 'ASC')->get();
        $selectedKitIds = array();
        foreach ($packet->kits as $kit) {
            array_push($selectedKitIds, $kit->id);
        }

        $selectedKits = DB::table('packet_kit')->where('packet_id', $id)->orderBy('kit_id', 'ASC')->select('kit_id', 'count')->get();

        return view('packet-kit.edit', compact('packet', 'kits', 'selectedKitIds', 'selectedKits'));
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
        $insertedPaketKitIds = array();  
        $packetKits = DB::table('packet_kit')->where('packet_id', '=', $id)->get();
        foreach ($packetKits as $packetKit) {
            array_push($insertedPaketKitIds, $packetKit->id);
        }

        foreach ($request->kits as $kit_id) {
            $packetKit = DB::table('packet_kit')->where([
                ['packet_id', '=', $id],
                ['kit_id', '=', $kit_id]
            ])->get()->first();
            
            if($packetKit != null)
                if (in_array($packetKit->id, $insertedPaketKitIds)) 
                    unset($insertedPaketKitIds[(array_search($packetKit->id, $insertedPaketKitIds))]);

            $updateOrInsertIsSuccess = DB::table('packet_kit')
                ->updateOrInsert(
                    ['packet_id' => $id, 'kit_id' => $kit_id],
                    ['count' => intval($request->counts[$kit_id])]
                );
        }

        if(count($insertedPaketKitIds) > 0)
            foreach ($insertedPaketKitIds as $key => $packetKitId) 
                DB::table('packet_kit')->where('id', $packetKitId)->delete();

        return redirect()->route('packet-kit.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $packet = Packet::find($id);
        $packet->kits()->detach();

        return redirect()->route('packet-kit.index');
    }
}

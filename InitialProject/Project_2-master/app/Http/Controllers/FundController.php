<?php
  
namespace App\Http\Controllers;
   
use App\Models\Fund;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
class FundController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$funds = Fund::latest()->paginate(5);
        $id = auth()->user()->id;
        if( auth()->user()->HasRole('admin') ){
            $funds = Fund::with('User')->get();
        }
        elseif( auth()->user()->HasRole('headproject') ){
            $funds = Fund::with('User')->get();
            
        }
        elseif( auth()->user()->HasRole('staff') ){
            $funds = Fund::with('User')->get();
            
        }
        else{
            $funds=User::find($id)->fund()->get();
            //$researchProjects=User::find($id)->researchProject()->latest()->paginate(5);
            
            //$researchProjects = ResearchProject::with('User')->latest()->paginate(5);
        }

        return view('funds.index',compact('funds'));
    }
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('funds.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'fund_name' => 'required',
            'fund_type' => 'required',
            'support_resource'=> 'required',
        ]);
    //return $request->all();
        //Fund::create($request->all());
        $user = User::find(Auth::user()->id);
        //return $request->all();
        // if($request->has('pos')){
        //     $fund_type = $request->fund_type_etc ;
            
        // }else{
        //     $fund_type = $request->fund_type;
            
        // }

        //$fund = $request->all();
        //$fund['fund_type'] = $fund_type;
        //return $fund ;
        $input=$request->all();
        if($request->fund_type == 'ทุนภายนอก'){
            $input['fund_level']=null;
        }
        $user->fund()->Create($input);
        return redirect()->route('funds.index')->with('success','fund created successfully.');
    }
     
    /**
     * Display the specified resource.
     *
     * @param  \App\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function show(Fund $fund)
    {
        return view('funds.show',compact('fund'));
    } 
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //return $id;
        $fu_id = Crypt::decrypt($id);  
        $fund=Fund::find($fu_id);
        $this->authorize('update', $fund);
        return view('funds.edit',compact('fund'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fund $fund)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'detail' => 'required',
        // ]);
    //return $request->all();
        $input=$request->all();
        if($request->fund_type == 'ทุนภายนอก'){
            $input['fund_level']=null;
        }
        $fund->update($input);
        return redirect()->route('funds.index')
                        ->with('success','Fund updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fund $fund)
    {
        $fund->delete();
    
        return redirect()->route('funds.index')
                        ->with('success','Fund deleted successfully');
    }
}
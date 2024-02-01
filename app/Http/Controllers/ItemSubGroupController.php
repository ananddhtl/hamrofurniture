<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemGroup;

use App\Models\itemSubGroup;


class ItemSubGroupController extends Controller
{
    //
    public function addsubgroup(Request $request)
    {
        $subgroupitems=itemSubGroup::with('ItemGroup')->orderBy('id','DESC')->where('status','0')->where('vendor_id',$request->user()->id)->take(10)->get();
      
        return view('subgroupitem.add-subgroup',compact('subgroupitems'));
    }

    public function SearchSubGroup(Request $request)
    {  
    
        if($request->ajax())
        {  
           // dd('request is submitted');
            $searchkey= $request->get('subgroupName');
            $groupId= $request->get('groupId');
            if($searchkey !='')
            {
                $data=itemSubGroup::where ( 'subGroupName', 'LIKE', '' . $searchkey . '%' )->where ( 'itemgroup_id', '=', $groupId )->take(10)->get();    
            }
            
        }
 
        return json_encode($data);

    
     
    }

    public function selectgroupitem($id)
    { 
        $subgroupitems=itemSubGroup::with('ItemGroup')->get();
        //$subgroupitems=itemSubGroup::all();
        $groupitems=ItemGroup::findorFail($id);
        return view('subgroupitem.add-subgroup',compact('groupitems','subgroupitems'));
    }

    public function subgroupstore(Request $request)
    {   
     if($request->itemgroup_id!="" && $request->itemSubgroup_idEdit=="")
        {      
        $request->validate(['subGroupName' => 'required',
                        'itemgroup_id'=>'required'
                                         ]);
        $subgroup = new itemSubGroup();
        $subgroup->subGroupName =$request->subGroupName;      
        $subgroup->itemgroup_id =$request->itemgroup_id; 
        $subgroup->vendor_id =$request->user()->id;         
        $subgroup->save();
        return redirect()->back()->with('group_added','Sub Group Item   added successfully');  
        
       }
    elseif( $request->itemgroup_id!="" && $request->itemSubgroup_idEdit!="")
       {     
           $request->validate(['subGroupName' => 'required',
                                'itemgroup_id'=>'required'
                           ]);
     
                         

            $subgroup=itemSubGroup::find($request->itemSubgroup_idEdit);      
            $subgroup->subGroupName=$request->subGroupName;     
            $subgroup->itemgroup_id=$request->itemgroup_id; 
            $subgroup->vendor_id =$request->user()->id;    
            $subgroup->update();
            return redirect()->back()->with('subgroup_updated','Group Item  is successfully updated');
       }
           else{      
                return redirect()->back()->with('selectgroup','Please select the  Group first!');
       }
    
    }

    public function subgroupitemedit(Request $request,$id)
    {    
        //$group=ItemGroup::FindorFail($id);       
      
       $requestid = request()->route('id');
       $separatedid = explode("-", $requestid);
        $subgroup=itemSubGroup::FindorFail($separatedid[0]); 
       
        $subgroupitems=itemSubGroup::with('ItemGroup')->where('status',0)->orderBy('id','DESC')->where('vendor_id',$request->user()->id)->take(10)->get();
        //dd($subgroup);
        return view('subgroupitem.add-subgroup', compact('subgroupitems','subgroup'));
    }

    // public function UpdateSubGroup(Request $request)
    // {     
      
    //     $subgroup=itemSubGroup::find($request->id);      
    //     $subgroup->subGroupName=$request->subGroupName;      
    //     $subgroup->itemgroup_id=$request->itemgroup_id;    
    //     $subgroup->update();
    //     return back()->with('subgroup_updated','Group Item  is successfully updated');
    // }

    public function DeleteSubGroup($id)
    {
       


        $subgroup  =itemSubGroup::find($id);  
        $subgroup ->status =1;    
        $subgroup->update();
         return back()->with('subGroup_delete','Group Item delete is delete successfully');
    }

    public function SearchsubGroupitem(Request $request)
    {   
       // dd($request->all());
        $query= $request->search;
        $search= $query;
        $subgroupitems =itemSubGroup::with('ItemGroup')->where( 'subGroupName', 'LIKE', '' . $search .'%' )->where('status','0')->get();     
        return view('subgroupitem.add-subgroup',compact('subgroupitems'));


        // return json_encode($subgroupitems);
       
    }



}

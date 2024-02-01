<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemGroup;
use App\Models\itemSubGroup;
use App\Models\Inventorysetting;
use App\Models\InventorysettingDetails;
use App\Models\User;

class InventoryController extends Controller
{
    //
    public function item()
    {
        // $itemsdetails = Inventorysetting::orderBy("id", "desc")->where('status', '0')->take(10)->get();
        //    next try

        $itemsdetails = Inventorysetting::orderBy("id", "asc")->where('status', '0')->paginate(10);

        $itemgroup = ItemGroup::all();


        // end try


        return view('items.item', compact('itemsdetails', 'itemgroup'));
    }
    public function additemdetails()
    {
        $companies = User::all();
        return view('items.item', compact('companies'));
    }
    public function additemunitdetails($id)
    {
        $requestid = request()->route('id');
        $separatedid = explode("-", $requestid);


        $itemsgroupDetails = ItemGroup::FindorFail($separatedid[1]);
        // dd( $itemsgroupDetails);       
        $itemssubgroupdetails = itemSubGroup::FindorFail($separatedid[2]);

       


        $itemsdetail = Inventorysetting::FindorFail($separatedid[0]);

        $itemsunitdetails = InventorysettingDetails::where('commonCode_id', '=', $separatedid[0])->orderBy("id", "desc")->take(10)->get();

        return view('items.item', compact('itemsunitdetails', 'itemsdetail', 'itemsgroupDetails', 'itemssubgroupdetails', ));
    }


    public function itemsdetailsStore(Request $request)
    {

        $request->validate([
            'itemName' => 'required',
            'itemgroup_id' => 'required',
            'sub_groups_id' => 'required',
            
            'units' => 'required',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);



        if ($request->itemEditId) {
            $itemsupdate = Inventorysetting::find($request->itemEditId);
            $itemsupdate->itemName = $request->itemName;
            $itemsupdate->itemDetails = $request->itemDetails;
            $itemsupdate->itemgroup_id = $request->itemgroup_id;
            $itemsupdate->sub_groups_id = $request->sub_groups_id;
            $itemsupdate->vendor_id = $request->user()->id;

            $itemsupdate->units = $request->units;
            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail');
                $img_name = hexdec(uniqid()) . '.' . $thumbnail->getClientOriginalExtension();
                $thumbnail->move('uploads/itemsettings/thumbnail/', $img_name);
                $save_url = '/uploads/itemsettings/thumbnail/' . $img_name;
                $itemsupdate->thumbnail = $save_url;
            }
            $itemsupdate->update();
            return back()->with('itemsdetails_updated', 'Group Item  is successfully updated');
        } else {
            
            $itemsdetails = new  Inventorysetting();
            $itemsdetails->itemName = $request->itemName;
            $itemsdetails->itemDetails = $request->itemDetails;
            $itemsdetails->itemgroup_id = $request->itemgroup_id;
            $itemsdetails->sub_groups_id = $request->sub_groups_id;
            $itemsdetails->vendor_id = $request->user()->id;
            $itemsdetails->units = $request->units;
            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail');
                $img_name = hexdec(uniqid()) . '.' . $thumbnail->getClientOriginalExtension();
                $thumbnail->move('uploads/itemsettings/thumbnail/', $img_name);
                $save_url = '/uploads/itemsettings/thumbnail/' . $img_name;
                $itemsdetails->thumbnail = $save_url;
            }

            $itemsdetails->save();
            return redirect()->back()->with('itemdetails', 'Item details  added successfully');
        }
    }
    public function itemsDetailsEdit($id)
    {


        $requestid = request()->route('id');
        $separatedid = explode("-", $requestid);

        $itemsdetail = Inventorysetting::FindorFail($separatedid[0]);
        $itemsgroupDetails = ItemGroup::FindorFail($separatedid[1]);
        // dd( $itemsgroupDetails);       
        $itemssubgroupdetails = itemSubGroup::FindorFail($separatedid[2]);

        $itemscompanydetails = Company::FindorFail($separatedid[3]);
        $companies = Company::where('id', '!=', $separatedid[3])->get();

        //($itemscompanydetails);

        //     $itemsdetail=Inventorysetting::FindorFail(1); 
        //    // dd($itemsdetail);

        //     $itemsgroupDetails=ItemGroup::FindorFail(2); 
        //     // dd( $itemsgroupDetails);       
        //     $itemssubgroupdetails=itemSubGroup::FindorFail(2); 

        return view('items.item', compact('itemsdetail', 'itemsgroupDetails', 'itemssubgroupdetails', 'itemscompanydetails', 'companies'));


        //return view('items.item',compact('itemsdetail','itemsgroupDetails','itemssubgroupdetails'));
    }

    public function inventorysettingStore(Request $request)
    {

        //dd($request->all());

        $request->validate([

            //    'commonCode_id'=>'required',
            // 'unitStatus'=>'required',
            'Alunits' => 'required',
            //     'whereQty'=>'required',
            //     'sellrate'=>'required',
            'equals' => 'required',
            //    'buyrate'=>'required',

        ]);

        // if ($request->unit_status == 0) {
        // }
        // else
        // {

        // }

        $data = InventorysettingDetails::where('status', '=', '0')
            ->where('commonCode_id', '=', $request->commonCode_id)
            ->where('altUnits', '=',  $request->Alunits)
            ->first();

        if ($data != null) {
            // user doesn't exist

            return redirect()->back()->with('itemAlreadyExist', 'This unit is already exist.');
        } else {

            $itemsettings = new  InventorysettingDetails();
            $itemsettings->unitStatus = $request->unit_status;
            $itemsettings->altUnits = $request->Alunits;
            $itemsettings->whereQty = $request->whereQty;
            $itemsettings->sellrate = $request->sellrate;
            $itemsettings->equals = $request->equals;
            $itemsettings->buyrate = $request->buyrate;
            $itemsettings->mrp = $request->mrp;
            $itemsettings->discountPercent = $request->dis;
            $itemsettings->commonCode_id = $request->commonCode_id;

            $itemsettings->save();
            return redirect()->back()->with('itemsettingsstore', 'Item Setting details  added successfully');
        }
    }
    public function searchitemsetting(Request $request)
    {
        // $search="";
        $itemsdetails = "";
        $search = $request->search;
        if ($request->group && $request->search == null) {
            //$itemsdetails = Inventorysetting::orderBy("id", "desc")->where('status', '0')->where('itemName','LIKE',''.$search.'%')->take(10)->get();

            // $itemsdetails=\DB::table('inventorysettings')
            //                ->join('item_groups','inventorysettings.itemgroup_id','=', 'item_groups.id' ) 
            //                ->select('*')
            //                ->paginate(10);



            $itemsdetails = \DB::select("select inventorysettings.id, itemName,itemDetails,itemgroup_id,sub_groups_id,company_id,itemStatus,units  from inventorysettings inner join item_groups on inventorysettings.itemgroup_id=item_groups.id where item_groups.id=" . $request->group . " and inventorysettings.status=0 ");
        } else if ($request->group && $request->search != null) {
            $itemsdetails = \DB::select("select inventorysettings.id, itemName,itemDetails,itemgroup_id,sub_groups_id,company_id,itemStatus,units  from inventorysettings inner join item_groups on inventorysettings.itemgroup_id=item_groups.id where itemName like '%" . $search . "%' and item_groups.id=" . $request->group . "  and inventorysettings.status=0");
        } else {
            $request->validate([
                'search' => 'required|min:1'
            ]);



            $itemsdetails = Inventorysetting::orderBy("id", "desc")->where('status', '0')->where('itemName', 'LIKE', '' . $search . '%')->take(10)->get();
        }



        // dd($itemsdetails);

        $itemgroup = ItemGroup::all();

        return view('items.item', compact('itemsdetails', 'itemgroup'));
    }

    public function deleteitemsDetails($id)
    {
        $itemsdetail = Inventorysetting::find($id);
        $itemsdetail->status = 1;
        $itemsdetail->update();
        return back()->with('itemsdetails_delete', 'Item delete  is delete successfully');
    }
}
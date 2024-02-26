@extends('index')
@section('content')
<div id="page-wrapper">
    <div class="main-page">
        @if (\Request::is('item') || \Request::is('searchitemsetting'))
        <div class="item">
            <div class="inline-form widget-shadow">
                <div class="form-body">
                    <div data-example-id="simple-form-inline">
                        <a href="/additemdetails"> <button type="submit" class="btn btn-default">Add New
                            </button></a>
                    </div>
                </div>
            </div>
            {{-- Display data --}}
            <div class="inline-form widget-shadow">
                <!-- searach start -->
                <div class="form-body">
                    <div data-example-id="simple-form-inline">
                        <form class="form-inline" action="{{ url('/searchitemsetting') }}" method="GET">
                            <div class="form-group">

                                <div class="col-sm-12">
                                    <input autocomplete="off" type="text" id="searchData" class="form-control"
                                        name="search" placeholder="Search item">
                                </div>

                                <div class="col-sm-12">
                                    <select name="group" class="form-control">
                                        <option value="">Select Group</option>
                                        @foreach ($itemgroup as $item)
                                        @if($item->id== Request::get('group'))

                                        <option value="{{$item->id}}" selected>{{ $item->groupName }}</option>

                                        @else

                                        <option value="{{$item->id}}">{{ $item->groupName }}</option>


                                        @endif
                                        @endforeach



                                    </select>
                                </div>



                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-default">Search</button>
                                </div>
                            </div>


                            @if ($errors->has('search'))
                            <div class="text-danger">{{ $errors->first('search') }}</div>
                            @endif


                        </form>
                    </div>
                </div>
            </div>
            <div class="panel-body widget-shadow">
                @if (Session::has('itemsdetails_delete'))
                <p class="alert alert-success"> {{ Session::get('itemsdetails_delete') }}</p>
                @endif

                <table class="table" id="displaySearchItems">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Item Name</th>
                            <th>Item Details</th>
                            <th>P. Unit</th>
                            <th>Thumbnail</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=0;?>
                        @foreach ($itemsdetails as $item)
                        <?php  $i++;?>
                        <tr>
                            <th scope="row"> {{  $item->id }}</th>
                            <td>{{ $item->itemName }}</td>

                            <td>{{ $item->itemDetails }}</td>
                            <td>{{ $item->units }}</td>
                            <td>@if(!empty($item->thumbnail))
                                <img height="70px;" src="{{$item->thumbnail}}" alt="">
                                @else
                                <img height="70px;" src="{{asset('defaultimage.jpg')}}" alt="">
                                @endif
                            </td>
                            <td>
                                <a href="/additemunitdetails/{{ $item->id }}-{{ $item->itemgroup_id }}-{{ $item->sub_groups_id }}-{{ $item->company_id }}"
                                    class="btn btn-info">Add
                                    Units </a>
                                <a target="_blank"
                                    href="/itemsDetailsEdit/{{ $item->id }}-{{ $item->itemgroup_id }}-{{ $item->sub_groups_id }}-{{ $item->company_id }}"
                                    class="btn btn-info">Edit </a>
                                <a href="/delete-itemsDetails/{{ $item->id }}" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this item ?');">
                                    Delete
                                </a>

                            </td>
                        </tr>
                        @endforeach


                    </tbody>
                </table>

            </div>

            @if (\Request::is('item'))
            <h4>pagination:</h4>
            {{ $itemsdetails-> links() }}
            @endif
            {{-- End here --}}
        </div>
        @endif

        @if (\Request::is('additemunitdetails/*'))
        {{-- item mesc. setup --}}
        <div class="inline-form widget-shadow">
            <div class="form-body">
                <div data-example-id="simple-form-inline">
                    <a href="/additemdetails"> <button type="submit" class="btn btn-default">Add New
                        </button></a>
                </div>
            </div>
        </div>
        <div class="forms">

            <div class=" form-grids row form-grids-right">
                <div class="widget-shadow " data-example-id="basic-forms">
                    <div class="form-title">
                        <h4>Item</h4>
                    </div>

                    @if (Session::has('itemdetails'))
                    <p class="alert alert-success"> {{ Session::get('itemdetails') }}</p>
                    @endif
                    <div class="form-body">
                        <form class="form-horizontal" action="{{ url('itemsDetailsStore') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input autocomplete="off" type="hidden" value="{{ @$itemsdetail->id }}">
                                <label for="for ItemName" class="col-sm-2 control-label">
                                    Item Name
                                </label>

                                <div class="col-sm-4">
                                    <input autocomplete="off" type="text" class="form-control" name="itemName"
                                        placeholder="Item Name" value="{{ @$itemsdetail->itemName }}" readonly>
                                    @error('itemName')
                                    <p style="margin: 5px;">
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                    </p>
                                    @enderror
                                </div>
                                <label for="vatable" class="col-sm-2 control-label">
                                    Vatable
                                </label>
                                <div class="col-sm-4">
                                    <input autocomplete="off" type="text" class="form-control" name="vatable"
                                        placeholder="Vatable" value="No" readonly>

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="for ItemName" class="col-sm-2 control-label">
                                    Item Details
                                </label>
                                <div class="col-sm-4">
                                    <input autocomplete="off" type="text" class="form-control" name="itemDetails"
                                        placeholder="Items Details" value="{{ @$itemsdetail->itemDetails }}" readonly>
                                    @error('itemDetails')
                                    <p style="margin: 5px;">
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                    </p>
                                    @enderror
                                </div>
                                <label for="inputEmail3" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-4">
                                    <input autocomplete="off" type="text" class="form-control" name="status"
                                        placeholder="status" value="Finish Good" readonly>
                                    @error('status')
                                    <p style="margin: 5px;">
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                    </p>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group">

                                <label for="for ItemName" class="col-sm-2 control-label">
                                    Group
                                </label>
                                <div class="col-sm-4">
                                    <input autocomplete="off" type="hidden" class="form-control" data-toggle="modal"
                                        data-target="#myModalForGroup" id="groupName" placeholder="Select Group"
                                        name="itemgroup_id" value="{{ @$itemsdetail->itemgroup_id }}" readonly>

                                    <input autocomplete="off" type="text" class="form-control" data-toggle="modal"
                                        data-target="#myModalForGroup" id="groupName" placeholder="Select Group"
                                        name="itemgroup_id" value="{{ @$itemsgroupDetails->groupName }}" readonly>
                                    @error('itemgroup_id')
                                    <p style="margin: 5px;">
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                    </p>
                                    @enderror
                                </div>

                                <label for="inputEmail3" class="col-sm-2 control-label">BeIn</label>
                                <div class="col-sm-4">
                                    <input autocomplete="off" type="text" class="form-control" name="beIn"
                                        placeholder="Be ln" value="Purchase" readonly>
                                    @error('beIn')
                                    <p style="margin: 5px;">
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                    </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="for ItemName" class="col-sm-2 control-label">
                                    Sub Group
                                </label>
                                <div class="col-sm-4">
                                    <input autocomplete="off" type="hidden" class="form-control" data-toggle="modal"
                                        name="subgroup_id" data-target="#myModalForSubGroup"
                                        placeholder="Select Sub group" value="{{ @$itemsdetail->sub_groups_id }}"
                                        readonly>
                                    <input autocomplete="off" type="text" class="form-control" data-toggle="modal"
                                        id="subGroupName" data-target="#myModalForSubGroup"
                                        placeholder="Select Sub group"
                                        value="{{ @$itemssubgroupdetails->subGroupName }}" readonly>
                                    @error('subgroup_id')
                                    <p style="margin: 5px;">
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                    </p>
                                    @enderror

                                </div>
                                <label for="Units" class="col-sm-2 control-label">Units</label>
                                <div class="col-sm-4">
                                    <input autocomplete="off" type="text" class="form-control" name="units"
                                        placeholder="Units" value="pc" id="units" readonly>
                                    @error('units')
                                    <p style="margin: 5px;">
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                    </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="for ItemName" class="col-sm-2 control-label">
                                    Company
                                </label>
                                <div class="col-sm-4">


                                    <input autocomplete="off" type="text" name="company_id" class="form-control"
                                        data-toggle="modal" data-target="#" readonly placeholder="Select the company"
                                        value="{{ @$itemscompanydetails->companyName }}">

                                    @error('company_id')
                                    <p style="margin: 5px;">
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                    </p>
                                    @enderror
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="forms">
            <div class=" form-grids row form-grids-right">
                <div class="widget-shadow " data-example-id="basic-forms">
                    <div class="form-title">
                        <h4>Item misc.Setup</h4>
                    </div>
                    @if (Session::has('itemsettingsstore'))
                    <p class="alert alert-success"> {{ Session::get('itemsettingsstore') }}</p>
                    @endif

                    @if (Session::has('itemAlreadyExist'))
                    <p class="alert alert-danger"> {{ Session::get('itemAlreadyExist') }}</p>
                    @endif
                    <div class="form-body">
                        <form class="form-horizontal" action="{{ url('inventorysettingStore') }}" method="POST">
                            @csrf

                            <input autocomplete="off" type="hidden" class="form-control" name="commonCode_id"
                                value="{{ @$itemsdetail->id }}" placeholder="UnitsStatus">

                            <div class="form-group">
                                <label for="for ItemName" class="col-sm-2 control-label">
                                    Type
                                </label>
                                <div class="col-sm-2">
                                    <select onchange="makeEditable(document.getElementById('unit_status').value)"
                                        name="unit_status" id="unit_status" class="form-control">
                                        <option value="0">Primary</option>
                                        <option value="1">Secondary</option>

                                    </select>
                                </div>
                                <label for="for ItemName" class="col-sm-2 control-label">
                                    Al units
                                </label>
                                <div class="col-sm-2">
                                    <input autocomplete="off" type="text" class="form-control" id="altunit"
                                        placeholder="Al units" readonly value="{{ @$itemsdetail->units }}"
                                        name="Alunits">
                                </div>
                                <label for="for ItemName" class="col-sm-2 control-label">
                                    Where
                                </label>
                                <div class="col-sm-2">
                                    <input autocomplete="off" type="number" class="form-control" readonly value="1"
                                        name="whereQty" id="where" placeholder="">
                                </div>
                                <label for="for ItemName" class="col-sm-2 control-label">
                                    Equals({{ @$itemsdetail->units }})
                                </label>
                                <div class="col-sm-2">
                                    <input autocomplete="off" type="number" readonly value="1" class="form-control"
                                        name="equals" placeholder="Equals" id="equal">
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="for ItemName" class="col-sm-2 control-label">
                                    B.Rate
                                </label>
                                <div class="col-sm-2">
                                    <input autocomplete="off" type="number" class="form-control" name="buyrate"
                                        placeholder="buy rate">
                                </div>
                                <label for="for ItemName" class="col-sm-2 control-label">
                                    S.Rate
                                </label>
                                <div class="col-sm-2">
                                    <input autocomplete="off" type="number" class="form-control" name="sellrate"
                                        placeholder="Sell Rate">
                                </div>
                                <label for="for ItemName" class="col-sm-2 control-label">
                                    MRP
                                </label>
                                <div class="col-sm-2">
                                    <input autocomplete="off" type="number" class="form-control" name="mrp"
                                        placeholder="MRP">
                                </div>
                                <label for="for ItemName" class="col-sm-2 control-label">
                                    Dis(%)
                                </label>
                                <div class="col-sm-2">
                                    <input autocomplete="off" type="number" class="form-control" name="dis"
                                        placeholder="discount">
                                </div>

                            </div>
                            <div class="col-sm-offset-2">
                                <button type="submit" class="btn btn-default">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- end --}}
        {{-- Display data --}}



        <div class="panel-body widget-shadow">

            <table class="table" id="displaySearchItems">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th> Al units</th>
                        <th> WhereQty</th>
                        <th> Equals</th>
                        <th> Sell Rate</th>
                        <th> MRP</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($itemsunitdetails as $item)
                    <tr>
                        <th scope="row">{{ @$item->id }} </th>
                        <td>{{ @$item->altUnits ?? '' }}</td>
                        <td>{{ @$item->whereQty ?? '' }}</td>
                        <td>{{ @$item->equals ?? '' }}</td>

                        <td>{{ @$item->sellRate ?? '' }}</td>
                        <td>{{ @$item->mrp ?? '' }}</td>
                        <td>

                            <a href="/ " class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this item ?');">
                                Delete
                            </a>

                        </td>
                    </tr>
                    @endforeach


                </tbody>
            </table>

        </div>
        {{-- End here --}}
        @endif

        @if (\Request::is('additemdetails') || \Request::is('itemsDetailsEdit/*'))
        <div class="forms">
            <div class=" form-grids row form-grids-right">
                <div class="widget-shadow " data-example-id="basic-forms">
                    {{-- new one --}}
                    <div class="form-body">
                        <div data-example-id="simple-form-inline">
                            <a href="/item"> <button type="submit" class="btn btn-default">View Item </button></a>
                        </div>
                    </div>
                    {{-- new one --}}

                    <div class="form-title">
                        <h4>Item</h4>
                    </div>

                    @if (Session::has('itemdetails'))
                    <p class="alert alert-success"> {{ Session::get('itemdetails') }}</p>
                    @endif
                    @if (Session::has('itemsdetails_updated'))
                    <p class="alert alert-success"> {{ Session::get('itemsdetails_updated') }}</p>
                    @endif
                    <div class="form-body">
                        <form class="form-horizontal" action="{{ url('itemsDetailsStore') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input autocomplete="off" type="hidden" value="{{ @$itemsdetail->id }}"
                                    name="itemEditId">
                                <label for="for ItemName" class="col-sm-2 control-label">
                                    Item Name
                                </label>

                                <div class="col-sm-4">
                                    <input autocomplete="off" type="text" class="form-control" name="itemName"
                                        placeholder="Item Name" value="{{ @$itemsdetail->itemName }}">
                                    @error('itemName')
                                    <p style="margin: 5px;">
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                    </p>
                                    @enderror
                                </div>
                                <label for="vatable" class="col-sm-2 control-label">
                                    Vatable
                                </label>
                                <div class="col-sm-4">
                                    <input autocomplete="off" type="text" readonly class="form-control" name="vatable"
                                        placeholder="Vatable" value="NO">

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="for ItemName" class="col-sm-2 control-label">
                                    Item Details
                                </label>
                                <div class="col-sm-4">
                                    <input autocomplete="off" type="text" class="form-control" name="itemDetails"
                                        placeholder="Items Details" value="{{ @$itemsdetail->itemDetails }}">
                                    @error('itemDetails')
                                    <p style="margin: 5px;">
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                    </p>
                                    @enderror
                                </div>
                                <label for="inputEmail3" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-4">
                                    <input autocomplete="off" type="text" readonly class="form-control" name="status"
                                        placeholder="status" value="Finish Good">
                                    @error('status')
                                    <p style="margin: 5px;">
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                    </p>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group">

                                <label for="for ItemName" class="col-sm-2 control-label">
                                    Group
                                </label>
                                <div class="col-sm-4">

                                    <input autocomplete="off" type="hidden" name="itemgroup_id" id="itemgroup_id"
                                        value="{{ @$itemsdetail->itemgroup_id }}">

                                    <input autocomplete="off" type="text" class="form-control" data-toggle="modal"
                                        data-target="#myModalForGroup" id="groupName" placeholder="Select Group"
                                        value="{{ @$itemsgroupDetails->groupName }}">
                                    @error('itemgroup_id')
                                    <p style="margin: 5px;">
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                    </p>
                                    @enderror
                                </div>

                                <label class="col-sm-2 control-label">BeIn</label>
                                <div class="col-sm-4">
                                    <input autocomplete="off" type="Text" readonly class="form-control" name="beIn"
                                        placeholder="Be ln" value="Purchase">
                                    @error('beIn')
                                    <p style="margin: 5px;">
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                    </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="for ItemName" class="col-sm-2 control-label">
                                    Sub Group
                                </label>

                                <div class="col-sm-4">
                                    <input autocomplete="off" type="hidden" class="form-control"
                                        value="{{ @$itemsdetail->sub_groups_id }}" name="sub_groups_id"
                                        id="sub_groups_id">
                                    <input autocomplete="off" type="text" class="form-control"
                                        value="{{ @$itemssubgroupdetails->subGroupName }}" name="subgroupName"
                                        id="subGroupName" data-toggle="modal" data-target="#myModalForSubGroup"
                                        placeholder="Select Subgroup">
                                    @error('subgroup_id')
                                    <p style="margin: 5px;">
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                    </p>
                                    @enderror

                                </div>
                                <label for="Units" class="col-sm-2 control-label">Units</label>
                                <div class="col-sm-4">
                                    <input autocomplete="off" type="text" class="form-control" name="units"
                                        placeholder="Units" value="pc">
                                    @error('units')
                                    <p style="margin: 5px;">
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                    </p>
                                    @enderror
                                </div>
                            </div>
                           

                          
                            <label for="ItemImage" class="col-sm-2 control-label">Item Image</label>
                            <div class="col-sm-4">
                                <input autocomplete="off" type="file" class="form-control" name="thumbnail"
                                    placeholder="Thumbnail">
                                @error('thumbnail')
                                <p style="margin: 5px;">
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                </p>
                                @enderror
                                @if(!empty($itemsdetail->thumbnail))
                                <img height="70px;" src="{{$itemsdetail->thumbnail}}" alt="">
                                @else
                                <img height="70px;" src="{{asset('defaultimage.jpg')}}" alt="">
                                @endif
                            </div>

                    </div>
                    <div class="col-sm-offset-2">
                        <button type="submit" class="btn btn-default">
                            @if (@$itemsdetail->id)
                            Update
                            @else
                            Add
                            @endif
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- End here --}}
    @endif
</div>
</div>
{{-- box model try --}}

<div class="container">
    <!-- The Modal for group -->
    <div class="modal" id="myModalForGroup">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <div class="form-body">

                        <div style="">


                            <div data-example-id="simple-form-inline ">
                                <div class="form-group">
                                    <label for="Group Item" class="col-sm-2 control-label">Group</label>

                                    <div class="col-sm-9">
                                        <input autocomplete="off" type="text" name="search" id="search"
                                            value="{{ @$group->groupName }}" class="form-control" id=""
                                            placeholder="Search  Group ">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-body">

                        <div>


                            <div data-example-id="simple-form-inline">
                                <table style="width: 100%" id="DataTable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th> Group Name</th>

                                        </tr>
                                    </thead>
                                    <tbody>


                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>


    {{-- model  for subgroup --}}

    <div class="modal" id="myModalForSubGroup">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <div class="form-body">

                        <div style="">


                            <div data-example-id="simple-form-inline ">
                                <div class="form-group">
                                    <label for="Group Item" class="col-sm-2 control-label">Subgroup</label>

                                    <div class="col-sm-9">
                                        <input autocomplete="off" type="text" name="search" id="searchforsubgroup"
                                            onkeyup="selectSubGroupFromTable(document.getElementById('itemgroup_id').value);"
                                            value="{{ @$group->groupName }}" class="form-control" id=""
                                            placeholder="Search Subgroup ">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-body">

                        <div>


                            <div data-example-id="simple-form-inline">
                                <table style="width: 100%" id="DataTableForSubgroup" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th> Subgroup Name</th>

                                        </tr>
                                    </thead>
                                    <tbody>


                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    {{-- end model  for subgroup --}}


</div>
{{-- endbox model try --}}

<script type="text/javascript">
function selectSubGroupFromTable(groupId) {
    if (groupId == "") {
        alert("Select group first");
    } else {

        var searchKey = $("#searchforsubgroup").val();

        //alert(query);

        $.ajax({
            url: "{{ url('searchsubgroup') }}",
            method: 'GET',
            data: {
                subgroupName: searchKey,
                groupId: groupId
            },
            dataType: 'json',
            success: function(data) {
                $("#DataTableForSubgroup tbody").empty();
                response = data;
                // alert(JSON.parse(JSON.stringify(response)));
                //console.log(response.length);


                for (var i = 0; i < response.length; i++) {


                    var str = '<tr><td><a onclick="putSubGroupNameAndGroupIdInTextField(' +
                        response[i].id + ',\'' + response[i].subGroupName + '\')" href="#">' +
                        response[i].subGroupName + '</a></td></tr>';

                    $("#DataTableForSubgroup tbody").append(str);
                }




            }



        })
    }





}


function putGroupNameAndGroupIdInTextField(groupId, groupName) {

    $("#itemgroup_id").val(groupId);
    $("#groupName").val(groupName);
    $("#myModalForGroup").modal('hide');
}


function putSubGroupNameAndGroupIdInTextField(subgroupId, sName) {

    //  alert(subgroupName);
    $("#sub_groups_id").val(subgroupId);
    $("#subGroupName").val(sName);
    $("#myModalForSubGroup").modal('hide');
}

$(document).ready(function() {
    function groupname(query = '') {

        $.ajax({
            url: "{{ url('searchgroup') }}",
            method: 'GET',
            data: {
                query: query
            },
            dataType: 'json',
            success: function(data) {
                $("#DataTable tbody").empty();
                response = data;
                // alert(JSON.parse(JSON.stringify(response)));
                //console.log(response.length);


                for (var i = 0; i < response.length; i++) {


                    var str = '<tr><td><a onclick="putGroupNameAndGroupIdInTextField(' +
                        response[i].id + ',\'' + response[i].groupName + '\')" href="#">' +
                        response[i].groupName + '</a></td></tr>';

                    $("#DataTable tbody").append(str);
                }




            }



        })
    }
    $(document).on('keyup', '#search', function() {
        var query = $(this).val();
        groupname(query);

    });

});
</script>
{{-- for start the subgroup ajax --}}
<script type="text/javascript">
function makeEditable(id) {
    // alert(id);
    if (id == 0) {
        document.getElementById("altunit").readOnly = true;
        document.getElementById("where").readOnly = true;
        document.getElementById("equal").readOnly = true;
        document.getElementById("equal").value = "1";
        document.getElementById("where").value = "1";
        document.getElementById("altunit").value = document.getElementById("units").value;

    } else {
        document.getElementById("altunit").readOnly = false;
        // document.getElementById("where").readOnly = false;
        document.getElementById("equal").readOnly = false;
        document.getElementById("equal").value = "";
        // document.getElementById("where").value="";
        document.getElementById("altunit").value = "";
    }


}

function putGroupNameAndGroupIdInTextField(groupId, groupName) {
    // alert(groupName);
    $("#itemgroup_id").val(groupId);
    $("#groupName").val(groupName);
    $("#myModalForGroup").modal('hide');
}

// $(document).ready(function() {
//     function groupname(query = '') {

//         $.ajax({
//             url: "{{ url('searchsubgroup') }}",
//             method: 'GET',
//             data: {
//                 query: query
//             },
//             dataType: 'json',
//             success: function(data) {
//                 $("#DataTable tbody").empty();
//                 response = data;
//                 for (var i = 0; i < response.length; i++) {
//                     var str = '<tr><td><a onclick="putGroupNameAndGroupIdInTextField(' +
//                         response[i].id + ',\'' + response[i].groupName + '\')" href="#">' +
//                         response[i].groupName + '</a></td></tr>';

//                     $("#DataTable tbody").append(str);
//                 }
//             }
//         })
//     }
//     $(document).on('keyup', '#searchforsubgroup', function() {
//         var query = $(this).val();
//         groupname(query);
//     });

// });
</script>
{{-- for the subgroup ajax end --}}


<script>
$.ajaxSetup({
    headers: {

        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
@endsection
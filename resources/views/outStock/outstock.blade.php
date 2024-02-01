@extends('index')

<?php
$mytime = Carbon\Carbon::now();
// echo  $mytime->toDateString("dd/MM/yyyy");
?>
@section('content')
<div id="page-wrapper">
    <div class="main-page">


        @if (Session::has('itemdetails'))
        <p class="alert alert-success"> {{ Session::get('itemdetails') }}</p>
        @endif
        {{-- {{$dummydata[0]->id}} --}}
        <div class="forms">
            <div class=" form-grids row form-grids-right">
                <div class="widget-shadow " data-example-id="basic-forms">
                    <div class="form-title">
                        <h4>Items</h4>
                    </div>
                    <div class="form-body">
                        <form class="form-horizontal" action="{{ url('/stockitemstoredummysecond') }}" method="POST">
                            @csrf

                            <input type="hidden" name="id" value="{{ @$dummydata[0]->id }}">

                            <div class="form-group">

                                <div class="col-sm-3 dropdown">

                                    <input type="hidden" class="form-control" name="itemId" id="itemId" value="{{ @$dummydata[0]->item_id }} ">
                                    <div>
                                        <input type="text" class="form-control dropbtn" onkeyup="selectProductsFromTable()" autocomplete="off" id="itemName"  placeholder="Product" value="{{ @$dummydata[0]->itemName }}">
                                        <div id="dropdown-content" class="dropdown-content">
                                            <table style="width: 100%" id="DataTable" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Product Name</th>
                                                        <th>Unit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    @if ($errors->has('itemId'))
                                    <div class="text-danger">{{ $errors->first('itemId') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-3">
                                    <input type="hidden" class="form-control" name="unitEqualsTo" id="unitEqualsTo" value="{{ @$dummydata[0]->unitEqualsTo }}">
                                    <input type="text" readonly autocomplete="off" class="form-control" placeholder="Unit" id="itemUnits" name="Unit" value="{{ @$dummydata[0]->units }}">
                                </div>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control" autocomplete="off" name="quantity" placeholder="quantity" value="{{ @$dummydata[0]->quantity }}">
                              
                                    @if ($errors->has('quantity'))
                                    <div class="text-danger">{{ $errors->first('quantity') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control" autocomplete="off" name="bonus" placeholder="Bonus" value="{{ @$dummydata[0]->bonus }}">
                                </div>

                            </div>
                            <div class="form-group">


                                <div class="col-sm-3">



                                    <input type="number" autocomplete="off" class="form-control" name="Rate" placeholder="Rate" value={{ @$dummydata[0]->rate }}>

                                </div>


                            </div>


                            <div class="col">
                                <button type="submit" class="btn btn-default">
                                    @if (@$dummydata[0]->id)
                                    Update
                                    @else
                                    Add
                                    @endif
                                </button>
                                <a href="/stockOut">
                                <button type="button" class="btn btn-default">
                                    Clear
                                </button>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <div class="panel-body widget-shadow">

            <table class="table" id="displaySearchItems">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Item</th>
                        <th>Unit</th>
                        <th>Stock In</th>
                        <th>Rate</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($itemsdummy as $item)
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ $item->itemName }}</td>
                        <td>{{ $item->units }}</td>

                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->rate }}</td>


                        <td>
                            <a href="/stockOut/{{ $item->id }}" class="btn btn-info">Edit </a>
                            <a href="/stockoutdelete/{{ $item->id }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item ?');"> Delete
                            </a>

                        </td>
                    </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
        <div class="inline-form widget-shadow">

        </div>
        <div class="forms">
            <div class=" form-grids row form-grids-right">
                <div class="widget-shadow " data-example-id="basic-forms">
                    <div class="form-title">
                        <h4>Stock Out</h4>
                    </div>
                    <div class="form-body">

                        <div class="form-group">
                            <div class="col-sm-1">
                                <label for="for ItemName" class="col-sm-2 control-label">
                                    Date
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <input type="date" id="transactionDate" class="form-control" onchange="putDate();" name="date" value="<?php echo $mytime->toDateString("dd/MM/yyyy"); ?>">
                            </div>
                            <div class="col-sm-1">
                                <label for="vatable" class="col-sm-1 control-label">
                                    SN
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" readonly="" class="form-control" name="vatable" placeholder="Vatable" value="Auto" readonly>

                            </div>
                            <div class="col-sm-2 ">
                                <a href="/stockOut/save/<?php echo $mytime->toDateString(); ?>" id="saveStockATag"> <button type="submit" class="btn btn-info">Save
                                    </button></a>
                            </div>
                            <br>
                        </div>


                    </div>
                </div>

            </div>
        </div>
        <!-- <div class="inline-form widget-shadow">
            <div class="form-body text-right">
                <div data-example-id="simple-form-inline">
                    <a href="/stockOut/save/<?php echo $mytime->toDateString(); ?>" id="saveStockATag"> <button type="submit" class="btn btn-default">Save
                        </button></a>
                </div>
            </div>
        </div> -->

    </div>
</div>


</div>


<script>
    function putDate() {
        document.getElementById("saveStockATag").href = "stockOut/save/" + document.getElementById("transactionDate").value;
    }

    function putItemIntoTextField(itemId, itemName, units, itemUnitsEqual) {

        //alert(itemUnitsEqual);
        $("#itemName").val(itemName);
        $("#unitEqualsTo").val(itemUnitsEqual);

        $("#itemId").val(itemId);
        $("#itemUnits").val(units);
        document.getElementById("dropdown-content").style.display = "none";
    }

    function selectProductsFromTable() {

        var searchKey = $("#itemName").val();
        // alert(searchKey);
        $.ajax({
            url: "{{ url('searchforstockitem') }}",
            method: 'GET',
            data: {
                query: searchKey,
            },
            dataType: 'json',
            success: function(data) {
                $("#DataTable tbody").empty();
                response = data;
                for (var i = 0; i < response.length; i++) {
                    var str = '<tr><td><a onclick="putItemIntoTextField(' +
                        response[i].id + ',\'' + response[i].itemName + '\',\'' + response[i].altUnits +
                        '\',\'' + response[i].equals + '\')" href="#">' +
                        response[i].itemName + '</a></td> <td>' + response[i].altUnits + '</td></tr>';

                    $("#DataTable tbody").append(str);
                    document.getElementById("dropdown-content").style.display = "block";
                }
            }

        })
    }
</script>
@endsection
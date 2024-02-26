@extends('index')

<?php
$mytime = Carbon\Carbon::now();
// echo  $mytime->toDateString("dd/MM/yyyy");
?>
@section('content')
<div id="page-wrapper">
    <div class="main-page">
        @if (Session::has('sucess'))
        <p class="alert alert-success"> {{ Session::get('sucess') }}</p>
        @endif
        <div class="forms">
            <div class=" form-grids row form-grids-right">
                <div class="widget-shadow " data-example-id="basic-forms">
                    <div class="form-title">
                        <h4>Items</h4>
                    </div>
                    <div class="form-body">
                        <form class="form-horizontal" action="{{ url('/storeStockAdjustment') }}" method="POST">
                            @csrf



                            <div class="form-group">

                                <div class="col-sm-3 dropdown">

                                    <input type="hidden" class="form-control" name="itemId" id="itemId" value="{{ @$dummydata[0]->item_id }} ">
                                    <div>
                                        <input type="text" class="form-control dropbtn" onkeyup="selectProductsFromTable()" autocomplete="off" id="itemName" placeholder="Product" value="{{ @$dummydata[0]->itemName }}">
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
                                    <input type="hidden" class="form-control" name="unitEqualsTo" id="unitEqualsTo" value="">
                                    <input type="text" autocomplete="off" class="form-control" placeholder="Unit" id="itemUnits" name="Unit" value="">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" onkeyup="clearOutQty();" id="quantityIn" name="quantityIn" placeholder="quantity in" value="">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" autocomplete="off" onkeyup="clearInQty();" id="quantityOut" name="quantityOut" placeholder="quantity out" value="">
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-sm-3">
                                    <input type="hidden" class="form-control" autocomplete="off" name="Rate" placeholder="Rate" value="0">
                                </div>
                            </div>


                            <div class="col">
                                <button type="submit" class="btn btn-default">
                                    Save
                                </button>

                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>



    </div>
</div>

<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <div class="form-body">

                    <div style="">


                        <div data-example-id="simple-form-inline ">
                            <div class="form-group">
                                <label for="Group Item" class="col-sm-2 control-label">Product</label>

                                <div class="col-sm-9">
                                    <input type="text" onkeyup="selectProductsFromTable()" name="search" id="searchProducts" value="" class="form-control" id="" placeholder="Search  products ">
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
                                        <th>Product Name</th>
                                        <th>Unit</th>

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
<!-- end model -->
</div>


<script>
    function clearInQty() {
        $("#quantityIn").val('');
    }

    function clearOutQty() {

        $("#quantityOut").val('');
    }

    function putDate() {
        document.getElementById("saveStockATag").href = "stockOut/save/" + document.getElementById("transactionDate").value;
    }

    function putItemIntoTextField(itemId, itemName, units, itemUnitsEqual) {

        //alert(itemUnitsEqual);
        $("#itemName").val(itemName);
        $("#unitEqualsTo").val(itemUnitsEqual);

        $("#itemId").val(itemId);
        $("#itemUnits").val(units);
        // $("#myModal").modal('hide');
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
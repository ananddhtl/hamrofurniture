@extends('index')
<?php
$mytime = Carbon\Carbon::now();

?>

<?php

use App\Models\fasicalyeardate;

$sc = new fasicalyeardate();
$selectdate = $sc->fasicalyearstart();

?>
@section('content')
    <div id="page-wrapper">


        <div class="inline-form widget-shadow">
            <div class="form-title">
                <h4>Reports</h4>
            </div>
            <div class="form-body">
                <div data-example-id="simple-form-inline" class="inform">
                    <div>

                        <form class="form-inline" action="{{ url('/SearchItemReportBetweenDateoutstock') }}" method="GET">
                            @csrf
                            <div class="form-group"> <input type="date" name="search1" class="form-control"
                                    placeholder="Search" value="{{$selectdate->facialyearstart}}"> </div>

                            <span class="form-group"> <input type="date" name="search2" class="form-control"
                                    placeholder="Search" value="<?php echo $mytime->toDateString("dd/MM/yyyy"); ?>" > </span>

                            <button type="submit" class="btn btn-default">View</button>
                            @if ($errors->has('search'))
                                <div class="text-danger"> {{ $errors->first('search') }} </div>
                            @endif
                        </form>
                    </div>


                </div>
                <div data-example-id="simple-form-inline" class="form2">
                    <form class="form-inline" action="{{ url('/reportsearch') }}" method="GET">
                        @csrf
                        <div class="form-group"> <input type="text" name="search" class="form-control"
                                placeholder="Search"> </div>

                        <button type="submit" class="btn btn-default">Search</button>
                        @if ($errors->has('search'))
                            <div class="text-danger"> {{ $errors->first('search') }} </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>



        <div class="panel-body widget-shadow">
            <!-- <h4>Basic Table:</h4> -->
            <table class="table">
                <thead>
                    <tr>
                        <th>SN.</th>
                        <th>Item Name</th>
                        <th>Stock In</th>
                        <th>Stock Out</th>
                        <th>Total</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0; ?>
                    @foreach ($reports as $item)
                        <?php $i++; ?>

                        <tr>
                            <th scope="row">{{ $i }}</th>
                            <td>{{ $item->itemName }}</td>
                            <td>{{ $item->inqty }}</td>
                            <td>{{ $item->ouqty }}</td>
                            <td>{{ $item->totalQty }}</td>

                        </tr>
                    @endforeach


                </tbody>
            </table>

        </div>
        <style>
            .form2
            {
                margin-top: 15px;
            }
        </style>

    </div>
@endsection

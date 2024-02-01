@extends('index')
@section('content')
<div id="page-wrapper">


    <div class="inline-form widget-shadow">
        <div class="form-title">
            <h4>Today Status </h4>
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

                @if($item->itemName)

                <tr>
                    <th scope="row">{{ $i }}</th>
                    <td>{{ $item->itemName }}</td>
                    <td>{{ $item->inqty }}</td>
                    <td>{{ $item->ouqty }}</td>
                    <td>{{ $item->totalQty }}</td>

                </tr>
                @endif
                @endforeach

            </tbody>

            {{-- @endif   --}}
        </table>

    </div>

</div>

<style>
    .form2 {
        margin-top: 15px;
    }
</style>
@endsection
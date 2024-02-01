@extends('index')
@section('content')
<div id="page-wrapper">


    <div class="inline-form widget-shadow">
        <div class="form-title">
            <h4>Item Group-wise Stock</h4>
        </div>
    </div>



    <div class="panel-body widget-shadow">
        <!-- <h4>Basic Table:</h4> -->
        <table class="table">
            <thead>
                <tr>
                    <th>SN.</th>
                    <th>Group Name </th>
                </tr>
            </thead>
            <tbody>
                {{-- // @if (\Request::is('SearchItemBetweenDateitemwisestok')) --}}


                <?php $i = 0; ?>
                @foreach ($reports as $item)
                <?php $i++; ?>

                <tr>
                    <th scope="row">{{ $i }}</th>
                    <td><a href="/singleitemgroupwisestock/{{$item->id}}">{{ $item->groupName }}</a></td>
                </tr>
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
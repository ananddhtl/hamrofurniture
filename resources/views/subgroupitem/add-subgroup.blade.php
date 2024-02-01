@extends('index')
@section('content')



    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div id="page-wrapper">
        <div class="main-page">

            <?php
            $requestid = request()->route('id');
            $separatedid = explode('-', $requestid);
            
            ?>


            @if (@$subgroup->id || \Request::is('searchsubgroupitems'))
                <div class="inline-form widget-shadow">
                    <div class="form-body">
                        <div data-example-id="simple-form-inline">
                            <a href="{{ url('/subgroup') }}"> <button type="submit" class="btn btn-default">Add New
                                </button></a>
                        </div>
                    </div>
                </div>
            @else
            @endif


            @if (\Request::is('searchsubgroupitems'))
            @else
                <div class="forms">
                    <div class=" form-grids row form-grids-right">
                        <div class="widget-shadow " data-example-id="basic-forms">
                            <div class="form-title">
                                <h4>Subgroup </h4>
                            </div>

                            <div class="form-body">

                                <div style="">


                                    <div data-example-id="simple-form-inline ">
                                        {{-- <form class="form-inline " action="{{url('/searchsubgroup')}}" method="" > --}}
                                        {{-- @csrf --}}
                                        <div class="form-group">
                                            <label for="Group Item" class="col-sm-2 control-label">Group</label>

                                            <div class="col-sm-9">

                                                <input type="text" onclick="clearGroupIdAndGroupName()" name="search" id="search"
                                                    value="<?php echo @$separatedid[1]; ?>" class="form-control" 
                                                    placeholder="Search  Group ">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="form-body">

                                <div style="margin-left: 17%">


                                    <div data-example-id="simple-form-inline" id="displaySearch">
                                        <table style="width: 57%" id="DataTable" class="table table-striped">
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

                            <div class="form-body">
                                @if (Session::has('selectgroup'))
                                    <p class="alert alert-danger"> {{ Session::get('selectgroup') }}</p>
                                @endif
                                @if (Session::has('group_added'))
                                    <p class="alert alert-success"> {{ Session::get('group_added') }}</p>
                                @endif
                                @if (Session::has('subGroup_delete'))
                                    <p class="alert alert-success"> {{ Session::get('subGroup_delete') }}</p>
                                @endif
                                @if (Session::has('subgroup_updated'))
                                    <p class="alert alert-success"> {{ Session::get('subgroup_updated') }}</p>
                                @endif
                                {{-- <form action="{{ isset($category) ? route('categories.update',$category->id) : route('categories.store') }}" method="POST"> --}}
                                <form class="form-horizontal" action="{{ url('subgroup/subgroupstore') }}" method="POST">
                                    @csrf

                                    <input type="hidden" name="itemSubgroup_idEdit" id="itemSubgroup_idEdit"
                                        value="{{ @$subgroup->id }}" />

                                    <input type="hidden" name="itemgroup_id" id="itemgroup_id"
                                        value="{{ @$subgroup->itemgroup_id }}" />
                                    <div class="form-group">
                                        <label for="Group Item" class="col-sm-2 control-label"> Sub Group Item</label>
                                        <div class="col-sm-9"> <input type="text" name="subGroupName"
                                                value="{{ @$subgroup->subGroupName }}" class="form-control" id=""
                                                placeholder="Enter Sub Group Item">
                                            @if ($errors->has('subGroupName'))
                                                <div class="text-danger">{{ $errors->first('subGroupName') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-offset-2"> <button type="submit" class="btn btn-default">
                                            @if (@$subgroup->id)
                                                Update
                                            @else
                                                Add
                                            @endif
                                        </button> </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>




        </div>
        @endif


        <div class="inline-form widget-shadow">

            <!-- searach start -->

            <div class="form-body">
                <div data-example-id="simple-form-inline">
                    <form class="form-inline" action="{{ url('/searchsubgroupitems') }}" method="POST">
                        @csrf
                        <div class="form-group"> <input type="text" id="searchData" class="form-control" name="search"
                                placeholder="Search group"> </div>

                        <button type="submit" class="btn btn-default">Search</button>
                        @if ($errors->has('search'))
                            <div class="text-danger">{{ $errors->first('search') }}</div>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        <div class="panel-body widget-shadow">

            <table class="table" id="displaySearchItems">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Group</th>
                        <th>Subgroup</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subgroupitems as $item)
                        <tr>
                            <th scope="row">{{ $item->id ?? '' }}</th>
                            <td>{{ $item->itemgroup->groupName ?? '' }}</td>

                            <td>{{ $item->subGroupName ?? '' }}</td>
                            <td>{{ $item->status ?? '' }}</td>
                            <td>
                                <a href="/subgroup/{{ $item->id }}-{{ $item->itemgroup->groupName }}"
                                    class="btn btn-info">Edit </a>
                                <a href="/delete-subgroupitem/{{ $item->id }}" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this item ?');"> Delete </a>

                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>


    <script type="text/javascript">
        function deleteItem(itemId) {
            alert(itemId);

        }

        function clearGroupIdAndGroupName()
        {
            document.getElementById('search').value='';
            document.getElementById('itemgroup_id').value='';
        }

        // function searchSubGroupItems() {
        //     var searchKey = $("#searchData").val();

        //     $.ajax({
        //         url: "{{ url('searchdata') }}",
        //         method: 'GET',
        //         data: {
        //             query: searchKey
        //         },
        //         dataType: 'json',
        //         success: function(response) {
        //             $("#displaySearchItems tbody").empty();
        //             for (var i = 0; i < response.length; i++) {
        //                 var records = '<tr><th scope="row">' + response[i].id + '</th><td>' + response[i]
        //                     .item_group.groupName + '</td><td>' + response[i].subGroupName + '</td><td>' +
        //                     response[i].status + '</td><td><a href="/subgroup/' + response[i].id +
        //                     '" class="btn btn-info">Edit </a> <a href="/delete-subgroupitem/' + response[i].id +
        //                     '" class="btn btn-danger"> Delete </a> </td></tr>';
        //                 $("#displaySearchItems tbody").append(records);
        //             }
        //         }

        //     })
        // }




        function putGroupNameAndGroupIdInTextField(groupId, groupName) {

            $("#itemgroup_id").val(groupId);
            $("#search").val(groupName);
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
    <script>
        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });
    </script>


@endsection

@extends('index')
@section('content')


<div id="page-wrapper">
    <div class="main-page">
     @if(@$group->id || \Request::is('searchgroup'))
                       
        <div class="inline-form widget-shadow">
            <div class="form-body">
                <div data-example-id="simple-form-inline">
                   <a href="{{ url('/group')}}"> <button type="submit" class="btn btn-default">Add New </button></a>
                </div>
            </div>
        </div>
                           
           @else
                     
     @endif
        
       
@if(\Request::is('searchgroup'))  

        @else
        <div class="forms">
            <div class=" form-grids row form-grids-right">
                <div class="widget-shadow " data-example-id="basic-forms">
                    <div class="form-title">
                        <h4>Group
                    </h4>
                    </div>
                    <div class="form-body">
                    
                    @if(Session::has('searches'))
                        <p class="alert alert-danger"> {{ Session::get('searches') }}</p>
                    @endif    
                    @if(Session::has('group_updated'))
                        <p class="alert alert-success"> {{ Session::get('group_updated') }}</p>
                    @endif
                    @if(Session::has('group_added'))
                    <p class="alert alert-success"> {{ Session::get('group_added') }}</p>
                    @endif
                    @if(Session::has('Group_delete'))
                        <p class="alert alert-success"> {{ Session::get('Group_delete') }}</p>
                    @endif
                        <form class="form-horizontal" action="{{ url('/Gitemstore')}}" method="POST">
                            @csrf
                            <input type="hidden" name="group_idEdit" id="group_idEdit" value="{{ @$group->id }}"> 
                            <div class="form-group"> <label for="Group Item" class="col-sm-2 control-label">Enter Group </label>

                                <div class="col-sm-9"> <input type="text"   value="{{ @$group->groupName }}" name="groupName" class="form-control" id="" placeholder="Enter Group Item"> 
                                @if ($errors->has('groupName'))
                                    <div class="text-danger">{{ $errors->first('groupName') }}</div>
                                @endif
                                </div>
                            </div>
                        
                            <div class="col-sm-offset-2"> 
                                <button type="submit" class="btn btn-default">
                                    @if(@$group->id)
                    
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

@endif

      


        
    </div>

    <div class="inline-form widget-shadow">
       

        {{-- {{ url('/')}} --}}


        <div class="form-body">
            <div data-example-id="simple-form-inline">
                <form class="form-inline" action="{{url('/SearchGroupReturnInView')}}" method="GET">
                    @csrf 
                    <div class="form-group"> <input type="text" name="search" class="form-control" id="exampleInputEmail3" placeholder="Search group"> </div>
                    <button type="submit" class="btn btn-default">Search</button>
                   
                    @if ($errors->has('search'))
                       <div class="text-danger">{{ $errors->first('search') }}</div>
                  @endif
  
                </form>
            </div>
        </div>
    </div>


<?php $i=0; ?>

<div class="panel-body widget-shadow">
        <!-- search items -->
     
   
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Item Name</th>
                    <th>status</th>
                    <th>Action</th>                  
                </tr>
            </thead>
          <tbody>
            @foreach($groupitems as $item )

             <?php $i=1; ?>
                <tr>
                    <th scope="row">{{ $item->id  }}</th>
                    <td>{{ $item->groupName }}</td>
                    <td>{{ $item->status }}</td>
                    <td>
                        <a href="/edit-groupitem/{{$item->id}}" class="btn btn-info" > Edit </a>                        
                        <a href="/delete-groupitem/{{$item->id}}" class="btn btn-danger"  onclick=" return confirm('Are you sure you want to delete this item ?'); "  >  Delete </a> </button>

                    </td>             
                </tr>
            @endforeach
            </tbody>
       </table>


          <h4 style="text-align: center; padding:10px;"><?php if($i==0)
            {
                echo '<div class="alert alert-danger" role="alert">
                        Data not found!
                       </div>';
            } 
            
           
            ?>
            
        </h4> 

 
@endsection
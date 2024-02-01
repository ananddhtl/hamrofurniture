@extends('index')
@section('content')
<div id="page-wrapper">
    <div class="main-page">

        @if(@$company->id || \Request::is('searchcompany'))
                       
        <div class="inline-form widget-shadow">
            <div class="form-body">
                <div data-example-id="simple-form-inline">
                   <a href="{{ url('/Company')}}"> <button type="submit" class="btn btn-default">Add New </button></a>
                </div>
            </div>
        </div>
                           
           @else
                     
     @endif


     @if(\Request::is('searchcompany'))  

     @else
     <div class="forms">
        <div class=" form-grids row form-grids-right">
            <div class="widget-shadow " data-example-id="basic-forms">
                <div class="form-title">
                    <h4>Company</h4>
                </div>
                <div class="form-body">
                @if(Session::has('company_added'))
                    <p class="alert alert-success"> {{ Session::get('company_added') }}</p>
                 @endif
                 @if(Session::has('company_delete'))
                    <p class="alert alert-success"> {{ Session::get('company_delete') }}</p>
                 @endif
                 @if(Session::has('company_updated'))
                    <p class="alert alert-success"> {{ Session::get('company_updated') }}</p>
                 @endif
                 
                 @if(Session::has('searches'))
                    <p class="alert alert-success"> {{ Session::get('searches') }}</p>
                 @endif
                    <form class="form-horizontal" action="{{ url('/Companystore') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{@$company->id}}" />
                        <div class="form-group"> <label for="Group Item" class="col-sm-2 control-label">Company Name</label>
                            <div class="col-sm-9"> <input type="text" name="companyName" value="{{ @$company->companyName }}" class="form-control" id="" placeholder="Enter Company Name">
                                @if ($errors->has('companyName'))
                                <div class="text-danger">{{ $errors->first('companyName') }}</div>
                           @endif
                            </div>
                           
                        </div>
                        
                        <div class="form-group"> <label for="Group Item" class="col-sm-2 control-label">Address</label>
                            <div class="col-sm-9"> <input type="text" name="address" class="form-control" id="" value="{{ @$company->address }}" placeholder="Enter Address">
                             @if ($errors->has('address'))
                                <div class="text-danger">{{ $errors->first('address') }}</div>
                              @endif
                            </div>
                             
                        </div>
                        <div class="form-group"> <label for="Group Item" class="col-sm-2 control-label">Contact Number</label>
                            <div class="col-sm-9"> <input type="text" name="contactNumber" value="{{ @$company->contactNumber }}" class="form-control" id="" placeholder="Enter Contact Number"> 
                             @if ($errors->has('contactNumber'))
                                <div class="text-danger">{{ $errors->first('contactNumber') }}</div>
                             @endif
                            </div>
                            
                        </div>
                       
                       
                        <div class="col-sm-offset-2"> <button type="submit" class="btn btn-default"> @if(@$company->id)
                
                            Update
                    
                         @else
                    Add
                    @endif</button> </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

     @endif


        




    </div>

    <div class="inline-form widget-shadow">
        <!-- <div class="form-title">
            <h4>Inline form Example 1 :</h4>
        </div> -->
        <div class="form-body">
            <div data-example-id="simple-form-inline">
                <form class="form-inline" action="{{url('/searchcompany')}}" method="GET" >
                    @csrf
                    <div class="form-group"> <input type="text" name="search" class="form-control"  placeholder="Search group"> </div>
                 
                    <button type="submit" class="btn btn-default">Search</button>
                     @if ($errors->has('search'))
                       <div class="text-danger"> {{ $errors->first('search') }} </div>
                     @endif
                </form>
            </div>
        </div>
    </div>
 
   <?php $i=0; ?>
@if(isset($searches))
    <div class="panel-body widget-shadow">
        <!-- <h4>Basic Table:</h4> -->
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Company  Name</th>
                    <th>Company  Address</th>
                    <th>Company  Contact Number</th>

                    <th>status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach (@$searches  as $company)
                <tr>
                    
                    <?php $i=1; ?>
                    <th scope="row">{{ $company->id  }}</th>
                    <td>{{ $company->companyName }}</td>
                    <td>{{ $company->address }}</td>
                    <td>{{ $company->contactNumber}}</td>
                     <td>{{ $company->status }}</td> 
                    <td>
                        <a href="/edit-Company/{{$company->id}}" class="btn btn-info" > <i class="fas fa-edit">Edit </i></a>                        
                        <a href="/delete-Company/{{$company->id}}" class="btn btn-danger" onclick=" return confirm('Are you sure you want to delete this item ?'); " >  Delete  </a> </button>

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
  
    </div>
@else

   

    <div class="panel-body widget-shadow">
        <!-- <h4>Basic Table:</h4> -->
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Company  Name</th>
                    <th>Company  Address</th>
                    <th>Company  Contact Number</th>

                    <th>status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach (@$companies as $company)
                <tr>
                    <th scope="row">{{ $company->id  }}</th>
                    <td>{{ $company->companyName }}</td>
                    <td>{{ $company->address }}</td>
                    <td>{{ $company->contactNumber}}</td>
                     <td>{{ $company->status }}</td> 
                    <td>
                        <a href="/edit-Company/{{$company->id}}" class="btn btn-info" > <i class="fas fa-edit">Edit </i></a>                        
                        <a href="/delete-Company/{{$company->id}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item ?');" >Delete</a> </button>

                    </td>
                </tr>
            @endforeach    
              
            </tbody>
        </table>
  
    </div>
    @endif
</div>
@endsection
@extends('index')

@section('content')
    <div id="page-wrapper">
        <div class="main-page">
            <div class="forms">
                <div class=" form-grids row form-grids-right">
                    <div class="widget-shadow " data-example-id="basic-forms">
                        <div class="form-title">
                            <h4>Facial Year Start </h4>
                        </div>
                        @if (Session::has('addfacialyear'))
                            <p class="alert alert-success"> {{ Session::get('addfacialyear') }}</p>
                        @endif
                        <div class="form-body">
                            <form class="form-horizontal" action="{{ url('addfacialyear') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ @$facialyeardate->id }}">
                              

                                <div class="form-group">
                                    <div class="col-sm-2">
                                        <label for="for ItemName" class="col-sm-4 control-label">
                                         Date
                                        </label>
                                    </div>
                                    <div> 

                                        <h1></h1>
                                        
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="DATE" class="form-control" name="facialyeardate"
                                            placeholder="company's name" value="{{@$facialyeardate->facialyearstart; }}">
                                    </div>

                                </div>
                              
                             
                               

                                <div class="col-sm-offset-2">
                                    <button type="submit" class="btn btn-default">
                                        @if (@$facialyeardate->id)
                                            Update
                                        @else
                                            Save
                                        @endif
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

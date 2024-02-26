@extends('index')

@section('content')
<div id="page-wrapper">
    <div class="main-page">
        <div class="forms">
            <div class=" form-grids row form-grids-right">
                <div class="widget-shadow " data-example-id="basic-forms">
                    <div class="form-title">
                        <h4>Company Info </h4>
                    </div>
                    @if (Session::has('companyinfo_added'))
                    <p class="alert alert-success"> {{ Session::get('companyinfo_added') }}</p>
                    @endif
                    <div class="form-body">
                        <form class="form-horizontal" action="{{ url('storecompanyinfo') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ @$companyinfo->id }}">

                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label for="for ItemName" >
                                        Industries Name
                                    </label>
                                </div>
                                <div class="col-sm-5">
                                    <input type="name" class="form-control" name="companyName" placeholder="company's name" value="{{ @$companyinfo->companyName }}">
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label for="for ItemName" >
                                        Address
                                    </label>
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="address" placeholder="Item Name" value="{{ @$companyinfo->address }}">
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label for="for ItemName" >
                                        Phone No.
                                    </label>
                                </div>
                                <div class="col-sm-5">
                                    <input type="text " class="form-control" name="contactNumber" placeholder="Item Name" value="{{ @$companyinfo->contactNumber }}">
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label for="for ItemName" >
                                        VAT No.
                                    </label>
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="VatNo" placeholder="Item Name" value="{{ @$companyinfo->VatNo }}">
                                </div>

                            </div>

                            <div class="col-sm-offset-2">
                                <button type="submit" class="btn btn-default">
                                    @if (@$companyinfo->id)
                                    Update
                                    @else
                                    Add
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
@extends('index')
@section('content')
<div id="page-wrapper">
    <div class="main-page">

        <div class="forms">
            <div class=" form-grids row form-grids-right">
                <div class="widget-shadow " data-example-id="basic-forms">
                    <div class="form-title">
                        <h4>Stock In</h4>
                    </div>
                    <div class="form-body">
                        <form class="form-horizontal">
                            <div class="form-group"> <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-9"> <input type="email" class="form-control" id="inputEmail3" placeholder="Email"> </div>
                            </div>
                            <div class="form-group"> <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-9"> <input type="password" class="form-control" id="inputPassword3" placeholder="Password"> </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox"> <label> <input type="checkbox"> Remember me </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-offset-2"> <button type="submit" class="btn btn-default">Sign
                                    in</button> </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('index')
@section('content')
<div id="page-wrapper">
    <div class="main-page">

        <div class="forms">
            <div class=" form-grids row form-grids-right">
                <div class="widget-shadow " data-example-id="basic-forms">
                    <div class="form-title">
                        <h4>Add Group</h4>
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

    <div class="inline-form widget-shadow">
        <!-- <div class="form-title">
            <h4>Inline form Example 1 :</h4>
        </div> -->
        <div class="form-body">
            <div data-example-id="simple-form-inline">
                <form class="form-inline">
                    <div class="form-group"> <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Search group"> </div>
                 
                    <button type="submit" class="btn btn-default">Search</button>
                </form>
            </div>
        </div>
    </div>

    <div class="panel-body widget-shadow">
        <!-- <h4>Basic Table:</h4> -->
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
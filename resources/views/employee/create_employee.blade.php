@extends('layouts.template')

@section('page-content')
    <link rel="stylesheet" href="{{asset('css/employee.css')}}">
    <div class="page-content">
        <div class="panel">
            <div class="panel-body container-fluid" style="height:auto;">
                <form autocomplete="off" method="post" id="beginner_form" action="{{url('employee/save')}}">
                    @csrf
                    <div class="form-wrap">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="first_name">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name"
                                           placeholder="First Name" autocomplete="off" required />
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="last_name">Last Name</label>
                                    <input type="text" class="form-control" id="inputBasicFirstName" name="last_name"
                                           placeholder="Last Name" autocomplete="off" />
                                </div>

                                {{--<div class="form-group">--}}
                                    {{--<label class="form-control-label" for="last_name">Bonus</label>--}}
                                    {{--<input type="number" class="form-control" name="bonus"--}}
                                           {{--placeholder=0 value="0" autocomplete="off" />--}}
                                {{--</div>--}}
                                <button type="submit" class="btn btn-success" id="add_employee_btn">Add Employee</button>
                            </div>

                            <div class="col-md-6">
                                <h3 class="pictureID-label">Upload Picture ID</h3>
                                <div class="profile-pic-container">
                                    <label for="profile_picture" style="display:block">
                                        <img src="{{asset('images/avatar.jpg')}}" class="profile-pic" id="profile-pic">
                                        <img src="{{asset('images/upload_icon.png')}}" id="upload-icon">
                                        <div id="image-overlay"></div>
                                    </label>
                                    <input type="file" id="profile_picture" name="profile_picture" class="form-control" style="display:none;"/>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div id="beginner-grid-holder">
                        <div class="js-grid-holder" style="margin-top:-40px;padding-left:0;padding-right:0;width:80%;">
                            <h3 class="table-title" style="margin-bottom:10px">Initial Payroll</h3>
                            <div id="beginner_position" class="table-content"></div>
                        </div>
                        {{--<div style="margin-top:0px;margin-left:10%;margin-top:-20px;">--}}
                            {{--<button type="submit" class="btn btn-primary" id="Start_Date">Start Date</button>--}}
                        {{--</div>--}}
                        <input type="text" style="display:none" id="employee_id" name="employee_id" value="0">
                    </div>

                </form>

                <div id="promote-grid-holder">
                    <form autocomplete="off" method="post" id="promote_form" action="{{url('employee/save')}}">
                        @csrf
                        <div class="promote-part-holder">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="form-control-label" for="promote_date">Promote Date</label>
                                    <input type="text" class="form-control" id="promote_date" data-plugin="datepicker" name="promote_date">
                                </div>

                            </div>

                            <div class="js-grid-holder js-gird-full-width" style="margin-top:-30px;padding-left:0;padding-right:0">
                                <h3 class="table-title" style="margin-bottom:10px">Promote Payroll</h3>
                                <div id="promote_position" class="table-content"></div>
                            </div>
                            <button type="submit" class="btn btn-primary" id="promote_submit" disabled>Promote</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('insert-js')
    <script>
        var job_item=JSON.parse('<?php echo($job_item)?>');
        var position_item=JSON.parse('<?php echo($position)?>');

    </script>
    <script src="{{asset('js/employee.js')}}"></script>
@endsection


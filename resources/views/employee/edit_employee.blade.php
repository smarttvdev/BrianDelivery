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
                                           placeholder="First Name" autocomplete="off" value="{{$employee->first_name}}" required />
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="last_name">Last Name</label>
                                    <input type="text" class="form-control" id="inputBasicFirstName" name="last_name"
                                           placeholder="Last Name" value="{{$employee->last_name}}" autocomplete="off" />
                                </div>

                                {{--<div class="form-group">--}}
                                    {{--<label class="form-control-label" for="last_name">Bonus</label>--}}
                                    {{--<input type="number" class="form-control" name="bonus"--}}
                                           {{--placeholder=0 value="{{$employee->bonus}}" autocomplete="off" />--}}
                                {{--</div>--}}

                                <div class="form-group">
                                    <label class="form-control-label">Gender</label>
                                    <div>
                                        <div class="radio-custom radio-default radio-inline">
                                            <input type="radio" id="gender_male" name="gender" value="male" {{$employee->gender=='male' ? 'checked' : ''}}/>
                                            <label for="gender_male">Male</label>
                                        </div>
                                        <div class="radio-custom radio-default radio-inline">
                                            <input type="radio" id="gender_female" name="gender" value="female" {{$employee->gender=='female' ? 'checked' : ''}} />
                                            <label for="gender_female">Female</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Paid Method</label>
                                    <div>
                                        <div class="radio-custom radio-default radio-inline">
                                            <input type="radio" id="cash" name="PaidMethod" value="cash" {{$employee->paid_method=='cash' ? 'checked' : ''}} />
                                            <label for="cash">Cash</label>
                                        </div>
                                        <div class="radio-custom radio-default radio-inline">
                                            <input type="radio" id="credit" name="PaidMethod" value="credit" {{$employee->paid_method=='credit' ? 'checked' : ''}} />
                                            <label for="credit">Credit</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h3 class="pictureID-label">Upload Picture ID</h3>
                                <div class="profile-pic-container">
                                    <label for="profile_picture" style="display:block">
                                        <img src="{{$employee->pictureID!=null ? url('public/pictureIDs').'/'.$employee->pictureID : asset('images/avatar.jpg') }}" class="profile-pic" id="profile-pic">
                                        <img src="{{asset('images/upload_icon.png')}}" id="upload-icon">
                                        <div id="image-overlay"></div>
                                    </label>
                                    <input type="file" id="profile_picture" name="profile_picture" class="form-control" style="display:none;"/>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success" id="add_employee_btn">Update Employee</button>
                    </div>
                    <div id="beginner-grid-holder">
                        <div class="js-grid-holder" style="margin-top:-40px;padding-left:0;padding-right:0;width:80%">
                            <h3 class="table-title" style="margin-bottom:10px">Initial Position</h3>
                            <div id="beginner_position" class="table-content"></div>
                        </div>

                        <div style="margin-top:-20px;margin-left:10%">
                            <button type="submit" class="btn btn-primary" id="Start_Date">Start Date</button>
                        </div>
                    </div>
                    <input type="text" style="display:none" id="employee_id" name="employee_id" value="{{$employee->id}}">
                </form>

                <form autocomplete="off" method="post" id="promote_form" action="{{url('employee/save')}}">
                    @csrf
                    <div class="promote-part-holder">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-control-label" for="promote_date">Promote Date</label>
                                <input type="text" class="form-control" id="promote_date" data-plugin="datepicker" name="promote_date" value="{{$employee->promotion_date!=null ? $employee->promotion_date : ''}}">
                            </div>

                        </div>
                        <div id="promote-grid-holder">
                            <div class="js-grid-holder js-gird-full-width" style="margin-top:-30px;padding-left:0;padding-right:0">
                                <h3 class="table-title" style="margin-bottom:10px">Promote Position</h3>
                                <div id="promote_position" class="table-content"></div>
                            </div>
                            <button type="submit" class="btn btn-primary" id="promote_submit">Promote</button>
                        </div>
                    </div>
                </form>

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



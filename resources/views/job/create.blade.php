@extends('layouts.template')

@section('page-content')
    <div class="page-content">
        <div class="panel">
            <div class="panel-body container-fluid" style="height:1400px;">
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

                                <div class="form-group">
                                    <label class="form-control-label">Gender</label>
                                    <div>
                                        <div class="radio-custom radio-default radio-inline">
                                            <input type="radio" id="gender_male" name="gender" value="male" checked />
                                            <label for="gender_male">Male</label>
                                        </div>
                                        <div class="radio-custom radio-default radio-inline">
                                            <input type="radio" id="gender_female" name="gender" value="female" />
                                            <label for="gender_female">Female</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Paid Method</label>
                                    <div>
                                        <div class="radio-custom radio-default radio-inline">
                                            <input type="radio" id="cash" name="PaidMethod" value="cash" checked />
                                            <label for="cash">Cash</label>
                                        </div>
                                        <div class="radio-custom radio-default radio-inline">
                                            <input type="radio" id="credit" name="PaidMethod" value="credit" />
                                            <label for="credit">Credit</label>
                                        </div>
                                    </div>
                                </div>
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

                    <div class="js-grid-holder" style="margin-top:-40px;padding-left:0;padding-right:0">
                        <h3 class="table-title" style="margin-bottom:10px">Select Employee</h3>
                        <div id="beginner_position" class="table-content"></div>
                    </div>

                    <div style="margin-top:-40px;margin-left:10%">
                        <button type="submit" class="btn btn-primary" id="Start_Date">Start Date</button>
                    </div>
                    <input type="text" style="display:none" id="employee_id" name="employee_id" value="0">
                </form>




            </div>
        </div>

    </div>
@endsection

@section('insert-js')
    <script>






    </script>



@endsection



@extends('layouts.template')

@section('page-content')
    <style>
        label{
            text-align: right;
            margin-right:10px;
            width:210px;

        }
        .label-input{
            margin-left:0 !important;
            margin-right:0 !important;
            margin-top:5px;

        }
        .form-control-label{
            text-transform: uppercase;
        }
        input{
            width:220px !important;
        }
        input[type='submit']{
            width:200px !important;
        }
        select{
            width:220px !important;
        }
        .checkbox-custom{
            margin-left:150px;
        }
        .checkbox-label{
            text-align: left;
            width:150px;
        }
        .mandatory{
            font-size:11px;
            color:#f00;
            margin-left:3px;
        }



    </style>
    <div class="page-content">
        <div class="panel">
            <div class="panel-body container-fluid" >
                <form autocomplete="off" method="post" id="beginner_form" action="{{url('employee/save')}}">
                    @csrf
                    {{--<div class="form-wrap">--}}
                        <div class="row" style="margin-left:20px;margin-right:0px;max-width:1000px;margin:auto;">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <div class="row label-input">
                                        <div><label class="form-control-label">pick up address<span class="mandatory">(Mandatory)</span>: </label></div>
                                        <div>
                                            <input type="text" class="form-control" id="pick_adress" name="pick_adress" placeholder="Pick Up Address" autocomplete="off"/>
                                        </div>
                                        {{--<div class="checkbox-custom checkbox-default">--}}
                                            {{--<input type="checkbox" id="pick_adress_mandatory" name="pick_adress_mandatory" checked autocomplete="off" disabled/>--}}
                                            {{--<label for="pick_adress_mandatory" class="checkbox-label">Mandatory</label>--}}
                                        {{--</div>--}}
                                    </div>
                                    <div class="row label-input">
                                        <div><label class="form-control-label">Drop Off Address<span class="mandatory">(Mandatory)</span>: </label></div>
                                        <div>
                                            <input type="text" class="form-control" id="drop_adress" name="drop_adress" autocomplete="off" placeholder="Drop Off Address"/>
                                        </div>
                                    </div>
                                    <div class="row label-input">
                                        <div><label class="form-control-label">Add A Stop<span class="mandatory">(Mandatory)</span>: </label></div>
                                        <div>
                                            <input type="text" class="form-control" id="stop" name="stop"
                                                   placeholder="Add A Stop" autocomplete="off"/>
                                        </div>
                                    </div>
                                    <div class="row label-input">
                                        <div><label class="form-control-label">Start Time<span class="mandatory">(Mandatory)</span>: </label></div>
                                        <div>
                                            <input type="text" class="form-control" id="start_time" name="start_time"
                                                   placeholder="Start Time" autocomplete="off"/>
                                        </div>
                                    </div>
                                    <div class="row label-input">
                                        <div><label class="form-control-label">Finish Time<span class="mandatory">(Mandatory)</span>: </label></div>
                                        <div>
                                            <input type="text" class="form-control" id="finish_time" name="finish_time"
                                                   placeholder="Finish Time" autocomplete="off"/>
                                        </div>
                                    </div>
                                    <div class="row label-input">
                                        <div><label class="form-control-label">Labor Hours<span class="mandatory">(Mandatory)</span>: </label></div>
                                        <div>
                                            <input type="text" class="form-control" id="labor_hour" name="labor_hour"
                                                   placeholder="Labor Hours" autocomplete="off"/>
                                        </div>
                                    </div>
                                    <div class="row label-input">
                                        <div><label class="form-control-label">Travel Time<span class="mandatory">(Mandatory)</span>: </label></div>
                                        <div>
                                            <input type="text" class="form-control" name="travel_time"
                                                   placeholder="Travel Time" autocomplete="off"/>
                                        </div>
                                    </div>
                                    <div class="row label-input">
                                        <div><label class="form-control-label">Total Hours<span class="mandatory">(Mandatory)</span>: </label></div>
                                        <div>
                                            <input type="text" class="form-control" name="total_hours" placeholder="Total Hours" autocomplete="off"/>

                                        </div>
                                    </div>
                                    <div class="row label-input">
                                        <div><label class="form-control-label">Discount $: </label></div>
                                        <div>
                                            <input type="text" class="form-control" name="discount" placeholder="0" autocomplete="off"/>
                                        </div>
                                    </div>
                                    <div class="row label-input">
                                        <div><label class="form-control-label">job total $: </label></div>
                                        <div>
                                            <input type="text" class="form-control" name="job_total" placeholder="0" readonly autocomplete="off"/>
                                        </div>
                                    </div>
                                    <div class="row label-input">
                                        <div><label class="form-control-label">truck license<span class="mandatory">(Mandatory)</span>: </label></div>
                                        <div>
                                            <input type="text" class="form-control" name="truck_license" placeholder="Truck License" autocomplete="off"/>
                                        </div>
                                    </div>

                                </div>
                                <input type="file" id="profile_picture" name="profile_picture"/>
                                {{--<div class="clearfix"></div>--}}
                                <button type="submit" class="btn btn-primary" id="Start_Date">Start Date</button>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <div class="row label-input">
                                        <div><label class="form-control-label">non profitable: </label></div>
                                        <div>
                                            <input type="text" class="form-control" name="non_profit"
                                                   placeholder="Truck License Plate $" autocomplete="off"/>
                                        </div>
                                    </div>
                                    <div class="row label-input">
                                        <div><label class="form-control-label">tips $: </label></div>
                                        <div>
                                            <input type="text" class="form-control" name="tips"
                                                   placeholder="Tips" autocomplete="off"/>
                                        </div>
                                    </div>
                                    <div class="row label-input">
                                        <div><label class="form-control-label">Select Job Type<span class="mandatory">(Mandatory)</span>:</label></div>
                                        <div>
                                            <select class="form-control" style="width:200px" name="job" id="job">
                                                <option value="0"></option>
                                               @for($i=0;$i<count($jobs);$i++)
                                                   <option value="{{$jobs[$i]['id']}}">{{$jobs[$i]['name']}}</option>
                                               @endfor
                                            </select>
                                        </div>

                                    </div>
                                    <div class="row label-input">
                                        <div><label class="form-control-label">Select Position<span class="mandatory">(Mandatory)</span>:</label></div>
                                        <div>
                                            <select class="form-control" style="width:200px" name="position" id="position">
                                                <option value="0"></option>
                                                @for($i=0;$i<count($positions);$i++)
                                                    <option value="{{$positions[$i]['id']}}">{{$positions[$i]['name']}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row label-input">
                                        <div><label class="form-control-label">Select Employee<span class="mandatory">(Mandatory)</span>:</label></div>
                                        <div>
                                            <select class="form-control" style="width:200px" name="employee" id="employee">
                                                <option value="0"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row label-input">
                                        <div><label class="form-control-label">Rate $: </label></div>
                                        <div>
                                            <input type="text" class="form-control" name="rate" id="rate"
                                                   placeholder="0" autocomplete="off"/>
                                        </div>
                                    </div>
                                    <div class="row label-input">
                                        <div><label class="form-control-label">Bonus %, $: </label></div>
                                        <div>
                                            <input type="text" class="form-control" name="bonus" id="bonus"
                                                   placeholder="0" autocomplete="off"/>
                                        </div>
                                    </div>
                                    <div class="row label-input">
                                        <div><label class="form-control-label">Extra $: </label></div>
                                        <div>
                                            <input type="text" class="form-control" name="extra" id="extra"
                                                   placeholder="0" autocomplete="off"/>
                                        </div>
                                    </div>
                                    <div class="row label-input">
                                        <div><label class="form-control-label">Packing $: </label></div>
                                        <div>
                                            <input type="text" class="form-control" name="packing" id="packing"
                                                   placeholder="0" autocomplete="off"/>
                                        </div>
                                    </div>
                                    <div class="row label-input">
                                        <div><label class="form-control-label">Service $: </label></div>
                                        <div>
                                            <input type="text" class="form-control" name="service" id="service"
                                                   placeholder="0" autocomplete="off"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    <input type="text" style="display:none" id="employee_id" name="employee_id" value="0">
                </form>




            </div>
        </div>

    </div>
@endsection

@section('insert-js')
    <script>
        var jobs=JSON.parse('<?php echo(json_encode($jobs))?>');
        var positions=JSON.parse('<?php echo(json_encode($positions))?>');
        var employees=JSON.parse('<?php echo(json_encode($employees))?>');

        $(document).ready(function () {
            console.log(employees);
            console.log(jobs);
            console.log(positions);

        })


        var job=0,position=0,employee=0;
        $('#job').change(function () {
            job=$(this).val();
            position=$('#position').val();
            for (var i=0;i<jobs.length;i++){
                if (jobs[i]['id']==job){
                    $('#rate').val(jobs[i]['pay_amount']);
                    $('#bonus').val(jobs[i]['bonus']);
                    $('#extra').val(jobs[i]['extra']);
                    $('#packing').val(jobs[i]['packing']);
                    $('#service').val(jobs[i]['service']);
                    break;
                }
            }
            getEmployeeByJobAndPosition(job,position);
        })
        $('#position').change(function () {
            job=$('#job').val();
            position=$('#position').val();
            getEmployeeByJobAndPosition(job,position);
        })

        $('#employee').change(function () {
            job=$('#job').val();
            position=$('#position').val();
            employee=$('#employee').val();
            console.log('job='+job);
            console.log('position='+position);

            for (var i=0;i<employees.length;i++){
                if (employees[i]['id']==employee){
                    for (var j=0;j<employees[i]['job'].length;j++){
                        console.log('jobs='+employees[i]['job'][j]);
                        console.log('positions='+employees[i]['position'][j]);
                        if (employees[i]['job'][j]==job && employees[i]['position'][j]==position){
                            $('#rate').val(employees[i]['pay_amount'][j]);
                            $('#bonus').val(employees[i]['bonus'][j]);
                            $('#extra').val(employees[i]['extra'][j]);
                            $('#packing').val(employees[i]['packing'][j]);
                            $('#service').val(employees[i]['service'][j]);
                            break;
                        }
                    }
                    break;
                }
            }
        })

        function getEmployeeByJobAndPosition(job_id, position_id) {
            $('#employee').empty();
            $('#employee').append('<option value="0"></option>');
            for (var i=0;i<employees.length;i++){
                if (typeof employees[i]['job']!="undefined"){
                    for (var j=0;j<employees[i]['job'].length;j++){
                        if(employees[i]['job'][j]==job_id && employees[i]['position'][j]==position_id){
                            $('#employee').append('<option value='+employees[i]['id']+'>'+employees[i]['name']+'</option>');
                        }
                    }
                }
            }
        }
    </script>

@endsection



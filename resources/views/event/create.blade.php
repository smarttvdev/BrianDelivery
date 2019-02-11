@extends('layouts.template')
@section('insert-css')
    <link rel="stylesheet" href="{{asset('template/vendor/datatables.net-bs4/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('template/vendor/datatables.net-fixedheader-bs4/dataTables.fixedheader.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('template/vendor/datatables.net-fixedcolumns-bs4/dataTables.fixedcolumns.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('template/vendor/datatables.net-rowgroup-bs4/dataTables.rowgroup.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('template/vendor/datatables.net-scroller-bs4/dataTables.scroller.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('template/vendor/datatables.net-select-bs4/dataTables.select.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('template/vendor/datatables.net-responsive-bs4/dataTables.responsive.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('template/vendor/datatables.net-buttons-bs4/dataTables.buttons.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('template/examples/css/tables/datatable.css')}}">
@endsection
@section('page-content')
    <style>
        .section{
            margin:auto;
            max-width:1200px;
            border:1px solid #aaa;
            margin-top:20px;
            padding-bottom:30px;
        }
        .section-title{
            margin:auto;
            width:fit-content;
            margin-top:30px !important;
            margin-bottom:30px;

        }
        label.form-control-label{
            text-align: right;
            margin-right:10px;
            width:210px;
        }
        .label-input{
            margin-left:0 !important;
            margin-right:0 !important;
            margin-top:5px;
            max-width:500px;
            float:right;

            display:flex;
            justify-content: space-between;
        }
        .form-control-label{
            text-transform: uppercase;
        }
        input.form-control,textarea.form-control{
            width:220px !important;
        }
        input[type='submit']{
            width:200px !important;
        }
        select.form-control{
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

        td.details-control {
            background: url('../public/images/details_open.png') no-repeat center center;
            width:30px;
            cursor: pointer;
        }
        tr.shown td.details-control {
            background: url('../public/images/details_close.png') no-repeat center center;
        }
        td, th{
            text-align: center;
        }



    </style>
    <div class="page-content">
        <div class="panel">
            <div class="panel-body container-fluid" >
                <div class="section">
                    <h3 class="section-title">Event Common Variables</h3>
                    <form autocomplete="off" method="post" id="beginner_form" action="{{url('employee/save')}}">
                        @csrf
                        <div class="row" style="margin-left:0;margin-right:0;">
                            <div class="col-lg-6 col-12">
                                <div class="form-group" style="">
                                    <div class="label-input">
                                        <div><label class="form-control-label">pick up address<span class="mandatory">(Mandatory)</span>: </label></div>
                                        <div>
                                            <input type="text" class="form-control" id="pick_adress" name="pick_adress" placeholder="Pick Up Address" autocomplete="off"/>
                                        </div>
                                    </div>
                                    <div class="label-input">
                                        <div><label class="form-control-label">Drop Off Address<span class="mandatory">(Mandatory)</span>: </label></div>
                                        <div>
                                            <input type="text" class="form-control" id="drop_adress" name="drop_adress" autocomplete="off" placeholder="Drop Off Address"/>
                                        </div>
                                    </div>
                                    <div class="label-input">
                                        <div><label class="form-control-label">Add A Stop<span class="mandatory">(Mandatory)</span>: </label></div>
                                        <div>
                                            <input type="text" class="form-control" id="stop" name="stop"
                                                   placeholder="Add A Stop" autocomplete="off"/>
                                        </div>
                                    </div>
                                    <div class="label-input">
                                        <div><label class="form-control-label">Non Profit: </label></div>
                                        <div>
                                            <input type="number" class="form-control" id="stop" name="non_profit"
                                                   value="0" autocomplete="off"/>
                                        </div>
                                    </div>
                                    <div class="label-input">
                                        <div><label class="form-control-label">Packing</label></div>
                                        <div>
                                            <input type="text" class="form-control" id="packing" name="packing"
                                                   value="0" autocomplete="off"/>
                                        </div>
                                    </div>
                                    <div class="label-input">
                                        <div><label class="form-control-label">Service: </label></div>
                                        <div>
                                            <input type="text" class="form-control" id="service" name="service"
                                                   value="0" autocomplete="off"/>
                                        </div>
                                    </div>
                                    <div class="label-input">
                                        <div><label class="form-control-label">Extra Amount: </label></div>
                                        <div>
                                            <input type="text" class="form-control" id="extra" name="extra"
                                                   value="0" autocomplete="off"/>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>
                                    <div class="label-input">
                                        <button type="submit" class="btn btn-primary" id="Start_Date">Submit</button>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group"  style="">

                                    <div class="label-input">
                                        <div><label class="form-control-label">truck license<span class="mandatory">(Mandatory)</span>: </label></div>
                                        <div>
                                            <input type="text" class="form-control" name="truck_license" placeholder="Truck License" autocomplete="off"/>
                                        </div>
                                    </div>
                                    <div class="label-input">
                                        <div><label class="form-control-label">Attach Shipping Documents<span class="mandatory">(Mandatory)</span>: </label></div>
                                        <div>
                                            <input type="file" class="form-control" id="profile_picture" name="profile_picture" style="margin-top:10px"/>
                                        </div>
                                    </div>
                                    <div class="label-input">
                                        <div><label class="form-control-label" style="margin-top:50px">Event Comment: </label></div>
                                        <div>
                                            <textarea class="form-control" id="event_commnet" name="event_comment" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="event_id" value="0">
                    </form>
                </div>

                <div class="section">
                    <h3 class="section-title">Employee Setting Parameter</h3>
                    <div class="row" style="margin-left:0;margin-right:0;">
                        <div class="col-lg-6 col-12">
                            <div class="form-group" style="">
                                <div class="label-input">
                                    <div><label class="form-control-label">Start Time<span class="mandatory">(Mandatory)</span>:</label></div>
                                    <div>
                                        <input type="text" class="form-control" id="start_time" name="start_time" placeholder="Start Time" autocomplete="off"/>
                                    </div>
                                </div>
                                <div class="label-input">
                                    <div><label class="form-control-label">Finish Time<span class="mandatory">(Mandatory)</span>: </label></div>
                                    <div>
                                        <input type="text" class="form-control" id="finish_time" name="finish_time" autocomplete="off" placeholder="Finish Time"/>
                                    </div>
                                </div>
                                <div class="label-input">
                                    <div><label class="form-control-label">Hourly Rate<span class="mandatory">(Mandatory)</span>: </label></div>
                                    <div>
                                        <input type="text" class="form-control" id="hourly_rate" name="hourly_rate"
                                               placeholder="Hourly Rate" value="0" autocomplete="off"/>
                                    </div>
                                </div>

                                <div class="label-input">
                                    <div><label class="form-control-label">Job Total, $: </label></div>
                                    <div>
                                        <input type="text" class="form-control" id="job_total" name="job_total"
                                               value="0" autocomplete="off"/>
                                    </div>
                                </div>
                                <div class="label-input">
                                    <div><label class="form-control-label">Bonus, % </label></div>
                                    <div>
                                        <input type="text" class="form-control" id="bonus" name="bonus"
                                               value="0" autocomplete="off"/>
                                    </div>
                                </div>
                                <div class="label-input">
                                    <div><label class="form-control-label">Hourly: </label></div>
                                    <div>
                                        <input type="text" class="form-control" id="hourly_pay" name="hourly_pay"
                                               value="0" autocomplete="off"/>
                                    </div>
                                </div>
                                <div class="label-input">
                                    <div><label class="form-control-label">Hourly, %: </label></div>
                                    <div>
                                        <input type="text" class="form-control" id="hourly_percent" name="hourly_percent"
                                               value="0" autocomplete="off"/>
                                    </div>
                                </div>
                                <div class="label-input">
                                    <div><label class="form-control-label">Flat, %: </label></div>
                                    <div>
                                        <input type="text" class="form-control" id="flat_percent" name="flat_percent"
                                               value="0" autocomplete="off"/>
                                    </div>
                                </div>
                                <div class="label-input">
                                    <div><label class="form-control-label">Extra Flat, %: </label></div>
                                    <div>
                                        <input type="text" class="form-control" id="extra_flat" name="extra_flat"
                                               value="0" autocomplete="off"/>
                                    </div>
                                </div>
                                <div class="label-input">
                                    <div><label class="form-control-label">Packing, %: </label></div>
                                    <div>
                                        <input type="text" class="form-control" id="packing_percent" name="packing_percent"
                                               value="0" autocomplete="off"/>
                                    </div>
                                </div>
                                <div class="label-input">
                                    <div><label class="form-control-label">Service, %: </label></div>
                                    <div>
                                        <input type="text" class="form-control" id="service_percent" name="service_percent"
                                               value="0" autocomplete="off"/>
                                    </div>
                                </div>
                                <div class="label-input">
                                    <div><label class="form-control-label">Non Profit, %: </label></div>
                                    <div>
                                        <input type="text" class="form-control" id="non_profit_percent" name="non_profit_percent"
                                               value="0" autocomplete="off"/>
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                                <div class="label-input">
                                    <button type="submit" class="btn btn-primary" id="Start_Date">Submit</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="label-input">
                                <div><label class="form-control-label">Labor Hours: </label></div>
                                <div>
                                    <input type="number" class="form-control" id="labor_hour" name="labor_hour"
                                           value="0" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="label-input">
                                <div><label class="form-control-label">Travel Time</label></div>
                                <div>
                                    <input type="text" class="form-control" id="travel_time" name="travel_time"
                                           value="0" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="label-input">
                                <div><label class="form-control-label">Total Hours: </label></div>
                                <div>
                                    <input type="text" class="form-control" id="total_hour" name="total_hour"
                                           value="0" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="label-input">
                                <div><label class="form-control-label">Discount, $: </label></div>
                                <div>
                                    <input type="text" class="form-control" id="discount" name="discount"
                                           value="0" autocomplete="off"/>
                                </div>
                            </div>

                            <div class="label-input">
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

                            <div class="label-input">
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
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Job</th>
                                    <th>Position</th>
                                    <th>Add</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                            </table>

                        </div>
                    </div>


                </div>

                <div class="section">
                    <h3 class="section-title">Selected Employees</h3>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('insert-js')
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script>
        var jobs=JSON.parse('<?php echo(json_encode($jobs))?>');
        var positions=JSON.parse('<?php echo(json_encode($positions))?>');
        var employees=JSON.parse('<?php echo(json_encode($employees))?>');

        function changePrice(d,i) {
            console.log(d);

        }

        function format ( d ) {
            console.log(d);
            // `d` is the original data object for the row
            // return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
            //     '<tr>'+
            //     '<td>Hourly Pay:</td>'+
            //     '<td><input type="text" value="'+d.hourly_pay+'"></td>'+
            //     '</tr>'+
            //     '<td>Hourly, %:</td>'+
            //     '<td><input type="text" value="'+d.hourly_percent+'"></td>'+
            //     '</tr>'+
            //     '<tr>'+
            //     '<td>Flat, %:</td>'+
            //     '<td><input type="text" value="'+d.flat_percent+'"></td>'+
            //     '</tr>'+
            //     '<tr>'+
            //     '<td>Extra, %:</td>'+
            //     '<td><input type="text" value="'+d.extra_percent+'"></td>'+
            //     '</tr>'+
            //     '<tr>'+
            //     '<td>Packing, %:</td>'+
            //     '<td><input type="text" value="'+d.packing_percent+'"></td>'+
            //     '</tr>'+
            //     '<td>Service, %:</td>'+
            //     '<td><input type="text" value="'+d.service_percent+'"></td>'+
            //     '</tr>'+
            //     '<tr>'+
            //     '<td>Price Description, %:</td>'+
            //     '<td><textarea type="text" rows="6"></textarea></td>'+
            //     '</tr>'+
            //     '</table>';

            $('#hourly_pay').val(d.hourly_pay);


        }


        $(document).ready(function () {
            console.log(employees);
            console.log(jobs);
            console.log(positions);
            var table = $('#example').DataTable({
                "ajax":"{{url('/getEmployee')}}",
                "columns": [
                    {
                        "className":      'details-control',
                        "orderable":      false,
                        "data":           null,
                        "defaultContent": ''
                    },
                    {"data": "name"},
                    { "data": "job" },
                    { "data": "position"},
                    {
                        "data":           null,
                        "className":"Add",
                        "defaultContent": '<button value="Add" class="btn btn-dark">Add to Event</button>'
                    },
                    {
                        "data":"employee_id",
                        "className":"hide"

                    },
                    {
                        "data":"job_id",
                        "className":"hide"
                    },
                    {
                        "data":"position_id",
                        "className":"hide"
                    },
                    {
                        "data":"hourly_pay",
                        "className":"hide"
                    },
                    {
                        "data":"hourly_percent",
                        "className":"hide"
                    },
                    {
                        "data":"flat_percent",
                        "className":"hide"
                    },
                    {
                        "data":"extra_percent",
                        "className":"hide"
                    },
                    {
                        "data":"packing_percent",
                        "className":"hide"
                    },
                    {
                        "data":"service_percent",
                        "className":"hide"
                    }



                ],
                sort:false
            });
            // $('#example tbody').on('click', 'td.details-control', function () {
            $('#example tbody').on('click', 'tr', function () {
                var tr = $(this).closest('tr');
                var row = table.row( tr );

                // if ( row.child.isShown() ) {
                //     row.child.hide(1000);
                //     tr.removeClass('shown');
                // }
                // else {
                //     row.child( format(row.data()) ).show(1000);
                //     tr.addClass('shown');
                // }
            } );



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



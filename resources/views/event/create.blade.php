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
        tr{
            cursor:pointer;
        }

        .hide{
            display:none !important;
        }

        .edit-modal-content{
            margin:auto;
            margin-top:20px;
        }
        .edit-input{
            padding-left:10px;
        }

        .employee-edit-row{
            display:flex;
            justify-content: space-between;
        }
        .edit-label{
            width:100px;
        }
        .edit-input{
            width:calc(100% - 120px);
        }
        .edit-comment{
            width:calc(100% - 103px);
        }

        @media screen and (min-width:480px){
            .employee-edit-holder:nth-child(odd){
                margin-top:5px;
                text-align:left;
                width:fit-content;
                padding-left:0;
            }
            .employee-edit-holder:nth-child(even){
                margin-top:5px;
                text-align:right;
                width:fit-content;
                padding-right:0;
                margin-left:10px;
            }
        }
        .employee-edit-holder label{
            text-align:right;
        }
        .price-comment-holder{
            text-align: right;
            display:flex;
            justify-content: space-between;
            margin-top:10px;
        }
        .comment-label{
            display:block;
            margin-top:40px;
            margin-left:10px;
        }


    </style>
    <div class="page-content">
        <div class="panel">
            <div class="panel-body container-fluid" >
                <div class="section">
                    <h3 class="section-title">Event Common Variables</h3>
                    <form autocomplete="off" method="post" id="event_form" action="{{url('employee/save')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row" style="margin-left:0;margin-right:0;">
                            <div class="col-lg-6 col-12">
                                <div class="form-group" style="">
                                    <div class="label-input">
                                        <div><label class="form-control-label">pick up address<span class="mandatory">(Mandatory)</span>: </label></div>
                                        <div>
                                            <input type="text" class="form-control" id="pick_address" name="pick_address" placeholder="Pick Up Address" autocomplete="off"/>
                                        </div>
                                    </div>
                                    <div class="label-input">
                                        <div><label class="form-control-label">Drop Off Address<span class="mandatory">(Mandatory)</span>: </label></div>
                                        <div>
                                            <input type="text" class="form-control" id="drop_address" name="drop_address" autocomplete="off" placeholder="Drop Off Address"/>
                                        </div>
                                    </div>
                                    <div class="label-input">
                                        <div><label class="form-control-label">Add A Stop<span class="mandatory">(Mandatory)</span>: </label></div>
                                        <div>
                                            <input type="text" class="form-control" id="stop_address" name="stop_address"
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
                                        <div><label class="form-control-label">Flat: </label></div>
                                        <div>
                                            <input type="number" class="form-control" id="flat" name="flat"
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
                                            {{--<input type="file" accept=".pdf,.doc,.docx" class="form-control" id="profile_picture" name="profile_picture" style="margin-top:10px"/>--}}
                                            <div class="input-group input-group-file" data-plugin="inputGroupFile">
                                                <input type="text" class="form-control" style="width:180px !important;" readonly="">
                                                <div class="input-group-append">
                                                    <span class="btn btn-success btn-file">
                                                      <i class="icon wb-upload" aria-hidden="true"></i>
                                                      <input type="file" class="form-control" name="attach_docs" accept=".pdf,.doc,.docx" multiple="">
                                                    </span>
                                                </div>
                                            </div>

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
                            <button type="submit" class="btn btn-primary" id="register_event" style="margin:auto; display:block;width:150px; border-radius:30px">Submit</button>
                        <input type="hidden" id="event_id" value="0" name="event_id">
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
                                    <div><label class="form-control-label">Hourly Pay: </label></div>
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
                                    <div><label class="form-control-label">Extra Percent, %: </label></div>
                                    <div>
                                        <input type="text" class="form-control" id="extra_percent" name="extra_percent"
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
                                <div class="label-input">
                                    <div><label class="form-control-label" style="margin-top:50px">Price Comment: </label></div>
                                    <div>
                                        <textarea class="form-control" id="price_commnet" name="price_comment" rows="5"></textarea>
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="label-input">
                                <div><label class="form-control-label">Labor Hours: </label></div>
                                <div>
                                    <input type="number" class="form-control" id="labor_hours" name="labor_hours"
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
                                    <input type="text" class="form-control" id="total_hours" name="total_hours"
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
                                <div><label class="form-control-label">Tips, $: </label></div>
                                <div>
                                    <input type="text" class="form-control" id="tips" name="tips"
                                           value="0" autocomplete="off"/>
                                </div>
                            </div>

                            <div class="label-input" style="margin-top:40px;">
                                <div><label class="form-control-label" style="color:black;font-weight:bold">Select Job Type<span class="mandatory">(Mandatory)</span>:</label></div>
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
                                <div><label class="form-control-label" style="color:black;font-weight:bold">Select Position<span class="mandatory">(Mandatory)</span>:</label></div>
                                <div>
                                    <select class="form-control" style="width:200px" name="position" id="position">
                                        <option value="0"></option>
                                        @for($i=0;$i<count($positions);$i++)
                                            <option value="{{$positions[$i]['id']}}">{{$positions[$i]['name']}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div id="employee-table-house" class="table-responsive" style="max-width:500px; float:right;margin-top:30px">
                                <table id="example" class="display" style="width:100%; float:right">
                                    <thead>
                                    <tr>
                                        {{--<th></th>--}}
                                        <th>Name</th>
                                        <th>Job</th>
                                        <th>Position</th>
                                        <th>Select</th>
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
                    <button type="submit" class="btn btn-primary" id="add_employee" style="margin:auto; display:block;width:150px; border-radius:30px">Submit</button>
                </div>

                <div class="section">
                    <h3 class="section-title">Selected Employees</h3>
                    <div id="employee-table-house" class="table-responsive" style="margin-top:30px">
                        <table id="selected_employees" class="display" style="width:100%; float:right">
                            <thead>
                            <tr>
                                {{--<th></th>--}}
                                <th>Name</th>
                                <th>Job</th>
                                <th>Position</th>
                                <th>Labor Hours</th>
                                <th>Hourly Pay</th>
                                <th>Job Total</th>
                                <th>Action</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
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
                    <div class="modal fade" id="editEmployeeEvent" aria-hidden="true" aria-labelledby="examplePositionCenter"
                         role="dialog" tabindex="-1">
                        <div class="modal-dialog modal-simple modal-center">
                            <div class="modal-content">
                                <div class="modal-header" style="border-bottom:1px solid">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title">Edit Data</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="edit-modal-content">
                                        <div class="employee-edit-row">
                                            <div class="employee-edit-holder">
                                                <label class="edit-label" style="text-transform: uppercase">start time: </label>
                                                <input type="text" class="edit-input" id="start_time_modal">
                                            </div>
                                            <div class="employee-edit-holder">
                                                <label class="edit-label">Finish Time: </label>
                                                <input type="text" class="edit-input" id="finish_time_modal">
                                            </div>
                                        </div>
                                        <div class="employee-edit-row">
                                            <div class="employee-edit-holder" >
                                                <label class="edit-label">Travel Time: </label>
                                                <input type="text" class="edit-input" id="travel_time_modal">
                                            </div>
                                            <div class="employee-edit-holder">
                                                <label class="edit-label">Labor Hours: </label>
                                                <input type="text" class="edit-input" id="labor_hours_modal">
                                            </div>

                                        </div>
                                        <div class="employee-edit-row">
                                            <div class="employee-edit-holder" >
                                                <label class="edit-label">Total Hours: </label>
                                                <input type="text" class="edit-input" id="total_hours_modal">
                                            </div>
                                            <div class="employee-edit-holder">
                                                <label class="edit-label">Bonus: </label>
                                                <input type="text" class="edit-input" id="bonus_modal">
                                            </div>

                                        </div>
                                        <div class="employee-edit-row">
                                            <div class="employee-edit-holder">
                                                <label class="edit-label">Hourly, %: </label>
                                                <input type="text" class="edit-input" id="hourly_percent_modal">
                                            </div>
                                            <div class="employee-edit-holder" >
                                                <label class="edit-label">Flat, %: </label>
                                                <input type="text" class="edit-input" id="flat_percent_modal">
                                            </div>
                                        </div>
                                        <div class="employee-edit-row">
                                            <div class="employee-edit-holder">
                                                <label class="edit-label">Extra, %: </label>
                                                <input type="text" class="edit-input" id="extra_percent_modal">
                                            </div>
                                            <div class="employee-edit-holder" >
                                                <label class="edit-label">Packing, %: </label>
                                                <input type="text" class="edit-input" id="packing_percent_modal">
                                            </div>
                                        </div>
                                        <div class="employee-edit-row">
                                            <div class="employee-edit-holder">
                                                <label class="edit-label">Service, %: </label>
                                                <input type="text" class="edit-input" id="service_percent_modal">
                                            </div>
                                            <div class="employee-edit-holder" >
                                                <label class="edit-label">Non Profit, %: </label>
                                                <input type="text" class="edit-input" id="non_profit_percent_modal">
                                            </div>
                                        </div>
                                        <div class="employee-edit-row">
                                            <div class="employee-edit-holder">
                                                <label class="edit-label">Hourly Rate: </label>
                                                <input type="text" class="edit-input" id="hourly_rate_modal">
                                            </div>
                                            <div class="employee-edit-holder" >
                                                <label class="edit-label">Job Total: </label>
                                                <input type="text" class="edit-input" id="job_total_modal">
                                            </div>

                                        </div>
                                        <div class="employee-edit-row">
                                            <div class="employee-edit-holder" >
                                                <label class="edit-label">Hourly Pay: </label>
                                                <input type="text" class="edit-input" id="hourly_pay_modal">
                                            </div>

                                            <div class="employee-edit-holder">
                                                <label class="edit-label">Discount, $: </label>
                                                <input type="text" class="edit-input" id="discount_modal">
                                            </div>
                                        </div>
                                        <div class="employee-edit-row">
                                            <div class="employee-edit-holder" >
                                                <label class="edit-label">Tips, $: </label>
                                                <input type="text" class="edit-input" id="tips_modal">
                                            </div>
                                        </div>
                                        <div class="price-comment-holder" >
                                            <label class="comment-label">Pay Comment: </label>
                                            <textarea type="text" class="edit-input edit-comment" id="price_comment_modal" rows="6"></textarea>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer" style="border-top:1px solid #888;padding-top:15px">
                                    <button type="button" class="btn btn-default" data-dismiss="modal" id="modal-close">Close</button>
                                    <button type="button" class="btn btn-primary" id="modal-save">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection

@section('insert-js')
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <script>
        var jobs=JSON.parse('<?php echo(json_encode($jobs))?>');
        var positions=JSON.parse('<?php echo(json_encode($positions))?>');
        var employees=JSON.parse('<?php echo(json_encode($employees))?>');
        var table;
        var selectedTable;
        var selected_tr;

        function format ( d ) {
            $('#hourly_pay').val(d.hourly_pay);
            $('#hourly_percent').val(d.hourly_percent);
            $('#flat_percent').val(d.flat_percent);
            $('#extra_percent').val(d.extra_percent);
            $('#packing_percent').val(d.packing_percent);
            $('#service_percent').val(d.service_percent);
            $('#extra_percent').val(d.extra_percent);
            $('#bonus').val(d.bonus);
        }
        $(document).ready(function () {
            $('#start_time').datetimepicker({footer:true,modal:true});
            $('#finish_time').datetimepicker({footer:true,modal:true});

            getEmployee();

            // $('#example tbody').on('click', 'td.details-control', function () {
            $('#example tbody').on('click', 'tr', function () {
                console.log('#example');
                $("input[type='radio']:checked").attr('checked',false);
                var row = table.row($(this));
                format(row.data());
                $('input:radio', this).attr('checked', true);
            } );

            $('#example tbody').on('click', 'td', function () {
                var tr=$(this).closest('tr');
                var row = table.row( tr );
                format(row.data());
                $('input:radio', this).attr('checked', true);
            } );
        })

        $('#add_employee').on('click',function () {
            var selected_employee= $("input[type='radio']:checked");
            var tr = $(selected_employee).closest('tr');
            var row=table.row(tr);

            if ($('#event_id').val()=="0")
                alert("please submit event before add employees");
            else if (typeof row.data()=="undefined")
                alert("please select employee");
            else{
                $.ajax({
                    url:"{{url('/addEmployeeToEvent')}}",
                    type:"post",
                    data:{
                        "start_time":$('#start_time').val(),
                        "finish_time":$('#finish_time').val(),
                        "hourly_rate":$('#hourly_rate').val(),
                        "job_total":$('#job_total').val(),
                        "bonus":$('#bonus').val(),
                        "hourly_pay":$('#hourly_pay').val(),
                        "hourly_percent":$('#hourly_percent').val(),
                        "flat_percent":$('#flat_percent').val(),
                        "extra_percent":$('#extra_percent').val(),
                        "packing_percent":$('#packing_percent').val(),
                        "service_percent":$('#service_percent').val(),
                        "non_profit_percent":$('#non_profit_percent').val(),
                        "comment":$('#price_commnet').val(),
                        "labor_hours":$('#labor_hours').val(),
                        "travel_time":$('#travel_time').val(),
                        "total_hours":$('#total_hours').val(),
                        "discount":$('#discount').val(),
                        "tips":$('#tips').val(),
                        "employee_id":row.data().employee_id,
                        "job_id":row.data().job_id,
                        "position_id":row.data().position_id,
                        "event_id":$('#event_id').val()
                    },
                    success:function (result) {
                        console.log(result);
                        drawSelectedEmployee();
                    },
                    error:function (err) {
                        console.log(err);
                    }
                })
            }
        })

        $('#job').change(function () {
           getEmployee();
        })
        $('#position').change(function () {
            getEmployee();
        })

        function getEmployee() {
            $("#example").dataTable().fnDestroy();
            var job_id=$('#job').val();
            var position_id=$('#position').val();

            table = $('#example').DataTable({
                "ajax":{
                    url:"{{url('/getEmployee')}}",
                    type:"post",
                    data:{"job_id":job_id,"position_id":position_id}
                },
                "columns": [
                    {"data": "name"},
                    { "data": "job" },
                    { "data": "position"},
                    {
                        "data":           null,
                        "className":"Add",
                        "defaultContent": '<div class="radio-custom radio-success radio-inline">\n' +
                            '                                            <input type="radio" id="gender_male" name="gender"/>\n' +
                            '                                            <label for="gender_male"></label>\n' +
                            '                                        </div>'
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
        }

        $('#register_event').click(function (e) {
            e.preventDefault();

            var formData=new FormData($('#event_form')[0]);
            $.ajax({
                url:"{{url('/registerEvent')}}",
                type:"post",
                contentType: false,
                processData: false,
                data:formData,
                dataType:'json',
                success:function (result) {
                    console.log(result);
                    $('#event_id').val(result);
                },
                error:function (err) {
                    console.log(err);
                }
            })
        });

        function drawSelectedEmployee() {
            $("#selected_employees").dataTable().fnDestroy();
            selectedTable = $('#selected_employees').DataTable({
                "ajax":{
                    url:"{{url('/getSelectedEmployee')}}",
                    type:"post",
                    data:{"event_id":$('#event_id').val()},
                },
                "columns": [
                    {"data": "name"},
                    { "data": "job" },
                    { "data": "position"},
                    { "data": "labor_hours"},
                    { "data": "hourly_pay"},
                    { "data": "job_total"},
                    {
                        "data":           null,
                        "className":"Add",
                        "defaultContent": '<button type="button" class="btn btn-floating btn-success btn-sm edit" style="width:30px;height:30px"><i class="icon wb-pencil" aria-hidden="true"></i></button>'+
                                          '<button type="button" class="btn btn-floating btn-danger btn-sm remove" style="width:30px;height:30px"><i class="icon fa-trash" aria-hidden="true"></i></button>'
                    },
                    {
                        "data":"employee_id",
                        "className":"hide"
                    },
                    {
                        "data":"event_id",
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
                        "data":"start_time",
                        "className":"hide"
                    },
                    {
                        "data":"finish_time",
                        "className":"hide"
                    },
                    {
                        "data":"travel_time",
                        "className":"hide"
                    },
                    {
                        "data":"total_hours",
                        "className":"hide"
                    },
                    {
                        "data":"non_profit_percent",
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
                    },
                    {
                        "data":"tips",
                        "className":"hide"
                    },
                    {
                        "data":"hourly_rate",
                        "className":"hide"
                    },
                    {
                        "data":"discount",
                        "className":"hide"
                    },
                    {
                        "data":"comment",
                        "className":"hide"
                    },
                    {
                        "data":"bonus",
                        "className":"hide"
                    },
                ],
                sort:false
            });
        };

        $(document).on('click','#selected_employees tbody td button.btn.edit', function () {
            console.log(selectedTable);
            var tr = $(this).closest('tr');
            selected_tr=tr;
            var row=selectedTable.row(tr);
            var data=row.data();
            console.log(data);
            $('#editEmployeeEvent').modal('show');
            $('#start_time_modal').val(data.start_time);
            $('#finish_time_modal').val(data.finish_time);
            $('#travel_time_modal').val(data.travel_time);
            $('#labor_hours_modal').val(data.labor_hours);
            $('#total_hours_modal').val(data.total_hours);

            $('#bonus_modal').val(data.bonus);
            $('#hourly_percent_modal').val(data.hourly_percent);
            $('#flat_percent_modal').val(data.flat_percent);
            $('#extra_percent_modal').val(data.extra_percent);
            $('#packing_percent_modal').val(data.packing_percent);
            $('#service_percent_modal').val(data.service_percent);
            $('#non_profit_percent_modal').val(data.non_profit_percent);
            $('#hourly_rate_modal').val(data.hourly_rate);
            $('#job_total_modal').val(data.job_total);
            $('#hourly_pay_modal').val(data.hourly_pay);
            $('#discount_modal').val(data.discount);
            $('#tips_modal').val(data.tips);
            $('#price_comment_modal').val(data.comment);
        });
        $(document).on('click','#selected_employees tbody td button.btn.remove', function () {
            console.log(selectedTable);
            var tr = $(this).closest('tr');
            var row=selectedTable.row(tr);
            var data=row.data();
            $(tr).remove();
            $.ajax({
                url:"{{url('/deleteEmployeeEvent')}}",
                type:"post",
                data:{event_id:data.event_id,job_id:data.job_id,position_id:data.position_id},
            });
        })

        $('#modal-save').click(function() {
            var row = selectedTable.row(selected_tr);
            var data=row.data();
            data.start_time=$('#start_time_modal').val();
            data.finish_time=$('#finish_time_modal').val();
            data.travel_time=$('#travel_time_modal').val();
            data.labor_hours=$('#labor_hours_modal').val();
            data.total_hours=$('#total_hours_modal').val();
            data.bonus=$('#bonus_modal').val();
            data.hourly_percent=$('#hourly_percent_modal').val();
            data.flat_percent=$('#flat_percent_modal').val();
            data.extra_percent=$('#extra_percent_modal').val();
            data.packing_percent=$('#packing_percent_modal').val();
            data.service_percent=$('#service_percent_modal').val();
            data.non_profit_percent=$('#non_profit_percent_modal').val();
            data.hourly_rate=$('#hourly_rate_modal').val();
            data.job_total=$('#job_total_modal').val();
            data.hourly_pay=$('#hourly_pay_modal').val();
            data.discount=$('#discount_modal').val();
            data.tips=$('#tips_modal').val();
            data.comment=$('#price_comment_modal').val();
            selectedTable
                .row(selected_tr)
                .data( data )
                .draw();
            $.ajax({
                url:"{{url('/addEmployeeToEvent')}}",
                type:"post",
                data:{
                    "start_time":$('#start_time_modal').val(),
                    "finish_time":$('#finish_time_modal').val(),
                    "hourly_rate":$('#hourly_rate_modal').val(),
                    "job_total":$('#job_total_modal').val(),
                    "bonus":$('#bonus_modal').val(),
                    "hourly_pay":$('#hourly_pay_modal').val(),
                    "hourly_percent":$('#hourly_percent_modal').val(),
                    "flat_percent":$('#flat_percent_modal').val(),
                    "extra_percent":$('#extra_percent_modal').val(),
                    "packing_percent":$('#packing_percent_modal').val(),
                    "service_percent":$('#service_percent_modal').val(),
                    "non_profit_percent":$('#non_profit_percent_modal').val(),
                    "comment":$('#price_comment_modal').val(),
                    "labor_hours":$('#labor_hours_modal').val(),
                    "travel_time":$('#travel_time_modal').val(),
                    "total_hours":$('#total_hours_modal').val(),
                    "discount":$('#discount_modal').val(),
                    "tips":$('#tips_modal').val(),
                    "employee_id":row.data().employee_id,
                    "job_id":row.data().job_id,
                    "position_id":row.data().position_id,
                    "event_id":$('#event_id').val()
                },
                success:function (result) {
                    console.log(result);
                    drawSelectedEmployee();
                },
                error:function (err) {
                    console.log(err);
                }
            })
            $('#editEmployeeEvent').modal('hide');
        })
    </script>
@endsection



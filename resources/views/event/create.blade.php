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
            /*max-width:1200px;*/
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
        .plus{
            font-size:18px;
            margin-top:5px;
            margin-left:5px;
            font-weight: lighter;
            color:#008000;
            cursor: pointer;
        }

        i.fas.fa-minus{
            margin-left:10px;
            margin-top:5px;
            color:#008000;
            cursor: pointer;
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

        .selected-employee-title{
            margin:50px auto;
            margin-bottom:10px;
            width:fit-content;
        }

    </style>
    <div class="page-content">
        <div class="panel">
            <div class="panel-body container-fluid" >
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        @for($i=0;$i<count($result['job']);$i++)
                            <a class="nav-item nav-link {{$i==0 ? 'active' : ''}}" id="nav-job-{{$i}}" data-toggle="tab" href="#nav-job-panel-{{$i}}" role="tab" aria-selected="true">{{$result['job'][$i]['type']}} - {{$result['job'][$i]['variation']}}</a>
                        @endfor
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    @for($i=0;$i<count($result['job']);$i++)
                        <div class="tab-pane fade {{$i==0 ? 'show active' : ''}}" id="nav-job-panel-{{$i}}" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="section">
                                <h3 class="section-title">Event Common Variables</h3>
                                <form autocomplete="off" method="post" id="event_form-{{$i}}" class="event_form" action="{{url('employee/save')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row" style="margin-left:0;margin-right:0;">
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group" style="">
                                                <div class="label-input">
                                                    <div><label class="form-control-label">pick up address<span class="mandatory">(Mandatory)</span>: </label></div>
                                                    <div>
                                                        <input type="text" class="form-control" id="pick_address-tab-{{$i}}" name="pick_address" placeholder="Pick Up Address" autocomplete="off"/>
                                                    </div>
                                                </div>
                                                <div class="label-input">
                                                    <div><label class="form-control-label">Drop Off Address<span class="mandatory">(Mandatory)</span>: </label></div>
                                                    <div>
                                                        <input type="text" class="form-control" id="drop_address-tab-{{$i}}" name="drop_address" autocomplete="off" placeholder="Drop Off Address"/>
                                                    </div>
                                                </div>
                                                <div class="label-input">
                                                    <input type="number" style="display:none" id="stop_count-tab-{{$i}}" name="stop-count" value="0"/>
                                                    <div><label class="form-control-label">Add A Stop<span id="add-stop-button-tab-{{$i}}" class="plus"><i class="fa fa-plus"></i></span></label></div>
                                                    <div id="stop-holder-tab-{{$i}}">
                                                        <input type="text" class="form-control" id="stop_address-tab-{{$i}}" name="stop_address"
                                                               placeholder="Add A Stop" autocomplete="off" style="visibility: hidden"/>

                                                    </div>
                                                </div>
                                                <div class="label-input">
                                                    <div><label class="form-control-label">Non Profit: </label></div>
                                                    <div>
                                                        <input type="number" class="form-control" id="non_profit-tab-{{$i}}" name="non_profit"
                                                               value="0" autocomplete="off"/>
                                                    </div>
                                                </div>
                                                @if($result['job'][$i]['type']=='Flat')
                                                <div class="label-input">
                                                    <div><label class="form-control-label">Flat: </label></div>
                                                    <div>
                                                        <input type="number" class="form-control" id="flat-tab-{{$i}}" name="flat"
                                                               value="0" autocomplete="off"/>
                                                    </div>
                                                </div>
                                                @else
                                                    <div class="label-input">
                                                        <div><label class="form-control-label">Hourly Rate: </label></div>
                                                        <div>
                                                            <input type="number" class="form-control" id="hourly_rate-tab-{{$i}}" name="hourly_rate"
                                                                   value="0" autocomplete="off"/>
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="label-input">
                                                    <div><label class="form-control-label">Packing</label></div>
                                                    <div>
                                                        <input type="number" class="form-control" id="packing-tab-{{$i}}" name="packing"
                                                               value="0" autocomplete="off"/>
                                                    </div>
                                                </div>
                                                <div class="label-input">
                                                    <div><label class="form-control-label">Service: </label></div>
                                                    <div>
                                                        <input type="number" class="form-control" id="service-tab-{{$i}}" name="service"
                                                               value="0" autocomplete="off"/>
                                                    </div>
                                                </div>
                                                <div class="label-input">
                                                    <div><label class="form-control-label">Extra Amount: </label></div>
                                                    <div>
                                                        <input type="number" class="form-control" id="extra-tab-{{$i}}" name="extra"
                                                               value="0" autocomplete="off"/>
                                                    </div>
                                                </div>

                                                <div class="label-input">
                                                    <div><label class="form-control-label">Job Total: </label></div>
                                                    <div>
                                                        <input type="number" class="form-control" id="job_total-tab-{{$i}}" name="job_total"
                                                               value="0" autocomplete="off" readonly/>
                                                    </div>
                                                </div>

                                                <div class="label-input" style="margin-top:50px">
                                                    <div><label class="form-control-label">Discount, $: </label></div>
                                                    <div>
                                                        <input type="number" class="form-control" id="discount_tab-{{$i}}" name="discount"
                                                               value="0" autocomplete="off"/>
                                                    </div>
                                                </div>
                                                <div class="label-input">
                                                    <div><label class="form-control-label">Tips, $: </label></div>
                                                    <div>
                                                        <input type="number" class="form-control" id="tips_tab-{{$i}}" name="tips"
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
                                                        <textarea class="form-control" id="event_comment-tab-{{$i}}" name="event_comment" rows="5"></textarea>
                                                    </div>
                                                </div>

                                                <div class="label-input" style="margin-top:50px;">
                                                    <div><label class="form-control-label">Start Time<span class="mandatory">(Mandatory)</span>:</label></div>
                                                    <div>
                                                        <input type="text" class="form-control date_time" id="start_time-tab-{{$i}}" name="start_time" placeholder="Start Time" autocomplete="off"/>
                                                    </div>
                                                </div>
                                                <div class="label-input">
                                                    <div><label class="form-control-label">Finish Time<span class="mandatory">(Mandatory)</span>: </label></div>
                                                    <div>
                                                        <input type="text" class="form-control date_time" id="finish_time-tab-{{$i}}" name="finish_time" autocomplete="off" placeholder="Finish Time"/>
                                                    </div>
                                                </div>

                                                <div class="label-input">
                                                    <div><label class="form-control-label">Labor Hours: </label></div>
                                                    <div>
                                                        <input type="number" class="form-control" id="labor_hours-tab-{{$i}}" name="labor_hours"
                                                               value="0" autocomplete="off"/>
                                                    </div>
                                                </div>
                                                <div class="label-input">
                                                    <div><label class="form-control-label">Travel Time</label></div>
                                                    <div>
                                                        <input type="number" class="form-control" id="travel_time-tab-{{$i}}" name="travel_time"
                                                               value="0" autocomplete="off"/>
                                                    </div>
                                                </div>
                                                <div class="label-input">
                                                    <div><label class="form-control-label">Total Hours: </label></div>
                                                    <div>
                                                        <input type="text" class="form-control" id="total_hours-tab-{{$i}}" name="total_hours"
                                                               value="0" autocomplete="off" readonly/>
                                                    </div>
                                                </div>

                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary register-event" id="register_event-tab-{{$i}}" style="margin:auto; display:block;width:150px; border-radius:30px">Submit</button>
                                    <input style="display:none" value="{{$result['job'][$i]['id']}}" id="job_id-tab-{{$i}}" name="job_id"/>
                                    <input style="display:none" value="0" id="event_id-tab-{{$i}}" name="event_id"/>
                                </form>
                            </div>

                            <div class="section">
                                <h3 class="section-title">Employee Setting Parameter</h3>
                                {{--<form autocomplete="off" method="post" id="event_form-{{$i}}" action="{{url('employee/save')}}" enctype="multipart/form-data">--}}
                                    {{--@csrf--}}
                                    <div class="row" style="margin-left:0;margin-right:0;">
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group" style="">
                                                <div class="label-input">
                                                    <div><label class="form-control-label" style="color:black;font-weight:bold">Select Position<span class="mandatory">(Mandatory)</span>:</label></div>
                                                    <div>
                                                        <select class="form-control" style="width:200px" name="position" id="position-tab-{{$i}}" onchange="positionChange({{$i}})" required>
                                                            @for($j=0;$j<count($result['position']);$j++)
                                                                <option value="{{$result['position'][$j]['Id']}}">{{$result['position'][$j]['Name']}}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="label-input">
                                                    <div><label class="form-control-label" style="color:black;font-weight:bold">Select Employee<span class="mandatory">(Mandatory)</span>:</label></div>
                                                    <div>
                                                        <select class="form-control" style="width:200px" name="employee" id="employee-tab-{{$i}}" onchange="employeeChange({{$i}})" required>
                                                            <option value="0"></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="label-input">
                                                    <div><label class="form-control-label" style="margin-top:50px">Employee Pay Comment: </label></div>
                                                    <div>
                                                        <textarea class="form-control" id="employee_pay_comment-tab-{{$i}}" name="event_comment" rows="5"></textarea>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <button type="submit" class="btn btn-primary" style="margin-top:20px;float:right" id="add_employee-tab-{{$i}}" onclick="addEmployee({{$i}})">Add Employee</button>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group" style="">
                                                <div class="label-input">
                                                    <div><label class="form-control-label">Bonus, %: </label></div>
                                                    <div>
                                                        <input type="number" class="form-control" id="bonus-tab-{{$i}}" name="bonus" placeholder="Bonus" value="0" autocomplete="off"/>
                                                    </div>
                                                </div>
                                                <div class="label-input">
                                                    <div><label class="form-control-label">Hourly Pay: </label></div>
                                                    <div>
                                                        <input type="number" class="form-control" id="hourly_pay-tab-{{$i}}" name="hourly_pay" placeholder="Hourly Pay" value="0" autocomplete="off"/>
                                                    </div>
                                                </div>

                                                @if($result['job'][$i]['type']=='Flat')
                                                    <div class="label-input">
                                                        <div><label class="form-control-label">Flat, %: </label></div>
                                                        <div>
                                                            <input type="number" class="form-control" id="flat_percent-tab-{{$i}}" name="flat_percent" placeholder="Flat, %" value="0" autocomplete="off"/>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="label-input">
                                                        <div><label class="form-control-label">Hourly, %: </label></div>
                                                        <div>
                                                            <input type="number" class="form-control" id="hourly_percent-tab-{{$i}}" name="hourly_percent" placeholder="Hourly, %" value="0" autocomplete="off"/>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="label-input">
                                                    <div><label class="form-control-label">Extra, %: </label></div>
                                                    <div>
                                                        <input type="number" class="form-control" id="extra_percent-tab-{{$i}}" name="extra_percent" placeholder="Extra, %" value="0" autocomplete="off"/>
                                                    </div>
                                                </div>
                                                <div class="label-input">
                                                    <div><label class="form-control-label">Packing, %: </label></div>
                                                    <div>
                                                        <input type="number" class="form-control" id="packing_percent-tab-{{$i}}" name="packing_percent" placeholder="Packing, %" value="0" autocomplete="off"/>
                                                    </div>
                                                </div>
                                                <div class="label-input">
                                                    <div><label class="form-control-label">Service, %: </label></div>
                                                    <div>
                                                        <input type="number" class="form-control" id="service_percent-tab-{{$i}}" name="service_percent" placeholder="Service, %" value="0" autocomplete="off"/>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                {{--</form>--}}

                                <h4 class="selected-employee-title">Selected Employees</h4>
                                <div class="table-responsive table">
                                    <table id="selected-employees-tab-{{$i}}" style="width:100%">
                                        <thead class="table-primary">
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Bonus</th>
                                            <th>Hourly Pay</th>
                                            @if($result['job'][$i]['type']=='Hourly')
                                                <th>Hourly, %</th>
                                            @else
                                                <th>Flat, %</th>
                                            @endif
                                            <th>Extra, %</th>
                                            <th>Packing, %</th>
                                            <th>Service, %</th>
                                            <th>Action</th>
                                            <th style="display:none"></th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="modal fade" id="editEmployeeEvent-tab-{{$i}}" aria-hidden="true" aria-labelledby="examplePositionCenter"
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
                                                            <label class="edit-label">Hourly Pay: </label>
                                                            <input type="text" class="edit-input" id="hourly_pay_modal-tab-{{$i}}">
                                                        </div>
                                                        <div class="employee-edit-holder">
                                                            <label class="edit-label">Bonus: </label>
                                                            <input type="text" class="edit-input" id="bonus_modal-tab-{{$i}}">
                                                        </div>
                                                    </div>
                                                    <div class="employee-edit-row">
                                                        @if($result['job'][$i]['type']=='Hourly')
                                                            <div class="employee-edit-holder">
                                                                <label class="edit-label">Hourly, %: </label>
                                                                <input type="text" class="edit-input" id="hourly_percent_modal-tab-{{$i}}">
                                                            </div>
                                                        @else
                                                            <div class="employee-edit-holder" >
                                                                <label class="edit-label">Flat, %: </label>
                                                                <input type="text" class="edit-input" id="flat_percent_modal-tab-{{$i}}">
                                                            </div>
                                                        @endif
                                                        <div class="employee-edit-holder">
                                                            <label class="edit-label">Extra, %: </label>
                                                            <input type="text" class="edit-input" id="extra_percent_modal-tab-{{$i}}">
                                                        </div>
                                                    </div>
                                                    <div class="employee-edit-row">

                                                        <div class="employee-edit-holder" >
                                                            <label class="edit-label">Packing, %: </label>
                                                            <input type="text" class="edit-input" id="packing_percent_modal-tab-{{$i}}">
                                                        </div>
                                                        <div class="employee-edit-holder">
                                                            <label class="edit-label">Service, %: </label>
                                                            <input type="text" class="edit-input" id="service_percent_modal-tab-{{$i}}">
                                                        </div>
                                                    </div>

                                                    <div class="price-comment-holder" >
                                                        <label class="comment-label">Pay Comment: </label>
                                                        <textarea type="text" class="edit-input edit-comment" id="price_comment_modal-tab-{{$i}}" rows="6"></textarea>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer" style="border-top:1px solid #888;padding-top:15px">
                                                <button type="button" class="btn btn-default" data-dismiss="modal" id="modal-close">Close</button>
                                                <button type="button" class="btn btn-primary modal-save" id="modal-save-tab-{{$i}}">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endfor
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
        var table=[];
        var count={{$i}};
        var result=JSON.parse('<?php echo(json_encode($result))?>');
        var selected_tr;

        $(document).ready(function () {
            for (var i=0;i<result['job'].length;i++){
                $('#start_time-tab-'+i).datetimepicker({footer: true, modal: true});
                $('#finish_time-tab-'+i).datetimepicker({footer: true, modal: true});
            }

            for (var i=0;i<result['job'].length;i++){
                table[i]=$('#selected-employees-tab-'+i).DataTable({
                    sort:false,
                    "columnDefs":{
                        "targets": [9],
                        "visible": false
                    }
                });
            }
        });

        $(document).on('click','.plus',function () {
            var id=this.id;
            var job_index=parseInt(id.replace('add-stop-button-tab-',''));
            var count=$('#stop-holder-tab-'+job_index).children().length;
            $('#stop-holder-tab-'+job_index).append('<div class="row" style="margin-left:0 !important;margin-right:0 !important;"><input type="text" class="form-control"  name="stop_address-'+count+'" id="stop_address-tab-'+job_index+'-'+count+'" style="margin-bottom:5px;width:200px !important;" autocomplete="off"/>\n' +
                '<span class="remove-stop"><i class="fas fa-minus"></i></span></div>'
            );
            $('#stop_count-tab-'+job_index).val(count);
        });

        $(document).on('click','.remove-stop',function () {
            var stop_holder=$(this).parents()[1];
            var count=$(stop_holder).children().length;
            var id=stop_holder.id;
            var job_index=parseInt(id.replace('stop-holder-tab-',''));

            var current_id=$(this).parent().children(':first').attr('id');
            var current_index=parseInt(current_id.replace('stop_address-tab-'+job_index+'-',''));
            $(this).parent().remove();
            for (var i=current_index+1;i<count;i++){
                // console.log($('#stop_address-tab-'+job_index+'-'+i)).attr('id');
                console.log('#stop_address-tab-'+job_index+'-'+i);
                $('#stop_address-tab-'+job_index+'-'+i).attr('id','stop_address-tab-'+job_index+'-'+(i-1)).
                attr('name','stop_address-'+(i-1));
            }
            $('#stop_count-tab-'+job_index).val(count-2);
        });

        $(document).on('click','.register-event',function (e) {
            e.preventDefault();
            var id=this.id;
            var job_index=parseInt(id.replace('register_event-tab-',''));
            saveEvent(job_index);
        })

        function saveEvent(job_index) {
            var formData=new FormData($('#event_form-'+job_index)[0]);
            $.ajax({
                url:"{{url('/registerEvent')}}",
                type:"post",
                contentType: false,
                processData: false,
                data:formData,
                dataType:'json',
                async:false,
                success:function (result) {
                    $('#event_id-tab-'+job_index).val(result);
                },
                error:function (err) {
                    console.log(err);
                }
            })

        }

        function positionChange(job_index) {
            var position_index=$('#position'+'-tab-'+job_index).val();

            $('#employee'+'-tab-'+job_index).empty();
            for (var i=0;i<result['employee'][job_index][position_index].length;i++){
                $('#employee'+'-tab-'+job_index).append('<option value="'+result['employee'][job_index][position_index][i]['Id']+'">'+result['employee'][job_index][position_index][i]['Name']+'</option>');
            }
            $('#bonus-tab-'+job_index).val(0);
            $('#hourly_pay-'+job_index).val(0);
            if (result['job'][job_index]['type']=='Hourly')
                $('#hourly_percent-tab-'+job_index).val(0);
            else
                $('#flat_percent-tab-'+job_index).val(0);
            $('#extra_percent-tab-'+job_index).val(0);
            $('#packing_percent-tab-'+job_index).val(0);
            $('#service_percent-tab-'+job_index).val(0);
        }

        function employeeChange(job_index) {
            var position_index=$('#position'+'-tab-'+job_index).val();
            var employee_index=$('#employee'+'-tab-'+job_index).val();
            $('#bonus-tab-'+job_index).val(result['employee'][job_index][position_index][employee_index]['bonus']);
            $('#hourly_pay-tab-'+job_index).val(result['employee'][job_index][position_index][employee_index]['hourly_pay']);
            if (result['job'][job_index]['type']=='Hourly')
                $('#hourly_percent-tab-'+job_index).val(result['employee'][job_index][position_index][employee_index]['hourly_percent']);
            else
               $('#flat_percent-tab-'+job_index).val(result['employee'][job_index][position_index][employee_index]['flat_percent']);

            $('#extra_percent-tab-'+job_index).val(result['employee'][job_index][position_index][employee_index]['extra_percent']);
            $('#packing_percent-tab-'+job_index).val(result['employee'][job_index][position_index][employee_index]['packing_percent']);
            $('#service_percent-tab-'+job_index).val(result['employee'][job_index][position_index][employee_index]['service_percent']);
        }

        function addEmployee(job_index) {
            var selectedEmployees=table[job_index].rows().data();

            var position_index=$('#position'+'-tab-'+job_index).val();
            var employee_index=$('#employee'+'-tab-'+job_index).val();
            if (position_index==0){
                alert("Please select position and employee");
                return;
            }else{
                if (employee_index==0){
                    alert("Please select employee");
                    return;
                }
            }
            var oneEmployee=[];

            oneEmployee[0]=result['employee'][job_index][position_index][employee_index]['Name'];  // Employee Name
            oneEmployee[1]=result['position'][position_index]['Name'];  // Position Name
            oneEmployee[2]=$('#bonus-tab-'+job_index).val();  //bonus
            oneEmployee[3]=$('#hourly_pay-tab-'+job_index).val();  //hourly pay
            if (result['job'][job_index]['type']!='Hourly'){
                oneEmployee[4]=$('#flat_percent-tab-'+job_index).val();  //bonus
            }
            else
                oneEmployee[4]=$('#hourly_percent-tab-'+job_index).val();  //bonus
            oneEmployee[5]=$('#extra_percent-tab-'+job_index).val();  //bonus
            oneEmployee[6]=$('#packing_percent-tab-'+job_index).val();  //bonus
            oneEmployee[7]=$('#service_percent-tab-'+job_index).val();  //bonus
            oneEmployee[8]='<button type="button" class="btn btn-floating btn-success btn-sm edit" style="width:30px;height:30px" onclick="editEmployee('+job_index+',this)"><i class="icon wb-pencil" aria-hidden="true"></i></button>'+
                '<button type="button" class="btn btn-floating btn-danger btn-sm remove" style="width:30px;height:30px" onclick="deleteEmployee('+job_index+','+'this)"><i class="icon fa-trash" aria-hidden="true"></i></button>';
            oneEmployee[9]=$('#employee_pay_comment-tab-'+job_index).val();

            for (var i=0;i<selectedEmployees.length;i++){
                if (selectedEmployees[i][1]==oneEmployee[1] && selectedEmployees[i][2]==oneEmployee[2]){
                    alert("Same Employee and position already exist. Please edit")
                    return;
                }
            }
            addEmployeeToEvent(job_index,oneEmployee);
            table[job_index].row.add(oneEmployee).draw();
        }

        function addEmployeeToEvent(job_index,employee_data) {
            var event_id=$('#event_id-tab-'+job_index).val();
            if (event_id==0){
                saveEvent(job_index);
                event_id=$('#event_id-tab-'+job_index).val();
            }

            $.ajax({
                method:'post',
                url:"{{url('addEmployeeToEvent')}}",
                data:{
                    job_id:$('#job_id-tab-'+job_index).val(),
                    event_id:event_id,
                    employee_data:employee_data
                },
                success:function (result) {
                    console.log(result);
                },
                error:function (err) {
                    console.log(err);
                }
            })
        }

        function deleteEmployee(job_index,btn){
            var event_id=$('#event_id-tab-'+job_index).val();
            var tr = $(btn).closest('tr');
            var row=table[job_index].row(tr);
            var data=row.data();
            $.ajax({
                method: 'post',
                url: "{{url('deleteEmployeeEvent')}}",
                data: {
                    event_id: event_id,
                    employee_data: data
                },
                success: function (result) {
                    console.log(result);
                },
                error: function (err) {
                    console.log(err);
                }
            });
            table[job_index].row(tr).remove().draw();
        }

        function editEmployee(job_index, btn){
            var tr = $(btn).closest('tr');
            selected_tr=tr;
            var row=table[job_index].row(tr);
            var data=row.data();
            $('#editEmployeeEvent-tab-'+job_index).modal('show');
            $('#bonus_modal-tab-'+job_index).val(data[2]);
            $('#hourly_pay_modal-tab-'+job_index).val(data[3]);
            if (result['job'][job_index]['type']=="Hourly")
                $('#hourly_percent_modal-tab-'+job_index).val(data[4]);
            else
                $('#flat_percent_modal-tab-'+job_index).val(data[4]);
            $('#extra_percent_modal-tab-'+job_index).val(data[5]);
            $('#packing_percent_modal-tab-'+job_index).val(data[6]);
            $('#service_percent_modal-tab-'+job_index).val(data[7]);
            $('#price_comment_modal-tab-'+job_index).val(data[9]);
        }

        $(document).on('click','.modal-save',function () {
            var id=this.id;
            var job_index=parseInt(id.replace('modal-save-tab-',''));
            var row = table[job_index].row(selected_tr);
            var data=row.data();

            data[2]=$('#bonus_modal-tab-'+job_index).val();
            data[3]=$('#hourly_pay_modal-tab-'+job_index).val();
            if (result['job'][job_index]['type']=="Hourly")
                data[4]=$('#hourly_percent_modal-tab-'+job_index).val();
            else
                data[4]=$('#flat_percent_modal-tab-'+job_index).val();
            data[5]=$('#extra_percent_modal-tab-'+job_index).val();
            data[6]=$('#packing_percent_modal-tab-'+job_index).val();
            data[7]=$('#service_percent_modal-tab-'+job_index).val();
            data[9]=$('#price_comment_modal-tab-'+job_index).val();
            table[job_index]
                .row(selected_tr)
                .data( data )
                .draw();

            addEmployeeToEvent(job_index,data);
            $('#editEmployeeEvent-tab-'+job_index).modal('hide');

        });

        $('form input').on('change', function (e) {
                var form=$(this).parents('form');
                var form_id=form.attr('id');
                var job_index=parseInt(form_id.replace('event_form-',''));
                caclulateTotalHour(job_index,$(this));
        });
        // $('form input').on('keypress', function (e) {
        //     var form=$(this).parents('form');
        //     var form_id=form.attr('id');
        //     var job_index=parseInt(form_id.replace('event_form-',''));
        //     caclulateTotalHour(job_index,$(this));
        // })



        function caclulateTotalHour(job_index,$element) {
            var labor_hours,travel_time,total_hours,non_profit,hourly_rate,packing,flat,packing,service,extra_amount,job_total;
            var discount, tips;
            if ($('#labor_hours-tab-'+job_index).val()==null)
                labor_hours=0;
            else
                labor_hours=parseFloat($('#labor_hours-tab-'+job_index).val());
            if ($('#travel_time-tab-'+job_index).val()==null)
                travel_time=0;
            else
                travel_time=parseFloat($('#travel_time-tab-'+job_index).val());
            total_hours=labor_hours+travel_time;
            $('#total_hours-tab-'+job_index).val(total_hours);

            if ($('#non_profit-tab-'+job_index).val()==null)
                non_profit=0;
            else
                non_profit=parseFloat($('#non_profit-tab-'+job_index).val());

            if ($('#packing-tab-'+job_index).val()==null)
                packing=0;
            else
                packing=parseFloat($('#packing-tab-'+job_index).val());

            if ($('#service-tab-'+job_index).val()==null)
                service=0;
            else
                service=parseFloat($('#service-tab-'+job_index).val());

            if ($('#extra-tab-'+job_index).val()==null)
                extra_amount=0;
            else
                extra_amount=parseFloat($('#extra-tab-'+job_index).val());

            if ($('#discount-tab-'+job_index).val()==null)
                discount=0;
            else
                discount=parseFloat($('#discount-tab-'+job_index).val());

            if ($('#tips-tab-'+job_index).val()==null)
                tips=0;
            else
                tips=parseFloat($('#tips-tab-'+job_index).val());

            job_total=non_profit+packing+service+extra_amount;

            if (result['job'][job_index]['type']=="Hourly"){
                if ($('#hourly_rate-tab-'+job_index).val()==null)
                    hourly_rate=0;
                else
                    hourly_rate=parseFloat($('#hourly_rate-tab-'+job_index).val());
                job_total+=hourly_rate*total_hours;
            }else{
                if ($('#flat-tab-'+job_index).val()==null)
                    flat=0;
                else
                    flat=parseFloat($('#flat-tab-'+job_index).val());
                job_total+=flat;
            }

            $('#job_total-tab-'+job_index).val(job_total);
















        }


















    </script>
@endsection



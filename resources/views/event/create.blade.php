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
    <link rel="stylesheet" href="{{asset('css/event.css')}}">
    <div class="page-content">
        <div class="panel">
            <div class="panel-body container-fluid" >
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        @for($i=0;$i<count($result['job']);$i++)
                            <a class="nav-item nav-link {{$i==0 ? 'active' : ''}}" id="nav-job-{{$i}}" data-toggle="tab" href="#nav-job-panel-{{$i}}" role="tab" aria-selected="true">{{$result['job'][$i]['type']}} {{!is_null($result['job'][$i]['variation'])?'-':''}} {{$result['job'][$i]['variation']}}</a>
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
                                                        <input type="number" class="form-control" id="tips-tab-{{$i}}" name="tips"
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
                                                    <div><label class="form-control-label">Bonus, $: </label></div>
                                                    <div>
                                                        <input type="number" class="form-control" id="bonus-tab-{{$i}}" name="bonus" placeholder="Bonus" value="0" autocomplete="off" />
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
                                                        <div><label class="form-control-label">Flat: </label></div>
                                                        <div>
                                                            <input type="number" class="form-control" id="flat_percent-tab-{{$i}}" name="flat_percent" placeholder="Flat, %" value="0" autocomplete="off"/>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="label-input">
                                                        <div><label class="form-control-label">Hourly Rate</label></div>
                                                        <div>
                                                            <input type="number" class="form-control" id="hourly_percent-tab-{{$i}}" name="hourly_percent" placeholder="Hourly, %" value="0" autocomplete="off"/>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="label-input">
                                                    <div><label class="form-control-label">Extra: </label></div>
                                                    <div>
                                                        <input type="number" class="form-control" id="extra_percent-tab-{{$i}}" name="extra_percent" placeholder="Extra, %" value="0" autocomplete="off"/>
                                                    </div>
                                                </div>
                                                <div class="label-input">
                                                    <div><label class="form-control-label">Packing: </label></div>
                                                    <div>
                                                        <input type="number" class="form-control" id="packing_percent-tab-{{$i}}" name="packing_percent" placeholder="Packing, %" value="0" autocomplete="off"/>
                                                    </div>
                                                </div>
                                                <div class="label-input">
                                                    <div><label class="form-control-label">Service</label></div>
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
                                                <th>Hourly</th>
                                            @else
                                                <th>Flat</th>
                                            @endif
                                            <th>Extra</th>
                                            <th>Packing</th>
                                            <th>Service</th>
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
                                                                <label class="edit-label">Hourly</label>
                                                                <input type="text" class="edit-input" id="hourly_percent_modal-tab-{{$i}}">
                                                            </div>
                                                        @else
                                                            <div class="employee-edit-holder" >
                                                                <label class="edit-label">Flat</label>
                                                                <input type="text" class="edit-input" id="flat_percent_modal-tab-{{$i}}">
                                                            </div>
                                                        @endif
                                                        <div class="employee-edit-holder">
                                                            <label class="edit-label">Extra</label>
                                                            <input type="text" class="edit-input" id="extra_percent_modal-tab-{{$i}}">
                                                        </div>
                                                    </div>
                                                    <div class="employee-edit-row">
                                                        <div class="employee-edit-holder" >
                                                            <label class="edit-label">Packing</label>
                                                            <input type="text" class="edit-input" id="packing_percent_modal-tab-{{$i}}">
                                                        </div>
                                                        <div class="employee-edit-holder">
                                                            <label class="edit-label">Service</label>
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
    <script src="{{asset('js/event.js')}}"></script>
    <script>
        var table=[];
        var count=parseInt("{{$i}}");
        var result=JSON.parse('<?php echo(json_encode($result))?>');
        var selected_tr;
        var bonus=0;


    </script>
@endsection



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

    <link rel="stylesheet" href="{{asset('css/report.css')}}">
@endsection
@section('page-content')
    <div class="page-content">
        <div class="panel">
            <div class="panel-body container-fluid" >
                <div class="section">
                    <h3 class="section-title">Reporting</h3>
                    <div class="row" id="Selection-holder">
                        <div>
                            <h4>Date Range</h4>
                            <div class="row" id="report-time-holder">
                                <div>
                                    <input type="text" class="form-control date_time" id="start_date" name="start_date" placeholder="Start Date" autocomplete="off"/>
                                </div>
                                <div>
                                    <input type="text" class="form-control date_time" id="end_date" name="end_date" placeholder="End Date" autocomplete="off"/>
                                </div>
                            </div>
                        </div>
                        <div style="margin-left:-40px">
                            <h4>Select Employee</h4>
                            <select class="form-control" style="width:200px" id="employee_id">
                                @for($i=0;$i<count($result['employee']);$i++)
                                    <option value="{{$result['employee'][$i]['id']}}">{{$result['employee'][$i]['name']}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>


                    <div id="table-holder" class="table-responsive">
                        <table class="display" id="reportTable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Employee Name</th>
                                    <th>Position</th>
                                    <th>Total Hours</th>
                                    <th>Hourly Pay</th>
                                    <th>Bonus</th>
                                    <th>Hourly</th>
                                    <th>Flat</th>
                                    <th>Job Type</th>
                                    <th>Extra</th>
                                    <th>Packing</th>
                                    <th>Service</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            {{--@for($i=0;$i<count($result);$i++)--}}
                                {{--<tr>--}}
                                    {{--<td style="display:none">{{$result[$i]['id']}}</td>--}}
                                    {{--<td>{{$result[$i]['customer']}}</td>--}}
                                    {{--<td>{{$result[$i]['pick_address']}}</td>--}}
                                    {{--<td>{{$result[$i]['drop_address']}}</td>--}}
                                    {{--<td>{{$result[$i]['stop_address']}}</td>--}}
                                    {{--<td>{{$result[$i]['employee_numbers']}}</td>--}}
                                    {{--<td>{{$result[$i]['truck_license']}}</td>--}}
                                    {{--<td>{{$result[$i]['job_type']}}</td>--}}
                                    {{--<td>{{$result[$i]['job_total']}}</td>--}}
                                    {{--@if($result[$i]['state']=='open')--}}
                                        {{--<td class="state-open">{{$result[$i]['state']}}</td>--}}
                                    {{--@else--}}
                                        {{--<td class="state-closed">{{$result[$i]['state']}}</td>--}}
                                    {{--@endif--}}
                                    {{--<td style="width:60px">--}}
                                        {{--<a href="{{url('/event/edit/'.$result[$i]['id'])}}"><button type="button" class="btn btn-floating btn-success btn-sm edit" style="width:25px;height:25px; display:inline"><i class="icon wb-pencil" aria-hidden="true"></i></button></a>--}}
                                        {{--<a href="{{url('/event/delete/'.$result[$i]['id'])}}"><button type="button" class="btn btn-floating btn-danger btn-sm remove" style="width:25px;height:25px; display:inline; margin-left:5px"><i class="icon fa-trash" aria-hidden="true"></i></button></a>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                            {{--@endfor--}}

                            </tbody>
                        </table>

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
    <script src="{{asset('js/report.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#employeeTableList').dataTable({
                "ordering":false,
            });
        })
    </script>
@endsection

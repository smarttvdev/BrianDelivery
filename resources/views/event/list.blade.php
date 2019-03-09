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
            max-width:1400px;
            border:1px solid #aaa;
            margin-top:20px;
            padding-bottom:30px;
            padding-left:20px;
            padding-right:20px;
        }
        .section-title{
            margin:auto;
            width:fit-content;
            margin-top:30px !important;
            margin-bottom:30px;

        }

        td, th{
            text-align: center;
        }

      section{
          padding-left:20px;
          padding-right:20px;
      }






    </style>
    <div class="page-content">
        <div class="panel">
            <div class="panel-body container-fluid" >
                <div class="section">
                    <h3 class="section-title">All Events</h3>
                    <div id="table-holder" class="table-responsive">
                        <table class="display" id="employeeTableList" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="display:none"></th>
                                    <th>Pick Address</th>
                                    <th>Drop Address</th>
                                    <th>Stop Address</th>
                                    <th>Employee Numbers</th>
                                    <th>Truck License</th>
                                    <th>Job Type</th>
                                    <th>Job Total</th>
                                    <th>State</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @for($i=0;$i<count($result);$i++)
                                <tr>
                                    <td style="display:none">{{$result[$i]['id']}}</td>
                                    <td>{{$result[$i]['pick_address']}}</td>
                                    <td>{{$result[$i]['drop_address']}}</td>
                                    <td>{{$result[$i]['stop_address']}}</td>
                                    <td>{{$result[$i]['employee_numbers']}}</td>
                                    <td>{{$result[$i]['truck_license']}}</td>
                                    <td>{{$result[$i]['job_type']}}</td>
                                    <td>{{$result[$i]['job_total']}}</td>
                                    <td>{{$result[$i]['state']}}</td>
                                    <td style="width:60px">
                                        <a href="{{url('/event/edit/'.$result[$i]['id'])}}"><button type="button" class="btn btn-floating btn-success btn-sm edit" style="width:25px;height:25px; display:inline"><i class="icon wb-pencil" aria-hidden="true"></i></button></a>
                                        <a href="{{url('/event/delete/'.$result[$i]['id'])}}"><button type="button" class="btn btn-floating btn-danger btn-sm remove" style="width:25px;height:25px; display:inline; margin-left:5px"><i class="icon fa-trash" aria-hidden="true"></i></button></a>
                                    </td>
                                </tr>
                            @endfor

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

    <script>
        $(document).ready(function () {
            $('#employeeTableList').dataTable({
                "ordering":false,


            });

        })
    </script>

@endsection



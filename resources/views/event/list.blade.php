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
            font-size:40px;

        }

        td, th{
            text-align: center;
        }

        table tbody tr td:nth-child(8){
            width:60px;
        }

      section{
          padding-left:20px;
          padding-right:20px;
      }
        td.state-open{
            background:#ffeeba !important;
        }
        td.state-closed{
            background:#c3e6cb;
        }
        #report-time-holder{
            margin-left:0;
            margin-bottom:30px;
            margin-top:-5px;
        }
        #report-time-holder div{
            margin-right:10px;
        }

    </style>
    <div class="page-content">
        <div class="panel">
            <div class="panel-body container-fluid" >
                <div class="section">
                    <h3 class="section-title">Events</h3>
                    <h4 style="margin-top:30px">Event Move Date Range</h4>
                    <div class="row" id="report-time-holder">
                        <div>
                            <input type="text" class="form-control date_time" id="start_date" name="start_date" placeholder="Start Date" autocomplete="off"/>
                        </div>
                        <div>
                            <input type="text" class="form-control date_time" id="end_date" name="end_date" placeholder="End Date" autocomplete="off"/>
                        </div>
                    </div>
                    <div id="table-holder" class="table-responsive">
                        <table class="display" id="employeeTableList" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Pick Address</th>
                                    <th>Drop Address</th>
                                    <th>Stop Address</th>
                                    <th>Employee Numbers</th>
                                    <th>Move Date</th>
                                    <th>Job Type</th>
                                    <th>Move Date</th>
                                    <th>State</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @for($i=0;$i<count($result);$i++)
                                <tr>
                                    <td>{{$result[$i]['customer']}}</td>
                                    <td>{{$result[$i]['pick_address']}}</td>
                                    <td>{{$result[$i]['drop_address']}}</td>
                                    <td>{{$result[$i]['stop_address']}}</td>
                                    <td>{{$result[$i]['employee_numbers']}}</td>
                                    <td>{{$result[$i]['move_date']}}</td>
                                    <td>{{$result[$i]['job_type']}}</td>
                                    <td>{{$result[$i]['job_total']}}</td>
                                    @if($result[$i]['state']=='open')
                                        <td class="state-open">{{$result[$i]['state']}}</td>
                                    @else
                                        <td class="state-closed">{{$result[$i]['state']}}</td>
                                    @endif
                                    <td style="width:90px">
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
    <script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <script>
       var event_list_table;
        $(document).ready(function () {
            event_list_table=$('#employeeTableList').DataTable({
                "ordering":false,
            });

            $('#start_date').datepicker({
                uiLibrary: 'bootstrap4',
                iconsLibrary: 'fontawesome',
                maxDate: function () {
                    return $('#end_date').val();
                },
            });
            $('#end_date').datepicker({
                uiLibrary: 'bootstrap4',
                iconsLibrary: 'fontawesome',
                minDate: function () {
                    return $('#start_date').val();
                },
            });
        })
        $('#start_date').change(function () {
            updateEventListTable();
        })
        $('#end_date').change(function () {
            updateEventListTable();
        })

        function updateEventListTable() {
            var start_date=$('#start_date').val();
            var end_date=$('#end_date').val();
            $.ajax({
                "method":"post",
                url:`${site_url}/event/updateList`,
                data:{
                    start_date:start_date,
                    end_date:end_date,
                },
                success:function (result) {
                    event_list_table.clear().draw();
                    var data=JSON.parse(result);
                    console.log(data);
                    for (var i=0;i<data.length;i++){
                        var row=[];
                        row[0]=data[i]['customer'];
                        row[1]=data[i]['pick_address'];
                        row[2]=data[i]['drop_address'];
                        row[3]=data[i]['stop_address'];
                        row[4]=data[i]['employee_numbers'];
                        row[5]=data[i]['move_date'];
                        row[6]=data[i]['job_type'];
                        row[7]=data[i]['job_total'];
                        row[8]=data[i]['state'];;
                        row[9]=`<a href="${site_url}/event/edit/${data[i]['id']}"><button type="button" class="btn btn-floating btn-success btn-sm edit" style="width:25px;height:25px; display:inline"><i class="icon wb-pencil" aria-hidden="true"></i></button></a>
                                <a href="${site_url}/event/delete/${data[i]['id']}"><button type="button" class="btn btn-floating btn-danger btn-sm remove" style="width:25px;height:25px; display:inline; margin-left:5px"><i class="icon fa-trash" aria-hidden="true"></i></button></a>`;
                        event_list_table.row.add(row).draw();
                        if (data[i]['state']=='open')
                            $('#employeeTableList tbody tr:last td:eq(8)').attr('class','state-open');
                        else
                            $('#employeeTableList tbody tr:last td:eq(8)').attr('class','state-close');
                        $('#employeeTableList tbody tr:last td:eq(9)').css('width','90px')

                    }
                },
                error:function (err) {
                    console.log(err);
                }
            })
        }
    </script>
@endsection

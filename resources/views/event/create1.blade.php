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
                                                    <input type="number" style="display:none" id="stop-count" name="stop-count" value="0"/>
                                                    <div><label class="form-control-label">Add A Stop<span id="add-stop-button" class="plus"><i class="fa fa-plus"></i></span></label></div>
                                                    <div id="stop-holder">
                                                        <input type="text" class="form-control" id="stop_address" name="stop_address"
                                                               placeholder="Add A Stop" autocomplete="off" style="visibility: hidden"/>

                                                    </div>
                                                </div>
                                                <div class="label-input">
                                                    <div><label class="form-control-label">Non Profit: </label></div>
                                                    <div>
                                                        <input type="number" class="form-control" id="stop" name="non_profit"
                                                               value="0" autocomplete="off"/>
                                                    </div>
                                                </div>
                                                @if($result['job'][$i]['type']=='Flat')
                                                <div class="label-input">
                                                    <div><label class="form-control-label">Flat: </label></div>
                                                    <div>
                                                        <input type="number" class="form-control" id="flat" name="flat"
                                                               value="0" autocomplete="off"/>
                                                    </div>
                                                </div>
                                                @else
                                                    <div class="label-input">
                                                        <div><label class="form-control-label">Hourly Rate: </label></div>
                                                        <div>
                                                            <input type="number" class="form-control" id="flat" name="hourly_rate"
                                                                   value="0" autocomplete="off"/>
                                                        </div>
                                                    </div>
                                                @endif

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

                                                <div class="label-input">
                                                    <div><label class="form-control-label">Job Total: </label></div>
                                                    <div>
                                                        <input type="number" class="form-control" id="job_total" name="job_total"
                                                               value="0" autocomplete="off"/>
                                                    </div>
                                                </div>

                                                <div class="label-input" style="margin-top:50px">
                                                    <div><label class="form-control-label">Discount, $: </label></div>
                                                    <div>
                                                        <input type="number" class="form-control" id="discount" name="discount"
                                                               value="0" autocomplete="off"/>
                                                    </div>
                                                </div>
                                                <div class="label-input">
                                                    <div><label class="form-control-label">Tips, $: </label></div>
                                                    <div>
                                                        <input type="number" class="form-control" id="tips" name="tips"
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

                                                <div class="label-input" style="margin-top:50px;">
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

                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--<button type="submit" class="btn btn-primary" id="register_event" style="margin:auto; display:block;width:150px; border-radius:30px">Submit</button>--}}
                                    <input type="hidden" id="event_id" value="0" name="event_id">
                                </form>
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

        $('#add-stop-button').click(function () {
            var count=$('#stop-holder').children().length;
            $('#stop-holder').append('<div class="row" style="margin-left:0 !important;margin-right:0 !important;"><input type="text" class="form-control"  name="stop_address'+count+'" style="margin-bottom:5px;width:200px !important;" placeholder="Stop'+count+'" autocomplete="off"/>\n' +
                '<span class="remove-stop"><i class="fas fa-minus"></i></span></div>'
            );
            $('#stop-count').val(count);

        });


        $(document).on('click','.remove-stop',function () {
            $(this).parent().remove();
            var count=$('#stop-holder').children().length;
            $('#stop-count').val(count-1);
        })







    </script>
@endsection



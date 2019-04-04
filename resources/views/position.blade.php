@extends('layouts.template')

@section('page-content')
    <div class="page-content container-fluid">
        <div class="js-grid-holder">
            <h3 class="table-title">Positions</h3>
            <div id="jsGrid" class="table-content"></div>
        </div>
    </div>
@endsection

@section('insert-js')

    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            'use strict';
            $("#jsGrid").jsGrid({
                width: "100%",
                height: "600px",
                editing: true,
                deleting: true,
                inserting: true,
                sorting: false,
                paging: true,
                filtering:false,
                pageSize: 10,
                pageButtonCount: 5,
                autoload: true,
                controller: {
                    loadData: function (filter) {
                        return $.ajax({
                            method: "GET",
                            url: "{{url('/getPositions')}}",
                        }).done(function (result) {
                            // console.log(result)
                        })
                    },

                    insertItem:function(item){
                        return $.ajax({
                            method: "post",
                            url: "{{url('/insertPosition')}}",
                            data: item,

                        }).done(function (result) {
                            console.log(result)
                        });
                    },
                    updateItem:function (item) {
                        return $.ajax({
                            method: "post",
                            url: "{{url('/updatePosition')}}",
                            data: item,
                        }).done(function (result) {
                            // console.log(result);
                        });
                    },
                    deleteItem:function (item) {
                        return $.ajax({
                            method: "post",
                            url: "{{url('/deletePosition')}}",
                            data: item,
                        }).done(function (result) {
                            // console.log(result);
                        });
                    }
                },

                fields: [
                    { name:"ID" ,type: "hidden", css: 'hide'},
                    { name: "name", type: "text", width: 150, validate: "required",title:"Position Name",css:"text-center",align: "center" ,filtering:true},
                    { name: "bonus", type: "number", width: 100, validate: "required",title:"Bonus Points",css:"text-center",align: "center" ,filtering:true},
                    {
                        type: "control",width:30
                    }
                ]
            });
        })
    </script>

@endsection



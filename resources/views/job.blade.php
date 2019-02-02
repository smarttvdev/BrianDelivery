@extends('layouts.template')

@section('page-content')
    <div class="page-content container-fluid">
        <div class="js-grid-holder">
            <h3 class="table-title">Jobs</h3>
            <div id="jsGrid" class="table-content"></div>
        </div>
    </div>
@endsection

@section('insert-js')

    <script>
        $(function () {
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
                            url: "{{url('/getJobs')}}",
                        }).done(function (result) {
                            // console.log(result)
                        })
                    },

                    insertItem:function(item){
                        return $.ajax({
                            method: "post",
                            url: "{{url('/insertJob')}}",
                            data: item,

                        }).done(function (result) {
                            // item['ID']=result;
                        });
                    },
                    updateItem:function (item) {
                        return $.ajax({
                            method: "post",
                            url: "{{url('/updateJob')}}",
                            data: item,
                        }).done(function (result) {
                            // console.log(result);
                        });
                    },
                    deleteItem:function (item) {
                        return $.ajax({
                            method: "post",
                            url: "{{url('/deleteJob')}}",
                            data: item,
                        }).done(function (result) {
                            // console.log(result);
                        });
                    }
                },

                fields: [
                    { name:"ID" ,type: "hidden", css: 'hide'},
                    { name: "category", type: "select", width: 150, validate: "required",title:'Job Type',css:"text-center",
                        items: [
                            { Name: null, Id: 0 },
                            { Name: "Hourly", Id:1},
                            { Name: "Flat", Id: 2},

                        ],
                        valueField: "Id",
                        textField: "Name",
                        filtering:true,
                    },

                    { name: "name", type: "text", width: 150, validate: "required",title:"Job Name",css:"text-center",align: "center" ,filtering:true},
                    { name: "pay_amount", type: "number", width: 100, css:"text-center",title:"$, Rate",align: "center",value:"0"},
                    { name: "bonus", type: "number", width: 100, css:"text-center",title:"%, Bonus",align: "center",value:"0"},
                    { name: "extra", type: "number", width: 100, css:"text-center",title:"%, Extra Flat",align: "center",value:"0"},
                    { name: "packing", type: "number", width: 100, css:"text-center",title:"%, Packing",align: "center",value:"0"},
                    { name: "service", type: "number", width: 100, css:"text-center",title:"%, Service",align: "center",value:"0"},

                    {
                        type: "control",width:50
                    }
                ]
            });
        })
    </script>

@endsection



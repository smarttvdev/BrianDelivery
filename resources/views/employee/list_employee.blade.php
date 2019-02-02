@extends('layouts.template')

@section('page-content')
    <div class="page-content container-fluid">
        <div class="js-grid-holder" style="width:90%">
            <form id="search_id" action="" method="post">
                <input type="select" name="search_method">
            </form>
            <h3 class="table-title">Employee Lists</h3>
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
                editing: false,
                deleting: false,
                inserting: false,
                sorting: false,
                paging: true,
                filtering:true,
                pageSize: 10,
                pageButtonCount: 5,
                autoload: true,
                controller: {
                    loadData: function (filter) {
                        return $.ajax({
                            method: "GET",
                            url: "{{url('/getEmployeeList')}}",
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
                            url: "{{url('/deleteEmployee')}}",
                            data: item,
                        }).done(function (result) {
                            // console.log(result);
                        });
                    }
                },

                fields: [
                    { name:"ID" ,type: "hidden", css: 'hide'},
                    {
                        width: 100, title:"EDIT",css:"text-center",align: "center",
                        itemTemplate: function(value, item) {
                            var $text = $("<p>").text(item.MyField);
                            var $link = $("<a>").attr("href", "{{url('employee/edit/')}}"+"/"+item.ID).text("Edit").attr("class",'btn btn-primary').css('width','100px').css('margin-top','-15px');
                            return $("<div>").append($text).append($link);
                        }
                    },
                    { name: "name", type: "text", width: 150, validate: "required",title:"Name",css:"text-center",align: "center" ,filtering:true},
                    { name: "employeement_date", type: "text", width: 150, validate: "required",title:"Start Date",css:"text-center",align: "center" ,filtering:false},
                    {
                        width: 100, validate: "required",title:"Terminate Employeement",css:"text-center",align: "center",
                        itemTemplate: function(_, item) {
                            var grid = this._grid;
                            return $("<button>").text("Termiate").attr('class','btn btn-warning')
                                .on("click", function() {
                                    console.log(grid);
                                    grid.option("fields")[3].insertControl.val("43434");
                                    item.employeement_date="dfdf";
                            });
                        }
                    },
                    {
                        name: "state", width: 100, validate: "required",title:"State",css:"text-center",align: "center",
                        itemTemplate:function (_,item) {
                            if (item.state=='active'){
                                return $("<div>").text("Active").attr('class','btn btn-success').css('border','none')
                                    .on("click", function() {
                                        console.log(item.state);

                                     });
                            } else{
                                return $("<div>").text("InActive").attr('class','btn btn-danger').css('border','none')
                                    .on("click", function() {

                                 });

                            }



                        }
                    },
                    { name: "bonus", type: "number", width: 100, validate: "required",title:"Bonus",css:"text-center",align: "center" ,filtering:false},
                    { name: "penalty", type: "number", width: 100, validate: "required",title:"Penalty",css:"text-center",align: "center" ,filtering:false},
                    { name: "reimbursment", type: "number", width: 100, validate: "required",title:"Reimbursment",css:"text-center",align: "center" ,filtering:false},

                    {
                        type: "control",width:50,
                        editButton: false,
                        clearFilterButton: true,
                        filtering: false,
                        headerTemplate: function() {
                            return this._createOnOffSwitchButton("filtering", this.searchModeButtonClass, false);
                        }
                    }
                ]
            });
            $("#jsGrid").jsGrid("option", "filtering", false);
        })
    </script>


@endsection



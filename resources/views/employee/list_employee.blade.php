@extends('layouts.template')

@section('page-content')
    <style>
        .btn{
            width:80px;
        }
    </style>
    <div class="page-content container-fluid">
        <div class="js-grid-holder" style="width:90%">
            <h3 class="table-title">Employee Lists</h3>
            <form id="search_form" action="{{url('getEmployeeList')}}" method="post" >
                @csrf
                <div class="row" style="margin-left:0">
                    <div>
                        <select name="search_by" type="text" placeholder="Search By"  style="margin-top:0px;height:32px;margin-right:0">
                            <option value="">Search By</option>
                            <option value="name">Name</option>
                            <option value="pay roll">Pay Roll</option>
                            <option value="position">Position</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" name="key_word" placeholder="Search..." id="key_word">
                                <span class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="icon wb-search" aria-hidden="true"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div id="jsGrid" class="table-content"></div>
        </div>
    </div>
@endsection

@section('insert-js')
    <script>
        function load_grid(){
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
                        var formData=new FormData($('#search_form')[0]);
                        return $.ajax({
                            method: "post",
                            url: "{{url('/getEmployeeList')}}",
                            data: formData,
                            async:false,
                            contentType: false,
                            processData: false,
                            dataType:'json',
                        }).done(function (result) {
                            console.log(result)
                        }).fail(function (result) {
                            console.log(result);

                        })
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
                    // {
                    //     width: 100, validate: "required",title:"Terminate Employeement",css:"text-center",align: "center",
                    //     itemTemplate: function(_, item) {
                    //         var grid = this._grid;
                    //         return $("<button>").text("Termiate").attr('class','btn btn-warning')
                    //             .on("click", function() {
                    //                 console.log(grid);
                    //                 grid.option("fields")[3].insertControl.val("43434");
                    //                 item.employeement_date="dfdf";
                    //         });
                    //     }
                    // },
                    {
                        name: "state", width: 100, validate: "required",title:"State",css:"text-center",align: "center",
                        itemTemplate:function (_,item) {
                            if (item.state=='active'){
                                return $("<div>").text("Active").attr('class','btn btn-success').css('border','none')
                                    .on("click", function() {
                                        console.log(item);
                                        $(this).attr('class',"btn btn-danger");
                                        $(this).text('InActive');
                                        $.ajax({
                                            "method":"post",
                                            "url":`${site_url}/employee/update_state`,
                                            "data":item,
                                            success:function (result) {
                                                console.log(result);
                                            },
                                            error:function (err) {
                                                console.log(err);

                                            }
                                        })

                                    });
                            } else{
                                return $("<div>").text("InActive").attr('class','btn btn-danger').css('border','none')
                                    .on("click", function() {
                                        $(this).attr('class',"btn btn-success");
                                        $(this).text('Active');
                                        $.ajax({
                                            "method":"post",
                                            "url":`${site_url}/employee/update_state`,
                                            "data":item,
                                            success:function (result) {
                                                console.log(result);
                                            },
                                            error:function (err) {
                                                console.log(err);

                                            }
                                        })

                                    });

                            }
                        }
                    },
                    // { name: "bonus", type: "number", width: 100, validate: "required",title:"Bonus",css:"text-center",align: "center" ,filtering:false},
                    // { name: "penalty", type: "number", width: 100, validate: "required",title:"Penalty",css:"text-center",align: "center" ,filtering:false},
                    // { name: "reimbursment", type: "number", width: 100, validate: "required",title:"Reimbursment",css:"text-center",align: "center" ,filtering:false},

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

        }
        $(function () {
            load_grid();
        })
    </script>
    
    <script>
        $('#search_form').submit(function (e) {
            e.preventDefault();
            load_grid();
        })

        $('#key_word').change(function () {
            console.log($('#key_word').val());
        })
    </script>

@endsection



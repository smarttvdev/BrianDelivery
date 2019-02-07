@extends('layouts.template')

@section('page-content')
    <div class="page-content">
        <div class="panel">
            <div class="panel-body container-fluid" style="height:1500px;">
                <form autocomplete="off" method="post" id="beginner_form" action="{{url('employee/save')}}">
                    @csrf
                    <div class="form-wrap">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="first_name">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name"
                                           placeholder="First Name" autocomplete="off" value="{{$employee->first_name}}" required />
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="last_name">Last Name</label>
                                    <input type="text" class="form-control" id="inputBasicFirstName" name="last_name"
                                           placeholder="Last Name" value="{{$employee->last_name}}" autocomplete="off" />
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label" for="last_name">Bonus</label>
                                    <input type="number" class="form-control" name="bonus"
                                           placeholder=0 value="0" autocomplete="off" />
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Gender</label>
                                    <div>
                                        <div class="radio-custom radio-default radio-inline">
                                            <input type="radio" id="gender_male" name="gender" value="male" {{$employee->gender=='male' ? 'checked' : ''}}/>
                                            <label for="gender_male">Male</label>
                                        </div>
                                        <div class="radio-custom radio-default radio-inline">
                                            <input type="radio" id="gender_female" name="gender" value="female" {{$employee->gender=='female' ? 'checked' : ''}} />
                                            <label for="gender_female">Female</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Paid Method</label>
                                    <div>
                                        <div class="radio-custom radio-default radio-inline">
                                            <input type="radio" id="cash" name="PaidMethod" value="cash" {{$employee->paid_method=='cash' ? 'checked' : ''}} />
                                            <label for="cash">Cash</label>
                                        </div>
                                        <div class="radio-custom radio-default radio-inline">
                                            <input type="radio" id="credit" name="PaidMethod" value="credit" {{$employee->paid_method=='credit' ? 'checked' : ''}} />
                                            <label for="credit">Credit</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h3 class="pictureID-label">Upload Picture ID</h3>
                                <div class="profile-pic-container">
                                    <label for="profile_picture" style="display:block">
                                        <img src="{{$employee->pictureID!=null ? url('public/pictureIDs').'/'.$employee->pictureID : asset('images/avatar.jpg') }}" class="profile-pic" id="profile-pic">
                                        <img src="{{asset('images/upload_icon.png')}}" id="upload-icon">
                                        <div id="image-overlay"></div>
                                    </label>
                                    <input type="file" id="profile_picture" name="profile_picture" class="form-control" style="display:none;"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="js-grid-holder" style="margin-top:-40px;padding-left:0;padding-right:0;width:80%">
                        <h3 class="table-title" style="margin-bottom:10px">Initial Position</h3>
                        <div id="beginner_position" class="table-content"></div>
                    </div>

                    <div style="margin-top:-20px;margin-left:10%">
                        <button type="submit" class="btn btn-primary" id="Start_Date">Start Date</button>
                    </div>
                    <input type="text" style="display:none" id="employee_id" name="employee_id" value="{{$employee->id}}">
                </form>

                <form autocomplete="off" method="post" id="promote_form" action="{{url('employee/save')}}">
                    @csrf
                    <div class="promote-part-holder">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-control-label" for="promote_date">Promote Date</label>
                                <input type="text" class="form-control" id="promote_date" data-plugin="datepicker" name="promote_date" value="{{$employee->promotion_date!=null ? $employee->promotion_date : ''}}">
                            </div>

                        </div>

                        <div class="js-grid-holder js-gird-full-width" style="margin-top:-30px;padding-left:0;padding-right:0">
                            <h3 class="table-title" style="margin-bottom:10px">Promote Position</h3>
                            <div id="promote_position" class="table-content"></div>
                        </div>
                        <button type="submit" class="btn btn-success" style="margin-top:-30px" id="promote_submit">Promote</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
@endsection

@section('insert-js')
    <script>
        $(document).ready(function () {
            load_grid('promote');
            load_grid('beginner');

            $('.profile-pic-container').addClass('upload-hover');
            $('#profile_picture').css('cursor','pointer');
            $('#image-overlay').show();
            $('#image-overlay').css('height',$('.profile-pic').css('height'));
            $('#upload-icon').show();
            $('.profile-pic-container').addClass('upload-hover');
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#profile-pic').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#profile_picture").change(function(){
            readURL(this);
        });



        function load_grid(employeement_state){
            $("#"+employeement_state+"_position").jsGrid({
                width: "100%",
                height: "300px",
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
                    loadData: function(filter){
                        var employee_id=$('#employee_id').val();
                        return $.ajax({
                            method: "GET",
                            url: "{{url('/getEmployeeJob/')}}"+"/"+employee_id+"/"+employeement_state,
                        }).done(function (result) {
                            // console.log(result);
                        })
                    },
                    insertItem:function (item) {
                        var employee_id=$('#employee_id').val();
                        if (employee_id!=0){
                            var form_id="#"+employeement_state+"_form";
                            addFomrData(employeement_state,form_id,item,0,1);
                            var formData=new FormData($(form_id)[0]);

                            return $.ajax({
                                method: "post",
                                url: "{{url('/insertEmployeeJob')}}",
                                data: formData,
                                contentType: false,
                                processData: false,
                                dataType:'json',
                            }).done(function (result) {
                                load_grid('promote');
                                load_grid('beginner');
                                console.log(result);

                            }).fail(function (e) {
                                console.log(e);

                            });
                        }

                    },
                    updateItem:function (item) {
                        var employee_id=$('#employee_id').val();
                        if (employee_id!=0){
                            var form_id="#"+employeement_state+"_form";
                            addFomrData(employeement_state,form_id,item,0,1);
                            var formData=new FormData($(form_id)[0]);

                            return $.ajax({
                                method: "post",
                                url: "{{url('/editEmployeeJob')}}",
                                data: formData,
                                contentType: false,
                                processData: false,
                                dataType:'json',
                            }).done(function (result) {
                                console.log(result);
                                load_grid('promote');
                                load_grid('beginner');

                            }).fail(function (e) {
                                console.log(e);

                            });
                        }

                    },
                    deleteItem:function (item) {
                        return $.ajax({
                            method: "post",
                            url: "{{url('/deleteEmployeeJob')}}",
                            data: item,
                        }).done(function (result) {
                            // console.log(result);
                            load_grid('beginner');
                            load_grid('promote');
                        }).fail(function (e) {
                            console.log(e);

                        });
                    }
                },

                fields: [
                    { name:"ID" ,type: "hidden", css: 'hide'},
                    { name: "job", type: "select", width: 150, validate: { message: "Please Select Job",validator: function(value) { return value > 0;} },title:'Job',css:"text-center",
                        items: job_item,
                        valueField: "Id",
                        textField: "Name",
                        filtering:true,
                        insertTemplate: function () {
                            // Retrieve the DOM element
                            // Note: prototype.insertTemplate
                            var $insertControl = jsGrid.fields.select.prototype.insertTemplate.call(this);
                            var grid = this._grid;

                            // Attach onchange listener !
                            $insertControl.change(function () {
                                var selectedValue = $(this).val();
                                grid.option("fields")[3].insertControl.val(job_item[selectedValue]['hourly_pay']);   // When changing Job, will set default value
                                grid.option("fields")[4].insertControl.val(job_item[selectedValue]['hourly_percent']);
                                grid.option("fields")[5].insertControl.val(job_item[selectedValue]['flat_percent']);
                                grid.option("fields")[6].insertControl.val(job_item[selectedValue]['extra_percent']);
                                grid.option("fields")[7].insertControl.val(job_item[selectedValue]['packing_percent']);
                                grid.option("fields")[8].insertControl.val(job_item[selectedValue]['service_percent']);
                            });

                            return $insertControl;
                        },
                        editTemplate: function (value) {
                            // Retrieve the DOM element (select)
                            // Note: prototype.editTemplate
                            var $editControl = jsGrid.fields.select.prototype.editTemplate.call(this, value);
                            var grid = this._grid;

                            // Attach onchange listener !
                            $editControl.change(function () {
                                var selectedValue = $(this).val();
                                grid.option("fields")[3].editControl.val(job_item[selectedValue]['hourly_pay']);   // When changing Job, will set default value
                                grid.option("fields")[4].editControl.val(job_item[selectedValue]['hourly_percent']);
                                grid.option("fields")[5].editControl.val(job_item[selectedValue]['flat_percent']);
                                grid.option("fields")[6].editControl.val(job_item[selectedValue]['extra_percent']);
                                grid.option("fields")[7].editControl.val(job_item[selectedValue]['packing_percent']);
                                grid.option("fields")[8].editControl.val(job_item[selectedValue]['service_percent']);
                            });
                            return $editControl;
                        }
                    },
                    { name: "position", type: "select", width: 150, validate: { message: "Please Select Position",validator: function(value) { return value > 0;} },title:'Position',css:"text-center",
                        items: position_item,
                        valueField: "Id",
                        textField: "Name",
                        filtering:true,
                    },

                    { name: "hourly_pay", type: "number", width: 100, css:"text-center",title:"Hourly Pay",align: "center",value:"0",
                        insertTemplate: function() {
                            var input = this.__proto__.insertTemplate.call(this); //original input
                            input.val(0);
                            return input;
                        }

                    },
                    { name: "hourly_percent", type: "number", width: 100, css:"text-center",title:"Hourly, %",align: "center",value:"0",
                        insertTemplate: function() {
                            var input = this.__proto__.insertTemplate.call(this); //original input
                            input.val(0);
                            return input;
                        }
                    },
                    { name: "flat_percent", type: "number", width: 100, css:"text-center",title:"Flat, %",align: "center",value:"0",
                        insertTemplate: function() {
                            var input = this.__proto__.insertTemplate.call(this); //original input
                            input.val(0);
                            return input;
                        }
                    },
                    { name: "extra_percent", type: "number", width: 100, css:"text-center",title:"Extra Flat, %",align: "center",value:"0",
                        insertTemplate: function() {
                            var input = this.__proto__.insertTemplate.call(this); //original input
                            input.val(0);
                            return input;
                        }
                    },
                    { name: "packing_percent", type: "number", width: 100, css:"text-center",title:"Packing, %",align: "center",value:"0",
                        insertTemplate: function() {
                            var input = this.__proto__.insertTemplate.call(this); //original input
                            input.val(0);
                            return input;
                        }
                    },
                    { name: "service_percent", type: "number", width: 100, css:"text-center",title:"Service, %",align: "center",value:"0",
                        insertTemplate: function() {
                            var input = this.__proto__.insertTemplate.call(this); //original input
                            input.val(0);
                            return input;
                        }
                    },

                    {
                        type: "control",width:50
                    }
                ]
            });
        }

        $('#promote_form').submit(function (e) {
            e.preventDefault();
            submit_function('promote',e);
        })

        $('#beginner_form').submit(function (e) {
            e.preventDefault();
            submit_function('beginner',e);
        });
    </script>

    <script>
        var job_item=JSON.parse('<?php echo($job_item)?>');
        var position_item=JSON.parse('<?php echo($position)?>');

        function submit_function(employeement_state,e) {
            var form_id="#"+employeement_state+"_position";
            var data = $(form_id).jsGrid("option", "data");

            // $('<input />').attr('type', 'hidden')
            //     .attr('name', "employeement_state")
            //     .attr('value', employeement_state)
            //     .appendTo(form_id);
            //
            // $('<input />').attr('type', 'hidden')
            //     .attr('name', "employee_id")
            //     .attr('value', $('#employee_id').val())
            //     .appendTo(form_id);

            if (data.length>0){
                for (var i=0;i<data.length;i++){
                    addFomrData(employeement_state,form_id,data[i],i,data.length)
                }
            }
            e.preventDefault();
            var formData=new FormData(e.target);

            $.ajax({
                method: "post",
                url: "{{url('employee/save')}}",
                data: formData,
                async:false,
                contentType: false,
                processData: false,
                dataType:'json',
                success:function (result) {
                    if (employeement_state=='beginner'){
                        $('#employee_id').val(result);
                        load_grid(employeement_state);
                        $('#promote_submit').removeAttr("disabled");
                        load_grid('promote');
                    }
                },
                error:function (e) {
                    console.log(e);
                }
            })
        }


        function addFomrData(employeement_state,form_id,item,item_index,item_count) {
            $('<input />').attr('type', 'hidden')
                .attr('name', "employeement_state")
                .attr('value', employeement_state)
                .appendTo(form_id);

            $('<input />').attr('type', 'hidden')
                .attr('name', "employee_id")
                .attr('value', $('#employee_id').val())
                .appendTo(form_id);

            $('<input />').attr('type', 'hidden')
                .attr('name', "item_count")
                .attr('value', item_count)
                .appendTo(form_id);

            $('<input />').attr('type', 'hidden')
                .attr('name', "hourly_pay-"+item_index.toString())
                .attr('value', item['hourly_pay'].toString())
                .appendTo(form_id);

            $('<input />').attr('type', 'hidden')
                .attr('name', "job-"+item_index.toString())
                .attr('value', item['job'].toString())
                .appendTo(form_id);
            $('<input />').attr('type', 'hidden')
                .attr('name', "position-"+item_index.toString())
                .attr('value', item['position'].toString())
                .appendTo(form_id);


            $('<input />').attr('type', 'hidden')
                .attr('name', "hourly_percent-"+item_index.toString())
                .attr('value', item['hourly_percent'].toString())
                .appendTo(form_id);
            $('<input />').attr('type', 'hidden')
                .attr('name', "flat_percent-"+item_index.toString())
                .attr('value', item['flat_percent'].toString())
                .appendTo(form_id);
            $('<input />').attr('type', 'hidden')
                .attr('name', "extra_percent-"+item_index.toString())
                .attr('value', item['extra_percent'].toString())
                .appendTo(form_id);
            $('<input />').attr('type', 'hidden')
                .attr('name', "packing_percent-"+item_index.toString())
                .attr('value', item['packing_percent'].toString())
                .appendTo(form_id);
            $('<input />').attr('type', 'hidden')
                .attr('name', "service_percent-"+item_index.toString())
                .attr('value', item['service_percent'].toString())
                .appendTo(form_id);
            $('<input />').attr('type', 'hidden')
                .attr('name', "id-"+item_index.toString())
                .attr('value', item['ID'].toString())
                .appendTo(form_id);


        }


    </script>

@endsection



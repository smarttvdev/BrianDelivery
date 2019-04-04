$(document).ready(function () {
    var employee_id=$('#employee_id').val();
    if (employee_id!="0"){
        $('#promote-grid-holder').css('display','block');
        $('#beginner-grid-holder').css('display','block');
    }



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
        height: "auto",
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
                    url: site_url+"/getEmployeeJob"+"/"+employee_id+"/"+employeement_state,
                }).done(function (result) {
                    console.log(result);
                }).fail(function (err) {
                    console.log(err);

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
                        url: site_url+"/insertEmployeeJob",
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
                        url: site_url+"/editEmployeeJob",
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
                    url: site_url+"/deleteEmployeeJob",
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

                    $insertControl.change(function () {
                        var selectedValue = $(this).val();
                        console.log(grid.option("fields")[9]);
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
                    var $editControl = jsGrid.fields.select.prototype.editTemplate.call(this, value);
                    var grid = this._grid;

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
                insertTemplate: function () {
                    // Retrieve the DOM element
                    // Note: prototype.insertTemplate
                    var $insertControl = jsGrid.fields.select.prototype.insertTemplate.call(this);
                    var grid = this._grid;

                    // Attach onchange listener !
                    $insertControl.change(function () {
                        var selectedValue = $(this).val();
                        console.log(position_item[selectedValue]['bonus']);

                        grid.option("fields")[9].insertControl.val(position_item[selectedValue]['bonus']);
                    });

                    return $insertControl;
                },
                editTemplate: function (value) {
                    var $editControl = jsGrid.fields.select.prototype.editTemplate.call(this, value);
                    var grid = this._grid;

                    $editControl.change(function () {
                        var selectedValue = $(this).val();
                        console.log(position_item[selectedValue]['bonus']);
                        console.log(grid.option("fields")[9]);
                        grid.option("fields")[9].editControl.val(position_item[selectedValue]['bonus']);
                    });
                    return $editControl;
                }
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
            { name: "bonus", type: "text",disabled: true, width: 100, css:"text-center disable",title:"Bonus Points",align: "center",value:"0",readOnly: true,
                insertTemplate: function() {
                    var input = this.__proto__.insertTemplate.call(this); //original input
                    input.text(0);
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
    $('#add_employee_btn').text('Update Employee');
    $('#promote-grid-holder').slideDown('slow');
    $('#beginner-grid-holder').slideDown('slow');
});

function submit_function(employeement_state,e) {
    var form_id="#"+employeement_state+"_position";
    var data = $(form_id).jsGrid("option", "data");
    if (data.length>0){
        for (var i=0;i<data.length;i++){
            addFomrData(employeement_state,form_id,data[i],i,data.length)
        }
    }
    e.preventDefault();
    var formData=new FormData(e.target);
    $.ajax({
        method: "post",
        url: site_url+"/employee/save",
        data: formData,
        async:false,
        contentType: false,
        processData: false,
        dataType:'json',
        success:function (result) {
            if (employeement_state=='beginner'){
                console.log(result);
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
    // $('<input />').attr('type', 'hidden')
    //     .attr('name', "bonus-"+item_index.toString())
    //     .attr('value', item['bonus'].toString())
    //     .appendTo(form_id);
    $('<input />').attr('type', 'hidden')
        .attr('name', "id-"+item_index.toString())
        .attr('value', item['ID'].toString())
        .appendTo(form_id);
}



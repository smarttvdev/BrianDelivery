$(document).ready(function () {
    for (var i=0;i<result['job'].length;i++){
        $('#start_time-tab-'+i).datetimepicker({footer: true, modal: true});
        $('#finish_time-tab-'+i).datetimepicker({footer: true, modal: true});
    }
    for (var i=0;i<result['job'].length;i++){
        table[i]=$('#selected-employees-tab-'+i).DataTable({
            sort:false,
            "columnDefs":{
                "targets": [8],
                "visible": false
            },
            "columns":[
                {},
                {},
                {},
                {},
                {},
                {},
                {},
                {},
                {},
                {
                    "className":"hide"
                },
            ]
        });
    }
});

$(document).on('click','.plus',function () {
    var id=this.id;
    var job_index=parseInt(id.replace('add-stop-button-tab-',''));
    var count=$('#stop-holder-tab-'+job_index).children().length;
    $('#stop-holder-tab-'+job_index).append('<div class="row" style="margin-left:0 !important;margin-right:0 !important;"><input type="text" class="form-control"  name="stop_address-'+count+'" id="stop_address-tab-'+job_index+'-'+count+'" style="margin-bottom:5px;width:200px !important;" autocomplete="off"/>\n' +
        '<span class="remove-stop"><i class="fas fa-minus"></i></span></div>'
    );
    $('#stop_count-tab-'+job_index).val(count);
});

$(document).on('click','.remove-stop',function () {
    var stop_holder=$(this).parents()[1];
    var count=$(stop_holder).children().length;
    var id=stop_holder.id;
    var job_index=parseInt(id.replace('stop-holder-tab-',''));

    var current_id=$(this).parent().children(':first').attr('id');
    var current_index=parseInt(current_id.replace('stop_address-tab-'+job_index+'-',''));
    $(this).parent().remove();
    for (var i=current_index+1;i<count;i++){
        // console.log($('#stop_address-tab-'+job_index+'-'+i)).attr('id');
        console.log('#stop_address-tab-'+job_index+'-'+i);
        $('#stop_address-tab-'+job_index+'-'+i).attr('id','stop_address-tab-'+job_index+'-'+(i-1)).
        attr('name','stop_address-'+(i-1));
    }
    $('#stop_count-tab-'+job_index).val(count-2);
});

$(document).on('click','.register-event',function (e) {
    e.preventDefault();
    var id=this.id;
    var job_index=parseInt(id.replace('register_event-tab-',''));
    saveEvent(job_index);
})

function saveEvent(job_index) {
    var formData=new FormData($('#event_form-'+job_index)[0]);
    $.ajax({
        url:site_url+"/registerEvent'",
        type:"post",
        contentType: false,
        processData: false,
        data:formData,
        dataType:'json',
        async:false,
        success:function (result) {
            $('#event_id-tab-'+job_index).val(result);
        },
        error:function (err) {
            console.log(err);
        }
    })
}

function positionChange(job_index) {
    var position_index=$('#position'+'-tab-'+job_index).val();

    $('#employee'+'-tab-'+job_index).empty();
    for (var i=0;i<result['employee'][job_index][position_index].length;i++){
        $('#employee'+'-tab-'+job_index).append('<option value="'+result['employee'][job_index][position_index][i]['Id']+'">'+result['employee'][job_index][position_index][i]['Name']+'</option>');
    }
    $('#bonus-tab-'+job_index).val(0);
    $('#hourly_pay-'+job_index).val(0);
    if (result['job'][job_index]['type']=='Hourly')
        $('#hourly_percent-tab-'+job_index).val(0);
    else
        $('#flat_percent-tab-'+job_index).val(0);
    $('#extra_percent-tab-'+job_index).val(0);
    $('#packing_percent-tab-'+job_index).val(0);
    $('#service_percent-tab-'+job_index).val(0);
}

function employeeChange(job_index) {
    var position_index=$('#position'+'-tab-'+job_index).val();
    var employee_index=$('#employee'+'-tab-'+job_index).val();
    $('#bonus-tab-'+job_index).val(result['employee'][job_index][position_index][employee_index]['bonus']);
    $('#hourly_pay-tab-'+job_index).val(result['employee'][job_index][position_index][employee_index]['hourly_pay']);
    if (result['job'][job_index]['type']=='Hourly')
        $('#hourly_percent-tab-'+job_index).val(result['employee'][job_index][position_index][employee_index]['hourly_percent']);
    else
        $('#flat_percent-tab-'+job_index).val(result['employee'][job_index][position_index][employee_index]['flat_percent']);

    $('#extra_percent-tab-'+job_index).val(result['employee'][job_index][position_index][employee_index]['extra_percent']);
    $('#packing_percent-tab-'+job_index).val(result['employee'][job_index][position_index][employee_index]['packing_percent']);
    $('#service_percent-tab-'+job_index).val(result['employee'][job_index][position_index][employee_index]['service_percent']);
}


function addEmployee(job_index) {
    var selectedEmployees=table[job_index].rows().data();
    var position_index=$('#position'+'-tab-'+job_index).val();
    var employee_index=$('#employee'+'-tab-'+job_index).val();
    if (position_index==0){
        alert("Please select position and employee");
        return;
    }else{
        if (employee_index==0){
            alert("Please select employee");
            return;
        }
    }
    var oneEmployee=[];
    oneEmployee[0]=result['employee'][job_index][position_index][employee_index]['Name'];  // Employee Name
    oneEmployee[1]=result['position'][position_index]['Name'];  // Position Name
    oneEmployee[2]=$('#bonus-tab-'+job_index).val();  //bonus
    oneEmployee[3]=$('#hourly_pay-tab-'+job_index).val();  //hourly pay
    if (result['job'][job_index]['type']!='Hourly'){
        oneEmployee[4]=$('#flat_percent-tab-'+job_index).val();  //bonus
    }
    else
        oneEmployee[4]=$('#hourly_percent-tab-'+job_index).val();  //bonus
    oneEmployee[5]=$('#extra_percent-tab-'+job_index).val();  //bonus
    oneEmployee[6]=$('#packing_percent-tab-'+job_index).val();  //bonus
    oneEmployee[7]=$('#service_percent-tab-'+job_index).val();  //bonus
    oneEmployee[8]='<button type="button" class="btn btn-floating btn-success btn-sm edit" style="width:30px;height:30px" onclick="editEmployee('+job_index+',this)"><i class="icon wb-pencil" aria-hidden="true"></i></button>'+
        '<button type="button" class="btn btn-floating btn-danger btn-sm remove" style="width:30px;height:30px;margin-left:5px;" onclick="deleteEmployee('+job_index+','+'this)"><i class="icon fa-trash" aria-hidden="true"></i></button>';
    oneEmployee[9]=$('#employee_pay_comment-tab-'+job_index).val();

    for (var i=0;i<selectedEmployees.length;i++){
        if (selectedEmployees[i][1]==oneEmployee[1] && selectedEmployees[i][2]==oneEmployee[2]){
            alert("Same Employee and position already exist. Please edit")
            return;
        }
    }
    addEmployeeToEvent(job_index,oneEmployee);
    table[job_index].row.add(oneEmployee).draw();
}

function addEmployeeToEvent(job_index,employee_data) {
    var event_id=$('#event_id-tab-'+job_index).val();
    if (event_id==0){
        saveEvent(job_index);
        event_id=$('#event_id-tab-'+job_index).val();
    }

    $.ajax({
        method:'post',
        url:"{{url('addEmployeeToEvent')}}",
        data:{
            job_id:$('#job_id-tab-'+job_index).val(),
            event_id:event_id,
            employee_data:employee_data
        },
        success:function (result) {
            console.log(result);
        },
        error:function (err) {
            console.log(err);
        }
    })
}

function deleteEmployee(job_index,btn){
    var event_id=$('#event_id-tab-'+job_index).val();
    var tr = $(btn).closest('tr');
    var row=table[job_index].row(tr);
    var data=row.data();
    $.ajax({
        method: 'post',
        url: "{{url('deleteEmployeeEvent')}}",
        data: {
            event_id: event_id,
            employee_data: data
        },
        success: function (result) {
            console.log(result);
        },
        error: function (err) {
            console.log(err);
        }
    });
    table[job_index].row(tr).remove().draw();
}

function editEmployee(job_index, btn){
    var tr = $(btn).closest('tr');
    selected_tr=tr;
    var row=table[job_index].row(tr);
    var data=row.data();
    $('#editEmployeeEvent-tab-'+job_index).modal('show');
    $('#bonus_modal-tab-'+job_index).val(data[2]);
    $('#hourly_pay_modal-tab-'+job_index).val(data[3]);
    if (result['job'][job_index]['type']=="Hourly")
        $('#hourly_percent_modal-tab-'+job_index).val(data[4]);
    else
        $('#flat_percent_modal-tab-'+job_index).val(data[4]);
    $('#extra_percent_modal-tab-'+job_index).val(data[5]);
    $('#packing_percent_modal-tab-'+job_index).val(data[6]);
    $('#service_percent_modal-tab-'+job_index).val(data[7]);
    $('#price_comment_modal-tab-'+job_index).val(data[9]);
}

$(document).on('click','.modal-save',function () {
    var id=this.id;
    var job_index=parseInt(id.replace('modal-save-tab-',''));
    var row = table[job_index].row(selected_tr);
    var data=row.data();

    data[2]=$('#bonus_modal-tab-'+job_index).val();
    data[3]=$('#hourly_pay_modal-tab-'+job_index).val();
    if (result['job'][job_index]['type']=="Hourly")
        data[4]=$('#hourly_percent_modal-tab-'+job_index).val();
    else
        data[4]=$('#flat_percent_modal-tab-'+job_index).val();
    data[5]=$('#extra_percent_modal-tab-'+job_index).val();
    data[6]=$('#packing_percent_modal-tab-'+job_index).val();
    data[7]=$('#service_percent_modal-tab-'+job_index).val();
    data[9]=$('#price_comment_modal-tab-'+job_index).val();
    table[job_index]
        .row(selected_tr)
        .data( data )
        .draw();

    addEmployeeToEvent(job_index,data);
    $('#editEmployeeEvent-tab-'+job_index).modal('hide');

});

$('form input').on('keyup', function (e) {
    var form=$(this).parents('form');
    var form_id=form.attr('id');
    var job_index=parseInt(form_id.replace('event_form-',''));
    caclulateTotalHour(job_index,$(this));
});

function caclulateTotalHour(job_index,$element) {
    var labor_hours,travel_time,total_hours,non_profit,hourly_rate,packing,flat,packing,service,extra_amount,job_total;
    var discount, tips;
    if ($('#labor_hours-tab-'+job_index).val()==null)
        labor_hours=0;
    else
        labor_hours=parseFloat($('#labor_hours-tab-'+job_index).val());
    if ($('#travel_time-tab-'+job_index).val()==null)
        travel_time=0;
    else
        travel_time=parseFloat($('#travel_time-tab-'+job_index).val());
    total_hours=labor_hours+travel_time;
    $('#total_hours-tab-'+job_index).val(total_hours);

    if ($('#non_profit-tab-'+job_index).val()==null)
        non_profit=0;
    else
        non_profit=parseFloat($('#non_profit-tab-'+job_index).val());

    if ($('#packing-tab-'+job_index).val()==null)
        packing=0;
    else
        packing=parseFloat($('#packing-tab-'+job_index).val());

    if ($('#service-tab-'+job_index).val()==null)
        service=0;
    else
        service=parseFloat($('#service-tab-'+job_index).val());

    if ($('#extra-tab-'+job_index).val()==null)
        extra_amount=0;
    else
        extra_amount=parseFloat($('#extra-tab-'+job_index).val());

    if ($('#discount-tab-'+job_index).val()==null)
        discount=0;
    else
        discount=parseFloat($('#discount-tab-'+job_index).val());

    if ($('#tips-tab-'+job_index).val()==null)
        tips=0;
    else
        tips=parseFloat($('#tips-tab-'+job_index).val());

    job_total=non_profit+packing+service+extra_amount+tips;

    if (result['job'][job_index]['type']=="Hourly"){
        if ($('#hourly_rate-tab-'+job_index).val()==null)
            hourly_rate=0;
        else
            hourly_rate=parseFloat($('#hourly_rate-tab-'+job_index).val());
        job_total+=hourly_rate*total_hours;
    }else{
        if ($('#flat-tab-'+job_index).val()==null)
            flat=0;
        else
            flat=parseFloat($('#flat-tab-'+job_index).val());
        job_total+=flat;
    }
    $('#job_total-tab-'+job_index).val(job_total);
}
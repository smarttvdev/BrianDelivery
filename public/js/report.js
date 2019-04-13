var employee_report_table;

$(document).ready(function () {
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

    employee_report_table=$('#reportTable').DataTable({
        sort:false,
        paginate:false,
        search:false,
        bPaginate: false,
        bInfo: false,
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
            {},
            {},
            {},
            {},
        ]
    });
})

function updateTable() {
    var start_date=$('#start_date').val();
    var end_date=$('#end_date').val();
    var employee_id=$('#employee_id').val();

    employee_report_table.clear().draw();
    if (start_date && end_date){
        $.ajax({
            "url":`${site_url}/get_employee_report`,
            "method":"post",
            "data":{
                "start_date":start_date,
                "end_date":end_date,
                "employee_id":employee_id
            },
            success:function (result) {
                var data=JSON.parse(result);
                console.log(data);
                var sum_total_hours=0,sum_hourly_pay=0,sum_bonus=0,sum_hourly=0,sum_extra=0,sum_flat=0,sum_packing=0,sum_service=0;

                if (data['event']){
                    for (var i=0;i<data['event'].length;i++){
                        for (var j=0;j<data['event'][i]['position_name'].length;j++){
                            var row=[];
                            row[0]=data['event'][i]['customer_name'];
                            row[1]=data['event'][i]['employee_name'];
                            row[2]=data['event'][i]['position_name'][j];
                            row[3]=data['event'][i]['total_hours'][j];
                            row[4]=data['event'][i]['hourly_pay'][j];
                            row[5]=data['event'][i]['bonus'][j];
                            row[6]=data['event'][i]['hourly'][j];
                            row[7]=data['event'][i]['flat'][j];
                            row[8]=data['event'][i]['job_type'];
                            row[9]=data['event'][i]['extra'][j];
                            row[10]=data['event'][i]['packing'][j];
                            row[11]=data['event'][i]['service'][j];

                            sum_total_hours+=parseFloat(row[3]);
                            sum_hourly_pay+=parseFloat(row[4]);
                            sum_bonus+=parseFloat(row[5]);
                            sum_hourly+=parseFloat(row[6]);
                            sum_flat+=parseFloat(row[7]);
                            sum_extra+=parseFloat(row[9]);
                            sum_packing+=parseFloat(row[10]);
                            sum_service+=parseFloat(row[11]);

                            row[12]=`<button type="button" class="btn btn-floating btn-success btn-sm edit" style="width:30px;height:30px" onclick="editEmployee(${data['event'][i]['id']},${data['event'][i]['position_id'][j]},${employee_id})"><i class="icon wb-pencil" aria-hidden="true"></i></button>
                        <button type="button" class="btn btn-floating btn-danger btn-sm remove" style="width:30px;height:30px;margin-left:5px;" onclick="deleteEmployee(${data['event'][i]['id']},${data['event'][i]['position_id'][j]},${employee_id})"><i class="icon fa-trash" aria-hidden="true"></i></button>`;
                            row[13]=data['event'][i]['id'];
                            employee_report_table.row.add(row).draw();
                        }
                    }


                    $("#reportTable tbody").append('<tr class="empty-row"><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>');

                    $("#reportTable tbody").append(`<tr class="summary"><td></td><td></td><td style="font-weight:bold">Period Total</td><td>${sum_total_hours}</td>
                                                <td>${sum_hourly_pay}</td><td>${sum_bonus}</td><td>${sum_hourly}</td>
                                                <td>${sum_flat}</td><td></td><td>${sum_extra}</td>
                                                <td>${sum_packing}</td><td>${sum_service}</td><td></td>
                                               </tr>`);

                    $("#reportTable tbody").append(`<tr class="summary"><td></td><td></td><td style="font-weight:bold">Total Salary</td><td>$${parseFloat(sum_total_hours)+parseFloat(sum_hourly_pay)+parseFloat(sum_bonus)
                    +parseFloat(sum_hourly)+parseFloat(sum_flat)+parseFloat(sum_extra)+parseFloat(sum_packing)+parseFloat(sum_service)}</td>
                                                <td></td><td></td><td></td>
                                                <td></td><td></td><td></td>
                                                <td></td><td></td><td></td>
                                               </tr>`);

                }

            },
            error:function (err) {
                console.log(err);
            }

        })

    }


}

$('#start_date').change(function () {
    updateTable();
})

$('#end_date').change(function () {
    updateTable();
})
$('#employee_id').change(function () {
    updateTable();
})


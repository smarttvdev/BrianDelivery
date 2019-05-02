$(document).ready(function () {
    $('#all-driver-table').DataTable({
        "columns":[
            {},
            {},
            {
                sorting:false
            },
            {
                sorting:false
            },
            {
                sorting:false
            },
            {
                sorting:false
            },
            {
                sorting:false
            },
            {},
            {},
            {},
            {},
            {},
            {},
            {
                sorting:false
            },
        ]
    });
});

var selected_driver_td;

function ChangeState(driver_id,object) {
    var state=$(object).text();
    var  tr=$(object).closest('tr');
    $.ajax({
        url:`${site_url}/api/driver/changestate`,
        method:'post',
        data:{
          id:driver_id,
          state:state
        },
        success:function () {
            if (state=='Pending'){
                $(object).attr('class','btn btn-success')
                $(object).text('Active');
                $(tr).remove();

            }
            else{
                $(object).attr('class','btn btn-danger')
                $(object).text('Pending');
                $(tr).remove();
            }
        },
        error:function (err) {
            console.log(err);
        }
    })
}

function ChangeAgreedSate(src,id,information,object) {
    selected_driver_td=object;
    $('img.vehicle_information_photo_modal').attr('src',src);
    $('.driver_id').text(id);
    var state=$(selected_driver_td).attr('state');
    $('.state').text(state);
    $('.picture_information_type').text(information);
    if (parseInt(state)==0){
        $('#showVehiclePictures').find('.modal-header').css('background','#ff4c52');
        $('.changeAgreeState').text('Agree');
        $('.changeAgreeState').attr('class','btn btn-success changeAgreeState')
    }
    else{
        $('#showVehiclePictures').find('.modal-header').css('background','#11c26d');
        $('.changeAgreeState').text('Disagree');
        $('.changeAgreeState').attr('class','btn btn-danger changeAgreeState')
    }

    $('#showVehiclePictures').modal('show');
}

$(document).on('click','.changeAgreeState',function () {
    var driver_id=$('.driver_id').text();
    var state=$('.state').text();
    var picture_information=$('.picture_information_type').text();
    var src=$(selected_driver_td).attr('src');
    var driver_active_state=$(selected_driver_td).closest('tr').find('td:eq(11)').text().trim();

    if (state==0){  // revert agreed state
        $(selected_driver_td).find('span').attr('class','agreed-state agreed');
        $(selected_driver_td).find('span').text('o');
        $(selected_driver_td).attr('state',1);
    }
    else{
        $(selected_driver_td).find('span').attr('class','agreed-state non-agreed');
        $(selected_driver_td).find('span').text('×');
        $(selected_driver_td).attr('state',0);
    }

    $.ajax({
        url:`${site_url}/api/driver/changeAgreeState`,
        method:"post",
        data:{
            driver_id:driver_id,
            state:state,
            picture_information:picture_information
        },
        success:function (result) {
            console.log(result);
            var changed_state=parseInt(result);
            console.log(`${changed_state}      ${driver_active_state}`)
            if (changed_state==0)  // if the state of approval is changed
            {
                if (driver_active_state=='Active')
                $(selected_driver_td).closest('tr').remove();
            }
            else{
                if (driver_active_state=='Pending')
                    $(selected_driver_td).closest('tr').remove();
            }
        },
        error:function (err) {
            console.log(err);
        }

    });
    $('#showVehiclePictures').modal('hide');
})



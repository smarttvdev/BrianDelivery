var my_marker=[];


var picked_driver_marker=[];
var map_element_ids=['map-online','map-picked','map-deliverying'];
var current_driver_id;

var driver_data=[];
var online_driver_marker=[];

var deliverying_driver_data=[];
var deliverying_driver_marker=[];

var maps=[];
var infowindow;

function initMap() {
    navigator.geolocation.getCurrentPosition(function (position) {
        var my_lat = position.coords.latitude;
        var my_lng = position.coords.longitude;
        for (var i=0;i<3;i++){
            maps[i] = new google.maps.Map(document.getElementById(map_element_ids[i]), {
                center: new google.maps.LatLng(my_lat, my_lng),
                mapTypeId: 'roadmap',
                zoom:4
            });
            my_marker[i] = new google.maps.Marker({position: {lat:my_lat,lng:my_lng}});
            my_marker[i].setMap(maps[i]);

            maps[i].addListener('click',function () {
                if (infowindow)
                    infowindow.close();
            })
        }
    })
}

setInterval(geoUpdate,5000);

function geoUpdate(){
    navigator.geolocation.getCurrentPosition(function (position) {
        var my_lat = position.coords.latitude;
        var my_lng = position.coords.longitude;
        $.ajax({
            url: `${site_url}/api/driver/getLocationInfo`,
            method: "post",
            data: {
                lat:my_lat,
                lng:my_lng
            },
            success: function (result) {
                var data = result;
                console.log(result);
                changeMyMarker(my_lat,my_lng);
                AddOnlineDriverMarker(data['online_drivers']);
                AddDeliveryingDriverMarker(data['deliverying_drivers']);

            },
            error: function (err) {
                console.log(err);
            }
        })
    });
}


function changeMyMarker(my_lat,my_lng) {
    for (var i=0;i<my_marker.length;i++){
        my_marker[i].setPosition(new google.maps.LatLng(my_lat, my_lng));
    }
}


function AddOnlineDriverMarker(online_data) {
    for (var i=0;i<driver_data.length;i++){
        for (var j=0;j<online_data.length;j++){
            if (driver_data[i]['id']==online_data[j]['id']){  // if driver already exists on the map
                online_driver_marker[i].setPosition(new google.maps.LatLng(online_data[j]['lat'],online_data[j]['lng']));
                online_data.slice(j,1);
                break;
            }
        }
    }
    for (var j=0;j<online_data.length;j++){
        driver_data.push(online_data[j]);
        var index=driver_data.length-1;
        online_driver_marker[index]=new google.maps.Marker({
            position: {lat:online_data[j]['lat'],lng:online_data[j]['lng']},
            map: maps[0],
            icon:{
                url:`${site_url}/public/images/car.png`,
                scaledSize: new google.maps.Size(60, 40),
            },
            data:online_data[j],

        });

        online_driver_marker[index].addListener('click', function(e) {
            var driver_data=this.data;
            if (infowindow)
                infowindow.close();
            infowindow=makeInforWindow(driver_data);
            infowindow.open(this.map,this);
        });
    }
}

function AddDeliveryingDriverMarker(delivering_data){
    for (var i=0;i<deliverying_driver_data.length;i++){
        for (var j=0;j<delivering_data.length;j++){
            if (deliverying_driver_data[i]['id']==delivering_data[j]['id']){  // if driver already exists on the map
                deliverying_driver_marker[i].setPosition(new google.maps.LatLng(delivering_data[j]['lat'],delivering_data[j]['lng']));
                delivering_data.slice(j,1);
                break;
            }
        }
    }
    for (var j=0;j<delivering_data.length;j++){
        deliverying_driver_data.push(delivering_data[j]);
        var index=deliverying_driver_data.length-1;
        deliverying_driver_marker[index]=new google.maps.Marker({
            position: {lat:delivering_data[j]['lat'],lng:delivering_data[j]['lng']},
            map: maps[2],
            icon:{
                url:`${site_url}/public/images/car.png`,
                scaledSize: new google.maps.Size(60, 40),
            },
            data:delivering_data[j],

        });

        deliverying_driver_marker[index].addListener('click', function(e) {
            var driver_data=this.data;
            if (infowindow)
                infowindow.close();
            infowindow=makeInforWindow(driver_data);
            infowindow.open(this.map,this);
        });
    }

}



function makeInforWindow(data) {
    var contentString=
       `<div class="driver-info-holder">
            <div class="image-holder">
                <img class="driver-image" src=${data['profile_pic']} />
            </div>
            
            <div class="driver-information">
                <h5 class="driver-information-item">${data['earned']}<span>Earned</span></h5>
                <h5 class="driver-information-item">${data['rate']}<span>Rate</span></h5>
                <h5 class="driver-information-item">${data['task_number']}<span>Tasks</span></h5>
            </div>
          
        </div>`;

    // <div class="contact-driver-part">
    //     <a href="tel:${data['phone_number']}" target="_blank"><i class="fa fa-phone" aria-hidden="true"></i></a>
    // </div>

    var infowindow = new google.maps.InfoWindow({
        content: contentString,
    });
    return infowindow;

}
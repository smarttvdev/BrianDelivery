
<template>
    <div>
        <table class="table" id="all-driver-table">
            <thead class="table table-primary">
                <tr v-for="driver in drivers" v-bind:key="driver.id">
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Driver License</th>
                    <th>Vehicle Registration</th>
                    <th>Proof Insurance</th>
                    <th>Vehicle Picture In</th>
                    <th>Vehicle Picture Out</th>
                    <th>Max Seats</th>
                    <th>Max Stuff Weight</th>
                    <th>Max Stuff Width</th>
                    <th>Max Stuff Height</th>
                    <th>Earned</th>
                    <th>Review</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="driver in drivers" v-bind:key="driver['id']">
                    <td>{{driver['firstname']}}</td>
                    <td>{{driver['lastname']}}</td>
                    <td><img v-bind:src="driver['driver_license']" /></td>
                    <td><img v-bind:src="driver['vehicle_registration']" /></td>
                    <td><img v-bind:src="driver['proof_insurance']" /></td>
                    <td><img v-bind:src="driver['vehicle_picture_in']" /></td>
                    <td><img v-bind:src="driver['vehicle_picture_out']" /></td>
                    <td>{{driver['max_seats']}}</td>
                    <td>{{driver['max_stuff_weight']}}</td>
                    <td>{{driver['max_stuff_width']}}</td>
                    <td>{{driver['max_stuff_height']}}</td>
                    <td>{{driver['earned']}}</td>
                    <td>{{driver['rate']}}</td>
                </tr>
            </tbody>


        </table>
        
    </div>


</template>

<script>
    export default {
        data(){
            return{
                drivers:[],
                driver:{
                    id:'',
                    driver_id:"",
                    firstname:"",
                    lastname:"",
                    driver_license:"",
                    vehicle_registration:"",
                    proof_insurance:"",
                    vehicle_picture_in:"",
                    vehicle_picture_out:"",
                    max_seats:"",
                    max_stuff_weight:"",
                    max_stuff_width:"",
                    max_stuff_height:"",
                    earned:"",
                    rate:""
                }
            }
        },
        created() {
            this.fetchAllDrivers();
        },
        methods: {
            fetchAllDrivers(){
                fetch(`${site_link}/api/driver/all`).
                    then(res=>res.json()).
                    then(res=>{
                        console.log(res);
                        this.drivers=res;
                }).then(
                    // $('#all-driver-table').DataTable({})
                )
            }
        }
    }
</script>

<style scoped>
    th, td{
        text-align:center;
        vertical-align:middle;
    }
    td img{
        width:100px;
        height:100px;
        border-radius: 10px;
    }
</style>
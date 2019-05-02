@extends('layouts.template')

@section('insert-css')
    <link rel="stylesheet" href="{{asset('custom/css/driver/approvals.css')}}">
@endsection

@section('page-content')
    <div class="table-responsive">
        <table id="all-driver-table" class="table-hover dataTable table-striped w-full" style="width: 100%">
            <thead class="table table-primary">
                <tr>
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
                    <th>State</th>
                </tr>
            </thead>
            <tbody class="table table-grid">
            @foreach($drivers as $driver)
                <tr>
                    <td>{{ucfirst($driver['firstname'])}}</td>
                    <td>{{ucfirst($driver['lastname'])}}</td>
                    <td class="open-vehicle-information-photo-modal" state="{{$driver['driver_license_agreed_state']}}"
                        onclick="ChangeAgreedSate('{{$driver['driver_license']}}','{{$driver['driver_id']}}','driver_license',this)">
                        <img src="{{$driver['driver_license']}}" />
                        @if($driver['driver_license_agreed_state']==0)
                            <span class="agreed-state non-agreed">×</span>
                        @else
                            <span class="agreed-state agreed">o</span>
                        @endif
                    </td>
                    <td class="open-vehicle-information-photo-modal" state="{{$driver['vehicle_registration_agreed_state']}}"
                        onclick="ChangeAgreedSate('{{$driver['vehicle_registration']}}','{{$driver['driver_id']}}','vehicle_registration',this)">
                        <img src="{{$driver['vehicle_registration']}}" />
                        @if($driver['vehicle_registration_agreed_state']==0)
                            <span class="agreed-state non-agreed">×</span>
                        @else
                            <span class="agreed-state agreed">o</span>
                        @endif
                    </td>
                    <td class="open-vehicle-information-photo-modal" state="{{$driver['proof_insurance_agreed_state']}}"
                        onclick="ChangeAgreedSate('{{$driver['proof_insurance']}}','{{$driver['driver_id']}}','proof_insurance',this)">
                        <img src="{{$driver['proof_insurance']}}" />
                        @if($driver['proof_insurance_agreed_state']==0)
                            <span class="agreed-state non-agreed">×</span>
                        @else
                            <span class="agreed-state agreed">o</span>
                        @endif
                    </td>
                    <td class="open-vehicle-information-photo-modal" state="{{$driver['vehicle_picture_in_agreed_state']}}"
                        onclick="ChangeAgreedSate('{{$driver['vehicle_picture_in']}}','{{$driver['driver_id']}}','vehicle_picture_in',this)">
                        <img src="{{$driver['vehicle_picture_in']}}" />
                        @if($driver['vehicle_picture_in_agreed_state']==0)
                            <span class="agreed-state non-agreed">×</span>
                        @else
                            <span class="agreed-state agreed">o</span>
                        @endif
                    </td>
                    <td class="open-vehicle-information-photo-modal" state="{{$driver['vehicle_picture_out_agreed_state']}}"
                        onclick="ChangeAgreedSate('{{$driver['vehicle_picture_out']}}','{{$driver['driver_id']}}','vehicle_picture_out',this)">
                        <img src="{{$driver['vehicle_picture_out']}}" />
                        @if($driver['vehicle_picture_out_agreed_state']==0)
                            <span class="agreed-state non-agreed">×</span>
                        @else
                            <span class="agreed-state agreed">o</span>
                        @endif
                    </td>
                    <td class="{{$driver['max_seats']>=0 ? "agreed" : "non-agreed"}}">
                        {{$driver['max_seats']}}
                    </td>
                    <td class="{{$driver['max_stuff_weight']>=0 ? "agreed" : "non-agreed"}}">
                        {{$driver['max_stuff_weight']}}
                    </td>
                    <td class="{{$driver['max_stuff_width']>=0 ? "agreed" : "non-agreed"}}">
                        {{$driver['max_stuff_width']}}
                    </td>
                    <td>
                        {{$driver['max_stuff_height']}}
                    </td>
                    <td>
                        @if($driver['state']=="pending")
                            <button class="btn btn-danger" onclick="ChangeState('{{$driver['driver_id']}}',this)">{{ucfirst($driver['state'])}}</button>
                        @else
                            <button class="btn btn-success" onclick="ChangeState('{{$driver['driver_id']}}',this)">{{ucfirst($driver['state'])}}</button>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="modal fade modal-primary" id="showVehiclePictures" aria-hidden="true" aria-labelledby="showVehiclePictures" role="dialog" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Check Vehicle Information Photo</h4>
                </div>
                <div class="modal-body">
                    <img class="vehicle_information_photo_modal">
                    <p class="driver_id" style="display:none"></p>
                    <p class="state" style="display:none"></p>
                    <p class="picture_information_type" style="display:none"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary changeAgreeState">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('insert-js')
    <script src="{{asset('custom/js/approvals.js')}}"></script>
@endsection

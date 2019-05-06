@extends('layouts.template')

@section('insert-css')
    <link rel="stylesheet" href="{{asset('custom/css/driver/map.css')}}">
@endsection

@section('page-header')
    <h3 class="page-title">Driver's Map</h3>
@endsection

@section('page-content')
    <div class="tab-content">
        <div class="tab-pane fade show active" id="online-views" role="tabpanel">
            <h3 class="tab-pane-title">Drivers Online</h3>
            <div class="map-container">
                <div class="map-place-element" id="map-online">

                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="picked-views" role="tabpanel">
            <h3 class="tab-pane-title">Picked Drivers</h3>
            <div class="map-container">
                <div class="map-place-element" id="map-picked">


                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="delivering-views" role="tabpanel">
            <h3 class="tab-pane-title">Drivers Deliverying</h3>
            <div class="map-container">
                <div class="map-place-element" id="map-deliverying">

                </div>
            </div>
        </div>
    </div>

    <nav class="nav-map-page">
        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" data-toggle="tab" href="#online-views" role="tab" aria-selected="true">All</a>
            <a class="nav-item nav-link" data-toggle="tab" href="#picked-views" role="tab" aria-selected="true">Picking</a>
            <a class="nav-item nav-link" data-toggle="tab" href="#delivering-views" role="tab" aria-selected="true">Delivering</a>
        </div>
    </nav>


    <div class="modal fade modal-primary" id="DriverInformation" aria-hidden="true" role="dialog" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Driver Information</h4>
                </div>
                <div class="modal-body">
                    <img class="driver_image">
                    <p class="driver_id" style="display:none"></p>
                    <p class="driver_profile_pic" style="display:none"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('insert-js')
    <script src="{{asset('custom/js/map.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDevDlcD-iiGG4qOs1OE8ZKsi11HTODjtA&callback=initMap"></script>


@endsection

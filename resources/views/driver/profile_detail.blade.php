@extends('layouts.template')

@section('insert-css')
    <link rel="stylesheet" href="{{asset('custom/css/driver/profile_detail.css')}}">
@endsection

@section('page-content')
    <div class="row">
        <div class="col-lg-3">
            <div class="card card-shadow text-center">
                <div class="card-block">
                    <div class="profile-detail-img-holder">
                        <img src="{{$profile_data['profile_pic']}}" class="profile_detail_pic">
                        <h4 class="profile-user-name">{{$profile_data['user_name']}}</h4>
                    </div>
                    <p class="profile-about-me">{{$profile_data['about_me']}}</p>

                </div>
                <div class="card-footer">
                    <div class="row no-space">
                        <div class="col-4">
                            <strong class="profile-stat-count">{{$profile_data['earned']}}</strong>
                            <span class="profile-amount-label">Earned</span>
                        </div>
                        <div class="col-4">
                            <strong class="profile-stat-count">{{$profile_data['rate']}}</strong>
                            <span class="profile-amount-label">Rate</span>
                        </div>
                        <div class="col-4">
                            <strong class="profile-stat-count">{{$profile_data['task_numbers']}}</strong>
                            <span class="profile-amount-label">Tasks</span>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <div class="col-lg-9">
            <div class="panel">
                <div class="panel-body">

                </div>
            </div>
        </div>
    </div>
@endsection
@section('insert-js')
    <script src="{{asset('custom/js/approvals.js')}}"></script>
@endsection

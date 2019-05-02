@extends('layouts.template')

@section('insert-css')
    <link rel="stylesheet" href="{{asset('custom/css/driver/profile.css')}}">
@endsection

@section('page-content')
    <div class="table-responsive">
        <table id="driver-profile-table" class="table-hover dataTable table-striped w-full" style="width: 100%">
            <thead class="table table-primary">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Country</th>
                <th>Profile Picture</th>
                <th>Birthday</th>
                <th>Gender</th>
                <th>Review</th>
                <th>Earned</th>
            </tr>
            </thead>
            <tbody class="table table-grid">
            @foreach($drivers as $driver)
                <tr onclick="viewProfileDetail('{{$driver['driver_id']}}')">
                    <td>{{ucfirst($driver['firstname'])}}</td>
                    <td>{{ucfirst($driver['lastname'])}}</td>
                    <td>{{$driver['email']}}</td>
                    <td>{{ucfirst($driver['phone_number'])}}</td>
                    <td>{{ucfirst($driver['country'])}}</td>
                    <td>
                        <img src="{{$driver['profile_pic']}}" />
                    </td>
                    <td>{{ucfirst($driver['birthday'])}}</td>
                    <td>{{ucfirst($driver['gender'])}}</td>
                    <td>{{ucfirst($driver['rate'])}}</td>
                    <td>{{ucfirst($driver['earned'])}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
@section('insert-js')
    <script src="{{asset('custom/js/profile.js')}}"></script>
@endsection

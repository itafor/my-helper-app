@extends('layouts.app', ['pageSlug' => 'requests'])

@section('content')
    <div class="header py-7 py-lg-8">
        <div class="container">
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <h2 class="text-blue h2-heading">{{ __('What do u need right now for your lockdown?') }}</h2>
                            <a href="{{ route('make.request') }}">
                                <button class="req-btn btn btn-danger">Make Request</button>
                            </a>
                        <p class="text-lead text-light">
                            {{ __('What do u need right now for your lockdown?') }}
                        </p>
                        <div class="col-md-12">
                            <div class="card ">
                                <div class="card-header">
                                    <h4 class="card-title">Requests</h4>
                                </div>
                                <div class="card-body">
                                @include('alerts.success')
                                <div class="table-responsive">
                                    <table class="table tablesorter " id="">
                                        <thead class=" text-primary">
                                            <tr>
                                                <th>Date</th>
                                                <th>Request Type</th>
                                                <th>Category</th>
                                                <th>Name</th>
                                                <th class="text-center">Details</th>
                                                <th>Type</th>
                                                <th>City</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($allRequests as $req)
                                            <tr>
                                                <td>{{ strftime('%d-%b-%Y', strtotime($req->created_at))  }}</td>
                                                <td>{{ $req->request_type == 1 ? 'I need' : 'I want to provide' }}</td>
                                                <td>{{ $req->category->title }}</td>
                                                <td>{{ $req->user->name }} {{ $req->user->last_name }}</td>
                                                <td class="text-center">{{ $req->description }}</td>
                                                <td class="text-center">{{ $req->type }}</td>
                                                <td class="text-center">{{ $req->city->name }}</td>
                                            </tr>
                                        @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

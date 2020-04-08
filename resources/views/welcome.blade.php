@extends('layouts.app')

@section('content')
    <div class="header py-7 py-lg-8">
        <div class="container">
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <h2 class="text-blue h2-heading">{{ __('What do u need right now for your lockdown?') }}</h2>
                            <a href="">
                                <button class="req-btn btn btn-danger">Make Request</button>
                            </a>
                        <p class="text-lead text-light">
                            {{ __('What do u need right now for your lockdown?') }}
                        </p>
                        <div class="col-md-12">
                            <div class="card ">
                            <div class="card-header">
                                <h4 class="card-title"> Simple Table</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table tablesorter " id="">
                                        <thead class=" text-primary">
                                            <tr>
                                                <th>Date</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th class="text-center">Details</th>
                                                <th>Type</th>
                                                <th>City</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Dakota Rice</td>
                                                <td>Niger</td>
                                                <td>Oud-Turnhout</td>
                                                <td class="text-center">$36,738</td>
                                            </tr>
                                            <tr>
                                                <td>Minerva Hooper</td>
                                                <td>Curaçao</td>
                                                <td>Sinaai-Waas</td>
                                                <td class="text-center">$23,789</td>
                                            </tr>
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

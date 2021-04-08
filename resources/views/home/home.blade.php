@extends('layouts.home')

@section('content')
    
    <div class="jumbotron text-center mt-4">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h3 class="display-4">Mark Allocation System!</h3>
                <h5 class="lead">
                    The easiest way to manage your DSO34 Marks. Register and manage your student marks effectively!
                </h5>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body text-center p-10">
                    <span class="description-icons text-primary pt-5">
                        <i class="fa fa-users" style="font-size: 50px"></i>
                    </span>
                    <hr>
                    <h6 class="text-uppercase font-weight-bold">SIMPLICITY</h6>
                    <hr class="bg-primary accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                    <p class="card-text">
                        Mark allocation system is designed to be simple and user friendly.
                        Everyone using the platform the first time can easily understand it at first glance.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body text-center p-10">
                    <span class="description-icons text-primary pt-5">
                        <i class="fa fa-lock" style="font-size: 50px"></i>
                    </span>
                    <hr>
                    <h6 class="text-uppercase font-weight-bold">Secured</h6>
                    <hr class="bg-primary accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                    <p class="card-text">
                        We take security very seriously, your data will be encrypted and can't be shared with third party.
                        Connect securely with boldness.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body text-center p-10">
                    <span class="description-icons text-primary pt-10">
                        <i class="fa fa-desktop" style="font-size: 50px"></i>
                    </span>
                    <hr>
                    <h6 class="text-uppercase font-weight-bold">Responsive</h6>
                    <hr class="bg-primary accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                    <p class="card-text">
                        People access the internet with different devices with different screen sizes.
                        Mark Allocation System is designed to look good on any screen.
                    </p>
                </div>
            </div>
        </div>
    </div>

@endsection
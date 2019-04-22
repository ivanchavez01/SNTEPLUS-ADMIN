@extends('layouts.app')

@section('content')
<!-- ROW ENDS -->
<div class="row">
    <div class="col-lg-12 grid-margin">
        <div class="card performance-cards">
        <div class="card-body">
            <div class="row">
            <div class="col d-flex flex-row justify-content-center align-items-center">
                <div class="wrapper icon-circle bg-success">
                <i class="icon-rocket icons"></i>
                </div>
                <div class="wrapper text-wrapper">
                <p class="text-dark">{{$analytics["android"]}}</p>
                <p>Android</p>
                </div>
            </div>
            <div class="col d-flex flex-row justify-content-center align-items-center">
                <div class="wrapper icon-circle bg-primary">
                <i class="icon-umbrella icons"></i>
                </div>
                <div class="wrapper text-wrapper">
                <p class="text-dark">{{$analytics["ios"]}}</p>
                <p>IOS</p>
                </div>
            </div>
            <div class="col d-flex flex-row justify-content-center align-items-center">
                <div class="wrapper icon-circle bg-danger">
                <i class="icon-briefcase icons"></i>
                </div>
                <div class="wrapper text-wrapper">
                <p class="text-dark">{{$analytics["web"]}}</p>
                <p>Web</p>
                </div>
            </div>
           
            <div class="col d-flex flex-row justify-content-center align-items-center">
                <div class="wrapper icon-circle bg-warning">
                <i class="icon-check icons"></i>
                </div>
                <div class="wrapper text-wrapper">
                <p class="text-dark">{{$analytics["total"]}}</p>
                <p>Total devices</p>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
<!-- ROW ENDS -->
<!-- <div class="row">
    <div class="col-md-6 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-0">Statistics</h4>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-inline-block pt-3">
                        <div class="d-flex">
                            <h2 class="mb-0">$10,200</h2>
                            <div class="d-flex align-items-center ml-2">
                                <i class="mdi mdi-clock text-muted"></i>
                                <small class=" ml-1 mb-0">Updated: 9:10am</small>
                            </div>
                        </div>
                        <small class="text-gray">Raised from 89 orders.</small>
                    </div>
                    <div class="d-inline-block">
                        <div class="bg-success px-4 py-2 rounded">
                            <i class="mdi mdi-buffer text-white icon-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-0">Daily Order</h4>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-inline-block pt-3">
                        <div class="d-flex">
                            <h2 class="mb-0">$2256</h2>
                            <div class="d-flex align-items-center ml-2">
                                <i class="mdi mdi-clock text-muted"></i>
                                <small class=" ml-1 mb-0">Updated: 05:42pm</small>
                            </div>
                        </div>
                        <small class="text-gray">hey, let’s have lunch together</small>
                    </div>
                    <div class="d-inline-block">
                        <div class="bg-warning px-4 py-2 rounded">
                            <i class="mdi mdi-wallet text-white icon-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row section social-section">
    <div class="col-lg-4 grid-margin stretch-card">
        <div class="social-card w-100 bg-facebook">
        <div class="social-icon">
            <i class="icon-social-facebook icons"></i>
        </div>
        <div class="content">
            <p>+ 1500</p>
            <p>Facebook Likes</p>
        </div>
        </div>
    </div>
    <div class="col-lg-4 grid-margin stretch-card">
        <div class="social-card w-100 bg-twitter">
        <div class="social-icon">
            <i class="icon-social-twitter icons"></i>
        </div>
        <div class="content">
            <p>+574</p>
            <p>Twitter Followers</p>
        </div>
        </div>
    </div>
    <div class="col-lg-4 grid-margin stretch-card">
        <div class="social-card w-100 bg-dribbble">
        <div class="social-icon">
            <i class="icon-social-dribbble icons"></i>
        </div>
        <div class="content">
            <p>+450</p>
            <p>Dribble Shots</p>
        </div>
        </div>
    </div> 
</div>-->
<!-- ROW ENDS -->
@endsection

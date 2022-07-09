@extends('layouts.app')
@push('page-css')
    
@endpush

@section('content')
<div class="col-12">
    <div class="row">
        <div class="col-3">
            <div class="card">
              <div class="card-body">
                <div class="media">
                  <div class="avatar-sm font-size-20 mr-3">
                    <span class="avatar-title bg-soft-primary text-primary rounded">
                      <i class="mdi mdi-chart-bar"></i>
                    </span>
                  </div>
                  <div class="media-body">
                    <div class="font-size-16 mt-2">Revenue</div>
                  </div>
                </div>
                <h4 class="mt-4">0</h4>
                <div class="row">
                  
                  <div class="col-12 align-self-center">
                    <div class="progress progress-sm">
                      <div
                        class="progress-bar bg-primary"
                        role="progressbar"
                        style="width: 62%"
                        aria-valuenow="62"
                        aria-valuemin="0"
                        aria-valuemax="100"
                      ></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
              <div class="card-body">
                <div class="media">
                  <div class="avatar-sm font-size-20 mr-3">
                    <span class="avatar-title bg-soft-primary text-primary rounded">
                      <i class="mdi mdi-keyboard-return"></i>
                    </span>
                  </div>
                  <div class="media-body">
                    <div class="font-size-16 mt-2">Total Clients</div>
                  </div>
                </div>
                <h4 class="mt-4">0</h4>
                <div class="row">
                  
                  <div class="col-12 align-self-center">
                    <div class="progress progress-sm">
                      <div
                        class="progress-bar bg-primary"
                        role="progressbar"
                        style="width: 50%"
                        aria-valuenow="50"
                        aria-valuemin="0"
                        aria-valuemax="100"
                      ></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="col-3">
          <div class="card">
            <div class="card-body">
              <div class="media">
                <div class="avatar-sm font-size-20 mr-3">
                  <span class="avatar-title bg-soft-primary text-primary rounded">
                    <i class="fas fa-money-bill"></i>
                  </span>
                </div>
                <div class="media-body">
                  <div class="font-size-16 mt-2">Today's Cash</div>
                </div>
              </div>
              <h4 class="mt-4">0</h4>
              <div class="row">
                
                <div class="col-12 align-self-center">
                  <div class="progress progress-sm">
                    <div
                      class="progress-bar bg-primary"
                      role="progressbar"
                      style="width: 90%"
                      aria-valuenow="90"
                      aria-valuemin="0"
                      aria-valuemax="100"
                    ></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-3">
            <div class="card">
              <div class="card-body">
                <div class="media">
                  <div class="avatar-sm font-size-20 mr-3">
                    <span class="avatar-title bg-soft-primary text-primary rounded">
                      <i class="fas fa-award"></i>
                    </span>
                  </div>
                  <div class="media-body">
                    <div class="font-size-16 mt-2">Profit</div>
                  </div>
                </div>
                <h4 class="mt-4">0</h4>
                <div class="row">
                  
                  <div class="col-12 align-self-center">
                    <div class="progress progress-sm">
                      <div
                        class="progress-bar bg-primary"
                        role="progressbar"
                        style="width: 90%"
                        aria-valuenow="90"
                        aria-valuemin="0"
                        aria-valuemax="100"
                      ></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
</div>
@endsection

@push('page-js')
<!-- Chart JS -->
<script src="{{asset('assets/libs/chart.js/Chart.bundle.min.js')}}"></script>
@endpush
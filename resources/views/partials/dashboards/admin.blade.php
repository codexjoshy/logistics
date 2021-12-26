<div class="row">
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
              Registered Companies</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              {{$registerdCompanies}}
            </div>
          </div>
          <div class="col-auto">
            <i class="fa fa-user fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Pending Requests Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
              Pool Requests</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$pending}}</div>
          </div>
          <div class="col-auto">
            <i class="fa fa-comments fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <x-base.card title="Dasboard">
      {{ __('You are logged in!') }}
      <p class="my-3">Click the link below to verify registered companies</p>
      <p>
        <a target="_blank" href="https://apps.firs.gov.ng/tinverification/">Verification Link</a>
      </p>
    </x-base.card>
  </div>
</div>
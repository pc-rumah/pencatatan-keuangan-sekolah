<div class="col-12 col-lg-3">
    <div class="card">
        <div class="card-body py-4 px-5">
            <div class="d-flex align-items-center">
                <div class="avatar avatar-xl">
                    <img src="assets/images/faces/1.jpg" alt="Face 1">
                </div>
                <div class="ms-3 name">
                    <h5 class="font-bold"> {{ auth()->user()->name }} </h5>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4>Info</h4>
        </div>

        @props(['deviceinfo' => []])

        <div class="card-content pb-4">
            <div class="recent-message d-flex px-4 py-3">
                <div class="avatar avatar-lg">
                    <img src="assets/images/faces/4.jpg">
                </div>
                <div class="name ms-4">
                    <h5 class="mb-1">Device</h5>
                    <h6 class="text-muted mb-0"> {{ $deviceinfo['device'] ?? '-' }} </h6>
                </div>
            </div>
            <div class="recent-message d-flex px-4 py-3">
                <div class="avatar avatar-lg">
                    <img src="assets/images/faces/5.jpg">
                </div>
                <div class="name ms-4">
                    <h5 class="mb-1">OS</h5>
                    <h6 class="text-muted mb-0"> {{ $deviceinfo['platform'] ?? '-' }} </h6>
                </div>
            </div>
            <div class="recent-message d-flex px-4 py-3">
                <div class="avatar avatar-lg">
                    <img src="assets/images/faces/1.jpg">
                </div>
                <div class="name ms-4">
                    <h5 class="mb-1">Browser</h5>
                    <h6 class="text-muted mb-0"> {{ $deviceinfo['browser'] ?? '-' }} </h6>
                </div>
            </div>
        </div>
    </div>
</div>

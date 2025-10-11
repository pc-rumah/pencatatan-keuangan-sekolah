<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - @yield('title')</title>

    @include('adminPanel.includes.style')
</head>

<body>
    <div id="app">
        <x-adminPanel.sidebar />

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>Statistics</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-9">

                        <x-adminPanel.stat :siswa="$siswa" :lunas="$lunas" :belumlunas="$belumlunas" :total="$total" />

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Pendapatan Perbulan</h4>
                                    </div>
                                    <div class="card-body">
                                        <div id="chart-profile-visit"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <x-adminPanel.userInfo :deviceinfo="$deviceinfo" />

                </section>
            </div>

            <x-adminPanel.footer />
        </div>
    </div>

    @include('adminPanel.includes.script')
</body>

</html>

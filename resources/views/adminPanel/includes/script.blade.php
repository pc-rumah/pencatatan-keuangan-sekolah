<script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendors/apexcharts/apexcharts.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script>
    var optionsProfileVisit = {
        annotations: {
            position: 'back'
        },
        dataLabels: {
            enabled: false
        },
        chart: {
            type: 'bar',
            height: 300
        },
        fill: {
            opacity: 1
        },
        series: [{
            name: 'Pendapatan',
            data: @json($dataBulan)
        }],
        colors: '#435ebe',
        xaxis: {
            categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        },
    }

    var chartProfileVisit = new ApexCharts(
        document.querySelector("#chart-profile-visit"),
        optionsProfileVisit
    );
    chartProfileVisit.render();
</script>

<script>
    document.getElementById('yearNow').innerHTML = new Date().getFullYear();
</script>

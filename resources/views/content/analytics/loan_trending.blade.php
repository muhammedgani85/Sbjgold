@extends('layouts/contentNavbarLayout')

@section('title', 'Customer Management')

@section('page-script')
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection

<meta name="csrf-token" content="{{ csrf_token() }}">


<!-- Include other styles here -->
@section('content')
<h4 class="py-0 mb-4">
  <span class="text-muted fw-light" style="color:red !important;">Loans</span>
</h4>

<div class="row">





  <div class="card">
    <div class="table-responsive text-nowrap">

    <div>
    <h3>Loan Amount Trend</h3>
    <canvas id="loanWaveChart" width="400" height="200"></canvas>
</div>




  </div>
</div>


</div>


<script>
  document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById("loanWaveChart").getContext("2d");

    // Fetch data from the backend
    fetch("{{ route('loan.wave.data') }}")
        .then(response => response.json())
        .then(data => {
            // Prepare data for the chart
            const labels = data.map(item => new Date(item.date)); // Convert date strings to JavaScript Date objects
            const amounts = data.map(item => parseFloat(item.total_amount)); // Parse amount to float

            // Create the Chart.js wave line chart
            new Chart(ctx, {
                type: "line",
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: "Loan Amount",
                            data: amounts,
                            borderColor: "rgba(75, 192, 192, 1)",
                            backgroundColor: "rgba(75, 192, 192, 0.2)",
                            tension: 0.4, // Smooth curve
                            fill: true,
                        },
                    ],
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: "top",
                        },
                        tooltip: {
                            mode: "index",
                            intersect: false,
                        },
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: "Date",
                            },
                            type: 'time', // Use time scale for the X-axis
                            time: {
                                unit: 'day', // Set the unit to day
                                tooltipFormat: 'll', // Format tooltips
                            },
                        },
                        y: {
                            title: {
                                display: true,
                                text: "Loan Amount",
                            },
                            ticks: {
                                beginAtZero: true,
                            },
                        },
                    },
                },
            });
        })
        .catch(error => console.error("Error fetching data:", error));
});



</script>

















@endsection

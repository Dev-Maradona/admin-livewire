<div class="col-12 col-md-6 col-xxl-3 d-flex order-2 order-xxl-3">
    <div class="card flex-fill w-100">
        <div class="card-header">
            <h5 class="card-title mb-0">Browser Usage</h5>
        </div>
        <div class="card-body d-flex">
            <div class="align-self-center w-100">
                <div class="py-3">
                    <div class="chart chart-xs">
                        <canvas id="chartjs-dashboard-pie"></canvas>
                    </div>
                </div>

                <table class="table mb-0">
                    <tbody>
                        <tr>
                            <td>Chrome</td>
                            <td class="text-end">4306</td>
                        </tr>
                        <tr>
                            <td>Firefox</td>
                            <td class="text-end">3801</td>
                        </tr>
                        <tr>
                            <td>IE</td>
                            <td class="text-end">1689</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Pie chart
        new Chart(document.getElementById("chartjs-dashboard-pie"), {
            type: "pie",
            data: {
                labels: ["Chrome", "Firefox", "IE"],
                datasets: [{
                    data: [4306, 3801, 1689],
                    backgroundColor: [
                        window.theme.primary,
                        window.theme.warning,
                        window.theme.danger
                    ],
                    borderWidth: 5
                }]
            },
            options: {
                responsive: !window.MSInputMethodContext,
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                cutoutPercentage: 75
            }
        });
    });
</script>
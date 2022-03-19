<div class="col-12 col-md-6 col-xxl-3 d-flex order-1 order-xxl-1">
    <div class="card flex-fill">
        <div class="card-header">

            <h5 class="card-title mb-0">Calendar</h5>
        </div>
        <div class="card-body d-flex">
            <div class="align-self-center w-100">
                <div class="chart">
                    <div id="datetimepicker-dashboard"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var date = new Date(Date.now() - 5 * 24 * 60 * 60 * 1000);
        var defaultDate = date.getUTCFullYear() + "-" + (date.getUTCMonth() + 1) + "-" + date.getUTCDate();
        document.getElementById("datetimepicker-dashboard").flatpickr({
            inline: true,
            prevArrow: "<span title=\"Previous month\">&laquo;</span>",
            nextArrow: "<span title=\"Next month\">&raquo;</span>",
            defaultDate: defaultDate
        });
    });
</script>
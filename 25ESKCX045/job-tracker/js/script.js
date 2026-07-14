$(document).ready(function () {

    // Auto hide flash messages
    setTimeout(function () {
        $('.alert').fadeOut('slow');
    }, 4000);

    // Jobs Page Search
    if ($("#search").length) {

        $("#search").on("keyup", function () {

            $.ajax({
                url: "ajax_search.php",
                type: "GET",
                data: {
                    q: $(this).val()
                },
                success: function (response) {
                    $("#jobsTable").html(response);
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });

        });

    }

    // Status Filter
    if ($("#statusFilter").length) {

        $("#statusFilter").on("change", function () {

            $.ajax({
                url: "ajax_filter.php",
                type: "GET",
                data: {
                    status: $(this).val()
                },
                success: function (response) {
                    $("#jobsTable").html(response);
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });

        });

    }

});
$(document).ready(function () {
    $('#searchName').on("keyup", function () {
        let searchName = $('#searchName').val();
        $.ajax({
            url: "/showAllStudentList",
            type: "get",
            data: {search: searchName},
            success: function (data) {
                let result = $(data).find('#listStd tbody').html();
                $('#listStd tbody').html(result);
            }
        });
    });
});
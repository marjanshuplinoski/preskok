$(document).ready(function () {
    $("#getFolderAndFiles").click(function () {
        $.ajax({
            cache: false,
            async: true,
            type: 'POST',
            url: 'getFolderAndFiles.php',
            dataType: 'text',
            data: {
                action: 'getFolderAndFiles'
            },
            success: function (result) {
                $("#getFolderAndFilesResult").html(result);
            }
        });
    });
});

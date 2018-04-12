$(document).ready(function () {
    $("#getFolderAndFiles").click(function () {
        $.ajax({
            cache: false,
            async: true,
            type: 'POST',
            url: 'ajaxAction.php',
            dataType: 'text',
            data: {
                action: 'getFolderAndFilesPreview'
            },
            success: function (result) {
                $("#getFolderAndFilesResult").html(result);
                treeView();
            }
        });
    });

    $("#checkUploadedToS3").click(function () {
        $.ajax({
            cache: false,
            async: true,
            type: 'POST',
            url: 'ajaxAction.php',
            dataType: 'text',
            data: {
                action: 'checkUploadedToS3'
            },
            success: function (result) {
                $("#checkUploadedToS3Result").html(result);
                treeView();
                uploadToS3Cloud();
            }
        });
    });

    $("#checkDownloadedFromS3").click(function () {
        $.ajax({
            cache: false,
            async: true,
            type: 'POST',
            url: 'ajaxAction.php',
            dataType: 'text',
            data: {
                action: 'checkDownloadedFromS3'
            },
            success: function (result) {
                $("#checkDownloadedFromS3Result").html(result);
                treeView();
                downloadFromS3Cloud();
            }
        });
    });

    $("#SQLFiles").click(function () {
        $.ajax({
            cache: false,
            async: true,
            type: 'POST',
            url: 'ajaxAction.php',
            dataType: 'text',
            data: {
                action: 'SQLFiles'
            },
            success: function (result) {
                $("#SQLFilesResult").html(result);
            }
        });
    });

    $("#parserData").click(function () {
        $.ajax({
            cache: false,
            async: true,
            type: 'POST',
            url: 'ajaxAction.php',
            dataType: 'text',
            data: {
                action: 'parserData'
            },
            success: function (result) {
                $("#parserDataResult").html(result);
            }
        });
    });

    $("#createTable").click(function () {
        $.ajax({
            cache: false,
            async: true,
            type: 'POST',
            url: 'ajaxAction.php',
            dataType: 'text',
            data: {
                action: 'createTable'
            },
            success: function (result) {
                $("#createTableResult").html(result);
            }
        });
    });

    function uploadToS3Cloud(){
        $("#uploadToS3Cloud").click(function () {
            $.ajax({
                cache: false,
                async: true,
                type: 'POST',
                url: 'ajaxAction.php',
                dataType: 'text',
                data: {
                    action: 'uploadToS3Cloud'
                },
                success: function (result) {
                    $("#checkUploadedToS3Result").html(result);
                }
            });
        });
    }
    function downloadFromS3Cloud(){
        $("#downloadFromS3Cloud").click(function () {
            $.ajax({
                cache: false,
                async: true,
                type: 'POST',
                url: 'ajaxAction.php',
                dataType: 'text',
                data: {
                    action: 'downloadFromS3Cloud'
                },
                success: function (result) {
                    $("#checkDownloadedFromS3Result").html(result);
                }
            });
        });
    }
    function treeView (){
        $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
        $('.tree li.parent_li > span').on('click', function (e) {
            var children = $(this).parent('li.parent_li').find(' > ul > li');
            if (children.is(":visible")) {
                children.hide('fast');
                $(this).attr('title', 'Expand this branch').find(' > i').addClass('icon-plus-sign').removeClass('icon-minus-sign');
            } else {
                children.show('fast');
                $(this).attr('title', 'Collapse this branch').find(' > i').addClass('icon-minus-sign').removeClass('icon-plus-sign');
            }
            e.stopPropagation();
        });
    }
});
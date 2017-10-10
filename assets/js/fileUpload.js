$(function () {
    $('#upload_file_package').submit(function (e) {
        e.preventDefault();
        missionId = $(this).data('missionId');
        $.each($('#userfile_package').prop("files"), function (k, v) {
            filename = v['name'];
        });

        fileUploadSubmit(filename, "package", missionId);

    });
});
$(function () {
    $('#upload_file_social').submit(function (e) {
        e.preventDefault();
        missionId = $(this).data('missionId');
        $.each($('#userfile_social').prop("files"), function (k, v) {
            filename = v['name'];
        });

        fileUploadSubmit(filename, "social", missionId);

    });
});
$(function () {
    $('#upload_file_relocation').submit(function (e) {
        e.preventDefault();
        missionId = $(this).data('missionId');
        $.each($('#userfile_relocation').prop("files"), function (k, v) {
            filename = v['name'];
        });

        fileUploadSubmit(filename, "relocation", missionId);

    });
});


function fileUploadSubmit(filename, type, missionId) {
    $.ajaxFileUpload({
        url: base_url + 'missions/upload_file/',
        secureuri: false,
        fileElementId: 'userfile_'+type,
        dataType: 'json',
        data: {
            'title': filename,
            'type': type,
            'mission_id': missionId
        },
        success: function (data, status) {
            if (data.status != 'error') {
                /*if(type == "package") {
                    $('#files_package').html('<p>Reloading files...</p>');
                    refresh_files(type, missionId);
                    refresh_date(type, missionId);
                    $('#package-action-form').fadeOut();
                    refresh_action(type, missionId);
                    refresh_user(type, missionId);
                }
                if(type == "social") {
                    $('#files_social').html('<p>Reloading files...</p>');
                    refresh_files(type, missionId);
                    refresh_date(type, missionId);
                    $('#social-action-form').fadeOut();
                    refresh_action(type, missionId);
                    refresh_user(type, missionId);
                }
                if(type == "relocation") {
                    $('#files_relocation').html('<p>Reloading files...</p>');
                    refresh_files(type, missionId);
                    refresh_date(type, missionId);
                    $('#relocation-action-form').fadeOut();
                    refresh_action(type, missionId);
                    refresh_user(type, missionId);
                }*/
				location.reload();

            }
            alert(data.msg);
        }
    });
    return false;
}

function refresh_files(type, missionId) {
    $.post(base_url + 'missions/files/', { type: type, mission_id: missionId } )
        .success(function (data) {
            if(type == "package") {
                $('#files_package').html(data);
            }
            if(type == "social") {
                $('#files_social').html(data);
            }
            if(type == "relocation") {
                $('#files_relocation').html(data);
            }
        });
}

function refresh_date(type, missionId) {
    $.post(base_url + 'missions/date/', { type: type, mission_id: missionId } )
        .success(function (data) {
            if(type == "package") {
                $('#date-package').html(data);
            }
            if(type == "social") {
                $('#date-social').html(data);
            }
            if(type == "relocation") {
                $('#date-relocation').html(data);
            }
        });
}

function refresh_user(type, missionId) {
    $.post(base_url + 'missions/userrefresh/', { type: type, mission_id: missionId } )
        .success(function (data) {
            if(type == "package") {
                $('.package-user').html(data);
            }
            if(type == "social") {
                $('.social-user').html(data);
            }
            if(type == "relocation") {
                $('.relocation-user').html(data);
            }
        });
}

function refresh_action(type, missionId) {
    $.post(base_url + 'missions/actionrefresh/', { type: type, mission_id: missionId } )
        .success(function (data) {
            if(type == "package") {
                $('#package-action').html(data);
            }
            if(type == "social") {
                $('#social-action').html(data);
            }
            if(type == "relocation") {
                $('#relocation-action').html(data);
            }
        });
}

$(document).on('click', '.delete_file_link', function (e) {
    e.preventDefault();
    if (confirm(LANG['confirm_delete_file'])) {
        var link = $(this);
        delete_refresh(link);
    }
});


function delete_refresh(link){

    //alert(link.data('file_id'));
    type = link.data('type');
    missionId = link.data('mission_id');

    $.ajax({
        url: base_url + 'missions/delete_file/' + link.data('file_id'),
        dataType: 'json',
        success: function (data) {
            if (data.status === "success") {

                //TODO[CL] majd egyszer be kéne fejezni az ajaxos törlést
                /*refresh_files(type, missionId);
                refresh_date(type, missionId);
                refresh_action(type, missionId);*/
                location.reload();
            }
            else {
                alert(data.msg);
            }
        }
    });
}
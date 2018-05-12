$(function () {
    var console = new consoleApp();
    console.init();
});

function consoleApp() {
    var thisApp = this;
    this.init = function () {
        thisApp.get_dw();
        this.get_admin_by_id();
        thisApp.get_adopters();

        //add department worker
        $('#addDWform').submit(function (e) {
            e.preventDefault();
            thisApp.addDW();
        });
        //update department worker
        $('#updateDWForm').submit(function (e) {
            e.preventDefault();
            var id = $(this).attr("data-id");
            thisApp.updateDW(id);
        });
        //changePasswordDw
        $('#changePasswordDw').submit(function (e) {
            e.preventDefault();
            var id = $('#updateDWForm').attr("data-id");
            thisApp.changeDWPassword(id);
        });
        //changeDWImage
        $('#changeImageDw').submit(function (e) {
            e.preventDefault();
            var id = $('#updateDWForm').attr("data-id");
            // thisApp.changeDWImage(id);
            var formSettings = {
                "type": "POST",
                "headers": {
                    "cache-control": "no-cache",
                    "mimeType": "multipart/form-data"
                },
                processData: false, // tell jQuery not to process the data
                contentType: false, // tell jQuery not to set contentType
                "data": new FormData(this),
                "url": "api/department_worker/photo/" + id,
            };

            $.ajax(formSettings).success(function (response) {
                if (response.status == 'failed' || response.status == 'error') {
                    console.log(JSON.stringify(response));
                    notify("Failed to save data, please try again :" + JSON.stringify(response), "warning");
                } else if (response.status == 'success') {
                    console.log(JSON.stringify(response));
                    notify("Data updated", "success");
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);

                } else {

                }

            });
        });
        $('#profileForm').submit(function (e) {
            e.preventDefault();
            var id = $(this).attr("data-id");
            thisApp.updateProfile(id);
        });
        $('.logoutBtn').click(function (e) {
            e.preventDefault();
            thisApp.logout();
        });

        //delete 
        $('#dwMenu .items').on('click', '.deleteDWBtn', function (e) {
            e.preventDefault();
            var id = $(this).attr("data-id");
            var cc = confirm("Do you want to Delete");
            if (cc == true) {
                thisApp.deleteDW(id);
            }
        });

        //deleteAdopterBtn
        $('#adoptersMenu .items').on('click', '.deleteAdopterBtn', function (e) {
            e.preventDefault();
            var id = $(this).attr("data-id");
            var cc = confirm("Do you want to Delete");
            if (cc == true) {
                thisApp.deleteAdopter(id);
            }
        });
    }
    this.addDW = function () {
        var name = $('#addDWform .name').val();
        var username = $('#addDWform .username').val();
        var gender = $('#addDWform .gender').val();
        var telephone = $('#addDWform .telephone').val();
        var email_address = $('#addDWform .email').val();
        var password = $('#addDWform .password').val();

        var formdata = {
            "name": name,
            "username": username,
            "gender": gender,
            "telephone": telephone,
            "email_address": email_address,
            "password": password
        };

        console.log(JSON.stringify(formdata));
        var formSettings = {
            "type": "POST",
            //"dataType": "json",
            "data": formdata,
            "url": "api/department_worker",
        };

        $.ajax(formSettings).success(function (response) {
            if (response.status == 'failed' || response.status == 'error') {
                console.log(JSON.stringify(response));
                notify("Failed to save data, please try again :" + JSON.stringify(response), "warning");
            } else if (response.status == 'success') {

                thisApp.get_dw();
                console.log(JSON.stringify(response));
                notify("Data updated", "success");
                setTimeout(function () {
                    window.location.reload();
                }, 2000);

            } else {

            }

        });
    }
    this.updateDW = function (id) {
        var name = $('#updateDWForm .name').val();
        var gender = $('#updateDWForm .gender').val();
        var telephone = $('#updateDWForm .telephone').val();
        var email_address = $('#updateDWForm .email_address').val();

        var formdata = {
            "name": name,
            "gender": gender,
            "telephone": telephone,
            "email_address": email_address
        };

        console.log(JSON.stringify(formdata));
        var formSettings = {
            "type": "POST",
            //"dataType": "json",
            "data": formdata,
            "url": "api/department_worker/update/" + id,
        };

        $.ajax(formSettings).success(function (response) {
            if (response.status == 'failed' || response.status == 'error') {
                console.log(JSON.stringify(response));
                notify("Failed to save data, please try again :" + JSON.stringify(response), "warning");
            } else if (response.status == 'success') {

                thisApp.get_dw();
                console.log(JSON.stringify(response));
                notify("Data updated", "success");
                setTimeout(function () {
                    window.location.reload();
                }, 2000);

            } else {

            }

        });
    }
    this.changeDWPassword = function (id) {
        var password = $('#changePasswordDw .password').val();
        var formdata = {
            "password": password
        };

        console.log(JSON.stringify(formdata));
        var formSettings = {
            "type": "POST",
            //"dataType": "json",
            "data": formdata,
            "url": "api/department_worker/password/" + id,
        };

        $.ajax(formSettings).success(function (response) {
            if (response.status == 'failed' || response.status == 'error') {
                console.log(JSON.stringify(response));
                notify("Failed to save data, please try again :" + JSON.stringify(response), "warning");
            } else if (response.status == 'success') {
                console.log(JSON.stringify(response));
                notify("Data updated", "success");
                setTimeout(function () {
                    window.location.reload();
                }, 2000);

            } else {

            }

        });
    }
    this.changeDWImage = function (id) {
        // var image = $('#changeImageDw .image').val();

        console.log(JSON.stringify(new FormData(this)));
        var formSettings = {
            "type": "POST",
            "headers": {
                "cache-control": "no-cache",
                "mimeType": "multipart/form-data"
            },
            processData: false, // tell jQuery not to process the data
            contentType: false, // tell jQuery not to set contentType
            "data": new FormData(this),
            "url": "api/department_worker/photo/" + id,
        };

        $.ajax(formSettings).success(function (response) {
            if (response.status == 'failed' || response.status == 'error') {
                console.log(JSON.stringify(response));
                notify("Failed to save data, please try again :" + JSON.stringify(response), "warning");
            } else if (response.status == 'success') {
                console.log(JSON.stringify(response));
                notify("Data updated", "success");
                setTimeout(function () {
                    window.location.reload();
                }, 2000);

            } else {

            }

        });
    }
    this.logout = function () {
        notify("Signing out...", "success");
        var formsSettings = {
            "type": "GET",
            "dataType": "json",
            "url": "api/logout"
        };
        $.ajax(formsSettings).success(function (response) {
            window.location.reload();
        });
    }
    this.updateProfile = function (id) {
        var full_names = $('#profileForm .full_names').val();
        var email = $('#profileForm .email').val();
        var formdata = {
            "full_names": full_names,
            "email": email
        };

        console.log(JSON.stringify(formdata));
        var formSettings = {
            "type": "POST",
            //"dataType": "json",
            "data": formdata,
            "url": "api/sys_admin/update/" + id,
        };

        $.ajax(formSettings).success(function (response) {
            if (response.status == 'failed' || response.status == 'error') {
                console.log(JSON.stringify(response));
                notify("Failed to save data, please try again :" + JSON.stringify(response), "warning");
            } else if (response.status == 'success') {

                thisApp.get_dw();
                console.log(JSON.stringify(response));
                notify("Data updated", "success");
                setTimeout(function () {
                    window.location.reload();
                }, 2000);

            } else {

            }

        });
    }
    this.get_dw = function () {
        var formsSettings = {
            "type": "GET",
            "dataType": "json",
            "url": "api/department_worker"
        };

        $.ajax(formsSettings).success(function (response) {
            $("#dwMenu .items").html("");
            if (response.status == 'failed' || response.status == 'error') {
                notify("Failed to get department worker data", "warning");

            } else if (response.status == 'success') {
                console.log(JSON.stringify(response));
                var appendData = "";
                $.each(response.data, function (key, value) {
                    var gender = "";
                    if (value.gender == "1" || value.gender == 1) {
                        gender = "Male";
                    } else if (value.gender == "2" || value.gender == 2) {
                        gender = "Female";
                    } else {
                        gender = "N/A";
                    }
                    appendData += '<tr><td>' + value.id + '</td>' +
                        '<td>' + value.name + '</td>' +
                        '<td>' + value.username + '</td>' +
                        '<td>' + gender + '</td>' +
                        '<td>' + value.telephone + '</td>' +
                        '<td>' + value.email_address + '</td>' +
                        '<td>' +
                        '<button title="Delete" data-id="' + value.id + '" class="btn btn-xs btn-default deleteDWBtn">' +
                        '<i class="fas fa-trash"></i></button>' +
                        '<button title="Update" data-id="' + value.id + '" data-toggle="modal" class="update_dw btn btn-xs btn-default" data-target="#updateDW">' +
                        '<i class="fas fa-pencil-alt"></i>' +
                        '</button>' +
                        '</td>' +
                        ' </tr>';
                });
                $("#dwMenu .items").html(appendData);
                $("#dwMenu .items .update_dw").click(function (e) {
                    e.preventDefault();
                    var id = $(this).attr("data-id");
                    thisApp.get_dw_by_id(id);
                });

            }

        });
    }
    this.get_adopters = function () {
        var formsSettings = {
            "type": "GET",
            "dataType": "json",
            "url": "api/adopter"
        };

        $.ajax(formsSettings).success(function (response) {
            $("#adoptersMenu .items").html("");
            if (response.status == 'failed' || response.status == 'error') {
                notify("Failed to get data", "warning");

            } else if (response.status == 'success') {
                console.log(JSON.stringify(response));
                var appendData = "";
                $.each(response.data, function (key, value) {
                    var gender = "";
                    if (value.gender == "1" || value.gender == 1) {
                        gender = "Male";
                    } else if (value.gender == "2" || value.gender == 2) {
                        gender = "Female";
                    } else {
                        gender = "N/A";
                    }
                    appendData += '<tr><td>' + value.id + '</td>' +
                        '<td>' + value.first_name + ' ' + value.middle_name + ' ' + value.last_name + '</td>' +
                        '<td>' + value.username + '</td>' +
                        '<td>' + gender + '</td>' +
                        '<td>' + value.telephone + '</td>' +
                        '<td>' + value.email_address + '</td>' +
                        '<td>' + value.residence + '</td>' +
                        '<td>' + value.nationality + '</td>' +
                        '<td>' +
                        '<button title="Delete" data-id="' + value.id + '" class="btn btn-xs btn-default deleteAdopterBtn">' +
                        '<i class="fas fa-trash"></i></button>' +
                        '</td>' +
                        ' </tr>';
                });
                $("#adoptersMenu .items").html(appendData);
            }

        });
    }
    this.get_dw_by_id = function (id) {
        var formsSettings = {
            "type": "GET",
            "dataType": "json",
            "url": "api/department_worker/" + id
        };

        $.ajax(formsSettings).success(function (response) {
            $("#updateDWForm")[0].reset();
            if (response.status == 'failed' || response.status == 'error') {
                notify("Failed to get department worker data", "warning");

            } else if (response.status == 'success') {
                console.log(JSON.stringify(response));
                var appendData = "";
                $.each(response.data, function (key, value) {
                    $("#updateDWForm .name").val(value.name);
                    $("#updateDWForm .gender").val(value.gender);
                    $("#updateDWForm .email_address").val(value.email_address);
                    $("#updateDWForm .telephone").val(value.telephone);
                    $("#updateDWForm").attr("data-id", value.id);
                    $("#changeImageDw .img").attr("src", "./uploads/"+value.image);
                });
            }

        });
    }
    this.deleteDW = function (id) {
        var formsSettings = {
            "type": "DELETE",
            "dataType": "json",
            "url": "api/department_worker/delete/" + id
        };

        $.ajax(formsSettings).success(function (response) {
            if (response.status == 'failed' || response.status == 'error') {
                notify("Failed to get department worker data", "warning");

            } else if (response.status == 'success') {
                console.log(JSON.stringify(response));
                notify("Department Worker has been deleted", "success");
                setTimeout(function () {
                    window.location.reload();
                }, 2000);
            }

        });
    }

    this.deleteAdopter = function (id) {
        var formsSettings = {
            "type": "DELETE",
            "dataType": "json",
            "url": "api/adopter/delete/" + id
        };

        $.ajax(formsSettings).success(function (response) {
            if (response.status == 'failed' || response.status == 'error') {
                notify("Failed to get data", "warning");

            } else if (response.status == 'success') {
                console.log(JSON.stringify(response));
                notify("Adopter has been deleted", "success");
                setTimeout(function () {
                    window.location.reload();
                }, 2000);
            }

        });
    }
    this.get_admin_by_id = function () {
        var id = $("#profileForm").attr("data-id");
        var formsSettings = {
            "type": "GET",
            "dataType": "json",
            "url": "api/sys_admin/" + id
        };

        $.ajax(formsSettings).success(function (response) {
            $("#profileForm")[0].reset();
            if (response.status == 'failed' || response.status == 'error') {
                notify("Failed to get department worker data", "warning");

            } else if (response.status == 'success') {
                console.log(JSON.stringify(response));
                var appendData = "";
                $.each(response.data, function (key, value) {
                    $("#profileForm .full_names").val(value.full_names);
                    $("#profileForm .email").val(value.email);
                    // $("#profileForm").attr("data-id",value.id);
                });
            }

        });
    }
}
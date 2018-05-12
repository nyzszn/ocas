$(function () {
    var console = new consoleApp();
    console.init();
});

function consoleApp() {
    var thisApp = this;
    this.init = function () {
        //list all my applications
        thisApp.listMyApplications();
        thisApp.listChildren();
        thisApp.get_profle();

        //logout
        $('.logoutBtn').click(function (e) {
            e.preventDefault();
            thisApp.logout();
        });

        $('#profileForm').submit(function (e) {
            e.preventDefault();
            var id = $(this).attr("data-id");
            thisApp.updateProfile(id);
        });

         //changePasswordDw
     $('#changePasswordAdopter').submit(function (e) {
        e.preventDefault();
        var id = $('#profileForm').attr("data-id");
        thisApp.changeAdopterPassword(id);
    });

        $('#changeImageAdopter').submit(function (e) {
            e.preventDefault();
            var id = $('#profileForm').attr("data-id");
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
                "url": "api/adopter/photo/" + id,
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
		$('#adoptForm').submit(function(e){
			e.preventDefault();
			var dataChild=$(this).attr("data-child");
			thisApp.Apply(dataChild);
		});
    }
    this.changeAdopterPassword = function (id) {
        var password = $('#changePasswordAdopter .password').val();
        var formdata = {
            "password": password
        };

        console.log(JSON.stringify(formdata));
        var formSettings = {
            "type": "POST",
            //"dataType": "json",
            "data": formdata,
            "url": "api/adopter/password/" + id,
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
    this.get_profle = function () {
        var id = $("#profileForm").attr("data-id");
        var formsSettings = {
            "type": "GET",
            "dataType": "json",
            "url": "api/adopter/" + id
        };

        $.ajax(formsSettings).success(function (response) {
            $("#profileForm")[0].reset();
            if (response.status == 'failed' || response.status == 'error') {
                notify("Loading", "warning");

            } else if (response.status == 'success') {
                console.log(JSON.stringify(response));
                var appendData = "";
                $.each(response.data, function (key, value) {
                    $("#profileForm .first_name").val(value.first_name);
                    $("#profileForm .middle_name").val(value.middle_name);
                    $("#profileForm .last_name").val(value.last_name);
                    $("#profileForm .telephone").val(value.telephone);
                    $("#profileForm .residence").val(value.residence);
                    $("#profileForm .email_address").val(value.email_address);
                    $("#profileForm .nationality").val(value.nationality);
                    $("#profileForm .gender").val(value.gender);
                    $("#changeImageAdopter .img").attr("src", "./uploads/"+value.user_image);
                });
            }

        });
    }
    this.updateProfile = function (id) {
        var first_name = $("#profileForm .first_name").val();
        var middle_name = $("#profileForm .middle_name").val();
        var last_name = $("#profileForm .last_name").val();
        var telephone = $("#profileForm .telephone").val();
        var residence = $("#profileForm .residence").val();
        var email_address = $("#profileForm .email_address").val();
        var nationality = $("#profileForm .nationality").val();
        var gender = $("#profileForm .gender").val();
        var formdata = {
            "first_name": first_name,
            "last_name": last_name,
            "middle_name": middle_name,
            "telephone": telephone,
            "residence": residence,
            "email_address": email_address,
            "nationality": nationality,
            "gender": gender
        };

        console.log(JSON.stringify(formdata));
        var formSettings = {
            "type": "POST",
            //"dataType": "json",
            "data": formdata,
            "url": "api/adopter/update/" + id,
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

        }).error(function(response){
            console.log(JSON.stringify(response));
        });
    }
    this.listMyApplications = function () {
        var myId = $('.profileForm').attr("data-id");
        var formsSettings = {
            "type": "GET",
            "dataType": "json",
            "url": "api/adoptions/adopter/" + myId
        };
        console.log(myId);

        $.ajax(formsSettings).success(function (response) {
            $("#adoptionsMenu .items").html("");
            if (response.status == 'failed' || response.status == 'error') {
                notify("Application Data not available", "warning");

            } else if (response.status == 'success') {
                console.log(JSON.stringify(response));
                var appendData = "";
                $.each(response.data, function (key, value) {
                    var status = "";
					var state="active";
                    if (value.status == "1" || value.status == 1) {
                        status = "Review";
                    } else if (value.status == "2" || value.status == 2) {
                        status = "Approved";
						state="disabled";
                    } 
                    else if (value.status == "3" || value.status == 3) {
                        status = "Declined";
                    }
                    else {
                        status = "Pending";
                    }
                    appendData += '<tr><td>' + value.id + '</td>' +
                        '<td>' + value.child_f+' '+value.child_l+ '</td>' +
                        //  '<td>' + value.department_worker_id + '</td>' +
                        '<td>' + value.remarks + '</td>' +
                        '<td>' + status + '</td>' +
                        '<td>' +
                        '<button title="Delete" data-id="' + value.id + '" '+state+' class="btn btn-xs btn-danger deleteBtn">' +
                        'Cancel</button>' +
                        '</td>' +
                        ' </tr>';
                });
                $("#adoptionsMenu .items").html(appendData);

                $("#adoptionsMenu .items .deleteBtn").click(function (e) {
                    e.preventDefault();
                    var id = $(this).attr("data-id");
                    var cc = confirm("Do you want to Delete");
                    if (cc == true) {
                        thisApp.cancelApp(id);
                    }
                   
                });

            }

        });

    }
    this.Apply = function (child_id) {
        var myId = $('.profileForm').attr("data-id");
		var marital = $('#adoptForm .marital').val();
		var proffession = $('#adoptForm .proffession').val();
		var income = $('#adoptForm .income').val();
		var reason = $('#adoptForm .reason').val();
		var language = $('#adoptForm .language').val();
		
        var formdata = {
            "adopter_id": myId,
            "child_id": child_id,
			"marital":marital,
			"proffession":proffession,
			"income":income,
			"reason":reason,
			"language":language
        };

        console.log(JSON.stringify(formdata));
        var formSettings = {
            "type": "POST",
            //"dataType": "json",
            "data": formdata,
            "url": "api/adopt",
        };

        $.ajax(formSettings).success(function (response) {
            if (response.status == 'failed' || response.status == 'error') {
                console.log(JSON.stringify(response));
                notify("Failed to save data, please try again :" + JSON.stringify(response), "warning");
            } else if (response.status == 'success') {

                //thisApp.get_dw();
                console.log(JSON.stringify(response));
                notify("Child Application has been submitted", "success");
                setTimeout(function () {
                    window.location.reload();
                }, 2000);

            } else {

            }

        }).error(function(response){
            console.log(JSON.stringify(response));
        });
    }
    this.cancelApp = function (appId) {
        // console.log(JSON.stringify(formdata));
        var formSettings = {
            "type": "DELETE",
            //"dataType": "json",
            // "data": formdata,
            "url": "api/adoption/delete/" + appId,
        };

        $.ajax(formSettings).success(function (response) {
            if (response.status == 'failed' || response.status == 'error') {
                console.log(JSON.stringify(response));
                notify("Failed to save data, please try again :" + JSON.stringify(response), "warning");
            } else if (response.status == 'success') {

                // thisApp.get_dw();
                console.log(JSON.stringify(response));
                notify("Application has been canceled and removed", "success");
                setTimeout(function () {
                    window.location.reload();
                }, 2000);

            } else {

            }

        });


    }
    this.listChildren = function () {
        var formsSettings = {
            "type": "GET",
            "dataType": "json",
            "url": "api/child"
        };

        $.ajax(formsSettings).success(function (response) {
            $("#childMenu").html("");
            if (response.status == 'failed' || response.status == 'error') {
                notify("Children data is not yet available", "warning");

            } else if (response.status == 'success') {
                console.log(JSON.stringify(response));
                var appendData = "";
                $.each(response.data, function (key, value) {
                    appendData +='<div class="col-md-12 adoptions">'+
                    '<div class="img" style="background-image:url(./uploads/'+value.user_image+')">'+
                    '</div>'+
                    '<div class="content">'+
                        '<h5>Name: ' + value.first_name +' '+value.middle_name+' '+value.last_name+' </h5>'+
                        '<p>Id:' + value.id + ' </p>'+
                        '<p>Gender: ' + value.sex + '</p>'+
                        '<p>Date of birth: ' + value.date_of_birth + '</p>'+
                        '<p>Date added: ' + value.date_added + '</p>'+
                        '<button data-toggle="modal" data-target="#adoptModal" title="Adopt" data-id="' + value.id + '"class="AdoptBtn btn btn-xs btn-default">Adopt</button>' +
                    '</div>'+
                '</div>';
                });
                $("#childMenu").html(appendData);
               
                $("#childMenu .AdoptBtn").click(function (e) {
                    e.preventDefault();
                    var id = $(this).attr("data-id");
					$('#adoptForm').attr('data-child',id);
                    //thisApp.Apply(id);
                }); 

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

}
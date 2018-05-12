$(function () {
    var console = new consoleApp();
    console.init();
});

function consoleApp() {
    var thisApp = this;
    this.init = function () {
        thisApp.get_myApps();
        thisApp.get_pending_adoption();
        thisApp.get_children();
      this.get_dw_by_id();
      $('#profileForm').submit(function (e) {
        e.preventDefault();
        var id = $(this).attr("data-id");
        thisApp.updateProfile(id);
    });
    $('.logoutBtn').click(function (e) {
        e.preventDefault();
        thisApp.logout();
    });
    //add department worker
    $('#addChildform').submit(function (e) {
        e.preventDefault();
        thisApp.addChild();
    });
    $('#updateChildForm').submit(function (e) {
        e.preventDefault();
        var id = $(this).attr("data-id");
        thisApp.updateChild(id);
    });
    //deleteAdopterBtn
    $('#childMenu .items').on('click', '.deleteBtn', function (e) {
        e.preventDefault();
        var id = $(this).attr("data-id");
        var cc = confirm("Do you want to Delete");
        if (cc == true) {
            thisApp.deleteChild(id);
        }
    });
     
     //changePasswordDw
     $('#changePasswordDw').submit(function (e) {
        e.preventDefault();
        var id = $('#profileForm').attr("data-id");
        thisApp.changeDWPassword(id);
    });
    //changeDWImage
    $('#changeImageDw').submit(function (e) {
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
    //changeDWImage
    $('#changeImageChild').submit(function (e) {
        e.preventDefault();
        var id = $('#updateChildForm').attr("data-id");
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
            "url": "api/child/photo/" + id,
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

    }
     
    this.addChild = function () {
        var first_name = $('#addChildform .first_name').val();
        var middle_name = $('#addChildform .middle_name').val();
        var last_name = $('#addChildform .last_name').val();
        var sex = $('#addChildform .sex').val();
        var date_of_birth = $('#addChildform .date_of_birth').val();
        var about = $('#addChildform .about').val();
        

        var formdata = {
            "first_name": first_name,
            "middle_name": middle_name,
            "last_name": last_name,
            "sex": sex,
            "date_of_birth": date_of_birth,
            "about": about
        };

        console.log(JSON.stringify(formdata));
        var formSettings = {
            "type": "POST",
            //"dataType": "json",
            "data": formdata,
            "url": "api/child/register",
        };

        $.ajax(formSettings).success(function (response) {
            if (response.status == 'failed' || response.status == 'error') {
                console.log(JSON.stringify(response));
                notify("Failed to save data, please try again :" + JSON.stringify(response), "warning");
            } else if (response.status == 'success') {

                //thisApp.get_dw();
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
    this.get_child_by_id = function (id) {
        //var id = $("#updateChild").attr("data-id");
        var formsSettings = {
            "type": "GET",
            "dataType": "json",
            "url": "api/child/" + id
        };

        $.ajax(formsSettings).success(function (response) {
            $("#updateChildForm")[0].reset();
            $("#updateChildForm").attr("data-id",id)
            if (response.status == 'failed' || response.status == 'error') {
                notify("Child data not available", "warning");

            } else if (response.status == 'success') {
                console.log(JSON.stringify(response));
                var appendData = "";
                $.each(response.data, function (key, value) {
                    $("#updateChildForm .first_name").val(value.first_name);
                    $("#updateChildForm .last_name").val(value.last_name);
                    $("#updateChildForm .middle_name").val(value.middle_name);
                    $("#updateChildForm .sex").val(value.sex);
                    $("#updateChildForm .date_of_birth").val(value.date_of_birth);
                    $("#updateChildForm .about").val(value.about);
                    $("#changeImageChild .img").attr("src", "./uploads/"+value.user_image);
                    // $("#profileForm").attr("data-id",value.id);
                });
            }

        });
    }
    this.updateChild = function (id) {
        var first_name = $('#updateChildForm .first_name').val();
        var middle_name = $('#updateChildForm .middle_name').val();
        var last_name = $('#updateChildForm .last_name').val();
        var sex = $('#updateChildForm .sex').val();
        var date_of_birth = $('#updateChildForm .date_of_birth').val();
        var about = $('#updateChildForm .about').val();

        var formdata = {
            "first_name": first_name,
            "middle_name": middle_name,
            "last_name": last_name,
            "sex": sex,
            "date_of_birth": date_of_birth,
            "about": about
        };

        console.log(JSON.stringify(formdata));
        var formSettings = {
            "type": "POST",
            //"dataType": "json",
            "data": formdata,
            "url": "api/child/update/" + id,
        };

        $.ajax(formSettings).success(function (response) {
            if (response.status == 'failed' || response.status == 'error') {
                console.log(JSON.stringify(response));
                notify("Failed to save data, please try again :" + JSON.stringify(response), "warning");
            } else if (response.status == 'success') {

               // thisApp.get_dw();
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
        var name = $('#profileForm .name').val();
        var email = $('#profileForm .email').val();
        var telephone = $('#profileForm .telephone').val();
        var gender = $('#profileForm .gender').val();
        var formdata = {
            "name": name,
            "email_address": email,
            "telephone": telephone,
            "gender": gender,

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

               // thisApp.get_dw();
                console.log(JSON.stringify(response));
                notify("Data updated", "success");
                setTimeout(function () {
                    window.location.reload();
                }, 2000);

            } else {

            }

        });
    }
    this.get_children = function () {
        var formsSettings = {
            "type": "GET",
            "dataType": "json",
            "url": "api/child/all"
        };

        $.ajax(formsSettings).success(function (response) {
            $("#childMenu .items").html("");
            if (response.status == 'failed' || response.status == 'error') {
                notify("Department Worker Data not availbale", "warning");

            } else if (response.status == 'success') {
                console.log(JSON.stringify(response));
                var appendData = "";
                $.each(response.data, function (key, value) {
                    var sex = "";
					var adopted ="";
                    if (value.sex == "1" || value.sex == 1) {
                        sex = "Male";
                    } else if (value.sex == "2" || value.sex == 2) {
                        sex = "Female";
                    } else {
                        sex = "N/A";
                    }
					
					if (value.adopted == "2" || value.adopted == 2) {
                        adopted = "Adopted";
                    } else {
                        adopted = "Available";
                    }
                    appendData += '<tr><td>' + value.id + '</td>' +
                        '<td>' + value.first_name +' '+value.middle_name+' '+value.last_name+' </td>' +
                        '<td>' + sex + '</td>' +
                        '<td>' + value.date_of_birth + '</td>' +
                        '<td>' + value.date_added + '</td>' +
						'<td>' + adopted + '</td>' +
                        '<td>' +
                        '<button title="Delete" data-id="' + value.id + '"class="deleteBtn btn btn-xs btn-default">' +
                        '<i class="fas fa-trash"></i>' +
                        '</button>' +
                        '<button title="Update" data-id="' + value.id + '" data-toggle="modal" class="update_child btn btn-xs btn-default" data-target="#updateChild">' +
                        '<i class="fas fa-pencil-alt"></i>' +
                        '</button>' +
                        '</td>' +
                        ' </tr>';
                });
                $("#childMenu .items").html(appendData);
                $("#childMenu .items .update_child").click(function (e) {
                    e.preventDefault();
                    var id = $(this).attr("data-id");
                    thisApp.get_child_by_id(id);
                });

            }

        });
    }
    this.get_myApps = function () {
        var id = $('#profileForm').attr("data-id");
        var formsSettings = {
            "type": "GET",
            "dataType": "json",
            "url": "api/adoptions/"+id
        };

        $.ajax(formsSettings).success(function (response) {
            $("#myAppMenu .items").html("");
            if (response.status == 'failed' || response.status == 'error') {
                notify("Department worker data not available", "warning");

            } else if (response.status == 'success') {
                console.log(JSON.stringify(response));
                var appendData = "";
                $.each(response.data, function (key, value) {
                    var status = "";
                    if (value.status == "1" || value.status == 1) {
                        status = "Review";
                    } else if (value.status == "2" || value.status == 2) {
                        status = "Approved";
                    } 
                    else if (value.status == "3" || value.status == 3) {
                        status = "Declined";
                    }
                    else {
                        status = "Pending";
                    }
                    appendData += '<tr><td>' + value.id + '</td>' +
                        '<td>' + value.adopter_f+' '+ value.adopter_l+' '+ value.adopter_m+ '</td>' +
                        '<td>' + value.child_f+' '+ value.child_l+' '+ value.child_m+ '</td>' +
                        '<td>' + status + '</td>' +
                        '<td>' + value.remarks + '</td>' +
                        '<td>' +
                        '<button title="Update" data-id="' + value.id + '" data-toggle="modal" class="update_App btn btn-xs btn-default" data-target="#appModal">' +
                        '<i class="fas fa-pencil-alt"></i>' +
                        '</button>' +
                        '</td>' +
                        ' </tr>';
                });
                $("#myAppMenu .items").html(appendData);
                $("#myAppMenu .items .update_App").click(function (e) {
                    e.preventDefault();
                    var id = $(this).attr("data-id");
                    thisApp.get_app_by_id(id);
                });

            }

        });
    }
    this.get_pending_adoption = function () {
        var formsSettings = {
            "type": "GET",
            "dataType": "json",
            "url": "api/adoptions"
        };

        $.ajax(formsSettings).success(function (response) {
            $("#pendingAppMenu .items").html("");
            if (response.status == 'failed' || response.status == 'error') {
                notify("There are no available adoptions", "warning");

            } else if (response.status == 'success') {
                console.log(JSON.stringify(response));
                var appendData = "";
                $.each(response.data, function (key, value) {
                    var status = "";
                    if (value.status == "1" || value.status == 1) {
                        status = "Review";
                    } else if (value.status == "2" || value.status == 2) {
                        status = "Approved";
                    } 
                    else if (value.status == "3" || value.status == 3) {
                        status = "Declined";
                    }
                    else {
                        status = "Pending";
                    }
                    var status = "";
                    if (value.status == "1" || value.status == 1) {
                        status = "Review";
                    } else if (value.status == "2" || value.status == 2) {
                        status = "Approved";
                    } 
                    else if (value.status == "3" || value.status == 3) {
                        status = "Declined";
                    }
                    else {
                        status = "Pending";
                    }
                    appendData += '<tr><td>' + value.id + '</td>' +
                    '<td>' + value.adopter_f+' '+ value.adopter_l+' '+ value.adopter_m+ '</td>' +
                    '<td>' + value.child_f+' '+ value.child_l+' '+ value.child_m+ '</td>' +
                    '<td>' + status + '</td>' +
                    '<td>' + value.remarks + '</td>' +
                        '<td>' +
                        '<button title="Update" data-id="' + value.id + '" data-toggle="modal" class="update_App btn btn-xs btn-default" data-target="#appModal">' +
                        '<i class="fas fa-pencil-alt"></i>' +
                        '</button>' +
                        '</td>' +
                        ' </tr>';
                });
                $("#pendingAppMenu .items").html(appendData);
                $('.update_App').click( function(e){
                    e.preventDefault();
                    var id = $(this).attr("data-id");
                    thisApp.get_app_by_id(id);
                })
            }

        });
    }

    this.deleteChild = function (id) {
        var formsSettings = {
            "type": "DELETE",
            "dataType": "json",
            "url": "api/child/delete/" + id
        };

        $.ajax(formsSettings).success(function (response) {
            if (response.status == 'failed' || response.status == 'error') {
                notify("Failed to get Child data", "warning");

            } else if (response.status == 'success') {
                console.log(JSON.stringify(response));
                notify("Child has been deleted", "success");
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
    this.get_dw_by_id = function () {
        var id = $("#profileForm").attr("data-id");
        var formsSettings = {
            "type": "GET",
            "dataType": "json",
            "url": "api/department_worker/" + id
        };

        $.ajax(formsSettings).success(function (response) {
            $("#profileForm")[0].reset();
            if (response.status == 'failed' || response.status == 'error') {
                notify("Failed to get department worker data", "warning");

            } else if (response.status == 'success') {
                console.log(JSON.stringify(response));
                var appendData = "";
                $.each(response.data, function (key, value) {
                    $("#profileForm .name").val(value.name);
                    $("#profileForm .gender").val(value.gender);
                    $("#profileForm .email").val(value.email_address);
                    $("#profileForm .telephone").val(value.telephone);
                    // $("#profileForm").attr("data-id",value.id);
                    $("#changeImageDw .img").attr("src", "./uploads/"+value.image);
                });
            }

        });
    }

    this.get_app_by_id = function (id) {
        var formsSettings = {
            "type": "GET",
            "dataType": "json",
            "url": "api/adoption/" + id
        };

        $.ajax(formsSettings).success(function (response) {
            if (response.status == 'failed' || response.status == 'error') {
                notify("Failed to get department worker data", "warning");

            } else if (response.status == 'success') {
                console.log(JSON.stringify(response));
                $('#appForm').html("");
                var appendData = "";
                $.each(response.data, function (key, value) {
                    var child_gender = "";
                    if (value.child_gender == "1" || value.child_gender == 1) {
                        child_gender = "Male";
                    } else if (value.child_gender == "2" || value.child_gender == 2) {
                        child_gender = "Female";
                    } else {
                        child_gender = "N/A";
                    }
                    var adopter_gender = "";
                    if (value.adopter_gender == "1" || value.adopter_gender == 1) {
                        adopter_gender = "Male";
                    } else if (value.adopter_gender == "2" || value.adopter_gender == 2) {
                        adopter_gender = "Female";
                    } else {
                        adopter_gender = "N/A";
                    }
                    var status = "";
                    if (value.status == "1" || value.status == 1) {
                        status = "Review";
                    } else if (value.status == "2" || value.status == 2) {
                        status = "Approved";
                    } 
                    else if (value.status == "3" || value.status == 3) {
                        status = "Declined";
                    }
                    else {
                        status = "Pending";
                    }
                    appendData ='<div class="col-md-6 child" style="border-right:1px solid #000;">'+
                '<img src="./uploads/'+value.child_image+'" class="img img-circle img-responsive"/>'+
                '<p>Name: '+value.child_f+' '+value.child_l+'</p>'+
                '<p>Gender: '+child_gender+'</p>'+
                '<p>Date of birth: '+value.c_date_of_birth+'</p>'+
                '<p>date added: '+value.date_added+'</p>'+
                '</div>'+
                '<div class="col-md-6 adopter">'+
                '<img src="./uploads/'+value.adopter_image+'" class="img img-circle img-responsive"/>'+
                '<p>Name: '+value.adopter_f+' '+value.adopter_l+'</p>'+
                '<p>Telephone:'+value.telephone+' </p>'+
                '<p>Residence: '+value.residence+'</p>'+
                '<p>Nationality: '+value.nationality+'</p>'+
                '<p>Gender: '+adopter_gender+'</p>'+
										'<p>Marital Status: ' + value.marital + '</p>'+
						'<p>Proffession: ' + value.proffession + '</p>'+
						'<p>Monthly Income: ' + value.income + '</p>'+
						'<p>Reason: ' + value.reason + '</p>'+
						'<p>Language: ' + value.language + '</p>'+
                '</div>'+
                '<br>'+
                 
                '</div>'+
                '<div class="row">'+
                '<div class="col-md-12">'+
                '<p class="alert alert-warning">Application Status : <span class="status"> '+status+'</span>'+
                '</p></div>'+
                    '<div class="col-md-12 options">'+
                    '<Button type="button" data-id="'+value.id+'" data-value="1" data-child="'+value.child_id+'" data-adopter="'+value.adopter_id+'" class="Review btn btn-default">Review &nbsp; <span class="fas fa-edit"> </span></Button> &nbsp; '+
                    '<Button type="button" data-id="'+value.id+'" data-value="2" data-child="'+value.child_id+'" data-adopter="'+value.adopter_id+'" class="Accepted btn btn-success">Accept &nbsp; <span class="fas fa-check-circle"> </span></Button> &nbsp; '+
                    '<Button type="button" data-id="'+value.id+'" data-value="3" data-child="'+value.child_id+'" data-adopter="'+value.adopter_id+'" class="Decline btn btn-danger">Decline &nbsp; <span class="fas fa-times"> </span></Button> &nbsp; '+
                   '</div>';
                });
                $('#appForm').html(appendData);
                $('.options button').click(function(e){
                    e.preventDefault();
                    var id = $(this).attr("data-id");
					var adopter = $(this).attr("data-adopter");
					var child = $(this).attr("data-child");
                    var status = $(this).attr("data-value");
                    thisApp.updateApp(id, status, adopter, child);
                });
            }

        });
    }
    this.updateApp = function(id, status, adopter, child){
        var dwid = $('.profileForm').attr("data-id");
		var adopter_id="";
		var remarks ="";
		if(status ==2 || status =="2"){
			remarks ="Already Adopted";
		}else{
			remarks="On Going";
		}
        var formdata = {
            "status": status,
            "department_worker_id": dwid,
            "remarks": remarks,
			"child":child,
			"adopter":adopter
        };

        console.log(JSON.stringify(formdata));
        var formSettings = {
            "type": "POST",
            //"dataType": "json",
            "data": formdata,
            "url": "api/adoption/update/" + id,
        };

        $.ajax(formSettings).success(function (response) {
            if (response.status == 'failed' || response.status == 'error') {
                console.log(JSON.stringify(response));
                notify("Failed to save data, please try again :" + JSON.stringify(response), "warning");
            } else if (response.status == 'success') {

               // thisApp.get_dw();
                console.log(JSON.stringify(response));
                notify("Data updated", "success");
                setTimeout(function () {
                  window.location.reload();
                }, 2000);

            } else {

            }

        });
    }

}
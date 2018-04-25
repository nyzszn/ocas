$(function () {
    var sysAdmin = new sysApp();
    sysAdmin.init();
});

function sysApp() {
    var thisApp = this;
    this.init = function () {
        $('.adminLogin').submit(function(e){
            e.preventDefault();
            thisApp.login();
        });
    }
    this.login = function(){
        var username = $('.adminLogin .username').val();
        var password = $('.adminLogin .password').val();
        var loginType = $('.adminLogin .loginType').val();
    
        var formdata = {
            "username": username,
            "password": password,
        };
        //alert(JSON.stringify(formdata));
        var LoginSettings={};
        if(loginType=='1'|| loginType ==1){
            var LoginSettings = {
                "type": "POST",
                //"dataType": "json",
                "data": formdata,
                "url": "api/sys_admin/login"
            };
        }
        else if(loginType=='2'|| loginType ==2){
            var LoginSettings = {
                "type": "POST",
                //"dataType": "json",
                "data": formdata,
                "url": "api/department_worker/login"
            };
        }
       
    
        $.ajax(LoginSettings).success(function (response) {
            console.log("Hello");
            if (response.status == 'failed' || response.status == 'error') {
                console.log(JSON.stringify(response));
                notify(response.message, "warning");
            } else if (response.status == 'success') {
                $('.adminLogin')[0].reset();
                console.log(JSON.stringify(response));
                notify("Signing in", "success");
               // setTimeout(function () {
                    window.location.reload();
                //}, 5000);
                //window.location.href = "codinator.php";
            } else {
                console.log("Else "+JSON.stringify(response));
            }
    
        }).error(function(response){
            console.log(JSON.stringify(response));
        });
    }

    this.logout = function(){

    }
    
}
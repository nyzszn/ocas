$(function () {
    NProgress.start();
    var kyobe = new App();
    kyobe.init();
});

function App() {
    var thisApp = this;
    this.loader = function(){
        $(document).ajaxSend(function () {
            $('.loader').fadeIn();
            NProgress.configure({
                showSpinner: true
            });
            NProgress.start();
            $('#nprogress .bar').css({
                'background': 'rgba(141,121,174,1)'
            });
            $('#nprogress .peg').css({
                'box-shadow': '0 0 10px rgba(141,121,174,1), 0 0 5px rgba(141,121,174,1)'
            });
            $('#nprogress .spinner-icon').css({
                'border-top-color': '#fff',
                'border-left-color': '#fff'
            });
    
        });
    }
    this.init = function () {
        console.log("We see you like to see whats under the hood: go to http://www.nnyanziian.com to learn more about how we develop websites");
        thisApp.clAOS();
        thisApp.activateTab();
        NProgress.done();
    }
    this.clAOS = function () {
        AOS.init({
            offset: 150,
            duration: 500,
            easing: 'ease-in-sine',
            delay: 100,
            once: false,
            disable: 'mobile'
        });
    }
    this.gallery = function(){
        $('.gallaria').magnificPopup({
            delegate: 'a',
            type: 'image',
            tLoading: 'Loading image #%curr%...',
            mainClass: 'mfp-img-mobile',
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0,1] // Will preload 0 - before current, and 1 after the current image
            },
            image: {
                tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                titleSrc: function(item) {
                    return item.el.attr('title') + '<small>by Kyobe Safaris</small>';
                }
            }
        });
    }
    this.loadCat = function(){
        var pk = this;
        var settings = {
            "type": "GET",
            "dataType": "json",
            "url": "./c-load.php"
        }
        $.ajax(settings).success(function (response) {
            $(".cat").html("");
               console.log(JSON.stringify(response));
                var appendData = "";
                $.each(response, function (key, value) {
                    appendData += '<a class="btn btn-default" data-load="'+value+'" href="#">'+
                    '<i class="fas fa-tag"> </i> &nbsp; '+value+'</a> &nbsp; &nbsp; ';
                });
                var other = '<a class="btn btn-default" data-load="/" href="#">'+
                '<i class="fas fa-tag"> </i> &nbsp;Home</a> &nbsp; &nbsp; ';
                $(".cat").html(other+appendData);
                $('.cat a').click(function(e){
                    e.preventDefault();
                var cat= $(this).attr('data-load');
                    pk.loadImages(cat);
                });
        });
    }
    this.loadImages = function(cat=''){
        var settings={};

        if(cat.length>0){
            var settings = {
                "type": "GET",
                "dataType": "json",
                "url": "./g-loader.php?cat="+cat
            }
        }
        else{
            var settings = {
                "type": "GET",
                "dataType": "json",
                "url": "./g-loader.php"
            }
        }
        
        $.ajax(settings).success(function (response) {
            $(".gallaria").html("");
               console.log(JSON.stringify(response));
                var appendData = "";
                $.each(response, function (key, value) {
                    appendData += '<a class="group_s" href="'+value+'" title="Source">'+
                    '<img src="'+value+'">'+
                    '<div class="caption_g">'+
                    '<p>Kyobe Safaris Ug</p>'+
                    '</div>'+
                '</a>';
                });
                $(".gallaria").html(appendData);
        });
    }
    this.activateTab = function () {
        var currentLoc = window.location.pathname;
        if (currentLoc == '/' || currentLoc == '/ocas/') {
            $('.home-link').addClass('active');
        } else if (currentLoc == '/adopt.php' || currentLoc == '/ocas/adopt.php') {
            $('.adopt-link').addClass('active');
        } else if (currentLoc == '/safaris.php' || currentLoc == '/ocas/safaris.php') {
            $('.safaris-link').addClass('active');

            
        }else if (currentLoc == '/account.php' || currentLoc == '/ocas/account.php') {
            $('.account-link').addClass('active');

            
        }
        else if (currentLoc == '/gallery.php' || currentLoc == '/ocas/gallery.php') {
            $('.gallery-link').addClass('active');

            
        } else {
            console.log("curent page is not located on the menu bar "+currentLoc);
        }
    }
}

function notify(textM, type) {
    $('.notification').fadeOut();

    if (type === "error") {
        mType = "#errorNot";
    } else if (type === "success") {
        mType = "#successNot";
    } else if (type === "warning") {
        mType = "#warnNot";
    } else {
        console.log("Error on Notify Plugin (var type)");
    }
    $(mType).slideDown(function () {

        $(mType + " p").text('');
        $(mType + " p").text(textM);

        $(mType).click(function () {
            $(this).slideUp();

        });
        setTimeout(function () {
            $(mType).slideUp();
        }, 5000);
    });
}
window.onload = function () {
    $(document).ready(function() {
        setTimeout(function(){
            document.getElementById('loader').classList.add('fade-out');
            document.getElementById('footer').classList.remove('hide');
            document.getElementById('footer').classList.add('fade-in');
            $(".loader").addClass('hide');
        }, 200);
    });

    setTimeout(function () {
        if (document.location.pathname == "/") {
            console.log("Hey, you still here? try " + document.location.href + "cv 😀");
        } else {
            console.log("Nothing to see here 🙄");
        }
    }, 25000);
};

setBackgroundImage();

particlesJS.load('particles-js', '/particles-config.json');

function setBackgroundImage() {
    $('body').attr('style', 'background-image: url(/images/' + getRandomImageId() + '.jpg');
}

function getRandomImageId(){

    var randomNumber = Math.floor((Math.random() * 5) + 1);

    switch (randomNumber){
        case 1:
            return 992;
            break;
        case 2:
            return 911;
            break;
        case 3:
            return 901;
            break;
        case 4:
            return 974;
            break;
        case 5:
            return 765;
            break;

        default:
            return 1;
    }
}

$(".locale-flags").on( "click", function() {
    $("#footer").addClass("fade-out");
    $("#footer").removeClass("fade-in");

    $("#loader").addClass("fade-in");
    $("#loader").removeClass("fade-out");

    $(".loader").removeClass("hide");

});

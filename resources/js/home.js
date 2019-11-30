window.onload = function () {
    document.getElementById('loader').classList.add('loaded');
    setTimeout(function(){
        document.getElementById('loader').classList.add('hide');
        document.getElementById('loader').classList.remove('loader');
    }, 300);
};

setBackgroundImage();

particlesJS.load('particles-js', '/particles-config.json', function() {
    console.log('Loaded Particles!');
});

function setBackgroundImage() {
    $('body').attr('style', 'background-image: url(images/' + getRandomImageId() + '.jpg');
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

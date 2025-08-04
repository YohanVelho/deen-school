import { Slider } from "./../components/slider"

function init(){
    home_slider();
}

function home_slider(){
    new Slider('js-test',{
        autoplay: true,
        autoplaySpeed: 5000
    })
}

$(function() {
    init();
});

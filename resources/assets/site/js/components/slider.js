export function Slider(identifier, options) {
    options = options || {};
    return $(".slider-" + identifier).slick(
        Object.assign(
            {
                prevArrow: $(".slider-" + identifier + "-prev"),
                nextArrow: $(".slider-" + identifier + "-next"),
                appendDots: $(".slider-" + identifier + "-pagination"),
                dots: false,
                arrows: false,
                customPaging: () => {
                    return '<a href="javascript:void(0)"></a>';
                }
            },
            options
        )
    );
}


const mix = require("laravel-mix");

mix.browserSync('http://localhost:8000');

if (mix.inProduction()) mix.version();

mix.disableNotifications();


/**
 * SITE
 */

mix.sass(
    "resources/assets/site/sass/main.scss",
    "public/assets/site/css/main.css"
);

mix.copy(
    [
        "node_modules/slick-carousel/slick/slick.css"
    ],
    "public/assets/site/css/vendor.css"
);

mix.js(
    [
        "resources/assets/site/js/main.js",
    ],
    "public/assets/site/js/main.js"
);

mix.js(
    "resources/assets/site/js/pages/home.js",
    "public/assets/site/js/pages/home.js"
);

mix.scripts(
    [
        "node_modules/jquery/dist/jquery.js",
        "node_modules/slick-carousel/slick/slick.js"
    ],
    "public/assets/site/js/vendor.js"
);

mix.copyDirectory(
    "resources/assets/site/images",
    "public/assets/site/images"
);

mix.copyDirectory(
    "resources/assets/site/fonts",
    "public/assets/site/fonts"
);


/**
 * ADMIN
 */

mix.sass(
    "resources/assets/admin/sass/main.scss",
    "public/assets/admin/css/all.css"
);

mix.styles(
    [
        "resources/assets/admin/vendor/argon/css/argon.min.css"
    ],
    "public/assets/admin/css/vendor.css"
);

mix.scripts(
    [
        "resources/assets/admin/vendor/argon/js/argon.min.js"
    ],
    "public/assets/admin/js/vendor.js"
);

mix.scripts(
    [
        "resources/assets/admin/js/components/action.js",
        "resources/assets/admin/js/components/gallery.js",
        "resources/assets/admin/js/components/table.js",
        "resources/assets/admin/js/components/tags.js",
        "resources/assets/admin/js/components/translate.js",
        "resources/assets/admin/js/components/translatable.js",
        "resources/assets/admin/js/components/card.js",
        "resources/assets/admin/js/main.js",
    ],
    "public/assets/admin/js/all.js"
);


mix.copyDirectory(
    "resources/assets/admin/images",
    "public/assets/admin/images"
);

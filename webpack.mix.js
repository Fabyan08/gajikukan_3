const mix = require("laravel-mix");

// mix.styles(
//     [
//         "resources/assets-dashboard/modules/bootstrap/css/bootstrap.min.css",
//         "resources/assets-dashboard/modules/fontawesome/css/all.min.css",
//         "resources/assets-dashboard/modules/jqvmap/dist/jqvmap.min.css",
//         "resources/assets-dashboard/modules/summernote/summernote-bs4.css",
//         "resources/assets-dashboard/modules/owlcarousel2/dist/assets/owl.carousel.min.css",
//         "resources/assets-dashboard/modules/owlcarousel2/dist/assets/owl.theme.default.min.css",
//         "resources/assets-dashboard/modules/datatables/datatables.min.css",
//         "resources/assets-dashboard/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css",
//         "resources/assets-dashboard/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css",
//         "resources/assets-dashboard/css/style.css",
//         "resources/assets-dashboard/css/components.css",
//     ],
//     "public/css/app.css"
// );

let plugins = [
    "bootstrap",
    "flag-icon-css",
    "jqvmap",
    "summernote",
    "owl.carousel",
    "weathericons",
    "jquery",
    "jquery-ui-dist",
    "jquery-sparkline",
    "popper.js",
    "jquery.nicescroll",
    "tooltip.js",
    "moment",
    "summernote",
    "chocolat",
    "chart.js",
    "simpleweather",
    "prismjs",
    "dropzone",
    "bootstrap-social",
    "cleave.js",
    "bootstrap-daterangepicker",
    "bootstrap-colorpicker",
    "bootstrap-timepicker",
    "bootstrap-tagsinput",
    "select2",
    "selectric",
    "codemirror",
    "fullcalendar",
    "datatables",
    "ionicons201",
    "sweetalert",
    "izitoast",
    "weathericons",
    "gmaps",
];

plugins.forEach((plugin) => {
    mix.copy("./node_modules/" + plugin, "public/library/" + plugin);
});

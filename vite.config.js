import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/assets-dashboard/modules/bootstrap/css/bootstrap.min.css",
                "resources/assets-dashboard/modules/fontawesome/css/all.min.css",

                "resources/assets-dashboard/modules/jqvmap/dist/jqvmap.min.css",
                "resources/assets-dashboard/modules/summernote/summernote-bs4.css",
                "resources/assets-dashboard/modules/owlcarousel2/dist/assets/owl.carousel.min.css",
                "resources/assets-dashboard/modules/owlcarousel2/dist/assets/owl.theme.default.min.css",

                "resources/assets-dashboard/modules/datatables/datatables.min.css",
                "resources/assets-dashboard/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css",
                "resources/assets-dashboard/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css",

                "resources/assets-dashboard/css/style.css",
                "resources/assets-dashboard/css/components.css",

                // Javascript
                "resources/assets-dashboard/modules/jquery.min.js",
                "resources/assets-dashboard/modules/popper.js",
                "resources/assets-dashboard/modules/tooltip.js",
                "resources/assets-dashboard/modules/bootstrap/js/bootstrap.min.js",
                "resources/assets-dashboard/modules/nicescroll/jquery.nicescroll.min.js",
                "resources/assets-dashboard/modules/moment.min.js",
                "resources/assets-dashboard/js/stisla.js",

                "resources/assets-dashboard/modules/jquery.sparkline.min.js",
                "resources/assets-dashboard/modules/chart.min.js",
                "resources/assets-dashboard/modules/owlcarousel2/dist/owl.carousel.min.js",
                "resources/assets-dashboard/modules/summernote/summernote-bs4.js",
                "resources/assets-dashboard/modules/jquery-ui/jquery-ui.min.js",
                "resources/assets-dashboard/modules/codemirror/lib/codemirror.js",
                "resources/assets-dashboard/modules/codemirror/mode/javascript/javascript.js",
                "resources/assets-dashboard/modules/jquery-selectric/jquery.selectric.min.js",
                "resources/assets-dashboard/modules/datatable/datatables.min.js",
                "resources/assets-dashboard/modules/datatable/DataTables-1.10.16/js/dataTables.bootstrap4.min.js",
                "resources/assets-dashboard/modules/datatable/Select-1.2.4/js/dataTables.select.min.js",
                "resources/assets-dashboard/modules/bootstrap-daterangepicker/daterangepicker.js",
                "resources/assets-dashboard/modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js",
                "resources/assets-dashboard/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js",
                "resources/assets-dashboard/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js",

                "resources/assets-dashboard/js/scripts.js",
                "resources/assets-dashboard/js/custom.js",
            ],
            refresh: true,
        }),
    ],
});

<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <script src="/es6-shim/es6-shim.min.js"></script>
        <script src="/systemjs/dist/system-polyfills.js"></script>
        <script src="/angular2/es6/dev/src/testing/shims_for_IE.js"></script>

        <script src="/angular2/bundles/angular2-polyfills.js"></script>
        <script src="/systemjs/dist/system.src.js"></script>
        <script src="/rxjs/bundles/Rx.js"></script>
        <script src="/angular2/bundles/angular2.dev.js"></script>

        <script>
            System.config({
                "defaultJSExtensions": true,
                packages: {
                  typescript: {
                        format: 'register',
                        defaultExtension: 'js'
                    }
                }
            });

            System.import('typescript/boot')
                .then(null, console.error.bind(console));
        </script>

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Laravel 5</div>
                <my-app>Loading</my-app>
            </div>
        </div>
    </body>
</html>

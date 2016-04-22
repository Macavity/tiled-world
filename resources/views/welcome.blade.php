<!DOCTYPE html>
<html>
    <head>
      <title>Laravel</title>
      
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

      <!-- Optional theme -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

      <!-- Latest compiled and minified JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        
      
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

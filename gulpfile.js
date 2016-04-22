var elixir = require('laravel-elixir');
var elixirTypescript = require('elixir-typescript');



elixir(function(mix) {
    /**
     * Sass
     */
    mix.sass('app.scss');

    /**
     * Vendor libraries
     */
    mix.copy('node_modules/angular2', 'public/angular2');
    mix.copy('node_modules/rxjs', 'public/rxjs');
    mix.copy('node_modules/systemjs', 'public/systemjs');
    mix.copy('node_modules/es6-promise', 'public/es6-promise');
    mix.copy('node_modules/es6-shim', 'public/es6-shim');
    mix.copy('node_modules/zone.js', 'public/zone.js');

    /**
     * Typescript
     */
    mix.typescript(
        'app.js',
        'public/',
        '/**/*.ts', {
            "target": "ES5",
            "module": "system",
            "moduleResolution": "node",
            "sourceMap": true,
            "emitDecoratorMetadata": true,
            "experimentalDecorators": true,
            "removeComments": false,
            "noImplicitAny": false
        }
    );


});
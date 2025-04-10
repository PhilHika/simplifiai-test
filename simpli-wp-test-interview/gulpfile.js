const autoprefixer = require( 'autoprefixer' ),
    concat = require( 'gulp-concat' ),
    cssnano = require( 'cssnano' ),
    footer = require( 'gulp-footer' ),
    gulp = require( 'gulp' ),
    header = require( 'gulp-header' ),
    mqpacker = require( 'css-mqpacker' ),
    path = require( 'path' ),
    postcss = require( 'gulp-postcss' ),
    replace = require( 'gulp-replace' ),
    sass = require( 'gulp-sass' )( require( 'sass' ) ),
    sassVariables = require( 'gulp-sass-variables' );

const buildInclude = [
    path.resolve( __dirname, './*.+(txt|php)' ), // All files in the root.
    path.resolve( __dirname, './src/**/*.php' ), // Only PHP files in our source files, others will be compiled into dist.
    path.resolve( __dirname, './src/**/block.json' ), // Allow block metadata files.
    path.resolve( __dirname, './dist/**' ),
    path.resolve( __dirname, './freemius/**' ),
    path.resolve( __dirname, './languages/**' ),
    path.resolve( __dirname, './images/**' ),
    path.resolve( __dirname, './src/welcome/images/**' ), // Welcome screen / settings images.
    '!' + path.resolve( __dirname, './dist/videos/**' ), // Help tooltip videos.
    '!' + path.resolve( __dirname, './dist/**/*.js.map' ), // JS Map files.
    '!' + path.resolve( __dirname, './dist/**/*.js.map' ), // JS Map files.
    '!' + path.resolve( __dirname, './src/__*/**/*' ), // Development templates.
]

const postCSSOptions = [
    autoprefixer(),
    mqpacker(), // Combine media query rules.
    cssnano(), // Minify.
]

const sassOptions = {
    includePaths: [
        path.resolve( __dirname, './src/' ),
        path.resolve( __dirname, './src/styles' ),
        './node_modules',
    ],
}

module.exports = {
    buildInclude,
    postCSSOptions,
    sassOptions,
}
gulp.task( 'style-editor', function() {
    return gulp.src( [ path.resolve( __dirname, './src/**/editor.scss' ), '!' + path.resolve( __dirname, './src/deprecated/**/editor.scss' ) ] )
        .pipe( sassVariables( {
            '$desktop-width': 781,
            '$tablet-width': 361,
        } ) )
        .pipe( sass( sassOptions ).on( 'error', sass.logError ) )
        .pipe( concat( 'editor_blocks.css' ) )
        .pipe( header( '#start-resizable-editor-section{display:none}' ) )
        .pipe( postcss( postCSSOptions ) )
        .pipe( footer( '#end-resizable-editor-section{display:none}' ) )
        .pipe( replace( /.z\s?{\s?opacity:\s?1;?}/g, '' ) )
        .pipe( gulp.dest( 'build/' ) )
} );
gulp.task( 'build-process', gulp.parallel( 'style-editor' ) );
gulp.task( 'build', gulp.series( 'build-process' ) );


const watchFuncs = ( basePath = '.' ) => {
    gulp.watch(
        [ `${ basePath }/src/**/*.scss` ],
        gulp.parallel( [ 'style-editor' ] )
    )
}

gulp.task( 'watch', gulp.series( 'build-process', function watch( done ) {
    watchFuncs();
    done();
} ) );

module.exports.watchFuncs = watchFuncs
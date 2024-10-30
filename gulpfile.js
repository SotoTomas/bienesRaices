
//1. Importación de funciones de Gulp
const {src, dest, watch, parallel, series} = require('gulp');
 

//Plugins de Gulp para CSS
const sass = require('gulp-sass')(require('sass'));
const cssnano = require('cssnano');
const postcss = require('gulp-postcss');

//Plugins de Gulp para JavaScript
const autoPrefixer = require('autoprefixer');
const sourcemaps = require('gulp-sourcemaps');
const concat = require('gulp-concat');
const terser = require('gulp-terser-js');

//Plugins de Gulp para Imágenes
const webp =require('gulp-webp');
const imagemin = require('gulp-imagemin');
const cache = require('gulp-cache');
const avif = require('gulp-avif');

//Configuración de Rutas
const path = {
    scss: 'src/scss/**/*.scss',
    css: 'build/css/app.css',
    js: 'src/js/**/*.js',
    img: 'src/img/**/*.{jpg,png}',
    imgmin: 'build/img/**/*.{jpg,png}',
}
 
//Tarea para Compilar Sass
function compileSass() {
    return src(path.scss)
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(postcss([autoPrefixer(),cssnano()]))
        .pipe(sourcemaps.write('.'))
        .pipe(dest('build/css'));
}

//Tarea para Compilar JavaScript
function compileJS(){
    return src(path.js)
        .pipe(sourcemaps.init())
        .pipe(concat('bundle.js'))
        .pipe(terser())
        .pipe(sourcemaps.write('.'))
        .pipe(dest('build/js'));
}

//Tarea para Optimizar Imágenes 
function imageMin(){
    const settings= {
        optimizationLevel:3
    }
 
    return src(path.img)
        .pipe(cache(imagemin(settings)))
        .pipe(dest('build/img'));
}
 
//Tareas para Convertir Imágenes a WebP y AVIF
function imgWebp(){
    const settings={
        quality:50
    }
    return src(path.img)
        .pipe(webp(settings))
        .pipe(dest('build/img'));
}  
function imgAvif(){
    const settings = {
        quality:50
    }
    return src(path.img)
        .pipe(avif(settings))
        .pipe(dest('build/img'));
}

//Tarea de Observación
function autoCompile(){
    watch(path.scss, compileSass); // Observa los cambios en SCSS y compila cuando cambien
    watch(path.js, compileJS); // Observa los cambios en JS y compila cuando cambien
    watch(path.img, parallel(imgAvif, imgWebp, imageMin)); // Observa imágenes y convierte/optimiza
}

 
exports.default = parallel(compileSass,compileJS,autoCompile,imgAvif,imageMin,imgWebp);

#!/usr/bin/env node

var gulp = require('gulp'),
  concat = require('gulp-concat'),
  watch = require('gulp-watch'),
  uglify = require('gulp-uglify'),
  ngAnnotate = require('gulp-ng-annotate');

gulp.task(
  'default',
  [
    'angular'
  ]
);

/**
 * Angular scripts for moderator panels
 */
gulp.task('angular', function () {

  return gulp.src([
    'scripts/angular/*/*.js'
  ])
    .pipe(concat('angular.min.js'))
    .pipe(ngAnnotate())
    .pipe(uglify())
    .pipe(gulp.dest('public_html/dist/'));

});

gulp.task('watch', function () {
  gulp.watch([
    'scripts/angular/*/*.js',
  ], ['angular']);
});

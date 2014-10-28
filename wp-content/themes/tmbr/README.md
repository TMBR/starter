## Gulp Starter Kit

## This project uses gulp

We are using [gulp](http://www.gulpjs.com), the amazing Javascript Task Runner, for a simple compilation of SASS and CoffeeScript files. Installation is simple.

### Install

1. [Install node and npm](https://gist.github.com/isaacs/579814)
1. Install gulp: `npm install -g gulp-cli`
1. Install bower: `npm install -g bower`
1. Install dependencies (reads from package.json): `npm install`
1. Install bower assets: `bower install`

_On some installations, or if you haven't installed gulp globally, you'll want to type `npm install gulp` as well._

Once installed, type `gulp` in the Terminal and edit away. Source files found in `public/assets/stylesheets/sass`.

Site manifest file (main file that is compiled) is `public/assets/stylesheets/application.sass`. This simply contains a bunch of imports to keep the sass organized and lovely.

Gulp is absorbed using an awesome pattern from [Dan Tello at Viget](http://viget.com/extend/gulp-browserify-starter-faq). All tasks are separated into individual files in the `./gulp` directory.

#### Styles

Where possible, we would like to use the [http://smacss.com/](SMACSS) theory for CSS styles.

## Gulp:

We have added [`gulp`](http://gulpjs.com) to use instead of Grunt. Its speed and async tasks make things really, really awesome, and speedy.

### Gulp Tasks

* `gulp watch` runs watch for `.coffee` and `.styl` files in the repository, and concatenates / compiles them.
* `gulp server` runs the node (web) server.
* `gulp build` compiles the scripts and styles.

_It is recommend you open two tabs and run the server separately due to conflicts and to ease the separation of the build tool from the server._

### Styleinjector

TODO: Add instructions.

#### Config

Check out the `gulpfile.coffee` for the simple config file that identifies the very basic task used in this project.

#### Learn about SASS

Read up on [SASS](http://sass-lang.com). SCSS and CSS are _fully interchangeable_. On many of the files we are using [SASS Indented Syntax](http://sass-lang.com/documentation/file.INDENTED_SYNTAX.html) to save time, though, and abstracting into a partial.

### Ignored Files:

All application specific `.css` and `.js` files are currently ignored from this repository.

There are two options for versioning the production code:

##### Preferred Method:

If you have and are able to install `node` and `npm` on your server:

1.`git rm public/js/*.js public/css/*.css`.
2. Ignore `public/js/*.js` and `public/css/*.css`.
3. When deploying, run `gulp build` on the server.

##### Alternate Method:

Track `public/**` as you would normally and deal with the merge conflicts.
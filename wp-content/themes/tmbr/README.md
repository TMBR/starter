## Get Up and Running with gulp

Run the following commands from anywhere:

1. Install [homebrew](http://brew.sh/#install)
2. `brew install node`
3. `npm install -g gulp`
4. `npm install -g bower`

---

## Using Gulp in Development

`cd` to your theme directory

1. `npm install`
2. `bower install`
3. `gulp`

**To kill gulp watch press Ctrl C**

---

## Starting a site from scratch

1. Create a repository on GitHub (if it's not already created)
2. Follow the steps below

		cd ~/web/
		mkdir example.dev
		cd example.dev
		git clone git@github.com:TMBR/starter.git html
		cd html
		rm -rf .git
		cd wp-content/themes
		mv tmbr example #change theme dir name to client-specific theme directory
		cd ../..
		git init
		git remote add origin git@github.com:TMBR/example.git
		git add --all .
		git commit -m "initial add of new repository based off starter theme"
		cd wp-content/themes/example
		bower install
		npm install

---

## How To Add a Vendor/Library Dependency

Ensure you're in the theme folder for the project you want

### Find the Package you want

One of two ways:

1. `bower search {{package_name}}`

OR

2. Visit Bower's site, and search there: <http://bower.io/search/>


### Install the Package Into Your Project

The `-D` flag will install _and add_ to dependecy list in the bower.json file.

1. `bower install -D {{package_handle}}`

### Utilize it in Your Project


1. CSS/SCSS : Go to `assets/components/{{package_handle}}/` - .css / .scss paths and add to - **`assets/stylesheets/application.scss`**
1. JS : Go to `assets/components/{{package_handle}}/`  - .js path and add to - `gulp/config.js` in the vendor array towards the bottom.
1. Restart Gulp: in terminal -  `ctrl+c` - then `gulp`


## Keep Your Project Up-To-Date

Check for New Dependencies/Libraries

		bower install

Install/Update any new Gulp Modules

		npm install


---

## Resources

- Gulp <http://gulpjs.com/>
- SCSS/SASS <http://sass-lang.com/>

## Version Control of Files

When you're ready to deploy the site to production or staging, go ahead and make a commit of the `public/` directory.  This way, the versioned file has the latest code from the server.

==================================================


# TO-DO(cument)

* `gulp build` compiles the scripts and styles.
* `gulp deploy` pushes code to origin
* Styleinjector (don't think this is being used)




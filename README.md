Simple Mobile First
--

_A bare-bones mobile-first WordPress theme._

Use this theme as a starting point for your own
mobile-first WordPress (as a CMS) website.

Intentionally, a lot of WordPress features like
widgets have been removed from this theme because
they just give clients another way to break the site.


Recommended plugins
---

* Advanced Custom Fields / Advanced Custom Fields Pro
* Google Analyticator
* Gravity Forms (if you need custom forms)
* Regenerate Thumbnails
* Yoast SEO


Grunt and front-end tooling
---

This theme uses Grunt to perform the following tasks

* Lint, uglify and concatenate the JavaScript
* Convert the Sass files into CSS
* Minimise/optimise images (JPG and PNG) and SVG files

To run, firstly make sure Node and npm are installed then 
in Terminal or command prompt navigate to the theme directory
and run the following commands

> `cd _grunt`
> `npm install` note: only run this the first time
> `grunt watch` note: this will run grunt every time a file is changed

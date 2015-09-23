
module.exports = function(grunt) {

	// load all grunt tasks
	require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		// Concatenate JavaScript files. 
		// bc one big file downloads quicker than several small ones on HTTP1
		concat: {
			options: {
				separator: ';'
			},
			dist: {
				src: [
					'!../assets/js/plugins/jquery-*.js',
					'!../assets/js/plugins/respond.js',
					'../assets/js/**/*.js',
					'!../assets/js/<%= pkg.name %>.js',
					'!../assets/js/<%= pkg.name %>.min.js'
				],
				dest: '../assets/js/<%= pkg.name %>.js'
			}
		},

		// Uglify JavaScript - make filesize smaller
		uglify: {
			options: {
				banner: '/*! <%= pkg.name %> <%= grunt.template.today("dd-mm-yyyy") %> */\n'
			},
			dist: {
				files: {
					'../assets/js/<%= pkg.name %>.min.js': ['<%= concat.dist.dest %>']
				}
			}
		},

		// Run JavaScript pass jslint rule so it conforms
		jslint: {

			client: {
				src: [
					'../assets/js/modules/*.js'
				],
				directives: {
					browser: true,
					devel: true,
					white: true,
					todo: true,
					unparam: true,
					unused: true,
					predef: [
						'jQuery',
						'requestAnimationFrame',
						'Modernizr',
						'Hammer'
					]
				},
				options: {
				}
			}
		},

		// Convert Sass to CSS
		sass: {																 		// Task
			dist: {														 		// Target
				files: {													// Dictionary of files
						'../style.css': '../_sass/style.scss'		 // 'destination': 'source'
				}
			}
		},

		// Add browser prefixes to CSS
		postcss: {
			options: {
				map: true, // inline sourcemaps

				processors: [
					require('autoprefixer-core')({
						browsers: 'last 2 versions'
					})/*, // add vendor prefixes
					require('cssnano')() // minify the result */
				]
			},
			dist: {
				src: '../*.css'
			}
		},

		// Minify CSS (to save filesize)
		cssmin: {
			combine: {
				files: {
					'../style.min.css': ['../style.css']
				}
			}
		},

		// Optimise images
		imagemin: {
			png: {
				options: {
					optimizationLevel: 7
				},
				files: [
					{
						// Set to true to enable the following options…
						expand: true,
						// cwd is 'current working directory'
						cwd: '../assets/images/',
						src: ['**/*.png'],
						// Could also match cwd line above. i.e. project-directory/img/
						dest: '../assets/images/',
						ext: '.png'
					}
				]
			},
			jpg: {
				options: {
					progressive: true
				},
				files: [
					{
						// Set to true to enable the following options…
						expand: true,
						// cwd is 'current working directory'
						cwd: '../assets/images/',
						src: ['**/*.jpg'],
						// Could also match cwd. i.e. project-directory/img/
						dest: '../assets/images/',
						ext: '.jpg'
					}
				]
			}
		},

		// Optimise SVGs
		svgmin: {
			options: {
				plugins: [
					{
						removeViewBox: false
					}, 
					{
						removeUselessStrokeAndFill: false
					}
				]
			},
			dist: {
				files: [
					{
						// Set to true to enable the following options…
						expand: true,
						// cwd is 'current working directory'
						cwd: '../assets/images/',
						src: ['*.svg', '**/*.svg'],
						// Could also match cwd. i.e. project-directory/img/
						dest: '../assets/images/',
						ext: '.svg'
					}
				]
			}
		},

		// LINTSPACES
		// Make sure CSS and JS conform to whitespace compliance
		lintspaces: {
			all: {
				src: [
						'../_sass/**/*.scss',
						'!../_sass/library/**/*.scss',
						'../assets/js/modules/*.js'
				],
				options: {
					newline: true,
					trailingspaces: true,
					indentation: 'tabs',
					ignores: ['js-comments']
				}
			},
		},

		// WATCH:
		// Whenever a file is changed, run specific tasks
		watch: {
			css: {
				files: [
					'../_sass/*.scss',
					'../_sass/**/*.scss',
				],
				tasks: ['sass', 'postcss', 'cssmin'],
				options: {
					nospawn: true
				}
			},
			js: {
				files: [
					'../assets/js/*.js',
					'../assets/js/**/*.js',
					// Ignore these
					'!../assets/js/<%= pkg.name %>.js', 
					'!../assets/js/<%= pkg.name %>.min.js'
				],
				tasks: ['jslint', 'concat', 'uglify']
			},
			images: {
				files: [
					'../assets/images/**/*.jpg',
					'../assets/images/**/*.png',
				],
				tasks: ['imagemin'],
				options: {
					nospawn: true
				}
			},
		}
	});

	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-postcss');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-jslint');	
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-imagemin');
	grunt.loadNpmTasks('grunt-svgmin');
	grunt.loadNpmTasks('grunt-lintspaces');
	grunt.loadNpmTasks('grunt-contrib-watch');

	// Tasks than can be ran
	grunt.registerTask('default', ['sass', 'postcss', 'cssmin', 'concat', 'uglify', 'jslint', 'imagemin', 'svgmin']);
	grunt.registerTask('css', ['sass', 'postcss', 'cssmin']);
	grunt.registerTask('js', ['concat', 'uglify', 'jslint']);
	grunt.registerTask('images', ['imagemin', 'svgmin']);
};


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
					'../assets/js/modules/*.js',
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
						'throttle',
						'debounce'
					]
				},
				options: {
				}
			}
		},

		// SASS
		// Convert Sass into CSS (to make CSS easier to write) 
		// uses libsass instead of Ruby Sass (for speed - it's upto 5 times faster)
		sass: {
			options: {
				sourceMap: true,
				outputStyle: 'expanded'
			},
			dist: {
				files: { // 'destination': 'source'
					'../assets/css/style.css': '../assets/_sass/style.scss',
					'../editor-style.css': '../assets/_sass/wysiwyg.scss'
				}
			}
		},

		// Add browser prefixes to CSS
		postcss: {
			options: {
				map: true,
				processors: [
					require('autoprefixer')({
						browsers: ['last 2 versions']
					})
				]
			},
			dist: {
				src: '../assets/css/*.css'
			}
		},

		// Minify CSS (to save filesize)
		cssmin: {
			combine: {
				files: {
					'../assets/css/style.min.css': ['../assets/css/style.css']
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

	grunt.loadNpmTasks('grunt-sass');
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

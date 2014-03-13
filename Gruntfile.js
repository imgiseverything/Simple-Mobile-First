

module.exports = function(grunt) {

	// load all grunt tasks
	require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		
		concat: {
			options: {
				separator: ';'
			},
			dist: {
				src: [
					'scripts/plugins/*.js', 
					'!scripts/plugins/jquery-1.10.2.min.js',
					'!scripts/plugins/respond.js',
					'scripts/*.js',
					'!scripts/<%= pkg.name %>.js',
					'!scripts/<%= pkg.name %>.min.js'
				],
				dest: 'scripts/<%= pkg.name %>.js'
			}
		},
		
		uglify: {
			options: {
				banner: '/*! <%= pkg.name %> <%= grunt.template.today("dd-mm-yyyy") %> */\n'
			},
			dist: {
				files: {
					'js/<%= pkg.name %>.min.js': ['<%= concat.dist.dest %>']
				}
			}
		},
		
		sass: {                                 		// Task
	        dist: {                             		// Target
	            files: {                        	// Dictionary of files
	                'style.css': '_sass/style.scss'     // 'destination': 'source'
	            }
	        }
	    },
		
		cssmin: {
		  combine: {
		    files: {
		      'style.min.css': ['style.css']
		    }
		  }
		},
		
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
		          cwd: 'images/',
		          src: ['**/*.png'],
		          // Could also match cwd line above. i.e. project-directory/img/
		          dest: 'images/',
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
		          cwd: 'images/',
		          src: ['**/*.jpg'],
		          // Could also match cwd. i.e. project-directory/img/
		          dest: 'images/',
		          ext: '.jpg'
		        }
		      ]
		    }
		},
		
		watch: {
			files: ['_sass/*.scss', 'js/*.js', '!js/<%= pkg.name %>.js', '!js/<%= pkg.name %>.min.js'],
			tasks: ['sass', 'cssmin','concat'/*, 'uglify'*/]
		}
	});
	
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-imagemin');
	grunt.loadNpmTasks('grunt-contrib-watch');

	grunt.registerTask('default', ['sass', 'cssmin', 'concat', 'uglify', 'imagemin']);

};
module.exports = function(grunt) {
	// Project configuration.
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		uglify: {
			build: {
				files: {
					'js/scripts.min.js' : ['_source/js/plugins.js', '_source/js/main.js']
				}
			}
		},
		less: {
			dev: {
				files: {
					'css/theme.css': ['_source/less/style.less', '_source/less/responsive.less']
				}
			},
			build: {
				options: {
					yuicompress: true
				},
				files: {
					'css/theme.min.css': ['_source/less/style.less', '_source/less/responsive.less']
				}
			}
		},
		watch: {
			less: {
				files: ['_source/less/*'],
				tasks: 'less'
			}
		},
		copy: {
			main: {
				files: [
					{expand: true, flatten: true, src: ['_source/font-awesome/font/**'], dest: 'fonts/', filter: 'isFile'},
					{expand: true, flatten: true, src: ['_source/js/vendor/**'], dest: 'js/', filter: 'isFile'}
				]
			}
		}
	});

	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.registerTask('default', ['watch']);
	grunt.registerTask('build', ['uglify', 'less', 'copy']);
};
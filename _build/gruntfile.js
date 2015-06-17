module.exports = function(grunt) {
	// Project configuration.		
	var initConfig = {
		pkg: grunt.file.readJSON('package.json'),
		dirs: { /* just defining some properties */
			lib: './lib/',
			theme: '../',
			assets: 'assets/components/blockdown/',
			css: 'css/',
			js:  'js/',
		},
		bower: {
			install: {
				options: {
					targetDir: '<%= dirs.lib %>',
					layout: 'byComponent'
				}
			}
		},
		copy: { 
            epiceditor:{
        		files: [{
        			src: 'epiceditor/**/*',
        			cwd: '<%= dirs.lib %>',
        			dest: '<%= dirs.theme %><%= dirs.assets %><%= dirs.js %>vendor/',
        			expand: true
        		}]
        	}
		},
	};

	grunt.initConfig(initConfig);
	
	grunt.loadNpmTasks('grunt-bower-task');
	grunt.loadNpmTasks('grunt-contrib-copy');

	grunt.registerTask('default', ['bower','copy']);
 
};

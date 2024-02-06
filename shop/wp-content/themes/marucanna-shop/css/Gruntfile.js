module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    sass: {
      dist: {
        options: {                       // Target options
          style: 'expanded'
        },
      	files: {
      		'css/main.css' : 'scss/main.scss',
      	}
      }
    },
    watch: {
    	css: {
    		files: 'scss/**/*.scss',
    		tasks: ['sass', 'autoprefixer']
    	},
      js: {
        files: '../js/fragments/**/*.js',
        tasks: ['uglify']
      }
    },
    autoprefixer: {
      options: {
        browsers: ['last 2 version', 'ie 8', 'ie 9']
      },
      single_file: {
        src: 'css/main.css',
        dest: 'theme.css'
      },
    },
    uglify: {
      dist: {
        options: {
            banner: '/*! <%= pkg.name %> <%= pkg.version %> filename.min.js <%= grunt.template.today("yyyy-mm-dd h:MM:ss TT") %> */\n',
            report: 'gzip'
        },
        files: {
            '../js/scripts.min.js' : [
                '../js/fragments/mc_init.js',
                '../js/fragments/**/*.js'
            ]
        }
      },
      dev: {
        options: {
            banner: '/*! <%= pkg.name %> <%= pkg.version %> filename.js <%= grunt.template.today("yyyy-mm-dd h:MM:ss TT") %> */\n',
            beautify: true,
            compress: false,
            mangle: false
        },
        files: {
            '../js/scripts.js' : [
                '../js/fragments/mc_init.js',
                '../js/fragments/**/*.js'
            ]
        }
      }
    }
});
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-autoprefixer');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.registerTask('default',['watch', 'autoprefixer','uglify']);
}
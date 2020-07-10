module.exports = function(grunt) {
    grunt.initConfig({
        uglify: {
            files: {
                src: 'public/assets/js/src/*.js', // source files mask
                dest: 'public/assets/js/', // destination folder
                expand: true, // allow dynamic building
                flatten: true, // remove all unnecessary nesting
                ext: '.min.js' // replace .js to .min.js
            }
        },
        watch: {
            js: {
                files: 'public/assets/js/src/*.js',
                tasks: ['uglify']
            }
        }
    });

    // load plugins
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-uglify');

    // register at least this one task
    grunt.registerTask('default', [
        'uglify'
    ]);
};
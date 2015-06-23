module.exports = function(grunt) {

    // must run npm install grunt-contrib-less --save-dev
    grunt.loadNpmTasks('grunt-contrib-less');
    // must run npm install grunt-contrib-watch --save-dev
    grunt.loadNpmTasks('grunt-contrib-watch');
    // npm install grunt-bower-task --save-dev
    grunt.loadNpmTasks('grunt-bower-task');

    // Project configuration.
    grunt.initConfig({
        pkg : grunt.file.readJSON('package.json'),
        uglify : {
            bower : {
                options : {
                    mangle : true,
                    compress : true
                },
                files : {
                    'js/bower.min.js' : 'js/bower.js'
                }
            },
            options : {
                banner : '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
            },
            build : {
                src : 'src/<%= pkg.name %>.js',
                dest : 'build/<%= pkg.name %>.min.js'
            }
        },
        less : {
            development : {
                options : {
                    paths : ['custom_bootstrap/']
                },
                files : {
                    "css/bootstrap.css" : "custom_bootstrap/custom-bootstrap.less"
                }
            }
        },
        bower : {
            install : {
                //just run 'grunt bower:install' and you'll see files from your Bower packages in lib directory
            }
        },
        watch : {
            scripts : {
                files : ['bower.json'],
                tasks : 'buildbower'
            },
            less : {
                files : ['custom_bootstrap/**/*.less'],
                tasks : 'less:development'
            }
        },
        bower_concat : {
            all : {
                dest : 'js/bower.js'
                //cssDest: 'build/_bower.css'
            }
        }
    });

    require('load-grunt-tasks')(grunt);

    // Load the plugin that provides the "uglify" task.
    //grunt.loadNpmTasks('grunt-contrib-uglify');
    //grunt.loadNpmTasks('grunt-bower-concat');

    // Default task(s).
    grunt.registerTask('default', ['uglify']);

    grunt.registerTask('buildbower', ['bower:install', 'bower_concat', 'uglify:bower']);

};

/*
 |--------------------------------------------------------------------------
 | Browser-sync config file
 |--------------------------------------------------------------------------
 |
 | Please report any issues you encounter:
 |  https://github.com/shakyShane/browser-sync/issues
 |
 | For up-to-date information about the options:
 |  https://github.com/shakyShane/browser-sync/wiki/Working-with-a-Config-File
 |
 */
module.exports = {

    ports: {
        min: 3400,
        max: 3405
    },

    /*
     |--------------------------------------------------------------------------
     | Files to watch
     |--------------------------------------------------------------------------
     | https://github.com/shakyShane/browser-sync/wiki/options#wiki-files
     */
    files: [
        'wp-content/themes/believe-slate-2013/public/css/*.css',
        'wp-content/themes/believe-slate-2013/*.php',
    ],

    /*
     |--------------------------------------------------------------------------
     | Directories or files to exclude
     |--------------------------------------------------------------------------
     | https://github.com/shakyShane/browser-sync/wiki/options#wiki-exclude
     */
    exclude: false,

    /*
     |--------------------------------------------------------------------------
     | Server
     |--------------------------------------------------------------------------
     | https://github.com/shakyShane/browser-sync/wiki/options#wiki-server
     */
    server: false,

    /*
     |--------------------------------------------------------------------------
     | Proxy
     |--------------------------------------------------------------------------
     | https://github.com/shakyShane/browser-sync/wiki/options#wiki-proxy
     */
    // proxy: 'fok.dev',

    /*
     |--------------------------------------------------------------------------
     | Start path
     |--------------------------------------------------------------------------
     | https://github.com/shakyShane/browser-sync/wiki/options#wiki-startPath
     */
    startPath: null,

    /*
     |--------------------------------------------------------------------------
     | Ghost Mode
     |--------------------------------------------------------------------------
     | https://github.com/shakyShane/browser-sync/wiki/options#wiki-ghostmode
     */
    ghostMode: {
        clicks: false,
        links: true,
        forms: true,
        scroll: false
    },

    /*
     |--------------------------------------------------------------------------
     | Open (true|false)
     |--------------------------------------------------------------------------
     | https://github.com/shakyShane/browser-sync/wiki/options#wiki-open
     */
    open: true,

    /*
     |--------------------------------------------------------------------------
     | xip (true|false)
     |--------------------------------------------------------------------------
     | https://github.com/shakyShane/browser-sync/wiki/options#wiki-xip
     */
    xip: false,

    /*
     |--------------------------------------------------------------------------
     | Timestamps (true|false)
     |--------------------------------------------------------------------------
     | https://github.com/shakyShane/browser-sync/wiki/options#wiki-timestamps
     */
    timestamps: true,

    /*
     |--------------------------------------------------------------------------
     | File Timeout (milliseconds)
     |--------------------------------------------------------------------------
     | https://github.com/shakyShane/browser-sync/wiki/options#wiki-filetimeout
     */
    fileTimeout: 0,

    /*
     |--------------------------------------------------------------------------
     | Inject Changes
     |--------------------------------------------------------------------------
     | https://github.com/shakyShane/browser-sync/wiki/options#wiki-injectchanges
     */
    injectChanges: true,

    /*
     |--------------------------------------------------------------------------
     | Scroll Proportionally (true|false)
     |--------------------------------------------------------------------------
     | https://github.com/shakyShane/browser-sync/wiki/options#wiki-scrollproportionally
     */
    scrollProportionally: true,

    /*
     |--------------------------------------------------------------------------
     | Scroll Throttle (milliseconds)
     |--------------------------------------------------------------------------
     | https://github.com/shakyShane/browser-sync/wiki/options#wiki-scrollthrottle
     */
    scrollThrottle: 0,

    /*
     |--------------------------------------------------------------------------
     | Notify (true|false)
     |--------------------------------------------------------------------------
     | https://github.com/shakyShane/browser-sync/wiki/options#wiki-notify
     */
    notify: true,

    /*
     |--------------------------------------------------------------------------
     | Host
     |--------------------------------------------------------------------------
     | https://github.com/shakyShane/browser-sync/wiki/options#wiki-host
     */
    host: null,

    /*
     |--------------------------------------------------------------------------
     | Excluded File Types
     |--------------------------------------------------------------------------
     | https://github.com/shakyShane/browser-sync/wiki/options#wiki-excludedfiletypes
     */
    excludedFileTypes: [],

    /*
     |--------------------------------------------------------------------------
     | Reload Delay
     |--------------------------------------------------------------------------
     | https://github.com/shakyShane/browser-sync/wiki/options#wiki-reloadDelay
     */
    reloadDelay: 0

};
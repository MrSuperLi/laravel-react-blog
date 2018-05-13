var webpack = require('webpack');
var HtmlWebpackPlugin = require('html-webpack-plugin');
var ExtractTextPlugin = require('extract-text-webpack-plugin');

plugins = [
    new HtmlWebpackPlugin({
        'template':'index.html'
    }),
    new webpack.ProvidePlugin({
        $: "jquery",
        jQuery: "jquery",
        "window.jQuery": "jquery"
    }),
    new webpack.optimize.UglifyJsPlugin({
        'compress': {
            warnings: false
        }
    }),
    new ExtractTextPlugin("[name].[hash].css"),
    new webpack.DefinePlugin({
      'process.env': {
        'NODE_ENV': '"production"'
      }
    })
];


module.exports = {
    entry:__dirname + "/index.js",
    output:{
        path:__dirname + "/../public/admin",
        filename:"[name]-[hash].js"
    },

    module:{
        loaders:[
            {
                test:/\.json$/,
                loader:"json"
            },
            {
                test:/\.js$/,
                exclude:/node_modules/,
                loader:"babel",
                /*query:{
                    presets:['es2015','react']
                }*/
            },
            {
                test:/\.css$/,
                loader:"style!css?modules"
            },
             {
                test:/\.scss$/,
                loader:"sass?style=compressed!style!css?modules"
            }
        ]
    },
    plugins:plugins,
    resolve:{
        alias:{

        },
        extensions:['','.js','.json','.css','.scss']
    }
    
}
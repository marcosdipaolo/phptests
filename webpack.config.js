const path = require('path');
const extract = require("mini-css-extract-plugin");

module.exports = {
	entry: './src/Assets/js/app.js',
	output: {
		path: path.resolve(__dirname, 'dist/js'),
		filename: 'app.js'
	},

	module: {
		rules: [
			{
				test: /\.js$/,
				exclude: /(node_modules)/,
				use: {
					loader: 'babel-loader',
					options: {
						presets: ['@babel/preset-env'],
					}
				}
			},
			{
				test: /\.scss$/,
				use: [
					'style-loader',
					extract.loader,
					'css-loader',
					'sass-loader'
				]
			},
			{
				//applying rule
				test: /\.(png|jpe?g|gif|svg)$/,
				use: [
					{
						//using file-loader
						loader: 'file-loader',
						options: {
							outputPath: "images"
						}
					}
				]
			}
		]
	},
	resolve: {
		extensions: ['.scss', '.js']
	},
	plugins: [
		new extract({
			filename: '../css/style.css',
		})
	],
	mode: 'production'
};
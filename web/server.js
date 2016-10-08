//server.js

//modules ------------------------------
var express = require ('express');
var request = require ('request');
var querystring = require('querystring');
var cookieParser = require('cookie-parser');

var app = express();

app.use(express.static(__dirname + '/public'))
   .use(cookieParser());

//routing -----------------------------
require('./app/routes')(app)

var port = 8888;
//Start app at 8888;
app.listen(port);
console.log('Server running on port ' +  port);

exports = module.exports = app;

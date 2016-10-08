//server.js

//modules ------------------------------
var express = require ('express');
var request = require ('request');
var querystring = require('querystring');
var bodyParser     = require('body-parser');
var methodOverride = require('method-override');
var cookieParser = require('cookie-parser');
var morgan = require('morgan');
var mongoose = require('mongoose');
var app = express();

var db = require('./config/db');
mongoose.connect(db.url);

app.use(morgan('dev'));
app.use(express.static(__dirname + '/public'))
   .use(cookieParser());

   app.use(bodyParser.json());

// parse application/vnd.api+json as json
app.use(bodyParser.json({ type: 'application/vnd.api+json' }));

// parse application/x-www-form-urlencoded
app.use(bodyParser.urlencoded({ extended: true }));

// override with the X-HTTP-Method-Override header in the request. simulate DELETE/PUT
app.use(methodOverride('X-HTTP-Method-Override'));

//routing -----------------------------
require('./app/routes')(app)

var port = 8888;
//Start app at 8888;
app.listen(port);
console.log('Server running on port ' +  port);


exports = module.exports = app;

var express  = require('express');
var querystring = require('querystring');
var request = require('request');
var mongoose = require('mongoose');


module.exports = function(app) {

  var client_id = 'eafbafd8462c416e9683f2cbecced544'; // Your client id
  var client_secret = '6d0b5783b6954ddf8d156dcd34bbb035'; // Your secret

  var redirect_uri = 'http://localhost:8888/api/spotify/callback';

//  var redirect_uri = 'http://dynamix.tech:8888/api/spotify/callback'; // Your redirect uri

  var stateKey = 'spotify_auth_state';

  var Schema = mongoose.Schema;
  //test interval function
  //setInterval(function() { console.log("setInterval: It's been one second!"); }, 1000);

    var mixSchema = new Schema({
      user_id: Number,
      heart_rate: Number,
      steps: Number
    });


      var mixModel = mongoose.model('mix', mixSchema);


  var router = express.Router();
  router.use(function(req, res, next) {
  console.log('Incoming:');
  next();
});

  router.route('/mix')
  .post(function(req, res) {
    var mix = new mixModel({
      user_id: 1,
      heart_rate: 120,
      steps: 50
    });

    mix.save(function(err) {
      if (err) {
        res.send(err);
        return;
      }
    });

    res.json({
      message: "mix saved in database"
    });
  });

  router.route('/spotify/login')
  .get(function(req, res) {
    var state = "online";
    res.cookie(stateKey, state);

    //app requests authorization
    var scope = 'user-read-private user-read-email';
    res.redirect('https://accounts.spotify.com/authorize?' +
        querystring.stringify({
          response_type: 'code',
          client_id: client_id,
          scope: scope,
          redirect_uri: redirect_uri,
          state: state
        }));
  });

  router.route('/spotify/callback')
  .get(function(req, res) {
    var code = req.query.code || null;
    var state = req.query.state || null;
    var storedState = req.cookies ? req.cookies[stateKey] : null;

    if (state === null || state !== storedState) {
      res.redirect('/#' +
        querystring.stringify({
          error: 'state_mismatch'
        }));
    } else {
      res.clearCookie(stateKey);
      var authOptions = {
        url: 'https://accounts.spotify.com/api/token',
        form: {
          code: code,
          redirect_uri: redirect_uri,
          grant_type: 'authorization_code'
        },
        headers: {
          'Authorization': 'Basic ' + (new Buffer(client_id + ':' + client_secret).toString('base64'))
        },
        json: true
      };

      request.post(authOptions, function(error, response, body) {
        if (!error && response.statusCode === 200) {
          var access_token = body.access_token,
              refresh_token = body.refresh_token;

          var options = {
            url: 'https://api.spotify.com/v1/me',
            headers: { 'Authorization': 'Bearer ' + access_token },
            json: true
          };

          request.get(options, function(error, response, body) {
            console.log(body);
          });

          //Get tracks from spotify
          var options = {
            url: 'https://api.spotify.com/v1/users/spotify/playlists/1GQLlzxBxKTb6tJsD4RxHI?market=ES',
            headers: { 'Authorization': 'Bearer ' + access_token },
            json: true
          };

          request.get(options, function(error, response, body) {
            console.log(body);
          });

          res.redirect('/#' + querystring.stringify({
            access_token: access_token,
            refresh_token: refresh_token
          }));
        } else {
          res.redirect('/#' +
            querystring.stringify({
              error: 'invalid_token'
            }));
        }
      });
    }
  });

  router.route('/api/spotify/refresh_token', function(req, res) {
    var refresh_token = req.query.refresh_token;
    var authOptions = {
      url: 'https://accounts.spotify.com/api/token',
      headers: { 'Authorization': 'Basic ' + (new Buffer(client_id + ':' + client_secret).toString('base64')) },
      form: {
        grant_type: 'refresh_token',
        refresh_token: refresh_token
      },
      json: true
    };

    request.post(authOptions, function(error, response, body) {
      if (!error && response.statusCode === 200) {
        var access_token = body.access_token;
        res.send({
          'access_token': access_token
        });
      }
    });
  });

  router.route('/api/spotify/refresh_test', function(req, res) {
    var options = {
    	  host: url,
    	  port: 80,
    	  path: '/resource?id=foo&bar=baz',
    	  method: 'POST'
    	};

    	http.request(options, function(res) {
    	  console.log('STATUS: ' + res.statusCode);
    	  console.log('HEADERS: ' + JSON.stringify(res.headers));
    	  res.setEncoding('utf8');
    	  res.on('data', function (chunk) {
    		console.log('BODY: ' + chunk);
    	});
    	}).end();

  });
  app.use('/api', router);


};

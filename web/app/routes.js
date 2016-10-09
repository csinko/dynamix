var express  = require('express');
var querystring = require('querystring');
var request = require('request');
var mongoose = require('mongoose');
var SpotifyWebApi = require('spotify-web-api-node');

// credentials are optional

var access_code;
var spotifyApi = new SpotifyWebApi({
  clientId : '5facb3ec0e234f91bc7eb0e7a99a96d9',
  clientSecret : '666e2cd36093405cada67f8d252a795d',
  redirectUri : 'http://dynamix.tech:8888/api/spotify/callback'
});


module.exports = function(app) {


  var playlist_tracks = [];
  var spotify_user = "";
  var dj_playlist = "";

  var danceability = 0.5;

  var client_id = '5facb3ec0e234f91bc7eb0e7a99a96d9'; // Your client id
  var client_secret = '666e2cd36093405cada67f8d252a795d'; // Your secret

  //var redirect_uri = 'http://localhost:8888/api/spotify/callback';

  var redirect_uri = 'http://dynamix.tech:8888/api/spotify/callback'; // Your redirect uri

  var stateKey = 'spotify_auth_state';

  var user_data = [];


  var Schema = mongoose.Schema;


  //test interval function
  //setInterval(function() { console.log("setInterval: It's been one second!"); }, 1000);

  //10 second timer to check user_data
  setInterval(function() {
    console.log("Current Amount of user data is " + user_data.length);
    danceability = determine_danceability();
    user_data = [];
    console.log("Access code:" + access_code);

   }, 10000);

   function determine_danceability() {
     var curr_danceability = 0;
     var unique_users = [];
     for(var i = 0; i < user_data.length; i++) {
       user = user_data[i];
       user_danceability = (1/500) * user.steps + (1/600) * (user.heart_rate - 80);
       curr_danceability += user_danceability;
       var exists = false;
       for(var j = 0; j < unique_users.length; j++) {
         if (user_data[i].user_id == unique_users[j]) {
           exists = true;
         }
       }
       if (!exists) {
         unique_users.push(user_data[i].user_id);
       }
     }
     curr_danceability /= user_data.length;
     console.log(unique_users.length + " unique users");
     curr_danceability += (1/60) * unique_users.length;
     if (curr_danceability > 1) {
       curr_danceability = 1;
     }
     if (curr_danceability < 0) {
       curr_danceability = 0;
     }
     if (isNaN(curr_danceability)) {
       curr_danceability = 0;
     }

     console.log("Specific Danceability: " + curr_danceability);
     console.log("Avg Danceability: " + danceability);
     return (danceability + curr_danceability) / 2;
   }

    var mixSchema = new Schema({
      user_id: Number,
      heart_rate: Number,
      steps: Number
    });


      var mixModel = mongoose.model('mix', mixSchema);


  var router = express.Router();
  router.use(function(req, res, next) {
  //console.log('Incoming:');
  next();
});

  router.route('/mix')
  .post(function(req, res) {

    if (req.body.hasOwnProperty('type')) {
      if (req.body.type == 'array') {
        var objects = req.body.data;
        for(var i=0; i < objects.length; i++) {
          add_mix_data(objects[i]);
        }

      }
    }
    function add_mix_data(data_obj) {
      //console.log("ADDING MIX DATA");
      //console.log(data_obj);
    if(!data_obj.hasOwnProperty('user_id')) {
      console.log('Error: No user_id');
      res.status(400).json({
        message: 'Error: no user_id'
      });
      return;
    }
    if(!data_obj.hasOwnProperty('heart_rate')) {
      console.log('Error: No heart_rate');
      res.status(400).json({
        message: 'Error: no heart_rate'
      });
      return;
    }
    if(!data_obj.hasOwnProperty('steps')) {
      console.log('Error: No steps');
      res.status(400).json({
        message: 'Error: no steps'
      });
      return;
    }

    var mix = new mixModel({
      user_id: data_obj.user_id,
      heart_rate: data_obj.heart_rate,
      steps: data_obj.steps
    });

    user_data.push(mix);

    mix.save(function(err) {
      if (err) {
        res.send(err);
        return;
      }
    });
  }

    res.json({
      message: "mix saved in database"
    });
  })
  .get(function(req, res) {
    mixModel.find(function(err, mixes) {
      if(err) {
        res.send(err);
      }
      res.json(mixes);
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

  /* Read query parameters */
  var code  = req.query.code; // Read the authorization code from the query parameters
  var state = req.query.state; // (Optional) Read the state from the query parameter
  console.log("CODE: " + code);
  access_code = code;
  /* Get the access token! */
  spotifyApi.authorizationCodeGrant(code)
    .then(function(data) {

      /* Ok. We've got the access token!
         Save the access token for this user somewhere so that you can use it again.
         Cookie? Local storage?
      */

      /* Redirecting back to the main page! :-) */
      res.redirect('/');
      spotifyApi.getMe()
      .then(function(data) {
        console.log("DATA");
        console.log(data);
      }


    }, function(err) {
      res.status(err.code);
      res.send(err.message);
    });
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

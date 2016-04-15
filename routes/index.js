var express = require('express');
var flag = require('../models/flag');
var entry = require('../models/entry');
var participant = require('../models/participant');
var passport = require('passport')
var LocalStrategy = require('passport-local').Strategy;
var router = express.Router();

/* GET home page. */
router.get('/', function(req, res, next) {
  res.render('index', { title: 'da am4z1ng r4c3' });
});
router.get('/submit', function(req, res, next) {
  res.render('submit', { title: 'Submit Flag', user: req.user });
});

router.post('/submit', function(req, res, next) {
	if(!req.body.name) res.render('submit', { error: 'No Name' ,title: 'Submit flag'});
	else if(req.body.name.length == 0) res.render('submit', { error: 'No Name' });
	else {
		var name = req.body.name.toUpperCase();
		flag.getFlag(req.body.flag, function(err, results) {
			console.log(results);
			if(err)
			{
				res.render('submit', { error: 'Error, please try again' });
				return;
			}
			if(!results.length)
			{
				res.render('submit', { error: 'Wrong Flag' });
				return;
			}
			entry.insert(name, results[0].id, function(err ) {
				res.render('submit', { msg: 'Correct!' });
			});
		});
	}
});

router.get('/scoreboard', function(req, res, next) {
	entry.getRanks(function(err, result) {
		res.render('scoreboard', {participants: result});
	});
});
module.exports = router;

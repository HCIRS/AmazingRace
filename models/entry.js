var mysql = require('../models/mysql').getConnection()

var entry = {};

entry.insert = function(id, flagid, callback) {
	mysql.query('INSERT INTO entries (flagid, participantid) VALUES ( ?, ? )', [flagid, id] , callback);
}


module.exports = entry;

var mysql = require('../models/mysql').getConnection()

var entry = {};

entry.insert = function(id, flagid, callback) {
	mysql.query('INSERT INTO entries (flagid, participantid) VALUES ( ?, ? )', [flagid, id] , callback);
}

entry.getRanks = function(callback) {
	mysql.query('SELECT participantid, sum(points) AS totalpoints FROM \
				( \
					SELECT participantid, points FROM entries \
					LEFT JOIN flags \
					ON entries.flagid = flags.id \
					GROUP BY participantid, flagid \
				) scores \
				GROUP BY participantid \
				ORDER BY totalpoints DESC', callback);
}

module.exports = entry;

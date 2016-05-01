var mysql = require('../models/mysql').getConnection()

var entry = {};

entry.insert = function(id, flagid, callback) {
	mysql.query('INSERT INTO entries (flag, participant) VALUES ( ?, ? )', [flagid, id] , callback);
}

entry.getRanks = function(callback) {
	mysql.query('SELECT participant, sum(points) AS totalpoints FROM \
				( \
					SELECT participant, points FROM entries \
					LEFT JOIN flags \
					ON entries.flag = flags.id \
					GROUP BY participant, flag \
				) scores \
				GROUP BY participant \
				ORDER BY totalpoints DESC', callback);
}

module.exports = entry;

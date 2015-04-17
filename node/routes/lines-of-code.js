var request = require('request');
var async = require('async');
var apiUrl = 'https://api.github.com/repos/BrokingClub/BrokingClub/commits';
var token = '848a0e99cfb419e1fdb8166750bb6f6345659da9';
var cache = {};

module.exports = function(app){
    app.get('/api/linesofcode', getLinesOfCode);
};

function getLinesOfCode(req, res){
    if(cache.commits){
        return res.json(cache.commits);
    }

    getAllCommits(function (err, commits) {
        if (err) {
            return console.error(err);
        }

        populateCommitStats(commits, function (err, commitStats) {
            if (err) {
                return console.error(err);
            }

            cache.commits = commitStats;

            res.json(commitStats);
        })
    });
}

function populateCommitStats(commits, cb){
    async.mapLimit(commits, 10, populateCommit, cb);
}

function populateCommit(commit, cb){
    getCommitStats(commit, function(err, stats){
        if(err){
            return cb(err);
        }

        cb(null, {
            sha: commit,
            stats: stats
        });
    });
}

function getAllCommits(cb){
    var allCommits = [];

    appendCommits('master', allCommits, cb);
}

function appendCommits(sha, allCommits, cb){
    console.log('getting commits for sha: ' + sha);

    getCommits(sha, function(err, commits){
        if(err){
            return cb(err);
        }

        if(commits.length === 1){
            return cb(null,  allCommits);
        }

        commits.forEach(function(commit){
            if(commit.commit.message.indexOf('#') === 0) {
                allCommits.push(commit.sha);
            }
        });

        appendCommits(commits[commits.length - 1].sha, allCommits, cb);
    });
}

function getCommits(sha, cb){
    gitHubApi(apiUrl + '?sha=' + sha, cb);
}

function getCommitStats(sha, cb){
    console.log(apiUrl + '/' + sha);
    gitHubApi(apiUrl + '/' + sha, function(err, data){
        if(err) return cb(err);

        var stats = data.stats.additions - data.stats.deletions;

        cb(null, stats);
    });
}

function gitHubApi(url, cb){
    var options = {
        url: url,
        headers: {
            'User-Agent': 'Broking Club'
        },
        auth: {
            username: token,
            password: 'x-oauth-basic'
        }
    };

    request.get(options, function(err, response, body){
        if(err){
           return cb(err);
        }

        if(response.statusCode !== 200){
            return cb(response.body);
        }

        cb(null, JSON.parse(body));
    });
}
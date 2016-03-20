var page = require('webpage').create();

var url = 'https://tempostorm.com/hearthstone/meta-snapshot';

function renderPage(url) {
  page.onUrlChanged = function(targetUrl) {
    if(targetUrl.substr(0, url.length+1) == url + '/'){
      // The url we're looking for (after redirect)
      var fs = require('fs');
      fs.write('snapshotUrl.txt', targetUrl, 'w');
      console.log('New url: ' + targetUrl);
    }
  };

  page.open(url);
}

renderPage(url);
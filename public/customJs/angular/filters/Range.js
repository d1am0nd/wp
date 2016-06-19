app.filter('range', function() {
  return function(input, start, total) {
    total = parseInt(total);

    for (var i=start; i<total; i++) {
      input.push(i);
    }

    return input;
  };
})
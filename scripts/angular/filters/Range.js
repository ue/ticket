app.filter('range', function () {
  return function (input, total) {
    var i;
    total = parseInt(total, 10);
    for (i = 0; i < total; i++) {
      input.push(i);
    }
    return input;
  };
});
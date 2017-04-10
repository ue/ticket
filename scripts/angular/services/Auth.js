app.factory('auth', function () {

  var service = {
    token: false,
    user: false
  };

  service.clear = function () {
    service.token = false;
    service.user = false;
    store.remove('token');
    store.remove('user');
  };

  service.loadFromStorage = function () {
    if (store.get('token') !== undefined) {
      service.token = store.get('token');
    }

    if (store.get('user') !== undefined) {
      service.user = store.get('user');
    }
  };

  service.isLogged = function () {
    if (service.getToken() === false) {
      service.clear();
      return false;
    }
    return true;
  };

  service.setToken = function (token, user) {
    console.log("ugur");
    console.log(user);
    service.token = token;
    service.user = user;
    store.set('token', token);
    store.set('user', user);
  };

  service.getToken = function () {
    if (service.token === false) {
      service.loadFromStorage();
    }
    return service.token;

  };

  service.getUser = function () {
    if (service.isLogged() === true) {
      return service.user;
    }
    return false;
  };

  return service;

});
function HttpObject($http, $rootScope, $state) {

  this.rootUrl = '/index.php/api/';
  this.successCallback = null;
  this.errorCallback = null;
  this.exceptions = {};
  this.hiddenRequest = false;
  var self = this;

  this.post = function (url, data, hiddenRequest) {
    if (data === undefined) {
      data = {};
    }
    this.clearExceptions();
    return self.request('POST', url, data, hiddenRequest);
  };

  this.get = function (url, data, hiddenRequest) {
    if (data === undefined) {
      data = {};
    }
    this.clearExceptions();
    return self.request('GET', url, data, hiddenRequest);
  };

  this.successCaller = function (response) {
    // Loader broadcast is being stopping
    if (self.hiddenRequest === false) {
      $rootScope.$broadcast('Request.Off');
    }

    console.log(response);

    if (response.error !== false) {
      if (self.exceptions[response.error.type] !== undefined) {
        return self.exceptions[response.error.type](response);
      }
      return self.errorCaller(response);
    }

    // Calling callback if it was defined
    if (self.successCallback !== null) {
      self.successCallback(response);
    }
  };

  this.errorCaller = function (response) {
    // Broadcast messages is being sending to stop it
    if (self.hiddenRequest === false) {
      $rootScope.$broadcast('Request.Off');
    }
    // Calling callback if it was defined
    if (self.errorCallback !== null) {
      return self.errorCallback(response);
    }
    // Error message publishing
    console.log(response.error.texts);
    // alert.danger(response.error.texts);
  };

  this.request = function (method, url, data, hiddenRequest) {
    // Loader broadcast is being starting
    if (hiddenRequest === undefined) {
      $rootScope.$broadcast('Request.On');
    } else {
      self.hiddenRequest = true;
    }
    // Preparing request informations
    var request = {
      method: method,
      url: self.rootUrl + url + '?suid=' + (new Date().getTime()),
      data: $.param(data),
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
        'If-Modified-Since': '0'
      }
    };

    // All form elements set as disable
    // Sending HTTP Request
    $http(request)
      .success(self.successCaller)
      .error(self.errorCaller);

    return self;
  };

  this.success = function (callback) {
    self.successCallback = callback;
    return self;
  };

  this.error = function (callback) {
    self.errorCallback = callback;
    return self;
  };

  this.exception = function (type, callback) {
    self.exceptions[type] = callback;
    return self;
  };

  this.AuthException = function () {
    // $state.go('login');
  };

  this.clearExceptions = function () {
    self.exceptions = {
      'AuthException': self.AuthException
    };
  };

  this.checkAuthException = function () {
    console.log('checkAuthException');
    /**
    if (auth.get().Token !== undefined) {
      self.get('security/auth');
    }
    */
  };

}

app.factory('http', function ($http, $rootScope, $state) {

  var service = {};

  service.isReady = function (callback) {
    callback(new HttpObject($http, $rootScope, $state));
  };

  return service;

});
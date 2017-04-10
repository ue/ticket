app.factory('sweet', function () {

  var service = {
      callbacks: {
        success: null,
        cancel: null
      }
    };
  service.success = function (message) {
    this.type = 'success';
    this.title = 'Başarılı';
    this.put(message);
  };

  service.info = function (message) {
    this.type = 'info';
    this.title = 'Bilgi';
    this.put(message);
  };

  service.warning = function (message) {
    this.type = 'warning';
    this.title = 'Uyarı';
    this.put(message);
  };

  service.error = function (message) {
    this.type = 'error';
    this.title = 'Hata';
    this.put(message);
  };

  service.setCancelCallback = function (callback) {
    service.callbacks.cancel = callback;
    return service.getCallbackConnector();
  };

  service.setSuccessCallback = function (callback) {
    service.callbacks.success = callback;
    return service.getCallbackConnector();
  };

  service.getCallbackConnector = function () {
    return {
      cancel: service.setCancelCallback,
      success: service.setSuccessCallback
    };
  };

  service.question = function (message) {
    service.callbacks.cancel = null;
    service.callbacks.success = null;
    swal({
      title: "Kapatmak istedinize eminmisiniz ?",
      text: message,
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Evet",
      cancelButtonText: "Hayır",
      closeOnConfirm: true,
      closeOnCancel: true
    }, function (response) {
      if (response) {
        if (typeof service.callbacks.success === 'function') {
          service.callbacks.success();
        }
      } else {
        if (typeof service.callbacks.cancel === 'function') {
          service.callbacks.cancel();
        }
      }
    });
    return service.getCallbackConnector();
  };

  service.put  = function (message) {
    swal({
      title: this.title,
      text: message,
      type: service.type
    });
  };

  return service;

});
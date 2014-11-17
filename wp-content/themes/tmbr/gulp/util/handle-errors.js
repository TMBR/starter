(function() {
  var notify;

  notify = require("gulp-notify");

  module.exports = function() {
    var args;
    args = Array.prototype.slice.call(arguments);
    notify.onError({
      title: "Compile Error",
      message: "<%= error.message %>"
    }).apply(this, args);
    return this.emit("end");
  };

}).call(this);

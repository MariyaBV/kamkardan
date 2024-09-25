window.addEventListener("DOMContentLoaded", function() {
  document.querySelectorAll('.tel').forEach(function(input) {
    var keyCode;

    function mask(event) {
      event.keyCode && (keyCode = event.keyCode);
      var pos = this.selectionStart;
      var prevLength = this.value.length;

      if (pos < 1 && event.keyCode !== 8 && event.keyCode !== 46) { // Allow backspace (8) and delete (46) keys
        event.preventDefault();
      }

      var matrix = "+_ (___) ___ ____",  // Ensure that + is always present
          i = 0,
          def = matrix.replace(/\D/g, ""),
          val = this.value.replace(/\D/g, ""),
          new_value = matrix.replace(/[_\d]/g, function(a) {
              return i < val.length ? val.charAt(i++) : a;
          });

      i = new_value.indexOf("_");
      if (i != -1) {
          new_value = new_value.slice(0, i);
      }

      var reg = matrix.substr(0, this.value.length).replace(/_+/g, function(a) {
          return "\\d{1," + a.length + "}"; 
      }).replace(/[+()]/g, "\\$&");

      reg = new RegExp("^" + reg + "$");

      if (!reg.test(this.value) || this.value.length < 2 || (keyCode > 47 && keyCode < 58)) {
        this.value = new_value;
      }

      if (event.type == "blur" && this.value.length < 2) {
        this.value = "";
      }

      // Correct the cursor position after input
      var newPos = pos + (this.value.length - prevLength);
      if (newPos > 0 && newPos < this.value.length) {
        this.setSelectionRange(newPos, newPos);
      }
    }

    function handleDelete(event) {
      if (this.selectionStart == 0 && this.selectionEnd == this.value.length) {
        this.value = "";
      }
    }

    function handleInput(event) {
      if (this.value === "") {
        this.value = "+";
      }
    }

    input.addEventListener("input", mask, false);
    input.addEventListener("focus", mask, false);
    input.addEventListener("blur", mask, false);
    input.addEventListener("keydown", mask, false);
    input.addEventListener("keydown", handleDelete, false);
    input.addEventListener("input", handleInput, false);

  });
});

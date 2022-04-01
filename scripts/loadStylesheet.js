(function () {
  var _window = window;
  var _document = document;
  var _localStorage = _window.localStorage;

  var storageItem = "current-theme";

  var defaultTheme = "original";
  var currentTheme = (
    (
      _localStorage != null
        ? _localStorage.getItem(storageItem)
        : null
    )
    || defaultTheme
  );

  function getTheme() {
    return currentTheme;
  }

  function setTheme(selectedTheme) {
    currentTheme = selectedTheme;

    if (_localStorage != null) {
      _localStorage.setItem(storageItem, selectedTheme);
    }

    var links = _document.getElementsByTagName("link");
    for (var i = 0; i < links.length; i++) {
      var link = links[i];
      var theme = link.dataset["theme"];
      if (theme != null) {
        if (theme === selectedTheme) {
          link.disabled = false;
        } else {
          link.disabled = true;
        }
      }
    }
  }

  setTheme(currentTheme);

  _window.getTheme = getTheme;
  _window.setTheme = setTheme;

  _window.addEventListener("load", function () {
    var themeSelector = _document.getElementById("theme-selector");
    themeSelector.value = getTheme();
    themeSelector.addEventListener("change", function (event) {
      setTheme(themeSelector.value);
    });
  });
})();

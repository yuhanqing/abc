window.onload = function () {
    var level = document.getElementById('roleId');
    var options = document.getElementsByTagName('option');
    if (level) {
        for(i=0;i<options.length;i++) {
            if (options[i].value == level.value) {
                options[i].setAttribute('selected','selected');
            }
        }
    }
}
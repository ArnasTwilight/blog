function select (element) {
    return document.querySelector(element)
}
function selectAll (element) {
    return document.querySelectorAll(element)
}

let checkBox = select('.checkbox-theme')

if (localStorage.getItem('dark-theme') == 'true') {
    theme.setAttribute('href', '/views/template/css/dark-style.css')

    if (checkBox) {
        checkBox.checked = true
    }
}

if (checkBox) {
    checkBox.onchange = function () {
        if(this.checked) {
            localStorage.setItem('dark-theme', true)
            theme.setAttribute('href', '/views/template/css/dark-style.css')
        } else {
            localStorage.setItem('dark-theme', false)
            theme.setAttribute('href', '/views/template/css/style.css')
        }
    }
}

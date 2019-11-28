String.prototype.currency = function () {
    let decimal = Number(this).toFixed(2)
    return Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL'
    }).format(decimal)
}
Number.prototype.currency = function () {
    return this.toString().currency()
}
Number.prototype.pad = function (size) {
    var s = String(this)
    while (s.length < (size || 2)) { s = "0" + s }
    return s
}

import Vue from 'vue'
Vue.prototype.$validatorError = function (data) {
    let message = "<ul>"
    for (let row in data) {
        message += `<li>${data[row][0]}</li>`
    }
    message += "</ul>"
    return message
} 
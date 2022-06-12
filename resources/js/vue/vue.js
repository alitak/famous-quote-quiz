window.Vue = require('vue').default;

Vue.mixin({methods: {route: route}}) // ziggy

require("./utilities/Errors")
require("./utilities/Form")
require("./utilities/Event")

import vSelect from "vue-select"
import "vue-select/dist/vue-select.css"

Vue.component("v-select", vSelect)

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

const app = new Vue({
    el: '#app',
});

export const main_props = {
    name: {type: String, required: true},
    label: {type: String, required: false},
    required: {type: Boolean, required: false, default: false},
    error: {type: String, required: false},
    wrapperClass: {type: String, required: false, default: "col-12"},
    defaultValue: {required: false, default: ""},
    oldValue: {type: String | Array, required: false, default: null},
    tab: {type: String, required: false, default: "default"},
    hint: {type: String, required: false},
}

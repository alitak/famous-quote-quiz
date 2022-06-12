<template>
    <div :class="wrapperClass" class="mb-3">
        <label :for="name" v-text="label" class="form-label"></label>
        <div class="custom-control custom-radio" v-for="(option, key, index) in options">
            <input type="radio" :id="`${name}-${index}`" :name="name"
                   class="custom-control-input" :class="{'is-invalid': error}"
                   :required="Boolean(required)"
                   v-on:change="setValue($event)" :value="key"
                   :checked="value !== null && value === key"
            >
            <label class="custom-control-label" :for="`${name}-${index}`" v-text="option"></label>
            <div class="invalid-feedback" v-if="index === Object.keys(options).length -1 && error" v-text="error"></div>
        </div>
        <small class="form-text text-muted" v-text="hint" v-if="hint"></small>
    </div>
</template>

<script>
import {main_props} from "./main_props.js"

export default {
    name: "FgRadio",
    props: {
        ...main_props,
        ...{
            options: {type: Object, required: true}
        }
    },
    data() {
        return {
            value: this.oldValue ?? this.$attrs.value ?? this.defaultValue,
        }
    },
    methods: {
        setValue(event) {
            this.$emit("input", event.target.value);
        },
    },
}
</script>

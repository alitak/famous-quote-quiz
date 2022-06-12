<template>
    <div :class="wrapperClass" class="mb-3">
        <label :for="name" v-text="label" v-if="label" class="form-label"></label>
        <div :class="{'input-group' : groupSuffix}">
            <input type="text" :name="name" :id="name" class="form-control" :class="{'is-invalid': error}"
                   :required="Boolean(required)"
                   v-on:input="$emit('input', value)" v-model="value"
                   v-on:change="$emit('change', value)"
                   :disabled="disabled"
            >
            <div class="input-group-append" v-if="groupSuffix">
                <span class="input-group-text" v-text="groupSuffix"></span>
            </div>
            <div class="invalid-feedback" v-if="error" v-text="error"></div>
            <small class="form-text text-muted" v-text="hint" v-if="hint"></small>
        </div>
    </div>
</template>

<script>
import {main_props} from "./main_props.js"

export default {
    name: "FgInputText",
    props: {
        ...main_props,
        ...{
            disabled: {type: Boolean, required: false, default: false},
            groupSuffix: {type: String, required: false, default: ""},
        },
    },
    data() {
        return {
            value: this.oldValue ?? this.$attrs.value ?? this.defaultValue,
        }
    },
}
</script>

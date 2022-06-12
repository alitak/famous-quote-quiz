<template>
    <div :class="wrapperClass" class="mb-3">
        <label :for="name" v-text="label" v-if="label" class="form-label"></label>
        <v-select
            :name="name"
            :required="Boolean(required)"
            :options="options"
            :label="optionLabel"
            v-model="value"
            v-on:option:selected="optionChanged"
            v-on:input="optionChanged"
            :class="{'is-invalid': error}"
            :disabled="disabled"
            :multiple="multiple"
        >
            <template slot="option" slot-scope="option">
                <div class="d-center">
                    {{ option[optionLabel] }}
                </div>
            </template>
            <template slot="selected-option" slot-scope="option">
                <div class="selected d-center">
                    {{ option[optionLabel] }}
                </div>
                <input :name="name" type="hidden" :value="option[valueLabel]" :required="required">
            </template>
        </v-select>
        <div class="invalid-feedback" v-if="error" v-text="error"></div>
        <small class="form-text text-muted" v-text="hint"></small>
    </div>
</template>

<script>
import {main_props} from "./main_props"

export default {
    name: "FgSelect",
    props: {
        ...main_props,
        ...{
            options: {type: Array, required: true},
            optionLabel: {type: String, required: false, default: "name"},
            valueLabel: {type: String, required: false, default: "id"},
            disabled: {type: Boolean, required: false, default: false},
            multiple: {type: Boolean, required: false, default: false},
        },
    },
    data() {
        return {
            value: this.getSelectedValue(),
        }
    },
    methods: {
        optionChanged() {
            this.$emit("input", this.value ? (this.value[this.valueLabel] ?? this.value) : null)
        },
        getSelectedValue() {
            if (this.oldValue === "" && this.$attrs.value === "" && this.defaultValue === "") {
                return ""
            }
            let selected = this.oldValue ?? this.$attrs.value ?? this.defaultValue
            if (this.multiple) return selected

            let selectedOption = ""
            this.options.some((option) => {
                if (option === selected || option[this.valueLabel] === selected) {
                    selectedOption = option
                    return true
                }
            })
            return selectedOption
        },
    },
}
</script>

<style>
.v-select {
    background-color: #ffffff;
    height: 40px;
}

.vs__dropdown-toggle {
    cursor: text;
    height: 40px;
    border: 1px solid #E3E3E3;
}

.vs__search {
    height: 100%;
}

.is-invalid .vs__dropdown-toggle {
    border: 1px solid #dc3545;
}

</style>

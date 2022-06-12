<template>
    <button type="submit" :class="buttonClass" v-on:click.prevent="submitted" :disabled="isStoring">
        <i :class="icon" v-if="icon"></i>
        <span v-if="label">{{ label }}</span>
        <span v-if="isStoring"><i class="fas fa-spin fa-spinner"></i></span>
    </button>
</template>

<script>
export default {
    name: "Submit",
    props: {
        buttonClass: {type: String, default: "btn btn-success"},
        icon: {type: String, default: "fas fa-sign-in-alt", required: false},
        label: {type: String, required: false},
        storeMethod: {type: Function},
    },
    data() {
        return {
            isStoring: false,
        }
    },
    methods: {
        submitted() {
            this.storeMethod()
        },
        disable() {
            this.isStoring = true
        },
        enable() {
            this.isStoring = false
        },
    },
    mounted() {
        Event.listen('submit-started', this.disable)
        Event.listen('submit-finished', this.enable)
    },
    beforeDestroy() {
        Event.off('submit-started', this.enable)
        Event.off('submit-finished', this.disable)
    },
}
</script>

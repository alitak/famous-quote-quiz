<template>
    <fg-select name="correct_answer" label="Correct answer" v-model="correct_answer" v-on:input="$emit('input', {key: 'correct_answer', value: correct_answer})" :error="errors.get('correct_answer')" :options="yesNoOptions" wrapper-class="col-12"></fg-select>
</template>

<script>
export default {
    name: "Binary",
    props: {
        errors: {type: Object, required: true},
        data: {type: Object, required: true},
    },
    data() {
        return {
            correct_answer: this.data.correct_answer ?? null,
            yesNoOptions: [
                {id: 0, name: "No"},
                {id: 1, name: "Yes"},
            ],
        }
    },
}
</script>

<style scoped>

</style>

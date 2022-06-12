<template>
    <div>
        <fg-input-text name="answer_1" label="Answer 1" v-model="answer_1" v-on:input="$emit('input', {key: 'answer_1', value: answer_1})" :error="errors.get('answer_1')" wrapper-class="col-12"></fg-input-text>
        <fg-input-text name="answer_2" label="Answer 2" v-model="answer_2" v-on:input="$emit('input', {key: 'answer_2', value: answer_2})" :error="errors.get('answer_2')" wrapper-class="col-12"></fg-input-text>
        <fg-input-text name="answer_3" label="Answer 3" v-model="answer_3" v-on:input="$emit('input', {key: 'answer_3', value: answer_3})" :error="errors.get('answer_3')" wrapper-class="col-12"></fg-input-text>
        <fg-select name="correct_answer" label="Correct answer" v-model="correct_answer" v-on:input="$emit('input', {key: 'correct_answer', value: correct_answer})" :error="errors.get('correct_answer')" :options="correctAnswers" wrapper-class="col-12"></fg-select>
    </div>
</template>

<script>
export default {
    name: "Multiple",
    props: {
        errors: {type: Object, required: true},
        data: {type: Object, required: true},
    },
    data() {
        return {
            answer_1: this.data.answer_1 ?? null,
            answer_2: this.data.answer_2 ?? null,
            answer_3: this.data.answer_3 ?? null,
            correct_answer: this.data.correct_answer ?? null,
            correctAnswers: [
                {id: 1, name: 1},
                {id: 2, name: 2},
                {id: 3, name: 3},
            ],
        }
    },
}
</script>

<style scoped>

</style>

<template>
    <div>
        <div class="form-check" v-for="(i) in [1,2,3]">
            <input class="form-check-input" type="radio" name="answer" :id="`answer_${i}`" v-on:input="check(i)">
            <label class="form-check-label" :for="`answer_${i}`">
                {{ data[`answer_${i}`] }}
            </label>
        </div>
    </div>
</template>

<script>
export default {
    name: "QuizMultiple",
    props: {
        data: {type: Object, required: true},
        currentResult: {type: Boolean, required: false, default: null},
    },
    methods: {
        check(answer) {
            Event.fire('answer', answer === this.data.correct_answer)
        },
    },
}
</script>

<style scoped>

</style>

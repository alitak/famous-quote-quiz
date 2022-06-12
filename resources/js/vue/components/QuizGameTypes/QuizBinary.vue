<template>
    <div>
        <button class="btn btn-success" v-on:click="check(1)">Yes</button>
        <button class="btn btn-danger" v-on:click="check(0)">No</button>
    </div>
</template>

<script>
export default {
    name: "QuizBinary",
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

<template>
    <form>
        <fg-select name="type" label="Game type" v-model="question.type" :error="question.errors.get('type')" :options="gameTypes" wrapper-class="col-12"></fg-select>
        <fg-input-text name="question" label="Question" v-model="question.question" :error="question.errors.get('question')" wrapper-class="col-12"></fg-input-text>
        <!-- todo: on change remove data from fields? -->
        <component :is="question.type" :errors=question.errors :data=question v-on:input="processComponentData"/>
        <submit label="Submit" :store-method="submit" button-class="btn btn-success"/>
        <a :href="route('admin.questions.index')" class="btn btn-secondary">Cancel</a>
    </form>
</template>

<script>
export default {
    name: "AdminQuestion",
    props: {
        entry: {type: Object, required: false},
        gameTypes: {type: Array, required: true},
    },
    data() {
        return {
            question: new Form(this.entry ?? {
                id: null,
                question: null,
                type: null,
                answer_1: null,
                answer_2: null,
                answer_3: null,
                correct_answer: null,
            }),
        }
    },
    methods: {
        processComponentData(data) {
            this.question[data.key] = data.value
        },
        submit() {
            let submit_type = "post"
            let url = route('admin.questions.store')

            if (this.question.id !== null) {
                submit_type = "put"
                url = route('admin.questions.update', this.question.id)
            }

            this.question.submit(submit_type, url)
                .then(response => {
                    window.location.href = response.route
                })
        },
    },
    mounted() {
    },
}
</script>

<style scoped>

</style>

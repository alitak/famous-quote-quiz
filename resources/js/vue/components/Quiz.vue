<template>
    <div>
        <div class="text-center mb-3">
            <button class="btn btn-success" v-on:click="start" v-if="!isRunning && !isFinished ">START</button>
        </div>

        <div class="alert alert-warning" v-if="missingQuiz">
            Sorry, there are no questions at the moment. Please try again later!
        </div>

        <div v-if="isRunning && currentTime > 0" class="mb-5">
            <div class="progress mb-3">
                <div class="progress-bar progress-bar-striped" :class="{progressBackground, 'progress-bar-animated': !isPaused}" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" :style="{width: progressPercent}">
                    {{ currentTime|timeForHumans }} / {{ timeForGame|timeForHumans }}
                </div>
            </div>
            <div>
                <h3 v-text="questions[currentQuestionId].question"></h3>
                <component :data="questions[currentQuestionId]" :is="`quiz-${gameType}`" v-if="currentResult === null"></component>
            </div>
            <div v-if="currentResult !== null">
                <div class="alert alert-success" v-if="currentResult === true">The answer is correct!</div>
                <div class="alert alert-danger" v-if="currentResult === false">Sorry, you are wrong! The right answer is {{ correctAnswer }}</div>
                <button class="btn btn-warning" v-on:click="tick">Next</button>
            </div>
        </div>

        <div class="alert alert-warning" v-if="isFinished">
            <div v-if="currentTime === 0">
                <h4>Sorry, time is up!</h4>
                <h5>Unanswered questions: {{ questions.length - results.answer_count }}</h5>
            </div>
            <div v-else>
                <h3>Results</h3>
                <h4>Total answers: {{ results.answer_count }}</h4>
                <h4>Correct answers: {{ results.correct_answer }}</h4>
                <h4>Total time: {{ results.total_time|timeForHumans }}</h4>
            </div>
            <div class="text-center">
                <button class="btn btn-success" v-on:click="restart">Restart</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Quiz",
    data() {
        return {
            isRunning: false,
            isFinished: false,
            isPaused: false,
            missingQuiz: false,
            timeForGame: 10,
            currentTime: 0,
            questions: [],
            currentQuestionId: null,
            gameType: null,
            progress: 0,
            currentResult: null,
            timer: null,
            results: {
                answer_count: 0,
                correct_answer: 0,
                total_time: 0,
            },
        }
    },
    computed: {
        progressPercent() {
            this.progress = ((this.currentTime / this.timeForGame) * 100)
            return this.progress + "%"
        },
        progressBackground() {
            if (this.progress > 50) {
                return "bg-primary"
            } else if (this.progress > 20) {
                return "bg-warning"
            } else {
                return "bg-danger"
            }
        },
        correctAnswer() {
            if (this.gameType === "binary") {
                if (this.questions[this.currentQuestionId].correct_answer) return "Yes"

                return "No"
            } else {
                return this.questions[this.currentQuestionId][`answer_${this.questions[this.currentQuestionId].correct_answer}`]
            }
        }
    },
    methods: {
        start() {
            axios.get(route('api.quiz'))
                .then(response => {
                    this.missingQuiz = false
                    this.populateInitData(response.data)

                    if (this.questions.length === 0) {
                        this.missingQuiz = true
                        return
                    }

                    this.results.answer_count = 0
                    this.results.correct_answer = 0
                    this.results.total_time = 0

                    this.currentTime = this.timeForGame
                    this.currentQuestionId = 0
                    this.isRunning = true
                    this.timer = setInterval(() => {
                        if (this.isPaused) return

                        if (this.currentTime === 0) {
                            clearInterval(this.timer)
                            this.end()
                            return
                        }

                        this.currentTime--
                    }, 1000)
                })
        },
        populateInitData(data) {
            for (const [key, value] of Object.entries(data)) {
                this[key] = value
            }
        },
        checkAnswer(result) {
            this.isPaused = true

            this.results.answer_count++
            if (result) this.results.correct_answer++
            this.currentResult = result
        },
        tick() {
            this.currentResult = null

            if (this.questions.length === this.currentQuestionId + 1) this.end()
            else this.currentQuestionId++
            this.isPaused = false
        },
        end() {
            let total_time = this.timeForGame - this.currentTime

            axios.post(route('api.results'), {
                total_score: this.results.correct_answer,
                total_unanswered: this.questions.length - this.results.answer_count,
                total_time: total_time,
            })

            this.isFinished = true
            clearInterval(this.timer)
            this.questions = []
            this.isRunning = false
            this.currentResult = null
            this.results.total_time = total_time
        },
        restart() {
            this.isFinished = false
            this.isRunning = false
        }
    },
    mounted() {
        Event.listen("answer", this.checkAnswer)
    }
}
</script>

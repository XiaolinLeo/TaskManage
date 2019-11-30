<template>
    <div>
        <div class="row">

            <div class="col">
                <step-list :route="url" :steps="inProcess">
                            <div class="card-header d-flex justify-content-between">
                                <span>未完成({{ steps.length }})</span>
                                <button class="btn btn-success btn-sm " style="margin-right: 10px;" @click="completeAll">完成全部
                                </button>
                            </div>
                </step-list>
            </div>

            <div class="col">
                <step-list :route="url" :steps="Process">
                    <div class="card-header d-flex justify-content-between">
                        <span>未完成({{ steps.length }})</span>
                        <button class="btn btn-danger btn-sm " style="margin-right: 10px;" @click="clearAll">清除全部
                        </button>
                    </div>
                </step-list>
            </div>
        </div>
            <step-input :route="url"></step-input>


    </div>

</template>

<script>
    import {Hub} from '../event-bus'

    export default {
        props: {
            url: String,
            initialSteps:Array
        },
        components: {
            'step-input': require('./step-input').default,
            'step-list': require('./step-list').default
        },
        data() {
            return {
                steps: this.initialSteps
            }
        },
        created() {
            Hub.$on('add', (data) => {
                this.steps.push(data);
            });
            Hub.$on('remove',this.remove)
        },
        methods: {
            remove(step) {
                    let i = this.steps.indexOf(step);
                    this.steps.splice(i, 1);
            },
            edit(step) {
                this.remove(step);
                Hub.$emit('edit', step)
            },
            completeAll() {
                axios.post(`${this.url}/complete`).then((res) => {
                    this.inProcess.forEach((step) => {
                        step.completion = true;
                    })
                })

            },
            clearAll() {
                axios.delete(`${this.url}/clear`).then((res) => {
                    this.steps = this.inProcess;
                })

            }

        },
        computed: {
            inProcess() {
                return this.steps.filter((step) => {
                    return step.completion == false
                })
            },
            Process() {
                return this.steps.filter((step) => {
                    return step.completion == true
                })
            },
        }
    }
</script>
<style>

</style>

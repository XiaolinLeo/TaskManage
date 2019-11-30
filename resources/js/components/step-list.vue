<template>
    <div class="card" v-if="steps.length">
        <slot></slot>

        <ul class="list-group list-group-flush -pull-right" v-for="step in steps">
            <li class="list-group-item d-flex justify-content-between">
                <span @dblclick="edit(step)">
                    {{step.name}}
                </span>
                <span>
                    <i class="fa fa-check" @click="toggle(step)"></i>
                    <i class="fa fa-close" @click="remove(step)"></i>
                </span>
            </li>
        </ul>
    </div>
</template>
<script>
    import {Hub} from '../event-bus'
    export default {
        props: {
            route: String,
            steps: Array
        },
        methods: {
            toggle(step) {
                axios.patch(`${this.route}/${step.id}`, {completion: !step.completion}).then((res) => {
                    step.completion = !step.completion
                })
            },
            remove(step){
                axios.delete(`${this.route}/${step.id}`).then((res) => {
                    Hub.$emit('remove',step)
                })
            }
        }

    }

</script>

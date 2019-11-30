<template>
    <div class="row mt-lg-5">
        <div class="col-6">
            <div class="col">
                <div class="card">
                    <div class="card-header" v-show="!newStep">请输入你要添加的任务</div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <input type="text" ref="newStep" class="form-control" style="margin-left: 11px;"
                                   v-model="newStep" @keyup.enter="addStep">
                        </li>
                        <li class="list-group-item text-right" v-show="newStep">
                            <button class="btn btn-primary btn-sm" @click="addStep">提交</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import {Hub} from '../event-bus'
    export default {
        props:{
            route:String
        },
        data(){
            return {
                newStep: ''
            }
        },
        created() {
            Hub.$on('edit',this.edit)
        }
        ,
        methods:{
            addStep() {
                axios.post(this.route, {name: this.newStep}).then((res) => {
                    Hub.$emit('add',res.data.step)
                    this.newStep = '';
                })
            },
            edit(step){
                this.newStep = step.name;
                this.$refs.newStep.focus();
            }
        }
    }
</script>

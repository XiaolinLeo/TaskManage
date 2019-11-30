<template>
    <div class="search-form">
        <form class="form-inline ml-3 ">
            <div class="input-group input-group-sm">
                <input type="text" class="form-control" @focus="fetch" @blur="leave" placeholder="search..."
                       aria-label="Small"
                       aria-describedby="inputGroup-sizing-sm">
                <div class="input-group-append">
                    <span class="input-group-text" id="inputGroup-sizing-sm"><i class="fa fa-btn fa-search"></i></span>
                </div>
            </div>
        </form>
<!--        <div class="dropdown-content">-->
            <ul class="list-group search-list" v-if="show">
                <li class="list-group-item" v-for="task in tasks">{{task.name}}</li>
            </ul>
<!--        </div>-->
    </div>

</template>
<script>
    export default {
        data() {
            return {
                tasks: [],
                show:false
            }
        },
        methods: {
            fetch() {
                axios.get('/tasks/search').then((res) => {
                    this.tasks = res.data.tasks
                    this.show = true
                }).catch((error) => {
                    console.log(error)
                })
            },
            leave(){
                this.show = false
            },

        }
    }
</script>

<style>
    .search-form{
        position:absolute;
        margin-left: 100px;
        z-index:100;
        display: flex;
        flex-direction: column;
        justify-content: left;
        align-items: center;
    }

    .search-list{

    }
</style>

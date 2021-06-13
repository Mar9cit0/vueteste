<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <router-link :to='{name:"add"}' class="btn btn-primary">Create</router-link>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Tarefa</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>nome da tarefa</th>
                                    <th>Status</th>
                                    <th>data</th>
                                </tr>
                            </thead>
                            <tbody v-if="tareas.length > 0">
                                <tr v-for="(tareas,key) in tarea" :key="key">
                                    <td>{{ tarea.id }}</td>
                                    <td>{{ tarea.title }}</td>
                                    <td>{{ tarea.description }}</td>
                                    <td>
                                        <router-link :to='{name:"tareaEdit",params:{id:tarea.id}}' class="btn btn-success">Edit</router-link>
                                        <button type="button" @click="deleteTarea(tarea.id)" class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="4" align="center">Não se eeeeeencontrou tarefa.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"tareas",
    data(){
        return {
            tareas:[]
        }
    },
    mounted(){
        this.getTareas()
    },
    methods:{
        async getTareas(){
            await this.axios.get('/api/lista').then(response=>{
                this.tareas = response.data
            }).catch(error=>{
                console.log(error)
                this.tareas = []
            })
        },
        deleteTareas(id){
            if(confirm("Are you sure to delete this homework ?")){
                this.axios.delete(`/api/tarea/${id}`).then(response=>{
                    this.getTareas()
                }).catch(error=>{
                    console.log(error)
                })
            }
        }
    }
}
</script>
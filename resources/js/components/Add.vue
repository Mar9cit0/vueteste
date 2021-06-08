<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Adicionar Tarefa</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="create">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Nome da tarefa</label>
                                    <input type="text" class="form-control" v-model="tarea.tarea">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Status</label>
                                    <input type="text" class="form-control" v-model="tarea.status">
                                </div>
                            </div>
                              <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Data</label>
                                    <input type="text" class="form-control" v-model="tarea.data">
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"add-tarea",
    data(){
        return {
            tarea:{
                tarea:"",
                status:"",
                data:""
            }
        }
    },
    methods:{
        async create(){
            await this.axios.post('/api/tarea',this.tarea).then(response=>{
                this.$router.push({name:"lista"})
            }).catch(error=>{
                console.log(error)
            })
        }
    }
}
</script>
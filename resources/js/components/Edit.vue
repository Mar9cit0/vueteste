<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Update Category</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="update">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Nome da tarea</label>
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
                                <button type="submit" class="btn btn-primary">Update</button>
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
    name:"update-tarea",
    data(){
        return {
            tarea:{
                tarea:"",
                status:"",
                data:"",
                _method:"patch"
            }
        }
    },
    mounted(){
        this.showTarea()
    },
    methods:{
        async showTarea(){
            await this.axios.get(`/api/tarea/${this.$route.params.id}`).then(response=>{
                const { tarea, status,data } = response.data
                this.tarea.tarea = tarea
                this.tarea.status = status
                this.tarea.data = data
            }).catch(error=>{
                console.log(error)
            })
        },
        async update(){
            await this.axios.post(`/api/tarea/${this.$route.params.id}`,this.tarea).then(response=>{
                this.$router.push({name:"tareaList"})
            }).catch(error=>{
                console.log(error)
            })
        }
    }
}
</script>
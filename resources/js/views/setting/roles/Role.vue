<template>
    <div class="row">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Tambah</h3>
                            </div>
                            
​
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Role</label>
                                    <input  v-model="form.roleName" type="text" class="form-control" :class="{'is-invalid' : form.errors.has('roleName')}" id="Role" placeholder="Role Name">
                                 <has-error :form="form" field="roleName"  ></has-error>
                                </div>
                           
                                <div class="card-footer">
                                    <button class="btn btn-primary"  @click="addData" >Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">List</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Role</td>
                                            <td>Guard</td>
                                            <td>Created At</td>
                                            <td>Aksi</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <form action="" method="POST">
                                                  
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                       
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada data</td>
                                        </tr>
                                       
                                    </tbody>
                                </table>
                            </div>
                            </div>
​
                            <div class="float-right">
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>





</template>
<script>

export default {
   data() {
       return {
        form : new Form({
            id: '',
            roleName : '',
        }), 
        loading : false,  
        data :{},
        message :{},
        addModal : false, 
        editModal : false, 
        isAdding : false, 
       }
    },
   methods : {
       loadData(){
           axios.get('api/role').then(({data}) => (this.roles = data))
       }
   },
   created(){
       this.loadData();
       console.log(this.loadData())
   }
   
}
</script>
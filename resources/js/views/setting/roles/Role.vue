<template>
    <div class="row">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title" v-show="!editMode">Tambah</h3>
                                <h3 class="card-title" v-show="editMode">Edit Data</h3>
                            </div>
                            
​
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Role</label>
                                    <input  v-model="form.roleName" type="text" class="form-control" :class="{'is-invalid' : form.errors.has('roleName')}" id="Role" placeholder="Role Name">
                                 <has-error :form="form" field="roleName"  ></has-error>
                                 <p class="text-danger" v-if="errors.roleName">
                                    {{ errors.roleName[0] }}
                                </p>
                                </div>
                           
                                <div class="card-footer">
                                    <button class="btn btn-primary"  @click="addData" v-show="!editMode">Simpan</button>
                                    <button class="btn btn-primary"  @click="addData" v-show="editMode">Update Data</button>
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
                                       
                                        <tr v-for="(row, i) in roles" :key="i">
                                            <td>{{i+1}}</td>
                                            <td>{{row.name}}</td>
                                            <td>{{row.guard_name}}</td>
                                            <td>{{row.created_at}}</td>
                                            <td>
                                                  
                                <router-link :to="{ name:'role.permissions' }" class="btn btn-icon icon-left btn-success btn-sm white"><i class="fas fa-check"></i> Access</router-link>
                                <button   class="btn btn-icon icon-left btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="far fa-edit"></i> Edit</button>
                                <button  class="btn btn-icon icon-left btn-danger btn-sm"><i class="fas fa-times"></i> Delete</button> 
                                            </td>
                                        </tr>
                                       
                                        <tr v-if="!roles.length">
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
import { mapActions, mapState, mapMutations } from "vuex";
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
        editMode : false, 
        isAdding : false, 
        alert_role : false,
       }
    },
   methods : {
        ...mapActions("user", [
           "getRoles",
           "getAllPermission",
           "addRole",

           
    ]),
       addData(){
        this.form.post('/api/role')
        .then((response) => {
            console.log(response)
            setTimeout(() => {
                this.form.clear()
                this.alert_role = false;
            }, 1000);
            
        })
        .catch((error) => {
            
        })
       }
   },
   computed: {
    ...mapState(["errors"], { errors: (state) => state.errors }), //ME-LOAD STATE ERRORS
    ...mapState("user", {
      roles: (state) => state.roles, //ME-LOAD STATE ROLES

    })
  },
   created(){
       this.getRoles();
       
   }
   
}
</script>